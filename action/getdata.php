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
  include '../php/error.php';
  
  header('Content-type: application/json');
  if( isset( $_POST['search'] ) )
  {
    require('../php/database.php');

    $name = $_POST['search'];

    require ('../php/inject.php'); //0) ajouter inject et définir redirect
    $redirect = '../allconcerts.php';

    $values = array($name); //1) mettre données dans un arrray
    $inject = inject($values, null); //2) les vérifier
    $validate = validate($inject, $redirect); //3)validation de tous les champs
    if($validate == 0) //4) si pas d'injection : ajout des variables
    {
      $name = mysqli_real_escape_string($con, $name);
    }

    $test = $_POST['this'];

    if($test == 'salle')
    {
      $str = "SELECT Nom_salle FROM salle WHERE Nom_salle LIKE '%{$name}%'";
      $result = mysqli_query($con, $str);
      while($row = mysqli_fetch_array($result))
      {
        $response[] = array("label"=>$row['Nom_salle']);
      }
    }
    else if($test == 'ville')
    {
      $str = "SELECT ville_nom_reel, ville_code_postal FROM ville WHERE ville_nom_reel LIKE '%{$name}%' ORDER BY CHAR_LENGTH(ville_nom_reel) LIMIT 20";
      $result = mysqli_query($con, $str);
      while($row = mysqli_fetch_array($result))
      {
        $response[] = array("label"=>$row['ville_nom_reel'] . " (" . $row['ville_code_postal'] . ")");
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
    else if($test == 'pseudoget')
    {
      $str = "SELECT pseudo FROM utilisateur WHERE pseudo LIKE '%{$name}%'";
      $result = mysqli_query($con, $str);
      while($row = mysqli_fetch_array($result))
      {
        $response[] = array("label"=>$row['pseudo']);
      }
    }
    else
    {
      $str = "SELECT Nom_artiste FROM artiste WHERE Nom_artiste LIKE '%{$name}%'";
      $result = mysqli_query($con, $str);
      while($row = mysqli_fetch_array($result))
      {
        $response[] = array("label"=>$row['Nom_artiste']);
      }
    }
    
    ob_clean();
    if(!$response)
    {
      $response[] = array("label"=>'norep');
    }

    echo json_encode($response); 
  }
?>