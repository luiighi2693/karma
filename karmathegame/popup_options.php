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
                <img src="images/icon_gears.png" border="0" alt="">
            </div>
            <div class="text_holder" style="width:48%">
		Options
            </div>
            
             <div class="text_holder" style="width:15%;cursor:pointer;font-size:2.3vw;" onclick="hide_pop(); show_pop('popup_dashboard.php')" >
		>STEP 1
            </div>
             <div class="text_holder" style="width:15%;cursor:pointer;font-size:2.2vw;">
		 >aDvAnCeD
            </div>
          
            <div class="icon_holder"style="float:right;">
                <a href="#" onclick="hide_pop();return false;"><img src="images/popup_close.png" border="0" alt=""/></a>
            </div>
        </div>
    </div>
    <div class="middlesection">
        <div class="centered_info">
        	<div class="blocks_3" style="height:100%; margin-top:1%;">
        		<div class="verticalsplit" style="text-align:center;display:inline-block; float:top;">
        			<p style="color:white; font-size:3vh;">Layout
        			 
        			
                		
              			  <div style="margin-top:2%;">
                   		 <img src="images/layout1.png" border="0" style="height:40%;width:80%;">
                		</div>
        		</div>
        		
        	<div class="verticalsplit" style="margin-top:5%;">
        			<div class="musicoptions" >
               				 <p style="color:white;font-size:3vh;">AI AUDIO</p>

               			 <form style="text-align:left; margin-left:47%;">
                   		 <br/>
                   		 <input type="checkbox" id="radio1" name="radio1" onclick="control(1);" style="background:gray;"/>
                  		  <label id="text3vh" for="radio1"><span>Yes</span></label>
                   		 <br/>
                   		 <input type="checkbox" id="radio2" onclick="control(2);" name="radio2"/>
                   		 <label id="text3vh" for="radio2"><span>No</span></label>
                    		<br/>
                    		<input type="checkbox" id="radio3" name="radio3" onclick="control(3);"/>
                    		<label  style="font-size:1vw;" for="radio3"><span>When asked</span></label>
                </form>

            </div>
        		</div>
        	</div>
        	
        	<div class="blocks_3" style="height:100%;margin-top:1%;text-align:center;">
        		<p style="color:white; font-size:3vh;">Color</p>
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
                                         <li><a href="#" onclick="color(5);"><img src="images/color5.png" alt="color5"
                                                                  title="color5" border="0"/></a></li>
                      			 
                    </ul>
                </div>
        	</div>
        	
        	
        	<div class="blocks_3" style="height:100%;text-align:center;margin-top:1%;">
        	<p style="color:white; font-size:3vh;">Background</p>
        	  	<div class="themes-list">
                    		<ul class="list4themes">
                       			 <li><a href="#" onclick="theme2(1);"><img src="images/theme1-small.jpg" alt="Theme2"
                                                                  title="Theme1" border="0"/></a></li>
                      			  <li><a href="#" onclick="theme2(2);"><img src="images/theme2-small.jpg" alt="Theme2"
                                                                  title="Theme2" border="0"/></a></li>
                       			 <li><a href="#" onclick="theme2(3);"><img src="images/theme3-small.jpg" alt="Theme3"
                                                                  title="Theme3" border="0"/></a></li>
                        		<li><a href="#" onclick="theme2(4);"><img src="images/theme4-small.jpg" alt="Theme4"
                                                                  title="Theme4" border="0"/></a></li>
                        		<li><a href="#" onclick="theme2(5);"><img src="images/theme5-small.jpg" alt="Theme5"
                                                                  title="Theme5" border="0"/></a></li>
                        		<li><a href="#" onclick="theme2(7);"><img src="images/theme6-small.jpg" alt="Theme6"
                                                                  title="Theme6" border="0"/></a></li>
                        		<li><a href="#" onclick="theme2(6);"><img src="images/theme7-small.jpg" alt="Theme7"
                                                                  title="Theme7" border="0"/></a></li>
                        		<li><a href="#" onclick="theme2(8);"><img src="images/theme8-small.jpg" alt="Theme8"
                                                                  title="Theme8" border="0"/></a></li>
                    </ul>
                </div>
        	</div>
        	
    	</div>
    </div>
 <div class="footer">
 	<div class="centered_info">
		 <div class="button">
			<a href="#" onclick="hide_pop();return false;">
				<img src="images/close-button.png" border="0" />
			</a>
		</div>
		<div class="button">
		<input type="image"  src="images/button_apply.png" align="top" onclick="save()" />
		</div>
	</div>
  </div>
</body>
</html>