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
	 <h4 class="card-title"><a type="button" class="btn btn-light waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#new">New Group</a></h4>
	   
	 </div>
   <div class="card-body">
<form action="" method="post" enctype="multipart/form-data">
   <div class="row">
   <div class="col-lg-6 col-xs-12">
   <div class="form-group">
   <label>Combo Name</label>
   <input type="text" name="name" placeholder="Name" class="form-control">
   </div>
   </div>
    <div class="col-lg-6 col-xs-12">
   <div class="form-group">
   <label>Lines Count</label>
   <input type="text" name="lines" placeholder="100000" class="form-control">
   </div>
   </div>
   

    <div class="col-lg-6 col-xs-12">
   <div class="form-group">
   <label>Combo Category</label>
   <select name="id" class="form-control">
   <?php 
   $stmt = $mysqli->prepare("SELECT id, group_name FROM groups");
    $stmt->execute();
    $result = $stmt->get_result();
    $kah  = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
   
		 foreach($kah as $data){ 
   ?><option value="<?= $data["id"]; ?>"><?= $data["group_name"]; ?></option><?php  }            ?>
   </select>
   </div>
   </div>
     <div class="col-lg-6 col-xs-12">
   <div class="form-group">
   <label>Type</label>
   <select name="type" class="form-control">
   <option value="Mail:Pass">Mail:Pass</option>
   <option value="User:Pass">User:Pass</option>  
   <option value="Proxies">Proxies</option>  
   </select>
   </div>
   </div>
    <div class="col-lg-12 col-xs-12">
<div class="form-group">
<label>Who can download this combo?</label>
<?php foreach($kah2 as $data){ ?>
<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="role[]" value="<?= $data["role_name"]; ?>">
									<label class="form-check-label" for="flexSwitchCheckChecked"><?= $data["role_name"]; ?></label>
								</div>
<?php } ?>
</div>
									</div>
   <div class="col-lg-12 col-xs-12">
     <div class="form-group">
						<label>Combo Country</label>
						<select name="country" class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true">
						<option value="world">Worldwide</option>
<option value="af">afghanistan</option><option value="ax">aland islands</option><option value="al">albania</option><option value="dz">algeria</option><option value="as">american samoa</option><option value="ad">andorra</option><option value="ao">angola</option><option value="ai">anguilla</option><option value="aq">antarctica</option><option value="ag">antigua and barbuda</option><option value="ar">argentina</option><option value="am">armenia</option><option value="aw">aruba</option><option value="au">australia</option><option value="at">austria</option><option value="az">azerbaijan</option><option value="bs">bahamas</option><option value="bh">bahrain</option><option value="bd">bangladesh</option><option value="bb">barbados</option><option value="by">belarus</option><option value="be">belgium</option><option value="bz">belize</option><option value="bj">benin</option><option value="bm">bermuda</option><option value="bt">bhutan</option><option value="bo">bolivia</option><option value="ba">bosnia and herzegovina</option><option value="bw">botswana</option><option value="bv">bouvet island</option><option value="br">brazil</option><option value="io">british indian ocean territory</option><option value="bn">brunei darussalam</option><option value="bg">bulgaria</option><option value="bf">burkina faso</option><option value="bi">burundi</option><option value="kh">cambodia</option><option value="cm">cameroon</option><option value="ca">canada</option><option value="cv">cape verde</option><option value="ky">cayman islands</option><option value="cf">central african republic</option><option value="td">chad</option><option value="cl">chile</option><option value="cn">china</option><option value="cx">christmas island</option><option value="cc">cocos (keeling) islands</option><option value="co">colombia</option><option value="km">comoros</option><option value="cg">congo</option><option value="cd">congo, democratic republic</option><option value="ck">cook islands</option><option value="cr">costa rica</option><option value="ci">cote d'ivoire</option><option value="hr">croatia</option><option value="cu">cuba</option><option value="cy">cyprus</option><option value="cz">czech republic</option><option value="dk">denmark</option><option value="dj">djibouti</option><option value="dm">dominica</option><option value="do">dominican republic</option><option value="ec">ecuador</option><option value="eg">egypt</option><option value="sv">el salvador</option><option value="gq">equatorial guinea</option><option value="er">eritrea</option><option value="ee">estonia</option><option value="et">ethiopia</option><option value="fk">falkland islands (malvinas)</option><option value="fo">faroe islands</option><option value="fj">fiji</option><option value="fi">finland</option><option value="fr">france</option><option value="gf">french guiana</option><option value="pf">french polynesia</option><option value="tf">french southern territories</option><option value="ga">gabon</option><option value="gm">gambia</option><option value="ge">georgia</option><option value="de">germany</option><option value="gh">ghana</option><option value="gi">gibraltar</option><option value="gr">greece</option><option value="gl">greenland</option><option value="gd">grenada</option><option value="gp">guadeloupe</option><option value="gu">guam</option><option value="gt">guatemala</option><option value="gg">guernsey</option><option value="gn">guinea</option><option value="gw">guinea-bissau</option><option value="gy">guyana</option><option value="ht">haiti</option><option value="hm">heard island & mcdonald islands</option><option value="va">holy see (vatican city state)</option><option value="hn">honduras</option><option value="hk">hong kong</option><option value="hu">hungary</option><option value="is">iceland</option><option value="in">india</option><option value="id">indonesia</option><option value="ir">iran, islamic republic of</option><option value="iq">iraq</option><option value="ie">ireland</option><option value="im">isle of man</option><option value="il">israel</option><option value="it">italy</option><option value="jm">jamaica</option><option value="jp">japan</option><option value="je">jersey</option><option value="jo">jordan</option><option value="kz">kazakhstan</option><option value="ke">kenya</option><option value="ki">kiribati</option><option value="kr">korea</option><option value="kw">kuwait</option><option value="kg">kyrgyzstan</option><option value="la">lao people's democratic republic</option><option value="lv">latvia</option><option value="lb">lebanon</option><option value="ls">lesotho</option><option value="lr">liberia</option><option value="ly">libyan arab jamahiriya</option><option value="li">liechtenstein</option><option value="lt">lithuania</option><option value="lu">luxembourg</option><option value="mo">macao</option><option value="mk">macedonia</option><option value="mg">madagascar</option><option value="mw">malawi</option><option value="my">malaysia</option><option value="mv">maldives</option><option value="ml">mali</option><option value="mt">malta</option><option value="mh">marshall islands</option><option value="mq">martinique</option><option value="mr">mauritania</option><option value="mu">mauritius</option><option value="yt">mayotte</option><option value="mx">mexico</option><option value="fm">micronesia, federated states of</option><option value="md">moldova</option><option value="mc">monaco</option><option value="mn">mongolia</option><option value="me">montenegro</option><option value="ms">montserrat</option><option value="ma">morocco</option><option value="mz">mozambique</option><option value="mm">myanmar</option><option value="na">namibia</option><option value="nr">nauru</option><option value="np">nepal</option><option value="nl">netherlands</option><option value="an">netherlands antilles</option><option value="nc">new caledonia</option><option value="nz">new zealand</option><option value="ni">nicaragua</option><option value="ne">niger</option><option value="ng">nigeria</option><option value="nu">niue</option><option value="nf">norfolk island</option><option value="mp">northern mariana islands</option><option value="no">norway</option><option value="om">oman</option><option value="pk">pakistan</option><option value="pw">palau</option><option value="ps">palestinian territory, occupied</option><option value="pa">panama</option><option value="pg">papua new guinea</option><option value="py">paraguay</option><option value="pe">peru</option><option value="ph">philippines</option><option value="pn">pitcairn</option><option value="pl">poland</option><option value="pt">portugal</option><option value="pr">puerto rico</option><option value="qa">qatar</option><option value="re">reunion</option><option value="ro">romania</option><option value="ru">russian federation</option><option value="rw">rwanda</option><option value="bl">saint barthelemy</option><option value="sh">saint helena</option><option value="kn">saint kitts and nevis</option><option value="lc">saint lucia</option><option value="mf">saint martin</option><option value="pm">saint pierre and miquelon</option><option value="vc">saint vincent and grenadines</option><option value="ws">samoa</option><option value="sm">san marino</option><option value="st">sao tome and principe</option><option value="sa">saudi arabia</option><option value="sn">senegal</option><option value="rs">serbia</option><option value="sc">seychelles</option><option value="sl">sierra leone</option><option value="sg">singapore</option><option value="sk">slovakia</option><option value="si">slovenia</option><option value="sb">solomon islands</option><option value="so">somalia</option><option value="za">south africa</option><option value="gs">south georgia and sandwich isl.</option><option value="es">spain</option><option value="lk">sri lanka</option><option value="sd">sudan</option><option value="sr">suriname</option><option value="sj">svalbard and jan mayen</option><option value="sz">swaziland</option><option value="se">sweden</option><option value="ch">switzerland</option><option value="sy">syrian arab republic</option><option value="tw">taiwan</option><option value="tj">tajikistan</option><option value="tz">tanzania</option><option value="th">thailand</option><option value="tl">timor-leste</option><option value="tg">togo</option><option value="tk">tokelau</option><option value="to">tonga</option><option value="tt">trinidad and tobago</option><option value="tn">tunisia</option><option value="tr">turkey</option><option value="tm">turkmenistan</option><option value="tc">turks and caicos islands</option><option value="tv">tuvalu</option><option value="ug">uganda</option><option value="ua">ukraine</option><option value="ae">united arab emirates</option><option value="gb">united kingdom</option><option value="us">united states</option><option value="um">united states outlying islands</option><option value="uy">uruguay</option><option value="uz">uzbekistan</option><option value="vu">vanuatu</option><option value="ve">venezuela</option><option value="vn">viet nam</option><option value="vg">virgin islands, british</option><option value="vi">virgin islands, u.s.</option><option value="wf">wallis and futuna</option><option value="eh">western sahara</option><option value="ye">yemen</option><option value="zm">zambia</option><option value="zw">zimbabwe</option> </select>
						
						</select>
					  </div>

   </div>
       <div class="col-lg-12 col-xs-12">
   <div class="form-group">
   	<label>Combo file:</label>
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