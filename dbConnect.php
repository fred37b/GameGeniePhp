<?php		
	/**
	 * Mise a jour : 06/09/16
	 * 
	 * Permet de se connecter a la bdd, est appele par l'ensemble des scripts.
	 * 
	 */
	//Defining Constants
	define('HOST','<host_address>');
	define('USER','<user>');
	define('PASS','<password>');
	define('DB','<data_base_name>');
	
	//Connecting to Database
	$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');