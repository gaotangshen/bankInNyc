<?php
class mysql{
	public  $host;
	public $user;
	public $passwd;
	public $dbname;
	public $charset;
	//__construct
	function __construct($h,$u,$p,$d,$c){
		$this->host=$h;
		$this->user=$u;
		$this->passwd=$p;
		$this->dbname=$d;
		$this->charset=$c;
		$this->conn();
	}
	function  conn(){
		mysql_connect($this->host,$this->user, $this->passwd) or die("error");
		mysql_select_db($this->dbname)or die("error");
		mysql_query("set names '{$this->charset}'");
	}
	function __destruct(){
		mysql_close();
	}
}