/*
	Type fichier : JS
	Fonction : Gestion du header lors du scroll
	Emplacement : js
	Contenu HTML : n
	JS+JQuery : n
	CSS : n
*/

/*var vertical=-1;
var rcun = document.getElementById('recherche');
var rchidden = document.getElementById('recherche-hidden');
setInterval(function() {
 if (window.scrollY != vertical) {
   vertical=window.scrollY;
   //console.log("window.scrollY="+vertical);
 }
 if(vertical>300 && $("#recherche").is(":visible"))
 {
 	rcun.style.visibility = "hidden";
 	rchidden.style.visibility = "visible";
 }
 else if(vertical<300 && $("#recherche-hidden").is(":visible"))
 {
 	rcun.style.visibility = "visible";
 	rchidden.style.visibility = "hidden";
 }
});*/

function recherche()
{
	$('#recherche').css('visibility', 'hidden');
    $('#bar').css('visibility', 'visible');
    //$('#bar').css('display', 'contents');
}

function fermer()
{
	var scroll = $(window).scrollTop();
	$('#bar').css('visibility', 'hidden');
	$('#recherche').css('visibility', 'visible');
}