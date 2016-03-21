<?php
require_once 'init_page.php';
?>
<!DOCTYPE html />
<html>
<head>
	<title>Ledger Summary</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="ledgercss.css">
</head>
<body>

<header>
<h2>SUMMARY</h2>
</header>

<nav>
	<?php
	include "navcontents.html";
	?>
</nav>

<section>
<h3>Summary:</h3>
<?php
//connect to database
$connection=new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($connection->connect_error) die ($connection-> error);
//list accounts
$query="SELECT * FROM accounts";
$result=$connection->query($query);
if (!$result) die ($connection->error);
$numrows=$result->num_rows;
echo'<table>';
echo'<caption>Account Summary</caption>';
echo'<tr><th>Account Name</th><th>Account Type</th><th>Balance</th></tr>';
for ($i=0 ; $i<$numrows ; ++$i)
{
	$result->data_seek($i);
	$row=$result->fetch_array(MYSQLI_ASSOC);
	$accounttype=accttype_plaintext($row['type']);
	echo'<tr><td>'.$row['acctname'].'</td><td style="text-align:center">'.$accounttype.'</td><td style="text-align:right">$ '.$row['balance'].'</td></tr>';
}
echo"</table>";
$result->close();

//show cashflow
$query="SELECT * FROM transactions";
$result=$connection->query($query);
if (!$result) die ($connection->error);
$numrows=$result->num_rows;
echo'<br><br><table>';
echo'<caption>Cashflow Summary</caption>';
echo'<tr><th>30 days</th><th>90 days</th><th>365 days</th><th>Year-To-Date</th></tr>';
for ($i=0 ; $i<$numrows ; ++$i)
{
	$result->data_seek($i);
	$row=$result->fetch_array(MYSQLI_ASSOC);
}
echo'<tr><th>Income</th><td style="text-align:right">'.$i30.'</td><td style="text-align:right">'.$i90.'</td><td style="text-align:right">$ '.$i365.'</td><td style="text-align:right">$ '.$iytd.'</td></tr>';
echo'<tr><th>Expenses</th><td style="text-align:right">'.$e30.'</td><td style="text-align:right">'.$e90.'</td><td style="text-align:right">$ '.$e365.'</td><td style="text-align:right">$ '.$eytd.'</td></tr>';
echo'<tr><th>Income</th><td style="text-align:right">'.$i30-$e30.'</td><td style="text-align:right">'.$i90-$e90.'</td><td style="text-align:right">$ '.$i365-$e365.'</td><td style="text-align:right">$ '.$iytd-$eytd.'</td></tr>';
echo'</table>';
$result->close();$connection->close();
?>
</section>

<footer>
	<?php
	include "footcontents.html";
	?>
</footer>

</body>
</html>