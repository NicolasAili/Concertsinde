$('#connect').submit(function () 
{
var strpays = $("#pays").val();
var strregion = $("#region").val();

var strdate = $("#date").val();
var datesaisie = new Date(strdate).getTime()

var now = new Date();
var heure   = now.getHours();
heureinf = (heure+1)*3600000; //heure courante multipliée par le nb de ms en 1 heure
heuresup = 63072000000; //2 ans en milliseconde


var dateinf = datesaisie + heureinf;
var datesup = Date.now() + heuresup;

if(dateinf < Date.now())
{
    alert("Erreur, date saisie inférieure à la date actuelle");
    return false;
}
if(datesaisie > datesup)
{
    alert("Erreur, impossible de saisir des concerts plus de deux ans en avance");
    return false;
}


if(strregion.length > 0 && !strpays)
{
    alert("Erreur, vous devez saisir le pays dont fait partie cette région");
    return false;
}
});
