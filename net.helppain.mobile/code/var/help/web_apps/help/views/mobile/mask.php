<script>
var head= document.getElementsByTagName('head')[0];
var script= document.createElement('script');
script.setAttribute('type', 'text/javascript');
script.setAttribute('src', '/assets/vendor/require/ask.js');
script.setAttribute('data-main', "/assets/mobile/js/ask.config");
head.appendChild(script);

var progressbar = null;

$(document).ready(function(){
	 progressbar = $( "#progressbar" );
	 progressLabel = $( ".progress-label" );
    	 progressbar.progressbar({
        	 value: false,
        	 change: function() {
            	 progressLabel.text( progressbar.progressbar( "value" ) + "%" );
            	 progressbar.progressbar( "value" ) || 0;
            	 progressbar.find( ".ui-progressbar-value" ).css({"background": 'darkgreen'});

        	 },
        	 complete: function() {
          	   progressLabel.text( "Done!" );
        	 }
    	 });

	 });

var pin = '<?php echo $pin; ?>';
var pkey = '<?php echo $pkey; ?>';
var token = '<?php echo $token; ?>';
var expire = '<?php echo $expire; ?>';
var instrument_name = '<?php echo $instrument_name; ?>';
var instrument_id = '<?php echo $instrument_id; ?>';

</script>

<div id="content">
    <div id='app' class="navbar mini-layout">
        <h2 id='survey-title'><?php echo $pin; ?></h2>
        <div id="progressbar"><div class="progress-label">0 %</div></div>
        <div id='survey'>
        </div>
        </div>
    </div>
</div>