<?php
/**
 * objets des tables
 */
/**
 * Définition de la classe abstraite
 * @package DMFI\Models\Object
 * @author GFI
 */
abstract class Application_Model_Object_Abstract
{
	/**
	 * @var Application_Model_Mapper_* mapper de l'objet
	 */
	protected $_mapper;
	
	/**
	 * @var string[] noms des clé étrangères
	 */
	protected $_keys = array();

	/**
	 * méthode magic d'affectation
	 * @param string $name nom  de la variable
	 * @param mixed $value valeur de la variable
	 * @throws Exception
	 */
	public function __set($name, $value)
    {
        $method = 'set' . ucfirst(strtolower($name));
        if (('_mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid location property');
        }
        $this->$method($value);
    }
 
    /**
	 * méthode magic de récupération
	 * @param string $name nom  de la variable
	 * @throws Exception
	 * @return mixed
	 */
    public function __get($name)
    {
        $method =  'get'.ucfirst(strtolower($name));
        if (('_mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid location property');
        }
        return $this->$method();
    }
 
    /**
	 * méthode d'affectation de l'objet
	 * @param array $data tableau des valeurs (nom=>valeur)
	 * @return Application_Model_Object_*
	 */
	public function hydrate(array $data)
    { 
        $methods = get_class_methods($this);
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst(strtolower(str_replace($this->_prefix, '', $key)));
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        
        return $this;
    }
    
    /**
     * méthode static recupérant le mapper de l'objet
     * @param string $class nom complet de la classe de l'objet
     * @return Application_Model_Mapper_*
     */
    private static function getMapper($class)
    {
    	$m = str_replace('Object', 'Mapper', $class);
		return new $m();
    }
    
    /**
	 * Initialisation du mapper et remplissage de l'objet
	 * @param int|array $data l'id de l'objet à retourner ou un tableau de données
	 */
	public function __construct($data = null)
    {
		$this->_mapper = self::getMapper(get_class($this));
		if (is_array($data)) {
            $this->hydrate($data);
        } else if (is_integer($data)) {
        	$this->hydrate($this->_mapper->getDbTable()->find($data)->current()->toArray());
        }
    }
    
    /**
     * Transformation d'un objet en tableau 
     * @param string $encodage encodage souhait (ISO ou UTF8)
     * @param bool $all si vrai, retourne toutes les variables même null. faux sinon.
     * @return array
     */
	public function toArray($encodage='',$all=false)
    {
    	$tab = array();
    	$obj =get_object_vars($this); 
		foreach ($obj as $key => $var) {
			if( (!$all and !$var) or ($key == '_mapper') )
				continue;
				
			switch ($encodage)
			{
				case 'ISO':
					$tab[$key] = mb_convert_encoding($var, 'ISO-8859-1', mb_detect_encoding($var));
				    break;
				
				case 'UTF8':
					$tab[$key] = utf8_encode($var);
				    break;
				
				default:
					$tab[$key] = $var;
			}

		}
		return $tab;
    }
    
    /**
     * Transformation d'un objet en tableau pour le mapper
     * @param string $encodage encodage souhait (ISO ou UTF8)
     * @return array
     */
	public function toTable($encodage='')
    {
    	$tab = array();
    	$obj =get_object_vars($this);
    	 
		foreach ($obj as $key => $var) {
			if(in_array($key, array('_mapper', '_prefix', '_keys')))
				continue;
				
			if(!$this->isKey($key))
				$key = $this->_prefix.$key;
							
			switch ($encodage) {
				case 'ISO':
					$tab[$key] = mb_convert_encoding($var, 'ISO-8859-1', mb_detect_encoding($var));
				    break;
				
				case 'UTF8':
					$tab[$key] = utf8_encode($var);
				    break;
				
				default:
					$tab[$key] = $var;
			}

		}
		
		return $tab;
    }
    
    /**
     * Sauvegarde de l'objet
     */
    public function save()
    {
    	$this->_mapper->save($this);
    }
    
    /**
     * Trouve un objet
     * @param int|string|array|Zend_Db_Table_Select $param
     * @return Application_Model_Object_*
     */
    public static function find($param)
    {
    	$_mapper = self::getMapper(get_called_class());
    	return $_mapper->find($param);
    }
    
    /**
     * Retourne toutes les objets de la table
     * @param string|array|Zend_Db_Table_Select $where  OPTIONAL An SQL WHERE clause or Zend_Db_Table_Select object.
     * @param string|array                      $order  OPTIONAL An SQL ORDER clause.
     * @return Application_Model_Object_*[]
     */
	public static function all($where=null, $order=null)
    {
    	$_mapper = self::getMapper(get_called_class());
    	return $_mapper->all($where, $order);
    }
    
    /**
     * Supprime l'objet
     */
	public function delete()
    {
    	if ($this->getId())
    		$this->_mapper->delete($this->getId());
    }
    
    /**
     * Retourne si le $champ est une clé étrangère.
     * @param string $champ nom du champ
     * @return bool
     */
    public function isKey($champ)
    {
    	return in_array($champ, $this->_keys);
    }
    
    /**
     * Retourne l'objet parent.
     * @param string $cible nom du parent (fin du nom de la classe)
     * @return Application_Model_Object_*
     */
    public function getParent($cible)
    {
		$row = $this->_mapper->getDbTable()->find($this->getId())->current();
		
		$profile = $row->findParentRow('Application_Model_DbTable_'.$cible)->toArray();
		$class = 'Application_Model_Object_'.$cible;
		
		return new $class($profile);
    }
    
    /**
     * Retourne un tableau d'objet dépendants.
     * @param string $cible nom du parent (fin du nom de la classe)
     * @return Application_Model_Object_*[]
     */
    public function getDependent($cible)
    {
    	$aData 		= array();
		$aObjects 	= array();
		
		$row = $this->_mapper->getDbTable()->find($this->getId())->current();
		
		$aData = $row->findDependentRowset('Application_Model_DbTable_'.$cible)->toArray();
		$class = 'Application_Model_Object_'.$cible;
		
		foreach ($aData as $data) {
			$aObjects[] = new $class($data);
		}
		
		return $aObjects;
    }
    
    /**
     * Retourne un tableau d'objet de relation multiple.
     * @param string $cible nom du parent (fin du nom de la classe)
     * @param string $intersection nom de l'objet de liaison (fin du nom de la classe)
     * @return Application_Model_Object_*[]
     */
    public function getManyToMany($cible,$intersection)
    {
    	$aData 		= array();
		$aObjects 	= array();
		
		$row = $this->_mapper->getDbTable()->find($this->getId())->current();
		
		$aData = $row->findManyToManyRowset(
		    'Application_Model_DbTable_'.$cible, 'Application_Model_DbTable_'.$intersection
		)->toArray();
		$class = 'Application_Model_Object_'.$cible;
		
		foreach ($aData as $data) {
			$aObjects[] = new $class($data);
		}
		
		return $aObjects;
    }
    
}