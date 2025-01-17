// TP Javascript ECMA2015 M.Narelli

var currentPos = 700;
var intervalHandle;

function demarrerAnimer() {
    document.getElementById("formulaire").style.position="absolute";
    document.getElementById("formulaire").style.left="700px";
    document.getElementById("formulaire").style.top="75px";
    intervalHandle=setInterval(baladeBoite,50);
}

function baladeBoite(){
    console.log("currentPos = ",currentPos);
    currentPos-=5;
    document.getElementById("formulaire").style.left=currentPos+"px";
    if (currentPos <=0) {
        clearInterval(intervalHandle);
        document.getElementById("formulaire").style.position="";
        document.getElementById("formulaire").style.left="";
        document.getElementById("formulaire").style.top="";
    }
}

window.onload= function(){
    setTimeout(demarrerAnimer,1000);
};