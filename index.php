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
while (!$_SESSION['auth']){
	//get login credentials
	$sledgername='';
	$spassword='';
	echo <<<_END
	<br><br><br><br><form type="post"; action="index.php"><pre>
	<h3>Ledger Name: <input type="text" name="ledgername">
	   Password: <input type="password" name="password">

				 <input type="submit"; value="Login"></h3>
	</pre></form> 
_END;
	$_SESSION['auth']='no';
	if(isset($_POST['ledgername']) && isset($_POST['password'])){
		$sledgername=sanitize($_POST['ledgername']);
		$spassword=sanitize($_POST['password']);
	}
	// If database does not exist, create new?...
	if(!mysql_select_db($sledgername)) {
		echo'<h3>The Ledger "'.$sledgername.'" does not exist.<br>
		Would you like to create the ledger?</h3>';
		echo'<form action="index.php" method="post">';
		echo'<input type="submit" name="choice"  value="CREATE THIS LEDGER">   
		<input type="submit" name="choice"  value="RETRY LOGIN">';
		echo '</form';
		if(isset($_POST['choice'])){
			if($_POST['choice']='CREATE THIS LEDGER'){
				//yes: create database, set session parameters, and proceed to home page
				$connection=new mysqli($_SESSION['db_host'], $_SESSION['db_username'], $spassword, $sledgername);
				//$query='CREATE DATABASE $sledgername';
				//$query='USE $sledgername';
				//$query='GRANT ALL ON $sledgername.* TO $_SESSION["db_username"] IDENTIFIED BY $spassword';
				$query='CREATE TABLE accounts (id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, name VARCHAR(128), type CHAR(1), balance FLOAT, interest FLOAT) ENGINE MyISAM';
				$result=$connection->query($query);
				$query='CREATE TABLE categories (id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, name VARCHAR(128), type CHAR(1), tax CHAR(1)) ENGINE MyISAM';
				$result=$connection->query($query);
				$query='CREATE TABLE transactions (id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, date DATE, debitacct INT UNSIGNED, creditacct INT UNSIGNED, amount FLOAT, comment VARCHAR(255)) ENGINE InnoDB';			
				$result=$connection->query($query);
				$connection->close();
				$_SESSION['db_dbname']=$sledgername;
				$_SESSION['db_password']=$spassword;
				$_SESSION['auth']='yes';
				echo'<h3>Creation of ledger "'.$sledgername.'" was successful.';
				echo'<form action="index.php" method="post">';
				echo'<input type="submit" name="acknowledge"  value="OK">';
				echo'</form>';
				if (isset($_POST['acknowledge'])) "home.php";
			}
			else {
				//no: try again
				break;
			}
		}
	}
	else{
		//database exists: try opening with supplied credentials
		$connection=new mysqli($_SESSION['db_host'], $_SESSION['db_username'], $spassword, $sledgername);
		if (!$connection->connect_errno){
			//unsuccessful: try again.
			echo'Access denied';
			break;
		}
		else{
			//successful: set session parameters and proceed to home page;
			$connection->close();
			$_SESSION['db_dbname']=$sledgername;
			$_SESSION['db_password']=$spassword;
			$_SESSION['auth']='yes';
			"home.php";
		}
	}
}
?>
</section>

<footer>
	<?php
	include "footcontents.html";
	?>
</footer>


</body>
</html>