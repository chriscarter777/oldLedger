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
?>