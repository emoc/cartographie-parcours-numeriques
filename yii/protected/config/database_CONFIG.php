<?php

// This is the database connection configuration.
// � renommer en database.php apr�s configuration

return array(
	//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database

    
    'connectionString' => 'mysql:host=;dbname=', // nom ddu serveur et nom de la base
	'emulatePrepare' => true,
	'username' => '',                            // nom d'utilisateur
	'password' => '',                            // mot de passe d'utilisateur
	'charset' => 'utf8',
	'enableProfiling' => true,    // d�bugueur panel, � d�sactiver pour la version en ligne
    'enableParamLogging' => true, // d�bugueur panel, � d�sactiver pour la version en ligne
    
);