<? include("connect.php"); 
include("checklogin.php");
?>
<!DOCTYPE =html>
<html>
<head>
<title><? echo "UNITY ".$SITE_TITLE;?></title>
<link href="css/style.css?rnd=<? echo rand();?>" rel="stylesheet" type="text/css" />
<script language="javascript" src="popup_fun.js?rnd=<? echo rand();?>"></script>
<script language="javascript" src="ajax_validation.js?rnd=<? echo rand();?>"></script>
<? if($_SERVER['HTTP_HOST']=='yogs'){?>
<script src="js/jquery-1.9.1.js" type="text/javascript"></script>
<? }else{?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<? }?>
<style type="text/css">*{margin:0;padding:0;-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}</style>
</head>
<body>
<div class="main">
  <? include("top_dashboard.php");?>
  <div class="container">
    <div class="clearfix">
	  <? // all popup will goes here ?>
	  	<div class="dashboardpopup" id='rightsidePOPUP_MAIN' style="display:none;"  >
			<div id="pad_wrapper_newlife">
				<div id="pad_newlife" style="border:0px solid gray;	border-radius:0px;max-width:100%;">
					<div id="rightsidePOPUP" style="color:#FFFFFF"></div>
				</div>
			</div>	
		  </div>
	  <? // end of all popup goes here?>
      <div class="column1">
        <div class="photo_list">
          <ul class="clearfix"  id="SoulmateboxID">
            <?
			$getHidedusersQryRs=mysql_query("SELECT userid_to FROM users_hide WHERE userid_from='".$_SESSION['UsErIdFrOnT']."'");
			$TotgetHidedusersQryRs=mysql_affected_rows();
			if($TotgetHidedusersQryRs>0)	
			{
				while($getHidedusersQryRow=mysql_fetch_array($getHidedusersQryRs))
				{
					$userid_to.=$getHidedusersQryRow['userid_to'].",";
				}	
				$userid_to=substr($userid_to,0,-1);
				$andQryHide=" and id not in ($userid_to)";
			}
			$getHidedusersQryRs=mysql_query("SELECT userid_to FROM users_zap WHERE userid_from='".$_SESSION['UsErIdFrOnT']."'");
			$TotgetHidedusersQryRs=mysql_affected_rows();
			if($TotgetHidedusersQryRs>0)	
			{
				while($getHidedusersQryRow=mysql_fetch_array($getHidedusersQryRs))
				{
					$userid_to2.=$getHidedusersQryRow['userid_to'].",";
				}	
				$userid_to2=substr($userid_to2,0,-1);
				$andQryHide.=" and id not in ($userid_to2)";
			}
			$GetUsersQry="SELECT id,avatarid FROM users WHERE active='Y' and id!='".$_SESSION['UsErIdFrOnT']."' $andQryHide ORDER BY id DESC";
			$GetUsersQryRs=mysql_query($GetUsersQry);
			while($GetUsersQryRow=mysql_fetch_array($GetUsersQryRs))
			{
			?>
            	<li onClick="ClickAvatar(<? echo $GetUsersQryRow['id']?>,'1');">
					<div class="icon_wrap" style="color:#ffffff;text-align:center;">
						<? echo GetUserName($GetUsersQryRow['id']);?>
						<?php /*?><a href="#" class="link_icon">Link</a> <a href="#" class="like_icon">Like</a><a href="#" class="fav_icon">Favourite</a><?php */?>
					</div>
					<img src="<? echo GetAvatarImage($GetUsersQryRow['avatarid']);?>" alt="" width="75" height="114" />
				</li>
			<? }?>
          </ul>
        </div>
        <div class="footer_left">&nbsp;<a href="#" onClick="LoadFooterSoulmates('Infinity');"><img id="Infinity" src="images/footer_icon1.jpg" border="0" align="absmiddle" /></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onClick="LoadFooterSoulmates('ThumbsUp');"><img id="ThumbsUp" src="images/footer_icon2.jpg" border="0" align="absmiddle" /></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onClick="LoadFooterSoulmates('Heart');"><img id="Heart" src="images/footer_icon3.jpg" border="0" align="absmiddle" /></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onClick="LoadFooterSoulmates('Ideas');"><img id="Ideas" src="images/footer_icon4.jpg" border="0" align="absmiddle" /></a></div>
      </div>
	  
	  <? // middle section - DEFAULT?>
      <div class="column2" style="display:inline" id="MiddleSection_default">
        <div class="clearfix">
          <div class="journey_book"><a href="journeystats.php" style="color:#fff;text-decoration:none;">journey book</a></div>
        </div>
        <div class="footer_mid">&nbsp;<img src="images/footer_icon5.jpg" border="0" align="absmiddle" />&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/footer_icon6.jpg" border="0" align="absmiddle" />&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/footer_icon7.jpg" border="0" align="absmiddle" />&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/footer_icon8.jpg" border="0" align="absmiddle" /></div>
      </div>
	  
	  <? // middle section - this section will get updated based on the avatar click?>
	  <div class="column2" style="display:none" id="MiddleSection_updating">
        <div class="clearfix">
          <div class="journey_book"><a href="journeystats.php" style="color:#fff;text-decoration:none;">journey book</a></div>
        </div>
        <div class="journal_section">
          <div class="journal_links"> <a href="#">unlikely to reply</a> | <a href="#">likely to chat</a> | <a href="#">likes to go out</a> | <a href="#">ready for long term</a>
            <div class="status_bar"> <img src="images/status-bar.jpg" alt="" /> </div>
          </div>
          <div class="journal_bg clearfix">
            <div class="journal_box">
              <h2>Journal</h2>
              <div class="journal_data clearfix">
                <div class="journal_bar"> <a href="#" class="hide_icon"></a><br />
                  <a href="#" class="bomb_icon"></a><br />
                  <a href="#" class="stars_icon"></a><br />
                  <a href="#" class="challenge_icon"></a><br />
                  <a href="#" class="music_icon"></a><br />
                  <a href="#" class="strike_icon"></a><br />
                  <a href="#" class="outing_icon"></a> </div>
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
                <li><a href="journey_questions.php?grp=2"><img src="images/blue-lock.jpg" alt="" /></a></li>
                <li><a href="journey_questions.php?grp=1"><img src="images/yellow-lock.jpg" alt="" /></a></li>
                <li><a href="journey_questions.php?grp=3"><img src="images/pink-lock.jpg" alt="" /></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="pager"> <a href="#">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> </div>
        <div class="footer_mid"> Game Zone </div>
      </div>
	  
      <div class="column3">
        <div class="status"  style="visibility:hidden" id="Graphs_BOTH">
			<span class="blue_bar" id="Graphs_BOTH_1">&nbsp;</span><br />
          	<span class="yellow_bar" id="Graphs_BOTH_2">&nbsp;</span><?php /*?> 097%<br /><?php */?><br />
          	<span class="pink_bar" id="Graphs_BOTH_3">&nbsp;</span>
		</div>
        <div class="user_status" style="visibility:hidden" id="Graphs_YOU">
          <div class="clearfix">
            <div class="user_box" id="Graphs_YOU_4">you</div>
            <div class="user_stat"> 
			  <span class="blue_bar" id="Graphs_YOU_2">&nbsp;</span><br />
              <span class="yellow_bar" id="Graphs_YOU_1">&nbsp;</span><br />
              <span class="pink_bar" id="Graphs_YOU_3">&nbsp;</span>
			</div>
          </div>
        </div>
        <div class="user_status"  id="Graphs_ME">
          <div class="clearfix" style="cursor:pointer">
            <div class="user_box" <? echo GetMyColor($_SESSION['UsErIdFrOnT']);?> onClick="UpdateMiddleSection(<? echo $_SESSION['UsErIdFrOnT'];?>,1);document.getElementById('CurrentSelectedUserId').value='<? echo $_SESSION['UsErIdFrOnT'];?>';">me</div>
            <div class="user_stat"> 
			  <span class="blue_bar" style="width:<? echo GetBar($_SESSION['UsErIdFrOnT'],2);?>%;">&nbsp;</span><br />
              <span class="yellow_bar" style="width:<? echo GetBar($_SESSION['UsErIdFrOnT'],1);?>%;">&nbsp;</span><br />
              <span class="pink_bar" style="width:<? echo GetBar($_SESSION['UsErIdFrOnT'],3);?>%;">&nbsp;</span>
			</div>
          </div>
        </div>
        <? include("right_icons.php");?>
        <div class="footer_right">
          <div class="clearfix"><input type="submit" value="Search" />
            <input type="text" value="" />
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<? if($_REQUEST['LoadEmail']!=''){?>
<script language="javascript">
show_pop('popup_emails.php');
document.getElementById('CurrentSelectedUserId').value=<? echo $_REQUEST['LoadEmail'];?>;
LoadEmail(<? echo $_REQUEST['LoadEmail'];?>);
</script>
<? }?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js?ver=1.6.1"></script>
<script language="javascript">
$(document).ready(function(){ resizeDiv();});
window.onresize = function(event) {resizeDiv();}
function resizeDiv() 
{
	vpw = $(window).width();
	vph = $(window).height();
	if(vpw==1024) { vph=vph-144; }
	else if(vpw==1280) { vph=vph-151; }
	else if(vpw==1360) { vph=vph-161; }
	else if(vpw==1600) { vph=vph-178; }
	else if(vpw==1440) { vph=vph-198; }
	else { vph=vph-163; }
	$('#SoulmateboxID').css({'height': vph + 'px'});
}

UpdateMiddleSection(<? echo $_SESSION['UsErIdFrOnT'];?>,1);
</script>
<? include("googleanalytic.php");?>
</body>
</html>