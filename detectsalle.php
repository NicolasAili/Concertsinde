<?php
  if( isset( $_POST['namesalle'] ) )
  {
    $name = $_POST['namesalle'];
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
    
    $data = "SELECT Nom_salle FROM salle WHERE Nom_salle = '$name'";
    $query = mysqli_query($con, $data);
    if(mysqli_fetch_array($query))
    {
       echo "<p>"."salle trouvee"."</p>";
    }
    else
    {
       echo "<p>"."aucune salle trouvee"."</p>";
    }
  }
?>