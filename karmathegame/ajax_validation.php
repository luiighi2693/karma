<?php
include("connect.php");
global $THUMBNAIL_IMAGEPATH;
//////////Username Validation//////////
if($_REQUEST["Type"]=="LoadCountry_States")
{
	function validate($CountryName,$statefieldname,$totalwidth)
	{
		$sql1="select id_country from country where country_name='".$CountryName."'";
		$rs1=mysql_query($sql1);
		$rrow=mysql_fetch_array($rs1);
		
		
		$sql="select * from state where id_country='".$rrow['id_country']."' order by 	state_name";
		$rs=mysql_query($sql);
		$tot=mysql_affected_rows();
		
		$Data='<select name="'.$statefieldname.'" id="'.$statefieldname.'" class="register_textfield2" style="width:153px;">';
		if($tot)
		{
			$Data.="<option value=''>Select</option>";
			for($w=0;$w<$tot;$w++)
			{
				$aj=mysql_fetch_object($rs);
				$id=$aj->state_name;
				$name=stripslashes(htmlentities($aj->state_name));
				$Data.="<option value='".$id."'>".$name."</option>";
			}
		}
		else
		{
				$Data.="<option value=''>No Record</option>";
		}
		return $Data;
	}
	echo validate(trim($_REQUEST['CountryName']),trim($_REQUEST['statefieldname']),trim($_REQUEST['totalwidth']));
}
else if($_REQUEST["Type"]=="SaveQuestionsAnswer")
{
	function validate($questionid,$answerid,$answeertext)
	{
		$groupid=GetName1("questions","groupid","id",$questionid);
		$subgroupid=GetName1("questions","subgroupid","id",$questionid);
		
		$sql1="select * from users_questions where userid='".$_SESSION['UsErIdFrOnT']."' and questionid='".$questionid."'";
		$rs1=mysql_query($sql1);
		$totquestion=mysql_affected_rows();
		if($totquestion>0)
		{
			$query_product_detail = "UPDATE users_questions 
									 set userid = '".$_SESSION['UsErIdFrOnT']."',
									 questionid = '".$questionid."',
									 answerid ='".$answerid."',
									 answeertext ='".addslashes($answeertext)."',
									 groupid ='".addslashes($groupid)."',
									 subgroupid ='".addslashes($subgroupid)."',
									 updateddate =now(),
									 ipaddress = '".get_client_ip()."' WHERE userid = '".$_SESSION['UsErIdFrOnT']."' and questionid='".$questionid."'";
			mysql_query($query_product_detail) or die(mysql_error()); 
		}
		else
		{
			$query_product_detail = "insert into users_questions 
									 set userid = '".$_SESSION['UsErIdFrOnT']."',
									 questionid = '".$questionid."',
									 answerid ='".$answerid."',
									 answeertext ='".addslashes($answeertext)."',
									 groupid ='".addslashes($groupid)."',
									 subgroupid ='".addslashes($subgroupid)."',
									 addeddate =now(),
									 ipaddress = '".get_client_ip()."'";
			mysql_query($query_product_detail) or die(mysql_error()); 
		}
		return "";
	}
	echo validate(trim($_REQUEST['questionid']),trim($_REQUEST['answerid']),trim($_REQUEST['answeertext']));
}
else if($_REQUEST["Type"]=="SaveProfileAnswer")
{
	function validate($questionid,$answeertext)
	{
		$query_product_detail = "UPDATE users  SET
								 `$questionid` ='".addslashes($answeertext)."',
								 ipaddress = '".get_client_ip()."' WHERE id = '".$_SESSION['UsErIdFrOnT']."'";
		mysql_query($query_product_detail) or die(mysql_error()); 
	
		return "";
	}
	echo validate(trim($_REQUEST['questionid']),trim($_REQUEST['answeertext']));
}
else if($_REQUEST["Type"]=="DisplayGraph")
{
	function validate($userid)
	{
		$graph1=GetBar($userid,1);
		$graph2=GetBar($userid,2);
		$graph3=GetBar($userid,3);
		$getboxcolor=GetMyColor($userid,"short");
		return $graph1."#".$graph2."#".$graph3."#".$getboxcolor;
	}
	echo validate(trim($_REQUEST['userid']));
}
else if($_REQUEST["Type"]=="DisplayGraphPercent")
{
	function validate($userid)
	{
		$graph1=GetBarPercent($userid,1);
		$graph2=GetBarPercent($userid,2);
		$graph3=GetBarPercent($userid,3);
		return $graph1."#".$graph2."#".$graph3;
	}
	echo validate(trim($_REQUEST['userid']));
}
else if($_REQUEST["Type"]=="UpdateMiddleSection")
{
	function validate($userid)
	{
		$graph1=GetBar($userid,1);
		$graph2=GetBar($userid,2);
		$graph3=GetBar($userid,3);
		return $graph1."#".$graph2."#".$graph3;
	}
	echo validate(trim($_REQUEST['userid']));
}
else if($_REQUEST["Type"]=="SAVE_POPUP_INTRODUCTION")
{
	function validate($userid_from,$userid_to,$introid)
	{
		global $SITE_URL;
		$query = "insert into users_introductions 
									 set 
									 userid_from = '".addslashes($userid_from)."',
									 userid_to ='".addslashes($userid_to)."',
									 introid ='".addslashes($introid)."',
									 addeddate =now(),
									 ipaddress = '".get_client_ip()."'";
		mysql_query($query) or die(mysql_error()); 
		$insertedrecord=mysql_insert_id();
		///ADD RECORD FOR MESSAGE TABLE
		$query = "insert into users_emails 
					 set 
					 userid_from = '".addslashes($userid_from)."',
					 userid_to ='".addslashes($userid_to)."',
					 TYPE ='introduction',
					 TYPE_TABLE ='users_introductions',
					 TYPE_TABLE_ID ='".addslashes($insertedrecord)."',
					 createdate =now(),
					 ipaddress = '".get_client_ip()."'";
		mysql_query($query) or die(mysql_error()); 
		///END OF ADD RECORD FOR MESSAGE TABLE
		
		$username_from=GetUserName($userid_from);
		$username_to=GetUserName($userid_to);
		$toemail=GetName1("users","email","id",$userid_to);
		
		/*if($introid==1) {$subject1=$username_from." LIKES YOUR AVATAR.";}
		else if($introid==2) {$subject1=$username_from." LIKES YOUR TAGLINE.";}
		else if($introid==3) {$subject1=$username_from." WOULD LOVE TO CHAT WITH YOU.";}*/
		$subject1=$username_from." SENT YOU EMOTICONS.";
		
		$from1="noreply@karmathegame.guru";
		$mailcontent1='
		<table width="100%" border="0" cellpadding=0 cellspacing=0>
			<tr>
				<td align="left">
				Hello '.$username_to.',
				<br><br>
				'.$subject1.'
				<br><br>
				<a href="'.$SITE_URL.'/dashboard.php">CLICK HERE</a> TO CHECK YOUR PROFILE.
				<br><br><br>THANK YOU.
				</td>
			</tr>
		</table>';
		//echo $toemail."<br>";echo $subject1."<br>";echo $mailcontent1."<br>";echo $from1."<br>";exit;
		if($_SERVER['HTTP_HOST']!="yogs")
		{
			$headers  = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
			$headers .= "From: Karma <$from1>" . "\r\n";	
			mail($toemail, $subject1, $mailcontent1, $headers);	
		}
		
		return "SUCCESS";
	}
	echo validate(trim($_REQUEST['userid_from']),trim($_REQUEST['userid_to']),trim($_REQUEST['introid']));
}
else if($_REQUEST["Type"]=="SAVE_POPUP_GOOUT")
{
	function validate($userid_from,$userid_to,$outtype,$relationtype,$whomidea,$payby,$outdate,$outdatetime, $bucket_id, $output="false",$outtime="",$massage="")
	{
		global $SITE_URL;
		if($outtime!=""){
			$query = "insert into users_goout
				 set 
				 userid_from = '".addslashes($userid_from)."',
				 userid_to ='".addslashes($userid_to)."',
				 outtype ='".addslashes($outtype)."',
				 relationtype ='".addslashes($relationtype)."',
				 whomidea ='".addslashes($whomidea)."',
				 payby ='".addslashes($payby)."',
				 outdate ='".addslashes($outdate)."',
				 outdatetime ='".addslashes($outtime)."',
				 massage ='".addslashes($massage)."',
				 addeddate =now(),
				 ipaddress = '".get_client_ip()."'";
		mysql_query($query) or die(mysql_error()); 
		
		$insertedrecord=mysql_insert_id();
		}
		else{
		$query = "insert into users_goout
				 set 
				 userid_from = '".addslashes($userid_from)."',
				 userid_to ='".addslashes($userid_to)."',
				 outtype ='".addslashes($outtype)."',
				 relationtype ='".addslashes($relationtype)."',
				 whomidea ='".addslashes($whomidea)."',
				 payby ='".addslashes($payby)."',
				 outdate ='".addslashes($outdate)."',
				 outdatetime ='".addslashes($outdatetime)."',
				 bucket_id ='".addslashes($bucket_id)."',
				 addeddate =now(),
				 ipaddress = '".get_client_ip()."'";
		mysql_query($query) or die(mysql_error()); 
		}
		$insertedrecord=mysql_insert_id();
		///ADD RECORD FOR MESSAGE TABLE
		$query = "insert into users_emails 
					 set 
					 userid_from = '".addslashes($userid_from)."',
					 userid_to ='".addslashes($userid_to)."',
					 TYPE ='goout',
					 TYPE_TABLE ='users_goout',
					 TYPE_TABLE_ID ='".addslashes($insertedrecord)."',
					 createdate =now(),
					 ipaddress = '".get_client_ip()."'";
		mysql_query($query) or die(mysql_error()); 
		$insertedemailid=mysql_insert_id();
		///END OF ADD RECORD FOR MESSAGE TABLE
		
		$username_from=GetUserName($userid_from);
		$username_to=GetUserName($userid_to);
		$toemail=GetName1("users","email","id",$userid_to);
		
		$subject1=$username_from." REQUEST FOR GO OUT."; 
		
		$from1="noreply@karmathegame.guru";
		$mailcontent1='
		<table width="100%" border="0" cellpadding=0 cellspacing=0>
			<tr>
				<td align="left">
				Hello '.$username_to.',
				<br><br>
				'.$subject1.'
				<br><br>
				<a href="'.$SITE_URL.'/dashboard.php?LoadEmail='.$insertedemailid.'">CLICK HERE</a> TO CHECK GO OUT REQUEST.
				<br>
				<br><br><br>THANK YOU.
				</td>
			</tr>
		</table>';
		//echo $toemail."<br>";echo $subject1."<br>";echo $mailcontent1."<br>";echo $from1."<br>";exit;
		if($_SERVER['HTTP_HOST']!="yogs")
		{
			$headers  = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
			$headers .= "From: Karma <$from1>" . "\r\n";	
			mail($toemail, $subject1, $mailcontent1, $headers);	
		}
		if($output=="output"){
			return "SUCCESS";
		}
		else	return "SUCCESS";
	}
	if($_REQUEST['output'])
	{
	echo validate(trim($_REQUEST['userid_from']),trim($_REQUEST['userid_to']),trim($_REQUEST['outtype']),trim($_REQUEST['relationtype']),trim($_REQUEST['whomidea']),trim($_REQUEST['payby']),trim($_REQUEST['outdate']),trim($_REQUEST['output']),trim($_REQUEST['outtime']),trim($_REQUEST['massage']));
	}
	else
	{
	echo validate(trim($_REQUEST['userid_from']),trim($_REQUEST['userid_to']),trim($_REQUEST['outtype']),trim($_REQUEST['relationtype']),trim($_REQUEST['whomidea']),trim($_REQUEST['payby']),trim($_REQUEST['outdate']),trim($_REQUEST['outdatetime']),trim($_REQUEST['bucket_id']));
	}
}
else if($_REQUEST["Type"]=="SAVE_POPUP_CHAT")
{
	function validate($userid_from,$userid_to,$message)
	{
		$message=str_replace("RRRRRR_RRRRRR","#",$message);
		$message=str_replace("PPPPPP_PPPPPP","&",$message);
		
		$query = "insert into users_chat
				 set 
				 userid_from = '".addslashes($userid_from)."',
				 userid_to ='".addslashes($userid_to)."',
				 message ='".addslashes($message)."',
				 addeddate =now(),
				 ipaddress = '".get_client_ip()."'";
		mysql_query($query) or die(mysql_error()); 
		$lastid=mysql_insert_id();
		
		$ret='';
		$getchatsRs=mysql_query("select * FROM users_chat where id='".$lastid."'");
		while($getchatsRow=mysql_fetch_array($getchatsRs))
		{
			$username_from=GetUserName($getchatsRow['userid_from']);
			
			if($getchatsRow['userid_from']==$_SESSION['UsErIdFrOnT'])
			{
				$ret.="<div style='float:left;font-size:16px;'>".nl2br(stripslashes($getchatsRow['message']))."</div>";
			}
			else
			{
				$ret.="<div style='float:right;font-size:16px;margin-left:70px;'>".nl2br(stripslashes($getchatsRow['message']))."</div>";
			}	
			
			//$ret.=$username_from.": ".nl2br(stripslashes($getchatsRow['message']));
			$ret.="<br><br><br>";
		}
		return $ret;
	}
	echo validate(trim($_REQUEST['userid_from']),trim($_REQUEST['userid_to']),trim($_REQUEST['message']));
}
else if($_REQUEST["Type"]=="GETCHAT")
{
	function validate($userid_from,$userid_to)
	{
		$ret='';
		$getchatsRs=mysql_query("UPDATE users_chat SET 	seen='Y' WHERE userid_to='".$_SESSION['UsErIdFrOnT']."' and userid_from='".$userid_to."'");
		
		$getchatsRs=mysql_query("select * FROM users_chat where ( userid_to='".$userid_to."' and userid_from='".$userid_from."' )or ( userid_to='".$userid_from."' and userid_from='".$userid_to."') order by id asc");
		while($getchatsRow=mysql_fetch_array($getchatsRs))
		{
			$username_from=GetUserName($getchatsRow['userid_from']);
			if($getchatsRow['userid_from']==$_SESSION['UsErIdFrOnT'])
			{
				$ret.="<div style='float:left;font-size:16px;'>".nl2br(stripslashes($getchatsRow['message']))."</div>";
			}
			else
			{
				$ret.="<div style='float:right;font-size:16px;margin-left:70px;'>".nl2br(stripslashes($getchatsRow['message']))."</div>";
			}	
			$ret.="<br><br><br>";
		}
		if($ret==''){$ret='No Chat History.';}
		return $ret;
	}
	echo validate(trim($_REQUEST['userid_from']),trim($_REQUEST['userid_to']));
}
else if($_REQUEST["Type"]=="LoadRightSideChatterBox")
{
	function validate($userid_to)
	{
		$ret='';
		$avatarid=stripslashes(GetName1("users","avatarid","id",$userid_to));
		$ret='<table width="98%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td height="35"  class="dashboard_whitetext">'.GetUserName($userid_to).'</td>
				</tr> 
				<tr>
				  <td valign="top" >';
					$ret.='<img src="'.GetAvatarImage($avatarid,'big').'" width="150" height="210" />';
				  $ret.='</td>
				</tr>  
			</table>';
		return $ret;
	}
	echo validate(trim($_REQUEST['userid_to']));
}
else if($_REQUEST["Type"]=="SAVE_POPUP_HIDE")
{
	function validate($userid_from,$userid_to,$neverwann,$hideme1,$hideme2)
	{
		if($neverwann=='true')
		{
			$sql1="select * from users_hide where userid_from='".$userid_from."' and userid_to='".$userid_to."'";
			$rs1=mysql_query($sql1);
			$totquestion=mysql_affected_rows();
			if($totquestion<=0)
			{
				$query_product_detail = "insert into users_hide 
										 set userid_from = '".$userid_from."',
										 userid_to = '".$userid_to."',
										 addeddate =now(),
										 ipaddress = '".get_client_ip()."'";
				mysql_query($query_product_detail) or die(mysql_error()); 
			}
		}	
		if($hideme1=='true')
		{
			 $sql1="UPDATE users SET  hideme='Y' where id='".$userid_from."'";
			$rs1=mysql_query($sql1);
		}
		if($hideme2=='true')
		{
			$sql1="UPDATE users SET  hideme='N' where id='".$userid_from."'";
			$rs1=mysql_query($sql1);
		}	
		return "Done";
	}
	echo validate(trim($_REQUEST['userid_from']),trim($_REQUEST['userid_to']),trim($_REQUEST['neverwann']),trim($_REQUEST['hideme1']),trim($_REQUEST['hideme2']));
}
else if($_REQUEST["Type"]=="SaveWhatIwantAnswer")
{
	function validate($fieldname,$answer)
	{
		$annnd=",".$fieldname."='".$answer."'";
		$sql1="select * from  users_want where userid='".$_SESSION['UsErIdFrOnT']."' ";
		$rs1=mysql_query($sql1);
		$totquestion=mysql_affected_rows();
		if($totquestion>0)
		{
			$query_product_detail = "UPDATE  users_want 
									 set 
									 ipaddress = '".get_client_ip()."' $annnd 
									 WHERE userid = '".$_SESSION['UsErIdFrOnT']."' ";
			mysql_query($query_product_detail) or die(mysql_error()); 
		}
		else
		{
			$query_product_detail = "insert into  users_want 
									 set 
									 userid = '".$_SESSION['UsErIdFrOnT']."',
									 addeddate =now(),
									 ipaddress = '".get_client_ip()."' $annnd";
			mysql_query($query_product_detail) or die(mysql_error()); 
		}
		return "";
	}
	echo validate(trim($_REQUEST['fieldname']),trim($_REQUEST['answer']));
}
else if($_REQUEST["Type"]=="SAVE_POPUP_GROUP")
{
	function validate($userid_from,$userid_to,$groupid_new,$groupid)
	{
		if($groupid_new!='')
		{
				$sql1="select * from users_groups where userid='".$userid_from."' and name = '".addslashes($groupid_new)."'";
				$rs1=mysql_query($sql1);
				$totquestion=mysql_affected_rows();
				if($totquestion<=0)
				{
					$query_product_detail = "insert into  users_groups 
											 set userid = '".$userid_from."',
											 name = '".addslashes($groupid_new)."',
											 addeddate =now(),
											 ipaddress = '".get_client_ip()."'";
					mysql_query($query_product_detail) or die(mysql_error()); 
					$groupid=mysql_insert_id();
				}	
				else
				{
					$sql1Row=mysql_fetch_array($rs1);
					$groupid=$sql1Row['id'];
				}
		}
		
		
			$sql1="select * from users_groups_members where userid_from='".$userid_from."' and userid_to='".$userid_to."' and groupid='".$groupid."'";
			$rs1=mysql_query($sql1);
			$totquestion=mysql_affected_rows();
			if($totquestion<=0)
			{
				$query_product_detail = "insert into users_groups_members 
										 set userid_from = '".$userid_from."',
										 userid_to = '".$userid_to."',
										 groupid = '".$groupid."',
										 addeddate =now(),
										 accepted='Y',
										 ipaddress = '".get_client_ip()."'";
				mysql_query($query_product_detail) or die(mysql_error()); 
				$insertedrecord=mysql_insert_id();
				///ADD RECORD FOR MESSAGE TABLE
				$query = "insert into users_emails 
							 set 
							 userid_from = '".addslashes($userid_from)."',
							 userid_to ='".addslashes($userid_to)."',
							 TYPE ='groups',
							 TYPE_TABLE ='users_groups_members',
							 TYPE_TABLE_ID ='".addslashes($insertedrecord)."',
							 createdate =now(),
							 ipaddress = '".get_client_ip()."'";
				mysql_query($query) or die(mysql_error()); 
				///END OF ADD RECORD FOR MESSAGE TABLE
				
				return "<br>Added Successfully!";
			}
			else
			{
				return "<br>Already added in this group.";
			}
			
		
	}
	echo validate(trim($_REQUEST['userid_from']),trim($_REQUEST['userid_to']),trim($_REQUEST['groupid_new']),trim($_REQUEST['groupid']));
}
else if($_REQUEST["Type"]=="LoadEmail")
{
	function validate($emailid)
	{
		$getchatsRs=mysql_query("select * FROM users_emails where id='".$emailid."'");
		$tot=mysql_affected_rows();
		if($tot>0)
		{
			$getchatsRow=mysql_fetch_array($getchatsRs);
			
			$updateviewQry=mysql_query("UPDATE users_emails SET  viewed='Y' where id='".$emailid."'");
			
			$TYPE=$getchatsRow['TYPE'];
			$TYPE_TABLE=$getchatsRow['TYPE_TABLE'];
			$TYPE_TABLE_ID=$getchatsRow['TYPE_TABLE_ID'];
			if($TYPE!='safe')
			{
				$getDetailQryRs=mysql_query("select * FROM $TYPE_TABLE where id='".$TYPE_TABLE_ID."'");
				$totgetDetailQry=mysql_affected_rows();
			}
			$ret='<table width="100%" border="0" cellspacing="2" cellpadding="2">
				  <tr>
					<td align="left" height="30">From: '.GetUserName($getchatsRow['userid_from']).'</td>
					<td align="right" height="30">'.date("l M j, Y",strtotime($getchatsRow['createdate'])).'</td>
				  </tr>
				</table>';
				
			if($TYPE=='introduction') //if introductio email 
			{
				if($totgetDetailQry>0)
				{	
					$getDetailQryRow=mysql_fetch_array($getDetailQryRs);
					$introid=$getDetailQryRow['introid'];
					$picture=GetName1("emoticons","picture","id",$introid);
					$ret.='<table width="100%" border="0" cellspacing="2" cellpadding="2">
						  <tr>
							<td align="left" height="40" valign="top" width="60"><img src="images/icon1.jpg" width="50" height="50" /></td>
							<td align="left" height="40" valign="top"><img src="Emoticons/'.$picture.'" width="200" height="200" /></td>
						  </tr>
						</table>';	
				}		
			}
			else if($TYPE=='groups') //if introductio email 
			{
				if($totgetDetailQry>0)
				{	
					$getDetailQryRow=mysql_fetch_array($getDetailQryRs);
					$groupid=$getDetailQryRow['groupid'];
					$groupname=GetName1("users_groups","name","id",$groupid);
					$ret.='<table width="100%" border="0" cellspacing="2" cellpadding="2">
						  <tr>
							<td align="left" height="40" valign="top" width="60"><img src="images/icon3.jpg" width="50" height="50" /></td>
							<td align="left" height="40" valign="top">You have been added to <strong>'.$groupname.'</strong> group.</td>
						  </tr>
						</table>';	
				}		
			}
			else if($TYPE=='goout') //if introductio email 
			{
				if($totgetDetailQry>0)
				{	
				
				
					$getDetailQryRow=mysql_fetch_array($getDetailQryRs);
					$SEL="SELECT * from ideas where id='".$getDetailQryRow['bucket_id']."'";
					$SELRs=mysql_query($SEL);
					$ROW=mysql_fetch_object($SELRs);
					$outtype=$getDetailQryRow['outtype'];
					if($outtype=='DATE'){$outtype_1='checked';}
					if($outtype=='EVENT'){$outtype_2='checked';}
					if($outtype=='GROUP'){$outtype_3='checked';}
					
					$relationtype=$getDetailQryRow['relationtype'];
					if($relationtype=='RELATIONSHIP'){$relationtype_1='checked';}
					if($relationtype=='FRIENDSHIP'){$relationtype_2='checked';}
					
					$whomidea=$getDetailQryRow['whomidea'];
					if($whomidea=='YOUR IDEA'){$whomidea_1='checked';}
					if($whomidea=='MY IDEA'){$whomidea_2='checked';}
					
					$payby=$getDetailQryRow['payby'];
					if($payby=='I WILL PAY'){$payby_1='checked';}
					if($payby=='YOU PAY'){$payby_2='checked';}
					if($payby=='SPLIT'){$payby_3='checked';}
					if($payby=='T.C. OF Y.'){$payby_4='checked';}
					
					$ret.='<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left" height="40" valign="top" width="60"><img src="images/icon4.jpg" width="50" height="50" /></td>
							<td align="left"  valign="top" style="background-color:#5D4C46"  class="dashboard_whitetext">
								<table width="100%" border="0" cellspacing="3" cellpadding="3">
								  	<tr>
											<td>
												<table border="0" cellspacing="0" cellpadding="0">
													<tr>
													  <td  class="dashboard_whitetext">
													  <input type="radio" name="outtype" id="outtype_1" value="DATE" '.$outtype_1.'  />&nbsp;<label for="outtype_1">DATE</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													  <input type="radio" name="outtype" id="outtype_2" value="EVENT" '.$outtype_2.'/>&nbsp;<label for="outtype_2">EVENT</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
													  <input type="radio" name="outtype" id="outtype_3" value="GROUP" '.$outtype_3.' />&nbsp;<label for="outtype_3">GROUP</label> </td>
													</tr>   
												</table>
										</td>
									 </tr>
									 <tr>
											<td style="padding-top:5px;">
												<table border="0" cellspacing="0" cellpadding="0">
													<tr>
													  <td   class="dashboard_whitetext">
													  <input type="radio" name="relationtype" id="relationtype_1" value="RELATIONSHIP" '.$relationtype_1.'   />&nbsp;<label for="relationtype_1">RELATIONSHIP</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													  <input type="radio" name="relationtype" id="relationtype_2" value="FRIENDSHIP" '.$relationtype_2.'  />&nbsp;<label for="relationtype_2">FRIENDSHIP</label>
													  </td>
													</tr>   
												</table>
										</td>
									 </tr>
									 <tr>
											<td style="padding-top:5px;">
												<table border="0" cellspacing="0" cellpadding="0">
													<tr>
													  <td   class="dashboard_whitetext">WHEN <input type="text" name="outdate" value="'.$getDetailQryRow['outdate'].'"  id="outdate" placeholder="mm/dd/yyyy"  style="width:95px;"/></td>
													  <td   class="dashboard_whitetext" style="padding-left:80px;">
														  <input type="radio" name="whomidea" id="whomidea_1" value="YOUR IDEA"  '.$whomidea_1.'  />&nbsp;<label for="whomidea_1">YOUR IDEA</label>&nbsp;&nbsp;&nbsp;&nbsp;
														  <input type="radio" name="whomidea" id="whomidea_2" value="MY IDEA"  '.$whomidea_2.'  />&nbsp;<label for="whomidea_2">MY IDEA</label>
													  </td>
													</tr>   
												</table>
										</td>
									 </tr>
									 <tr>
											<td style="padding-top:5px;">
												<img src="images/goout_holder.jpg" width="70%" />
										</td>
									 </tr>
									 <tr>
											<td style="padding-top:5px;">
												<table border="0" cellspacing="0" cellpadding="0">
													<tr>
													  <td   class="dashboard_whitetext">
													  <input type="radio" name="payby" id="payby_1" value="I WILL PAY" '.$payby_1.'   />&nbsp;<label for="payby_1">I\'LL PAY</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													  <input type="radio" name="payby" id="payby_2" value="YOU PAY" '.$payby_2.'  />&nbsp;<label for="payby_2">YOU PAY</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													  <input type="radio" name="payby" id="payby_3" value="SPLIT" '.$payby_3.'  />&nbsp;<label for="payby_3">SPLIT</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													  <input type="radio" name="payby" id="payby_4" value="T.C. OF Y." '.$payby_4.' />&nbsp;<label for="payby_4">T.C. OF Y.</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													  </td>
													</tr>   
												</table>
										</td>
									 </tr>
								</table>

							</td>
						  </tr>
						  
						 
						</table>';
						$ret.='<div style="margin-bottom:-45px;margin-top:40px;width:100%;cell-padding:0px;height:42px;"><a href="#" onclick="document.getElementById(\'CurrentSelectedUserId\').value='.$getchatsRow['userid_from'].';show_pop(\'popup_letsgoout.php\');"><img src="images/button_accept.jpg" border="0" /></a><a href="#" onclick="DeleteEmail('.$getchatsRow['id'].');"><img src="images/button_reject.jpg" border="0" /></a><a href="#" onclick="show_pop(\'popup_chat.php\');GETCHAT('.$getchatsRow['userid_from'].','.$getchatsRow['userid_to'].');"><img src="images/button_reply.jpg" border="0" /></a></div>';			
				}		
			}
			else if($TYPE=='safe') //if introductio email 
			{
				$getDetailQryRs=mysql_query("select * FROM $TYPE_TABLE where id in (".$TYPE_TABLE_ID.") ");
				$totgetDetailQry=mysql_affected_rows();
				if($totgetDetailQry>0)
				{	
					$ret.='<div style="height:280px;overflow:auto;"><table width="100%" border="0" cellspacing="2" cellpadding="2">
						  <tr>
							<td align="left" height="40" valign="top" width="60"><img src="images/icon5.jpg" width="50" height="50" /></td>
							<td align="left" height="40" valign="top">';
							while($getDetailQryRow=mysql_fetch_array($getDetailQryRs))
							{
								$picture=GetName1("users_pics_videos","picture","id",$getDetailQryRow['id']);
								$type=GetName1("users_pics_videos","type","id",$getDetailQryRow['id']);
								if($type=='Picture')
								{
									$ret.='<img src="SafePicsVideos/'.$picture.'" width="250" height="250" /><br>';
								}
								if($type=='Video')
								{
									$ret.='<img src="images/icon-player.png" />';
								}
								if($type=='Music')
								{
									$auxPlay = "PlaySound('soundSharedMail')";
									$auxStop = "StopSound('soundSharedMail')";
									$ret.='<img src="images/icon-player.png" />
									<button onclick=" ' . $auxPlay . ' " type="button">Play</button>
									<button onclick=" ' . $auxStop . ' " type="button">Stop</button>
									<audio tabindex="0" id="soundSharedMail">
        								<source src="SafePicsVideos/'.$picture.'">
    								</audio>';

								}
							}	
							$ret.='</td>
						  </tr>
						</table></div>';	
					$ret.='<div style="margin-bottom:-45px;width:100%;cell-padding:0px;height:42px;"><a href="#" onclick="document.getElementById(\'CurrentSelectedUserId\').value='.$getchatsRow['userid_from'].';show_pop(\'popup_safe.php\');"><img src="images/button_accept.jpg" border="0" /></a><a href="#" onclick="DeleteEmail('.$getchatsRow['id'].');"><img src="images/button_reject.jpg" border="0" /></a><a href="#" onclick="show_pop(\'popup_chat.php\');GETCHAT('.$getchatsRow['userid_from'].','.$getchatsRow['userid_to'].');"><img src="images/button_reply.jpg" border="0" /></a></div>';		
				}		
			}
            else if($TYPE=='torb'){
                $splitRow = explode(",", $getchatsRow['TYPE_TABLE_ID']);
                $questionSelected =mysql_query("select * FROM torb_questions where id='".$splitRow[0]."'");
                $questionSelectedArray = mysql_fetch_array($questionSelected);

                $answerSelected = mysql_query("select * FROM torb_question_answers where id='".$splitRow[1]."'");
                $answerSelectedArray = mysql_fetch_array($answerSelected);
                $ret='<table width="100%" border="0" cellspacing="2" cellpadding="2">
				  <tr>
					<td style="    padding: 10px;border-bottom: solid;font-size: 24px;">'.$questionSelectedArray['torb_question'].'</td>
				  </tr>
				  <tr>
					<td style="font-size: 22px;padding: 30px;">'.$answerSelectedArray['answer'].'</td>
				  </tr>
				</table>';
            }else if($TYPE=='socialLinks'){
                $userToFrom = mysql_query("SELECT * FROM users WHERE id=".$getchatsRow['userid_from']);
                $userToFromArray = mysql_fetch_array($userToFrom);

                $socialLinks = mysql_query("SELECT * FROM users_sociallinks_share WHERE id=".$getchatsRow['TYPE_TABLE_ID']);
                $socialLinksArray = mysql_fetch_array($socialLinks);


                $ret='<table width="100%" border="0" cellspacing="2" cellpadding="2">
				  <tr>
					<td style="    padding: 10px;border-bottom: solid;font-size: 24px;">'.$userToFromArray['username'].' has shared your social Links with you:</td>
				  </tr>';

                if($socialLinksArray['social_fb_share']!='N'){
                    $ret.='<tr>
					<td style="font-size: 22px;"><img src="images/icon_facebook.png" align="absmiddle" /> '.$userToFromArray['social_fb'].'</td>
				  </tr>';
                }

                if($socialLinksArray['social_twitter_share']!='N'){
                    $ret.='<tr>
					<td style="font-size: 22px;"><img src="images/icon_twitter.png" align="absmiddle" /> '.$userToFromArray['social_twitter'].'</td>
				  </tr>';
                }

                if($socialLinksArray['social_youtube_share']!='N'){
                    $ret.='<tr>
					<td style="font-size: 22px;"><img src="images/icon_youtube.png" align="absmiddle" /> '.$userToFromArray['social_youtube'].'</td>
				  </tr>';
                }

                if($socialLinksArray['social_in_share']!='N'){
                    $ret.='<tr>
					<td style="font-size: 22px;"><img src="images/icon_linkdin.png" align="absmiddle" /> '.$userToFromArray['social_in'].'</td>
				  </tr>';
                }

                if($socialLinksArray['social_pinterest_share']!='N'){
                    $ret.='<tr>
					<td style="font-size: 22px;"><img src="images/icon_pinterest.png" align="absmiddle" /> '.$userToFromArray['social_pinterest'].'</td>
				  </tr>';
                }

                if($socialLinksArray['social_instagram_share']!='N'){
                    $ret.='<tr>
					<td style="font-size: 22px;"><img src="images/icon_instagram.png" align="absmiddle" /> '.$userToFromArray['social_instagram'].'</td>
				  </tr>';
                }

                if($socialLinksArray['social_rss_share']!='N'){
                    $ret.='<tr>
					<td style="font-size: 22px;"><img src="images/icon_rss.png" align="absmiddle" /> '.$userToFromArray['social_rss'].'</td>
				  </tr>';
                }
                $ret.='</table>';
            }else if($TYPE=='musicShare'){
                $getDetailQryRs=mysql_query("select * FROM $TYPE_TABLE where id in (".$TYPE_TABLE_ID.") ");
                $totgetDetailQry=mysql_fetch_array($getDetailQryRs);

                $youtube = 'window.open(\'https://www.youtube.com/results?search_query='.str_replace(" ","+", $totgetDetailQry['music']).'\')';
                $amazon = 'window.open(\'https://www.amazon.com/s/ref=nb_sb_noss_2?url=search-alias%3Ddigital-music-track&field-keywords='.str_replace(" ","+", $totgetDetailQry['music']).'\')';
                $spotify = 'window.open(\'https://www.google.co.ve/webhp?sourceid=chrome-instant&ion=1&espv=2&ie=UTF-8#q='.str_replace(" ","%20", $totgetDetailQry['music']).'%20site%3Aspotify.com\')';
                $pandora = 'window.open(\'https://www.pandora.com\')';

                $ret.='<table width="100%" border="0" cellspacing="2" cellpadding="2" style="font-size: 22px;">
				  <tr>
					<td style="padding-top: 25px;padding-bottom: 20px;">Has Share this song with you:</td>
				  </tr>
				   <tr>
					<td style="padding-left: 20px;padding-bottom: 20px;">'.$totgetDetailQry['music'].'</td>
				  </tr>
				   <tr>
					<td style="padding-bottom: 20px;">play with this links:</td>
				  </tr>
				  <tr>
					<td style="padding-left: 50px;">
					    <img onclick='.$youtube.' src="images/youtube.jpg" width="100px" height="100px">
					    <img onclick='.$spotify.' src="images/spotify.jpg" width="100px" height="100px">
					    <img onclick='.$amazon.' src="images/amazon.png" width="100px" height="100px">
					    <img onclick='.$pandora.' src="images/pandora.jpg" width="100px" height="100px">
					</td>
				  </tr>
				</table>';
            }
		}
		else
		{
			$ret='<table width="100%" border="0" cellspacing="2" cellpadding="2">
				  <tr>
					<td>Something went wrong.</td>
				  </tr>
				</table>';
		}	
		return $ret;
	}
	echo validate(trim($_REQUEST['emailid']));
}
else if($_REQUEST["Type"]=="DeleteEmail")
{
	function validate($emailid)
	{
		$ret='';
		$del=mysql_query("DELETE FROM users_emails WHERE id='".$emailid."'");
		return "done";
	}
	echo validate(trim($_REQUEST['emailid']));
}
else if($_REQUEST["Type"]=="SAVE_POPUP_ZAP")
{
	function validate($userid_from,$userid_to,$neverwann,$reason)
	{
		if($neverwann=='true')
		{
			$sql1="select * from  users_zap where userid_from='".$userid_from."' and userid_to='".$userid_to."'";
			$rs1=mysql_query($sql1);
			$totquestion=mysql_affected_rows();
			if($totquestion<=0)
			{
				$query_product_detail = "insert into  users_zap 
										 set userid_from = '".$userid_from."',
										 userid_to = '".$userid_to."',
										 reason = '".$reason."',
										 addeddate =now(),
										 ipaddress = '".get_client_ip()."'";
				mysql_query($query_product_detail) or die(mysql_error()); 
			}
		}	
		return "Done";
	}
	echo validate(trim($_REQUEST['userid_from']),trim($_REQUEST['userid_to']),trim($_REQUEST['neverwann']),trim($_REQUEST['reason']));
}
else if($_REQUEST["Type"]=="RequestIntimicyLock")
{
	function validate($userid_from,$userid_to)
	{
		global $SITE_URL;
		$sql1="select * from  users_intimicy_lock_request where userid_from='".$userid_from."' and userid_to='".$userid_to."'";
		$rs1=mysql_query($sql1);
		$totquestion=mysql_affected_rows();
		if($totquestion<=0)
		{
			$randm=rand(1111111111,9999999999);
			$query = "insert into users_intimicy_lock_request 
						 set 
						 userid_from = '".addslashes($userid_from)."',
						 userid_to ='".addslashes($userid_to)."',
						 randm ='".$randm."',
						 addeddate =now(),
						 ipaddress = '".get_client_ip()."'";
			mysql_query($query) or die(mysql_error()); 
			$insertedrecord=mysql_insert_id();
			
			
			$username_from=GetUserName($userid_from);
			$username_to=GetUserName($userid_to);
			$toemail=GetName1("users","email","id",$userid_to);
			
			$subject1=$username_from." REQUEST TO VIEW Intimacy Preferences.";
			
			$from1="noreply@karmathegame.guru";
			$mailcontent1='
			<table width="100%" border="0" cellpadding=0 cellspacing=0>
				<tr>
					<td align="left">
					Hello '.$username_to.',
					<br><br>
					'.$subject1.'
					<br><br>
					Click Here to <a href="'.$SITE_URL.'/intimacyrequest.php?accepted=Y&id='.$insertedrecord.'&randm='.$randm.'">ACCEPT</a> <a href="'.$SITE_URL.'/intimacyrequest.php?rejected=Y&id='.$insertedrecord.'&randm='.$randm.'">REJECT</a> .
					<br><br><br>THANK YOU.
					</td>
				</tr>
			</table>';
			//echo $toemail."<br>";echo $subject1."<br>";echo $mailcontent1."<br>";echo $from1."<br>";exit;
			if($_SERVER['HTTP_HOST']!="yogs")
			{
				$headers  = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
				$headers .= "From: Karma <$from1>" . "\r\n";	
				mail($toemail, $subject1, $mailcontent1, $headers);	
			}
		}
		return "SUCCESS";
	}
	echo validate(trim($_REQUEST['userid_from']),trim($_REQUEST['userid_to']));
}
else if($_REQUEST["Type"]=="SaveLikedTagged")
{
	function validate($userid_from,$userid_to,$type,$val)
	{
		if($val=='true')
		{
			$sql1="select * from  users_likes_tagged where userid_from='".$userid_from."' and userid_to='".$userid_to."' and type='".$type."'";
			$rs1=mysql_query($sql1);
			$totquestion=mysql_affected_rows();
			if($totquestion<=0)
			{
				$query_product_detail = "insert into  users_likes_tagged 
										 set userid_from = '".$userid_from."',
										 userid_to = '".$userid_to."',
										 type = '".$type."',
										 addeddate =now(),
										 ipaddress = '".get_client_ip()."'";
				mysql_query($query_product_detail) or die(mysql_error()); 
			}
		}	
		else
		{
			$sql1="delete  from  users_likes_tagged where userid_from='".$userid_from."' and userid_to='".$userid_to."' and type='".$type."'";
			$rs1=mysql_query($sql1);
		}
		return "Done";
	}
	echo validate(trim($_REQUEST['userid_from']),trim($_REQUEST['userid_to']),trim($_REQUEST['type']),trim($_REQUEST['val']));
}
?>