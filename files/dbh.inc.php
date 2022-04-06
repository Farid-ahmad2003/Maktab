<?php
$servername = '127.0.0.1:3308';
$dBUsername = 'root';
$dBpassword = 'Passwordisincorrect1';
$databaseName = 'data';

$conn = mysqli_connect($servername,$dBUsername,$dBpassword,$databaseName);
if(!$conn){
	die("Connection failed ".mysqli_connect_error());
}
?>