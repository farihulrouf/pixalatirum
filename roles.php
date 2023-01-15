<?php include("header.php");
if($rank !== "admin"){
    echo "No access";
} else {
$query = 0;


  if(isset($_POST["c"])){
	$stmt = $mysqli->prepare("INSERT INTO roles(role_name) VALUES(?)");
    $stmt->bind_param("s", $_POST["c"]);
    $stmt->execute();
	$stmt->close();
  }
    if(isset($_POST["delete"])){
	$stmt = $mysqli->prepare("DELETE FROM roles WHERE id= ?");
    $stmt->bind_param("s", $_POST["delete"]);
    $stmt->execute();
	$stmt->close();
  }



if(isset($_POST["id"]) && isset($_POST["role"])){
	$stmt = $mysqli->prepare("UPDATE users SET role_name = ?  WHERE id = ?");
	$stmt->bind_param("si", $_POST["role"], $_POST["id"]);
	$stmt->execute();
	$stmt->close();
	
}
if(isset($_POST["de"])){
    	$stmt = $mysqli->prepare("DELETE FROM users WHERE id= ?");
    $stmt->bind_param("s", $_POST["de"]);
    $stmt->execute();
	$stmt->close();
    
}
if(isset($_POST["reset"]) && isset($_POST["password"])){
 $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);	
 	$stmt = $mysqli->prepare("UPDATE users SET password = ?  WHERE id = ?");
	$stmt->bind_param("si", $hash, $_POST["reset"]);
	$stmt->execute();
	$stmt->close();   
}
if(isset($_POST["increase"]) && isset($_POST["days"])){
	$time = time();
	$stmt = $mysqli->prepare("SELECT sub_value, role_name, user_limit FROM users WHERE id = ?");
    $stmt->bind_param("s", $_POST["increase"]);
    $stmt->execute();
    $stmt->bind_result($sub_value, $role, $limit);
    $stmt->fetch();
    $stmt->close();	
    if($sub_value > $time){ /* Active */
    $new = $_POST["days"] * 60 * 60 * 24 + $sub_value;
    $stmt = $mysqli->prepare("UPDATE users SET sub_value = ? WHERE id = ?");
    $stmt->bind_param("ss", $new, $_POST["increase"]);
    $stmt->execute();	
	$stmt->close();    
    } else { /* Inactive */
    $new = $_POST["days"] * 60 * 60 * 24 + $time;
    $stmt = $mysqli->prepare("UPDATE users SET sub_value = ? WHERE id = ?");
    $stmt->bind_param("ss", $new, $_POST["increase"]);
    $stmt->execute();	
	$stmt->close();       
    }
}
if(isset($_POST["decrease"]) && isset($_POST["days"])){
	$time = time();
	$stmt = $mysqli->prepare("SELECT sub_value, role_name, user_limit FROM users WHERE id = ?");
    $stmt->bind_param("s", $_POST["decrease"]);
    $stmt->execute();
    $stmt->bind_result($sub_value, $role, $limit);
    $stmt->fetch();
    $stmt->close();	
    if($sub_value > $time){ /* Active */
    $new = $sub_value - $_POST["days"] * 60 * 60 * 24;
    $stmt = $mysqli->prepare("UPDATE users SET sub_value = ? WHERE id = ?");
    $stmt->bind_param("ss", $new, $_POST["decrease"]);
    $stmt->execute();	
	$stmt->close();    
    } else { /* Inactive */
    $new = $time - $_POST["days"] * 60 * 60 * 24;
    $stmt = $mysqli->prepare("UPDATE users SET sub_value = ? WHERE id = ?");
    $stmt->bind_param("ss", $new, $_POST["decrease"]);
    $stmt->execute();	
	$stmt->close();       
    }
}

 ?>

 <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 col-md-12">
					<h6 class="text-uppercase">Users</h6>
				<hr class="mt-5">
                    <div class="card">
                        <div class="card-body">
							<div class="table-responsive">
                           <table id="example" class="table table-borderless">
   <thead>
 <tr>
         <th>User ID</th>
		 <th>Username</th>
		 <th>Subscription</th>
		 <th>Role</th>
		 <th>UG</th>
		 <th>Email</th>
		 <th>Change Plan</th>
		  <th>Delete Account</th>
		  <th>Pass Changer</th>
		  	  <th>Subscription Days Adder</th>
		  	   <th>Account Banner</th>
		  	   	   <th>Edit Limit</th>
		  	   
      </tr>
   </thead>
   <tbody>
   <?php
    $stmt = $mysqli->prepare("SELECT * from users");
    $stmt->execute();
    $result = $stmt->get_result();
    $kah  = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
	    $stmt = $mysqli->prepare("SELECT * from roles");
    $stmt->execute();
    $result = $stmt->get_result();
    $kah2  = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
	foreach($kah as $data){
	?>
	<tr>
	<td><?= $data["id"]; ?></td>
	<td><?= $data["username"]; ?></td>
	<td><?php $time = time(); $stmt = $mysqli->prepare("SELECT sub_value FROM users WHERE username = ?"); $stmt->bind_param("s", $data["username"]); $stmt->execute(); $stmt->bind_result($sub_value); $stmt->fetch(); if($sub_value > $time){ echo "Active"; } else { echo "Inactive"; } $stmt->close(); ?> </td>
	<td><?= $data["role_name"]; ?></td>
	<td><?= $data["rank"]; ?></td>
		<td><?= $data["recovery_code"]; ?></td>
	<td><button class="btn btn-light"  data-bs-toggle="modal" data-bs-target="#edit<?= $data["id"]; ?>" style="float:right !important;">Change User Plan</button> </td>
	<td><form action="" method="post"><button type="sumbit" class="btn btn-danger" name="de" value="<?= $data["id"]; ?>">Delete Account</button></form></td>
		<td><button class="btn btn-light"  data-bs-toggle="modal" data-bs-target="#reset<?= $data["id"]; ?>" style="float:right !important;">Change Password</button> </td>
			<td><button class="btn btn-light"  data-bs-toggle="modal" data-bs-target="#sub<?= $data["id"]; ?>" style="float:right !important;">Edit subscription</button> </td>
	</tr>
	<?php } ?>
  </tbody>
</table></div>
                        </div>
                    </div>
                </div>
           	   
	 </div>
               
            </div>
			 <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 col-md-12">
					<h6 class="text-uppercase">Roles <button class="btn btn-light"  data-bs-toggle="modal" data-bs-target="#new" style="float:right !important;">New role</button></h6>
				<hr class="mt-5">
                    <div class="card">
                        <div class="card-body">
							<div class="table-responsive">
                           <table id="example2" class="table table-borderless">
   <thead>
 <tr>
         <th>Role ID</th>
		 <th>Role name</th>
		 <th>Action</th>
      </tr>
   </thead>
   <tbody>
   <?php
	foreach($kah2 as $data){
	?>
	<tr>
	<td><?= $data["id"]; ?></td>
	<td><?= $data["role_name"]; ?></td>
	<td><form action="" method="post"><button class="btn btn-light" name="delete" value="<?= $data["id"]; ?>">Delete</button></form></td>
	</tr>
	<?php } ?>
  </tbody>
</table></div>
                        </div>
                    </div>
                </div>
           	   
	 </div>
               
            </div>
        </div>
		   <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"  style="border-bottom:none !important;">
        <h5 class="modal-title" id="exampleModalLabel">New Role</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  <form action="" method="post">
      <div class="modal-body">
        <div class="form-group">
		<label>Role Name</label>
		<input type="text" name="c" placeholder="Premium" class="form-control">
		</div>
      </div>
      <div class="modal-footer" style="border-top:none !important;">
        <button type="submit" class="btn btn-primary">Create</button>
		</form>
      </div>
	  
    </div>
  </div>
</div>
<?php foreach($kah as $data){ ?>

<div class="modal fade" id="edit<?= $data["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"  style="border-bottom:none !important;">
        <h5 class="modal-title" id="exampleModalLabel"><?= $data["username"]; ?>'s role</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  <form action="" method="post">
      <div class="modal-body">
        <div class="form-group">
		<label>Username</label>
		<input type="text" name="username" value="<?= $data["username"]; ?>" class="form-control" disabled>
		</div>
		 <div class="form-group mt-2">
		<label>Role</label>
		<select name="role" class="form-control">
		<?php foreach($kah2 as $data2){ ?>
		<option value="<?= $data2["role_name"]; ?>"><?= $data2["role_name"]; ?></option>
		<?php } ?>
		</select>
      </div>
      <div class="modal-footer" style="border-top:none !important;">
        <button name="id" value="<?= $data["id"]; ?>" type="submit" class="btn btn-primary">Save</button>
		</form>
      </div>
	  
    </div>
  </div>
</div>
</div>
<div class="modal fade" id="reset<?= $data["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"  style="border-bottom:none !important;">
        <h5 class="modal-title" id="exampleModalLabel">Reset password for <?= $data["username"]; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  <form action="" method="post">
      <div class="modal-body">
        <div class="form-group">
		<label>Username</label>
		<input type="text" name="username" value="<?= $data["username"]; ?>" class="form-control" disabled>
		</div>
		        <div class="form-group">
		<label>New password</label>
		<input type="text" name="password" value="" class="form-control">
		</div>
      <div class="modal-footer" style="border-top:none !important;">
        <button name="reset" value="<?= $data["id"]; ?>" type="submit" class="btn btn-primary">Save</button>
		</form>
      </div>
	  
    </div>
  </div>
</div>
</div>
<div class="modal fade" id="sub<?= $data["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"  style="border-bottom:none !important;">
        <h5 class="modal-title" id="exampleModalLabel">Subscription for user :<?= $data["username"]; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  <form action="" method="post">
      <div class="modal-body">
        <div class="form-group">
		<label>Username</label>
		<input type="text" name="username" value="<?= $data["username"]; ?>" class="form-control" disabled>
		</div>
				         <div class="form-group">
		<label>Expiry</label>
		<input type="text" name="ff" disabled value="<?php $time = time(); $stmt = $mysqli->prepare("SELECT sub_value FROM users WHERE id = ?"); $stmt->bind_param("s", $data["id"]); $stmt->execute(); $stmt->bind_result($sub_value); $stmt->fetch();  $timel = date('Y-m-d  H:i', $sub_value); if($sub_value > $time){ echo $timel; } else { echo "0"; } $stmt->close(); ?>" class="form-control">
		</div>
		        <div class="form-group">
		<label>Days</label>
		<input type="number" name="days" value="<?= $data["username"]; ?>" class="form-control">
		</div>
      <div class="modal-footer" style="border-top:none !important;">
        <button name="decrease" value="<?= $data["id"]; ?>" type="submit" class="btn btn-primary">Decrease</button>
        <button name="increase" value="<?= $data["id"]; ?>" type="submit" class="btn btn-primary">Increase</button>
		</form>
      </div>
	  
	  
    </div>
  </div>
</div>
</div>
<?php } ?>
<?php } include("footer.php"); ?>