<?php
/*
	Type fichier : 
	Fonction : 
	Emplacement : 
	Connexion à la BDD :  
	Contenu HTML : 
	JS+JQuery : 
	CSS : 
*/
?>
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
    			header("Location: ./connexion.php?message=Votre compte a été banni");
    		}
    		else
    		{
				echo " Bonjour ";		
				echo $row['pseudo'];
				echo " ! ";
				$admin = 'administrateur';
				$_SESSION['pseudo'] = $row['pseudo'];
				$sql = "SELECT password FROM utilisateur WHERE pseudo = '$pseudo'";
				$result = mysqli_query($con, $sql);
				$row = mysqli_fetch_assoc($result);
				$_SESSION['password'] = $row['password'];
				header('Location: ./accueil.php');
			}
		}
	else 
		{		
    		header("Location: ./connexion.php?message=Pseudo ou Mot de Passe incorrect");
		}
}
?>		

