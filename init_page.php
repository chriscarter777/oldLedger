<?php
//
//This code initializes each page in Ledger...
//
//
//Start the session and load the application library
session_start();
require_once 'ledgerfunctionlib.php';
//
//Set some database parameters
$_SESSION['db_host']='localhost';
$_SESSION['db_username']='user';
$_SESSION['auth']='';
//
//Verify that the user is logged in.  If not, go to login page.
if($_SESSION['auth']=='yes') break;
else "index.php";
?>