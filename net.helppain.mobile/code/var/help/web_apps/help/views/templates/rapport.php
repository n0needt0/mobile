<!doctype html>
<html>
<head>
	<title> New Patient Introductory Questionnaire </title>

	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Expires" CONTENT="-1">
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">

	<!-- Home screen icon  Mathias Bynens mathiasbynens.be/notes/touch-icons -->
	<!-- For iPhone 4 with high-resolution Retina display: -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="apple-touch-icon.png">
	<!-- For first-generation iPad: -->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon.png">
	<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
	<link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">
	<!-- For nokia devices and desktop browsers : -->
	<link rel="shortcut icon" href="favicon.ico" />

	<!-- Mobile IE allows us to activate ClearType technology for smoothing fonts for easy reading -->
	<meta http-equiv="cleartype" content="on">


	<!-- jQuery Mobile CSS bits -->
	<link rel="stylesheet" href="/assets/mobile/css/jquery.mobile-1.3.0.min.css" />

	<!-- if you have a custom theme, add it here -->
	<link rel="stylesheet"  href="/assets/mobile/themes/rapport.css" />

	<!-- Custom css -->
	<link rel="stylesheet" href="/assets/mobile/css/custom.css" />

	<link rel="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<!-- js libs-->
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

	<script src="/assets/vendor/mobile/jquery.mobile-1.3.0.min.js"></script>
	<script src="/assets/vendor/mobile/ios-orientationchange-fix.min.js"></script>
	<script src="/assets/vendor/mobile/cordova-2.5.0.js"></script>

	<!-- Startup Images for iDevices -->
	<script>(function(){var a;if(navigator.platform==="iPad"){a=window.orientation!==90||window.orientation===-90?"images/startup-tablet-landscape.png":"images/startup-tablet-portrait.png"}else{a=window.devicePixelRatio===2?"images/startup-retina.png":"images/startup.png"}document.write('<link rel="apple-touch-startup-image" href="'+a+'"/>')})()</script>
	<!-- The script prevents links from opening in mobile safari. https://gist.github.com/1042026 -->
	<script>(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")</script>
	<!-- List of JS libs we use -->

	<script>
    	$(document).ready( function () {
    	    $.mobile.ajaxEnabled = false;
    	});


        var Conf = Conf || {};

        Conf.server_name = '<?php echo $_SERVER['SERVER_NAME']?>';
        Conf.protocol = 'http';
        <?php
        if(!empty($_SERVER['SERVER_HTTPS']))
        {
        	echo "Conf.protocol = 'https';";
        }
        ?>

        Conf.home = Conf.protocol + '://' + Conf.server_name;

        <?php
          if( JSDEBUG )
          {
              echo " Conf.DEBUG_MODE = 'console'; ";
          }
        ?>

        function debug(msg){

           if('debug' === Conf.DEBUG_MODE)
           {
               eval('debugger;');
           }

           if('console' === Conf.DEBUG_MODE)
           {
               console.log(msg);
           }
        }

        var jsLibs = {
        	        // Libraries
        	        jquery: Conf.home + "/assets/vendor/mobile/jquery-1.8.2-min",
        	        jquerymobile: Conf.home + "/assets/vendor/mobile/jquery.mobile-1.3.0.min",
        	        iosorientation: Conf.home + "/assets/vendor/mobile/ios-orientationchange-fix.min",
        	        cordova: Conf.home + "/assets/vendor/mobile/cordova-2.5.0",
        	        underscore: Conf.home + "/assets/vendor/underscore",
        	        backbone: Conf.home + "/assets/vendor/backbone",
        	        json2: Conf.home + "/assets/vendor/json2",
        	        // Shim Plugin
        	        use: Conf.home + "/assets/vendor/require/plugins/use",
        	        async: Conf.home + "/assets/vendor/require/plugins/async"
        	      };

    </script>
</head>
<body>
	<div data-role="page" id="page">
		<div data-role="header">
		      <h1>New Patient Introductory Questionnaire</h1>
		</div>

		<div data-role="content">
		 <?php echo $content; ?>
		</div>
		<div data-role="footer" data-theme="a">
			<h1>&copy; <?php echo date("Y",time());?> - Helppain.net</h1>
		</div>
	</div>
<!-- rMY_REVISION -->
</body>
</html>