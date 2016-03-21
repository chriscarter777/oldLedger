<?php
require_once 'init_page.php';
?>
<!DOCTYPE html />
<html>
<head>
	<title>Ledger Accounts</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="ledgercss.css">
</head>
<body>

<header>
<h2>ACCOUNTS</h2>
</header>

<nav>
	<?php
	include "navcontents.html";
	?>
</nav>

<section>
<h3>Accounts:</h3>
<p> ...Account list...</p>
<br>
<h3>Add new account:</h3>
<form type="post"; action="categories.php">
<pre>
Name: <input type="text" name="newcat">
           Bank Account<input type="radio" name="a_type" value="Bank">
    Other Asset Account<input type="radio" name="a_type" value="Asset">
                 Credit<input type="radio" name="a_type" value="Credit">
Other Liability Account<input type="radio" name="a_type" value="Liabilty">
            Payor/Payee<input type="radio" name="a_type" value="Payee">
			
                   <input type="submit"; value="ADD">
</pre>
</form>
</section>

<footer>
	<?php
	include "footcontents.html";
	?>
</footer>

</body>
</html>