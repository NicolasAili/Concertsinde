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
require ('../php/inject.php');
$redirect = '../artistes.php';

$artiste = $_POST['artisteajout'];
$artiste = inject($artiste, $redirect, null, 'artiste');

$description = $_POST['description'];
$description = inject($description, $redirect, null, 'description');


$artiste = strtolower($artiste);
$artiste = ucfirst($artiste);

if(isset($_SESSION['pseudo']) == null)
{
  setcookie('contentMessage', 'Erreur: vous devez être connectés afin de pouvoir ajouter un artiste', time() + 30, "/");
  header("Location: ../artistes.php");
  exit("Erreur: vous devez être connectés afin de pouvoir ajouter un artiste");
}

if( isset( $_POST['artisteajout'] ) )
{
  //echo $artiste;
  //echo "<br>";
  //echo $description;
  $sql = "SELECT Nom_artiste FROM artiste WHERE Nom_artiste = '$artiste' ";
  $query = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($query);
  if($row['Nom_artiste'])
  {
    setcookie('contentMessage', 'Erreur: cet artiste existe déjà', time() + 30, "/");
    header("Location: ../artistes.php");
    exit("Erreur: cet artiste existe déjà");
  }
  else
  {
    $sql = "INSERT INTO artiste (Nom_artiste, description) VALUES ('$artiste', '$description')";
    $query = mysqli_query($con, $sql);
    setcookie('contentMessage', 'Succès, '. $artiste .' a bien été ajouté(e)', time() + 30, "/");
    header("Location: ../artistes.php");
    exit("Succès, artiste ajouté");
  }
}
else
{
  setcookie('contentMessage', 'Erreur inconnue, merci de signaler cette erreur', time() + 30, "/");
  header("Location: ../artistes.php");
  exit("Erreur inconnue, merci de signaler cette erreur");
}
