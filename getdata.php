<?php
/*
  Type fichier : php
  Fonction : permet d'afficher dans un menu déroulant les éléments
  Emplacement : action
  Connexion à la BDD : oui  
  Contenu HTML : non
  JS+JQuery : non
  CSS : non
*/
?>
<?php
  header('Content-type: application/json');
  if( isset( $_POST['search'] ) )
  {
    $name = $_POST['search'];
    $test = $_POST['this'];
    //echo $test;
    //$name = "kini";
    $servername = 'localhost';
      $username = 'root';
      $password = '';
      $dbname = 'webbd';
      //Connexion à la BDD
      $con = mysqli_connect($servername, $username, $password, $dbname);
      $response = array();
      $n = 0;
      //Vérification de la connexion
      
      if(mysqli_connect_errno($con))
      {
        echo "Erreur de connexion" .mysqli_connect_error();
      }
      if($test == 'salle')
      {
        $str = "SELECT Nom_salle FROM salle WHERE Nom_salle LIKE '%{$name}%'";
        $result = mysqli_query($con, $str);
        while($row = mysqli_fetch_array($result))
        {
          $response[] = array("label"=>$row['Nom_salle']);
        }
      }
      else if($test == 'artiste')
      {
        $str = "SELECT Nom_artiste FROM artiste WHERE Nom_artiste LIKE '%{$name}%'";
        $result = mysqli_query($con, $str);
        while($row = mysqli_fetch_array($result))
        {
          $response[] = array("label"=>$row['Nom_artiste']);
        }
      }
      else if($test == 'ville')
      {
        $str = "SELECT nom_ville FROM ville WHERE nom_ville LIKE '%{$name}%'";
        $result = mysqli_query($con, $str);
        while($row = mysqli_fetch_array($result))
        {
          $response[] = array("label"=>$row['nom_ville']);
        }
      }
      else if($test == 'departement')
      {
        $str = "SELECT nom_departement FROM departement WHERE nom_departement LIKE '%{$name}%'";
        $result = mysqli_query($con, $str);
        while($row = mysqli_fetch_array($result))
        {
          $response[] = array("label"=>$row['nom_departement']);
        }
      }
      else if($test == 'region')
      {
        $str = "SELECT nom_region FROM region WHERE nom_region LIKE '%{$name}%'";
        $result = mysqli_query($con, $str);
        while($row = mysqli_fetch_array($result))
        {
          $response[] = array("label"=>$row['nom_region']);
        }
      }
      else if($test == 'pays')
      {
        $str = "SELECT nom_pays FROM pays WHERE nom_pays LIKE '%{$name}%'";
        $result = mysqli_query($con, $str);
        while($row = mysqli_fetch_array($result))
        {
          $response[] = array("label"=>$row['nom_pays']);
        }
      }
      else
      {
        echo("erreur");
      }

    echo json_encode($response);
    //echo json_encode($t);*/
  }
?>