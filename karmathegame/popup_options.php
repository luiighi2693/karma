<? include("connect.php");
include("checklogin.php");
$GetUsersQry3="SELECT * from backgrounds";
$GetUsersQryRs3=mysql_query($GetUsersQry3);
$Tot2=mysql_affected_rows();

$GetUsersQry4="SELECT * from loops where position > 0";
$GetUsersQryRs4=mysql_query($GetUsersQry4);
$Totalofloops=mysql_affected_rows();
if($Totalofloops>0)
	$getloopsrow=mysql_fetch_array($GetUsersQryRs4);

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
     <title><? echo $SITE_TITLE;?></title>
    <link href="css/style_popups.css?id=<? echo rand();?>" rel="stylesheet" type="text/css" />
    <script language="javascript">
        function hide_pop() {
            document.getElementById('rightsidePOPUP_MAIN').style.display = 'none';
        }
    </script>
</head>
<body>
 <div class="header">
        <div class="top_info">
            <div class="icon_holder">
            <? if($_REQUEST['iconcolor']=="white"){?><img src="images/icon_gears.png" height="100%" width="100%" style="margin-top:0px;" /><? }else{?><img src="images/icon_gears_black.png" height="100%" width="100%" style="margin-top:0px;" /><? } ?>
               
            </div>
            <div class="text_holder" style="width:48%">
		Options
            </div>
            
             <div class="text_holder" style="width:15%;cursor:pointer;font-size:2.3vw;" onclick="hide_pop(); show_pop('popup_dashboard.php')" >
		>Profile
            </div>
             <div class="text_holder" style="width:15%;cursor:pointer;font-size:2.2vw;">
		 >aDvAnCeD
            </div>
          
           
        </div>
    </div>
    <div class="middlesection">
        <div class="centered_info">
        	<div class="blocks_3" style="height:100%; margin-top:1%;text-align:center;">
        		
        	<p style="color:white; font-size:3vh;">audio</p>	
        	<div class="verticalsplit" style="margin-top:1%;">
       
        		<div class="musicoptions" id="musicoptions" style="float:right;padding-left:1%;margin-top:5%;" >
        			<div style="font-size:1vw;text-align:center;" class="row" id="updating_info">
        			<?echo $getloopsrow['info'];?></div>
        		<input type="range" class="range1"  onchange=" changesong(this.value);" name="range_control" min="1" max="<?echo $Totalofloops?>" value="0" /> <output for="range_control" name="range_control_value" ></output>
        		
        		</div>
        			<div class="musicoptions" id="musicoptions" >
        			<form>
               				 <div class="centered_info" style="padding-top:2%;">
               			<div class="row" >	 
               				<p style="color:white;font-size:1vw;">music</p>
				</div>
				<div class="row"  style="height:20%;margin-top:2%;">
               				<div class="icon_holder" style="width:20%;">
               				<? if($_REQUEST['iconcolor']=="white"){?><img src="images/icon_guitar_white.png" height="100%" width="100%" style="margin-top:0px;" /><? }else{?><img src="images/icon_guitar_black.png" height="100%" width="100%" style="margin-top:0px;" /><? } ?>
               				
               				</div>
               			 <div style="display:inline-block;width:70%;float:right;text-align:right;">
               					<div class="row" style="height:50%;">
               						<p style="color:white;font-size:1vw;">on / off</p>
                    				</div>
               					<div class="row" style="height:50%;margin-right:2%;">
               						<input type="checkbox" id="radio5" name="radio1" onclick="control(1);"/>
                    					<input type="checkbox" id="radio5" name="radio2" onclick="control(2);"/>
                    				</div>
                  			 </div>
               			 
               			 </div>
               			 
               			 <div class="row" style="margin-top:20%;" >	 
               				<p style="color:white;font-size:1vw;">Sound Effects</p>
				</div>
                   		<div class="row" style="height:20%;margin-top:2%;">
                   		 	<div class="icon_holder" style="width:20%;">
                   		 	<? if($_REQUEST['iconcolor']=="white"){?><img src="images/icon_dove_white.png" height="100%" width="100%" style="margin-top:0px;" /><? }else{?><img src="images/icon_dove_black.png" height="100%" width="100%" style="margin-top:0px;" /><? } ?>
               				
               				</div>
               				 <div style="display:inline-block;width:70%;float:right;text-align:right;">
               					<div class="row" style="height:50%;">
               						<p style="color:white;font-size:1vw;">on / off</p>
                    				</div>
               					<div class="row" style="height:50%;margin-right:2%;">
               						<input type="checkbox" id="radio3" name="radio3" onclick="control(3);"/>
                    					<input type="checkbox" id="radio4" name="radio4" onclick="control(4);"/>
                    				</div>
                  			 </div>
                  		  </div>
                  		  <div class="row" style="margin-top:20%;">
                  		  	 
               				<p style="color:white;font-size:1vw;">Voices and Ai</p>
					</div>
                  		  <div class="row" style="height:20%;margin-top:2%;">
                   		 	<div class="icon_holder" style="width:20%;">
                   		 	<? if($_REQUEST['iconcolor']=="white"){?><img src="images/icon_talking_white.png" height="100%" width="100%" style="margin-top:0px;" /><? }else{?><img src="images/icon_talking_black.png".png" height="100%" width="100%" style="margin-top:0px;" /><? } ?>
               				
               				</div>
               				<div style="display:inline-block;width:70%;float:right;text-align:right;">
               					<div class="row" style="height:50%;">
               						<p style="color:white;font-size:1vw;">on / off</p>
                    				</div>
               					<div class="row" style="height:50%;margin-right:2%;">
               						<input type="checkbox" id="radio5" name="radio5" onclick="control(5);"/>
                    					<input type="checkbox" id="radio6" name="radio6" onclick="control(6);"/>
                    				</div>
                  			 </div>
                   		 </div>
                   		
                    		
               			 </form>
			 </div>
            </div>
        		</div>
        	</div>
        	
        	<div class="blocks_3" style="height:100%;margin-top:1%;text-align:center;">
        		<p style="color:white; font-size:3vh;">Themes</p>
        	  	<div class="themes-list">
                    		<ul class="list4themes">
                       			 <li><a href="#" onclick="color(1);"><img src="images/color1.png" alt="color1"
                                                                  title="color1" border="0"/></a></li>
                                         <li><a href="#" onclick="color(2);"><img src="images/color2.png" alt="color2"
                                                                  title="color2" border="0"/></a></li>
                                         <li><a href="#" onclick="color(3);"><img src="images/color3.png" alt="color3"
                                                                  title="color3" border="0"/></a></li>
                                        <li><a href="#" onclick="color(4);"><img src="images/color4.png" alt="color4"
                                                                  title="color4" border="0"/></a></li>
                                        <li><a href="#" onclick="color(6);"><img src="images/color6.png" alt="color5"
                                                                  title="color6" border="0"/></a></li>
                                         <li><a href="#" onclick="color(5);"><img src="images/color5.png" alt="color5"
                                                                  title="color5" border="0"/></a></li>
                      			 
                    </ul>
                </div>
        	</div>
        	
        	
        	<div class="blocks_3" style="height:100%;text-align:center;margin-top:1%;">
        	<p style="color:white; font-size:3vh;">Background</p>
        	  	<div class="themes-list">
        	  	
                    		<ul class="list4themes">
               
        	<?
        	 if($Tot2>0){
					while($GetUsersQryRow3=mysql_fetch_array($GetUsersQryRs3))	
						{ ?>
                       			 <li><a href="#" onclick="theme2(<? echo $GetUsersQryRow3['id'];?>);"><img src="backgrounds/<? echo $GetUsersQryRow3['img'];?>" alt="Theme" border="0"/></a></li>
                      			 
                                           <? }?>
                   <? }?>
                    </ul>
                </div>
        	</div>
        	
    	</div>
    </div>
 <div class="footer">
 	<div class="centered_info">
		 <div class="button">
			<a href="#" onclick="hide_pop();return false;">
				<img src="images/button_close.png" border="0" />
			</a>
		</div>
		<div class="button">
		<input type="image"  src="images/button_apply.png" align="top" onclick="save()" />
		</div>
	</div>
  </div>
</body>
</html>