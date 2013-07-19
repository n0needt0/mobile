<script>
	window.onload = function()
	{
		window.print();
	}
</script>

<h1>Data for: Greg Smith</h1>
<hr align="left" style="width:40%;">
<h2>Call Info</h2>
<p><?php echo "Caller Name: " . $data['a.1'] ?></p>
<p><?php echo "Date of Call: " . ucfirst($data['a.2']) ?></p>
<hr align="left" style="width:40%;">
<h2>Patient Info</h2>
<p><?php echo "Date of Birth: " . ucfirst($data['b.1']) ?></p>
<p><?php echo "Height: " . substr($data['b.2'], 0, 1) . "'" . substr($data['b.2'], 1, strlen($data['b.2'])) . '"' ?></p>
<p><?php echo "Weight: " . $data['b.3'] . " pounds" ?></p>
<hr align="left" style="width:40%;">
<h2>Injury History</h2>
<p><?php echo "Injury Date: " . ucfirst($data['c.1']) ?></p>
<p><?php echo "Cause of Injury: " . $data['c.2'] ?></p>
<p><?php echo "Location of Injury: " . $data['c.3'] ?></p>
<hr align="left" style="width:40%;">
<h2>Procedures for Pain</h2>
<?php 
$treatments = array('Surgery', 'Physical Therapy', 'Acupuncture','Chiropractic treatment', 'Injections', 'Other');
foreach($treatments as $k=>$v)
{
	$keynum=($k*2+1);
	$value1=$data['d'. '.' . $keynum];
	$value2=$data['d'. '.' . ($keynum + 1)];
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
	$value1=$data['f'. '.' . $keynum];
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
	$value1=$data['g'. '.' . $keynum];
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
	$value1=$data['h'. '.' . $keynum];
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
	$value1=$data['i'. '.' . $keynum];
	echo "<p>$v: $value1</p>";
}
?>