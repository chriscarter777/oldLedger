<?php
require_once 'init_page.php';
?>
<!DOCTYPE html />
<html>
<head>
	<title>Ledger Reports</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="ledgercss.css">
</head>
<body>

<header>
<h2>REPORTS</h2>
</header>

<nav>
	<?php
	include "navcontents.html";
	?>
</nav>

<section>
<?php
echo <<<_END
<h3>SELECT REPORT TYPE:</h3>
<form action="" method="post"><pre>
     Income and Expense<input type="radio" name="r_type" value="1">
            By Category<input type="radio" name="r_type" value="2">
             By Account<input type="radio" name="r_type" value="3">
                    Tax<input type="radio" name="r_type" value="4">
	 
            <input type="submit" value="GET REPORT">
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