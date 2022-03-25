<?php
/*
	Type fichier : php 
	Fonction : Connexion au serveur
	Emplacement : php
	Contenu HTML : n
	JS+JQuery : n
	CSS : n
*/
	$servername = 'localhost';
	$username = 'aili';
	$password = 'root';
	$dbname = 'webbd';

	//Connexion à la BDD
	$con = mysqli_connect($servername, $username, $password, $dbname);

	//Vérification de la connexion
	if (mysqli_connect_errno()) 
	{
		printf("Échec de la connexion : %s\n", mysqli_connect_error());
		exit();
	}
?>