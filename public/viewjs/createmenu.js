function imagepreview(inputdata,element){
    if(inputdata.files[0]){
        var inputtedfile=inputdata.files[0];
        var imageplace=document.getElementById(element);
        var filereader = new FileReader;
        filereader.onload=function(event){
            var loadedfile=event.target.result
            imageplace.src=loadedfile;
            imageplace.style.display='block';
        }
        filereader.readAsDataURL(inputtedfile);
    }
    return
}