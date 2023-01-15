<?php
include("config.php");
       if(session_status() == PHP_SESSION_NONE){
    session_start();
  }
  if(!isset($_SESSION["username"])){
  	      header("Location: /signin");
  }
if(!empty($_GET["id"])){
	$ab = 0;
	
	
	
	$date = date("Y-m-d");
	$time = time();
	$stmt = $mysqli->prepare("SELECT * FROM downloads WHERE date_downloaded = ? AND username = ?"); 
	$stmt->bind_param("ss", $date, $_SESSION["username"]);
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows();
	$stmt->close();
	$stmt = $mysqli->prepare("SELECT sub_value, role_name, user_limit FROM users WHERE username = ?");
	$stmt->bind_param("s", $_SESSION["username"]);
	$stmt->execute();
	$stmt->bind_result($sub_value, $role_name, $limit);
	$stmt->fetch();
	$stmt->close();
		$stmt = $mysqli->prepare("SELECT downloadable FROM combolists WHERE id = ?");
    $stmt->bind_param("s", $_GET["id"]);
    $stmt->execute();
    $stmt->bind_result($roles);
    $stmt->fetch();
    $stmt->close();	
	$array = json_decode($roles, true);
	foreach($array as $data){
		if($role_name == $data){
			$ab++;
		}
	}
	if($rows >= $limit && $ab == 0){
	header("Location: /index");	
	} else if($sub_value < $time && $ab == 0){
	header("Location: /index");
	} else if($rows <= $limit-1 && $sub_value > $time && $ab !== 0){
	$stmt = $mysqli->prepare("SELECT content,id,combo_name FROM combolists WHERE id = ?");
    $stmt->bind_param("s", $_GET["id"]);
    $stmt->execute();
    $stmt->bind_result($content, $id, $name);
    $stmt->fetch();
    $stmt->close();	
    $stmt = $mysqli->prepare("INSERT INTO downloads(date_downloaded,combo_id,username) VALUES(?, ?, ?)");
    $stmt->bind_param("sss", $date, $_GET["id"], $_SESSION["username"]);
    $stmt->execute();
	header("Content-type: text/plain");
	header("Content-Disposition: attachment; filename=".$name."#".$id."".".txt");
	echo $content;
		
		
	} else {
			header("Location: /index");
	}
	
}
?>