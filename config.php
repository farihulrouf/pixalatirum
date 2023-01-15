<?php 
$db_host = "localhost";
$db_username = "root";
$db_userpass = "";
$db_name = "pixazodk_world";
$site_url = "http://localhost/pixacloud/";
$mysqli = new mysqli($db_host, $db_username, $db_userpass, $db_name);
$banner1= "";
$banner1link= "";
$banner2= "";
$banner2link= "";
$banned= "Not Banned";
$size= "450K IPS";
$proxy= "Online";
$backend= "Online";
$auth= "Online";
$hh= "Currently Online";
$ss= "Currently Online";


/**************************************/


function thousandsCurrencyFormat($num) {

  if($num>1000) {

        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('K', 'KK', 'b', 't');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];

        return $x_display;

  }

  return $num;
}
/**************************************/
?>