<script>
var head= document.getElementsByTagName('head')[0];
var script= document.createElement('script');
script.setAttribute('type', 'text/javascript');
script.setAttribute('src', '/assets/vendor/require/require.js');
script.setAttribute('data-main', "/assets/mobile/js/mhome.config");
head.appendChild(script);
</script>

<form id='form' action="/mnew" method="post">
<p>
Howdy Piligrim, how may we help?
</p>

<div class="ui-body ui-body-a">

        <input type="text" name="pin" id="pin" value="Enter your Name"/>

		<select name="type" id="type" data-native-menu="false">
		<option>Problem Area</option>
		<option value="Video Presence">Video Presence</option>
		<option value="Telephone">Telephone</option>
		<option value="Computer">Computer</option>
		<option value="VPN">VPN</option>
		<option value="Applications">Applications</option>
		<option value="Other">Other</option>
		</select>

		<textarea cols="40" rows="20" name="textarea" id="textarea">Problem Description</textarea>

		<select name="priority" id="priority" data-native-menu="false">
		<option>Priority</option>
		<option value="standard">when you get to it</option>
		<option value="urgent">I need it yesterday</option>
		</select>

		<button type="submit" data-theme="a" name="submit" value="submit-value">Submit</button>
</div>
</form>