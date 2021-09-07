<?php
/*
	Type fichier : 
	Fonction : 
	Emplacement : 
	Connexion à la BDD :  
	Contenu HTML : 
	JS+JQuery : 
	CSS : 
*/
require('../php/database.php');

$action = $_POST['modsuppr'];

if($action == 'valider')
{
	$idcheck = $_POST['idcheck'];
	$sql = "UPDATE session SET actif = 0 WHERE actif = 1 ";
	$query = mysqli_query($con ,$sql);
	$sql = "UPDATE session SET actif = 1 WHERE id = '$idcheck' ";
	$query = mysqli_query($con ,$sql);
	$sql = "UPDATE utilisateur SET points_session = 0";
	$query = mysqli_query($con ,$sql);
}




else if($action == 'ajout_session')
{
	$date_debut = $_POST['date_debut'];
	$date_fin = $_POST['date_fin'];
	$sql = "INSERT INTO session (date_debut, date_fin) VALUES ('$date_debut', '$date_fin')";
	$query = mysqli_query($con ,$sql);
}

else
{
	echo "erreur";
}

header("Location: /accueil.php");