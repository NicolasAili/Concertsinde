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
       $pvcpa = "SELECT * FROM salle WHERE Nom_salle = '$name'"; //on récupére les informations liées à cette salle
       $querypvcpa = mysqli_query($con, $pvcpa);
       if($row = mysqli_fetch_array($querypvcpa))
       {
          $pvcpz = "SELECT nom_ville, ville_departement FROM ville WHERE ville_id = '$row['id_ville']' ";
          $querypvcpz = mysqli_query($con, $pvcpz);
          if($rowa = mysqli_fetch_array($querypvcpz))
          {
            $ville = $rowa['nom_ville'];

            $pvcpe = "SELECT nom_departement, id_region FROM departement WHERE numero = '$row['ville_departement']' ";
            $querypvcpe = mysqli_query($con, $pvcpe);
            $rowz = mysqli_fetch_array($querypvcpe);

            $pvcpr = "SELECT nom_region, id_pays FROM region WHERE id = '$row['id_region']' ";
            $querypvcpr = mysqli_query($con, $pvcpr);
            $rowe = mysqli_fetch_array($querypvcpr);

            $pvcpt = "SELECT nom_pays FROM pays WHERE id = '$row['id_pays']' ";
            $querypvcpt = mysqli_query($con, $pvcpt);
            $rowr = mysqli_fetch_array($querypvcpt);
          }
          
          //echo("<p>" . $row['Pays'] . "</p>");
          $response[] = array("test"=>'succes', "adresse"=>$row['adresse']); //on renvoie ces données dans notre var "response"
       }
       
    }
    else //si cette salle n'existe pas dans notre BDD
    {
       $response[] = array("test"=>'erreur');
    }
    //$response[] = array("test"=>'succes');
    //echo json_encode($response); //on encode en JSON
    echo json_encode($response); //on encode en JSON
  }
?>