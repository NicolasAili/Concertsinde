<?php 
/*
	Type fichier : php
	Fonction : actualités du site
	Emplacement : /
	Connexion à la BDD :  oui
	Contenu HTML : oui
	JS+JQuery : non
	CSS : oui

*/
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php
			include 'php/error.php';
			require 'php/connectcookie.php';
			include 'php/base.php';
			include 'php/css.php';
			include 'php/js.php';
			require 'php/database.php';
			include 'contenu/reseaux.php';

			$currentdate = date('Y-m-d');
			$currentdate = new DateTime($currentdate);
		?>
		<link rel="stylesheet" type="text/css" href="css/body/news.css">

		
	</head>
	<body>	
		<header>
			<?php include('contenu/header.php'); ?>
		</header>
		<div id="main">
			<div id="top">
				<div class="bandeauun">
					<div class="contenub">
						<h1> Actus du site </h1>
					</div>
				</div>
				<div class="bandeaudeux">
					<div class="contenub">
						<h1> Actus de la scène indé </h1>
					</div>
				</div>
			</div>
			
			<div id="site">
				<?php 
				$sql = "SELECT * FROM actualites WHERE type = 'site' ORDER BY date DESC";
				$query = mysqli_query($con, $sql);
				while ($row = mysqli_fetch_array($query))
				{
					

					$filename = glob("image/actualites/news" . $row['id'] . "*");
					$date = $row['date'];
					$date = new DateTime($date);
					
					$intvl = $currentdate->diff($date);

					/*echo $intvl->y . " year, " . $intvl->m." months and ".$intvl->d." day"; 
					echo "\n";
					// Total amount of days
					echo $intvl->days . " days ";*/
					if ($intvl->m == 0 && $intvl->y == 0) {
						if ($intvl->d == 1) {
							$displaytime = "Il y a " . $intvl->d . " jour";
						}
						else
						{
							$displaytime = "Il y a " . $intvl->d . " jours";
						}
					}
					else if ($intvl->m > 0 && $intvl->y == 0) {
						if ($intvl->m == 1) {
							$displaytime = "Le mois dernier";
						}
						else
						{
							$displaytime = "Il y a " . $intvl->m . " mois";
						}
					}
					else if ($intvl->y > 0) {
						if ($intvl->y == 1) {
							$displaytime = "Il y a " . $intvl->y . " an";
						}
						else
						{
							$displaytime = "Il y a " . $intvl->y . " ans";
						}
					}

					?>
					<div class="content">
						<a <?php echo 'href="newscontent.php?newsid=' . $row['id'] . '"'; ?>>
							<img class="img" <?php echo 'src="' . $filename[0] . '"' ?>>
							<div class="rubrique"><?php echo $row['rubrique'];?></div>
							<h2><?php echo $row['titre'];?></h2>
							<div class="date"><?php echo $displaytime; ?></div>
						</a>
					</div><?php
				}?>
			</div>
			<div id="scene">
				<?php 
				$sql = "SELECT * FROM actualites WHERE type = 'scene' ORDER BY date DESC";
				$query = mysqli_query($con, $sql);
				while ($row = mysqli_fetch_array($query))
				{
					$filename = glob("image/actualites/news" . $row['id'] . "*");
					$date = $row['date'];
					$date = new DateTime($date);
					
					$intvl = $currentdate->diff($date);

					/*echo $intvl->y . " year, " . $intvl->m." months and ".$intvl->d." day"; 
					echo "\n";
					// Total amount of days
					echo $intvl->days . " days ";*/
					if ($intvl->m == 0 && $intvl->y == 0) {
						if ($intvl->d == 1) {
							$displaytime = "Il y a " . $intvl->d . " jour";
						}
						$displaytime = "Il y a " . $intvl->d . " jours";
					}
					else if ($intvl->m > 0 && $intvl->y == 0) {
						if ($intvl->m == 1) {
							$displaytime = "Le mois dernier";
						}
						$displaytime = "Il y a " . $intvl->m . " mois";
					}
					else if ($intvl->y > 0) {
						if ($intvl->y == 1) {
							$displaytime = "Il y a " . $intvl->y . " an";
						}
						$displaytime = "Il y a " . $intvl->y . " ans";
					}

					?>
					<div class="content">
						<a <?php echo 'href="newscontent.php?newsid=' . $row['id'] . '"'; ?>>
							<img class="img" <?php echo 'src="' . $filename[0] . '"' ?>>
							<div class="rubrique"><?php echo $row['rubrique'];?></div>
							<h2><?php echo $row['titre'];?></h2>
							<div class="date"><?php echo $displaytime; ?></div>
						</a>
					</div><?php
				}?>
			</div>
		</div>
		<?php include('contenu/scrolltop.html'); ?>
		<?php include('contenu/footer.html'); ?>
	</body>
</html>

<script>
	$( document ).ready(function() {
		imgwidth = $( '.img' ).width();
		newheight = (imgwidth*9)/16;
		$( '.img' ).css('height', newheight);
	});
	$( window ).resize(function() {
		imgwidth = $( '.img' ).width();
		newheight = (imgwidth*9)/16;
		$( '.img' ).css('height', newheight);
	});

	$(".bandeauun").click(function(){
		if($('#site').css('visibility') == 'hidden') //c'est la scène qui est affichée
		{
			$('#scene').css('visibility', 'hidden');
			$('#scene').css('display', 'none');
			$('#site').css('visibility', 'visible'); //on affiche le site
			$('#site').css('display', 'flex');

			$('.bandeauun').css('background-color', '#3a0101');
			$('.bandeauun').css('color', 'white');

			$('.bandeaudeux').css('background-color', 'white');
			$('.bandeaudeux').css('color', 'black');

			$('.bandeaudeux').css('cursor', 'pointer');

			$('.bandeaudeux').toggleClass('statutbdeux');
			$('.bandeauun').toggleClass('statutbun');
		}
   		
    });


    $(".bandeaudeux").click(function(){

		if($('#scene').css('visibility') == 'hidden')
		{
			$('#site').css('visibility', 'hidden');
			$('#site').css('display', 'none');
			$('#scene').css('visibility', 'visible');
			$('#scene').css('display', 'flex');

			$('.bandeaudeux').css('background-color', '#3a0101');
			$('.bandeaudeux').css('color', 'white');

			$('.bandeauun').css('background-color', 'white');
			$('.bandeauun').css('color', 'black');

			$('.bandeauun').css('cursor', 'pointer');

			$('.bandeaudeux').toggleClass('statutbdeux');
			$('.bandeauun').toggleClass('statutbun');
		}
    });
/*#bandeaudeux:hover
{
	background-color: #3a0101;
	color: white;
}

#bandeaudeux:hover::after
{
	content: '';
    position: absolute;
    bottom: 0; right: 0;
    border-bottom: 35px solid #DBCDC6;;
    border-left: 35px solid #3a0101;
    width: 0;
}*/
   
</script>