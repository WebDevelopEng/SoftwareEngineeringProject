var currentselection="userselection";
function registtype(string){
    var clickedelement=document.getElementById(string);
    console.log("helloi there");
    clickedelement.style.backgroundColor='#0d6efd';
    var previouselement=document.getElementById(currentselection);
    var divarea=currentselection.concat('area');
    divarea=document.getElementById(divarea);
    divarea.style.display="none";
    var newarea=string.concat('area');
    newarea=document.getElementById(newarea);
    newarea.style.display="block";
    previouselement.style.backgroundColor='grey';
    currentselection=string;
    var form=document.getElementById('form');
    if (string=="userselection"){
        form.action="/register";
    }
    if(string=="restoselection"){
        form.action="/restoregist";
    }
    if(string=="adminselection"){
        form.action="/adminregist";
    }
}