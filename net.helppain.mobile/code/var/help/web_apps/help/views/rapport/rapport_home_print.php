<script>
	window.onload = function()
	{
		window.print();
	}
</script>

<h1><?php echo $ptrac['summary'];?></h1>
<hr align="left" style="width:40%;">
<h2>Call Info</h2>
<p><?php echo "Caller Name: " . (array_key_exists('a.1', $data) ? $data['a.1'] : "Not filled out") ?></p>
<p><?php echo "Date of Call: " . (array_key_exists('a.2', $data) ? ucfirst($data['a.2']) : "Not filled out") ?></p>
<hr align="left" style="width:40%;">
<h2>Patient Info</h2>
<p><?php echo "Date of Birth: " . (array_key_exists('b.1', $data) ? ucfirst($data['b.1']) : "Not filled out") ?></p>
<p><?php echo "Height: " . (array_key_exists('b.2', $data) ? substr($data['b.2'], 0, 1) . "'" . substr($data['b.2'], 1, strlen($data['b.2'])) . '"' : "Not filled out") ?></p>
<p><?php echo "Weight: " . (array_key_exists('b.3', $data) ? $data['b.3'] . " pounds" : "Not filled out") ?></p>
<hr align="left" style="width:40%;">
<h2>Injury History</h2>
<p><?php echo "Injury Date: " . (array_key_exists('c.1', $data) ? ucfirst($data['c.1']) : "Not filled out") ?></p>
<p><?php echo "Cause of Injury: " . (array_key_exists('c.2', $data) ? $data['c.2'] : "Not filled out") ?></p>
<p><?php echo "Location of Injury: " . (array_key_exists('c.3', $data) ? $data['c.3'] : "Not filled out") ?></p>
<hr align="left" style="width:40%;">
<h2>Procedures for Pain</h2>
<?php
$treatments = array('Surgery', 'Physical Therapy', 'Acupuncture','Chiropractic treatment', 'Injections', 'Other');
foreach($treatments as $k=>$v)
{
	$keynum=($k*2+1);
	$value1=array_key_exists('d'. '.' . $keynum, $data) ? $data['d'. '.' . $keynum] : "Not filled out";
	$value2=array_key_exists('d'. '.' . $keynum + 1, $data) ? $data['d'. '.' . $keynum] : "Not filled out";
	echo "<p>$v: $value1 -> Was it helpful? $value2</p>";
}
?>
<hr align="left" style="width:40%;">
<h2>Medications Used</h2>
<?php
$keys = array_keys($data);
foreach($keys as $k=>$v)
{
	if(preg_match("#e\.*#", $v))
	{
		$medPart = substr($data[$v], 0, strrpos($data[$v], '/'));
		$helpfulpart = substr($data[$v], strrpos($data[$v], '/') + 1);
		echo "<p>Medication: $medPart, which was $helpfulpart.</p>";
	}
}
?>
<hr align="left" style="width:40%;">
<h2>Miscellaneous Questions</h2>
<?php
$questions = array('Have you had any adverse effects from any medications you have trialed? For example: sleepiness, naisea, headaches, etc.', 'Do you have difficulty sleeping as a result of your pain?', 'Do you have a sexual dysfunction as a result of your pain?', 'Have you noticed weight gain since your injury? How much weight gain over what period of time?', 'Have you been told that you are a candidate for surgery for your pain? If so, is this something that you desire, or wish to avoid if possible?');
foreach($questions as $k=>$v)
{
	$keynum=($k+1);
	$value1=array_key_exists('f'. '.' . $keynum, $data) ? $data['f'. '.' . $keynum] : "Not filled out";
	echo "<p>$v $value1</p>";
}
?>
<hr align="left" style="width:40%;">
<h2>Difficulties Associated with Pain</h2>
<?php
$effects = array('Dress', 'Groom', 'Bathe', 'Do home duties', 'Provide childcare', 'Work', 'Spend time with family', 'Enjoy life', 'Sit', 'Stand', 'Lift/carry');
foreach($effects as $k=>$v)
{
	$keynum=($k+1);
	$value1=array_key_exists('g'. '.' . $keynum, $data) ? $data['g'. '.' . $keynum] : "Not filled out";
	echo "<p>$v: $value1</p>";
}
?>
<hr align="left" style="width:40%;">
<h2>Goals</h2>
<?php
$goals = array('Increase your function', 'Medication reduction/optimization', 'Be independent in your daily life', 'Return to work', 'Case resolution', 'MMI status');
foreach($goals as $k=>$v)
{
	$keynum=($k+1);
	$value1=array_key_exists('h'. '.' . $keynum, $data) ? $data['h'. '.' . $keynum] : "Not filled out";
	echo "<p>$v: $value1</p>";
}
?>
<hr align="left" style="width:40%;">
<h2>Side-effects of Pain</h2>
<?php
$pains = array('Anger', 'Fear that you will re-injure yourself', 'Unhealthy ways of coping with your pain, ie:alcohol, illicit drugs, etc', 'Mood disturbance', 'Depression', 'Irritability', 'Emotional distress', 'Somatic preoccupation');
foreach($pains as $k=>$v)
{
	$keynum=($k+1);
	$value1=array_key_exists('i'. '.' . $keynum, $data) ? $data['i'. '.' . $keynum] : "Not filled out";
	echo "<p>$v: $value1</p>";
}
?>