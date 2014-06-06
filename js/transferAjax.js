/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var requete = null;
function obtenirObjetRequete() {
	if (window.ActiveXObject) { requete= new ActiveXObject("Microsoft.XMLHTTP");
	} else if (window.XMLHttpRequest) { requete = new XMLHttpRequest(); }
}
function envoyerRequete(courriel,pwd) {
	if (requete === null) {
		obtenirObjetRequete();
	}
	if (courriel=="" || pwd == "")
	{
		document.getElementById("tableau").innerHTML="";
		return;
	} 
	requete.open("GET","traitement.php?id_usager="+courriel+"&pwd="+pwd,true);
	requete.onreadystatechange = traiterReponse ;
	requete.send();
}
function traiterReponse () {
	if (requete.readyState==4)
	{
		document.getElementById("tableau").innerHTML=requete.responseText;
	}
}


