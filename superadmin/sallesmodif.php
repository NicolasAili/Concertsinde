<?php
/*
	Type fichier : php
	Fonction : modifier salle
	Emplacement : superadmin
	Connexion à la BDD : oui
	Contenu HTML : oui
	JS+JQuery : non
	CSS : non
*/
include '../php/error.php';
require '../php/connectcookie.php';
require '../php/database.php';
session_start();
$nomsalle = $_POST['nomsalle'];
$nomext = $_POST['nomext'];
$adresse = $_POST['adresse'];
$idsalle = $_POST['idsalle'];

$nomsalle = mysqli_real_escape_string($con, $nomsalle);
$nomext = mysqli_real_escape_string($con, $nomext);
$adresse = mysqli_real_escape_string($con, $adresse);

$sql = "UPDATE salle SET nom_salle = '$nomsalle', nom_ext = '$nomext', adresse = '$adresse' WHERE id_salle = '$idsalle' ";
$query = mysqli_query($con ,$sql);
echo "action effectuée avec succès";
echo "<br>";
echo "<a href=salles.php> retour </a>";

