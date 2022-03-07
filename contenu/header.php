<?php
/*
	Type fichier : php
	Fonction : affiche le header
	Emplacement : contenu
	Connexion à la BDD : oui 
	Contenu HTML : oui
	JS+JQuery : non
	CSS : oui
*/
?>
<?php
include 'php/js.php';
	
$pseudo = $_SESSION['pseudo'];
$sql = "SELECT admin, id_user FROM utilisateur WHERE pseudo = '$pseudo'";
$result = mysqli_query($con ,$sql);
$row = mysqli_fetch_array($result);
$pseudoid = $row['id_user'];
$admin = $row['admin'];
?>

<link rel="stylesheet" type="text/css" href="css/header.css">
<div id="recherche">
	<div id="nav">
		<?php 
		if($admin == 2)
		{?>
			<h1> <a href="superadmin/saccueil.php" id="logo"> Arpenid <span id="com">.com</span></a> </h1><?php
		}
		else
		{?>
			<h1> <a href="index.php" id="logo"> Arpenid <span id="com">.com</span></a> </h1><?php
		}?>
			
		<a href="presentation.php" class="li fonctionnementup"><span class="txtli fonctionnement">Fonctionnement</span></a>
		<a href="news.php" class="li actualitesup"><span class="txtli actualites">Actualités</span></a>
		<a href="artistes.php" class="li artistesup"><span class="txtli artistes">Artistes</span></a>
		<a href="allconcerts.php" class="li concertsup"><span class="txtli concerts">Concerts</span></a>
		<a href="classement.php" class="li classementup"><span class="txtli classement">Classement</span></a>
	</div>
	<div id="side">
		<div class="ajoutconcert">
			<a href="./ajoutconcert.php" class="button" role="button">Ajouter un concert</a>
		</div>
		<div id="sidetwo">
			<div id="loupe">
				<img src="./image/loupe.png" id="loupeimg"  width= "20" onclick="recherche();" alt="recherche">
			</div>
			<?php
			$count = 0;
			if ($admin == 2) 
			{
				$sql = "SELECT message.id FROM message, topic WHERE lu = 0 AND sender = '$pseudoid' AND message.id_topic = topic.id";
			}
			else
			{
				$sql = "SELECT message.id FROM message, topic WHERE utilisateur != '$pseudoid' AND lu = 0 AND receiver = '$pseudoid' AND message.id_topic = topic.id";
			}
			$querymsg = mysqli_query($con, $sql);
			while ($rowmsg = mysqli_fetch_array($querymsg)) 
			{
				$count++;
			}						
			if (isset($_SESSION['pseudo']) == null)
			{
				?>
				<div class="barre"></div>
				<div class="space">							
					<a href="./connexion.php" class="spacelink" role="button"><img src="./image/cadenas.png" class="imgcadenas" alt="connexion"> <div id="txtspace">Connexion</div></a>
				</div>
				<?php
			}
			else 
			{
				?>
				<div class="barre"></div>
				<div class="space">							
					<a class="spacelinkco" role="button"><img src="./image/cadenasopen.png" class="imgcadenas" alt="profil"> <div id="txtspace">Profil</div></a>
					<?php
					switch ($count) 
					{
						case '0':
							# rien à faire
							break;
						case '1':
							?> <img src="./image/notifun.png" id="notifun" alt="notification"> <?php
							break;
						case '2':
							?> <img src="./image/notifdeux.png" id="notifun" alt="notification"> <?php
							break;					
						default:
							?> <img src="./image/notiftrois.png" id="notifun" alt="notification"> <?php
							break;
					}?>
				</div>
				<div id="dropdown">
					<a href="./profil.php" class="fonction"> ♟ Profil </a>
					<a href="./inbox.php" class="fonction"> ✉ Messages <span id="msgcount"><?php if($count == 1){echo "➊";}else if($count == 2){echo "➋";}else if($count>2){echo "➋+";}?></span>
					</a>
					<a href="./support.php" class="fonction"> <span id="req">?</span>Requêtes </a>
					<a href="./resetpassword.php" class="fonction"> ⚒ Paramètres </a>
					<a href="./action/deconnexion.php" class="fonction" onmouseover="off()" onmouseleave="offleave()"> 
						<img src="image/off.png" alt="deconnexion" id="off" height="10" width="11">Déconnexion 
					</a>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
<div id="bar">
	<img src="image/loupe.png" id="loupebar" alt="loupe">
	<form class="searchbar" action="searchresult.php" method="post">
		<input class="champ"  type="search" name="searchfield" placeholder="Artiste/Salle/Festival/Ville/CP/Departement/Num departement/Région">
		<input class="o-search-submit" name="search" type="submit" value="OK">
	</form>
	<div>
		<img src="image/close.png" id="closebar" onclick="fermer();" alt="fermer">
	</div>
</div>

<script>
	function handler( event ) {
	  var target = $( event.target );
	  value = $("#dropdown").css("display");
	  if ( target.is( "#txtspace" ) || target.is( ".spacelinkco" ) || target.is( ".imgcadenas" )) 
	  {
	  	height = $('#recherche').height();
	  	if(value == "none")
		{
		    $('#dropdown').css('visibility', 'visible');
		    $('#dropdown').css('display', 'block');
		    $('#dropdown').css('width', '225px');
		    $('#dropdown').css('position', 'absolute');
		    $('#dropdown').css('right', '0');
		    $('#dropdown').css('top', '' + height + 'px');
		    $('#dropdown').css('right', '0');
		}
		else if(value == "block")
		{
			$('#dropdown').css('visibility', 'hidden');
			$('#dropdown').css('display', 'none');
		}
	  }
	  else
	  {
		if(value == "block")
		{
			$('#dropdown').css('visibility', 'hidden');
			$('#dropdown').css('display', 'none');
		}
	  }
	}
	$( "*" ).click( handler );
</script>
<script>
	$( document ).ready(function() 
	{
		var position = $('#txtspace').position();
		$('#notifun').css('left', position.left+25 + "px");
		$('#notifun').css('top', position.top-7 + "px");
	});
</script>
