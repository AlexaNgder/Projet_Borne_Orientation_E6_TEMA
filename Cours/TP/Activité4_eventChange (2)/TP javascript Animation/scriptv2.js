/* une nécessité d'afficher un menu nouveau, un message d'erreur, une promotion ??? */
/* etudions ce qui suit ... */
function preparerRemplacementPeriodique(){
    console.log("rentree preparerRemplacementPeriodique");
    var monImg=document.getElementById("mainImage");//capturer par l'image
    var monImg1=document.getElementById("mainImage1");
    var monTableau=["./images/Capture1.JPG","./images/Capture2.JPG","./images/Capture3.JPG","./images/Capture4.JPG","./images/Capture5.JPG","./images/cri.gif"];
    var numeroCelluleTab=0;
    function changerImage(){
        monImg.setAttribute("src",monTableau[numeroCelluleTab]);
        numeroCelluleTab++;
        if (numeroCelluleTab==monTableau.length) {
            clearInterval(myInterval);
            monImg1.setAttribute("src","./images/explosion.gif")
        }  
    }
    const myInterval = setInterval(changerImage,1000);
}
window.onload=function(){
    preparerRemplacementPeriodique();
}