<?php
    session_start();
    ini_set('display_errors', 0);
	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Tous les concerts</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />	
		<link rel="stylesheet" type="text/css" href="css/body/allconcerts.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/footer.css" media="screen" />	
		<script type="text/javascript" src="./jquery/jquery.min.js"></script>
		<script type="text/javascript" src="./jquery/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="./jquery/jquery-ui.css" media="screen" />		
		<meta name="Author" content="BUSQUET_TOURNU" />
		<meta name="Keywords" content="ConcertAll" />
		<meta name="Description" content="Recap" />
	</head>
	<body>
		<?php
		require('../php/database.php');
		$pseudo = $_SESSION['pseudo'];
		$sql = "SELECT admin FROM utilisateur WHERE pseudo = '$pseudo'";
		$result = mysqli_query($con ,$sql);
		$row = mysqli_fetch_array($result);
		if($row['admin'] == 2)
		{?> 
			<a href="users.php"> Gestion des utilisateurs </a> <br>
			<a href="accueil.php"> Gestion de la page accueil </a> <br>
			<a href="sessions.php"> Gestion des sessions </a> <br>
			<a href="contact.php"> Gestion des erreurs </a> <br>
			<a href="../accueil.php"> Quitter </a> <br>
		<?php
		}
		else
		{
			echo "accès non autorisé";
		}
		?>



	</body>
</html>