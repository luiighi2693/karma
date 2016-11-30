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
<div id="backg"
     style="position:absolute; width:100%; height:100%; z-index:1;background-size: 100% 100%; ">
    <audio tabindex="0" id="sound">
        <source src='music/looperman-l-0782612-0087385-40a-soul-link.wav'>
    </audio>
</div>
<div class="main" style="z-index:2;">
   
    <? include("top_dashboard.php"); ?>

    <div class="container">
        <div class="clearfix">
            <? // all popup will goes here ?>
            <div class="dashboardpopup" id='rightsidePOPUP_MAIN' style="display:none;">
                <div id="pad_wrapper_newlife">
                    <div id="pad_newlife" style="border:0px solid gray;	border-radius:0px;max-width:100%;">
                        <div id="rightsidePOPUP" style="color:#FFFFFF"></div>
                    </div>
                </div>
            </div>
            <div class="dashboardpopup2" style="display:none;">
                <div id="pad_wrapper_newlife">
                    <div id="pad_newlife" style="border:0px solid gray;	border-radius:0px;max-width:100%;">
                        <div id="rightsidePOPUP" style="color:#FFFFFF"></div>
                    </div>
                </div>
            </div>
            <? // end of all popup goes here?>
            <div class="column1">
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
                            <li onClick="ClickAvatar(<? echo $GetUsersQryRow['id'] ?>,'1');">
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
                <div class="footer_left" style="width:43.5%;marginleft:4px;"><div class="blackbg" style="width:13%;"><a href="#" onClick="LoadFooterSoulmates('Infinity');"><img id="Infinity"
                                                                                                    src="images/icon_infinity.png"
                                                                                                     style="width:51px; margin-top:15px; margin-left:15px;height:51px;"/></a></div><div class="blackbg"><a href="#" onClick="LoadFooterSoulmates('ThumbsUp');"><img id="ThumbsUp"
                                                                                                     src="images/icon_like.png"
                                                                                                     style="height:51px; width:51px; margin-top:15px;margin-left:15px;"
                                                                                                     border="0"/></a></div><div class="blackbg" style="width:13%;"><a href="#" onClick="LoadFooterSoulmates('Heart');"><img
																									style="height:51;margin-top:15px; width:51px;margin-left:15px;" id="Heart"
																									src="images/icon_heart.png" border="0"/></a></div><div class="blackbg"
																									style="width:13%;"><a href="#" onClick="LoadFooterSoulmates('Ideas');">
																									<img id="Ideas"
                                                                                                  style="height:51px;margin-top:15px; width:51px;margin-left:15px;"
                                                                                                  src="images/icon_idea.png"
                                                                                                  border="0"/></a></div><div class="blackbg" style="min-height:80px;width:43%; height:100%;position:absolute;"><input id="textToSearch"
                            style="width:85%; height:30px;margin-left:8%;margin-top:25px;margin-bottom:20px; border-radius:15px;padding: 5px 5px 5px 25px;"
                            type="text" value=""/></div>
                </div>
            </div>

            <? // middle section - DEFAULT?>
         
            <div class="column2" style="display:inline" id="MiddleSection_default">
                <div class="clearfix">
                    <div class="journey_book"><a href="journeystats.php" style="color:#fff;text-decoration:none;">journey
                            book</a></div>
                </div>
                <div class="footer_mid" style="right:17.5%;">
                    <div class="blackbg" style="position:absolute;"><img
                            style="height:50px; width:50px; margin-top:15px; margin-left:15px;"
                            src="images/footer_icon5.jpg" border="0"/></div>
                    <div class="blackbg" style="position:absolute; left:16%;"><img
                            style="height:50px; width:50px; margin-top:15px; margin-left:15px;"
                            src="images/icon_stats.png" border="0"/></div>
                    <div class="blackbg" style="position:absolute; left:32%;"><img
                            style="height:50px; width:50px; margin-top:15px; margin-left:15px;"
                            src="images/icon_journeybook.png" border="0"/></div>
                    <div class="blackbg" style="position:absolute; left:44%;"><img
                            style="height:50; width:50px; margin-top:15px; margin-left:15px;"
                            src="images/icon_bucketlist.png" border="0"/></div>
                    <div class="blackbg" style="position:absolute; left:64%;"></div>
                    <div class="blackbg" style="position:absolute; left:80%;"></div>
                </div>
            </div>

            <? // middle section - this section will get updated based on the avatar click?>
            <div class="column2" style="display:none" id="MiddleSection_updating">
                <div class="clearfix">
                    <div class="journey_book"><a href="journeystats.php" style="color:#fff;text-decoration:none;">journey
                            book</a></div>
                </div>
                <div class="journal_section">
                    <div class="journal_links"><a href="#">unlikely to reply</a> | <a href="#">likely to chat</a> | <a
                            href="#">likes to go out</a> | <a href="#">ready for long term</a>
                        <div class="status_bar"><img src="images/status-bar.jpg" alt=""/></div>
                    </div>
                    <div class="journal_bg clearfix">
                        <div class="journal_box">
                            <h2>Journal</h2>
                            <div class="journal_data clearfix">
                                <div class="journal_bar"><a href="#" class="hide_icon"></a><br/>
                                    <a href="#" class="bomb_icon"></a><br/>
                                    <a href="#" class="stars_icon"></a><br/>
                                    <a href="#" class="challenge_icon"></a><br/>
                                    <a href="#" class="music_icon"></a><br/>
                                    <a href="#" class="strike_icon"></a><br/>
                                    <a href="#" class="outing_icon"></a></div>
                                <div class="journal_info">
                                    <div class="jr_info_head">
                                        <ul class="clearfix">
                                            <li>outgoing</li>
                                            <li>incoming</li>
                                        </ul>
                                    </div>
                                    <div class="jr_info_list">
                                        <ul class="clearfix">
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="jr_lock">
                            <ul>
                                <li><a href="journey_questions.php?grp=2"><img src="images/blue-lock.jpg" alt=""/></a>
                                </li>
                                <li><a href="journey_questions.php?grp=1"><img src="images/yellow-lock.jpg" alt=""/></a>
                                </li>
                                <li><a href="journey_questions.php?grp=3"><img src="images/pink-lock.jpg" alt=""/></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="pager"><a href="#">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a></div>
                <div class="footer_mid"> Game Zone</div>
            </div>

            <div class="column3">
             <div id="pop_menu" hidden
         style="position:absolute;; z-index:50;width:18.5%;background:#5d4c46;height:calc(100% - 60px); right:0; box-shadow: -3px 0px 15px 2px #000000;">
        <div style="width:30% text-align:center margin-bottom: 50px;">

            <br>
            <table style="text-align:center;margin-left:auto;margin-right:auto;" width="95%" cellspacing="0"
                   cellpadding="0" border="0" align="center">
                <tbody>
                <tr>
                    <td>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                            <tr>
                                <td width="52%">

                                </td>
                                <td width="10%" align="right">
                                    <a href="javascript:toggle();">
                                        <img src="images/popup_close.png" border="0">
                                    </a></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>

                </tr>
                </tbody>
            </table>
        </div>

        <img style="width: 100%;padding: 5%;" src="Avatars/<? echo $avatarlogo; ?>">
        <? $execute = mysql_query("SELECT aboutme FROM users WHERE id='" . $_SESSION['UsErIdFrOnT'] . "'");
        $getaboutme = mysql_fetch_array($execute);
        ?>
        <h1 style="text-align:center;color:white; font-size:15px;"><? echo $getaboutme["aboutme"] ?></h1>
        <ul style="margin-left: 36%; position:relative;top:5%">
            <li style="background:#220e0f;width:80px;"><a href="journeystats.php" "><img src="images/icon_journeybook.png"
                                                                              style="height:60px; width:60;margin: 10 10;"
                                                                              alt="JOURNEY BOOK" title="JOURNEY BOOK"
                                                                              border="0"></a></li>
            <li style="background:#220e0f;margin-top:2px;width:80px;"><a href="#"
                                                                         onclick="show_pop('popup_calendar.php');"><img
                        src="images/icon_calendar.png" style="height:60px; width:60px;margin: 10 10;" alt="CALENDAR"
                        title="CALENDAR" border="0"></a></li>
            
            <li style="background:#220e0f;width:80px;margin-top:2px;"><a href="#"><img  onclick="show_pop('popup_bucketlist.php');" src="images/icon_bucketlist.png"
                                                                            style="height:60px; width:60px;margin: 10 10;"
                                                                            alt="BUCKETLIST" title="BUCKETLIST"
                                                                            border="0"></a></li>
            <li style="background:#220e0f;width:80px;margin-top:2px;"><a href="#" onclick="show_pop('popup_bail.php');"><img
                        src="images/icon_bail.png" style="height:60x; width:60px;margin: 10 10;" alt="BAIL" title="BAIL"
                        border="0"></a></li>
            <li style="background:#220e0f;margin-top:2px;width:80px;"><a href="#" onclick="show_pop('popup_options.php');"><img
                        src="images/icon_gears.png" style="height:60px; width:60px;margin: 10 10;" alt="OPTIONS"
                        title="OPTIONS" border="0"></a></li>
            <li style="background:#220e0f;width:80px;margin-top:2px;"><a href="#"><img src="images/icon_tokens_white.png"
                                                                            style="height:60px; width:60px;margin: 10 10 ;"
                                                                            alt="TOKENS" title="TOKENS" border="0"></a>
            </li>


        </ul>
    </div>
                <div id="hidebut" style="width:100;margin: 10 auto;">
                    <li style="height:60px; width:60px; margin: 10 auto; "><span class="notifier_box"></span><a
                            href="javascript:toggle();"><img src="images/3bars.png"
                                                             style="height:56px; width:56px;margin: 2 2;"
                                                             border="0"/></a></li>
                </div>
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
                <div class="user_status" id="Graphs_ME"">
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
                <? include("right_icons.php"); ?>
                <div onclick="searchUser()" class="footer_right" style="background:black">
                    <div class="clearfix"><input style="height:50; width:20%; margin-top:15; margin-left:40%;"
                                                 type="submit" value="Search"/>


                    </div>
                </div>
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
    var searchMotorSelected = '';
    var slideIndex = 1;
    
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
        document.getElementById('Hidsubmit').value = '1';
        if(document.getElementById("username").value != null && document.getElementById("passwordUser").value !=null && document.getElementById("username").length!=0 && document.getElementById("passwordUser").length!=0){
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
    }

    function searchUser() {
        var textToSearch = document.getElementById('textToSearch').value;
        if(textToSearch == ''){
            location.href="dashboard.php";
        }else{
            jQuery.ajax({
                type: "POST",
                url: "util.php",
                data: {
                    "method" : "searchUser",
                    "username" :  textToSearch
                },
                success: function(data){
                    if(data == ''){
                        alert('username not found');
                        document.getElementById('textToSearch').value="";
                    }else{
                        console.log(data);
                        var idUser = data.split(',')[0];
                        var picture = data.split(',')[1];
                        document.getElementById('SoulmateboxID').innerHTML = '<li onClick="ClickAvatar('+idUser+',1);">' +
                                                                                '<div class="icon_wrap" style="color:#ffffff;text-align:center;">'+textToSearch+'</div>' +
                                                                                '<img src="Avatars/'+picture+'" width="75" height="114"/>' +
                                                                             '</li>';
                    }
                }
            });
        }
    }
    UpdateMiddleSection(<? echo $_SESSION['UsErIdFrOnT'];?>, 1);
</script>
<? include("googleanalytic.php"); ?>

</body>
</html>