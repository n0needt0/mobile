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