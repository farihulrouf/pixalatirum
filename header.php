<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/config.php");  
       if(session_status() == PHP_SESSION_NONE){
    session_start();
  }
    
  if(!isset($_SESSION["username"])){
  	      header("Location: /signin");
  }
  $stmt = $mysqli->prepare("SELECT rank,user_limit,role_name,sub_value FROM users WHERE username = ?");
  $stmt->bind_param("s", $_SESSION["username"]);
  $stmt->execute();
  $stmt->bind_result($rank, $limit, $user_role, $subscription);
  $stmt->fetch();
  $stmt->close();
  $empty = "";
  if($subscription < time()){
      if($user_role == "Ape Max"){
          $stmt = $mysqli->prepare("UPDATE users SET role_name = ? WHERE username = ?");
          $stmt->bind_param("ss", $empty, $_SESSION["username"]);
          $stmt->execute();
          $stmt->close();
      }
          if($user_role == "Ape Normal"){
          $stmt = $mysqli->prepare("UPDATE users SET role_name = ? WHERE username = ?");
          $stmt->bind_param("ss", $empty, $_SESSION["username"]);
          $stmt->execute();
          $stmt->close();
      }  
         if($user_role == "Extreme"){
          $stmt = $mysqli->prepare("UPDATE users SET role_name = ? WHERE username = ?");
          $stmt->bind_param("ss", $empty, $_SESSION["username"]);
          $stmt->execute();
          $stmt->close();
      }  
  }
  

  
?>
<!doctype html>
<html lang="en" class="dark-theme">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Pixars-Cloud #1 HQ Combo cloud">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Chemosh">
	<!--favicon-->
	<link rel="icon" href="" type="image/png" />
	<!--plugins-->
	<link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metismenu.min.css" rel="stylesheet" />
	<link href="flag-icon-css/css/flag-icon.css" rel="stylesheet">
		<style>
  .loader,
        .loader:after {
            border-radius: 50%;
            width: 10em;
            height: 10em;
        }
        .loader {            
            margin: 60px auto;
			margin-top: 250px !important;
            font-size: 10px;
            position: relative;
            text-indent: -9999em;
            border-top: 1.1em solid rgba(255, 255, 255, 0.2);
            border-right: 1.1em solid rgba(255, 255, 255, 0.2);
            border-bottom: 1.1em solid rgba(255, 255, 255, 0.2);
            border-left: 1.1em solid #ffffff;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation: load8 1.1s infinite linear;
            animation: load8 1.1s infinite linear;
        }
        @-webkit-keyframes load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        #loadingDiv {
            position:absolute;;
            top:0;
            left:0;
            width:100%;
            height:100%;
        }
		body{
			overflow:hidden;
		}
	body::-webkit-scrollbar {
    width: 0.3em;
}
 
body::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
}
 
body::-webkit-scrollbar-thumb {
  background-color: darkgrey;
  outline: 1px solid slategrey;
}
	.table-responsive::-webkit-scrollbar {
    width: 0.2em;
}
 
.table-responsive::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
}
 
.table-responsive::-webkit-scrollbar-thumb {
  background-color: darkgrey;
  outline: 1px solid slategrey;
}
.btn {
  line-height: 31px;
  position: relative;
  padding: 5px 22px;
  border: 0;
  margin: 10px;
  cursor: pointer;
  border-radius: 2px;
  text-transform: uppercase;
  text-decoration: none;
  outline: none !important;
  -webkit-transition: 0.2s ease-out;
  -moz-transition: 0.2s ease-out;
  -o-transition: 0.2s ease-out;
  -ms-transition: 0.2s ease-out;
  transition: 0.2s ease-out;
}

.btn i,
.btn-flat i {
  font-size: 1.3rem;
  line-height: inherit;
}

.btn .badge {
  margin-left: 7px;
}

.z-depth-1, .btn, .btn-floating {
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
}

.z-depth-1-half, .btn:hover, .btn-floating:hover {
  box-shadow: 0 5px 11px 0 rgba(0, 0, 0, 0.18), 0 4px 15px 0 rgba(0, 0, 0, 0.15);
}

.btn-default {
  color: #fff;
  background-color: #2BBBAD;
}

.btn-default:hover,
.btn-default:focus {
  background-color: #30cfc0 !important;
  color: #fff !important;
}

.waves-effect {
  position: relative;
  cursor: pointer;
  display: inline-block;
  overflow: hidden;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  -webkit-tap-highlight-color: transparent;
  vertical-align: middle;
  z-index: 1;
  will-change: opacity, transform;
  -webkit-transition: all 0.3s ease-out;
  -moz-transition: all 0.3s ease-out;
  -o-transition: all 0.3s ease-out;
  -ms-transition: all 0.3s ease-out;
  transition: all 0.3s ease-out;
}

.waves-effect .waves-ripple {
  position: absolute;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  margin-top: -10px;
  margin-left: -10px;
  opacity: 0;
  background: rgba(0, 0, 0, 0.2);
  -webkit-transition: all 0.7s ease-out;
  -moz-transition: all 0.7s ease-out;
  -o-transition: all 0.7s ease-out;
  -ms-transition: all 0.7s ease-out;
  transition: all 0.7s ease-out;
  -webkit-transition-property: -webkit-transform, opacity;
  -moz-transition-property: -moz-transform, opacity;
  -o-transition-property: -o-transform, opacity;
  transition-property: transform, opacity;
  -webkit-transform: scale(0);
  -moz-transform: scale(0);
  -ms-transform: scale(0);
  -o-transform: scale(0);
  transform: scale(0);
  pointer-events: none;
}

.waves-effect.waves-light .waves-ripple {
  background-color: rgba(255, 255, 255, 0.45);
}

.waves-effect.waves-red .waves-ripple {
  background-color: rgba(244, 67, 54, 0.7);
}

.waves-effect.waves-yellow .waves-ripple {
  background-color: rgba(255, 235, 59, 0.7);
}

.waves-effect.waves-orange .waves-ripple {
  background-color: rgba(255, 152, 0, 0.7);
}

.waves-effect.waves-purple .waves-ripple {
  background-color: rgba(156, 39, 176, 0.7);
}

.waves-effect.waves-green .waves-ripple {
  background-color: rgba(76, 175, 80, 0.7);
}

.waves-effect.waves-teal .waves-ripple {
  background-color: rgba(0, 150, 136, 0.7);
}

/* Firefox Bug: link not triggered */
a.waves-effect .waves-ripple {
  z-index: -1;
}

span.label.label-pill.label-danger.count {
    margin-bottom: 11%;
    font-size: small;
    color: orangered;
}

.dropdown-menu.dropdown-menu-end.show {
   
    
   
    text-align: center;
  
   
    background-color: #1e1e1eed;
    border: 5px solid transparent;
    border-image: linear-gradient(to bottom right, #b827fc 0%, #2c90fc 25%, #b8fd33 50%, #fec837 75%, #fd1892 100%);
    border-image-slice: 1;
    height: 200px;
    margin: 20px auto;
    width: 200px;
    
}

.swal2-container.swal2-center>.swal2-popup {
    background-color: #181818!important;
}
</style>
	<!-- loader-->
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="assets/css/dark-theme.css" />
	<link rel="stylesheet" href="assets/css/semi-dark.css" />
	<link rel="stylesheet" href="assets/css/header-colors.css" />
			<link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" rel="stylesheet">
	<title>Pixars-Cloud</title>
</head>

<body>

	<!--wrapper-->
	<div class="wrapper" id="content" style="display:none !important;">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="https://media.discordapp.net/attachments/1024406741850525717/1026900448088694966/unknown.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Pixars-Cloud</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="index">
						<div class="parent-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
					
				</li>
			<li>
				<!--	<a href="allgroups">
						<div class="parent-icon"> <i>
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                              </i></i>
						</div>
						<div class="menu-title">All Groups</div>
					</a>
					
				</li>
			<li>-->
				<!--	<a href="Proxies">
						<div class="parent-icon"> <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                              </i></i>
						</div>
						<div class="menu-title">Paid Proxies</div>
					</a> -->
					
				</li>
        <li>
					<a href="cfg">
						<div class="parent-icon"> <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                              </i></i>
						</div>
						<div class="menu-title">Configs</div>
					</a>
					
				</li>
		<li>
					<a  href="javascript:;" class="has-arrow" class="btn btn-default waves-effect waves-light">
						<div class="parent-icon"><i class='bx bx-coin-stack'></i>
						</div>
						<div class="menu-title">Quick Access</div>
					</a>
					<ul>
						  <?php 
      $stmt = $mysqli->prepare("SELECT * FROM groups");
    $stmt->execute();
    $result = $stmt->get_result();
    $kah  = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
   
		 foreach($kah as $data){ 
   ?>
							  <li> <a href="<?php echo $site_url; ?>group?id=<?= $data["id"]; ?>"><i class="bx bx-right-arrow-alt"></i><?= $data["group_name"]; ?></a>
						</li>
		 <?php } ?>

						
						
					</ul>
				</li>
				<li>
			<a href="purchase_sub">
						<div class="parent-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg></i>
						</div>
						<div class="menu-title">Purchase Plan</div>
					</a>
						</li>
				<li>
					<a href="redeem">
						<div class="parent-icon"><i class='bx bx-box'></i>
						</div>
						<div class="menu-title">Redeem</div>
					</a>
					
				</li>
				<li>
					<a href="https://discord.gg/5dNeRsxaN5" target="_blank">
						<div class="parent-icon"><i <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="3"></circle></svg>></i>
						</div>
						<div class="menu-title">Discord Support</div>
					</a>
				</li>
			<!--		<li>
					<a href="chat" target="_blank">
						<div class="parent-icon"><i class="bx bx-support"></i>
						</div>
						<div class="menu-title">Shoutbox System</div>
					</a> -->
				</li>
					<li>
					<a href="Vouch" target="_blank">
						<div class="parent-icon">   <i>
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/> </svg>
                              </i></i>
						</div>
						<div class="menu-title">Vouches/Reviews</div>
					</a>
				</li>
					<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></i>
						</div>
						<div class="menu-title">Settings</div>
					</a>
					<ul>

								    <li class="">
                                  <a href="<?php echo $site_url; ?>settings">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="8"></line></svg> </i> Account Information
                                  </a> 
                              </li>
                              <!--	    <li class="">
                                  <a href="<?php echo $site_url; ?>prx">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6" y2="6"></line><line x1="6" y1="18" x2="6" y2="18"></line></svg> </i> Proxy Information
                                  </a> -->
                              </li>
							  <li class="">
                                  <a  href="<?php echo $site_url; ?>psw" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg> </i> Change Password
                                  </a>
                      </li>
					  							  <li class="">
                                  <a  href="<?php echo $site_url; ?>logout" >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M10 22H5a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h5"></path><polyline points="17 16 21 12 17 8"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> </i> Logout 
                                  </a>
                      </li>
                   

						
						
					</ul>
				</li>
				
				
				  <?php if($rank == "admin"){ ?>
				  
				  
				  
				  
				  
				  		<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-shield'></i>
						</div>
						<div class="menu-title">Admin CP</div>
					</a>
					<ul>

									    <li class="">
                                  <a href="<?php echo $site_url; ?>combo">
                                  <i class="bx bx-right-arrow-alt"></i> Manage Combos
                                  </a>
                              </li>
							  <li class="">
                                  <a  href="<?php echo $site_url; ?>generate" >
                                    <i class="bx bx-right-arrow-alt"></i> Generate keys
                                  </a>
                      </li>
					  							  <li class="">
                                  <a  href="<?php echo $site_url; ?>roles" >
                                    <i class="bx bx-right-arrow-alt"></i> Manage roles
                                  </a>
                     </li>
                        <li class="">
                                  <a  href="<?php echo $site_url; ?>leak" >
                                    <i class="bx bx-right-arrow-alt"></i> AntiLeak
                                  </a>
                      </li>
                        <li class="">
                                  <a  href="<?php echo $site_url; ?>download-logs" >
                                    <i class="bx bx-right-arrow-alt"></i>Check Download Logs
                                  </a>
                      </li>
 </li>
                        <li class="">
                                  <a  href="<?php echo $site_url; ?>News" >
                                    <i class="bx bx-right-arrow-alt"></i> Post Anouncement
                                  </a>

						
						
					</ul>
				</li>
				  
				  
				  
				 
				
				  
				  


                            
					  <?php } ?>

			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		 	<!--start header -->
		<header>
		      <div class="container">
   <nav class="navbar navbar-inverse">
    <div class="container-fluid">
     <div class="navbar-header">
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<div class="search-bar flex-grow-1">
						
					</div>
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center">
							<li class="nav-item mobile-search-icon">
								<a class="nav-link" href="#">	
								</a>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">	
								</a>
							
							</li>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<div class="header-notifications-list">
									</div>
									
								</div>
							
							</li>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><span class="label label-pill label-danger count" style="border-radius:10px;"></span>
								    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
  <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
</svg>
							
								</a>
							
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<div class="header-message-list">
									
									</div>
									
								</div>
							</li>
						</ul>
					</div>
					
				<script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  if($('#subject').val() != '' && $('#comment').val() != '')
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#comment_form')[0].reset();
     load_unseen_notification();
    }
   });
  }
  else
  {
   alert("Both Fields are Required");
  }
 });
 
 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>
			
		</header>
		<!--end header -->
		<!--start header -->
<!--		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<div class="search-bar flex-grow-1">
						
					</div>
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center">
							<li class="nav-item mobile-search-icon">
								<a class="nav-link" href="#">	
								</a>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">	
								</a>
							
							</li>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								    
									
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<div class="header-notifications-list">
									</div>
									
								</div>
								<!--
									<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
  <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
</svg>
							
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<div class="header-message-list">
									
									</div>
									
								</div> 
							
							</li>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
  <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
</svg>
							
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<div class="header-message-list">
									
									</div>
									
								</div>
								
								<script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  if($('#subject').val() != '' && $('#comment').val() != '')
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#comment_form')[0].reset();
     load_unseen_notification();
    }
   });
  }
  else
  {
   alert("Both Fields are Required");
  }
 });
 
 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>

							</li>
						</ul>
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="https://media.discordapp.net/attachments/1022971802617643079/1022985679497597029/icons8-settings-64.png" class="user-img" alt="user avatar">
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
								<li><a class="dropdown-item" href="settings">  <i>
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="8"></line></svg>
                              </i></i><span>Account Information</span></a>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li><a class="dropdown-item" href="psw"> <i>
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                              </i></i></i><span>Change Password</span></a>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li><a class="dropdown-item" href="logout">   <i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M10 22H5a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h5"></path><polyline points="17 16 21 12 17 8"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                              </i></i><span>Logout</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header> -->
		<!--end header -->

		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
			<div class="container-fluid">
<!--<div class="col-12 row m-auto">
        <div class="col-lg-6 col-xs-12 mb-2"><a href="<?= $banner2; ?>"><img src="<?= $banner2link; ?>" style="width:100%;height: 75px;"></a></div>       
        <div class="col-lg-6 col-xs-12"><a href="<?= $banner1; ?>"><img src="<?= $banner1link; ?>"  style="width:100%;height: 75px;"></a></div>
</div> -->
<!--- <div class="col-lg-12 col-xs-12 text-center"><div class="alert" style="background:#5B9BD5;"> Double Click On Date To See New Restocks!.</div></div> -->