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
		<script type="text/javascript" src="../jquery/jquery.min.js"></script>
		<script type="text/javascript" src="../jquery/jquery-ui.min.js"></script>
		<script type="text/javascript" src="../js/scriptform.js"></script> 
		<link rel="stylesheet" type="text/css" href="../jquery/jquery-ui.css" media="screen" />		
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
		{
			$sql = "SELECT id, date_debut, date_fin, actif FROM session ORDER BY id DESC";
			$query = mysqli_query($con, $sql);
			?>

			<h2> Ajouter une session </h2>
			<br>
			<form method="post" id="connect" action="sessionmodif.php">
				<input type="date" name="date_debut" placeholder="Saisir debut session " id="date_debut" required>
				<input type="date" name="date_fin" placeholder="Saisir fin session " id="date_fin" required>
				<input type="submit" value="ajout_session" class="ajout_session" name="modsuppr" href="">
			</form>
			<br>
			<br>
			<br>
			<table>
	    		<caption>Utilisateurs</caption>
	    		<tr>
	    		<th scope="col">Num</th>
		        <th scope="col">Du</th>
		        <th scope="col">Au</th>
		        <th scope="col">Actif</th>
   				</tr><?php
   				while($row = mysqli_fetch_array($query))
				{
					?>
					<form method="post" id="connect" action="sessionmodif.php">
						<tr>
					        <th scope="row"><?php echo $row['id']; ?></th>
					        <td><?php echo  $row['date_debut']; ?> </td>
					        <td><?php echo  $row['date_fin']; ?> </td>
					        <td><input type="checkbox" class="actif" name="actif" <?php if($row['actif'] == 1){echo "checked "; echo "disabled";} else{echo "required";} ?> > </td>
					        <input type="hidden" class="idcheck" name="idcheck" <?php echo 'value="' . $row['id'] . '"' ?> >
					        <?php if($row['actif'] == 0){?><td><input type="submit" value="valider" class="valider" name="modsuppr" href=""></td><?php } ?>
		    			</tr>
		    		</form>
	    		<?php
				}
				?>
			</table><?php
		}
		else
		{
			echo "accès non autorisé";
		}
		?>
	</body>
</html>
