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
<div class="col-xs-12 col-lg-12">
    <div class="card">
                <form action="" method="post">
        <div class="card-body">
    <div class="row">

    <div class="col-xs-12 col-lg-12">
        <div class="form-group">
            <label>Old password:</label>
            <input type="text" name="old" class="form-control">
        </div>
        
    </div>
    <div class="col-xs-12 col-lg-6">
        <div class="form-group">
            <label>New password:</label>
            <input type="text" name="new" class="form-control">
        </div>
        
    </div> 
     <div class="col-xs-12 col-lg-6">
        <div class="form-group">
            <label>Confirm password:</label>
            <input type="text" name="con" class="form-control">
        </div>
        
    </div>
</div>
<button type="sumbit" class="btn btn-primary mt-3">Change My Password</button>
</form>
</div>

</div></div>
<?php include("footer.php"); ?>