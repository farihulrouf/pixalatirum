<?php include("header.php"); 
$message = 0;
if(!empty($_POST["key"])){
	$stmt = $mysqli->prepare("SELECT key_content FROM sub_key WHERE key_content = ?");
	$stmt->bind_param("s", $_POST["key"]);
	$stmt->execute();
	$stmt->store_result();
	$query = $stmt->num_rows;
	$stmt->close();
	$used = "used";
	if($query == 1){
	$time = time();
	$sql = "SELECT key_status, time_value, role_grant, key_limit FROM sub_key WHERE key_content = ?";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("s", $_POST["key"]);
	$stmt->execute();
	$stmt->bind_result($status, $time_value, $role_grant, $key_limit);
	$stmt->fetch();
	$stmt->close();
	$stmt = $mysqli->prepare("SELECT sub_value, role_name, user_limit FROM users WHERE username = ?");
    $stmt->bind_param("s", $_SESSION["username"]);
    $stmt->execute();
    $stmt->bind_result($sub_value, $role, $limit);
    $stmt->fetch();
    $stmt->close();	
    

    
	if($status == "unused" && $sub_value > $time && $role_grant == $role && $key_limit == $limit){
    $new = $time_value * 60 * 60 * 24 + $sub_value;
	$stmt = $mysqli->prepare("UPDATE sub_key SET key_status = ?,key_user = ? WHERE key_content = ?");
    $stmt->bind_param("sss", $used, $_SESSION["username"], $_POST["key"]);
    $stmt->execute();	
	$stmt->close();
    $stmt = $mysqli->prepare("UPDATE users SET sub_value = ? WHERE username = ?");
    $stmt->bind_param("ss", $new, $_SESSION["username"]);
    $stmt->execute();	
	$stmt->close();
    $message = "Key redemption successful!";	
	} else if($status == "unused" && $sub_value > $time){
	        $message = "You cannot redeem this key because your role/limit is different than the role in the key is giving you. waiting till your subscription ends and try redeeming this.";
	} else  if($status == "unused" && $sub_value < $time){
    $new = $time_value * 60 * 60 * 24 + $time;
	$stmt = $mysqli->prepare("UPDATE sub_key SET key_status = ?, key_user = ? WHERE key_content = ?");
    $stmt->bind_param("sss", $used, $_SESSION["username"], $_POST["key"]);
    $stmt->execute();	
	$stmt->close();	
	$stmt = $mysqli->prepare("UPDATE users SET sub_value = ?, role_name = ?, user_limit = ? WHERE username = ?");
    $stmt->bind_param("ssss", $new, $role_grant, $key_limit, $_SESSION["username"]);
    $stmt->execute();	
	$stmt->close();	
    $message = "Key redemption successful!";	
	} else if($status == "used"){
		$message = "Key already used!";
	}

	} else {
    $message = "Key does not exist.";	
	}		
}


if(isset($_POST['h-captcha-response']) && !empty($_POST['h-captcha-response']))
  {error_reporting(0);

        $secret = '4a29a419-9fe7-4e61-bf72-3fedcc201549';
        $verifyResponse = file_get_contents('https://hcaptcha.com/siteverify?secret='.$secret.'&response='.$_POST['h-captcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success)
        { 
            error_reporting(0);

            $succMsg = 'Your request have submitted successfully.';
        }
        else
        {
            error_reporting(0);

            $errMsg = 'Robot verification failed, please try again.';
        }
   }

?>
<style>
    .iframe-container{
          overflow: hidden;
          padding-top: 56.25%;
          position: relative;
      }
      .iframe-container iframe
      {
          border: 0;
        height: 100%;
    left: 0;
position: absolute;
top: 0;
width: 100%;      }
.bn5 {
  padding: 0.6em 2em;
  border: none;
  outline: none;
  color: rgb(255, 255, 255);
  background: #111;
  cursor: pointer;
  position: relative;
  z-index: 0;
  border-radius: 10px;
}

.bn5:before {
  content: "";
  background: linear-gradient(
    45deg,
    #ff0000,
    #ff7300,
    #fffb00,
    #48ff00,
    #00ffd5,
    #002bff,
    #7a00ff,
    #ff00c8,
    #ff0000
  );
  position: absolute;
  top: -2px;
  left: -2px;
  background-size: 400%;
  z-index: -1;
  filter: blur(5px);
  width: calc(100% + 4px);
  height: calc(100% + 4px);
  animation: glowingbn5 20s linear infinite;
  opacity: 0;
  transition: opacity 0.3s ease-in-out;
  border-radius: 10px;
}

@keyframes glowingbn5 {
  0% {
    background-position: 0 0;
  }
  50% {
    background-position: 400% 0;
  }
  100% {
    background-position: 0 0;
  }
}

.bn5:active {
  color: #000;
}

.bn5:active:after {
  background: transparent;
}

.bn5:hover:before {
  opacity: 1;
}

.bn5:after {
  z-index: -1;
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  background: #191919;
  left: 0;
  top: 0;
  border-radius: 10px;
}

</style>
	 <script src="https://www.hCaptcha.com/1/api.js" async defer></script>
  <!-- Alert-->   
  <div class="col-lg-12 col-xs-12 text-center"><div class="alert" style="background:#5B9BD5;">INFO!  Wait Few Seconds For Purchase Plan Section to Popup!</div></div>
      <!-- Alert-->
<div class="col-lg-12 col-xs-12">
<!-- <div class="alert alert-danger text-center">Your subscription ends in :<?php $time = time(); $stmt = $mysqli->prepare("SELECT sub_value FROM users WHERE username = ?"); $stmt->bind_param("s", $_SESSION["username"]); $stmt->execute(); $stmt->bind_result($sub_value); $stmt->fetch();  $timel = date('Y-m-d  H:i', $sub_value); if($sub_value > $time){ echo $timel; } else { echo "0"; } $stmt->close(); ?>  <br> Your current role is : <?= $user_role; ?></div>-->
                           
</form>
 <div class="row">
   <!-- Free Tier -->
        <div class="col-lg-3 col-xs-12">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">Pixars Weekly</h5>
            <h6 class="card-price text-center">$20/Weekly<span class="period"></span></h6>
            <hr>
            <ul class="fa-ul">
               <li class="text-success"><span class="fa-li"><i class="fas fa-check"></i></span>Premium Combos</li>
              <li class="text-success"><span class="fa-li"><i class="fas fa-check"></i></span>Premium Proxies</li>
              <li class="text-success"><span class="fa-li"><i class="fas fa-check"></i></span>Premium Configs</li>
              <li class="text-success"><span class="fa-li"><i class="fas fa-check"></i></span>Premium AIO</li>
               <li class="text-success"><span class="fa-li"><i class="fas fa-check"></i></span>Restcok After Every 24-48 Hours</li>
                     <li class="text-success"><span class="fa-li"><i class="fas fa-check"></i></span>10 Downloads Daily</li>
              <li class="text-danger"><span class="fa-li"><i class="fas fa-times"></i></span>Reselling Not Allowed</li>		 	 			  
            </ul>
           <a href="https://pixarscloud.sellpass.io/products/-Week-Cloud-Access" target="_blank" class="bn5">Buy This Plan</a>

          </div>
          
        </div>
        
      </div>
        <div class="col-lg-3 col-xs-12">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">Pixars Monthlty</h5>
            <h6 class="card-price text-center">$40/Monthly<span class="period"></span></h6>
            <hr>
            <ul class="fa-ul">
             <li class="text-success"><span class="fa-li"><i class="fas fa-check"></i></span>Premium Combos</li>
              <li class="text-success"><span class="fa-li"><i class="fas fa-check"></i></span>Premium Proxies</li>
              <li class="text-success"><span class="fa-li"><i class="fas fa-check"></i></span>Premium Configs</li>
              <li class="text-success"><span class="fa-li"><i class="fas fa-check"></i></span>Premium AIO</li>               <li class="text-success"><span class="fa-li"><i class="fas fa-check"></i></span>Restcok After Every 24-48 Hours</li>
                     <li class="text-success"><span class="fa-li"><i class="fas fa-check"></i></span>20 Downloads Daily</li>
              <li class="text-danger"><span class="fa-li"><i class="fas fa-times"></i></span>Reselling Not Allowed</li>		 	 			  
            </ul>
              <a href="https://pixarscloud.sellpass.io/products/-Month-Pixars-Cloud" target="_blank" class="bn5">Buy This Plan</a>
          </div>
          
        </div>
        
      </div>
      <div class="col-lg-3 col-xs-12">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">Pixars Daily</h5>
            <h6 class="card-price text-center">$6/Daily<span class="period"></span></h6>
            <hr><ul class="fa-ul">
                <li class="text-success"><span class="fa-li"><i class="fas fa-check"></i></span>Premium Combos</li>
              <li class="text-danger"><span class="fa-li"><i class="fas fa-times"></i></span>Premium Proxies</li>
              <li class="text-danger"><span class="fa-li"><i class="fas fa-times"></i></span>Premium Configs</li>
              <li class="text-danger"><span class="fa-li"><i class="fas fa-times"></i></span>Premium AIO</li>
              <li class="text-danger"><span class="fa-li"><i class="fas fa-times"></i></span>Premium Yahoo Checker</li>
               <li class="text-success"><span class="fa-li"><i class="fas fa-check"></i></span>Restcok After Every 24-48 Hours</li>
                     <li class="text-success"><span class="fa-li"><i class="fas fa-check"></i></span>4 Downloads Daily</li>
              <li class="text-danger"><span class="fa-li"><i class="fas fa-times"></i></span>Reselling Not Allowed</li>		 		 			  
            </ul>
           <a href="https://pixarscloud.sellpass.io/products/-Day-Coud-Access" target="_blank" class="bn5">Buy This Plan</a>
          </div>
    </div>
</div>
</div>
</div>
      <div class="col-lg-12 col-xs-12">

	</div>
	</div>
<?php include("footer.php"); ?>