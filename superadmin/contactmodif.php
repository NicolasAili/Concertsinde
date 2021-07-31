<?php
require('../php/database.php');

$idcheck = $_POST['idcheck'];

$sql = "SELECT type FROM probleme WHERE id = '$idcheck'";
$query = mysqli_query($con ,$sql);
$row = mysqli_fetch_array($result);

switch($row['type'])
{
	case "1":
		//
	break;

	case "2":
		//
	break;

	case "3":
		//
	break;

}

/* A faire:

1) ajouter champ type en BDD X
2) modifier cas report erreur afin mettre champ (1 erreur concert, 2 erreur ,3 contact) X
3) afficher les différents champs en fonction du typed
4) permettre de mettre en résolu 
5) permettre d'envoyer un mail ou un msg au choix
6) aligner champs page précédente */