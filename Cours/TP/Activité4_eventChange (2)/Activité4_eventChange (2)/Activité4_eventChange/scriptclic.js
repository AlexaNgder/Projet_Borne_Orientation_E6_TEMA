
function preparerRemplacementAuClic(){
    console.log("rentree preparerRemplacementPeriodique");
    var monImg=document.getElementById("mainImage");
    var monTableau=["./images/img0.gif","./images/img1.gif","./images/img2.gif","./images/img3.gif","./images/giphy.gif"];
    var numeroCelluleTab=0;
	monImg.addEventListener(RemplacerPar,function(){
		console.log("coucou les SN2");
        setInterval(RemplacerPar(), 1000);
        //setTimeout(RemplacerPar(),5000,monTableau[numeroCelluleTab]);
        monImg.setAttribute("src",monTableau[numeroCelluleTab]);
        numeroCelluleTab++;
        if (numeroCelluleTab>=monTableau.length) {
            numeroCelluleTab=0;
        }
	});

}

window.onload=function(){
    this.console.log("rentree onload");
    preparerRemplacementAuClic();
}
