/* une nécessité d'afficher un menu nouveau, un message d'erreur, une promotion ??? */
/* etudions ce qui suit ... */
function deplacement(){
    /*console.log("rentree deplacement");
    var hautimage = 0;
    var gaucheimage = 0;
    var monImg=document.getElementById("mainImage");//capturer par l'image
    monImg.style.position ="absolute";
    
    
    //monImg.style.left="0px";
    //monImg.style.top = 10+"100px";
    function bougeptmerede() {
        if (document.getElementById && gaucheimage < 500){
            hautimage ++;
            gaucheimage ++;
            monImg.style.left = gaucheimage+"px";
            monImg.addEventListener('click',function(){
                monImg.setAttribute("src","./images/chien.gif");
            });
        }
    }
    const myInterval = setInterval(bougeptmerede,10);*/
    document.addEventListener('keydown', function(event) {
        const box = document.querySelector('.movable-box');
        const step = 10;
        const playground = box.parentNode;
    
        const currentTop = parseInt(box.style.top, 10) || 0;
        const currentLeft = parseInt(box.style.left, 10) || 0;
    
        const maxTop = playground.clientHeight - box.offsetHeight;
        const maxLeft = playground.clientWidth - box.offsetWidth;
    
        if (['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight'].includes(event.key)) {
            event.preventDefault();
        }
    
        switch (event.key) {
            case 'ArrowUp':
                if (currentTop - step >= 0) {
                    box.style.top = `${currentTop - step}px`;
                }
                break;
            case 'ArrowDown':
                if (currentTop + step <= maxTop) {
                    box.style.top = `${currentTop + step}px`;
                }
                break;
            case 'ArrowLeft':
                if (currentLeft - step >= 0) {
                    box.style.left = `${currentLeft - step}px`;
                }
                break;
            case 'ArrowRight':
                if (currentLeft + step <= maxLeft) {
                    box.style.left = `${currentLeft + step}px`;
                }
                break;
        }
    });
}
window.onload=function(){
    deplacement();
}