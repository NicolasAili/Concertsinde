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

		$count = 0;
		if($row['admin'] == 2)
		{
			$pseudoget = $_GET['pseudoget'];
			?>
			<form action="users.php" method="get">
			  <label for="pseudoget">Utilisateur:</label>
			  <input type="text" id="pseudoget" name="pseudoget" onkeyup="getdata(this.id);" required><br><br>
			  <input type="submit">
			</form>
			<?php
			if(!$pseudoget)
			{
				$sql = "SELECT pseudo, email, date_inscription, points, points_session, admin, banni FROM utilisateur";
			}
			else
			{
				$sql = "SELECT pseudo, email, date_inscription, points, points_session, admin, banni FROM utilisateur WHERE pseudo = '$pseudoget'";
			}
			
			$query = mysqli_query($con, $sql);

			?>
			<table>
	    		<caption>Utilisateurs</caption>
	    		<tr>
		        <th scope="col">pseudo</th>
		        <th scope="col">mail</th>
		        <th scope="col">date_inscription</th>
		        <th scope="col">points</th>
		        <th scope="col">points_session</th>
		        <th scope="col">admin</th>
		        <th scope="col">banni</th>
   				</tr>
   				<?php
				while($row = mysqli_fetch_array($query))
				{?>
					<form method="post" id="connect" action="usermodif.php">
						<tr>
				        <th scope="row"><?php echo $row['pseudo']; ?></th>
				        <th scope="row"><?php echo $row['email']; ?></th>
				        <th scope="row"><?php echo $row['date_inscription']; ?></th>
				        <td><input type="text" name="points" <?php echo 'value="' . $row['points'] . '"' ?> id="points"></td>
				        <td><input type="text" name="points_session" <?php echo 'value="' . $row['points_session'] . '"' ?> id="points_session"></td>
				        <td><input type="checkbox" class="admin" name="admin" <?php if($row['admin'] == 1){echo "checked";} ?>> </td>
				        <td><input type="checkbox" class="banni" name="banni" <?php if($row['banni'] == 1){echo "checked";} ?>> </td>
				        <input type="hidden" class="pseudo" name="pseudo" <?php echo 'value="' . $row['pseudo'] . '"' ?> >
				        <input type="hidden" class="admincheck" name="admincheck" <?php echo 'value="' . $row['admin'] . '"' ?> >
				        <input type="hidden" class="bannicheck" name="bannicheck" <?php echo 'value="' . $row['banni'] . '"' ?> >
				        <td><input type="submit" value="Valider" class="valider" name="modsuppr" href=""></td>
				        <td><input class="message" type="submit" name="modsuppr" value="Message"></td>
		    			</tr>
		    		</form>
	    		<?php
				}
				?>
			</table>
		<?php	
		}
		else
		{
			echo "accès non autorisé";
		}
		?>
	</body>
</html>

<script type="text/javascript">
	$(".admin").on("click", function() 
	{
		var par = $(this).closest("tr").index();
		par = par/2;
		par = par-1;
		if($('.admincheck').eq(par).val() != 2)
		{
			if($('.admin').eq(par).is(':checked'))
			{
			    $('.admincheck').eq(par).val("1");
			}
			else
			{
			    $('.admincheck').eq(par).val("0");
			}
		}
		else
		{
			alert("superadmin, fais gaffe mon pote");
		}
	});


	$(".banni").on("click", function() 
	{
		var par = $(this).closest("tr").index();
		par = par/2;
		par = par-1;
		if($('.banni').eq(par).is(':checked'))
		{
		    $('.bannicheck').eq(par).val("1");
		}
		else
		{
		    $('.bannicheck').eq(par).val("0");
		}
	});
</script>

	

