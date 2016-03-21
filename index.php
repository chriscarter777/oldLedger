<?php
require_once 'init_page.php';
?>
<!DOCTYPE html />
<html>
<head>
	<!--This page logs the user into the database, or creates a new database.-->
	<title>Ledger Login</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="ledgercss.css">
</head>
<body>

<header>
	<h1>MY GENERAL LEDGER - Login</h1>
</header>

<nav>
</nav>

<section>
<?php
$_SESSION['auth']='';             //user not yet authorized
login_or_create_db()
?>
</section>

<footer>
	<?php
	include "footcontents.html";
	?>
</footer>


</body>
</html>