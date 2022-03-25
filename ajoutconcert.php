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
			include 'php/error.php';
			require 'php/connectcookie.php';
			include 'php/base.php';
			include 'php/css.php'; 
			include 'php/js.php'; 
			require 'php/database.php';
		?>
		<script>$(this.target).find('input').autocomplete();</script>
		<script src="js/popupaddconcert.js"></script> 

		<link rel="stylesheet" type="text/css" href="css/body/ajoutconcert.css">
	</head>
	
	<body>
		<header>
			<?php include('contenu/header.php'); ?> 
		</header>
		<?php include 'contenu/reseaux.php'; ?>
		<div id="main">
			<div class="indentfi">
				 <form method="post" class="connect" action="action/concert.php">
				 	<h1 class="titre">Ajout d'un concert</h1>
				 	<div id="artistediv">
				 		<label for="artiste">Nom de l'artiste ou du groupe<span class="star">*</span></label> 
						<input type="text" name="artiste" placeholder="Saisir l'artiste" onkeyup="getdata(this.id);" id="artiste" required>
				 	</div>
				 	<div id="dateheure">
						<div id="datediv">
							<label for="date">Date<span class="star">*</span></label> 
							<input type="date" name="date" id="date" required>
						</div>
						<div id="heurediv">
							<label for="heure">Heure</label> 
							<input type="time" name="heure" id="heure">
						</div>
					</div>
					<div id="extint"> 
						<label> Lieu du concert<span class="star">*</span></label>
						<div id="extintcontent">
							<div>
								<input type="checkbox" id="int" name="checkint" onclick="checkbox(this.id);"> 
							en intérieur (salle)
							</div>
							<div>
								<input type="checkbox" id="ext" name="checkext" onclick="checkbox(this.id);"> 
							en extérieur (festival, concert sauvage, concert de rue etc...)
							</div>
						</div>
					</div>
					<div id="sallediv">
						<label for="salle">Salle<span class="star">*</span></label> 
						<input type="text" name="salle" id="salle" placeholder="Salle où a lieu le concert" onblur="getleave(this.id);" onkeyup="getdata(this.id);">
						<div id="res"> </div>
						<br>
					</div>
					<div id="extdiv"> 
						<label for="denom">Denomination<span class="star">*</span></label> 
						<input type="text" name="denom" placeholder="Indiquez un nom pour cet événement exemple: garorock" id="denom">
						<div id="resx"> </div>
						<br>
					</div>
					<div id=infosx>
						<div id="infos">
							<div id="adressdiv">
								<label for="adresse">Adresse</label> 
								<input type="text" name="adresse" placeholder="Adresse où a lieu le concert" id="adresse">
							</div>
							<div id="villediv">
								<label for="ville">Ville<span class="star">*</span></label> 
								<input type="text" name="ville" onblur="getleave(this.id);" onkeyup="getdata(this.id);" placeholder="Ville où a lieu le concert" id="ville">
								<div id="resv"> </div>
							</div>
							<div id="cpdiv">
								<label for="cp">Code postal</label> 
								<input type="text" name="cp" placeholder="Code postal où a lieu le concert" id="cp" disabled>
							</div>
							<div id="departementdiv">
								<label for="departement">Departement</label> 
								<input type="text" name="departement" onblur="getleave(this.id);" onkeyup="getdata(this.id);" placeholder="Département où a lieu le concert" id="departement" disabled>
								<div id="resw"> </div>
							</div>
							<div id="regiondiv">
								<label for="region">Region</label> 
								<input type="text" name="region" onblur="getleave(this.id);" onkeyup="getdata(this.id);" placeholder="Région où a lieu le concert" id="region" disabled>
							</div>
							<div id="paysdiv">
								<label for="pays">Pays</label> 
								<input type="text" name="pays" onblur="getleave(this.id);" onkeyup="getdata(this.id);" placeholder="Pays où a lieu le concert" id="pays" disabled>
							</div>
						</div>
					</div>
					<br>
					<label for="fb">Lien de l'evenement (facebook ou autre)</label> 
					<input type="text" name="fb" placeholder="" id="fb">
					<label for="ticket">Lien de la billetterie</label> 
					<input type="text" name="ticket" placeholder="" id="ticket">
					<div id="enregistrer">
						<button type="button" id="dialog" onclick="popup();"> Enregister le concert </button>
					</div>
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
						<div class="saad">Lieu et adresse</div>
						<div id="checkboxes">
							<div class="checkintext">
								<input type="checkbox" id="pint" name="checkint" disabled>
								Interieur
							</div>
							<div class="checkintext">
								<input type="checkbox" id="pext" name="checkint" disabled>
								Exterieur
							</div>
						</div> 
							<div id="psalle">  </div> 
							<div id="padresse">  </div> 
						<div class="saad">Liens relatifs a l'evenement</div>
							<div id="pfb">  </div> 
							<div id="pticket"> </div> 
						<br>
						<h3> Ces données sont-elles correctes ? </h3>
						<div id="boutons">
							<button type="button" id="ouisaisie" onclick="submit();"> Oui, valider ces données </button>
							<button type="button" id="nonsaisie" onclick="retour();"> Non, modifier les données </button>
						</div>
					</div>
					<input type="hidden" value="Enregister le concert" name="concert" id="valider">
				</form>
			</div>	
		</div>
		<?php include('contenu/footer.html'); 
			require "action/messages.php";?>
	</body>
</html>