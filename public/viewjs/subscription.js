function calculatecosts(){
    const now = new Date()
    var enddate=document.getElementById('enddate')
    var timevalue=enddate.value-now
    const Seconds = Math.floor(timevalue / 1000);
    const Minutes = Math.floor(Seconds / 60);
    const Hours = Math.floor(Minutes / 60);
    const Days = Math.floor(Hours / 24);
    
}
