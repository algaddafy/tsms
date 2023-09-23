<?php 
// DB credentials.
/*$localhost = "localhost";
$username = "bhhhjpbo_sumeetsa";
$password = "JzKj}aTZa9*q";
$dbname = "bhhhjpbo_tailor";*/

$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "tailor";
// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}
?>





