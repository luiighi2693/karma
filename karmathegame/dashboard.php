<? include("connect.php");
include("checklogin.php");
$avatarlogo = stripslashes(GetName1("avatars", "picture", "id", $CURRENTgetuserwryRow['avatarid']));

if (isset($_GET["theme"])&&isset($_GET["soundoption"])) {
	$updateQry = mysql_query("UPDATE options set theme_number=".$_GET["theme"].", music=".$_GET["soundoption"]."  WHERE id=" . $_SESSION['UsErIdFrOnT']);
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
	<script language="javascript" src="popup_fun.js?rnd=<? echo rand(); ?>"></script>
	<script language="javascript" src="ajax_validation.js?rnd=<? echo rand(); ?>"></script>
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

		<div style="height: 3%;width: 100%;font-size: 2.5vh;margin-top:.025vh; display: flex;border-bottom: 1px solid #848484;font-family: Helvitica, Arial, sans-serif;color: #5d4c46; font-weight: 600;">
			<div style="width: 45%; color:#848484; overflow: hidden;">
				<? echo date("l, F j, Y");?>
			</div>

			<div style="width: 10%";>
				<div style="text-align: center;"><a href="myfile.htm"><img width="20%" src="images/guru_logo.png"></a> </div>
			</div>

			<div style="width: 45%; text-align: right; color:#848484; overflow: hidden;">
				<? echo TotalQuestionsAnswered();?>
			</div>
		</div>

		<div style="height: 3%;width: 100%;font-size: 2vh;margin-top:.05vh;display: flex;border-bottom: 1px solid #848484;font-family: Helvitica, Arial, sans-serif;color: #5d4c46; font-weight: 600;">
			<div style="width: 50%; overflow: hidden; text-align: center; color:#848484;">
				THE GRID
			</div>

			<div style="width: 50%; overflow: hidden; color:#848484; text-align: center;">
				THE BOX
			</div>
		</div>

		<div id="mid_box" style="padding-top: 1%;">
			
			<div id="left_buttons">
				<div id="left_menu">
					<div id="box1" style="margin-top: 0;"><span class="notifier_box"><? echo GetTotalHide($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_hide.php');"><img src="images/icon_hide.png" alt="" border="0"/></a></div>
					<div id="box2"> <span class="notifier_box"></span><a href="#" onclick="show_pop('popup_truthbomb.php');"><img src="images/icon_bomb.png"  alt="" border="0"/></a> </div>
					<div id="box3"> <span class="notifier_box"></span><a href="#" onclick="show_pop('popup_stars.php');"><img src="images/icon_star.png"  alt="" border="0"/></a> </div>
					<div id="box4"><span class="notifier_box"></span><a href="#" onclick="show_pop('popup_challenge.php');"><img src="images/icon_challenge.png"  alt="" border="0"/></a></a> </div>
					<div id="box5"><span class="notifier_box"></span><a href="#"><img src="images/icon_music.png"  alt="" border="0"/></a></a> </div>
					<div id="box6"><span class="notifier_box"><? echo GetTotalZap($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_zap.php');"><img src="images/icon_zap.png"  alt="" border="0"/></a> </div>
					<div id="box7"><a href="#" onclick="show_pop('popup_bail.php');"><img
								src="images/icon_bail.png"  alt="BAIL" title="BAIL"
								border="0"></a> </div>
					
				</div>	<!-- end #left_menu -->
			</div>   <!-- end #left_buttons -->
			
			
			<div id="popup_box" style="position:relative;">
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
					<div id="box8" style="margin-top: 0;"><span class="notifier_box"><? echo GetTotalIntro($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_introduction.php');"><img src="images/icon_intro.png"alt="INTRODUCTION" title="INTRODUCTION" border="0"/></a> </div>
					<div id="box9"><span class="notifier_box"><? echo GetTotalChat($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_chat.php');Callchateverysec();"><img src="images/icon_chat.png" alt="CHAT" title="CHAT" border="0"/></a> </div>
					<div id="box11"><span class="notifier_box"><? echo GetTotalGroups($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_groups.php');"><img src="images/icon_group.png"  margin-left:15%;" alt="GROUPS" title="GROUPS" border="0"/></a> </div>
					<div id="box12"><span class="notifier_box"><? echo GetTotalGoOut($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_letsgoout.php');"><img src="images/outingWhiteFill.png" alt="LET'S GO OUT!!!" title="LET'S GO OUT!!!" border="0"/></a> </div>
					<div id="box13"> <span class="notifier_box"></span><a href="#" onclick="show_pop('popup_safe.php');"><img src="images/safeWhiteFill.png"  alt="SAFE" title="SAFE"  border="0"/></a> </div>
					<div id="box14"> <a href="#"  onclick="show_pop('popup_calendar.php');"><img
								src="images/icon_calendar.png"  alt="CALENDAR"
								title="CALENDAR" border="0"></a> </div>
					<div id="box27"><a href="journeystats.php"><img src="images/icon_journeybook.png" alt="JOURNEY BOOK" title="JOURNEY BOOK"
																	border="0"></a> </div>
					
				</div>	<!-- end #right_menu -->
			</div>   <!-- end #right_buttons -->
				
				
		</div>	<!-- end #mid_box -->
					
		<div id="bottom_box">
			
			<div id="bottom_menu">
			
				<div id="box15"><a href="#" onclick="show_pop('popup_options.php');"><img src="images/icon_gears.png"  alt="OPTIONS" title="OPTIONS" border="0"></a> </div>
				<div id="box16"><a href="#" onClick="LoadFooterSoulmates('Infinity');"><img id="Infinity" src="images/icon_infinity.png" />
					</a> </div>
				<div id="box17"><a href="#" onClick="LoadFooterSoulmates('ThumbsUp');"><img id="ThumbsUp" src="images/icon_like.png" border="0"/></a></div>
				<div id="box18"><a href="#" onClick="LoadFooterSoulmates('Heart');"><img id="Heart"																					src="images/icon_heart.png" border="0"/></a> </div>
				<div id="box19"><a href="#" onClick="LoadFooterSoulmates('Ideas');"><img id="Ideas" src="images/icon_idea.png" border="0"/></a> </div>
				<div id="box20"><a href="myfile.htm"><img src="images/icon_search_white.png"></a> </div>
					
				<div id="box21" style="background:black;"><input style="width:85%; height:50%;margin-left:7.5%;margin-top:10%; border-radius:10px;padding: 5px 5px 5px 25px;" type="text" value="" placeholder="Who you looking for...">
				</div> </div>
					 
			<div id="box22"><a href="#" onclick="show_pop('popup_emails.php');"><img src="images/icon_email.png"   alt="EMAIL" title="EMAIL" border="0"></a> </div>
			<div id="box23"><a href="#" onclick="show_bucketlist();"><img   src="images/icon_bucketlist.png" border="0"></a> </div>
			<div id="box24"><a href="#" onclick="Updatebox(document.getElementById('CurrentSelectedUserId').value,'3');openPreferencesPopup('540',document.getElementById('CurrentSelectedUserId').value)"><img   src="images/icon_journeybook.png" border="0"></a> </div>
			<div id="box25"><a href="#" onclick="Updatebox(document.getElementById('CurrentSelectedUserId').value,'2');"><img
						src="images/icon_stats.png" border="0"></a> </div>
			<div id="box26"><a href="#" onclick="Updatebox(document.getElementById('CurrentSelectedUserId').value,'1');"><img  src="images/footer_icon5.jpg" border="0">	</a> </div>
										
		</div>	<!-- end #bottom_menu -->
				
	</div>	<!-- end #bottom_box -->
			
		
		
		
			
        
			
		 
                    
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
	var soundOptionSelected=2;
	var userId = <?echo $_SESSION['UsErIdFrOnT'];?>;
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
				layout_number=1, theme_number=1, music=1";
			$q = mysql_query($sql);
		}else{
			$array=mysql_fetch_array($result);
			if($array['music']=="1"){
				echo 'PlaySound("sound");';
				echo 'soundOptionSelected=1;';
			}else{
				echo 'soundOptionSelected=2;';
			}
			echo 'theme2('.$array['theme_number'].');';
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
	function control(selected) {
		if (selected == 1) {
			PlaySound("sound");
			document.forms[0].radio2.checked = false;
			document.forms[0].radio3.checked = false;
		}
		if (selected == 2) {
			StopSound("sound");
			document.forms[0].radio1.checked = false;
			document.forms[0].radio3.checked = false;
		}
		if (selected == 3) {
			when_needed(sound);
			document.forms[0].radio1.checked = false;
			document.forms[0].radio2.checked = false;
		}
		soundOptionSelected=selected;
	}
	function show_pop(urls)
	{
		ivar=document.getElementById('CurrentSelectedUserId').value;
		if((ivar>0 && ivar!='' && ivar!=<? echo $_SESSION['UsErIdFrOnT'];?>) || (urls=='popup_chat.php') || (urls=='popup_calendar.php') || (urls=='popup_emails.php') || (urls=='popup_options.php') || (urls=='popup_bail.php') || (urls=='popup_safe.php')|| (urls=='popup_challenge.php')|| (urls=='popup_menu.php') || (urls=='popup_bucketlist.php') || (urls=='popup_truthbomb2.php')|| (urls=='popup_dashboard.php')|| (urls=='popup_dashboard2.php') )
		{
			jQuery.noConflict();
			jQuery.ajax({
				type: "GET",
				url: urls,
				data: { id:ivar } ,
				success: function( response )
				{
					document.getElementById('rightsidePOPUP_MAIN').style.display='block';
					document.getElementById('rightsidePOPUP').innerHTML=response;
					if(urls=='popup_hide.php' || urls=='popup_stars.php' ||  urls=='popup_zap.php' || urls=='popup_bail.php'|| (urls=='popup_challenge.php') )
					{
						document.getElementById('pad_newlife').style.backgroundColor='#199579';
					}
					else
					{
						if((urls=='popup_menu.php'))
						{
							document.getElementById('rightsidePOPUP2').innerHTML=response;
							document.getElementById('pad_newlife').style.backgroundColor='#5D4C46';
						}else{
							document.getElementById('pad_newlife').style.backgroundColor='#5D4C46';
						}
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
		//alert(userId+" "+questionId+" "+document.getElementById("txtAreaUser").value);
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
			if(list.children[i].children[3].children[0].checked){
				DeleteEmail(list.children[i].children[3].children[0].id);
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
         
			if (document.getElementById('my_blist').style.display == "block") {
				document.getElementById('my_blist').style.display = "none";
       		
			}
       		
			document.getElementById('other_list').style.display = "block";
       		 
		}
        
		if (selected == 2) {
			document.getElementById('Hidwhomidea').value='MY IDEA'
			document.getElementById('whomidea_1').checked=false;
			if (document.getElementById('other_list').style.display == "block") {
				document.getElementById('other_list').style.display = "none";
			}
       		
			document.getElementById('my_blist').style.display = "block";
       		 
		}
      
        
	}
	function theme2(int) {
		document.getElementById('backg').style.backgroundImage = "url(images/theme" + int + ".jpg)";
//		window.location.href = window.location.href + "?theme=" + int;
		themeSelected = int;
	}

	function save() {
		window.location = "http://www.karmathegame.org/karmathegame/dashboard.php?theme=" + themeSelected+"&soundoption=" + soundOptionSelected;
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
	Updatebox(<? echo $_SESSION['UsErIdFrOnT'];?>, 1);

</script>
<? include("googleanalytic.php"); ?>

		
    
    
</body>

</html>
