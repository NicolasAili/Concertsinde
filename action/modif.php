<?php
/*
	Type fichier : php
	Fonction : modifier son mot de passe
	Emplacement : action
	Connexion à la BDD : oui  
	Contenu HTML : non
	JS+JQuery : non
	CSS : non
*/
?>
<?php
    session_start();
?>
<?php
		      
	require('../php/database.php');

if (isset($_POST['modif_password']))
	$password = $_POST['password'];
	$newpassword = $_POST['newpassword'];
	$cnewpassword = $_POST['cnewpassword'];
	$pass = $_SESSION['password'];
	$user = $_SESSION['pseudo']

	$passwordh = hash('sha512', $newpassword);

	if ($password == $pass ) 
	{
		if ($newpassword == $cnewpassword)
		{
			$sql = "UPDATE utilisateur SET password = '$passwordh' WHERE pseudo = '$user'";
			$result = mysqli_query($con ,$sql);
			$_SESSION['password']=$newpassword;
			header('Location: ../accueil.php');
		}
		else 
		{	
			header("Location: ../profil.php?message=Confirmation du mot de passe non valide, réessayer");
		}
	}
	else 
	{ 
		header("Location: ../profil.php?message=Votre mot de passe actuel n'est pas correct");
	}
?>


