<?php
/*
	Type fichier : php
	Fonction : gestion des news
	Emplacement : supermadmin
	Connexion à la BDD :  oui
	Contenu HTML : oui
	JS+JQuery : non
	CSS : non
*/
    session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Gestion des artistes</title>
		<meta charset="utf-8">
		<!--<script type="text/javascript" src="./jquery/jquery.min.js"></script>
		<script type="text/javascript" src="./jquery/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="./jquery/jquery-ui.css" media="screen" />-->		
		<meta name="Author" content="BUSQUET_TOURNU" />
		<meta name="Keywords" content="ConcertAll" />
		<meta name="Description" content="Recap" />
		<style>
			#file 
			{
			  display: flex;
			  justify-content: space-around;
			}
			#deletediv, #formsearch
			{
				display: flex;
			}
		</style>
		<?php
			echo "<script type='text/javascript' src='../jquery/jquery.min.js'></script>";
			echo "<script type='text/javascript' src='../jquery/jquery-ui-1.13.0/jquery-ui.min.js'></script>";
			echo "<link rel='stylesheet' type='text/css' href='../jquery/jquery-ui-1.13.0/jquery-ui.css'>";
		?>
	</head>
	<body>
		<?php
		require('../php/database.php');
		include '../php/error.php';
		$pseudo = $_SESSION['pseudo'];
		$sql = "SELECT admin FROM utilisateur WHERE pseudo = '$pseudo'";
		$result = mysqli_query($con ,$sql);
		$row = mysqli_fetch_array($result);

		if($row['admin'] == 2)
		{
			$artiste = $_GET['artiste'];
			?>

			<a href='saccueil.php'>retour accueil</a>
			<form action="ajoutimage.php" method="get" id="formsearch">
			  <label for="artiste">Chercher un artiste:</label>
			  <input type="text" id="artiste" name="artiste" onkeyup="getdata(this.id);" required><br><br>
			  <input type="submit">
			</form>
			<div id="file">
				<div id="modifartiste">
					<h1>Gestion d'artiste </h1>
					<?php 
					if(!$artiste)
					{
						$sql = "SELECT * FROM artiste";
					}
					else
					{
						$sql = "SELECT * FROM artiste WHERE Nom_artiste = '$artiste'";
					}
					$result = mysqli_query($con ,$sql);
					while ($row = mysqli_fetch_array($result)) 
					{
						$artistecnt = $row['Nom_artiste'];
						$filename = '../image/artiste/' . $artistecnt . '.jpg';
						if (file_exists($filename)) 
						{
		    				echo '<img src="../image/artiste/' . $row['Nom_artiste'] . '.jpg' . '" class="imgartiste" width="60px" height="80px">';
						} 
						else 
						{
							$filename = '../image/artiste/' . $artistecnt . '.png';
							if (file_exists($filename)) 
							{
								echo '<img src="../image/artiste/' . $row['Nom_artiste'] . '.png' . '" class="imgartiste" width="60px" height="80px">';
							}
							else
							{
								echo '<img src="../image/artiste/inconnu.png" class="imgartiste" width="60px" height="80px">';
							}
		    				
						}
						?>
						<form enctype="multipart/form-data" method="POST" class="ajoutimagephp" action="ajoutimagephp.php">
							<h3> Nom artiste</h3>
							<input type="text" name="nomartiste" <?php echo 'value="' . $row['Nom_artiste'] . '"'; ?>>
							<h3> Description artiste</h3>
							<textarea cols="40" rows="5" name="description" id="description"><?php echo $row['description']; ?></textarea>
							<h3> Ajout d'image</h3>
							<input name="userfile" type="file" />
							<div id="deletediv">
								<h3> Supprimer artiste</h3>
								<input type="checkbox" id="delete" name="delete" value="Suppression">
							</div>
							<input type="hidden" name="idconcert" <?php echo 'value="' . $row['Nom_artiste'] . '"'; ?>>
							<br>
							<input type="submit" name="submit" value="Modifier">
							<hr>
						</form><?php
					}?>
				</div>
				<div id="addartiste">
					<h1> Ajouter un artiste </h1>
					<form enctype="multipart/form-data" method="POST" class="ajoutimagephp" action="ajoutimagephp.php">
						<h3> Nom artiste</h3>
						<input type="text" name="nomartiste">
						<h3> Description artiste</h3>
						<textarea cols="40" rows="5" name="description" id="description"></textarea>
						<h3> Ajout d'image</h3>
						<input name="userfile" type="file" />
						<br>
						<br>
						<input type="submit" name="submit" value="Ajouter">
					</form>
				</div>
				<div id="addflag">
					<h1> Ajouter un drapeau </h1>
					<form enctype="multipart/form-data" method="POST" class="ajoutimagephp" action="ajoutimagephp.php">
						<h3> Nom du pays </h3>
						<input type="text" name="pays">
						<h3> Image drapeau </h3>
						<input name="userfile" type="file" />
						<br>
						<br>
						<input type="submit" name="submit" value="ajoutdrapeau">
					</form>
				</div>
			</div>
			<?php
		}?>
	</body>
</html>

<script type="text/javascript">
function getdata(identifiant)
{
	$( '#'+identifiant+'' ).autocomplete({
		source: function( request, response ) {
			$.ajax({
				url: "../action/getdata.php",
				type: 'post',
				dataType: "json",
				data: {
						search: request.term,
						this: identifiant
				  },
				success: function( data ) 
				{
					response( data );
                    if(data.length == 1 && data[0].label == request.term)
                    {
                        console.log("ok");
                        $( '#'+identifiant+'' ).autocomplete( "close" );
                        getleave(identifiant);
                    }
				}
			});
		},
		select: function (event, ui) {
			// Set selection
			$( this ).val(ui.item.label); // display the selected text in the field
			return false;
		}
	});
}   
</script>