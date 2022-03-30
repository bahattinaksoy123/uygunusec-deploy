<html>
<head>


</head>
<body>
<script language="JavaScript">

var timeleft;
var nextdue;
var tick = 1000;



function parseTime(t) {
 var tt = ("0:00:"+t);
 tt = tt.split(":").reverse();
 return (tt[0] * 1000)+(tt[1] * 60000)+(tt[2] * 3600000);
}



function zeroPad(n) {
 if (n<10) return "0"+n;
 return ""+n;
}



function makeTime(t) {
 if (t<0) return "0:00:00";
 var tt=t+999;
 return Math.floor(tt/3600000)+":"+
 zeroPad(Math.floor(tt/60000)%60)+":"+
 zeroPad(Math.floor(tt/1000)%60);
}



function startTimer() {
 nextdue = new Date().getTime();
 timeleft = parseTime(document.timerform.timerbox.value);
 runTimer();
}



function runTimer() {
 document.timerform.timerbox.value=makeTime(timeleft);
 if (timeleft<=0) alert ("Time's up!");
 else {
  var timecorr = (new Date().getTime())-nextdue;
  if (timecorr>0 && timecorr<3000) {
   timeleft -= (tick+timecorr);
   nextdue += tick;
   if (timeleft<1) setTimeout ("runTimer()",tick+timeleft);
   else setTimeout("runTimer()",Math.max(1,tick-timecorr));
  }
  else {
   nextdue=(new Date().getTime())+tick;
   timeleft-=tick;
   if (timeleft<1) setTimeout ("runTimer()",tick+timeleft);
   else setTimeout("runTimer()",tick);
  }
 } 
}



// -->
</script>



<form name="timerform">
  Decimal places: <input type="text" name="timerbox" value="0:00:00"></input>
  <input type="button" value="Start timer" onClick="startTimer()"></input>
</form>
</body>
</html>