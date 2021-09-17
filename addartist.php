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


if(isset($_SESSION['pseudo']) == null)
{
  setcookie('contentMessage', 'Erreur: vous devez être connectés afin de pouvoir modifier un concert', time() + 30, "/");
  header("Location: ./artistes.php");
  exit("Erreur: vous devez être connectés afin de pouvoir modifier un concert");
}

if( isset( $_POST['artisteajout'] ) )
{
  require('php/error.php');
  require('php/database.php');

  //echo $artiste;
  //echo "<br>";
  //echo $description;
  $sql = "SELECT Nom_artiste FROM artiste WHERE Nom_artiste = '$artiste' ";
  $query = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($query);
  if($row['Nom_artiste'])
  {
    setcookie('contentMessage', 'Erreur: cet artiste existe déjà', time() + 30, "/");
    header("Location: ./artistes.php");
    exit("Erreur: cet artiste existe déjà");
  }
  else
  {
    $sql = "INSERT INTO artiste (Nom_artiste, description) VALUES ('$artiste', '$description')";
    $query = mysqli_query($con, $sql);
    setcookie('contentMessage', 'Succès, '. $artiste .' a bien été ajouté(e)', time() + 30, "/");
    header("Location: ./artistes.php");
    exit("Succès, artiste ajouté");
  }
}
else
{
  setcookie('contentMessage', 'Erreur inconnue, merci de signaler cette erreur', time() + 30, "/");
  header("Location: ./artistes.php");
  exit("Erreur inconnue, merci de signaler cette erreur");
}
