<? include("connect.php"); 
include("checklogin.php");
$TOPCONDENSE="YES";
$GetUSerWantQry="SELECT * FROM users_want WHERE userid='".$_SESSION['UsErIdFrOnT']."'";
$GetUSerWantQryRs=mysql_query($GetUSerWantQry);
$TotGetUSerWant=mysql_affected_rows();
if($TotGetUSerWant>0)
{
	$GetUSerWantQryRow=mysql_fetch_array($GetUSerWantQryRs);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo $SITE_TITLE;?></title>
<link href="css/opening_styles.css?id=<? echo rand();?>" rel="stylesheet" type="text/css" />
</head>
<body>
<? include("top.php");?>
<div id="top_line"></div><br />
<div id="headline_titles"> </div>
<style type="text/css">body{background-image:url(backgrounds/background<?echo $_GET['bg']?>.png);background-color:#e6e6e6;background-position:top center; background-size:100%;background-repeat:no-repeat;background-attachment:fixed;background-border:0px 5px 0px 5px;}</style>
<div id="pad_wrapper_Journey">
      <div id="pad_Journey" style="background:<?echo $_GET['color1']?>">
        <h1>&nbsp;</h1>
        <br>
        <div id="bottom_border_newlife" style="padding:15px;padding-top:0px;">
		  <p><h1>Values and Compatibility can be changed but answer in<br />intimacy cannot be changed.</h1></p>
		</div>
        <div id="mbook_Journey" style="width:800px;"><div style="width:100%;margin:0 auto;">
          <div id="left_column" class="left_column"> </div>
		  
           <div id="center_column" class="center_column">
            <div id="space">
              <div id="dark_block" class"dark_block"></div>
              <div id="dark_center" class"dark_center"></div>
              <div id="white_block" class"white_block"></div>
            </div>
            <div id="binder">
              <div id="dark_space" class"dark_space">
                <div id="dark_bar" class"dark_bar"></div>
                <div id="white_space" class"white_space"></div>
              </div>
            </div>
            <div id="space">
              <div id="dark_block" class"dark_block"></div>
              <div id="dark_center" class"dark_center"></div>
              <div id="white_block" class"white_block"></div>
            </div>
            <div id="binder">
              <div id="dark_space" class"dark_space">
                <div id="dark_bar" class"dark_bar"></div>
                <div id="white_space" class"white_space"></div>
              </div>
            </div>
            <div id="space">
              <div id="dark_block" class"dark_block"></div>
              <div id="dark_center" class"dark_center"></div>
              <div id="white_block" class"white_block"></div>
            </div>
            <div id="binder">
              <div id="dark_space" class"dark_space">
                <div id="dark_bar" class"dark_bar"></div>
                <div id="white_space" class"white_space"></div>
              </div>
            </div>
            <div id="space">
              <div id="dark_block" class"dark_block"></div>
              <div id="dark_center" class"dark_center"></div>
              <div id="white_block" class"white_block"></div>
            </div>
          </div>
          <div id="right_column" class="right_column">
            <div id="questions">
              <h1>Journeybook</h1>
              <div id="brown_line"></div>
              <br>
			  <? if($CURRENTgetuserwryRow['aboutme']!=''){?>
						<h1 style="font-size:16px;"><? echo stripslashes($CURRENTgetuserwryRow['aboutme']);?></h1>
			  <? }?>
			 <?php /*?> <? if($GetUSerWantQryRow['my_gender']!=''){?>
			  	<? if($GetUSerWantQryRow['want_gender1']!='' && $GetUSerWantQryRow['lookingfor1']!=''){?>
			  		<h1 style="font-size:14px;"><? echo $GetUSerWantQryRow['my_gender'];?> seeks <? echo $GetUSerWantQryRow['want_gender1'];?> for <? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor1']);?></h1>
				<? }?>
				<? if($GetUSerWantQryRow['want_gender2']!='' && $GetUSerWantQryRow['lookingfor2']!=''){?>
			  		<h1 style="font-size:14px;"><? echo $GetUSerWantQryRow['my_gender'];?> seeks <? echo $GetUSerWantQryRow['want_gender2'];?> for <? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor2']);?></h1>
				<? }?>
				<? if($GetUSerWantQryRow['want_gender3']!='' && $GetUSerWantQryRow['lookingfor3']!=''){?>
			  		<h1 style="font-size:14px;"><? echo $GetUSerWantQryRow['my_gender'];?> seeks <? echo $GetUSerWantQryRow['want_gender3'];?> for <? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor3']);?></h1>
				<? }?>
				<? if($GetUSerWantQryRow['want_gender4']!='' && $GetUSerWantQryRow['lookingfor4']!=''){?>
			  		<h1 style="font-size:14px;"><? echo $GetUSerWantQryRow['my_gender'];?> seeks <? echo $GetUSerWantQryRow['want_gender4'];?> for <? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor4']);?></h1>
				<? }?>
				<? if($GetUSerWantQryRow['want_gender5']!='' && $GetUSerWantQryRow['lookingfor5']!=''){?>
			  		<h1 style="font-size:14px;"><? echo $GetUSerWantQryRow['my_gender'];?> seeks <? echo $GetUSerWantQryRow['want_gender5'];?> for <? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor5']);?></h1>
				<? }?>
				<? if($GetUSerWantQryRow['want_gender6']!='' && $GetUSerWantQryRow['lookingfor6']!=''){?>
			  		<h1 style="font-size:14px;"><? echo $GetUSerWantQryRow['my_gender'];?> seeks <? echo $GetUSerWantQryRow['want_gender6'];?> for <? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor6']);?></h1>
				<? }?>	
			  <? }?><?php */?>
              <?php /*?><table width="100%" border="5" cellspacing="5" cellpadding="5">
                <tr>
                  <td>&nbsp;</td>
                  <td><div align="center">INCOMING</div></td>
                  <td><div align="center">OUTGOING</div></td>
                </tr>
                <tr>
                  <td><img src="images/icon_hide.png" width="56" height="56" /></td>
                  <td><div align="center"></div></td>
                  <td><div align="center"></div></td>
                </tr>
                <tr>
                  <td><img src="images/icon_bomb.png" width="56" height="56" /></td>
                  <td><div align="center"></div></td>
                  <td><div align="center"></div></td>
                </tr>
                <tr>
                  <td><img src="images/icon_stars.png" width="56" height="56" /></td>
                  <td><div align="center"></div></td>
                  <td><div align="center"></div></td>
                </tr>
                <tr>
                  <td><img src="images/icon_challenge.png" width="56" height="56" /></td>
                  <td><div align="center"></div></td>
                  <td><div align="center"></div></td>
                </tr>
                <tr>
                  <td><img src="images/icon_music.png" width="56" height="56" /></td>
                  <td><div align="center"></div></td>
                  <td><div align="center"></div></td>
                </tr>
                <tr>
                  <td><img src="images/icon_zap.png" width="56" height="56" /></td>
                  <td><div align="center"></div></td>
                  <td><div align="center"></div></td>
                </tr>
              </table><?php */?>
            </div>
          </div>
          <? include("right_journey3buttons.php");?>
		  </div>
		  
        </div>
		<div style="width:100%;height:60px;background:<?echo $_GET['color1']?>;">
			<div style="height=80%;width:10%;margin-right:5%;margin-bottom:2%;float:right;">
				<img  src="images/button_close.png" style="width:100%" "height:100%"/>
			</div>
		</div>
      </div>
	  <div align="right" style="padding-bottom:10px;float:right;width:175px;"><img src="images/guru-icon-corner.jpg" style="float:right;" /></div>
    </div>
<? include("googleanalytic.php");?>
</body>
</html>