<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
</head>

<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link href=" {{asset('viewcss/landingpage.css')}}" rel="stylesheet" >
<body>
    <div class="slidingnavigation">
        
        <div class="partition13"></div><div class="partition23">
        <div class="navigationbutton" onclick="slidingbar('hciindicator','firstbutton')" id="firstbutton">
            <div class="inria-serif-light">Hello World</div>
        </div>
        <div class="dropdownparent navigationbutton" onclick="slidingbar('hciindicator','secondbutton')" id="secondbutton">
            <div class="inria-serif-light">Admin Functions </div><div class="dropdownmenu inria-serif-light">Who are we?</div>
        </div>
        <div class="navigationbutton" onclick="slidingbar('hciindicator','thirdbutton')" id="thirdbutton">
            <div class="inria-serif-light">What we are</div>
        </div>
        <div class="navigationbutton" onclick="slidingbar('hciiindicator','fourthbutton')" id="fourthbutton">
            <div class="inria-serif-light">Login</div>
        </div>
        <div class="indicator" id="hciindicator">
        </div>
</div>
    </div>
    <div style="display:flex">
    <div class="separator12" class="inria-serif-medium" style="font-size:1.5vw;padding-top:2%;" >We are Donacook. <img src="{{asset('')}}"></div><div class="separator12"></div></div>
    <div class="formbody">
        <div class='formcontent'></div><div class="formcontent"></div><div class="formcontent"></div></div>
    <script src="{{asset('viewjs/landingpage.js')}}"></script>
</body>
</html>
<!-- Comment
 style="font-family:'Roboto';font-weight:400;font-size:1.5vw;padding-top:2%;"-->