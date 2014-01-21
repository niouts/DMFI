<?php 
/**
 * Services
 */
/**
 * Définition du service des authentifications
 * @package DMFI\Administration\Service
 * @author GFI
 */
class Administration_Service_Auth
{
	/**
	 * Identification d'un utilisateur 
	 * @param string $login
	 * @param string $pass
	 * @return Application_Model_Object_Utilisateur|bool   
	 */
	public function Identifier($login, $pass)
	{
		
		$authAdapter = new Zend_Auth_Adapter_DbTable();
		$authAdapter->setTableName('t_utilisateur')
					->setIdentityColumn('uti_login')
					->setCredentialColumn('uti_pwd')
					->setIdentity($login)
					->setCredential(md5($pass));
		$auth = $authAdapter->authenticate();
		$data = $authAdapter->getResultRowObject();
		
		if (!$data->uti_id)
			return false;
			
		$uti = Application_Model_Object_Utilisateur::find($data->uti_id);		
		
		if($uti)
			return $uti;
		else
			return false;
	}
	
}
