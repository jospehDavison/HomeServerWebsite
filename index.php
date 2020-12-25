<html>
<head>
	<title>media controller</title>
	<link rel="stylesheet" href="style\mainMediaController.css">

	<meta name="viewport" content="width=device-width, initial-scale=1">
  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
</head>

<body style="padding-top: 25px;">
	<!--link in change colour function-->
	<script src="js/javascript.js"></script>
	
	<div class="center">
		<!--buttons div-->
		<h4>Media Controlls</h4>
		<div class="row">
			<form action="index.php" method="post">
				<input class="button" type="submit" value="Play/Pause" name="playPause">
			</form>
		
			<form action="index.php" method="post">
				<input class="button" type="submit" value="Volume Up" name="volUp">
			</form>
		
			<form action="index.php" method="post">
				<input class="button" type="submit" value="Volume Down" name="volDown">
			</form>
		</div>
		
		<h4>Colour Picker</h4>
		<div>
			<form action="index.php" method="post">
				<input type="color" id="colorPicker" name="colorPicker">
				<input class="button" type="submit">
			</form>
		</div>
		
		<h4>Themes</h4>
		<div class="row">
			<form action="index.php" method="post">
				<input class="button" type="submit" value="Chilled" name="themeChilled">
			</form>
		</div>
	</div>
	
	<?php
		//packets labels
		$PLAYPAUSE = '0';
		$VOLUP = '1';
		$VOLDOWN = '2';
		$OK = '3';
		
		$ip = '127.0.0.1';
		
		//acts like a listener for POST (when button pressed checks post data on form submision)
		if(isset($_POST['playPause'])){
			sendUdp($PLAYPAUSE);
		}	elseif(isset($_POST['volUp'])){
			sendUdp($VOLUP);
		} elseif(isset($_POST['volDown'])){
			sendUdp($VOLDOWN);
		} elseif(isset($_POST['colorPicker'])){
			$color = $_POST['colorPicker'];
			sendUdp($color);
		} elseif(isset($_POST['themeChilled'])){
			themes('chilled');
		}
		
		//function to just send given data over udp to server
		function sendUdp($data){
			//create udp socket and send data
			try{
				$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
				$len = strlen($data);		
				socket_sendto($sock, $data, $len, 0, $ip, 1200);
				
			} catch(Exception $e) {
				echo $e.getMessage();
				socket_close($sock);
			}		
			//clear post array when finnished
			$_POST = array();	
		}
		
		//function to send given theme info to server
		function themes($theme){
			if($theme == 'chilled'){			
				$colorHex = '#cc18ae';	
				sendUdp($colorHex);			
			}
		}			
	?>
	
</body>

</html>