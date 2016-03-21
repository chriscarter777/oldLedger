<?php
require_once 'init_page.php';
?>
<!DOCTYPE html />
<html>
<head>
	<title>Ledger Homepage</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="ledgercss.css">
</head>
<body>

<header>
	<h1>MY GENERAL LEDGER</h1>
</header>

<nav>
	<?php
	include "navcontents.html";
	?>
</nav>

<section>
	<?php
	echo"
	<br><br>
	<h3>Welcome to Ledger, user<span style='color:orange'> $_SESSION['user']</span>, with password<span style='color:orange'> $_SESSION['pw']</span>!</h3>
	<h3>Take control of your finances now!</h3><br>
	<p><span style='color:blue'>HOME </span> takes you here<p>
	<p><span style='color:blue'>SUMMARY </span> gives you a quick overview of all your accounts, and your recent cashflow<p>
	<p><span style='color:blue'>LEDGER </span> shows you a traditional ledger view of transactions<p>
	<p><span style='color:blue'>GRAPHS </span> allows you to see information about your finances graphically<p>
	<p><span style='color:blue'>REPORTS </span> shows you the same information in report format<p>
	<p><span style='color:blue'>ACCOUNTS </span> is where you manage your accounts, including payees and payors<p>
	<p><span style='color:blue'>CATEGORIES </span> is where you manage categories, to organize your transactions<p>"
	?>
</section>

<footer>
	<?php
	include "footcontents.html";
	?>
</footer>


</body>
</html>