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
<h2>CATEGORIES</h2>
</header>

<nav>
	<?php
	include "navcontents.html";
	?>
</nav>

<section>
<h3>Categories:</h3>
<p> ...Category list...</p>
<br>
<h3>Add new category:</h3>
<form type="post"; action="categories.php">
<pre>
Name: <input type="text" name="newcat">
    Income<input type="radio" name="ie" value="Income"> &emsp; Expense<input type="radio" name="ie" value="Expense" checked="checked">
  Include in tax report<input type="checkbox" name="tax" value="1">

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