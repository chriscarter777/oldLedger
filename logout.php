<?php
require_once 'init_page.php';
?>
<!DOCTYPE html />
<html>
<head>
	<title>Ledger Categories</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="ledgercss.css">
</head>
<body>

<header>
<h2>LOG OUT</h2>
</header>

<nav>
	<?php
	include "navcontents.html";
	?>
</nav>

<section>
<?php
echo <<<_END
<br><br>
<h3 style="text-align:center">Excellent work!  Keep those finances organized!</h3>
<h3 style="text-align:center">Your session is now logged out.</h3>
_END;
session_destroy();
?>
</section>

<footer>
	<?php
	include "footcontents.html";
	?>
</footer>

</body>
</html>