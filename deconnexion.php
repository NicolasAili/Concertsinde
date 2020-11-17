<?php
    session_start();
 ?>
<?php      
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
	else 
	{
		echo 'Connexion réussie';
	}
?>
<?php
    unset($_SESSION['pseudo']);
    header('Location: ./accueil.php');
?>