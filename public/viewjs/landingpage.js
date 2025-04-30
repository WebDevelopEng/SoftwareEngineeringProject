
var buttonpositions= new Map(
    [['firstbutton',document.getElementById('firstbutton').getBoundingClientRect()],
    ['secondbutton',document.getElementById('secondbutton').getBoundingClientRect()],
    ['thirdbutton',document.getElementById('thirdbutton').getBoundingClientRect()],
    ['hciindicator',document.getElementById('hciindicator').getBoundingClientRect()]
    ]
)
function slidingbar(x1,x2){
    var target= document.getElementById(x2);
    var indicator=document.getElementById(x1);
    var targetposition = buttonpositions.get(x2)
    var indicatorposition = buttonpositions.get(x1)
    var indicatortransform = new WebKitCSSMatrix(window.getComputedStyle(indicator).transform);

    var horizontaltranslation=targetposition.left-(indicatorposition.left);
    var strings="translateX("+horizontaltranslation.toString()+"px)";
    indicator.animate({transform: strings},{duration:500, fill:"forwards",easing:"ease-in"});
    return;
}




