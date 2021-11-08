<?php
/*
	Type fichier : php
	Fonction : ajoute un concert
	Emplacement : /
	Connexion à la BDD : non
	Contenu HTML : oui
	JS+JQuery : oui
	CSS : oui
*/
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php
			include 'php/base.php';
			include 'php/css.php'; 
			include 'php/js.php'; 
			require('php/database.php');
			session_start();
			require('php/error.php');
		?>
		<script src="js/popupaddconcert.js"></script> 

		<link rel="stylesheet" type="text/css" href="css/body/ajoutconcert.css">
	</head>
	
	<body>
		<header>
			<?php include('contenu/header.php'); ?>
			<script src="js/scrollnav.js"></script> 
		</header>
		<div id="main">
			<div class="indentfi">
				 <h1 class="titre">Ajout d'un concert</h1>
				 <form method="post" class="connect" action="action/concert.php">
				 	(*): champs <u>obligatoires</u>
				 	<br>
				 	<br>
					<label for="artiste">*Nom de l'artiste ou du groupe:  </label> 
					<input type="text" name="artiste" placeholder="Saisir l'artiste" onkeyup="getdata(this.id);" id="artiste" required>
					<br>
					<br>
					<label for="date">*Date : </label> 
					<input type="date" name="date" placeholder="Saisir la date du concert " id="date" required>
					<br>
					<br>
					<label for="heure">Heure : </label> 
					<input type="time" name="heure" id="heure">
					<br>
					<br>
					Lieu du concert  
					<div id="extint"> 
						<br>
						<input type="checkbox" id="int" name="checkint" onclick="checkbox(this.id);"> 
						en intérieur (salle)
						<input type="checkbox" id="ext" name="checkext" onclick="checkbox(this.id);"> 
						en extérieur (festival, concert sauvage, rue etc...)
					</div>
						<br>
					<div id="sallediv">
						<label for="salle">*Salle : </label> 
						<input type="text" name="salle" id="salle" placeholder="Salle où a lieu le concert" onblur="getleave(this.id);" onkeyup="getdata(this.id);">
						<br>
						<div id="res"> </div>
						<br>
					</div>
					<div id="extdiv">
						Vous pouvez indiquer un nom pour cet événement exemple: garorock 
						<br>
						<label for="denom">Denomination : </label> 
						<input type="text" name="denom" placeholder="Donnez un nom à ce concert" id="denom">
						<br>
						<div id="resx"> </div>
						<br>
					</div>
					<div id=infosx>
						<div id="infos">
							<label for="adresse">Adresse: </label> 
							<input type="text" name="adresse" placeholder="Adresse où a lieu le concert" id="adresse">
							<br>
							<label for="ville">*Ville : </label> 
							<input type="text" name="ville" onblur="getleave(this.id);" onkeyup="getdata(this.id);" placeholder="Ville où a lieu le concert" id="ville">
							<br>
							<div id="resv"> </div>
							<br>
							<label for="cp">Code postal: </label> 
							<input type="text" name="cp" placeholder="Code postal où a lieu le concert" id="cp" disabled>
							<br>
							<label for="departement">Departement: </label> 
							<input type="text" name="departement" onblur="getleave(this.id);" onkeyup="getdata(this.id);" placeholder="Département où a lieu le concert" id="departement" disabled>
							<div id="resw"> </div>
							<br>
							<label for="region">Region: </label> 
							<input type="text" name="region" onblur="getleave(this.id);" onkeyup="getdata(this.id);" placeholder="Région où a lieu le concert" id="region" disabled>
							<br>
							<label for="pays">Pays: </label> 
							<input type="text" name="pays" onblur="getleave(this.id);" onkeyup="getdata(this.id);" placeholder="Pays où a lieu le concert" id="pays" disabled>
							<br>
							<br>
						</div>
					</div>
					<br>
					<label for="fb">Lien de l'evenement (facebook ou autres) : </label> 
					<input type="text" name="fb" placeholder="" id="fb">
					<br>
					<label for="ticket">Lien de la billetterie : </label> 
					<input type="text" name="ticket" placeholder="" id="ticket">
					<br>
					<br>
					<button type="button" id="dialog" onclick="popup();"> Enregister le concert </button>
					<div id="divSchedule">
								<h1> Recapitulatif du concert </h1>
								<div id="partiste">  </div> 
								<div id="dahe">Date et heure</div>
									<div id="pdate">  </div>  
									<div id="pheure">  </div>  
								<div id="pacp">Pays ville et CP</div>
									<div id="ppays">  </div> 
									<div id="pregion">  </div> 
									<div id="pdepartement"> test </div> 
									<div id="pville">  </div> 
									<div id="pcp">  </div>
								<div id="saad">Lieu et adresse</div> 
									<input type="checkbox" id="pint" name="checkint" disabled> 
									Interieur
									<br>
									<input type="checkbox" id="pext" name="checkint" disabled> 
									Exterieur
									<br>
									<div id="psalle">  </div> 
									<div id="padresse">  </div> 
								<div id="saad">Liens relatifs a l'evenement</div>
									<div id="pfb">  </div> 
									<div id="pticket"> </div> 
								<br>
								<h3> Ces données sont-elles correctes ? </h3>
								<div id="boutons">
									<button type="button" id="ouisaisie" onclick="submit();"> Oui, valider ces données </button>
									<button type="button" id="nonsaisie" onclick="retour();"> Non, modifier les données </button>
								</div>
					</div>
					<input  type="hidden" value="Enregister le concert" name="concert" id="valider" href="">
				</form>
			</div>	
			<?php include('contenu/footer.html'); ?>
		</div>
	</body>
</html>