    function RemplacerPar(imag){
    console.log("rentree RemplacerPar");
    var mavarlocale=document.getElementById('mainImage');
    mavarlocale.setAttribute("src",imag);//setAttribute(src (de<img), argument passe a la function img ); 
}

function preparerRemplacement(){
    console.log("rentree preparerRemplacement");
    setTimeout(RemplacerPar,5000,"./images/giphy2.gif");// setTimeout(function , duree attendre en ms, on pase a la function argument );
}

window.onload=function(){
    this.console.log("rentree onload");
    preparerRemplacement();
}