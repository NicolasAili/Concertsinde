/*let elt = document.getElementById('test');
elt.innerHTML = "<ul><li>Elément 1</li><li>Elément 2</li></ul>";
var somme = 1 + 2;
elt.innerHTML = somme;*/

var vertical=-1;
var rcun = document.getElementById('recherche');
var rchidden = document.getElementById('recherche-hidden');
setInterval(function() {
 if (window.scrollY != vertical) {
   vertical=window.scrollY;
   //document.getElementById ("demo").innerHTML = "Vertically: " + vertical + "px";
   console.log("window.scrollY="+vertical);
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
}, 500);