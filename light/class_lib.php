<?php
class Database{
var $username;
var $password;
var $domain;
var $datbase;

	function __construct($db_domain='localhost',$db_username='root',$db_password='dfe0c74a',$db_database='employee_db'){
	$this->username=$db_username;
	$this->password=$db_password;
	$this->domain=$db_domain;
	$this->database=$db_database;
	error_reporting(0);
	}

	function connectdb(){
	$connect=mysql_connect($this->domain,$this->username,$this->password)or die(mysql_error());
	$select=mysql_select_db($this->database,$connect) or die(mysql_error());
	return $select;

	}

	function insertdb($db_table,$db_insert,$where=NULL){
	//print_r($db_insert);
	$query="INSERT INTO $db_table SET ";
	foreach($db_insert as $item => $value) {
	 $query .= "$item='$value', ";}
	$query = rtrim($query, ', ');
	if ($where!=NULL)
	$query.=" $where";
//	echo $query;
	$insert_db=mysql_query($query);
	//print_r($insert_db);
	return $insert_db;
	}


	function selectdb($db_table,$parameters='*',$where)
	{
	if ($where==NULL)
	$query="SELECT $parameters FROM $db_table";
	else 
	$query="SELECT $parameters FROM $db_table WHERE $where";
	//echo $query;
	$select_db=mysql_query($query);
	$result = mysql_fetch_array($select_db);
	//print_r($result);
	//echo $query;
	return $result;

	}

	function deletedb($db_table, $where)
	{
	if ($where==NULL)
	$query="DELETE from $db_table";
	else
	$query="DELETE from $db_table WHERE $where";
	$delete_db=mysql_query($query);
	//echo $query;
	return $delete_db;
	}

	function selectdb2($db_table,$parameters,$where=NULL,$orderby)
	{
	//$array=array();
	if ($where==NULL)
	$query="SELECT $parameters FROM $db_table";
	else 
	$query="SELECT $parameters FROM $db_table WHERE $where ORDER BY `".$orderby."` DESC limit 0,1";


	//echo $query;
	$select_db=mysql_query($query);

	$result = mysql_fetch_array($select_db);
	//print_r($result);
	return $result;

	}
	function selectdb3($db_table,$parameters,$where=NULL,$orderby)
	{
	//$array=array();
	if ($where==NULL)
	$query="SELECT $parameters FROM $db_table";
	else 
	$query="SELECT $parameters FROM $db_table WHERE $where ORDER BY `".$orderby."` ASC limit 0,1";


	//echo $query;
	$select_db=mysql_query($query);

	$result = mysql_fetch_array($select_db);
	//print_r($result);
	return $result;

	}
	function selectdb4($db_table,$parameters,$where=NULL)
	{
	//$array=array();
	if ($where==NULL)
	$query="SELECT $parameters FROM $db_table";
	else 
	$query="SELECT sum($parameters) FROM $db_table WHERE $where ";


	//echo $query;
	$select_db=mysql_query($query);

	$result = mysql_fetch_array($select_db);
	//print_r($result);
	return $result;

	}
	function selectdb1($db_table1,$db_table2,$parameters='*',$where=NULL)
	{
	//$array=array();
	if ($where==NULL)
	$query="SELECT $parameters FROM $db_table1,$db_table2";
	else 
	$query="SELECT $parameters FROM $db_table1,$db_table2 WHERE $where";
	//echo $query;
	$select_db=mysql_query($query);

	$desc = array();
	while($result = mysql_fetch_array($select_db))
		array_push($desc,$result);
	return $desc;

	}
	function select_distinct_db($db_table,$parameter)
	{
	$query="SELECT distinct $parameter  FROM $db_table order by $parameter ASC";
	$select_db=mysql_query($query);
	$desc = array();
	while($result = mysql_fetch_array($select_db))
		array_push($desc,$result);
	return $desc;

	}
	function select_distinct_db1($db_table,$parameter,$where)
	{
	$query="SELECT distinct $parameter FROM $db_table WHERE $where ";
	//echo $query;
	$select_db=mysql_query($query);
	$desc = array();
	while($result = mysql_fetch_array($select_db))
		array_push($desc,$result);
	return $desc;

	}

	function select_db($db_table,$parameters='*',$where=NULL)
	{
	$array=array();
	$i=0;
	if ($where==NULL)
	$query="SELECT $parameters FROM $db_table";
	else 
	$query="SELECT $parameters FROM $db_table WHERE $where";
	//echo $query;
	$select_db=mysql_query($query);
	while ($result = mysql_fetch_array($select_db))
	{

	$array[$i]=$result;
	++$i;

	}
           
	return $array;

	}

	function countdb($db_table,$parameters='*',$where=NULL)
	{
	if ($where==NULL)
	$query="SELECT $parameters FROM $db_table";
	else 
	$query="SELECT $parameters FROM $db_table WHERE $where";
	//echo $query;
	$select_db=mysql_query($query);
	$count=mysql_num_rows($select_db);
	return $count;
	}


	function updatedb($db_table,$db_insert,$where=NULL){
	//print_r($db_insert);
	$query="UPDATE $db_table SET ";
	foreach($db_insert as $item => $value) {
	 $query .= "$item='$value', ";}
	$query = rtrim($query, ', ');
	if ($where!=NULL)
	$query.=" WHERE $where";
	//echo $query."<br /><br />";
	$update_db=mysql_query($query);
	return $update_db;
	}

	function searchdb($search,$db_table,$fieldsearch,$fieldname='*')//Fieldsearch is the fields to be searched
	{
	$array=array();	
	$i=0;							//,Fieldname is the output required
	$query="SELECT $fieldname FROM $db_table WHERE $fieldsearch LIKE '$search'";
	//echo $query;
	$select_db=mysql_query($query);
	while ($result = mysql_fetch_array($select_db))
	{

	$array[$i]=$result;
	++$i;

	}
	return $array;
	}

	function selectdbquery($db_table,$parameters='*',$condn)
	{
	//$array=array();
	$query="SELECT $parameters FROM $db_table $condn";
	echo $query; echo "<br />";
	$select_db=mysql_query($query);
	$result = mysql_fetch_array($select_db);
	return $result;

	}


	function logincheck($username,$password){
	$query="SELECT * FROM `login` WHERE `username`='$username' AND `password`='$password'";
	//echo $query;
	$Mquery=mysql_query($query);
	$count=mysql_num_rows($Mquery);
	print_r($count);
	if ($count)
	return 1;
	else return 0;
	}

}

?>
