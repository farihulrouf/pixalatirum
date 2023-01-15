<?php include("header.php");
if($rank !== "admin"){
    echo "No access";
} else {
$query = 0;


	    $stmt = $mysqli->prepare("SELECT * from roles");
    $stmt->execute();
    $result = $stmt->get_result();
    $kah2  = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();





 ?>

<div class="col-lg-12 col-xs-12">
<div class="card">
<div class="card-body">
<div class="row">
<div class="col-lg-6 col-xs-12">
<form action="" method="post">
<div class="form-group">
<label> Amount of keys</label>
<input type="text" name="amount" class="form-control">
</div>
<div>
</div>
</div>
<div class="col-lg-6 col-xs-12">
<div class="form-group">
<label> Days Valid</label>
<input type="text" name="days" class="form-control">
</div>
<div>
</div>
</div>
<div class="col-lg-6 col-xs-12 mt-3">
<div class="form-group">
<label> Role</label>
<select name="role" class="form-control">
    <?php foreach($kah2 as $data){ ?>
    <option value="<?= $data["role_name"]; ?>"><?= $data["role_name"]; ?></option>
    <?php } ?>
    </select>
</div>
<div>
</div>
</div>
<div class="col-lg-6 col-xs-12 mt-3">
<div class="form-group">
<label> Role Download limits</label>
<input type="number" name="limit" class="form-control">
</div>
<div>
</div>
</div>
</div>
<button type="sumbit" class="btn btn-primary mt-3">Generate</button>
</form>
</div>
</div>
</div>
<div class="col-lg-12 col-xs-12">
<div class="card">
<div class="card-body">
<div class="row">
<div class="col-lg-12 col-xs-12">
<div class="form-group">
<label> Generated Keys :</label>
<textarea class="form-control"><?php if(!empty($_POST["amount"]) && !empty($_POST["days"]) && isset($_POST["role"]) && isset($_POST["limit"])){
	
$query = 1;	
for($i = 0; $i < $_POST["amount"]; $i++) {
		$n = 10; 				
        $token = bin2hex(random_bytes($n)); 
        $stmt = $mysqli->prepare("INSERT INTO sub_key(key_content, time_value, role_grant, key_limit) VALUES(?, ?, ?, ?)");
		$stmt->bind_param("ssss", $token, $_POST["days"], $_POST["role"], $_POST["limit"]);
		$stmt->execute();
		echo $token, "
";
		
			}
	
	
}
?></textarea>
</div>

</div>
</div>
</div>

<?php } include("footer.php"); ?>