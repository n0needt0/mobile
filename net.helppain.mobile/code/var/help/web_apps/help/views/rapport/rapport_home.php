<script>
var head= document.getElementsByTagName('head')[0];
var script= document.createElement('script');
script.setAttribute('type', 'text/javascript');
script.setAttribute('src', '/assets/vendor/require/require.js');
script.setAttribute('data-main', "/assets/rapport/js/home.config");
head.appendChild(script);
</script>

<div>
    <div data-role="fieldcontain" class="ui-hide-label" style="width:80px;">
         <label for="ptrac">ptrac id:</label>
         <input type="text" name="ptrac" id="ptrac" value="" placeholder="Ptrac ID"/>
    </div>

    <h1>Patient Name</h1>
</div>

<div data-role="collapsible">
    <h3>Call Info</h3>



	<div>
        <label for="caller">Caller:</label>
        <input type="text" name="caller" id="caller" value="" placeholder="Caller"/>
    </div>

    <div>
    <fieldset data-role="controlgroup" data-type="horizontal">
		<legend>Date of Call:</legend>

		<label for="select-choice-month-dc">Month</label>
		<select name="select-choice-month-dc" id="select-choice-month-dc">
			<option value="jan">Jan</option>
			<option value="dec">Dec</option>
			<option value="feb">Feb</option>
			<option value="mar">Mar</option>
			<option value="apr">Apr</option>
			<option value="may">May</option>
			<option value="jun">Jun</option>
			<option value="jul">Jul</option>
			<option value="aug">Aug</option>
			<option value="sep">Sep</option>
			<option value="oct">Oct</option>
			<option value="nov">Nov</option>
			<option value="dec">Dec</option>
		</select>

		<label for="select-choice-day-dc">Day</label>
		<select name="select-choice-day-dc" id="select-choice-day-dc">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">13</option>
			<option value="13">14</option>
			<option value="15">15</option>
		</select>

		<label for="select-choice-year-dc">Year</label>
		<select name="select-choice-year-dc" id="select-choice-year-dc">
			<option value="2011">2013</option>
			<option value="2011">2012</option>
			<option value="2010">2011</option>
		</select>
	</fieldset>
	</div>
</div>

<div data-role="collapsible">
   <h3>Patient Info</h3>

     <div>
     <fieldset data-role="controlgroup" data-type="horizontal">
		<legend>Date of Birth:</legend>

		<label for="select-choice-month-dob">Month</label>
		<select name="select-choice-month-dob" id="select-choice-month-dob">
			<option value="jan">Jan</option>
			<option value="dec">Dec</option>
			<option value="feb">Feb</option>
			<option value="mar">Mar</option>
			<option value="apr">Apr</option>
			<option value="may">May</option>
			<option value="jun">Jun</option>
			<option value="jul">Jul</option>
			<option value="aug">Aug</option>
			<option value="sep">Sep</option>
			<option value="oct">Oct</option>
			<option value="nov">Nov</option>
			<option value="dec">Dec</option>
		</select>

		<label for="select-choice-day-dob">Day</label>
		<select name="select-choice-day-dob" id="select-choice-day-dob">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">13</option>
			<option value="13">14</option>
			<option value="15">15</option>
		</select>

		<label for="select-choice-year-dob">Year</label>
		<select name="select-choice-year-dob" id="select-choice-year-dob">
		    <?php
		    $y = date("Y",time());

		    for($i=$y; $i>($y-100);$i--)
		    {
		        echo '<option value="' . $i . '">' . $i . '</option>' . "\n";
		    }
		    ?>
		</select>
	</fieldset>
	</div>

    <div>
        <fieldset data-role="controlgroup" data-type="horizontal">
		<legend>Height</legend>

		<label for="select-choice-ft">Feet</label>
		<select name="select-choice-ft" id="select-choice-ft">
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="7">7</option>
		</select>

		<label for="select-choice-in">Inch</label>
		<select name="select-choice-in" id="select-choice-in">
		    <?php
		    for($i=0; $i<13;$i++)
		    {
		        echo '<option value="' . $i . '">' . $i . '</option>' . "\n";
		    }
		    ?>

		</select>
	</fieldset>

    </div>

      <label for="weight">Weight Lb</label>
      <input type="number" name="weight" id="weight" value="" placeholder="Weight Lb"/>

</div>

<div data-role="collapsible">
   <h3>Injury History</h3>

   	     <div>
     <fieldset data-role="controlgroup" data-type="horizontal">
		<legend>Injury Date:</legend>

		<label for="select-choice-month-injury">Month</label>
		<select name="select-choice-month-injury" id="select-choice-month-injury">
			<option value="jan">Jan</option>
			<option value="dec">Dec</option>
			<option value="feb">Feb</option>
			<option value="mar">Mar</option>
			<option value="apr">Apr</option>
			<option value="may">May</option>
			<option value="jun">Jun</option>
			<option value="jul">Jul</option>
			<option value="aug">Aug</option>
			<option value="sep">Sep</option>
			<option value="oct">Oct</option>
			<option value="nov">Nov</option>
			<option value="dec">Dec</option>
		</select>

		<label for="select-choice-day-injury">Day</label>
		<select name="select-choice-day-injury" id="select-choice-day-injury">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">13</option>
			<option value="13">14</option>
			<option value="15">15</option>
		</select>

		<label for="select-choice-year-injury">Year</label>
		<select name="select-choice-year-injury" id="select-choice-year-injury">
		    <?php
		    $y = date("Y",time());

		    for($i=$y; $i>($y-100);$i--)
		    {
		        echo '<option value="' . $i . '">' . $i . '</option>' . "\n";
		    }
		    ?>
		</select>
	</fieldset>
	</div>

    <label for="howdidyourinjuryoccur">How did you injury occur?</label>
    <textarea name="howdidyourinjuryoccur" id="howdidyourinjuryoccur">
    </textarea>

    <label for="whereisyourpainlocated">Where is your pain located?</label>
    <textarea name="whereisyourpainlocated" id="whereisyourpainlocated">
    </textarea>

</div>

<div data-role="collapsible">
   <h3>What procedures have you done to treat your pain</h3>

   <?php
   $treatments = array('Surgery', 'Physical Therapy', 'Acupuncture','Chiropractic treatment', 'Injections');
   foreach($treatments as $k=>$v)
   {

     $key = 'previous_treatment_'  . str_replace(' ', '_', strtolower($v));

     echo "<div data-role='collapsible'>\n";
       echo "<h3>$v</h3>\n";
       echo "<label for='$key'>Details (type, #of visits, dates:</label>\n";
       echo "<textarea name='$key'' id='$key'>\n";
       echo "</textarea>\n";

       echo "<label id='slider-$key-label' class='ui-slider' for='slider-$key'>Did it help?:</label>\n";
       echo "<select id='slider-$key' class='ui-slider-switch' data-role='slider' name='slider-$key'>\n";
       echo "<option value='nope'>Nope</option>\n";
       echo "<option value='yep'>Yep</option>\n";
       echo "</select>\n";
     echo "</div>\n";

   }
   ?>


</div>


<div data-role="collapsible">
   <h3>Surgery Details</h3>
   <p>I'm the collapsible content. By default I'm closed, but you can click the header to open me.</p>
</div>

<div data-role="collapsible">
   <h3>What medications have you tried for your pain</h3>
   <p>I'm the collapsible content. By default I'm closed, but you can click the header to open me.</p>
</div>

<div data-role="collapsible">
   <h3>Medication Details</h3>
   <p>I'm the collapsible content. By default I'm closed, but you can click the header to open me.</p>
</div>

<div data-role="collapsible">
   <h3>Does the pain make it hard for you to:</h3>
   <p>I'm the collapsible content. By default I'm closed, but you can click the header to open me.</p>
</div>

<div data-role="collapsible">
   <h3>What are your goals?</h3>
   <p>I'm the collapsible content. By default I'm closed, but you can click the header to open me.</p>
</div>

<div data-role="collapsible">
   <h3>Do you have any of these as a result of your injury/pain?</h3>
   <p>I'm the collapsible content. By default I'm closed, but you can click the header to open me.</p>
</div>


