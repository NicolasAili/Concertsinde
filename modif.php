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
	if(mysqli_connect_errno($con)){
	echo "Erreur de connexion" .mysqli_connect_error();
	}
	else {
	echo 'Connexion réussie';
	}

if (isset($_POST['modif_pseudo']))
{
	$chpseudo = $_POST['chpseudo'];
	$pseudo = $_SESSION['pseudo'];
	$sql = "UPDATE utilisateur SET pseudo = '$chpseudo' WHERE pseudo = '$pseudo'";
	$result = mysqli_query($con ,$sql);
	$_SESSION['pseudo']=$chpseudo;
	header('Location: ./accueil.php');
}
if (isset($_POST['modif_password']))
	$password = $_POST['password'];
	$newpassword = $_POST['newpassword'];
	$cnewpassword = $_POST['cnewpassword'];
	$pass = $_SESSION['password'];

	if ($password == $pass ) 
	{
		if ($newpassword == $cnewpassword)
		{
			$sql = "UPDATE utilisateur SET password = '$newpassword' WHERE password = '$pass'";
			$result = mysqli_query($con ,$sql);
			$_SESSION['password']=$newpassword;
			header('Location: ./accueil.php');

		}
		else 
		{	
			header("Location: ./profil.php?message=Confirmation du mot de passe non valide, réessayer");
		}
	}
	else 
	{ 
		header("Location: ./profil.php?message=Votre mot de passe actuel n'est pas correct");
	}
?>



