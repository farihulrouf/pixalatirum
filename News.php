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
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
   <div class="col-lg-12 col-xs-12">
  
   <div class="card">
     <div class="card-header">
	 <h4 class="card-title"><a type="button" class="btn btn-light waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#new">News System</a></h4>
	   
	 </div>
   <br />
   <form method="post" id="comment_form">
    <div class="form-group">
     <label>Enter Subject</label>
     <input type="text" name="subject" id="subject" class="form-control">
    </div>
    <div class="form-group">
     <label>Enter News</label>
     <textarea name="comment" id="comment" class="form-control" rows="5"></textarea>
    </div>
    <div class="form-group">
     <input type="submit" name="post" id="post" class="btn btn-info" value="Post" />
    </div>
   </form>
   <script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  if($('#subject').val() != '' && $('#comment').val() != '')
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#comment_form')[0].reset();
     load_unseen_notification();
    }
   });
  }
  else
  {
   alert("Both Fields are Required");
  }
 });
 
 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>

   

    
  <?php } 
  
  
  include("footer.php"); ?>