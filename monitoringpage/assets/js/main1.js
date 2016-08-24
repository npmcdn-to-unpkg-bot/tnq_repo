window.onload =  function(){
	display_inistformat();
	display_inutcformat();
}

function display_timerefresh(){
var refresh=1000;
mytime=setTimeout('display_inistformat()',refresh)
}

function display_timerefresh2(){
var refresh=1000;
mytime=setTimeout('display_inutcformat()',refresh)
}

function display_inistformat() {
var strcount
var x = new Date()
document.getElementById('isttime').innerHTML = x;
tt=display_timerefresh();
}

function display_inutcformat() {

var now = new Date(); 
var now_utc = new Date(now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate(),  now.getUTCHours(), now.getUTCMinutes(), now.getUTCSeconds());
document.getElementById('utctime').innerHTML = now_utc;
tt=display_timerefresh2();
}