<?php
/*
	Type fichier : php
	Fonction : connecte l'utilisateur
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

	if ( isset($_POST['connexion'])) {
		$pseudo = $_POST['pseudo'];
		$password = $_POST['password'];
		$passwordh = hash('sha512', $password);
		$sql = "SELECT pseudo, banni FROM utilisateur WHERE pseudo = '$pseudo' AND password = '$passwordh'";
		$result = mysqli_query($con ,$sql);
		$row = mysqli_fetch_assoc($result);

		//echo $passwordh;

	    if ($row['pseudo'] != null )
    	{
    		if($row['banni'] == 1)
    		{
    			header("Location: ../connexion.php?message=Votre compte a été banni");
    		}
    		else
    		{
				$_SESSION['pseudo'] = $row['pseudo'];
				/*$sql = "SELECT password FROM utilisateur WHERE pseudo = '$pseudo'";
				$result = mysqli_query($con, $sql);
				$row = mysqli_fetch_assoc($result);*/
				$_SESSION['password'] = $passwordh;
				header('Location: ../allconcerts.php');
			}
		}
		else 
		{
			$sql = "SELECT email, banni, pseudo FROM utilisateur WHERE email = '$pseudo' AND password = '$passwordh'";
			$result = mysqli_query($con ,$sql);
			$row = mysqli_fetch_assoc($result);
			if ($row['email'] != null )
    		{
	    		if($row['banni'] == 1)
	    		{
	    			header("Location: ../connexion.php?message=Votre compte a été banni");
	    		}
	    		else
	    		{
					$_SESSION['pseudo'] = $row['pseudo'];
					$_SESSION['password'] = $passwordh;
					header('Location: ../allconcerts.php');
				}
			}
			else
			{
				header("Location: ../connexion.php?message=Pseudo ou Mot de Passe incorrect");
			}
		}
}
?>		

