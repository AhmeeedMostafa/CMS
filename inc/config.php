<?php

class con_sql{
	
	private $dbhost, $dbuser, $dbpass;
	
	public function __constructor($host,$user,$pass){
		$this->dbhost = $host;
		$this->dbuser = $user;
		$this->dbpass = $pass;
	}
	
	public function con(){
		#���� ��� �� ����� ������ ���� ��������� ����� ����
		//mysql_connect($this->dbhost,$this->dbuser,$this->dbpass) or die('Error in connect server no: '.mysql_error());
		mysql_connect('localhost','root','root');
	}
	public function selectdb($data){
		mysql_select_db($data) or die('Error in Connect DataBase, no: '.mysql_error());
	}
}

###########################################
$DB_HOST = 'localhost'; #��� �������

$DB_NAME = ''; #��� ����� ��������

$DB_USER = ''; #��� ��������

$DB_PASS = '';#���� ���� ����� ��������

#################

$con = new con_sql($DB_HOST,$DB_USER,$DB_PASS);
$con->con();
$con->selectdb($DB_NAME);
mysql_query("SET NAMES 'utf8'");

error_reporting(E_ALL ^ E_NOTICE);//������ ���� ��������� ��� ������� ������� ��� �������
?>