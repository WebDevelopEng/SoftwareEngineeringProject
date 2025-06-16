function closewindow(){
    $faded=document.getElementById("background-fade");
    $content=document.getElementById("ad");
    $faded.style.display='none';
    $content.style.display='none';
    document.getElementById('ad-overlay').style.display = 'none';
    document.getElementById('ad-modal').style.display = 'none';
    return;
}