<script>
var head= document.getElementsByTagName('head')[0];
var script= document.createElement('script');
script.setAttribute('type', 'text/javascript');
script.setAttribute('src', '/assets/vendor/require/require.js');
script.setAttribute('data-main', "/assets/rapport/js/home.config");
//head.appendChild(script);
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

    var ptracID = "<?php echo $ptracid?>";

    <?php //meds list

    $lines = explode("\n", str_replace("\r", "", file_get_contents("meds.text")));
    $meds = "";
    foreach ($lines as $line)
    {
          $line = trim($line);
          //skip emptys
          if( '' !== $line)
          {
              $meds .= '"' . ucfirst($line) . '","';
          }
    }

    echo "var medicationValues = [" . trim($meds, ',') . '];';

    ?>

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
        debug(k + ", " + v);
        try
        {
            var api_url = '/rapport_api/key_data';
            debug('api call url:' + api_url);
            $.ajax({
                url: api_url,
                type: "POST",
                data: {ptracid : ptracID, key : k, value : v},

                success: function(data)
                {
                    debug(data);
                }
            });
            debug('api url:' + api_url);
            return true;
        }
        catch (err)
        {
            debug(err);
            return false;
        }
    }

    function showGreenCheck(checkable) //Not finished!
    {
        debug("hi");
        $(checkable).find('.checkImage').html('<img id="icon" src="/assets/images/green_check.png"/>');
    }

    function makeKey(base)
    {
        var container = $(base);
        while(!container.hasClass("checkable"))
        {
            container = container.parent();
        }
        var key = container.attr("data-keyletter") + "." + $(base).attr("data-keynum");
        showGreenCheck(container);
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
            while(container.prop("tagName") != "FIELDSET" && container.prop("tagName") != "TD" && container.attr("data-role") != "collapsible")
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
        var basekey = container.attr("data-keyletter") + ".";
        showGreenCheck(container);

        container = $(base);
        while(!container.hasClass("box"))
        {
            container = container.parent();
        }
        var key = basekey + container.attr("data-keynum");
        var value = container.find("input").val() + "/";
        if(container.find(".helpful").hasClass("chosen"))
        {
            value += "helpful";
        }
        else if(container.find(".unhelpful").hasClass("chosen"))
        {
            value += "unhelpful";
        }
        else
        {
            value += "neither helpful nor unhelpful";
        }

        update(key, value);
    }

    $(document).ready(function()
    {

        $(".changeable").on('focusout', function()
        {
            updateVal(this);
        });

        $(".changeable").on('change', function()
        {
            updateVal(this);
        });

        $(".changemeds").on('focusout', function()
        {
            updateMedications(this);
        });

        $(".changemeds").on('change', function()
        {
            updateMedications(this);
        });

        $(".helpful").on('click', function()
        {
            var has = $(this).hasClass("chosen");
            clearToggle(this);
            if(!has)
            {
                $(this).addClass("chosen");
            }
            updateMedications(this);
        });

        $(".unhelpful").on("click", function()
        {
            var has = $(this).hasClass("chosen");
            clearToggle(this);
            if(!has)
            {
                $(this).addClass("chosen");
            }
            updateMedications(this);
        });

        $(".deleteButton").on("click", function()
        {
            try
            {
                var listItem = $(this);
                while(!listItem.hasClass("medicationItem"))
                {
                    listItem = listItem.parent();
                }
                var container = listItem
                while(!container.hasClass("checkable"))
                {
                    container = container.parent();
                }
                update(container.attr("data-keyletter") + "." + listItem.find(".box").attr("data-keynum"), '');
                listItem.remove();
            }
            catch(e)
            {
                debug(e.message);
            }
        });

        $(".toggleOpen").on("click", function()
        {
            $(".ui-content").children(".checkable").each(function(index)
            {
                debug(this);
                $(this).trigger('expand');
            });


        });

        $(".toggleClose").on("click", function()
        {
            $(".ui-content").children(".checkable").each(function(index)
            {
                debug(this);
                $(this).trigger('collapse');
            });
        });
    });

    $('#page').on("pageinit", function(event)
    {

        $(".addMedication").click(function()
        {
            var container = $(this);
            while(!container.hasClass("checkable"))
            {
                container = container.parent();
            }
            var ul = $('ul.unstyled');
            var d = new Date();
            var newElement = "";
            newElement += '<li class="medicationItem ui-li ui-li-static ui-btn-up-c ui-first-child ui-last-child"><div data-keynum="' + d.getTime() + '"class="box ui-field-contain ui-body ui-br" data-role="fieldcontain" style="display:block;"><div data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-icon="delete" data-iconpos="notext" data-theme="c" data-inline="true" data-mini="true" data-disabled="false" title="" class="ui-btn ui-btn-up-c ui-shadow ui-btn-corner-all ui-mini ui-btn-inline ui-btn-icon-notext" aria-disabled="false"><span class="ui-btn-inner"><span class="ui-btn-text"></span><span class="ui-icon ui-icon-delete ui-icon-shadow">&nbsp;</span></span><button class="deleteButton ui-btn-hidden" data-mini="true" data-inline="true" data-iconpos="notext" data-icon="delete" data-disabled="false"></button></div><div class="ui-input-text ui-shadow-inset ui-corner-all ui-btn-shadow ui-body-c"><input class="changemeds ui-input-text ui-body-c" placeholder="Name of Medication" type="text" value=""></div><div style="display:inline-block"><div data-corners="false" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-theme="c" data-inline="true" data-disabled="false" class="ui-btn ui-btn-up-c ui-shadow ui-btn-inline" aria-disabled="false"><span class="ui-btn-inner"><span class="ui-btn-text">Helpful</span></span><button class="helpful toggle ui-btn-hidden" data-inline="true" data-corners="false" data-disabled="false">Helpful</button></div><div data-corners="false" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-theme="c" data-inline="true" data-disabled="false" class="ui-btn ui-btn-up-c ui-shadow ui-btn-inline" aria-disabled="false"><span class="ui-btn-inner"><span class="ui-btn-text">Not Helpful</span></span><button class="unhelpful toggle ui-btn-hidden" data-inline="true" data-corners="false" data-disabled="false">Not Helpful</button></div></div></div></li>';
            ul.append(newElement);
        });

        $('#testMed').autocomplete({
            source: medicationValues,
            minLength: 1,
            select: function (event, ui) {debug('selected');}
        });
    });
</script>


<div>
    <table>
        <tr>
            <td>
                <div data-role="fieldcontain" class="ui-hide-label" style="width:0px">
                     <input type="hidden" name="ptrac" id="ptrac" value="<?php echo $ptracid;?>"/>
                 </div>
            </td>
            <td>
                <button data-inline="true" class="toggleOpen">Expand All</button>
            </td>
            <td>
                <button data-inline="true" class="toggleClose">Collapse All</button>
            </td>
            <td>
                <a data-role="button" data-inline="true" href="/rapport/index/<?php echo $ptracid;?>/print">Print</a>
            </td>
        </tr>
    </table>

    <h1>Patient Name</h1>
</div>

<div class="checkable" data-keyletter="a" data-role="collapsible">
    <h3>Call Info <span class="checkImage"></span></h3>
    <div>
        <label for="caller">Caller: </label>
        <input data-keynum="1" class="changeable" type="text" name="caller" id="caller" value="<?php if(isset($data['a.1'])) echo $data['a.1']; ?>" placeholder="Caller"/>
    </div>

    <div>
    <fieldset data-role="controlgroup" data-type="horizontal">
        <legend>Date of Call:</legend>

        <label for="select-choice-month-dc">Month</label>
        <select class="changeable" data-keynum="2" name="select-choice-month-dc" id="select-choice-month-dc">
            <?php
            $months = array('jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec');
            foreach($months as $k=>$v)
            {
                $uppercase = ucfirst($v);
                echo "<option value='$v'";
                if(!empty($data['a.2']) && $v == substr($data['a.2'], 0, strpos($data['a.2'], '/')))
                {
                    echo " selected='selected'";
                }
                echo ">$uppercase</option>\n";
            }

            ?>
        </select>

        <label for="select-choice-day-dc">Day</label>
        <select class="changeable" data-keynum="2" name="select-choice-day-dc" id="select-choice-day-dc">
            <?php
            for($i=1; $i<=31; $i++)
            {
                echo "<option value='$i'";
                if(!empty($data['a.2']) && $i == substr($data['a.2'], strpos($data['a.2'], '/') + 1, strpos($data['a.2'], '/', 1)))
                {
                    echo " selected='selected'";
                }
                echo ">$i</option>";
            }
            ?>
        </select>

        <label for="select-choice-year-dc">Year</label>
        <select class="changeable" data-keynum="2" name="select-choice-year-dc" id="select-choice-year-dc">
            <?php
            $y = date("Y",time());
            for($i=$y; $i>=2011; $i--)
            {
                echo "<option value='$i'";
                if(!empty($data['a.2']) && $i == substr($data['a.2'], strrpos($data['a.2'], '/') + 1))
                {
                    echo " selected='selected'";
                }
                echo ">$i</option>";
            }
            ?>
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
        <?php
            $months = array('jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec');
            foreach($months as $k=>$v)
            {
                $uppercase = ucfirst($v);
                echo "<option value='$v'";
                if(!empty($data['b.1']) && $v == substr($data['b.1'], 0, strpos($data['b.1'], '/')))
                {
                    echo " selected='selected'";
                }
                echo ">$uppercase</option>\n";
            }

        ?>
        </select>

        <label for="select-choice-day-dob">Day</label>
        <select class="changeable" data-keynum="1" name="select-choice-day-dob" id="select-choice-day-dob">
            <?php
            for($i=1; $i<=31; $i++)
            {
                echo "<option value='$i'";
                if(!empty($data['b.1']) && $i == substr($data['b.1'], strpos($data['b.1'], '/') + 1, strpos($data['b.1'], '/', 1)))
                {
                    echo " selected='selected'";
                }
                echo ">$i</option>";
            }
            ?>
        </select>

        <label for="select-choice-year-dob">Year</label>
        <select class="changeable" data-keynum="1" name="select-choice-year-dob" id="select-choice-year-dob">
            <?php
            $y = date("Y",time());

            for($i=$y; $i>($y-100);$i--)
            {
                echo "<option value='$i'";
                if(!empty($data['b.1']) && $i == substr($data['b.1'], strrpos($data['b.1'], '/') + 1))
                {
                    echo " selected='selected'";
                }
                echo ">$i</option>";
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
            <?php
            for($i=3; $i<9;$i++)
            {
                echo "<option value='$i'";
                if(!empty($data['b.2']) && $i == substr($data['b.2'], 0, strrpos($data['b.2'], '/')))
                {
                    echo " selected='selected'";
                }
                echo ">$i</option>";
            }
            ?>
        </select>

        <label for="select-choice-in">Inch</label>
        <select class="changeable" data-keynum="2" name="select-choice-in" id="select-choice-in">
            <?php
                for($i=1; $i<12; $i++)
                {
                    echo "<option value='$i'";
                    if(!empty($data['b.2']) && $i == substr($data['b.2'], strrpos($data['b.2'], '/') + 1))
                    {
                        echo " selected='selected'";
                    }
                    echo ">$i</option>";
                    }
            ?>

        </select>
    </fieldset>

    </div>

      <label for="weight">Weight Lb</label>
      <input class="changeable" data-keynum="3" type="number" name="weight" id="weight" value="<?php if(isset($data['b.3'])) echo $data['b.3']; ?>" placeholder="Weight Lb"/>

</div>

<div data-keyletter="c" class="checkable" data-role="collapsible">
   <h3>Injury History <span class="checkImage"></span></h3>

            <div>
     <fieldset data-role="controlgroup" data-type="horizontal">
        <legend>Injury Date:</legend>

        <label for="select-choice-month-injury">Month</label>
        <select class="changeable" data-keynum="1" name="select-choice-month-injury" id="select-choice-month-injury">
            <?php
                $months = array('jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec');
                foreach($months as $k=>$v)
                {
                    $uppercase = ucfirst($v);
                    echo "<option value='$v'";
                    if(!empty($data['c.1']) && $v == substr($data['c.1'], 0, strpos($data['c.1'], '/')))
                    {
                        echo " selected='selected'";
                    }
                    echo ">$uppercase</option>\n";
                }
            ?>
        </select>

        <label for="select-choice-day-injury">Day</label>
        <select class="changeable" data-keynum="1" name="select-choice-day-injury" id="select-choice-day-injury">
            <?php
            for($i=1; $i<=31; $i++)
            {
                echo "<option value='$i'";
                if(!empty($data['c.1']) && $i == substr($data['c.1'], strpos($data['c.1'], '/') + 1, strpos($data['c.1'], '/', 1)))
                {
                    echo " selected='selected'";
                }
                echo ">$i</option>";
            }
            ?>
        </select>

        <label for="select-choice-year-injury">Year</label>
        <select class="changeable" data-keynum="1" name="select-choice-year-injury" id="select-choice-year-injury">
            <?php
            $y = date("Y",time());

            for($i=$y; $i>($y-100);$i--)
            {
                echo "<option value='$i'";
                if(!empty($data['c.1']) && $i == substr($data['c.1'], strrpos($data['c.1'], '/') + 1))
                {
                    echo " selected='selected'";
                }
                echo ">$i</option>";
            }
            ?>
        </select>
    </fieldset>
    </div>

    <label for="howdidyourinjuryoccur">How did your injury occur?</label>
    <textarea class="changeable" data-keynum="2" name="howdidyourinjuryoccur" id="howdidyourinjuryoccur"><?php if(isset($data['c.2'])) echo $data['c.2']; ?></textarea>

    <label for="whereisyourpainlocated">Where is your pain located?</label>
    <textarea class="changeable" data-keynum="3" name="whereisyourpainlocated" id="whereisyourpainlocated"><?php if(isset($data['c.3'])) echo $data['c.3']; ?></textarea>

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
       if(isset($data['d.' . ($k*2+1)]))
       {
           echo $data['d.' . ($k*2+1)];
       }
       echo "</textarea>\n";

       echo "<label id='slider-$key-label' class='ui-slider' for='slider-$key'>Did it help?:</label>\n";
       echo "<select id='slider-$key' class='changeable ui-slider-switch' data-keynum='".($k*2+2)."' data-role='slider' name='slider-$key'>\n";
       echo "<option value='no'";
       if(!empty($data['d.' . ($k*2+2)]) && $data['d.' . ($k*2+2)] == 'no')
       {
           echo " selected='selected'";
       }
       echo ">No</option>\n";
       echo "<option value='yes'";
       if(!empty($data['d.' . ($k*2+2)]) && $data['d.' . ($k*2+2)] == 'yes')
       {
           echo " selected='selected'";
       }
       echo ">Yes</option>\n";
       echo "</select>\n";
     echo "</div>\n";

   }
   ?>
</div>

<div data-keyletter="e" class="checkable" data-role="collapsible">
   <h3>What medications have you tried for your pain?<span class="checkImage"></span></h3>
   <div data-role="content">
       <ul class="unstyled" data-role="listview">

       <?php

       $keys = array_keys($data);
       foreach($keys as $k=>$v)
       {
           if(preg_match('#e\.*#', $v))
           {
               ?>
                   <li class="medicationItem">
                   <div class="box" data-role="fieldcontain" data-keynum=<?php echo substr($v, strrpos($v, '.') + 1); ?> style="display:block;">
                       <button class="deleteButton" data-mini="true" data-inline="true" data-iconpos="notext" data-icon="delete"></button>
                       <input class="changemeds" placeholder="Name of Medication" type="text" value="<?php echo substr($data[$v], 0, strpos($data[$v], '/')); ?>"></input>
                       <div style="display:inline-block"><button class="helpful toggle <?php if(substr($data[$v], strpos($data[$v], '/') + 1) == 'helpful') echo " chosen"; ?>" data-inline="true" data-corners="false">Helpful</button>
                       <button class="unhelpful toggle <?php if(substr($data[$v], strpos($data[$v], '/') + 1) == 'unhelpful') echo " chosen"; ?>" data-inline="true" data-corners="false">Not Helpful</button></div>
                </div>
                </li>
           <?php
           }
      }
      ?>


       <li class="medicationItem">
           <div class="box" data-role="fieldcontain" data-keynum=<?php echo time(); ?> style="display:block;">
               <button class="deleteButton" data-mini="true" data-inline="true" data-iconpos="notext" data-icon="delete"></button>
               <input class="changemeds medicationComplete" id='testMed' placeholder="Name of Medication" type="text" value=""></input>
               <div style="display:inline-block"><button class="helpful toggle" data-inline="true" data-corners="false">Helpful</button>
               <button class="unhelpful toggle" data-inline="true" data-corners="false">Not Helpful</button></div>
        </div>
    </li>
   </ul>
   </div>
   <hr>
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="addMedication" data-inline="true" data-theme="e" data-iconpos="notext" data-icon="plus"></button>
</div>

<div data-keyletter="f" class="checkable" data-role="collapsible">
   <h3>Misc. Questions <span class="checkImage"></span></h3>
   <?php
   $questions = array('Have you had any adverse effects from any medications you have trialed? For example: sleepiness, naisea, headaches, etc.', 'Do you have difficulty sleeping as a result of your pain?', 'Do you have a sexual dysfunction as a result of your pain?', 'Have you noticed weight gain since your injury? How much weight gain over what period of time?', 'Have you been told that you are a candidate for surgery for your pain? If so, is this something that you desire, or wish to avoid if possible?');
   foreach($questions as $k=>$v)
   {
     $key = 'question_'  . str_replace(' ', '_', strtolower($v));

     echo "<div data-role='collapsible'>\n";
       echo "<h3>$v</h3>\n";
       echo "<textarea class='changeable' data-keynum='".($k+1)."'name='$key'' id='$key'>\n";
       if(isset($data['f.' . ($k+1)]))
       {
           echo $data['f.' . ($k+1)];
       }
       echo "</textarea>\n";
     echo "</div>\n";
   }
   ?>
</div>

<div data-keyletter="g" class="checkable" data-role="collapsible">
   <h3>Does the pain make it hard for you to: <span class="checkImage"></span></h3>
   <table style="width:100%;">
   <?php
   $effects = array('Dress', 'Groom', 'Bathe', 'Do home duties', 'Provide childcare', 'Work', 'Spend time with family', 'Enjoy life', 'Sit', 'Stand', 'Lift/carry');
   foreach($effects as $k=>$v)
   {
     $key = 'effect_'  . str_replace(' ', '_', strtolower($v));
     echo "<tr><div class='box' data-role='fieldcontain' style='display:block;'>";
     echo "<td><h3>$v:</h3></td>";
     echo "<td><select data-keynum='".($k+1)."' style='position:relative;float:right;' id='slider-$key-difficulties' data-mini='true' class='changeable ui-slider-switch' data-role='slider' name='slider-$key'>\n";
     echo "<option value='no' ";
     if(!empty($data['g.' . ($k + 1)]) && $data['g.' . ($k + 1)] == 'no')
     {
         echo "selected='selected'";
     }
     echo ">No</option>\n";
     echo "<option value='yes' ";
     if(!empty($data['g.' . ($k + 1)]) && $data['g.' . ($k + 1)] == 'yes')
     {
         echo "selected='selected'";
     }
     echo ">Yes</option>\n";
     echo "</select></td>\n";
     echo "</div></tr>";
   }
   ?>
   </table>
</div>

<div data-keyletter="h" class="checkable" data-role="collapsible">
   <h3>What are your goals? <span class="checkImage"></span></h3>
   <table style="width:100%;">
   <?php
   $goals = array('Increase your function', 'Medication reduction/optimization', 'Be independent in your daily life', 'Return to work', 'Case resolution', 'MMI status');
   foreach($goals as $k=>$v)
   {
     $key = 'goals_'  . str_replace(' ', '_', strtolower($v));
     echo "<tr><div class='box' data-role='fieldcontain' style='display:block;'>";
     echo "<td><h3>$v:</h3></td>";
     echo "<td><select data-keynum='".($k+1)."' style='position:relative;float:right;' id='slider-$key-difficulties' data-mini='true' class='changeable ui-slider-switch' data-role='slider' name='slider-$key'>\n";
        echo "<option value='no' ";
     if(!empty($data['h.' . ($k + 1)]) && $data['h.' . ($k + 1)] == 'no')
     {
         echo "selected='selected'";
     }
     echo ">No</option>\n";
     echo "<option value='yes' ";
     if(!empty($data['h.' . ($k + 1)]) && $data['h.' . ($k + 1)] == 'yes')
     {
         echo "selected='selected'";
     }
     echo ">Yes</option>\n";
     echo "</select></td>\n";
     echo "</div></tr>";
   }
   ?>

   <tr>
       <td><h3>Other</h3></td>
       <td><textarea class="changeable" data-keynum="7"><?php if(isset($data['h.7'])) echo $data['h.7']; ?></textarea></td>
   </tr>
   </table>
</div>

<div data-keyletter="i" class="checkable" data-role="collapsible">
   <h3>Do you have any of these as a result of your injury/pain? <span class="checkImage"></span></h3>
   <table style="width:100%;">
   <?php
   $pains = array('Anger', 'Fear that you will re-injure yourself', 'Unhealthy ways of coping with your pain, ie:alcohol, illicit drugs, etc', 'Mood disturbance', 'Depression', 'Irritability', 'Emotional distress', 'Somatic preoccupation');
   foreach($pains as $k=>$v)
   {
     $key = 'pain_'  . str_replace(' ', '_', strtolower($v));
     echo "<tr><div class='box' data-role='fieldcontain' style='display:block;'>";
     echo "<td><h3>$v:</h3></td>";
     echo "<td><select data-keynum='".($k+1)."' style='position:relative;float:right;' id='slider-$key-difficulties' data-mini='true' class='changeable ui-slider-switch' data-role='slider' name='slider-$key'>\n";
     echo "<option value='no' ";
     if(!empty($data['i.' . ($k + 1)]) && $data['i.' . ($k + 1)] == 'no')
     {
         echo "selected='selected'";
     }
     echo ">No</option>\n";
     echo "<option value='yes' ";
     if(!empty($data['i.' . ($k + 1)]) && $data['i.' . ($k + 1)] == 'yes')
     {
         echo "selected='selected'";
     }
     echo ">Yes</option>\n";
     echo "</select></td>\n";
     echo "</div></tr>";
   }
   ?>
   </table>
</div>