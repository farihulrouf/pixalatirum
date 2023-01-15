<?php include("header.php"); 
if(isset($_POST["delete"]) && $rank == "admin"){
 $stmt = $mysqli->prepare("DELETE FROM combolists WHERE id = ?");
 $stmt->bind_param("s", $_POST["delete"]);
 $stmt->execute();
 $stmt->close();
 $stmt = $mysqli->prepare("SELECT amount_lines FROM combolists WHERE id = ?");
 $stmt->bind_param("s", $_POST["delete"]);
 $stmt->execute();
 $stmt->bind_result($amount_lines);
 $stmt->fetch();
 $stmt->close();
  $stmt = $mysqli->prepare("SELECT amount_lines, amount_combos FROM groups WHERE id = ?");
 $stmt->bind_param("s", $_GET["id"]);
 $stmt->execute();
 $stmt->bind_result($al, $ac);
 $stmt->fetch();
 $stmt->close();
$new_ac = $ac -1;
$new_al = $al - $amount_lines;
$stmt = $mysqli->prepare("UPDATE groups SET amount_combos = ?, amount_lines = ? WHERE id = ?");
$stmt->bind_param("sss", $new_ac, $new_al, $_GET["id"]);
$stmt->execute();
$stmt->close();

}


?>
  <!-- Alert-->   
  <div class="col-lg-12 col-xs-12 text-center"><div class="alert" style="background:#5B9BD5;">INFO!  Make sure to Double Click On Posted Date To See Latest Restocks!</div></div>
      <!-- Alert-->
<section id="basic-datatable">
<?php if($rank !== "admin"){ ?>
  		 <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 col-md-12">
				<h6 class="text-uppercase">Combo group:</h6>
				<hr class="mt-5">
                    <div class="card">

                        <div class="card-body">
							<div class="table-responsive">
                           <table id="example" class="table table-borderless">
   <thead>
 <tr>
 <th>Roles able to download</th>
         <th>Database Name</th>
         <th>Lines</th>
		 <th>Country</th>
		 <th>Type</th>
		<th>Posted Date</th>
		<th></th>
      </tr>
   </thead>
   <tbody>
<?php if(!empty($_GET["id"])){ 
    $stmt = $mysqli->prepare("SELECT id,combo_name, amount_lines, country, created_timestamp, combo_type, downloadable FROM combolists WHERE group_id = ?");
	$stmt->bind_param("s", $_GET["id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $kah  = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
	foreach($kah as $data){
	    $stmt2 = $mysqli->prepare("SELECT COUNT(*) FROM `downloads` WHERE combo_id = ? AND username = ?");
	   $stmt2->bind_param("ss", $data["id"], $_SESSION["username"]);
	  $stmt2->execute();
    $stmt2->bind_result($count);
    $stmt2->fetch();
    $stmt2->close();
    
    $roles = json_decode($data["downloadable"]);
?>
  

<tr>
<td><?= $data["downloadable"]; ?></td>
<td><?= $data["combo_name"]; ?></td>
<td><?= $data["amount_lines"]; ?></td>
<td><i class="font-size-20 text-center flag-icon flag-icon-<?= $data["country"]; ?>"></i></td>
<td><?= $data["combo_type"]; ?></td>
<td><?= $data["created_timestamp"]; ?></td>

<?php 

if (!in_array($user_role, $roles)) { ?>
 <td><button class="btn btn-primary roleError">Download Base</button></td>
    
<?php } else {
    if ($count <= 0) { 

?>

<td><form action="" method="post"><a href="<?php echo $site_url; ?>download?id=<?= $data["id"]; ?>" class="btn btn-primary">Download Base</a></form></td>

<?php } else { ?>

<td><button data-id="<?= $data["id"]; ?>" class="btn btn-primary again">Download Base</a></td>

<?php } } ?>

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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
         $(document).on('click', '.roleError', function(e) {

    Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'You Have No Role Role To Download This File Or Either You Have To Upgrade Your Plan To Download This Base!',
})
     });
     
     
      $(document).on('click', '.again', function(e) { // hia
      const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})
            e.preventDefault();
            var id = $(this).data('id');
            swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You Have Downloaded This Combolist Before!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, download!',
  cancelButtonText: 'No, cancel!!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    window.location.href = "<?php echo $site_url; ?>download?id=" + id
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Everything is fine :)',
      'error'
    )
  }
})
        });
        
        
        $(document).on('click', '.expire', function(e) {
            Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'You do not have an active plan!',
})
            
        });
  </script>
  
  
  
  
  
  
	<?php  } else {  echo "No input selected."; } ?>
<?php } else { ?>


  		 <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 col-md-12">
				<h6 class="text-uppercase">Combo group:</h6>
				<hr class="mt-5">
                    <div class="card">

                        <div class="card-body">
						<div class="table-responsive">
                           <table id="example" class="table table-borderless">
   <thead>
 <tr>
 <th>Roles able to download</th>
         <th>Database Name</th>
         <th>Total Lines</th>
		 <th>Country</th>
		 <th>Base Type</th>
		<th>Posted Date</th>
		<th>Action</th>
		<th>Admin</th>
      </tr>
   </thead>
   <tbody>
<?php if(!empty($_GET["id"])){ 
    $stmt = $mysqli->prepare("SELECT id,combo_name, amount_lines, country, created_timestamp, combo_type, downloadable FROM combolists WHERE group_id = ? ORDER BY id DESC");
	$stmt->bind_param("s", $_GET["id"]);
	$stmt->execute();
    $result = $stmt->get_result();
    $kah  = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
	
	foreach($kah as $data){
	    $stmt2 = $mysqli->prepare("SELECT COUNT(*) FROM `downloads` WHERE combo_id = ? AND username = ?");
	   $stmt2->bind_param("ss", $data["id"], $_SESSION["username"]);
	  $stmt2->execute();
    $stmt2->bind_result($count);
    $stmt2->fetch();
    $stmt2->close();
    
    $roles = json_decode($data["downloadable"]);
    
?>
  

<tr>
<td><?= $data["downloadable"]; ?></td>
<td><?= $data["combo_name"]; ?></td>
<td><?= $data["amount_lines"]; ?></td>
<td><i class="font-size-20 text-center flag-icon flag-icon-<?= $data["country"]; ?>"></i></td>
<td><?= $data["combo_type"]; ?></td>
<td><?= $data["created_timestamp"]; ?></td>

<?php 

if (!in_array($user_role, $roles)) { ?>
 <td><button class="btn btn-primary roleError">Download Base</button></td>
    
<?php } else {
    if ($count <= 0) { 

?>

<td><form action="" method="post"><a href="<?php echo $site_url; ?>download?id=<?= $data["id"]; ?>" class="btn btn-primary">Download Base</a></form></td>

<?php } else { ?>

<td><button data-id="<?= $data["id"]; ?>" class="btn btn-primary again">Download Base</a></td>

<?php } } ?>

<td><form action="" method="post"><button class="btn btn-danger" type="sumbit" name="delete" value="<?= $data["id"]; ?>">Delete This Base</button></form></td>
</tr>
	<?php } ?>
  
  </tbody>
</table>
         </div>               </div>
                    </div>
                </div>
           	   
	 </div>
               
            </div>
        </div>
         <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    
     $(document).on('click', '.roleError', function(e) {

    Swal.fire({
  icon: 'error', 
  title: 'Oops...',
  text: 'You Have No Role Role To Download This File Or Either You Have To Upgrade Your Plan To Download This Base!',
})
     });
     
     
      $(document).on('click', '.again', function(e) { // hia
      const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})
            e.preventDefault();
            var id = $(this).data('id');
            swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You Have Downloaded This Combolist Before!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, download!',
  cancelButtonText: 'No, cancel!!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    window.location.href = "<?php echo $site_url; ?>download?id=" + id
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Everything is fine :)',
      'error'
    )
  }
})
        });
        
        
        $(document).on('click', '.expire', function(e) {
            Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'You do not have an active plan!',
})
            
        });
  </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
  
  
  
  
  
	<?php  } else {  echo "No input selected."; } ?>


  <?php } ?>
  </section>
<?php include("footer.php"); ?>