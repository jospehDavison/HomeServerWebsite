<html>
<head>
<title>Colours</title>
</head>
<body>
<script src="js/javascript.js"></script>

<?php

		//create listener socket
		$sockRead = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
		socket_bind($sockRead, $ip, 1201);
		
		//listener for udp from media controll server
		while(true){		
			$byteArray = socket_read($sockRead, 15);
			$string = implode(byteArray());
			echo string;
		}

?>

</body>
</html>