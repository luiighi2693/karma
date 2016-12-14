<? include("connect.php");
include("checklogin.php");


$avatarlogo = stripslashes(GetName1("avatars", "picture", "id", $CURRENTgetuserwryRow['avatarid']));

if (isset($_GET["theme"])&&isset($_GET["soundoption"])&&isset($_GET["background"])) {
	$updateQry = mysql_query("UPDATE options set theme_number=".$_GET["theme"].", music=".$_GET["soundoption"].",background=".$_GET["background"]." , audio=".$_GET["audio"]." WHERE id=" . $_SESSION['UsErIdFrOnT']);
	header("location:dashboard.php");
}

if ($_POST['Hidsubmit'] == '1') {
	if (trim($_POST['username']) != '') {
		$updateQry = mysql_query("UPDATE users set username='" . trim(addslashes($_POST['username'])) . "' WHERE id='" . $_SESSION['UsErIdFrOnT'] . "'");
	}
	if (trim($_POST['password']) != '') {
		$updateQry = mysql_query("UPDATE users set password='" . trim(addslashes($_POST['password'])) . "' WHERE id='" . $_SESSION['UsErIdFrOnT'] . "'");
	}
	if (trim($_POST['
	
	
	']) != ''
	) {
		$updateQry = mysql_query("UPDATE users set aboutme='" . trim(addslashes($_POST['aboutme'])) . "' WHERE id='" . $_SESSION['UsErIdFrOnT'] . "'");
	}
	$msg = "Updated Successfully!";
	header("location:dashboard.php?first=yes&step=yes");
	exit;
}
?>
<!doctype=HTML>
<html>

<head>
	<title><? echo $SITE_TITLE; ?></title>
	<link href="css/style.css?rnd=<? echo rand(); ?>" rel="stylesheet" type="text/css"/>
	<link href="dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css"/>
	<script language="javascript" src="popup_fun.js?rnd=<? echo rand(); ?>"></script>
	<script language="javascript" src="ajax_validation.js?rnd=<? echo rand(); ?>"></script>
	<script src="dhtmlgoodies_calendar.js"></script>
	<? if ($_SERVER['HTTP_HOST'] == 'yogs') { ?>
		<script src="js/jquery-1.9.1.js" type="text/javascript"></script>
	<? }else{ ?>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
	<? } ?>
	<style type="text/css">* {
			margin: 0;
			padding: 0;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}</style>
    
	<meta name="description" content="Design Engineer">
	<meta name="keywords" content="HTML,CSS,XML,JavaScript, Design, Engineering, CAD, Drafting, Virtual Reality, Game Development, App Development, Innovation, Invention, Software, Energy, Renewable, Patient Navigation, Business Navigator, Karma - the Game of Destiny, Alquimist eBook Reader, Business Navigator, Alquimi, Rene Reyes">
	<meta name="author" content="Rene Reyes">
	<meta charset="UTF-8">
		
	<link href="css/style.css" rel="stylesheet" type="text/css" media="screen">

</head>
    
<body>
<!-- Background and hidden items -->
<input value="" id="CurrentSelectedUserId" hidden></input>
<div id="color1" hidden></div>
<div id="color2" hidden></div>
<div id="backg"
	 style="position:absolute; width:100%; height:100%; z-index:1;background-size: 100% 100%; ">
	<audio tabindex="0" id="sound">
		<source src='music/looperman-l-0782612-0087385-40a-soul-link.wav'>
	</audio>
</div>
<!-- Top of Page - Main Title -->
		

				
			
		
		
			
<!-- Headline of Page - Titles of sections and lines -->

		
        
<style>
		
</style>
<div style="width:100%;height:100%;z-index:3;position:absolute;">
	<div id="dashboard_box" >

		<div style="height: 3%;width: 100%;display: flex;border-bottom: 1px solid #5d4c46;font-family: Helvitica, Arial, sans-serif;color: white; font-weight: 600;">
			<div style="width: 45%; overflow: hidden;">
				<? echo date("l, F j, Y");?>
			</div>

			<div style="width: 10%";>
				<div style="text-align: center;"><a href="myfile.htm"><img width="20%" src="images/guru_logo.png"></a> </div>
			</div>

			<div style="width: 45%; text-align: right; overflow: hidden;color:white;">
				<? echo TotalQuestionsAnswered();?>
			</div>
		</div>

		<div style="height: 3%;width: 100%;display: flex;border-bottom: 1px solid #5d4c46;font-family: Helvitica, Arial, sans-serif;color: white; font-weight: 600;">
			<div style="width: 50%; overflow: hidden; text-align: center;">
				THE GRID
			</div>

			<div style="width: 50%; overflow: hidden; text-align: center;">
				THE BOX
			</div>
		</div>

		<div id="mid_box" style="padding-top: 1%;">
			
			<div id="left_buttons">
				<div id="left_menu">
					<div id="box1" class="leftButtons" style="margin-top: 0;"><span class="notifier_box"><? echo GetTotalHide($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_hide.php');"><img id="iconhide" src="images/icon_hide.png" alt="" border="0"/></a></div>
					<div id="box2" class="leftButtons"> <span class="notifier_box"></span><a href="#" onclick="show_pop('popup_truthbomb.php');"><img src="images/icon_bomb.png" id="iconbomb"  alt="" border="0"/></a> </div>
					<div id="box3" class="leftButtons"> <span class="notifier_box"></span><a href="#" onclick="show_pop('popup_stars.php');"><img src="images/icon_star.png" id="iconstar"  alt="" border="0"/></a> </div>
					<div id="box4" class="leftButtons"><span class="notifier_box"></span><a href="#" onclick="show_pop('popup_challenge.php');"><img src="images/icon_challenge.png"  id="iconchallenge" alt="" border="0"/></a></a> </div>
					<div id="box5" class="leftButtons"><span class="notifier_box"></span><a href="#"><img src="images/icon_music.png" id="iconmusic" alt="" border="0"/></a></a> </div>
					<div id="box6" class="leftButtons"><span class="notifier_box"><? echo GetTotalZap($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_zap.php');"><img src="images/icon_zap.png" id="iconzap"  alt="" border="0"/></a> </div>
					<div id="box7" class="leftButtons"><a href="#" onclick="show_pop('popup_bail.php');"><img
								src="images/icon_bail.png" id="iconbail" alt="BAIL" title="BAIL"
								border="0"></a> </div>
					
				</div>	<!-- end #left_menu -->
			</div>   <!-- end #left_buttons -->
			
			
			<div id="popup_box" style="position:relative; overflow: hidden;">
				<div class="dashboardpopup" id='rightsidePOPUP_MAIN' style="display:none;width:100%;height:100%;">
					<div id="pad_wrapper_newlife">
						<div id="pad_newlife" style="border:0px solid gray;	border-radius:0px;max-width:100%;">
							<div id="rightsidePOPUP" style="color:#FFFFFF"></div>
						</div>
					</div>
				</div>
            					
            					
				<div id="grid_box" style="overflow:auto;">
					<div class="photo_list">
						<ul class="clearfix" id="SoulmateboxID">
							<?
							$getHidedusersQryRs = mysql_query("SELECT userid_to FROM users_hide WHERE userid_from='" . $_SESSION['UsErIdFrOnT'] . "'");
							$TotgetHidedusersQryRs = mysql_affected_rows();
							if ($TotgetHidedusersQryRs > 0) {
								while ($getHidedusersQryRow = mysql_fetch_array($getHidedusersQryRs)) {
									$userid_to .= $getHidedusersQryRow['userid_to'] . ",";
								}
								$userid_to = substr($userid_to, 0, -1);
								$andQryHide = " and id not in ($userid_to)";
							}
							$getHidedusersQryRs = mysql_query("SELECT userid_to FROM users_zap WHERE userid_from='" . $_SESSION['UsErIdFrOnT'] . "'");
							$TotgetHidedusersQryRs = mysql_affected_rows();
							if ($TotgetHidedusersQryRs > 0) {
								while ($getHidedusersQryRow = mysql_fetch_array($getHidedusersQryRs)) {
									$userid_to2 .= $getHidedusersQryRow['userid_to'] . ",";
								}
								$userid_to2 = substr($userid_to2, 0, -1);
								$andQryHide .= " and id not in ($userid_to2)";
							}
							$GetUsersQry = "SELECT id,avatarid FROM users WHERE active='Y' and id!='" . $_SESSION['UsErIdFrOnT'] . "' $andQryHide ORDER BY id DESC";
							$GetUsersQryRs = mysql_query($GetUsersQry);
							while ($GetUsersQryRow = mysql_fetch_array($GetUsersQryRs)) {
								?>
								<li onClick="ClickAvatar2(<? echo $GetUsersQryRow['id'] ?>,'1');">
									<div class="icon_wrap" style="color:#ffffff;text-align:center;">
										<? echo GetUserName($GetUsersQryRow['id']); ?>
										<?php /*?><a href="#" class="link_icon">Link</a> <a href="#" class="like_icon">Like</a><a href="#" class="fav_icon">Favourite</a><?php */
										?>
									</div>
									<img src="<? echo GetAvatarImage($GetUsersQryRow['avatarid']); ?>" alt="" width="75"
										 height="114"/>
								</li>
							<? } ?>
						</ul>
					</div>
						
													
				</div> <!-- end #grid_box -->
						
				<div id="detail_box_updating">
				</div>
				<div id="detail_box">
				
				</div>
				
			</div>

						
				
			<div id="right_buttons">
				<div id="right_menu">
					<div id="box8" class="rightButtons" style="margin-top: 0;"><span class="notifier_box"><? echo GetTotalIntro($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_introduction.php');"><img src="images/icon_intro.png" id="iconintro" alt="INTRODUCTION" title="INTRODUCTION" border="0"/></a> </div>
					<div id="box9"  class="rightButtons"><span class="notifier_box"><? echo GetTotalChat($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_chat.php');Callchateverysec();"><img src="images/icon_chat.png" id="iconchat" alt="CHAT" title="CHAT" border="0"/></a> </div>
					<div id="box11" class="rightButtons"><span class="notifier_box"><? echo GetTotalGroups($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_groups.php');"><img src="images/icon_group.png" id="icongroup" margin-left:15%;" alt="GROUPS" title="GROUPS" border="0"/></a> </div>
					<div id="box12" class="rightButtons"><span class="notifier_box"><? echo GetTotalGoOut($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_letsgoout.php');"><img src="images/icon_outing_white.png" id="iconout" alt="LET'S GO OUT!!!" title="LET'S GO OUT!!!" border="0"/></a> </div>
					<div id="box13"  class="rightButtons"> <span class="notifier_box"></span><a href="#" onclick="show_pop('popup_safe.php');"><img src="images/icon_safe.png" id="iconsafe" alt="SAFE" title="SAFE"  border="0"/></a> </div>
					<div id="box14" class="rightButtons"> <a href="#"  onclick="show_pop('popup_calendar.php');"><img
								src="images/icon_calendar.png" id="iconcalendar" alt="CALENDAR"
								title="CALENDAR" border="0"></a> </div>
					<div id="box27"  class="rightButtons"><a href="journeystats.php"><img src="images/icon_journeybook.png" id="iconjourneybook2" alt="JOURNEY BOOK" title="JOURNEY BOOK"
																	border="0"></a> </div>
					
				</div>	<!-- end #right_menu -->
			</div>   <!-- end #right_buttons -->
				
				
		</div>	<!-- end #mid_box -->
					
		<div id="bottom_box">
			
			<div id="bottom_menu">
			
				<div id="box15" class="leftButtons"><a href="#" onclick="show_pop('popup_options.php');"><img src="images/icon_gears.png" id="icongears" alt="OPTIONS" title="OPTIONS" border="0"></a> </div>
				<div id="box16" class="bottomleft"><a href="#" onClick=" clickOnIcon('Infinity');"><img id="Infinity" src="images/icon_infinity.png"id="iconinfinity" />
					</a> </div>
				<div id="box17" class="bottomleft"><a href="#" onClick=" clickOnIcon('ThumbsUp');"><img id="ThumbsUp" src="images/icon_like.png" border="0"/></a></div>
				<div id="box18" class="bottomleft"><a href="#" onClick=" clickOnIcon('Heart');"><img id="Heart"																					src="images/icon_heart.png" border="0"/></a> </div>
				<div id="box19" class="bottomleft"><a href="#" onClick=" clickOnIcon('Ideas');"><img id="Ideas" src="images/icon_idea.png"   border="0"/></a> </div>
				<div id="box20" class="bottomcenter"><a onclick="searchUser()"><img src="images/icon_search_white.png" id="iconsearch"></a> </div>
					
				<div id="box21"  class="bottomcenter"><input id="textToSearch" style="width:85%; height:50%;margin-left:7.5%;margin-top:10%; border-radius:10px;padding: 5px 5px 5px 25px;" type="text" value="" placeholder="Who you looking for...">
				</div> </div>
					 
			<div id="box22"  class="rightButtons"><a href="#" onclick="show_pop('popup_emails.php');"><img src="images/icon_email.png" id="iconemail"   alt="EMAIL" title="EMAIL" border="0"></a> </div>
			<div id="box23" class="bottomright"><a href="#" onClick="changefunctionForbucket(document.getElementById('CurrentSelectedUserId').value,10);"><img   src="images/icon_bucketlist.png" id="iconbucketlist" border="0"></a> </div>
			<div id="box24" class="bottomright"><a href="#" onclick="Updatebox(document.getElementById('CurrentSelectedUserId').value,'3');openPreferencesPopup('540',document.getElementById('CurrentSelectedUserId').value)"><img   src="images/icon_journeybook.png" id="iconjourneybook" border="0"></a> </div>
			<div id="box25" class="bottomright"><a href="#" onclick="Updatebox(document.getElementById('CurrentSelectedUserId').value,'2');"><img
						src="images/icon_stats.png" id="iconstats" border="0"></a> </div>
			<div id="box26" class="bottomright"><a href="#" onclick="Updatebox(document.getElementById('CurrentSelectedUserId').value,'1');"><img  src="images/footer_icon5.jpg" id="iconavatar" border="0">	</a> </div>
										
		</div>	<!-- end #bottom_menu -->
				
	</div>	<!-- end #bottom_box -->
			
		
		
		
			
        
			
		 
           <input id="currentSelectedIcon" value="" hidden/>   
          
</div>  <!-- end #dashboard_box -->
</div>
		
        
		
<?php
$IP = $_SERVER["REMOTE_ADDR"];
$file = "iplog.txt";
$txtfile = fopen($file, "a");
$stamp = date('Y-m-d H:i:s');
$page = "about.php";
fwrite($txtfile, "\r\n");
fwrite($txtfile, $IP);
fwrite($txtfile, "\t");
fwrite($txtfile, $stamp);
fwrite($txtfile, "\t");
fwrite($txtfile, $page);
		
fclose($txtfile);
?>
        

<? if ($_REQUEST['LoadEmail'] != '') { ?>
	<script language="javascript">
		show_pop('popup_emails.php');
		document.getElementById('CurrentSelectedUserId').value =<? echo $_REQUEST['LoadEmail'];?>;
		LoadEmail(<? echo $_REQUEST['LoadEmail'];?>);
	</script>
<? } ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js?ver=1.6.1"></script>
<script language="javascript">
	var themeSelected=1;
	var backgroundselected=1;
	var soundOptionSelected=2;
	var userId = <?echo $_SESSION['UsErIdFrOnT'];?>;
	var slideIndex = 1;
	var ideaSelected = null;
	var iconcolor="white";
	var audioselected=0;
	

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function control3(id)
{
 var checks = document.getElementsByClassName("checks");
 var i;
 
  for (i = 0; i < checks.length; i++)
   {
 
  	if(checks[i].value!=id)
  	{
     		checks[i].checked = false; 
  	}
  	
  	
  	
   }
   if(document.getElementById(id)!=null)
   {
   document.getElementById(id).checked = true; 
   }
}
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("photos");
  
  if (n > slides.length) {slideIndex = 1} 
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none"; 
  }
 
  slides[slideIndex-1].style.display = "block"; 

}
	$(document).ready(function () {
		resizeDiv();
		//myAudio = new Audio('music/looperman-l-0782612-0087385-40a-soul-link.wav');
		// myAudio.addEventListener('ended', function() {
		//       this.currentTime = 0;
		//       this.play();
		// }, false);
//myAudio.play();

		<?
		$result = mysql_query("SELECT * FROM options WHERE id='" . $_SESSION['UsErIdFrOnT'] . "'");
		$numero_filas = mysql_num_rows($result);
		if ($numero_filas == 0) {
			$sql = "INSERT INTO options SET 
				id=" . $_SESSION['UsErIdFrOnT'] . ",
				layout_number=1, theme_number=1, music=1, sound_effects=1, voices_and_ai=1, audio=1, background=1";
			$q = mysql_query($sql);
			echo 'theme2(1);';
		}else{
			
			$array=mysql_fetch_array($result);
			if($array['music']=="1"){
				
				
				echo 'changesong('.$array['audio'].');';
				echo 'soundOptionSelected=1;';
			}else{
				echo 'soundOptionSelected=2;';
			}
			
			echo 'theme2('.$array['background'].');';
			echo 'color('.$array['theme_number'].');';
		}
		?>

		verifyUser();
	});
	window.onresize = function (event) {
		resizeDiv();
	};
	function resizeDiv() {
		vpw = $(window).width();
		vph = $(window).height();
		if (vpw == 1024) {
			vph = vph - 144;
		}
		else if (vpw == 1280) {
			vph = vph - 151;
		}
		else if (vpw == 1360) {
			vph = vph - 161;
		}
		else if (vpw == 1600) {
			vph = vph - 178;
		}
		else if (vpw == 1440) {
			vph = vph - 198;
		}
		else {
			vph = vph - 163;
		}
		$('#SoulmateboxID').css({'height': vph + 'px'});
	}

	function toggle() {
		var ele = document.getElementById("pop_menu");

		if (ele.style.display == "block") {
			ele.style.display = "none";
		}
		else {
			ele.style.display = "block";
		}
	}

	function PlaySound(soundobj) {
		var thissound = document.getElementById(soundobj);
		thissound.addEventListener('ended', function () {
			this.currentTime = 0;
			this.play();
		}, false);
		thissound.play();
	}
	function StopSound(soundobj) {
		var thissound = document.getElementById(soundobj);
		thissound.pause();
		thissound.currentTime = 0;
	}

	function when_needed(soundobj) {
		var thissound = document.getElementById(soundobj);

	}
	
	function changesound(soundobj,songname)
	{
		StopSound(soundobj);
		document.getElementById(soundobj).src="music/"+songname;
		
	}
	function changesong(option)
	{
	audioselected=option;
			if(option==3){
				changesound("sound","looperman-l-1879947-0101629-kingmswati-bieber-hall.wav");
				PlaySound("sound");
			}
			if(option==2){
				changesound("sound","looperman-l-1929922-0101649-alabafruit-disorted-hip-hop-drums-90-bpm.wav");
				PlaySound("sound");
			}
			if(option==1){
				changesound("sound","looperman-l-0159051-0101634-minor2go-guitars-unlimited-reflective-poetry.wav");
				PlaySound("sound");
			}
			if(option==0){
				changesound("sound","looperman-l-0159051-0101593-minor2go-piano-quality-on-the-way-home.wav");
				PlaySound("sound");
			}
		
	
	}
	
	function setwhiteicons()
	{
		iconcolor="white";
		document.getElementById("iconhide").src = "images/icon_hide.png";
		document.getElementById("iconbomb").src = "images/icon_bomb.png";
		document.getElementById("iconstar").src = "images/icon_star.png";
		document.getElementById("iconchallenge").src = "images/icon_challenge.png";
		document.getElementById("iconmusic").src = "images/icon_music.png";
		document.getElementById("iconzap").src = "images/icon_zap.png";
		document.getElementById("iconbail").src = "images/icon_bail.png";
		document.getElementById("icongears").src = "images/icon_gears.png";
		document.getElementById("Infinity").src = "images/icon_infinity.png";
		document.getElementById("ThumbsUp").src = "images/icon_like.png";
		document.getElementById("Heart").src = "images/icon_heart.png";
		document.getElementById("Ideas").src = "images/icon_idea.png";
		document.getElementById("iconsearch").src = "images/icon_search.png";
		document.getElementById("iconemail").src = "images/icon_email.png";
		document.getElementById("iconbucketlist").src = "images/icon_bucketlist.png";
		document.getElementById("iconjourneybook").src = "images/icon_journeybook.png";
		document.getElementById("iconstats").src = "images/icon_stats.png";
		document.getElementById("iconavatar").src = "images/footer_icon5.jpg";
		document.getElementById("iconintro").src = "images/icon_intro.png";
		document.getElementById("iconcalendar").src = "images/icon_calendar.png";
		document.getElementById("icongroup").src = "images/icon_group.png";
		document.getElementById("iconjourneybook2").src = "images/icon_journeybook.png";
		document.getElementById("iconsafe").src = "images/icon_safe.png";
		document.getElementById("iconchat").src = "images/icon_chat.png";
		document.getElementById("iconout").src = "images/icon_outing_white.png";


		
	}
	
	function setblackicons()
	{
		iconcolor="black";
		document.getElementById("iconhide").src = "images/icon_hide_black.png";
		document.getElementById("iconbomb").src = "images/icon_bomb_black.png";
		document.getElementById("iconstar").src = "images/icon_stars_black.png";
		document.getElementById("iconchallenge").src = "images/icon_challenge_black.png";
		document.getElementById("iconmusic").src = "images/icon_music_black.png";
		document.getElementById("iconzap").src = "images/icon_zap_black.png";
		document.getElementById("iconbail").src = "images/icon_bail_black.png";
		document.getElementById("icongears").src = "images/icon_gears_black.png";
		document.getElementById("Infinity").src = "images/icon_infinity_black.png";
		document.getElementById("ThumbsUp").src = "images/icon_like_black.png";
		document.getElementById("Heart").src = "images/icon_heart_black.png";
		document.getElementById("Ideas").src = "images/icon_idea_black.png";
		document.getElementById("iconsearch").src = "images/icon_search_black.png";
		document.getElementById("iconemail").src = "images/icon_email_black.png";
		document.getElementById("iconbucketlist").src = "images/icon_bucketlist_black.png";
		document.getElementById("iconjourneybook").src = "images/icon_journeybook_black.png";
		document.getElementById("iconstats").src = "images/icon_stats_black.png";
		document.getElementById("iconavatar").src = "images/icon_avatar_black.png";
		document.getElementById("iconintro").src = "images/icon_intro_black.png";
		document.getElementById("iconcalendar").src = "images/icon_calendar_black.png";
		document.getElementById("icongroup").src = "images/icon_group_black.png";
		document.getElementById("iconjourneybook2").src = "images/icon_journeybook_black.png";
		document.getElementById("iconsafe").src = "images/icon_safe_black.png";
		document.getElementById("iconchat").src = "images/icon_chat_black.png";
		document.getElementById("iconout").src = "images/icon_outing_black.png";


		
	}
	function geticon(currenticon)
	{
		var result="";
		switch(currenticon)
		{
			case "gears":
				alert(document.getElementById('icongears').src);
				
			break;
		}
		return result;
	}
	function color(selected)
	{
	themeSelected=selected;
		if(selected==3)
		{
		 setblackicons();
		}
		var checks = document.getElementsByClassName("leftButtons");
		var checks2 = document.getElementsByClassName("rightButtons");
		var checks3= document.getElementsByClassName("bottomright");
		var checks4= document.getElementsByClassName("bottomleft");
		var checks5= document.getElementsByClassName("bottomcenter");
		
		
		var i;
		switch(selected)
		{
		
			case 1:
			document.getElementById('color1').style.backgroundColor="#199579";
			document.getElementById('color2').style.backgroundColor="#5d4c46";
 			 for (i = 0; i < checks.length; i++)
  			 {
 
     					checks[i].style.backgroundColor = "#199579"; 
  				
  	
  			}
  			for (i = 0; i < checks2.length; i++)
  			 {
 
     					checks2[i].style.backgroundColor = "#5d4c46"; 
  				
  	
  			}
  			for (i = 0; i < checks3.length; i++)
  			 {
 
     					checks3[i].style.backgroundColor = "#199579"; 
  				
  	
  			}
  			for (i = 0; i < checks4.length; i++)
  			 {
 
     					checks4[i].style.backgroundColor = "#5d4c46"; 
  				
  	
  			}
  			for (i = 0; i < checks5.length; i++)
  			 {
 
     					checks5[i].style.backgroundColor = "black"; 
  				
  	
  			}
			break;
			case 2:
			document.getElementById('color1').style.backgroundColor="#199579";
			document.getElementById('color2').style.backgroundColor="#5d4c46";
			setwhiteicons();
 			 for (i = 0; i < checks.length; i++)
  			 {
 
     					checks[i].style.backgroundColor = "transparent"; 
  				
  	
  			}
  			for (i = 0; i < checks2.length; i++)
  			 {
 
     					checks2[i].style.backgroundColor = "transparent"; 
  				
  	
  			}
  			for (i = 0; i < checks3.length; i++)
  			 {
 
     					checks3[i].style.backgroundColor = "transparent"; 
  				
  	
  			}
  			for (i = 0; i < checks4.length; i++)
  			 {
 
     					checks4[i].style.backgroundColor = "transparent"; 
  				
  	
  			}
  			for (i = 0; i < checks5.length; i++)
  			 {
 
     					checks5[i].style.backgroundColor = "transparent"; 
  				
  	
  			}
			break;
			case 4:
			document.getElementById('color1').style.backgroundColor="#721716";
			document.getElementById('color2').style.backgroundColor="black";
 			 for (i = 0; i < checks.length; i++)
  			 {
 
     					checks[i].style.backgroundColor = "#721716"; 
  				
  	
  			}
  			for (i = 0; i < checks2.length; i++)
  			 {
 
     					checks2[i].style.backgroundColor = "black"; 
  				
  	
  			}
  			for (i = 0; i < checks3.length; i++)
  			 {
 
     					checks3[i].style.backgroundColor = "#721716"; 
  				
  	
  			}
  			for (i = 0; i < checks4.length; i++)
  			 {
 
     					checks4[i].style.backgroundColor = "black"; 
  				
  	
  			}
  			for (i = 0; i < checks5.length; i++)
  			 {
 
     					checks5[i].style.backgroundColor = "black"; 
  				
  	
  			}
			break;
			case 6:
			document.getElementById('color1').style.backgroundColor="#111674";
			document.getElementById('color2').style.backgroundColor="#111674";
 			 for (i = 0; i < checks.length; i++)
  			 {
 
     					checks[i].style.backgroundColor = "#111674"; 
  				
  	
  			}
  			for (i = 0; i < checks2.length; i++)
  			 {
 
     					checks2[i].style.backgroundColor = "#111674"; 
  				
  	
  			}
  			for (i = 0; i < checks3.length; i++)
  			 {
 
     					checks3[i].style.backgroundColor = "#111674"; 
  				
  	
  			}
  			for (i = 0; i < checks4.length; i++)
  			 {
 
     					checks4[i].style.backgroundColor = "#111674"; 
  				
  	
  			}
  			for (i = 0; i < checks5.length; i++)
  			 {
 
     					checks5[i].style.backgroundColor = "#111674"; 
  				
  	
  			}
			break;
		}
		
		document.getElementById('pad_newlife').style.backgroundColor=document.getElementById('color1').style.backgroundColor;
		
		//document.getElementById('grid_box').style.backgroundColor=document.getElementById('color2').style.backgroundColor;
		//document.getElementById('detail_box_updating').style.backgroundColor=document.getElementById('color1').style.backgroundColor;
		//document.getElementById('detail_box').style.backgroundColor=document.getElementById('color1').style.backgroundColor;
		
	}
	
	
	function control(selected) {
		if (selected == 1) {
			PlaySound("sound");
			document.forms[0].radio2.checked = false;
			
		}
		
		if (selected == 2) {
			StopSound("sound");
			document.forms[0].radio1.checked = false;
			
		}
		if (selected == 3) {
			when_needed(sound);
			document.forms[0].radio4.checked = false;
			
		}
		if (selected == 4) {
			when_needed(sound);
			document.forms[0].radio3.checked = false;
			
		}
		if (selected == 5) {
			
			document.forms[0].radio6.checked = false;
			
		}
		if (selected == 6) {
			
			document.forms[0].radio5.checked = false;
			
		}
		soundOptionSelected=selected;
	}
	function show_pop(urls)
	{
		ivar=document.getElementById('CurrentSelectedUserId').value;
		if((ivar>0 && ivar!='' && ivar!=<? echo $_SESSION['UsErIdFrOnT'];?>) || (urls=='popup_chat.php') || (urls=='popup_calendar.php') || (urls=='popup_emails.php') || (urls=='popup_options.php') || (urls=='popup_bail.php') || (urls=='popup_safe.php')|| (urls=='popup_challenge.php')|| (urls=='popup_menu.php') || (urls=='popup_bucketlist.php') || (urls=='popup_truthbomb2.php')|| (urls=='popup_dashboard.php')|| (urls=='popup_dashboard2.php') || (urls=='popup_music.php') )
		{
			jQuery.noConflict();
			jQuery.ajax({
				type: "GET",
				url: urls,
				data: { id:ivar,
					"iconcolor": iconcolor } ,
				success: function( response )
				{
					document.getElementById('rightsidePOPUP_MAIN').style.display='block';
					document.getElementById('rightsidePOPUP').innerHTML=response;
					if(urls=='popup_hide.php' || urls=='popup_stars.php' ||  urls=='popup_zap.php' || urls=='popup_bail.php'|| (urls=='popup_challenge.php')  || (urls=='popup_truthbomb.php')  || (urls=='popup_music.php') || (urls=='popup_options.php'))
					{
						document.getElementById('pad_newlife').style.backgroundColor=document.getElementById('color1').style.backgroundColor;
						
					}
					else
					{
						if((urls=='popup_menu.php'))
						{
							document.getElementById('rightsidePOPUP2').innerHTML=response;
							document.getElementById('pad_newlife').style.backgroundColor=document.getElementById('color2').style.backgroundColor;
						}else{
							document.getElementById('pad_newlife').style.backgroundColor=document.getElementById('color2').style.backgroundColor;
						}
					}
					if((urls=='popup_options.php')){
					
					}
				}
			});
		}
		else
		{
			alert("Please select soulmate from left side.");
		}
	}
	function hide_pop()
	{
		document.getElementById('rightsidePOPUP_MAIN').style.display='none';
	}

	function verifyTypeMail() {
		jQuery.ajax({
			type: "POST",
			url: "util.php",
			data: {
				"method" : "verifyTypeMail",
				"idMail" :  mailSelected
			},
			success: function(data){
				if(data == "true"){
					document.getElementById("bombIcon").style.display="block";
					document.getElementById("haloIcon").style.display="block";
				}else{
					document.getElementById("bombIcon").style.display="none";
					document.getElementById("haloIcon").style.display="none";
				}
			}
		});
	}

	function saveAnswer(userId, questionId, userToId, type, typeTable, typeTableId, accepted) {
	    if (questionId = null){
	        alert("Sorry, you don't have a question without answer with this user now!");
        }
		if(document.getElementById("txtAreaUser").value == ""){
			alert("empty answer");
		}else{
			jQuery.ajax({
				type: "POST",
				url: "util.php",
				data: {
					"method" : "addAnswer",
					"id_question" :  questionId ,
					"id_user" : userId,
					"id_userTo" : userToId,
					"answer" : document.getElementById("txtAreaUser").value
				},
				success: function(data){
					sendEmail(userToId, userId, type, typeTable, typeTableId+","+data, accepted);
				}
			});
		}
	}


	function sendEmail(userIdTo, userIdFrom, type, typeTable, typeTableId, accepted) {
		jQuery.ajax({
			type: "POST",
			url: "util.php",
			data: {
				"method" : "sendMail",
				"userIdTo" :  userIdTo,
				"userIdFrom" :  userIdFrom,
				"type" :  type,
				"typeTable" :  typeTable,
				"typeTableId" :  typeTableId,
				"accepted" :  accepted
			},
			success: function(data){
				console.log(data);
			}
		});
		//console.log(userIdTo+"  "+userIdFrom+"  "+type+"  "+typeTable+"  "+typeTableId+"  "+accepted);
	}
	
	function reply() {
		if(typeMailSelected == "torb"){
			//alert(mailSelected);
			jQuery.ajax({
				type: "POST",
				url: "util.php",
				data: {
					"method" : "saveMailId",
					"mailId" :  mailSelected
				},
				success: function(data){
					console.log(data);
					hide_pop();
					show_pop('popup_truthbomb2.php');
				}
			});


		}
	}

	function hideUser() {
		jQuery.ajax({
			type: "POST",
			url: "util.php",
			data: {
				"method" : "hideUser",
				"idMail" :  mailSelected
			},
			success: function(data){
				alert("user in hide list Succsefully");
				show_pop('popup_emails.php');
			}
		});
	}
	
	function promptChat() {
		var result = prompt("Do you want to chat with this user?", "yes");
		if(result != null){
			if(result=="Yes" || result=="yes" || result == "y"){
				show_pop('popup_chat.php');
			}
		}
	}

	function deleteBunckedListElements(idUser){
		var list =document.getElementById('buckedList');
		for (var i=0; i<list.childElementCount; i++){
			if(list.children[i].children[0].children[0].checked){
				jQuery.ajax({
					type: "POST",
					url: "util.php",
					data: {
						"method" : "deleteBuckedElement",
						"idElement" :  list.children[i].children[0].children[0].id,
						"userId" : idUser
					},
					success: function(data){
						console.log(data);
					}
				});
			}
		}
		show_pop('popup_bucketlist.php');
	}

	function DeleteEmailList(){
		var list =document.getElementById('mailList');
		for (var i=0; i<list.childElementCount; i++){
			if(list.children[i].children[2].children[1].checked){
				DeleteEmail(list.children[i].children[2].children[1].id);
			}
		}
		setTimeout(function() {
			hide_pop();
			show_pop('popup_emails.php');
		}, 1500);
	}
	function control2(selected) {
        
        
		if (selected == 1) {
			document.getElementById('Hidwhomidea').value='YOUR IDEA'
			document.getElementById('whomidea_2').checked=false;
         
			if (document.getElementById('my_blist').style.display == "inline-block") {
				document.getElementById('my_blist').style.display = "none";
       		
			}
       		
			document.getElementById('other_list').style.display = "inline-block";
       		 
		}
        
		if (selected == 2) {
			document.getElementById('Hidwhomidea').value='MY IDEA'
			document.getElementById('whomidea_1').checked=false;
			if (document.getElementById('other_list').style.display == "inline-block") {
				document.getElementById('other_list').style.display = "none";
			}
       		
			document.getElementById('my_blist').style.display = "inline-block";
       		 
		}
      
        
	}
	function theme2(int) {
		if(int==0)
		{
		document.getElementById('backg').style.backgroundImage = "url(images/theme1.jpg)";
		window.location.href = window.location.href + "?theme=1";
		}else{
		document.getElementById('backg').style.backgroundImage = "url(images/theme" + int + ".jpg)";
//		window.location.href = window.location.href + "?theme=" + int;
		backgroundselected = int;
		}
	}

	function save() {
		window.location = "http://www.karmathegame.org/karmathegame/dashboard.php?background=" + backgroundselected+"&soundoption=" + soundOptionSelected+"&theme="+themeSelected+"&audio="+audioselected;
	}

	function insert_bucketlist(ideaid, userid)
	{
		jQuery.ajax({
			type: "POST",
			url: "util.php",
			data: {
				"method" : "addBucketlist",
				"ideaId" :  ideaid ,
				"userId" : userid
			},
			success: function(data){
				console.log(data);
			}
		});
		alert("The Idea has been added to your Bucketlist");
	}
	function show_bucketlist()
	{
		alert("me han pulsado");
	}

	function verifyUser()
	{
		jQuery.ajax({
			type: "POST",
			url: "util.php",
			data: {
				"method" : "verifyUserNew",
				"userId" :  userId
			},
			success: function(data){
				if(data == 'NoActive'){
					show_pop('popup_dashboard.php');
				}
			}
		});
	}
	function clickOnIcon(type)
	{
		var currentselected=document.getElementById("currentSelectedIcon").value;
		RemoveYellowIcon(currentselected);
		if(type==currentselected)
		{
			document.getElementById("currentSelectedIcon").value="";
			type="";
		}else{
			setYellowIcon(type);
			document.getElementById("currentSelectedIcon").value=type;
			updateLeftSection(type);
		}
		updateLeftSection(type);
		
	
	}
	function updateLeftSection(type)
	{
	 var http4_1 = false;
 	 document.getElementById('grid_box').innerHTML= "<img src='images/loading.gif' />";
  	if(navigator.appName == "Microsoft Internet Explorer") { http4_1 = new ActiveXObject("Microsoft.XMLHTTP");} else {  http4_1 = new XMLHttpRequest();	}
 		 http4_1.abort();
 		 http4_1.open("GET", "ajax_footersoulmates.php?type="+type+"&allselected="+type, true);
 		 http4_1.onreadystatechange=function()
 	 {
	  if(http4_1.readyState == 4)
	  {
		  if(http4_1.responseText!="")
		  {
			  document.getElementById('grid_box').innerHTML=http4_1.responseText;
			  return  false;
		  }
	  } 
  }
  http4_1.send(null);
	
	}
	
	function changefunctionForbucket(userid,slide)
	{
		if(ideaSelected != null){
			insert_bucketlist(ideaSelected, <? echo $_SESSION['UsErIdFrOnT']; ?>);
			ideaSelected = null;
		}else{
			Updatebox(userid, slide);
		}
	}
	function RemoveYellowIcon(type)
	{
	switch(type)// removes the glow effect on
		{
			 case "Heart":

        			if(iconcolor=="white"){
					document.getElementById('Heart').src="images/icon_heart_white.png";
				}else{
					document.getElementById('Heart').src="images/icon_heart_black.png";
				}
				
      			  	break;
      			  	
   			 case "Infinity":
   			 	if(iconcolor=="white"){
					document.getElementById('Infinity').src="images/icon_infinity_white.png";
				}else{
					document.getElementById('Infinity').src="images/icon_infinity_black.png";
				}

				
   			 	break;
   			 	
   			 case "ThumbsUp":
   			 if(iconcolor=="white"){
					document.getElementById('ThumbsUp').src="images/icon_like_white.png";
				}else{
					document.getElementById('ThumbsUp').src="images/icon_like_black.png";
				}


				
      			  	break;
      			  	
    			default:
    			if(iconcolor=="white"){
					document.getElementById('Ideas').src="images/icon_idea.png";
				}else{
					document.getElementById('Ideas').src="images/icon_idea_black.png";
				}

		}
	}
	function setYellowIcon(type)
	{
	switch(type)// adds the glow effect on
		{
			 case "Heart":
        			document.getElementById('Heart').src="images/footer_icon3_blur.png";
      			  	break;
      			  	
   			 case "Infinity":
   			 document.getElementById('Infinity').src="images/footer_icon1_blur.png";
   			 	break;
   			 	
   			 case "ThumbsUp":
        			document.getElementById('ThumbsUp').src="images/footer_icon2_blur.png";
      			  	break;
      			  	
    			default:
			document.getElementById('Ideas').src="images/footer_icon4_blur.png";
		}
		
	
	}
	function frmupdatesave() {
		//document.getElementById('Hidsubmit').value = '1';
		jQuery.ajax({
			type: "POST",
			url: "util.php",
			data: {
				"method" : "updateInfoUser",
				"userId" :  userId,
				"username": document.getElementById("username").value,
				"password": document.getElementById("passwordUser").value,
				"aboutme": document.getElementById("aboutmeUser").value
			},
			success: function(data){
				console.log(data);
				hide_pop();
				show_pop('popup_dashboard2.php');
			}
		});
	}

	function searchUser() {
		var textToSearch = document.getElementById('textToSearch').value;
		if(textToSearch == ''){
			location.reload();
		}else{
			jQuery.ajax({
				type: "POST",
				url: "util.php",
				data: {
					"method" : "searchUser",
					"username" :  textToSearch
				},
				success: function(data){

					if(data == "[]"){
						alert('username not found');
						document.getElementById('textToSearch').value="";
					}else{
						var result = JSON.parse(data);
						var innerResult = '';
						for (var i = 0; i < result.length; i++){
							var idUser = result[i].split(',')[0];
							var picture = result[i].split(',')[1];
							var username = result[i].split(',')[2];
							innerResult+='<li onClick="ClickAvatar('+idUser+',1);">' +
											'<div class="icon_wrap" style="color:#ffffff;text-align:center;">'+username+'</div>' +
											'<img src="Avatars/'+picture+'" width="75" height="114"/>' +
										'</li>';
						}
						document.getElementById('SoulmateboxID').innerHTML = innerResult;
					}
				}
			});
		}
	}

	function checkBirthDates() {
		var result;
		if(document.getElementById("userid_from_birthdate").value == ""){
			result = prompt("If you want to send this user an email to PLAY THE STARS you should enter your Birhday first", "yes");
			if(result != null){
				if(result=="Yes" || result=="yes" || result == "y"){
					window.location = "http://www.karmathegame.org/karmathegame//journey_questions_step.php?grp=2&subgrp=1";
				}
			}
		}else{
			var control = true;
			var content = null;
			if(document.getElementById("userid_to_birthdate").value == ""){
				result = prompt("Sorry! Birthdate not provided by this user.. Write 'yes' if you want to let them know you tried to PLAY THE STARS with you", "yes");
				if(result != null){
					if(result=="Yes" || result=="yes" || result == "y"){
						content = "N";
					}else{
						control = false;
					}
				}
			}else{
				content = document.getElementById("iframeStars").contentDocument.getElementById("contentStars").children[0].children[0].children[0].textContent.substring(23, 523);
            }

            if(control){
				jQuery.ajax({
					type: "POST",
					url: "util.php",
					data: {
						"method" : "saveStarsContent",
						"userid_from" :  document.getElementById("userid_from").value,
						"userid_to" :  document.getElementById("userid_to").value,
						"content": content
					},
					success: function(data){
						sendEmail(document.getElementById("userid_to").value, document.getElementById("userid_from").value, "stars", "users_stars", data, "N");
						alert("send succefully;");
					}
				});
			}

		}
	}

	Updatebox(<? echo $_SESSION['UsErIdFrOnT'];?>, 1);

</script>
<? include("googleanalytic.php"); ?>

		
    
    
</body>

</html>
