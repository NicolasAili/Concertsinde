/*
	Type fichier : JS
	Fonction : Gestion du header lors du scroll
	Emplacement : js
	Contenu HTML : n
	JS+JQuery : n
	CSS : n
*/

var vertical=-1;
var rcun = document.getElementById('recherche');
var rchidden = document.getElementById('recherche-hidden');
setInterval(function() {
 if (window.scrollY != vertical) {
   vertical=window.scrollY;
   //console.log("window.scrollY="+vertical);
 }
 if(vertical>300)
 {
 	rcun.style.visibility = "hidden";
 	rchidden.style.visibility = "visible";
 }
 else
 {
 	rcun.style.visibility = "visible";
 	rchidden.style.visibility = "hidden";
 }
});