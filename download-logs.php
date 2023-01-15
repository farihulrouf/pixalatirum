<?php 

include("header.php");
if($rank !== "admin"){
    return "No access";
}

?>

<div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 col-md-12">
					<h6 class="text-uppercase">Download Logs</h6>
				<hr class="mt-5">
                    <div class="card">
                        <div class="card-body">
							<div class="table-responsive">
                           <table id="example3" class="table table-borderless">
   <thead>
 <tr>
		 <th>Username</th>
		 <th>Combo</th>
		 <th>Date Download</th>
		  	   
      </tr>
   </thead>
   <tbody>
   <?php
    $stmt = $mysqli->prepare("SELECT * from downloads order by date_downloaded ASC");
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
	    $stmt = $mysqli->prepare("SELECT combo_name FROM combolists WHERE id = ?");
      $stmt->bind_param("s", $data["combo_id"]);
      $stmt->execute();
      $stmt->bind_result($comboName);
      $stmt->fetch();
      $stmt->close();
	?>
	<tr>

	<td><?= $data["username"]; ?></td>
	<td><?= $comboName; ?></td>
	<td><?= $data["date_downloaded"]; ?></td>
	</tr>
	<?php } ?>
  </tbody>
</table></div>
                        </div>
                    </div>
                </div>
           	   
	 </div>
               
            </div>
            
    <?php include("footer.php"); ?>