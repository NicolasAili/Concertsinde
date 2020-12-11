<?php
  header('Content-type: application/json');
  if( isset( $_POST['namesalle'] ) )
  {
    $name = $_POST['namesalle']; //variable envoyée grâce à la méthode "post" par notre script JQuery
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
     
    $response = array(); //var qui contiendra nos données JSON
    $data = "SELECT Nom_salle FROM salle WHERE Nom_salle = '$name'"; //on regarde si la var passée en paramètre existe dans notre BDD
    $query = mysqli_query($con, $data);
    if(mysqli_fetch_array($query)) //si elle existe
    {
       $pvcpa = "SELECT adresse, Pays, Ville, CP, Region FROM salle WHERE Nom_salle = '$name'"; //on récupére les informations liées à cette salle
       $querypvcpa = mysqli_query($con, $pvcpa);
       if($row = mysqli_fetch_array($querypvcpa))
       {
          //echo("<p>" . $row['Pays'] . "</p>");
          $response[] = array("test"=>'succes', "adresse"=>$row['adresse'], "pays"=>$row['Pays'], "ville"=>$row['Ville'], "cp"=>$row['CP'], "region"=>$row['Region']); //on renvoie ces données dans notre var "response"
       }
       
    }
    else //si cette salle n'existe pas dans notre BDD
    {
       $response[] = array("test"=>'erreur');
    }

    echo json_encode($response); //on encode en JSON
  }
?>