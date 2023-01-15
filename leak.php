<?php include("header.php"); ?>
<?php if($rank !== "admin"){
  	      echo "Access Denied.";
  } else {  
  if(isset($_POST["c"])){
	$stmt = $mysqli->prepare("INSERT INTO groups(group_name) VALUES(?)");
    $stmt->bind_param("s", $_POST["c"]);
    $stmt->execute();
	$stmt->close();
  }
define("UPLOAD_DIR", "./secured");
define("ERROR", "STOP! Error time! I have no idea what caused this." );
  
  
   if (!empty($_FILES["myFile"]) && isset($_POST["name"]) && isset($_POST["id"]) && isset($_POST["lines"]) && isset($_POST["country"]) &&  isset($_POST["type"]) && isset($_POST["role"])) {
   

   $myFile = $_FILES["myFile"];
	$content = file_get_contents($myFile["tmp_name"], UPLOAD_DIR . $myFile["name"]);
	$stmt = $mysqli->prepare("INSERT INTO combolists(group_id, combo_name, content, amount_lines, country, combo_type, downloadable) VALUES(?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $_POST["id"], $_POST["name"], $content, $_POST["lines"], $_POST["country"], $_POST["type"], json_encode($_POST["role"]));
	$stmt->execute();
	$stmt->close();
	$stmt = $mysqli->prepare("SELECT amount_lines, amount_combos FROM groups WHERE id = ?");
	$stmt->bind_param("s", $_POST["id"]);
	$stmt->execute();
	$stmt->bind_result($old_lines, $old_combos);
	$stmt->fetch();
	$stmt->close();
	$new_lines = $old_lines + $_POST["lines"];
	$new_combos = $old_combos + 1;
	$stmt = $mysqli->prepare("UPDATE groups SET amount_lines = ?, amount_combos = ?  WHERE id = ?");
	$stmt->bind_param("sss", $new_lines, $new_combos, $_POST["id"]);
	$stmt->execute();
	$stmt->close();
	
} 




	    $stmt = $mysqli->prepare("SELECT * from roles");
    $stmt->execute();
    $result = $stmt->get_result();
    $kah2  = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
  ?>
   <div class="col-lg-12 col-xs-12">
  
   <div class="card">
     <div class="card-header">
	 <h4 class="card-title"><a type="button" class="btn btn-light waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#new">Refresh Antileak System</a></h4>
	   
	 </div>
  
   

  
   </div>
    <div class="col-lg-12 col-xs-12">
<div class="form-group">
<label>Select Which Users Have Access To This Base?</label>
<?php foreach($kah2 as $data){ ?>
<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="role[]" value="<?= $data["role_name"]; ?>">
									<label class="form-check-label" for="flexSwitchCheckChecked"><?= $data["role_name"]; ?></label>
								</div>
<?php } ?>
</div>
									</div>
   

   </div>
       <div class="col-lg-12 col-xs-12">
   <div class="form-group">
   	<label>Upload Combo file Which You Want To Check For AntiLeak:</label>
                          <input name="myFile" class="form-control form-control-sm" id="formFileSm" type="file">
                        </div>
   </div>
   
   </div>
   </div>
   <div class="card-footer">
      <button type="sumbit" class="btn btn-primary float-right">Sumbit</button>
   </div>
   </form>
   </div>
   </div>
   <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"  style="border-bottom:none !important;">
        <h5 class="modal-title" id="exampleModalLabel">New Group</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  <form action="" method="post">
      <div class="modal-body">
        <div class="form-group">
		<label>Group Name</label>
		<input type="text" name="c" placeholder="Gaming" class="form-control">
		</div>
      </div>
      <div class="modal-footer" style="border-top:none !important;">
        <button type="sumbit" class="btn btn-light waves-effect waves-light">Create</button>
		</form>
      </div>
	  
    </div>
  </div>
</div>
  <?php } 
  
  
  include("footer.php"); ?>