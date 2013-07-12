<script>
var head= document.getElementsByTagName('head')[0];
var script= document.createElement('script');
script.setAttribute('type', 'text/javascript');
script.setAttribute('src', '/assets/vendor/require/require.js');
script.setAttribute('data-main', "/assets/rapport/js/home.config");
head.appendChild(script);
</script>

<style>
	#icon
	{
		height:16px;
		width:16px;
	}
	.chosen
	{
		background-color:#000000 !important;
	}
	ul.unstyled
	{
		padding:0 !important;
		margin:0 !important;
	}
</style>

<script>

	var ptracID = "NO_ID";
	
	function clearToggle(chosenButton)
	{
		var cb = $(chosenButton);
		while(!cb.hasClass("box"))
		{
			cb = cb.parent();
		}
		cb.find(".toggle").removeClass("chosen");
		return true;
	}

	function clear(curDiv)
	{
		$(curDiv).find('.checkImage').html(' ');
		return true;
	}

	function update(k, v)
	{
		console.log(k + ", " + v);
		return true;
	}

	function makeKey(base)
	{
		var container = $(base);
		while(!container.hasClass("checkable"))
		{
			container = container.parent();
		}
		var key = ptracID + "." + container.attr("data-keyletter") + "." + $(base).attr("data-keynum");
		return key;
	}

	function updateVal(base)
	{
		if($(base).prop("tagName") == "INPUT" || $(base).prop("tagName") == "TEXTAREA")
		{
			var key = makeKey(base);
			var value = $(base).val();
			update(key, value);
		}
		else if($(base).prop("tagName") == "SELECT")
		{
			var key = makeKey(base);
			var value = "";
			var container = $(base);
			while(container.prop("tagName") != "FIELDSET" && container.attr("data-role") != "collapsible")
			{
				container = container.parent();
			}
			container.find(".changeable option:selected").each(function(index)
			{
				value += $(this).val() + "/";
			});
			value = value.substring(0, value.length - 1);
			update(key, value);
		}
	}

	function updateMedications(base)
	{
		var container = $(base);
		while(!container.hasClass("checkable"))
		{
			container = container.parent();
		}
		var key = ptracID + "." + container.attr("data-keyletter") + ".med";

		container = $(base);
		while(!container.hasClass("unstyled"))
		{
			container = container.parent();
		}
		var value = new Array();
		container.find(".box").each(function(index)
		{
			value[index] = $(this).find("input").val() + "/";
			if($(this).find(".helpful").hasClass("chosen"))
			{
				value[index] += "helpful";
			}
			else if($(this).find(".unhelpful").hasClass("chosen"))
			{
				value[index] += "unhelpful";
			}
			else
			{
				value[index] += "neither";
			}
		});
		update(key, value);
	}
	
	$(document).ready(function()
	{
		$(".ptracIn").live('focusout', function()
		{
			if(!isNaN($(this).val()) && $(this).val().indexOf('.') == -1 && $(this).val().indexOf('-') == -1)
			{
				ptracID = $(this).val();
			}
		});

		$(".changeable").live('focusout', function()
		{
			updateVal(this);
		});

		$(".changeable").live('change', function()
		{
			updateVal(this);
		});

		$(".changemeds").live('focusout', function()
		{
			updateVal(this);
		});
		
		$(".checkable").live('expand', function()
		{
			$(this).find('.checkImage').html('<img id="icon" src="http://www.clker.com/cliparts/9/I/e/1/i/B/dark-green-check-mark-hi.png"/>');
		});

		$(".helpful").live('click', function()
		{
			var has = $(this).hasClass("chosen");
			clearToggle(this);
			if(!has) $(this).addClass("chosen");
			updateMedications(this);
		});

		$(".unhelpful").live("click", function()
		{
			var has = $(this).hasClass("chosen");
			clearToggle(this);
			if(!has) $(this).addClass("chosen");
			updateMedications(this);
		});

		$(".deleteButton").live("click", function()
		{
			try
			{
				var listItem = $(this);
				while(!listItem.hasClass("medicationItem"))
				{
					listItem = listItem.parent();
				}
				listItem.remove();
			}
			catch(e)
			{
				debug(e.message);
			}
		});
	});

	$('#page').live("pageinit", function(event)
	{		
		$(".addMedication").click(function()
		{
			var container = $(this);
			while(!container.hasClass("checkable"))
			{
				container = container.parent();
			}
			var ul = $('ul.unstyled');
		
			var newElement = "";
			newElement += '<li class="medicationItem ui-li ui-li-static ui-btn-up-c ui-first-child ui-last-child">';
			newElement += '<div class="box ui-field-contain ui-body ui-br" data-role="fieldcontain" style="display:block;"><div data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-icon="delete" data-iconpos="notext" data-theme="c" data-inline="true" data-mini="true" data-disabled="false" title="" class="ui-btn ui-shadow ui-btn-corner-all ui-mini ui-btn-inline ui-btn-icon-notext ui-btn-up-c" aria-disabled="false"><span class="ui-btn-inner"><span class="ui-btn-text"></span><span class="ui-icon ui-icon-delete ui-icon-shadow">&nbsp;</span></span><button data-mini="true" data-inline="true" data-iconpos="notext" data-icon="delete" class="deleteButton ui-btn-hidden" data-disabled="false"></button></div><div class="ui-input-text ui-shadow-inset ui-corner-all ui-btn-shadow ui-body-c"><input placeholder="Name of Medication" type="text" value="" class="changemeds ui-input-text ui-body-c"></div><div data-corners="false" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-theme="c" data-inline="true" data-disabled="false" class="ui-btn ui-btn-up-c ui-shadow ui-btn-inline" aria-disabled="false"><span class="ui-btn-inner"><span class="ui-btn-text">Helpful</span></span><button class="helpful toggle ui-btn-hidden" data-inline="true" data-corners="false" data-disabled="false">Helpful</button></div><div data-corners="false" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-theme="c" data-inline="true" data-disabled="false" class="ui-btn ui-btn-up-c ui-shadow ui-btn-inline" aria-disabled="false"><span class="ui-btn-inner"><span class="ui-btn-text">Not Helpful</span></span><button class="unhelpful toggle ui-btn-hidden" data-inline="true" data-corners="false" data-disabled="false">Not Helpful</button></div></div>';
			newElement += '</li>';
			
			ul.append(newElement);
		});
	});
</script>


<div>
    <div data-role="fieldcontain" class="ui-hide-label" style="width:80px;">
         <label for="ptrac">ptrac id:</label>
         <input class="ptracIn" type="text" name="ptrac" id="ptrac" value="" placeholder="Ptrac ID"/>
    </div>
    
    <h1>Patient Name</h1>
</div>

<div class="checkable" data-keyletter="a" data-role="collapsible">
    <h3>Call Info <span class="checkImage"></span></h3>
	<div>
        <label for="caller">Caller:</label>
        <input data-keynum="1" class="changeable" type="text" name="caller" id="caller" value="" placeholder="Caller"/>
    </div>
    
    <div>
    <fieldset data-role="controlgroup" data-type="horizontal">
		<legend>Date of Call:</legend>
		
		<label for="select-choice-month-dc">Month</label>
		<select class="changeable" data-keynum="2" name="select-choice-month-dc" id="select-choice-month-dc">
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
		<select class="changeable" data-keynum="2" name="select-choice-day-dc" id="select-choice-day-dc">
			<?php
		    for($i=1; $i<=31; $i++)
		    {
		        echo '<option value="' . $i . '">' . $i . '</option>' . "\n";
		    }
		    ?>
		</select>

		<label for="select-choice-year-dc">Year</label>
		<select class="changeable" data-keynum="2" name="select-choice-year-dc" id="select-choice-year-dc">
			<option value="2013">2013</option>
			<option value="2012">2012</option>
			<option value="2011">2011</option>
		</select>
	</fieldset>
	</div>
</div>

<div data-keyletter="b" class="checkable" data-role="collapsible">
   <h3>Patient Info <span class="checkImage"></span></h3>

     <div>
     <fieldset data-role="controlgroup" data-type="horizontal">
		<legend>Date of Birth:</legend>

		<label for="select-choice-month-dob">Month</label>
		<select class="changeable" data-keynum="1" name="select-choice-month-dob" id="select-choice-month-dob">
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
		<select class="changeable" data-keynum="1" name="select-choice-day-dob" id="select-choice-day-dob">
			<?php
			
		    for($i=1; $i<=31; $i++)
		    {
		        echo '<option value="' . $i . '">' . $i . '</option>' . "\n";
		    }
		    ?>
		</select>

		<label for="select-choice-year-dob">Year</label>
		<select class="changeable" data-keynum="1" name="select-choice-year-dob" id="select-choice-year-dob">
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
		<select class="changeable" data-keynum="2" name="select-choice-ft" id="select-choice-ft">
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="7">7</option>
		</select>

		<label for="select-choice-in">Inch</label>
		<select class="changeable" data-keynum="2" name="select-choice-in" id="select-choice-in">
		    <?php
		    for($i=0; $i<12;$i++)
		    {
		        echo '<option value="' . $i . '">' . $i . '</option>' . "\n";
		    }
		    ?>

		</select>
	</fieldset>

    </div>

      <label for="weight">Weight Lb</label>
      <input class="changeable" data-keynum="3" type="number" name="weight" id="weight" value="" placeholder="Weight Lb"/>

</div>

<div data-keyletter="c" class="checkable" data-role="collapsible">
   <h3>Injury History <span class="checkImage"></span></h3>

   	     <div>
     <fieldset data-role="controlgroup" data-type="horizontal">
		<legend>Injury Date:</legend>

		<label for="select-choice-month-injury">Month</label>
		<select class="changeable" data-keynum="1" name="select-choice-month-injury" id="select-choice-month-injury">
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
		<select class="changeable" data-keynum="1" name="select-choice-day-injury" id="select-choice-day-injury">
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
		<select class="changeable" data-keynum="1" name="select-choice-year-injury" id="select-choice-year-injury">
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

    <label for="howdidyourinjuryoccur">How did your injury occur?</label>
    <textarea class="changeable" data-keynum="2" name="howdidyourinjuryoccur" id="howdidyourinjuryoccur">
    </textarea>

    <label for="whereisyourpainlocated">Where is your pain located?</label>
    <textarea class="changeable" data-keynum="3" name="whereisyourpainlocated" id="whereisyourpainlocated">
    </textarea>

</div>

<div data-keyletter="d" class="checkable" data-role="collapsible">
   <h3>What procedures have you done to treat your pain?<span class="checkImage"></span></h3>

   <?php
   $treatments = array('Surgery', 'Physical Therapy', 'Acupuncture','Chiropractic treatment', 'Injections', 'Other');
   foreach($treatments as $k=>$v)
   {

     $key = 'previous_treatment_'  . str_replace(' ', '_', strtolower($v));

     echo "<div data-role='collapsible'>\n";
       echo "<h3>$v</h3>\n";
       echo "<label for='$key'>Details (type, #of visits, dates:</label>\n";
       echo "<textarea class='changeable' data-keynum='".($k*2+1)."' name='$key'' id='$key'>\n";
       echo "</textarea>\n";

       echo "<label id='slider-$key-label' class='ui-slider' for='slider-$key'>Did it help?:</label>\n";
       echo "<select id='slider-$key' class='changeable ui-slider-switch' data-keynum='".($k*2+2)."' data-role='slider' name='slider-$key'>\n";
       echo "<option value='nope'>Nope</option>\n";
       echo "<option value='yep'>Yep</option>\n";
       echo "</select>\n";
     echo "</div>\n";

   }
   ?>
</div>

<div data-keyletter="e" class="checkable" data-role="collapsible">
   <h3>What medications have you tried for your pain?<span class="checkImage"></span></h3>
   <div data-role="content">
   	<ul class="unstyled" data-role="listview">
   	<li class="medicationItem">
   		<div class="box" data-role="fieldcontain" style="display:block;">
   			<button class="deleteButton" data-mini="true" data-inline="true" data-iconpos="notext" data-icon="delete"></button>
   			<input class="changemeds" placeholder="Name of Medication" type="text" value=""></input>
   			<button class="helpful toggle" data-inline="true" data-corners="false">Helpful</button>
   			<button class="unhelpful toggle" data-inline="true" data-corners="false">Not Helpful</button>
		</div>
	</li>
   </ul>
   </div>
   <hr>
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="addMedication" data-inline="true" data-theme="e" data-iconpos="notext" data-icon="plus"></button>
</div>

<div class="checkable" data-role="collapsible">
   <h3>Misc. Questions <span class="checkImage"></span></h3>
   <?php
   $questions = array('Have you had any adverse effects from any medications you have trialed? For example: sleepiness, naisea, headaches, etc.', 'Do you have difficulty sleeping as a result of your pain?', 'Do you have a sexual dysfunction as a result of your pain?', 'Have you noticed weight gain since your injury? How much weight gain over what period of time?', 'Have you been told that you are a candidate for surgery for your pain? If so, is this something that you desire, or wish to avoid if possible?');
   foreach($questions as $k=>$v)
   {
     $key = 'question_'  . str_replace(' ', '_', strtolower($v));

     echo "<div data-role='collapsible'>\n";
       echo "<h3>$v</h3>\n";
       echo "<textarea name='$key'' id='$key'>\n";
       echo "</textarea>\n";
     echo "</div>\n";
   }
   ?>
</div>

<div class="checkable" data-role="collapsible">
   <h3>Does the pain make it hard for you to: <span class="checkImage"></span></h3>
   <table style="width:25%;">
   <?php
   $effects = array('Dress', 'Groom', 'Bathe', 'Do home duties', 'Provide childcare', 'Work', 'Spend time with family', 'Enjoy life', 'Sit', 'Stand', 'Lift/carry');
   foreach($effects as $k=>$v)
   {
     $key = 'effect_'  . str_replace(' ', '_', strtolower($v));
     echo "<tr><div class='box' data-role='fieldcontain' style='display:block;'>";
     echo "<td><h3	>$v:</h3></td>";
     echo "<td><select style='position:relative;float:right;' id='slider-$key-difficulties' data-mini='true' class='ui-slider-switch' data-role='slider' name='slider-$key'>\n";
     echo "<option value='nope'>Nope</option>\n";
     echo "<option value='yep'>Yep</option>\n";
     echo "</select></td>\n";
     echo "</div></tr>";
   }
   ?>
   </table>
</div>

<div class="checkable" data-role="collapsible">
   <h3>What are your goals? <span class="checkImage"></span></h3>
   <table style="width:25%;">
   <?php
   $goals = array('Increase your function', 'Medication reduction/optimization', 'Be independent in your daily life', 'Return to work', 'Case resolution', 'MMI status');
   foreach($goals as $k=>$v)
   {
     $key = 'goals_'  . str_replace(' ', '_', strtolower($v));
     echo "<tr><div class='box' data-role='fieldcontain' style='display:block;'>";
     echo "<td><h3	>$v:</h3></td>";
     echo "<td><select style='position:relative;float:right;' id='slider-$key-difficulties' data-mini='true' class='ui-slider-switch' data-role='slider' name='slider-$key'>\n";
     echo "<option value='nope'>Nope</option>\n";
     echo "<option value='yep'>Yep</option>\n";
     echo "</select></td>\n";
     echo "</div></tr>";
   }
   ?>
   
   <tr>
   	<td><h3>Other</h3></td>
   	<td><textarea></textarea></td>
   </tr>
   </table>
</div>

<div class="checkable" data-role="collapsible">
   <h3>Do you have any of these as a result of your injury/pain? <span class="checkImage"></span></h3>
   <table style="width:25%;">
   <?php
   $pains = array('Anger', 'Fear that you will re-injure yourself', 'Unhealthy ways of coping with your pain, ie:alcohol, illiciet drugs, etc', 'Mood disturbance', 'Depression', 'Irritability', 'Emotional distress', 'Somatic preoccupation');
   foreach($pains as $k=>$v)
   {
     $key = 'pain_'  . str_replace(' ', '_', strtolower($v));
     echo "<tr><div class='box' data-role='fieldcontain' style='display:block;'>";
     echo "<td><h3	>$v:</h3></td>";
     echo "<td><select style='position:relative;float:right;' id='slider-$key-difficulties' data-mini='true' class='ui-slider-switch' data-role='slider' name='slider-$key'>\n";
     echo "<option value='nope'>Nope</option>\n";
     echo "<option value='yep'>Yep</option>\n";
     echo "</select></td>\n";
     echo "</div></tr>";
   }
   ?>
   </table>
</div>