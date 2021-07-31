<?php
require('../php/database.php');

$idcheck = $_POST['idcheck'];

$sql = "SELECT type FROM probleme WHERE id = '$idcheck'";
$query = mysqli_query($con ,$sql);
$row = mysqli_fetch_array($result);

switch($row['type'])
{
	case "1":
		//lien vers concert concerné
			//affichage des champs

	break;

	case "2":
		//affichage des champ
	break;

	case "3":
		//affichage DU champ
	break;

}

//afficher user > contact ou mail
// afficher
//résolu / en cours de résolution

/* A faire:

1) ajouter champ type en BDD X
2) modifier cas report erreur afin mettre champ (1 erreur concert, 2 erreur ,3 contact) X
X) Contact > mail si pas connecté
3) afficher les différents champs en fonction du type
4) permettre de mettre en résolu 
5) permettre d'envoyer un mail ou un msg au choix
6) aligner champs page précédente */