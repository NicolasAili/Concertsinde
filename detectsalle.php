<?php
  header('Content-type: application/json');
  if( isset( $_POST['identifiant'] ) )
  {
    $identifiant = $_POST['identifiant']; //variable envoyée grâce à la méthode "post" par notre script JQuery
    $name = $_POST['input'];

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
    if($name)
    {
      switch($identifiant)
      {
        case "salle":
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
                $pvcpz = "SELECT nom_salle, nom_ville, ville_code_postal, nom_departement, nom_region, nom_pays FROM salle, ville, departement, region, pays WHERE salle.id_ville = '$ville_id' AND salle.id_ville = ville.ville_id AND ville.ville_departement = departement.numero AND departement.id_region = region.id AND region.id_pays = pays.id";
                $querypvcpz = mysqli_query($con, $pvcpz);
                $row = mysqli_fetch_array($querypvcpz);
                $response[] = array("test"=>'succes', "adresse"=>$adresse,  "ville"=>$row['nom_ville'], "cp"=>$row['ville_code_postal'], "departement"=>$row['nom_departement'], "region"=>$row['nom_region'], "pays"=>$row['nom_pays']); //on renvoie ces données dans notre var "response"
             }
          }
          else //si cette salle n'existe pas dans notre BDD
          {
             $response[] = array("test"=>'erreur');
          }
        break;
        case "ville":
          $data = "SELECT nom_ville FROM ville WHERE nom_ville = '$name'";
          $query = mysqli_query($con, $data);
          if($row = mysqli_fetch_array($query)) //si ville trouvee
          {
            $numdpt = $row['nom_ville'];
            $ville = "SELECT ville_code_postal, nom_departement, nom_region, nom_pays FROM ville, departement, region, pays WHERE ville.nom_ville = '$numdpt' AND  ville.ville_departement = departement.numero AND departement.id_region = region.id AND region.id_pays = pays.id";
            $query = mysqli_query($con, $ville);
            $row = mysqli_fetch_array($query);
            $response[] = array("test"=>'succes', "cp"=>$row['ville_code_postal'], "departement"=>$row['nom_departement'], "region"=>$row['nom_region'], "pays"=>$row['nom_pays']);
          }
          else //ville non trouvee
          {
            $response[] = array("test"=>'erreur');
          }
        break;
        case "departement":
          $data = "SELECT nom_departement FROM departement WHERE nom_departement = '$name'";
          $query = mysqli_query($con, $data);
          if($row = mysqli_fetch_array($query)) //si departement trouve
          {
            $dpt = $row['nom_departement'];
            $sqldpt = "SELECT nom_region, nom_pays FROM departement, region, pays WHERE departement.nom_departement = '$dpt' AND  departement.id_region = region.id AND region.id_pays = pays.id";
            $query = mysqli_query($con, $sqldpt);
            $row = mysqli_fetch_array($query);
            $response[] = array("test"=>'succes', "region"=>$row['nom_region'], "pays"=>$row['nom_pays']);
          }
          else //ville non trouvee
          {
            $response[] = array("test"=>'erreur');
          }
        break;
        case "region":
          $data = "SELECT nom_region FROM region WHERE nom_region = '$name'";
          $query = mysqli_query($con, $data);
          if($row = mysqli_fetch_array($query)) //si region trouve
          {
            $rgn = $row['nom_region'];
            $sqlrgn = "SELECT nom_pays FROM region, pays WHERE region.nom_region = '$rgn' AND region.id_pays = pays.id";
            $query = mysqli_query($con, $sqlrgn);
            $row = mysqli_fetch_array($query);
            $response[] = array("test"=>'succes', "pays"=>$row['nom_pays']);
          }
          else //ville non trouvee
          {
            $response[] = array("test"=>'erreur');
          }
        break;
        case "pays":
          $data = "SELECT nom_pays FROM pays WHERE nom_pays = '$name'";
          $query = mysqli_query($con, $data);
          if($row = mysqli_fetch_array($query)) //si pays trouve
          {
            $response[] = array("test"=>'succes', "pays"=>$row['nom_pays']);
          }
          else //ville non trouvee
          {
            $response[] = array("test"=>'erreur');
          }
      }
    }
    else
    {
       $response[] = array("test"=>'nodata');
    }
    echo json_encode($response); //on encode en JSON*/
  }
?>