
window.onload=function(){// attendre soit tout charger dans le navigateur    
    this.console.log("rentree onload");// this represente un window
    var zoneImage=document.getElementById('mainImage');//getElementById Ca prend l'element HTML et le transforme en objet  
	zoneImage.addEventListener('mouseover',function(){// C'est un écouteur d'evenments  qui execute la function 
		console.log("coucou les SN2");
		zoneImage.setAttribute("src","./images/Poussin.gif");	
	});
}//F12 permet de voir le message 