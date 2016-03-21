<?php  //function library for Ledger
function sanitize($string)
{
	if (get_magic_quotes_gpc()) $string=stripslashes($string);
	return htmlentities($string);	
}	
function mysqli_sanitize($connection, $string)
{
	if (get_magic_quotes_gpc()) $string=stripslashes($string);
	return htmlentities($connection->mysql_real_escape_string($string));
}
function tokenize($string)	
{
	$salt="Cstob*";
	return hash('ripemd128', "$salt$string");
}
function get_filters()
{
//first, initialize variables
global $begin_date; $begin_date='';
global $end_date; $end_date='';
global $included_accounts; $included_accounts='';
global $included_categories; $included_categories='';
global $min_amount; $min_amount='';
global $max_amount; $max_amount='';
if (isset($_POST['begdate']) || isset($_POST['enddate']) || isset($_POST['accounts']) || isset($_POST['categories']) || isset($_POST['minamt']) || isset($_POST['maxamt']))
	{
		$begin_date=sanitize($_POST['begdate']);
		$end_date=sanitize($_POST['enddate']);
		$included_accounts=sanitize($_POST['accounts']);
		$included_categories=sanitize($_POST['categories']);
		$min_amount=sanitize($_POST['minamt']);
		$max_amount=sanitize($_POST['maxamt']);		
	}
echo <<<_END
<h3>FILTER PARAMETERS:</h3><form method="post"><pre>
         From date: <input type="date" name="begdate">
           To date: <input type="date" name="enddate">
		
  Include Accounts: <select name="accounts" size="5" multiple="multiple">
  <option value="Savings">Savings</option>
  <option value="Checking">Checking</option>
  <option value="CreditOne">CreditOne</option>
  <option value="Amex">Amex</option>
  <option value="Petsmart">Petsmart</option>
  <option value="Amoco">Amoco</option>
  <option value="Walmart">Walmart</option>
		</select>
		
Include Categories: <select name="categories" size="5" multiple="multiple">
  <option value="Gas">Gas</option>
  <option value="Salary">Salary</option>
  <option value="Medical">Medical</option>
  <option value="Interest">Interest</option>
  <option value="Insurance">Insurance</option>
  <option value="Entertainment">Entertainment</option>
  <option value="Groceries">Groceries</option>
  </select>
		
          Between $ <input type="text" name="minamt">  
              And $ <input type="text" name="maxamt">
			
                    <input type="submit" value="SET FILTER">
</pre>
_END;
//return $begin_date, $end_date, $included_accounts, $included_categories, $min_amount, $max_amount;
}
function db_login($db_hostname, $db_database, $db_username, $db_password)
{
	$connection=new mysqli($db_hostname, $db_username, $db_password, $db_database);
	if ($connection->connect_error) die($connection->connect_error);
}
function accttype_plaintext($accttype)
{
	if ($accttype=='b') $accounttype='bank';
	elseif ($accttype=='a') $accounttype='asset';
	elseif ($accttype=='c') $accounttype='credit';
	elseif ($accttype=='l') $accounttype='liability';
	elseif ($accttype=='r') $accounttype='retirement';
	elseif ($accttype=='s') $accounttype='special';
	return $accounttype;
}
function add_tx()
{
	if (isset($_POST['date']) && isset($_POST['from']) && isset($_POST['to']) && isset($_POST['amount']))
	{}
	echo<<<_END
	<form method="post"><pre>
	Date<input type="date" name=date">
	From<select name=from">
	</select>
	To<select name=date">
	</select>
	Amount $<input type="text" name="amount">
	Comment<input type="text" size="255" name="comment">
	<submit>
	</form>
_END;
}
function delete_tx($id)
{
	$query="DELETE FROM transactions WHERE id='$id'";
	$result=$connection->query($query);
	if (!$result) echo "Transaction delete failed!";
}
function edit_tx ($id)
{
	
}
function login_or_create_db(){
	echo <<<_END
	<br><br><br><br><form type="post"; action="index.php"><pre>
	<h3 style="text-align:center">Ledger Name: <input type="text" name="ledgername" size="24" >
      Password: <input type="password" name="password" size="25">

			 <input type="submit"; value="Login"></h3>
	</pre></form> 
_END;
	echo'one', $_POST['ledgername'];
	if(isset($_POST['ledgername']) && isset($_POST['password'])){
		echo'two';
		$sledgername=sanitize($_POST['ledgername']);
		$spassword=sanitize($_POST['password']);
		if(!mysql_select_db($sledgername)) {  // Ledger does not exist, create new?
			echo'<h3>The Ledger "'.$sledgername.'" does not exist.<br>
			Would you like to create the ledger?</h3>';
			echo'<form action="index.php" method="post">';
			echo'<input type="submit" name="choice"  value="CREATE THIS LEDGER">   
			<input type="submit" name="choice"  value="RETRY LOGIN">';
			echo '</form';
			if(isset($_POST['choice'])){
				if($_POST['choice']='CREATE THIS LEDGER') $connection=create_db($sledgername, $spassword);  //yes
			}
			else login_or_create_db();                                 //no, do not create ledger, retry login
		}
		else{                                  //database exists: try opening with supplied credentials
			$connection=new mysqli($_SESSION['db_host'], $_SESSION['db_username'], $spassword, $sledgername);
			if (!$connection->connect_errno){
				echo'Access denied';
				login_or_create_db();                     //unsuccessful: try again.
			}
			else login_success($connection, $sledgername, $spassword);  //successful
		}
	}
}
function create_db($db_name, $db_password){
			$connection=new mysqli($_SESSION['db_host'], $_SESSION['db_username'], $db_password, $db_name);
			//$query='CREATE DATABASE $db_name';
			//$query='USE $db_name';
			//$query='GRANT ALL ON $db_name.* TO $_SESSION["db_username"] IDENTIFIED BY $db_password';
			$query='CREATE TABLE accounts (id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, name VARCHAR(128), type CHAR(1), balance FLOAT, interest FLOAT) ENGINE MyISAM';
			$result=$connection->query($query);
			$query='CREATE TABLE categories (id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, name VARCHAR(128), type CHAR(1), tax CHAR(1)) ENGINE MyISAM';
			$result=$connection->query($query);
			$query='CREATE TABLE transactions (id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, date DATE, debitacct INT UNSIGNED, creditacct INT UNSIGNED, amount FLOAT, comment VARCHAR(255)) ENGINE InnoDB';			
			$result=$connection->query($query);
			login_success($connection, $sledgername, $spassword);
}
function login_success($connection, $sledgername, $spassword){
	$connection->close();
	$_SESSION['db_dbname']=$sledgername;
	$_SESSION['db_password']=$spassword;
	$_SESSION['auth']='yes';
	'home.php';
}
?>