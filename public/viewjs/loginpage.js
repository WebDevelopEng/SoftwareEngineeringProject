var currentselection="userselection";
function logintype(string){
    var clickedelement=document.getElementById(string);
    console.log("helloi there");
    clickedelement.style.backgroundColor=' #0d6efd';
    var previouselement=document.getElementById(currentselection);
    currentselection=string;
    previouselement.style.backgroundColor='grey';
    var hidden=document.getElementById("hidden");
    hidden.value=string;
    console.log(hidden.value);
}