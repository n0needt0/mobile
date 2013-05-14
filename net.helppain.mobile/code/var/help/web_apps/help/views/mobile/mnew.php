<script>
var head= document.getElementsByTagName('head')[0];
var script= document.createElement('script');
script.setAttribute('type', 'text/javascript');
script.setAttribute('src', '/assets/vendor/require/require.js');
script.setAttribute('data-main', "/assets/mobile/js/mhome.config");
head.appendChild(script);
</script>

<p>
<?php echo $message;?>
</p>
<form method="get" action="/">
<div class="ui-body ui-body-a">

		<button type="submit" data-theme="a" name="submit" value="submit-value">Report More</button>
</div>
</form>