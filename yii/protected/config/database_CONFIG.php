<?php

// This is the database connection configuration.
// à renommer en database.php après configuration

return array(
	//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database

    
    'connectionString' => 'mysql:host=;dbname=', // nom ddu serveur et nom de la base
	'emulatePrepare' => true,
	'username' => '',                            // nom d'utilisateur
	'password' => '',                            // mot de passe d'utilisateur
	'charset' => 'utf8',
	'enableProfiling' => true,    // débugueur panel, à désactiver pour la version en ligne
    'enableParamLogging' => true, // débugueur panel, à désactiver pour la version en ligne
    
);