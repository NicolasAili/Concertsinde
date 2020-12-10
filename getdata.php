<?php
  if( isset( $_POST['name'] ) )
  {
    $name = $_POST['name'];
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
    
    $data = " SELECT Nom_salle FROM salle WHERE Nom_salle LIKE '$name%' ";
    $query = mysql_query($data);
    while($row = mysql_fetch_array($query))
    {
       echo "<p>".$row['Nom_salle']."</p>";
    }
  }
?>