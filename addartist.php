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
  $artiste = $_POST['artisteajout']; //variable envoyée grâce à la méthode "post" par notre script JQuery
  $description = $_POST['description'];
  $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'webbd';
    //Connexion à la BDD
    $con = mysqli_connect($servername, $username, $password, $dbname);
    //Vérification de la connexion
     
    if(mysqli_connect_errno($con))
    {
      echo "Erreur de connexion" .mysqli_connect_error();
    }

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
