<?php
/*
	Type fichier : php
	Fonction : Permet de contacter l'admin du site
	Emplacement : /
	Connexion à la BDD : non
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
		?>
		<link rel="stylesheet" type="text/css" href="css/body/contact.css">
	</head>	
	<body>
		<header>
			<?php include('contenu/header.php'); ?>
		</header>
		<?php include 'contenu/reseaux.php'; ?>
		<div id="main">
			<h1> Contactez nous ! </h1>
			<form action="action/erreursubmit.php" method="post">
				<div id="raison">
					<label> Motif du contact <span class="star">*</span> </label>
					<br>
					<span><input type="checkbox" id="problemecheck" onclick="motif(this.id);"> Problème sur le site/report d'un bug</span>
					<br>
					<span><input type="checkbox" id="contactcheck" onclick="motif(this.id);"> Suggestion, remerciement ou question</span>
					<br>
					<span><input type="checkbox" id="contactcheckother" onclick="motif(this.id);"> Autre</span>
					<div id="verifmotif"></div>
				</div>
				<fieldset>
					<legend>Contact</legend>
					<label class="content" for="sujet"> Objet <span class="star">*</span> </label><br />
					<input type="text" name="sujet" id="sujet">
					<div id="verifsujet"></div>
					<label class="content" for="probleme">Votre message <span class="star">*</span></label><br />
					<textarea name="probleme" id="probleme"></textarea>
					<div id="verifmessage"></div>
					<?php
						if(isset($_SESSION['pseudo']))
						{?>
							<input type="hidden" id="pseudo" name="pseudo" <?php echo 'value="' . $_SESSION['pseudo'] . '"' ?>> <?php
						}
						else
						{?>
							<input type="hidden" id="pseudo" name="pseudo" value="anonyme"> <?php
						}
					?>
					<input type="hidden" id="type" name="type" value=""> 
				</fieldset>
				<div id=showmail>
					<?php if(isset($_SESSION['pseudo']) == null)
					{
						echo "<br>";
						echo "<label> Il semble que vous ne soyez pas connecté, saisissez votre mail ci-dessous ou connectez-vous (nous ne vous enverrons un mail que si cela est strictement nécessaire)<span class='star'>*</span> </label>";?>
						<br>
						<input type="email" name="mailinput" id="mailinput" value="">
						<div id="verifmail"></div>
						<?php
					}
					?>
				</div> 
				<div id="contribution">	
					Merci pour votre contribution
				</div>
				<div id="footer">
					<input type="hidden" name="valider" id="valider">
					<input type="button" value="Envoyer" class="okbutton" onclick="verification()" style="margin-top: 0px;">
					<input type="reset" value="Effacer" class="okbutton" style="margin-top: 0px;">
				</div>
			</form>
		</div>
		<?php include('contenu/scrolltop.html'); ?>
		<?php include('contenu/footer.html'); ?>
		<?php require "action/messages.php"; ?>
		<script>
			function verification()
			{
				var strsujet = $("#sujet").val();
				var strprobleme = $("#probleme").val();
				var strmailinput = $("#mailinput").val();
				var verif = 0;

				if(!$('#problemecheck').is(':checked') && !$('#contactcheck').is(':checked') && !$('#contactcheckother').is(':checked'))
				{
					$('#verifmotif').html("Une case doit être cochée");
					verif = 1;
				}
				if(strsujet.length == 0)
				{
					$('#verifsujet').html("Ce champ est obligatoire");
					verif = 1;
				}
				if(strprobleme.length == 0)
				{
					$('#verifmessage').html("Ce champ est obligatoire");
					verif = 1;
				}
				if($('#mailinput').length)
				{
					if(strmailinput.length == 0)
					{
						$('#verifmail').html("Ce champ est obligatoire");
						verif = 1;
					}
				}	
				if (verif == 0) 
				{
					$("#valider").attr("type", "submit");
					$("#valider").trigger('click');
				}
			}
		</script>
	</body>
</html>


   			