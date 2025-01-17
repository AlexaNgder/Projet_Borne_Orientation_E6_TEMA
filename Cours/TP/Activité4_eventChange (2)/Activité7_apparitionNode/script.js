function preparerApparitionMenu(){
    console.log("rentree preparerApparitionMenu");
    var broch=document.getElementById("brochures");
    var tour=document.getElementById("tourBrochures");
    broch.onclick=function (){ // onclick = sinifie executer la function 
        if (broch.checked) tour.style.display="block";
        else tour.style.display="none";
    }
}

window.onload=function(){
    this.console.log("rentree onload");
    preparerApparitionMenu();
}