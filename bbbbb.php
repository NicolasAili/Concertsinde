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

$osef = $_POST['osef']; 
$placement = $_POST['placement'];
$osef = $osef*365;
$i = 1;
$calc = 0;

while($i < $osef)
{
	$calc = $calc + $i;
	$i++;
}

$calc = $calc/100;
echo "<br>";
echo "gains totaux (en euros) sur ";
echo $osef/365;
echo " ans: ";
echo $calc;
echo " €";

echo "<br>";
echo "<br>";
echo "argent par jour (en euros) au bout de ";
echo $osef/365;
echo " ans: ";
echo $osef/100;
echo " €";

echo "<br>";
echo "<br>";
echo "argent par mois (en euros) au bout de ";
echo $osef/365;
echo " ans: ";
echo ($i/100) *30 +30;
echo " €";

echo "<hr>";

$calcx = 100000;
$i = 0;
while ($i < $osef/365)
{
	$calcx = $calcx * (1+ $placement/100);
	$i++;
}

echo "<br>";
echo "<br>";
echo "argent total (en euros) au bout de ";
echo $osef/365;
echo " ans avec un rendement de ";
echo $placement;
echo "% par ans: ";
echo $calcx;
echo " €";

echo "<br>";
echo "bénéfices pour l'année n+1 :  ";
echo ($calcx * (1 + $placement/100)) - $calcx;
echo " €";
echo "<br>";
echo "<br>";
echo '<a href="aaaaa.html">'; ?> retour <?php echo "</a>"; 
?>