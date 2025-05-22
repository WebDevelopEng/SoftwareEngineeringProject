function popupedit($string){
    $formdiv=document.getElementById($string)
    $formdiv.style.display="block";
    $background=document.getElementById('background-fade');
    $background.style.display="block";
    return;
}
function closepopup($string){
    $formdiv=document.getElementById($string)
    $formdiv.style.display="none";
    $background=document.getElementById('background-fade');
    $background.style.display="none";
    return;
}