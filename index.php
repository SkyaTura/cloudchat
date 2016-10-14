<?php 
$db = [
	'jon' => 'amor1',
	'bibs' => 's2jonsnow',
];
$nome = [
	'jon'=> "Jon Snow",
	'bibs'=> "Ygritte",
];
$colors = [
	'jon'=> "F55",
	'bibs'=> "CA82FF",
];

if ((!isset($_POST['user'], $_POST['pass'])) || !isset($db[$_POST['user']]) ||
	($_POST['pass'] != $db[$_POST['user']])){ ?>
<form method="post">
	Usuario: <input type="text" name="user" /><br>
	Senha: <input type="password" name="pass" /><br>
	<input type="submit" value="Entrar" />
</form>
<?php exit; } ?>
<?php 
function getIpAddress() {
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			return $_SERVER['HTTP_CLIENT_IP'];
		} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			return trim($ips[count($ips) - 1]);
		} else {
			return $_SERVER['REMOTE_ADDR'];
		}
	}
	
$colours = array('007AFF','FF7000','FF7000','15E25F','CFC700','CFC700','CF1100','CF00BE','F00');
$ip = getIpAddress();
if (isset($colors[$_POST['user']]))
	$color = $colors[$_POST['user']];
else
	$color = $colours[array_rand($colours)];

?>

<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8' />
<style type="text/css">
/* For the "inset" look only */
html {
    overflow: auto;
}
/*
body {
    position: absolute;
    top: 20px;
    left: 20px;
    bottom: 20px;
    right: 20px;
    padding: 30px; 
    overflow-y: scroll;
    overflow-x: hidden;
}
*/
/* Let's get this party started */
::-webkit-scrollbar {
    width: 4px;
}
 
/* Track */
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    -webkit-border-radius: 10px;
    border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
    -webkit-border-radius: 10px;
    border-radius: 10px;
    background: rgba(127,127,127,0.8); 
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
}
::-webkit-scrollbar-thumb:window-inactive {
    background: rgba(127,127,127,0.4); 
}


#message {
	width: 100%;
}
.chat_wrapper, .main_wrapper, .panel {
	display: flex;
}
.panel {
	margin-bottom: 2.5px;
}
.chat_wrapper {
	height: 100%;
    border-bottom: 1px solid rgba(255,255,255,.4);
	padding: 5px 0px;
}
.message_box {
	height: 100%;
	width: 100%;
	overflow-y: scroll;
    overflow-x: hidden;
	padding: 0px 60px;
}
body {
	margin: 0;
	background: url('../iw3/img/backgrounds/bkg_dmountain.jpg');
	font-size: 16px;
}
.main_wrapper {
    flex-flow: column nowrap;
    height: 100%;
    width: 100%;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
	overflow: hidden;
	color: white;
}
.panel input{
	padding: 10px 10px;
	border: 0;
	background: none;
}
.main_wrapper * {
	color: white;
	font: 16px 'lucida grande',tahoma,verdana,arial,sans-serif;
	text-shadow: 1px 1px 3px rgba(0,0,0,.5);
}
.system_msg{color: #BDBDBD;font-style: italic;}
.user_name{font-weight:bold;}
.user_message {
    text-align: left;
	min-width: 5em;
	max-width: 30em;
}
.user_message > span {
	color: #88B6E0;
	max-width: 100%;
    overflow-wrap: break-word;
}
.user_message > span::after {
	content: " \00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0";
	font-size: .5em;
}
.timestamp::after {
    content: "";
}
.timestamp {
	color: rgba(255,255,255, .5);
	opacity: .5;
	font-size: .75em;
	position: absolute;
	bottom: 2.5px;
	right: 10px;
}
#bg {
	background: url('../iw3/img/backgrounds/bkg_dmountain.jpg');
	background-size: cover;
	filter: blur(2px);
	position: fixed;
	width: 100%;
	height: 100%;
}
#show_emojis{
	background: url(emojis.png) no-repeat;
    width: 34px;
    height: 34px;
    background-position: center;
    background-size: 80%;
    filter: invert(1);
    opacity: .5;
	
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	cursor: default;
}
#show_emojis:hover {
	opacity: 1;
}
#emojis {
    overflow-y: scroll;
    height: 300px;
}
#emojis_wrapper {
    position: absolute;
    width: 97%;
    bottom: 35px;
    padding: 10px 5px;
    left: 10px;
    filter: invert(1);	
	display: none;
	background: rgba(0,0,0,.5);
}
#emojis > span.emoji-outer {
	height: 1.5em;
	width: 1.5em;
	cursor: pointer;
}
#show_emojis:hover > #emojis_wrapper {
	display: initial;
}
.outcoming {
	text-align: left;
}
.bubble {
	background: rgba(0,0,0,0.5);
    padding: 2.5px 10px;
    border-radius: 10px;
	display: inline-block;
	position: relative;
}
.label {
	margin-bottom: 0.25em;
}
.line:not(:last-child) {
	margin-bottom: 0.25em;
}
textarea:focus, input:focus{
    outline: none;
}
.system_msg {
	text-align: center;
}
#message_box > div {
	opacity: .4;
	transition: opacity 800ms;
}
#message_box > div:hover {
	opacity: 1;
	transition: opacity 50ms !important;
}
#message_box > div .user_message > span,
#message_box > div .user_message > span * {
	color: rgba(127,127,127,.5);
	transition: color 800ms;
	
}
#message_box > div:hover .user_message > span,
#message_box > div:hover .user_message > span * {
	color: #88B6E0;
	transition: color 50ms;
}
#message_box > div .user_message > span i *,
#message_box > div .user_message > span i {
    font-style: italic;
}
#message_box > div .user_message > span s *,
#message_box > div .user_message > span s {
    text-decoration: line-through;
}
#message_box > div .user_message > span b,
#message_box > div .user_message > span b * {
    font-weight: bold;
}
.big-emoji > span.emoji-outer {
	height: 3em;
	width: 3em;
}
@keyframes pulseheart {
	0% {
		height: 4em;
		width: 4em;
		margin: -0.2em;
	}
	100% {
		height: 3.5em;
		width: 3.5em;
		margin: 0em;
	}
}
.heart-emoji {
    height: 4em;
    width: 4em;
    display: inline-block;
    overflow: hidden;
}
.heart-emoji > span.emoji-outer {
	animation: pulseheart 600ms linear infinite;
	animation-direction: alternate;
}
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<link href="emoji.css" rel="stylesheet" type="text/css" />
<script src="js-emoji/lib/emoji.js" type="text/javascript"></script>
<script src="js-emoji/lib/jquery.emoji.js" type="text/javascript"></script>

<script language="javascript" type="text/javascript">  
var unread = 0;
/*
var emoji = new EmojiConvertor();


emoji.use_sheet = true;

emoji.init_env();
emoji.img_set = 'apple';
emoji.text_mode = true;
emoji.replace_mode = 'img';
emoji.supports_css = true;
*/

var emoji = null;

function formatDate(date, format, utc) {
    var MMMM = ["\x00", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var MMM = ["\x01", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var dddd = ["\x02", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    var ddd = ["\x03", "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

    function ii(i, len) {
        var s = i + "";
        len = len || 2;
        while (s.length < len) s = "0" + s;
        return s;
    }

    var y = utc ? date.getUTCFullYear() : date.getFullYear();
    format = format.replace(/(^|[^\\])yyyy+/g, "$1" + y);
    format = format.replace(/(^|[^\\])yy/g, "$1" + y.toString().substr(2, 2));
    format = format.replace(/(^|[^\\])y/g, "$1" + y);

    var M = (utc ? date.getUTCMonth() : date.getMonth()) + 1;
    format = format.replace(/(^|[^\\])MMMM+/g, "$1" + MMMM[0]);
    format = format.replace(/(^|[^\\])MMM/g, "$1" + MMM[0]);
    format = format.replace(/(^|[^\\])MM/g, "$1" + ii(M));
    format = format.replace(/(^|[^\\])M/g, "$1" + M);

    var d = utc ? date.getUTCDate() : date.getDate();
    format = format.replace(/(^|[^\\])dddd+/g, "$1" + dddd[0]);
    format = format.replace(/(^|[^\\])ddd/g, "$1" + ddd[0]);
    format = format.replace(/(^|[^\\])dd/g, "$1" + ii(d));
    format = format.replace(/(^|[^\\])d/g, "$1" + d);

    var H = utc ? date.getUTCHours() : date.getHours();
    format = format.replace(/(^|[^\\])HH+/g, "$1" + ii(H));
    format = format.replace(/(^|[^\\])H/g, "$1" + H);

    var h = H > 12 ? H - 12 : H == 0 ? 12 : H;
    format = format.replace(/(^|[^\\])hh+/g, "$1" + ii(h));
    format = format.replace(/(^|[^\\])h/g, "$1" + h);

    var m = utc ? date.getUTCMinutes() : date.getMinutes();
    format = format.replace(/(^|[^\\])mm+/g, "$1" + ii(m));
    format = format.replace(/(^|[^\\])m/g, "$1" + m);

    var s = utc ? date.getUTCSeconds() : date.getSeconds();
    format = format.replace(/(^|[^\\])ss+/g, "$1" + ii(s));
    format = format.replace(/(^|[^\\])s/g, "$1" + s);

    var f = utc ? date.getUTCMilliseconds() : date.getMilliseconds();
    format = format.replace(/(^|[^\\])fff+/g, "$1" + ii(f, 3));
    f = Math.round(f / 10);
    format = format.replace(/(^|[^\\])ff/g, "$1" + ii(f));
    f = Math.round(f / 10);
    format = format.replace(/(^|[^\\])f/g, "$1" + f);

    var T = H < 12 ? "AM" : "PM";
    format = format.replace(/(^|[^\\])TT+/g, "$1" + T);
    format = format.replace(/(^|[^\\])T/g, "$1" + T.charAt(0));

    var t = T.toLowerCase();
    format = format.replace(/(^|[^\\])tt+/g, "$1" + t);
    format = format.replace(/(^|[^\\])t/g, "$1" + t.charAt(0));

    var tz = -date.getTimezoneOffset();
    var K = utc || !tz ? "Z" : tz > 0 ? "+" : "-";
    if (!utc) {
        tz = Math.abs(tz);
        var tzHrs = Math.floor(tz / 60);
        var tzMin = tz % 60;
        K += ii(tzHrs) + ":" + ii(tzMin);
    }
    format = format.replace(/(^|[^\\])K/g, "$1" + K);

    var day = (utc ? date.getUTCDay() : date.getDay()) + 1;
    format = format.replace(new RegExp(dddd[0], "g"), dddd[day]);
    format = format.replace(new RegExp(ddd[0], "g"), ddd[day]);

    format = format.replace(new RegExp(MMMM[0], "g"), MMMM[M]);
    format = format.replace(new RegExp(MMM[0], "g"), MMM[M]);

    format = format.replace(/\\(.)/g, "$1");

    return format;
};
function beep() {
    var snd = new Audio("data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU=");  
    snd.play();
}
function runScript(e) {
    if (e.keyCode == 13) {
        send();
    }
}
function send(){ //use clicks message send button	
	var mymessage = $('#message').val(); //get message text
	var myname = '<?=$nome[$_POST['user']]?>'; //get user name
	
	if(myname == ""){ //empty name?
		alert("Enter your Name please!");
		return;
	}
	if(mymessage == ""){ //emtpy message?
		return;
	}
	
	//prepare json data
	var msg = {
	message: mymessage,
	name: myname,
	color : '<?php echo $color; ?>'
	};
	//convert and send data to server
	websocket.send(JSON.stringify(msg));
	$('#message').val(''); //reset text
};
/* */
var wsUri = "ws://172.20.21.55:9000/chat/server.php"; 	
websocket = new WebSocket(wsUri); 
$(document).ready(function(){
	window.focused = true;
	window.onblur = function(){ 
		if (window.focused !== false){
			window.focused = false; 
			console.log('brb');
		}
	}
	window.onfocus = function(){ 
		if (window.focused !== true){
			window.focused = true; 
			setTimeout(function(){$("#message").focus();}, 80);
			console.log('Msgs esperando: '+unread);
			unread = 0;
			document.title = "Chat";
		}
	}

	$('#message').focus();
	//create a new WebSocket object.
	
	websocket.onopen = function(ev) { // connection is open 
		$('#message_box').append("<div class=\"system_msg\">Connected!</div>"); //notify user
	}
emoji = new EmojiConvertor();
emoji.img_sets = {
	'apple'    : {'path' : 'js-emoji/build/emoji-data/img-apple-64/'   , 'sheet' : 'js-emoji/build/emoji-data/sheet_apple_64.png',    'mask' : 1 },
	'google'   : {'path' : 'js-emoji/build/emoji-data/img-google-64/'  , 'sheet' : 'js-emoji/build/emoji-data/sheet_google_64.png',   'mask' : 2 },
	'twitter'  : {'path' : 'js-emoji/build/emoji-data/img-twitter-64/' , 'sheet' : 'js-emoji/build/emoji-data/sheet_twitter_64.png',  'mask' : 4 },
	'emojione' : {'path' : 'js-emoji/build/emoji-data/img-emojione-64/', 'sheet' : 'js-emoji/build/emoji-data/sheet_emojione_64.png', 'mask' : 8 }
};
/*
emoji.text_mode = true;
emoji.removeAliases([
  'doge',
  'cat',
]);
*/
emoji.include_title = true;
emoji.use_sheet = true;
emoji.addAliases({
  'doge' : '1f415',
  'cat'  : '1f346'
});
$("#emojis").html(emoji.replace_colons($("#emojis").html()));
$('#emojis .emoji-inner').click(function(a){
$("#message").val($("#message").val()+":"+(a.target.title)+":");
});
	function decorate(text){
		if (text == ':heart:')
			text = "<span class='heart-emoji'>:heart:</span class='heart-emoji'>";
		text = text.replace(/(\*){2}(.*?)(\*){2}/ig, "<b>$2</b>");
		text = text.replace(/(\_){2}(.*?)(\_){2}/ig, "<i>$2</i>");
		text = text.replace(/(\~){2}(.*?)(\~){2}/ig, "<s>$2</s>");
		text = text.replace(/(\+){2}(.*?)(\+){2}/ig, "<span class='big-emoji'>$2</span class='big-emoji'>");
		return text;
	}
	//#### Message received from server?
	websocket.onmessage = function(ev) {
		var msg = JSON.parse(ev.data); //PHP sends Json data
		var type = msg.type; //message type
		var umsg = emoji.replace_colons(decorate(msg.message)); //message text
		var uname = msg.name; //user name
		var ucolor = msg.color; //color
		var time = new Date();
		var timestamp = formatDate(time, "HH:mm:ss");

		
		if(type == 'usermsg') 
		{
			var id = uname.toLowerCase().replace(/\s/g, '');
			var myname = '<?=$nome[$_POST['user']]?>';
			var myid = myname.toLowerCase().replace(/\s/g, '');
			
			if ($('#message_box > div:last-child').hasClass(id))
				var bubbles = $('#message_box > div:last-child > .bubbles');
			else {
				var message_combo = $("<div class='"+id+"'></div>").appendTo("#message_box");
				message_combo.append("<div class='label'><label style=\"color:#"+ucolor+"\">"+uname+"</label></div>");
				if (myid == id)
					message_combo.addClass("outcoming");
				else
					message_combo.addClass("incoming");
				bubbles = $("<div class='bubbles'></div>").appendTo(message_combo);
			}

			bubble = ""+
				"<div class='line'>"+
					"<div class='bubble'>"+
						"<div class=\"user_message\"><span>"+umsg+"</span></div>"+
						"<div class=\"timestamp\">"+timestamp+"</div>"+
					"</div>"+
				"</div>";
				
			bubbles.append(bubble);
			
			if (window.focused != true){
				unread++;
				document.title = unread+" Mensagens não lidas";
				beep();
			}
		}
		if(type == 'system')
		{
			$('#message_box').append("<div class=\"system_msg\">"+umsg+"</div>");
		}
		var objDiv = document.getElementById("message_box");
		objDiv.scrollTop = objDiv.scrollHeight;
	};
	
	websocket.onerror	= function(ev){$('#message_box').append("<div class=\"system_error\">Error Occurred - "+ev.data+"</div>");}; 
	websocket.onclose 	= function(ev){$('#message_box').append("<div class=\"system_msg\">Connection Closed</div>");}; 
});
/* */
</script>
</head>
<body>	
	<div id="bg"></div>
	<div class="main_wrapper">

		<div class="chat_wrapper">
			<div class="message_box" id="message_box"> </div>
		</div>
		<div class="panel">
			<span id="show_emojis">
				<?php 
					include "emojitable.php"; 
				?>
			</span>
			<input type="text" name="message" id="message" placeholder="Message" maxlength="500" onkeypress="return runScript(event)"/>
		</div>
	</div>
</body>
</html>