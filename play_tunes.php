<!DOCTYPE html>
<html>
<head>
	<title>Tunes!</title>
	<link rel="stylesheet" type="text/css" href="css/play_tunes.css">
	<script type="text/javascript" scr="js/play_tunes.js"></script>
</head>
<body>
<header>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/play_tunes.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/play_tunes.js"></script>
	<script type="text/javascript">
$(function () {

	var tunes = [];
	var index = 0;
	var player = $('audio');
	tunes.push("BackstepCindy.mp3", "WinderSlide.mp3", "SugarInTheGourd.mp3", "Rachel.mp3", "CumberlandGap.mp3", "BreakingUpChristmas.mp3", "ElkRiverBlues.mp3")
	$('#prev').click(function(){
		prev_tune();
	});
	$('#next').click(function(){
		next_tune();
	});
	document.getElementById('audio').addEventListener('ended', function() {
		next_tune();
		document.getElementById('audio').play();
	}); 
	$('#tune_name').html(tunes[index]);
	$('#audio').attr('src','tunes/'+tunes[index]);
	function next_tune(){
		
		index = (index + 1) % 8;
		$('#audio').attr('src', 'tunes/'+tunes[index]);
		$('#tune_name').html(tunes[index]);
		document.getElementById('audio').play();
	}
	function prev_tune(){

		index = (index - 1);
		if(index < 0){
			index += 8;
		}
		$('#audio').attr('src', 'tunes/'+tunes[index]);
		$('#tune_name').html(tunes[index]);
		document.getElementById('audio').play();
	}
});
	</script>
	<style type="text/css">
		body {
			padding: 1em;
			text-align: center;
		}
		#audio {
			margin: 1em 0;
			max-width: 100%;
		}
		.audio-nav { text-align: center; }
	</style>
</header>
<div id="container">
	<div id="header">
		<h2>Play some tunes</h2>
	</div>
	<div class="name" id="tune_name"></div>
	<div id="body" class="">
	
		<audio controls id="audio">
	  		<!-- <source src="horse.ogg" type="audio/ogg"> -->
	  		<source  type="audio/mpeg">
			Your browser does not support the audio element.

		</audio>
		<div class="audio-nav">
			<button id="prev" class="btn btn-info">Prev <span class="glyphicon glyphicon-backward"></span></button>
			<button id="next" class="btn btn-info"><span class="glyphicon glyphicon-forward"></span> Next</button>
		</div>
		<div class="tune-title">
			<p id="tune-title"></p>
		</div>
	</div>
	<div id="foooter">
		<p></p>
	</div>
	
</div>
<!-- end container id -->
</body>
</html>