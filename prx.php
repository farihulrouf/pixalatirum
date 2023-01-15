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
                        <h4 class="card-title">Proxy Information!</h4>
                         <h4 class="card-title"><a type="button" class="btn btn-light waves-effect waves-light" value="Click" onclick="alert('Backend Is Working Fine')">Check Proxy Backend System</a></h4>
                     </div>
                  
                  </div>
                  <div class="card-body">
                     
                   <!-- Alert-->   
  <div class="col-lg-12 col-xs-12 text-center"><div class="alert" style="background:#5B9BD5;"> Make sure to join our new server: https://discord.gg/datacloud</div></div>
      <!-- Alert-->
                     <div class="row">
                        <div class="col-sm-3">
                           <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                              <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Proxy Info</a>
                           </div>
                        </div>
                        <div class="col-sm-9">
                           <div class="tab-content mt-0" id="v-pills-tabContent">
                            							 <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                               
							 <div class="form-group">
							 <label>Proxy Pool Size:</label>
							  <input type="text" class="form-control" disabled value="<?= $size; ?>">
							  </div>
							  
							   <div class="form-group">
							 <label>Proxy Pool Status:</label>
							  <input type="text" class="form-control" disabled value="<?= $proxy; ?>">
							  </div>
							  
							  <div class="form-group">
							 <label>Backend System:</label>
							  <input type="text" class="form-control" disabled value="<?= $backend; ?>">
							  </div>
							  
							   <div class="form-group">
							 <label>Auth API:</label>
							  <input type="text" class="form-control" disabled value="<?= $auth; ?>">
							  </div>
							  
							   <div class="form-group">
							 <label>Http/S Proxy Status:</label>
							  <input type="text" class="form-control" disabled value="<?= $hh; ?>">
							  </div>
							  
							     <div class="form-group">
							 <label>Socks 5 Proxy Status:</label>
							  <input type="text" class="form-control" disabled value="<?= $ss; ?>">
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