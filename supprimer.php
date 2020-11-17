<?php

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'webbd';

    //Connexion à la BDD
    $con = mysqli_connect($servername, $username, $password, $dbname);

    //Vérification de la connexion
    if(mysqli_connect_errno($con)){
    echo "Erreur de connexion" .mysqli_connect_error();
    }
    else {
    echo 'Connexion réussie';
    }

if (isset($_POST['supprimer']))
{
    $artiste = $_POST['artiste'];
    $date = $_POST['date'];
    $heure =$_POST['heure'];
    $sql = "DELETE FROM concert WHERE artiste = '$artiste' AND date = '$date' AND heure = '$heure'"  ;
    $result = mysqli_query($con, $sql);
    header('Location: ./allconcerts.php');
}