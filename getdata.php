<?php
  header('Content-type: application/json');
  if( isset( $_POST['search'] ) )
  {
    $name = $_POST['search'];
    //echo $name;
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
      //echo("succes0");
    $str = "SELECT Nom_salle FROM salle WHERE Nom_salle LIKE '%{$name}%'";
    $result = mysqli_query($con, $str);
    while($row = mysqli_fetch_array($result))
    {
      //echo("succes");
       //$t["Var{$n}"] = $row['Nom_salle'];
       //$t["Var"] = $row['Nom_salle'];
      //echo json_encode($t);
      $response[] = array("label"=>$row['Nom_salle']);
    }
    echo json_encode($response);
    //echo json_encode($t);
  }
?>