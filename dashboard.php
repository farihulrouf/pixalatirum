<?php include("header.php"); ?>
   <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="mm-cart-image text-danger">
								<svg class="svg-icon svg-danger mr-4" width="50" height="52" id="h-01" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<rect x="2" y="2" width="20" height="8" rx="2" ry="2"/><rect x="2" y="14" width="20" height="8" rx="2" ry="2"/><line x1="6" y1="6" x2="6.01" y2="6"/><line x1="6" y1="18" x2="6.01" y2="18"/>
								
								</svg>
                                </div>
                                <div class="mm-cart-text">
                                    <h3 class="font-weight-700"><?php $total_lines = 0; $result = $mysqli->query("SELECT SUM(amount_lines) AS count FROM groups");  while($row = $result->fetch_assoc()) {  $total_lines += $row['count'];  } echo  thousandsCurrencyFormat($total_lines); ?></h3>
                                    <p class="mb-0 text-danger">Lines</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="mm-cart-image text-success">
								<svg class="svg-icon svg-success mr-4" width="50" height="52" id="h-02" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
								
								</svg>
                                </div>
                                <div class="mm-cart-text">
                                    <h3 class="font-weight-700"><?php $total_dbs = 0; $result = $mysqli->query("SELECT SUM(amount_combos) AS count FROM groups");  while($row = $result->fetch_assoc()) {  $total_dbs += $row['count'];  } echo  $total_dbs; ?></h3>
                                    <p class="mb-0 text-success">Databases</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-3 col-md-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="mm-cart-image text-primary">
								<svg class="svg-icon svg-primary mr-4" width="50" height="52" id="h-03" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/>
								
								</svg>
                                </div>
                                <div class="mm-cart-text">
                                    <h3 class="font-weight-700">Active</h3>
                                    <p class="mb-0 text-primary">Subscription</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="mm-cart-image text-warning">
                                    <svg class="svg-icon svg-warning mr-4" id="h-04" width="50" height="52" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <polyline points="8 17 12 21 16 17"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.88 18.09A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.29"/>
                                    </svg>
                                </div>
                                <div class="mm-cart-text">
                                    <h2 class="font-weight-700"><?php 
	$date = date("Y-m-d");								
	$stmt = $mysqli->prepare("SELECT * FROM downloads WHERE date_downloaded = ? AND username = ?"); 
	$stmt->bind_param("ss", $date, $_SESSION["username"]);
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows();
	$stmt->close();
	echo $rows;
	?>/<?= $limit; ?></h2>
                                    <p class="mb-0 text-warning">Downloads</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		 <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card card-block card-stretch card-height">
					     <div class="card-header">
	 <h4 class="card-title">Groups</h4>
	   
	 </div>
                        <div class="card-body">
                           <table class="table table-borderless " >
   <thead>
 <tr>
         <th>Name</th>
         <th>Lines</th>
         <th>Databases</th>
         <th style="width:15%;">Action</th>
      </tr>
   </thead>
   <tbody>
   <?php 
      $stmt = $mysqli->prepare("SELECT * FROM groups");
    $stmt->execute();
    $result = $stmt->get_result();
    $kah  = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
   
		 foreach($kah as $data){ 
   ?>
<tr>
<td><?= $data["group_name"]; ?></td>
<td><?= $data["amount_lines"]; ?></td>
<td><?= $data["amount_combos"]; ?></td>
<td><a href="group?id=<?= $data["id"]; ?>" class="btn btn-primary btn-block">View</td>
</tr>
<?php  }            ?>
</tbody>
</table>
                        </div>
                    </div>
                </div>
           
               
            </div>
        </div>
 <?php include("footer.php"); ?>