<?php include("header.php"); ?>

<?php $message = 0;  if(!empty($_POST["old"]) && !empty($_POST["new"]) && !empty($_POST["con"])){ 
$stmt = $mysqli->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $_SESSION["username"]);
$stmt->execute();
$stmt->bind_result($password);
$stmt->fetch();
$stmt->close();
$old = password_hash($_POST["old"], PASSWORD_DEFAULT);	
$new = password_hash($_POST["new"], PASSWORD_DEFAULT);	
if($_POST["new"] == $_POST["con"] && password_verify($_POST["old"], $password)){
$stmt = $mysqli->prepare("UPDATE users SET password = ? WHERE username = ?");
$stmt->bind_param("ss", $new, $_SESSION["username"]);
$stmt->execute();
$message = "Password Changed Successfully!";    
    
} else {
$message = "Confirmation password do not match or wrong old password.";
}	   
    
    
    
    
    
    
}
    ?>
<style>

</style>
    <?php if($message !== 0){ ?>
    <div class="col-xs-12 col-lg-12">
        <div class="alert alert-danger">
            <?= $message; ?>
        </div>
        </div>
        <?php } ?>
<div class="col-lg-12 col-xs-12">
<div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Account Information!</h4>
                     </div>
                  
                  </div>
                  <div class="card-body">
                     
                   <!-- Alert-->   
 <!-- <div class="col-lg-12 col-xs-12 text-center"><div class="alert" style="background:#5B9BD5;"> Make sure to join our new server: https://discord.gg/datacloud</div></div> -->
      <!-- Alert-->
                     <div class="row">
                        <div class="col-sm-3">
                           <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                              <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Account Info</a>
                           </div>
                        </div>
                        <div class="col-sm-9">
                           <div class="tab-content mt-0" id="v-pills-tabContent">
                            							 <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                               
							 <div class="form-group">
							 <label>Account Username:</label>
							  <input type="text" class="form-control" disabled value="<?= $_SESSION["username"]; ?>">
							  </div>
							  
						<!--	   <div class="form-group">
							 <label>Account Banned From Downloading Combos?:</label>
							  <input type="text" class="form-control" disabled value="<?= $banned; ?>">
							  </div> -->
							  
							  <div class="form-group">
							 <label>User Group:</label>
							  <input type="text" class="form-control" disabled value="<?= $rank; ?>">
							  </div>
							  
							   <div class="form-group">
							 <label>Purchased Plan:</label>
							  <input type="text" class="input-group-text" disabled value="<?= $user_role; ?>">
							  </div>
							  
							   <div class="form-group">
							 <label>Expiring On:</label>
							  <input type="text" class="form-control" disabled value="<?php $time = time(); $stmt = $mysqli->prepare("SELECT sub_value FROM users WHERE username = ?"); $stmt->bind_param("s", $_SESSION["username"]); $stmt->execute(); $stmt->bind_result($sub_value); $stmt->fetch();  $timel = date('Y-m-d  H:i', $sub_value); if($sub_value > $time){ echo $timel; } else { echo "0"; } $stmt->close(); ?> ">
							  </div>
							  
							  </div>
							  
                             
                                  
                                
						
                       
							  
                              
							  
							  </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
</div>
<?php include("footer.php"); ?>