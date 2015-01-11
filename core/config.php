<?
header("Content-Type: text/html; charset=utf-8");
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//error_reporting(E_ALL);

  $dblocation = "localhost";
  $dbname = "proba";
  $dbuser = "test";
  $dbpasswd = "21081993";

		$link = mysql_connect($dblocation, $dbuser, $dbpasswd) or die("Have not connect with database"); 
		mysql_query("SET CHARACTER SET utf8");
		mysql_query("SET NAMES 'utf8'"); 
		mysql_select_db($dbname);
	

$domain = "http://cms.kinofon.com.ua";
