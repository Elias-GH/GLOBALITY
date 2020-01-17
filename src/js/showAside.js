function openNav() {
    if (document.getElementById("linksESIEA").style.height != "200px") {
        console.log('show links\n');
        document.getElementById("linksESIEA").style.height    = "200px";
        document.getElementById("linksESIEA").style.opacity   = "1";
        document.getElementById("linksESIEA").style.transform = "rotateX(0deg) translate(-50%, -50%) scale(1)";
        document.getElementById('block').style.transform      = "rotateX(75deg) translate(-50%, -50%) skew(-15deg, 15deg)";
        document.getElementById('block').style.boxShadow      = "20px 30px 25px 5px rgba(0, 0, 0, 0.8)";
        document.getElementById('mainTitle').innerHTML        = "Liens";
        document.getElementById('btn-aside').style.transform  = 'rotate(135deg)';
    } else {
        console.log('hide links\n');
        document.getElementById("linksESIEA").style.height    = "0";
        document.getElementById("linksESIEA").style.opacity   = "0";
        document.getElementById("linksESIEA").style.transform = "rotateX(90deg) translate(-50%, -50%) scale(0)";
        document.getElementById('block').style.transform      = "rotateX(0deg) translate(-50%, -50%)";
        document.getElementById('block').style.boxShadow      = "0px 0px 0px 0px rgba(0, 0, 0, 0)";
        document.getElementById('mainTitle').innerHTML        = "Menu";
        document.getElementById('btn-aside').style.transform  = 'rotate(0deg)';
    }
}
