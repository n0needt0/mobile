<script>
var head= document.getElementsByTagName('head')[0];
var script= document.createElement('script');
script.setAttribute('type', 'text/javascript');
script.setAttribute('src', '/assets/vendor/require/require.js');
script.setAttribute('data-main', "/assets/mobile/js/mhome.config");
head.appendChild(script);
</script>

<h3>
<?php echo $message .' , your ticket number is ' . $ticket ;?>
</h3>
</hr>
<p>
<h3>IF URGENT PLEASE CALL ext 1170 !</h3>
</p>

<p>
<?php echo $body;?>
</p>
</hr>
<a href="/" data-theme="c" data-icon="back" data-role="button">Report More</a>
