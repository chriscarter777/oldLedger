<?php
require_once 'init_page.php';
?>
<!DOCTYPE html />
<html>
<head>
	<title>Ledger Graphs</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="ledgercss.css">
</head>
<body>

<header>
<h2>GRAPHS</h2>
</header>

<nav>
	<?php
	include "navcontents.html";
	?>
</nav>

<section>
	<?php
	echo <<<_END
	<h3>SELECT GRAPH TYPE:</h3>
	<form action="" method="post"><pre>
	Income Summary<input type="radio" name="g_type" value="1">
	Expense Summary<input type="radio" name="g_type" value="2">
	Income Timeline<input type="radio" name="g_type" value="3">
	Expense Timeline<input type="radio" name="g_type" value="4">
	Cashflow Timeline<input type="radio" name="g_type" value="5">

	<input type="submit" value="GRAPH">
	<pre>
	</form>
	<br><br><br>
_END;
	get_filters();
	?>
</section>

<footer>
	<?php
	include "footcontents.html";
	?>
</footer>

</body>
</html>