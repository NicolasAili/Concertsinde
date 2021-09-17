<?php
/*
  Type fichier : php
  Fonction : ajouter une description à un artiste
  Emplacement : action
  Connexion à la BDD : oui  
  Contenu HTML : non
  JS+JQuery : non
  CSS : non
*/
  header('Content-type: application/json');
  if( isset( $_POST['artiste'] ) )
  {
    require('php/database.php');
    
    $artiste = $_POST['artiste']; //variable envoyée grâce à la méthode "post" par notre script JQuery
    $description = $_POST['description'];
    
    $sql = "UPDATE artiste SET description = '$description' WHERE Nom_artiste = '$artiste' ";
    $query = mysqli_query($con, $sql);
    header("Location: supartiste.php?artiste=". $artiste ."");
  }
