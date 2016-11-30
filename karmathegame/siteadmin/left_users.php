<form name="frmsrch" action="manage_user.php" id="frmsrch" method="get" enctype="multipart/form-data">
	<table width="100%" border="0" cellpadding="2" cellspacing="1" >
	  <tr><td colspan="2">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="5%"><img src="images/login/bullet1.jpg" alt="bullet" width="10" height="29" /></td>
			<td width="95%"  background="images/login/leftbg.jpg"  class=form111>Search Customer </td>
		  </tr>
		</table>

	  </td></tr>
	  <tr><td colspan="2">&nbsp;</td></tr>
	  <tr>
		<td align="left" height="25" width="8%"  valign="top" style="padding-left:10px;"><strong>Keyword</strong></td>
		<td width="92%" align="left" valign="top"><input type="text" name="keyword" id="keyword" value="<? echo htmlentities(stripslashes(trim($_REQUEST["keyword"]))); ?>" style="width:155px;"  class="solidinput"/></td>
	  </tr>
	  <tr>
		<td align="left" height="25" width="8%"  valign="top" style="padding-left:10px;"><strong>Name</strong></td>
		<td width="92%" align="left" valign="top"><input type="text" name="left_name" id="left_name" value="<? echo htmlentities(stripslashes(trim($_REQUEST["left_name"]))); ?>" style="width:155px;"  class="solidinput"/></td>
	  </tr>
	  <tr>
		<td align="left" height="25" width="8%"  valign="top" style="padding-left:10px;"><strong>Email</strong></td>
		<td width="92%" align="left" valign="top"><input type="text" name="left_email" id="left_email" value="<? echo htmlentities(stripslashes(trim($_REQUEST["left_email"]))); ?>" style="width:155px;"  class="solidinput"/></td>
	  </tr>
	  
	  
	  <tr>
		<td align="left" height="25" width="8%"  valign="top"  style="padding-left:10px;"><strong>Records</strong>
		<td align="left" valign="top">
			 <select name="db_pages" id="db_pages" style="width:155px;" class="solidinput" >
				<?
				$arr_pages=array("50","100","150","200","500");
				 for ($i6=0;$i6<count($arr_pages);$i6++) { ?>
				<option value="<? echo $arr_pages[$i6] ?>" <? if ($arr_pages[$i6]==$_REQUEST['db_pages']) echo "Selected";?>><? echo $arr_pages[$i6] ?> Records per page</option>
				<? } ?>
			  </select></td>
	  </tr>
	  <tr>
		<td align="left" height="25" width="8%"  valign="top" style="padding-left:10px;"><strong>Active</strong></td>
		<td width="92%" align="left" valign="top">
		<select name="left_active" id="left_active" style="width:155px;" class="solidinput">
			<option value="">All</option>
			<option value="Y" <? if($_REQUEST["left_active"]=="Y"){echo "selected";}?>>Yes</option>
			<option value="N" <? if($_REQUEST["left_active"]=="N"){echo "selected";}?>>No</option>
	    </select>		</td>
	  </tr>
	  
	  
	  <tr>
		<td colspan="2" align="left" style="padding-left:12px;"  nowrap="nowrap"  height="30px" valign="bottom">
		  <input type="submit" name="btnsrch" id="btnsrch" class="bttn-s" value="SEARCH" onChange="frmsrch.submit();" style="width:58px;">
		  <input type="button" name="Viewallbtn" onClick="window.location.href='manage_user.php'" value="View All" class="bttn-s">
		  
		  <input type="button" name="btnreset" id="btnreset" class="bttn-s" style="width:98px;" value="Add Customer" onClick="javascript:location.href='add_user.php';" >
		   </td>
	  </tr>
	</table>
  </form>