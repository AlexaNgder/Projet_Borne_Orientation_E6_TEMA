/* une nécessité d'afficher un menu nouveau, un message d'erreur, une promotion ??? */
/* etudions ce qui suit ... */

function creationNode(){

    var chaine=" p !! je suis ... ton frère ! un autre p ! fils de article comme toi ...";
    var msgArct = document.getElementById('ici');
    msgErr = document.createElement('img');
    msgErr.setAttribute("src","./images/pa.jpg");
    msgErr.style.display="block";


    msgArct.appendChild(msgErr);
	
    document.body.style.backgroundColor = 'yellow';

}

function creationNodeRetardee(){
    setTimeout(creationNode,1000);
}


window.onload=function(){
    creationNodeRetardee();
}