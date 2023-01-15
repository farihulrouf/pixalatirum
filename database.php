<?php
$servername='localhost';
$username='datazwdh_shitty';
$password='datazwdh_shitty';
$dbname = "datazwdh_shitty";
$conn=mysqli_connect($servername,$username,$password,"$dbname");
if(!$conn){
die('Could not Connect My Sql:' .mysql_error());
}
?>