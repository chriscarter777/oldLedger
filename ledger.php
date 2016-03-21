<?php
require_once 'init_page.php';
?>
<!DOCTYPE html />
<html>
<head>
	<title>Ledger View</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="ledgercss.css">
</head>
<body>

<header>
<h2>LEDGER VIEW</h2>
</header>

<nav>
	<?php
	include "navcontents.html";
	?>
</nav>

<section>
	<h3>Ledger...</h3>
	<?php
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