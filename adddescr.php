<?php
  header('Content-type: application/json');
  if( isset( $_POST['artiste'] ) )
  {
    $artiste = $_POST['artiste']; //variable envoyée grâce à la méthode "post" par notre script JQuery
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

    $sql = "UPDATE artiste SET description = '$description' WHERE Nom_artiste = '$artiste' ";
    $query = mysqli_query($con, $sql);
    header("Location: supartiste.php?artiste='$artiste'");
  }
