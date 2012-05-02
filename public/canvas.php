<html>
	<head>
		<title>Hello world</title>

		<script type="text/javascript">
 
			var can;
			var ctx;
 
			function init() {
				can = document.getElementById("can");
				ctx = can.getContext("2d");
				drawText();
			}
 
			function drawText() {
				ctx.fillStyle = "white";
				ctx.font = "12px Helvetica";
				ctx.textAlign = "left";
				ctx.textBaseline = "middle";
				var text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc semper placerat magna, eget viverra enim viverra ac. Nam arcu lacus, fermentum et suscipit in, adipiscing id nunc. Integer eros lectus, feugiat non volutpat sit amet, viverra rhoncus tellus. Fusce vel bibendum neque. Cras sed justo et mi laoreet tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed porttitor ultrices laoreet. Phasellus lobortis enim ac neque elementum dictum. Nulla dictum, sem at aliquet luctus, purus ligula sollicitudin lectus, non sodales ligula ante ac est. Ut dapibus, libero sed viverra consequat, eros magna semper dolor, eu semper dolor quam eget urna. Praesent mi massa, scelerisque eget egestas at, egestas id elit. Curabitur quis erat nec lorem ultricies facilisis. Cras accumsan blandit egestas. Sed vehicula nunc at ante tempor quis imperdiet felis commodo. Vestibulum sollicitudin, turpis sed cursus mollis, nunc tortor suscipit quam, et dignissim sem velit sit amet nulla. Sed venenatis tempor urna eget tristique. Etiam mattis pulvinar nibh, sed pharetra magna bibendum vestibulum. Vivamus pharetra diam eu massa egestas mattis. Phasellus ipsum est, eleifend congue tristique quis, blandit a ante. Pellentesque accumsan volutpat molestie. Vestibulum imperdiet massa erat. Integer at neque sapien. Sed non lobortis elit. Duis magna lectus, elementum sit amet tincidunt vitae, volutpat nec mi. Quisque ac mauris erat, a condimentum nulla. In at vestibulum mauris. Sed tincidunt hendrerit quam, et bibendum urna tristique tincidunt. Donec odio erat, euismod adipiscing iaculis non, porttitor eu sapien. Morbi semper elementum iaculis. In hac habitasse platea dictumst. In hac habitasse platea dictumst. Pellentesque nunc urna, pellentesque porta fringilla vel, pretium rutrum dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean feugiat adipiscing purus a interdum. Proin rhoncus molestie malesuada. Nam massa elit, venenatis eu hendrerit eget, pretium ac lectus. Ut vestibulum malesuada neque, at tristique ligula mollis vel. Aenean tortor neque, ornare non vestibulum ut, venenatis quis erat. Maecenas viverra lacus quis lorem ornare adipiscing. Integer orci magna, iaculis sit amet cursus et, hendrerit ac ante. Curabitur rhoncus, neque sed adipiscing gravida, tortor eros iaculis velit, ut vestibulum ipsum odio a urna. Maecenas hendrerit iaculis nisl, at pretium velit porta non. Phasellus quis lacus leo. Sed pulvinar, erat sit amet laoreet eleifend, magna lorem volutpat lectus, quis feugiat nisi sapien at diam. Donec sed sodales elit. Fusce feugiat faucibus dictum. Mauris et tristique magna. ";
				
		console.info(ctx.measureText(text));

				
				var width = 0;
				var currentLine = '';
				var yPos = 12;
				var yInc = 15;
				for (var i = 0; i <= text.length; i++) {
					// add textto the current line
					currentLine +=text[i];
					// if text is wider than the element then draw and start a new line
					var metric = ctx.measureText(currentLine + text[i + 1]);
					console.info('current: ', currentLine, ctx.measureText(currentLine));
					console.info('current plus 1: ',currentLine + text[i + 1], ctx.measureText(currentLine + text[i + 1]));

					if (metric.width > 500) {
						console.info('LONGER');

						
						if (currentLine[0] == '') {
							currentLine = currentLine.slice(1, currentLine.length)
						}
						ctx.fillText(currentLine, 0 , yPos);
						
						yPos += yInc;
						currentLine = '';
					}
					
					
					
				}

				
				
			}
 
		</script>
	</head>

	<body onload="init()" style="background-color:black">

		<canvas id="can" height="200" width="400" style="backgroundcolor:white">
		</canvas>

	</body>
</html>