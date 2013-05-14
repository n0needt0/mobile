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
		<option value="standard">Video Presence</option>
		<option value="rush">Telephone</option>
		<option value="express">Computer</option>
		<option value="overnight">VPN</option>
		<option value="overnight">Other</option>
		</select>

		<textarea cols="40" rows="20" name="textarea" id="textarea">Problem Description</textarea>

		<select name="priority" id="priority" data-native-menu="false">
		<option>Priority</option>
		<option value="standard">No Rush</option>
		<option value="rush">when you get to it</option>
		<option value="express">I need it yesterday</option>
		<option value="overnight">Sky is Falling</option>
		<option value="overnight">Too late :(</option>
		</select>

		<button type="submit" data-theme="a" name="submit" value="submit-value">Submit</button>
</div>
</form>