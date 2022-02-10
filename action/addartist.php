<?php
/*
  Type fichier : php
  Fonction : ajouter un artiste
  Emplacement : action
  Connexion à la BDD : oui  
  Contenu HTML : non
  JS+JQuery : non
  CSS : non
*/
session_start();
require('../php/database.php');

require ('../php/inject.php'); //0) ajouter inject et définir redirect
$redirect = '../artistes.php';

$artiste = $_POST['artisteajout'];
$description = $_POST['description'];


$values = array($artiste); //1) mettre données dans un arrray
$inject = inject($values, null); //2) les vérifier

$returnval = inject($description, 'text'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
if (!is_null($returnval)) 
{
  array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
}

$validate = validate($inject, $redirect); //3)validation de tous les champs
if($validate == 0) //4) si pas d'injection : ajout des variables
{
  $artiste = mysqli_real_escape_string($con, $artiste); 
  $description = mysqli_real_escape_string($con, $description);
}

$artiste = strtolower($artiste);
$artiste = ucfirst($artiste);

if(isset($_SESSION['pseudo']) == null)
{
  setcookie('contentMessage', 'Erreur: vous devez être connectés afin de pouvoir ajouter un artiste', time() + 15, "/");
  header("Location: ../artistes.php");
  exit("Erreur: vous devez être connectés afin de pouvoir ajouter un artiste");
}

if( isset( $_POST['artisteajout'] ) )
{
  $sql = "SELECT Nom_artiste FROM artiste WHERE Nom_artiste = '$artiste' ";
  $query = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($query);
  if($row['Nom_artiste'])
  {
    setcookie('contentMessage', 'Erreur: cet artiste existe déjà', time() + 15, "/");
    header("Location: ../artistes.php");
    exit("Erreur: cet artiste existe déjà");
  }
  else
  {
    $sql = "INSERT INTO artiste (Nom_artiste, description) VALUES ('$artiste', '$description')";
    $query = mysqli_query($con, $sql);
    setcookie('contentMessage', 'Succès, '. $artiste .' a bien été ajouté(e)', time() + 15, "/");
    header("Location: ../artistes.php");
    exit("Succès, artiste ajouté");
  }
}
else
{
  setcookie('contentMessage', 'Erreur inconnue, merci de signaler cette erreur', time() + 15, "/");
  header("Location: ../artistes.php");
  exit("Erreur inconnue, merci de signaler cette erreur");
}
