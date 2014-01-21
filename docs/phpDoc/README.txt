-- Copier go-pear.php dans le répertoire de PHP

-- Installation de PEAR (http://pear.php.net/manual/fr/installation.getting.php) : 
$ php go-pear.php
(Mode system)

-- Installer graphviz

-- Installation de phpDoc (http://www.phpdoc.org/docs/latest/for-users/installation/using-pear.html) :
$ pear channel-discover pear.phpdoc.org
$ pear install phpdoc/phpDocumentor-alpha

-- définir la variable d'environnement PHP_PEAR_BIN_DIR si elle n'existe pas 

-- Remplacer le dossier pear\phpDocumentor\data\templates\responsive par celui dans docs/phpDoc/template/responsive

-- modifier le fichier de configuration phpdoc.xml (balises target)

-- activer l'extension xsl si pas déjà fait (dans le php.ini de ligne de commande)

-- lancer la génération de la doc : 
phpdoc -c d:\ZendWorkspace\DMFI\docs\phpDoc\phpdoc.xml --encoding ISO-8859-1
ou
$ cd d:\ZendWorkspace\DMFI\docs\phpDoc\
$ phpdoc -c phpdoc.xml --encoding ISO-8859-1