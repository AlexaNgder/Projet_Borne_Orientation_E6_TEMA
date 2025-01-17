/* une nécessité d'afficher un menu nouveau, un message d'erreur, une promotion ??? */
/* etudions ce qui suit ... */

function creationNode(){

    var chaine=" p !! je suis ... ton frère ! un autre p ! fils de article comme toi 89...";
    var msgArct = document.getElementById('ici');
    var image = document.getElementById('mainImage')
    msgErr = document.createElement('p');
    msgErr.id = "msg-err";
    msgErr.textContent = chaine;
    msgErr.style.color = "red";
    msgArct.appendChild(msgErr);

    msgErr1 = document.createElement('89');
    msgErr1.id = "msg-err";
    msgErr1.imageContent = chaine;
    image.appendChild(msgErr1);

    document.body.style.backgroundColor = 'purple';

}

function creationNodeRetardee(){
    setTimeout(creationNode,3000);
}


window.onload=function(){
    creationNodeRetardee();
}