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
<!DOCTYPE =html>
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
</head>
<body>
<input value="" id="CurrentSelectedUserId" hidden>
<div id="backg"
     style="position:absolute; width:100%; height:100%; z-index:1;background-size: 100% 100%; ">
    <audio tabindex="0" id="sound">
        <source src='music/looperman-l-0782612-0087385-40a-soul-link.wav'>
    </audio>
</div>
<div class="main" style="z-index:3;">
 <div class="dashboardpopup" id='rightsidePOPUP_MAIN' style="display:none;">
                <div id="pad_wrapper_newlife">
                    <div id="pad_newlife" style="border:0px solid gray;	border-radius:0px;max-width:100%;">
                        <div id="rightsidePOPUP" style="color:#FFFFFF"></div>
                    </div>
                </div>
            </div>
            
<div id="header" style="padding-top:5px;padding-bottom:10px;">
	<div class="date_time" style="width:100%;">
	  <? echo date("l, F j, Y");?>
	</div>
	<div  style="float:right;position:absolute;right:30;">
	  <? echo TotalQuestionsAnswered();?>
	</div>
	<div style="width:100%; height: 30px;">
	<a href="dashboard.php">
	
	</a>
	</div>
	
</div>
 <div id="column_on_left" style="display:block;float:left;width:100px;height:calc(100% - 65px);padding-left:2%;">

                            
	<div class="vertical"><span class="notifier_box"><? echo GetTotalHide($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_hide.php');"><img src="images/icon_hide.png"  style="height:70%; width:70%; margin-top:15%; margin-left:15%;" alt="" border="0"/></a>
        </div>  
        
        <div class="vertical">
        <span class="notifier_box"></span><a href="#" onclick="show_pop('popup_truthbomb.php');"><img src="images/icon_bomb.png" style="height:70%; width:70%; margin-top:15%; margin-left:15%;" alt="" border="0"/></a>
        </div>  
          <div class="vertical">
        <span class="notifier_box"></span><a href="#" onclick="show_pop('popup_stars.php');"><img src="images/icon_star.png" style="height:70%; width:70%; margin-top:15%; margin-left:15%;" alt="" border="0"/></a>
          </div>        
          
          <div class="vertical">   
          <span class="notifier_box"></span><a href="#" onclick="show_pop('popup_challenge.php');"><img src="images/icon_challenge.png" style="height:70%; width:70%; margin-top:15%; margin-left:15%;" alt="" border="0"/></a>
          </div> 
          <div class="vertical"> 
          <span class="notifier_box"></span><a href="#"><img src="images/icon_music.png" style="height:70%; width:70%; margin-top:15%; margin-left:15%;" alt="" border="0"/></a>
          </div>   
          <div class="vertical">
          <span class="notifier_box"><? echo GetTotalZap($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_zap.php');"><img src="images/icon_zap.png" style="height:70%; width:70%; margin-top:15%; margin-left:15%;" alt="" border="0"/></a>
          </div>
          <div class="vertical">
          <a href="#" onclick="show_pop('popup_bail.php');"><img
                        src="images/icon_bail.png" style="height:70%; width:70%; margin-top:15%; margin-left:15%;" alt="BAIL" title="BAIL"
                        border="0"></a>
          </div>
          <div class="vertical">
          <a href="#" onclick="show_pop('popup_options.php');"><img
                        src="images/icon_gears.png" style="height:70%; width:70%; margin-top:15%; margin-left:15%;" alt="OPTIONS"
                        title="OPTIONS" border="0"></a>
          </div>
          
          
 </div>
 
 
  <div id="column_on_right" style="display:block;float:right;width:100px;height:calc(100% - 65px);padding-right:2%;">
  
  <div class="vertical2"><span class="notifier_box"><? echo GetTotalIntro($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_introduction.php');"><img src="images/icon_intro.png" style="height:70%; width:70%; margin-top:15%; margin-left:15%;" alt="INTRODUCTION" title="INTRODUCTION" border="0"/></a>
        </div>  
        
        <div class="vertical2">
        <span class="notifier_box"><? echo GetTotalChat($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_chat.php');Callchateverysec();"><img src="images/icon_chat.png" style="height:70%; width:70%; margin-top:15%; margin-left:15%;" alt="CHAT" title="CHAT" border="0"/></a>
        </div>  
          <div class="vertical2">
        <span class="notifier_box"><? echo GetTotalGroups($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_groups.php');"><img src="images/icon_group.png" style="height:70%; width:70%; margin-top:15%; margin-left:15%;" alt="GROUPS" title="GROUPS" border="0"/></a>         
         </div>        
          
          <div class="vertical2">   
          <span class="notifier_box"><? echo GetTotalGoOut($_SESSION['UsErIdFrOnT']);?></span><a href="#" onclick="show_pop('popup_letsgoout.php');"><img src="images/outingWhiteFill.png" style="height:70%; width:70%; margin-top:15%; margin-left:15%;" alt="LET'S GO OUT!!!" title="LET'S GO OUT!!!" border="0"/></a>
          </div> 
          <div class="vertical2"> 
          <span class="notifier_box"></span><a href="#" onclick="show_pop('popup_safe.php');"><img src="images/safeWhiteFill.png" style="height:70%; width:70%; margin-top:15%; margin-left:15%;" alt="SAFE" title="SAFE"  border="0"/></a>
          </div>   
          <div class="vertical2">
          <a href="#"
                                                                         onclick="show_pop('popup_calendar.php');"><img
                        src="images/icon_calendar.png" style="height:70%; width:70%; margin-top:15%; margin-left:15%;" alt="CALENDAR"
                        title="CALENDAR" border="0"></a>
          </div>
          <div class="vertical2">
         <a href="journeystats.php"><img src="images/icon_journeybook.png"
                                                          style="height:70%; width:70%; margin-top:15%; margin-left:15%;"          
                                                                              alt="JOURNEY BOOK" title="JOURNEY BOOK"
                                                                              border="0">
          </div>
          <div style="background:#5D4C45;width:100%;height:12%;">
          <a href="#"
                                                                         onclick="show_pop('popup_emails.php');"><img
                        src="images/icon_email.png" style="height:70%; width:70%; margin-top:15%; margin-left:15%;"  alt="EMAIL"
                        title="EMAIL" border="0"></a>
          </div>
          
          
 </div>
 
  
  

  <div id="column_on_center" style="display:block;float:right;margin-right:5px;width:calc(100% - 210px);height:calc(100% - 65px);position:relative;">
  	<div style="display:block;width:100%;height:87.5%;float:top;">
  	
  		<div id="left" style="width:48.5%; height:96%;vertical-align: top; display:inline-block;margin-right:1%;margin-left:1%; overflow:auto;">
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
  		</div>
  		
  	<div  style="width:48.5%; height:96%; vertical-align:top;display:inline-block;">
  	<div id="avatar_updating" style="height:100%;width:100%;display:none;">
  	</div>
  	
  	<div id="avatar_default" style="height:100%;width:100%;">
  		<div style="height:50%;width:100%;">
  			<div style="width:59%;height:100%;display:inline-block;margin-right:1%;">
  			
  				
  				
  			</div>
  			
  			
  			
  			<div style="width:39%;height:100%;display:inline-block;vertical-align:top;position:relative;">
  				<div style="height:100%; width:100%; z-index:1; background:white; opacity:0.5;position:relative;display:inline-block;position:absolute;">
  				</div>
  				<div  style="height:100%; width:95%;margin-left:5%; z-index:100;position:relative;display:inline-block;position:absolute;">
  				<div class="status" style="visibility:hidden" id="Graphs_BOTH">
                   			 <span class="blue_bar" id="Graphs_BOTH_1">&nbsp;</span><br/>
                  			  <span class="yellow_bar" id="Graphs_BOTH_2">&nbsp;</span><?php /*?> 097%<br /><?php */ ?><br/>
                   			 <span class="pink_bar" id="Graphs_BOTH_3">&nbsp;</span>
                		</div>
               			 <div class="user_status" style="visibility:hidden" id="Graphs_YOU">
                   		 	<div class="clearfix">
                     			   <div class="user_box" id="Graphs_YOU_4">you</div>
                      				  <div class="user_stat">
                           				 <span class="blue_bar" id="Graphs_YOU_2">&nbsp;</span><br/>
                           				 <span class="yellow_bar" id="Graphs_YOU_1">&nbsp;</span><br/>
                         				   <span class="pink_bar" id="Graphs_YOU_3">&nbsp;</span>
                       				  </div>
                   			 </div>
                			</div>
              			  <div class="user_status" id="Graphs_ME" style="opacity:1;z-index:10;">
                   			 <div class="clearfix" style="cursor:pointer">
                        			<div class="user_box" <? echo GetMyColor($_SESSION['UsErIdFrOnT']); ?>
                          		   onClick="UpdateMiddleSection(<? echo $_SESSION['UsErIdFrOnT']; ?>,1);document.getElementById('CurrentSelectedUserId').value='<? echo $_SESSION['UsErIdFrOnT']; ?>';">
                            me
                        			</div>
                       			 <div class="user_stat">
                           		 <span class="blue_bar" style="width:<? echo GetBar($_SESSION['UsErIdFrOnT'], 2); ?>%;">&nbsp;</span><br/>
                            		<span class="yellow_bar" style="width:<? echo GetBar($_SESSION['UsErIdFrOnT'], 1); ?>%;">&nbsp;</span><br/>
                            		<span class="pink_bar" style="width:<? echo GetBar($_SESSION['UsErIdFrOnT'], 3); ?>%;">&nbsp;</span>
                        </div>
                    </div>
                </div>
                   
                </div></div></div>
  			
  		<div style="height:49%;width:100%;background:white;margin-top:1%;opacity: 0.7;">
  				
  				
  		
  		</div>
  	</div>	
  		</div>
  	
  	
  	
  	</div>
  	
  	
  	
  	
  	<div style="display:block;width:100%;height:12%;position:absolute;float:bottom;z-index:20;position:relative;">
  		<div  style="position:relative;width:33%;height:100%;margin-right=0.3%;display:inline-block;float:top;margin-bottom:2.85714%;">
  			<div style="background:#5D4C45;height:100%;width:24%;margin-right:1.33%;display:inline-block;position:relative;float:left;">
  			
  			<a href="#" onClick="LoadFooterSoulmates('Infinity');"><img id="Infinity" src="images/icon_infinity.png"
                          style="height:70%; width:70%;margin-top:15%;  margin-left:15%;"/>
                        </a>
  			</div>
  			
  			<div style="background:#5D4C45;width:24%;height:100%;margin-right:0.2%;display:inline-block;float:left;margin-right:1.33%;">
  			<a href="#" onClick="LoadFooterSoulmates('ThumbsUp');"><img id="ThumbsUp" src="images/icon_like.png" style="height:70%; width:70%;margin-top:15%;  margin-left:15%;" border="0"/></a>
  			</div>
  			
  			<div style="background:#5D4C45;width:24%;height:100%;margin-right:1%;display:inline-block;float:left;margin-right:1.33%;">
  			<a href="#" onClick="LoadFooterSoulmates('Heart');"><img
																									style="height:70%; width:70%;margin-top:15%;  margin-left:15%;" id="Heart"																					src="images/icon_heart.png" border="0"/></a>
  			</div>
  			<div style="background:#5D4C45;width:24%;height:100%;display:inline-block;float:left;">
  			<a href="#" onClick="LoadFooterSoulmates('Ideas');">
																									<img id="Ideas"
                                                                                                  style="height:70%; width:70%;margin-top:15%;  margin-left:15%;"
                                                                                                  src="images/icon_idea.png"
                                                                                                  border="0"/></a>
  			</div>
  	
  		</div>
  		<div  style="position:relative;width:33%;height:100%;margin-right=0.3%;display:inline-block;vertical-align: top;">
  			<div style="background:black;width:24%;height:100%;margin-right:1.33%;display:inline-block;float:left;">
  			<input style="border:0;background:url(../images/icon_search.png) no-repeat;cursor:pointer;display:block;color:transparent;vertical-align:middle;float:left;height:70%; width:70%;background-size: 100% 100%;height:70%; width:70%;margin-top:15%;  margin-left:15%;" type="submit" value="Search">
  			</div>
  			<div style="background:black;width:74%;height:100%;margin-right:0.2%;display:inline-block;vertical-align: top;">
  			<input style="width:85%; height:50%;margin-left:7.5%;margin-top:10%; border-radius:10px;padding: 5px 5px 5px 25px;" type="text" value="">
  			</div>
  		</div>
  		
  		
  		<div style="width:33%;height:100%;margin-right=0.3%;display:inline-block;vertical-align: top;">
  		<div style="background:#1C947B;width:24%;height:100%;margin-right:1.33%;display:inline-block;float:left;">
  		<a href="#" onclick="UpdateMiddleSection(document.getElementById('CurrentSelectedUserId').value,'1');"><img   style="height:70%; width:70%;margin-top:15%;  margin-left:15%;" src="images/footer_icon5.jpg" border="0">	</a>
  			</div>
  			<div style="background:#1C947B;width:24%;height:100%;margin-right:1.33%;display:inline-block;vertical-align: top;float:left;">
  			<a href="#" onclick="UpdateMiddleSection(document.getElementById('CurrentSelectedUserId').value,'2');"><img  style="height:70%; width:70%;margin-top:15%;  margin-left:15%;" src="images/icon_stats.png" border="0"></a>
  			</div>
  			<div style="background:#1C947B;width:24%;height:100%;margin-right:1.33%;display:inline-block;vertical-align: top;float:left;">
  			<a href="#" onclick="UpdateMiddleSection(document.getElementById('CurrentSelectedUserId').value,'3');openPreferencesPopup('540',document.getElementById('CurrentSelectedUserId').value)"><img  style="height:70%; width:70%;margin-top:15%;  margin-left:15%;" src="images/icon_journeybook.png" border="0"></a>
  			</div>
  			<div style="background:#1C947B;width:24%;height:100%;display:inline-block;vertical-align: top;float:left;">
  			<a href="#" onclick="show_bucketlist();"><img  style="height:70%; width:70%;margin-top:15%;  margin-left:15%;" src="images/icon_bucketlist.png" border="0"></a>
  			</div>
  		</div>
  			
  </div>
</div>


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
    UpdateMiddleSection(<? echo $_SESSION['UsErIdFrOnT'];?>, 1);
    
</script>
<? include("googleanalytic.php"); ?>

</body>
</html>