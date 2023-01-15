<?php include("header.php"); 
 session_start ();
function loginForm() {
    echo '
	<div class="form-group">
		<div id="loginform">
			<form action="chat" method="post">
		
			
	<div style="clear: both"></div>
				<label for="name">Please enter your Account Username to proceed..</label>
				<input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Username"/>
				<input type="submit" class="btn btn-primary" name="enter" id="enter" value="Enter To ShoutBox" />
			</form>
		</div>
		
	</div>
   ';
}
 
if (isset ( $_POST ['enter'] )) {
    if ($_POST ['name'] != "") {
        $_SESSION ['name'] = stripslashes ( htmlspecialchars ( $_POST ['name'] ) );
        $cb = fopen ( "log.html", 'a' );
        fwrite ( $cb, "<div class='msgln'><i>User " . $_SESSION ['name'] . " has joined the chat session.</i><br></div>" );
        fclose ( $cb );
    } else {
        echo '<span class="error">Please Enter a Name</span>';
    }
}
 
if (isset ( $_GET ['logout'] )) {
    $cb = fopen ( "log.html", 'a' );
    fwrite ( $cb, "<div class='msgln'><i>User " . $_SESSION ['name'] . " has left the chat session.</i><br></div>" );
    fclose ( $cb );
    session_destroy ();
    header ( "Location: index.php" );
}
?>
<style>
    .godlike_rank {
       position: relative;
    letter-spacing: .02em;
    text-shadow: 0.75px 0.75px 7px #b590ff;
    font-weight: 600;
    -webkit-text-fill-color: transparent;
    -webkit-background-clip: border-box,text;
    background-image: url(https://i.imgur.com/Ocwa4cC.gif),repeating-linear-gradient(90deg,#44dbff 25%,#e4ff00 47%,#00ff1d 53%,#44dbff 75%);
    background-size: 7em,10em;
    animation: refund-god-anim 3s linear infinite;
}

.godlike_rank:before{
    background-image: url(https://static.cracked.io/images/refund_god_crown.gif);
    background-size: 100% 100%;
    display: inline-block;
    position: absolute;
    width: 0.7em;
    height: 0.7em;
    left: -0.2em;
    top: -13%;
    transform: rotate(335deg);
    content: '';
}
</style>

 <!-- For Advertising-->   
      <div align="center" class="inner_stuff"><a href="https://shoppy.gg/@PremiumFox" target="_blank"><img loading="lazy" src="https://media.discordapp.net/attachments/979461543190204426/995283946466197534/350kb.gif"> </a><a href="https://discord.gg/P62N8Gfpek" target="_blank"><img loading="lazy" src="https://i.ibb.co/sVgk93M/Signature-VA-XS.gif"> </a></div>
        <!-- For Advertising-->  
        <!-- For Advertising-->   
      <div align="center" class="inner_stuff"><a href="https://discord.gg/jag5tKcwnA" target="_blank"><img loading="lazy" src="https://media.discordapp.net/attachments/1024640206231576607/1026553138364293140/max-res_3.gif"> </a><a href="#" target="_blank"><img loading="lazy" src="https://share.creavite.co/c8EtQHvKwLdPUp3H.gif"> </a></div>
        <!-- For Advertising-->  
    <!-- Alert-->   
  <div class="col-lg-12 col-xs-12 text-center"><div class="alert" style="background:#5B9BD5;">INFO! For Checking Your Subscription Status Go To Account Information!</div></div>
      <!-- Alert-->
   <!-- Alert-->   
 <!--  <div class="col-lg-12 col-xs-12 text-center"><div class="alert" style="background:#5B9BD5;" > For Accessing ShoutBox/Chat System <p class="chat"><a id="chat" href="https://data-cloud.lol/chat" class="btn btn-default">Click Here</a></p> </div></div> -->   
      <!-- Alert-->
   <div class="col-lg-12 mt-3">
   <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                   <div class="col">
					 <div class="card radius-10 border-start border-0 border-3 border-info">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div>
									<p class="mb-0 text-secondary">Total Lines</p>
									<h4 class="my-1 text-info"><?php $total_lines = 0; $result = $mysqli->query("SELECT SUM(amount_lines) AS count FROM groups");  while($row = $result->fetch_assoc()) {  $total_lines += $row['count'];  } echo  thousandsCurrencyFormat($total_lines); ?></h4>
								</div>
								<div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class="bx bxs-server"></i>
								</div>
							</div>
						</div>
					 </div>
				   </div>
				   <div class="col">
					<div class="card radius-10 border-start border-0 border-3 border-info">
					   <div class="card-body">
						   <div class="d-flex align-items-center">
							   <div>
								   <p class="mb-0 text-secondary">Total Databases</p>
								   <h4 class="my-1 text-info"><?php $total_dbs = 0; $result = $mysqli->query("SELECT SUM(amount_combos) AS count FROM groups");  while($row = $result->fetch_assoc()) {  $total_dbs += $row['count'];  } echo  $total_dbs; ?></h4>
							   </div>
							   <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class="bx bxs-coin-stack"></i>
							   </div>
						   </div>
					   </div>
					</div>
				  </div>
				  <div class="col">
					<div class="card radius-10 border-start border-0 border-3 border-info">
					   <div class="card-body">
						   <div class="d-flex align-items-center">
							   <div>
								   <p class="mb-0 text-secondary">Subscription Status </p>
								   	 
								   <h4 class="my-1 text-info"><?php $time = time(); $stmt = $mysqli->prepare("SELECT sub_value FROM users WHERE username = ?"); $stmt->bind_param("s", $_SESSION["username"]); $stmt->execute(); $stmt->bind_result($sub_value); $stmt->fetch(); if($sub_value > $time){ echo "Active"; } else { echo "Inactive"; } $stmt->close(); ?></h4>
								   
							   </div>
							   <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class="bx bxs-user-plus"></i>
							   </div>
						   </div>
					   </div>
					</div>
				  </div>
				  <div class="col">
					<div class="card radius-10 border-start border-0 border-3 border-info">
					   <div class="card-body">
						   <div class="d-flex align-items-center">
							   <div>
								   <p class="mb-0 text-secondary">Downloads Left</p>
								   <h4 class="my-1 text-info"><?php 
	$date = date("Y-m-d");								
	$stmt = $mysqli->prepare("SELECT * FROM downloads WHERE date_downloaded = ? AND username = ?"); 
	$stmt->bind_param("ss", $date, $_SESSION["username"]);
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows();
	$stmt->close();
	echo $rows;
	?>/<?= $limit; ?></h4>
							   </div>
							   <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class="bx bxs-cloud-download"></i>
							   </div>
						   </div>
					   </div>
					</div>
				  </div> 
				</div>
        </div>
		 <div class="col-lg-12 mt-2">
            <div class="row">
                <div class="col-lg-12 col-md-12">
					<h6 class="mb-0 text-uppercase">Shoutbox System:</h6>
			<!--	<p class="mb-2 text-primary">Purchased Plan: <?= $user_role; ?> </p> -->
		<!--<p class="mb-0 text-primary">Subscription Expiring: <?php $time = time(); $stmt = $mysqli->prepare("SELECT sub_value FROM users WHERE username = ?"); $stmt->bind_param("s", $_SESSION["username"]); $stmt->execute(); $stmt->bind_result($sub_value); $stmt->fetch();  $timel = date('Y-m-d  H:i', $sub_value); if($sub_value > $time){ echo $timel; } else { echo "0"; } $stmt->close(); ?> </p>-->
				<hr>
                     <div class="card-body">
                           <table class="table table-borderless " >
                              
   <thead>
 <tr>
   <body>
<?php
	if (! isset ( $_SESSION ['name'] )) {
	loginForm ();
	} else {
?>
<div id="wrapper">
	<div id="menu">
		<p class="welcome"><b>Welcome - <a><?php echo $_SESSION['name']; ?></a></b></p>
		<p class="logout"><a id="exit" href="<?php echo $site_url; ?>logout" class="btn btn-primary">Exit ShoutBox</a></p>
	<div style="clear: both"></div>
<!--		<p class="index"><a id="index" href="https://data-cloud.lol/index" class="btn btn-default">Dashboard</a></p> -->
	<div style="clear: both"></div>
	</div>
	<div id="chatbox">
	<?php
		if (file_exists ( "log.html" ) && filesize ( "log.html" ) > 0) {
		$handle = fopen ( "log.html", "r" );
		$contents = fread ( $handle, filesize ( "log.html" ) );
		fclose ( $handle );

		echo $contents;
		}
	?>
	</div>
<form name="message" action="">
	<input name="usermsg" class="form-control" type="text" id="usermsg" placeholder="Create A Message" />
	<input name="submitmsg" class="btn btn-primary" type="submit" id="submitmsg" value="Send" />
</form>
</div>
<script type="text/javascript">
$(document).ready(function(){
});
$(document).ready(function(){
    $("#exit").click(function(){
        var exit = confirm("Are you sure you want quit?");
        if(exit==true){window.location = 'https://data-cloud.lol/index';}     
    });
});
$("#submitmsg").click(function(){
        var clientmsg = $("#usermsg").val();
        $.post("post.php", {text: clientmsg});             
        $("#usermsg").attr("value", "");
        loadLog;
    return false;
});
function loadLog(){    
    var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
    $.ajax({
        url: "log.html",
        cache: false,
        success: function(html){       
            $("#chatbox").html(html);       
            var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
            if(newscrollHeight > oldscrollHeight){
                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal');
            }              
        },
    });
}
setInterval (loadLog, 2500);
</script>
<?php
}
?>
</body>
</table>
                        </div>
                    </div>
              
			  </div>
           
               
            </div>
        </div>
		</div>
		  <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="4395a16d-b718-4a92-985e-0266c10b6ed2";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
 <?php include("footer.php"); ?>