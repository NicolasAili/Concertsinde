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
          $adresse = $row['adresse']; //adresse de la salle
          $ville_id = $row['id_ville']; //cle etrangere ville_id permettant de faire le lien avec la ville où se situe la salle
          $pvcpz = "SELECT nom_salle, nom_ville, ville_code_postal, nom_departement, nom_region, nom_pays FROM salle, ville, departement, region, pays WHERE salle.id_ville = '$ville_id' AND salle.id_salle = ville.ville_id AND ville.ville_departement = departement.numero AND departement.id_region = region.id AND region.id_pays = pays.id";
          $querypvcpz = mysqli_query($con, $pvcpz);
          $row = mysqli_fetch_array($querypvcpz);
          $response[] = array("test"=>'succes', "adresse"=>$adresse, "ville"=>$row['nom_ville'], "cp"=>$row['ville_code_postal'], "departement"=>$row['nom_departement'], "region"=>$row['nom_region'], "pays"=>$row['nom_pays']); //on renvoie ces données dans notre var "response"
       }
    }
    else //si cette salle n'existe pas dans notre BDD
    {
       $response[] = array("test"=>'erreur');
    }
    echo json_encode($response); //on encode en JSON
  }
?>