<? include("connect.php");
$TOPCONDENSE="YES";
include("checklogin.php");
if($_SESSION['LIVESID']=="") {header("location:select-lives.php"); exit;}
if($_POST['HidContinueCheckout']=="1")
{

	    $_SESSION['total']=stripslashes(GetName1("lifes","amount","id",$_SESSION['LIVESID']));
		$_SESSION['finaltotal']=$_SESSION['total'];
		
		$_SESSION['cctype'] = addslashes($_POST['cardtype']);
		$_SESSION['ccnumber'] = addslashes($_POST['cnumber']);	
		$_SESSION['ccmonth'] = addslashes($_POST['month']);	
		$_SESSION['ccyear'] = addslashes($_POST['year']);	
		$_SESSION['cvv'] = addslashes($_POST['cvv']);							
		$_SESSION['ship_fname'] = addslashes($_POST['ship_firstname']);					
		$_SESSION['ship_lname'] = addslashes($_POST['ship_lastname']);
		$_SESSION['ship_address1'] = addslashes($_POST['ship_address1']);
		$_SESSION['ship_address2'] = addslashes($_POST['ship_address2']);
		$_SESSION['ship_city'] = addslashes($_POST['ship_city']);
		$_SESSION['ship_state'] = addslashes($_POST['ship_state']);
		$_SESSION['ship_country'] = addslashes($_POST['ship_country']);
		$_SESSION['ship_zipcode'] = addslashes($_POST['ship_zip']);
		$_SESSION['ship_day_telephone'] = addslashes($_POST['ship_phone']);					
		$_SESSION['fname'] = addslashes($_POST['firstname']);					
		$_SESSION['lname'] = addslashes($_POST['lastname']);
		$_SESSION['address1'] = addslashes($_POST['address1']);
		$_SESSION['address2'] = addslashes($_POST['address2']);
		$_SESSION['city'] = addslashes($_POST['city']);
		$_SESSION['state'] = addslashes($_POST['state']);
		$_SESSION['country'] = addslashes($_POST['country']);
		$_SESSION['zipcode'] = addslashes($_POST['zip']);
		$_SESSION['day_telephone'] = addslashes($_POST['phone']);	
		
		$query_order = "insert into ordermaster 
						set userid = '".$_SESSION['UsErIdFrOnT']."',
						orderdate =now(),
						total = '".$_SESSION['total']."',
						grandtotal = '".$_SESSION['finaltotal']."',
						cctype = '".addslashes($_SESSION['cctype'])."',	
						ccnumber = '".addslashes(substr($_SESSION['ccnumber'],0,4))."',	
						ccmonth = '".addslashes($_SESSION['ccmonth'])."',	
						ccyear = '".addslashes($_SESSION['ccyear'])."',	
						cvv = '',							
						ship_fname = '".addslashes($_SESSION['ship_fname'])."',					
						ship_lname = '".addslashes($_SESSION['ship_lname'])."',
						ship_address1 = '".addslashes($_SESSION['ship_address1'])."',
						ship_address2 = '".addslashes($_SESSION['ship_address2'])."',
						ship_city = '".addslashes($_SESSION['ship_city'])."',
						ship_state = '".addslashes($_SESSION['ship_state'])."',
						ship_country = '".addslashes($_SESSION['ship_country'])."',
						ship_zipcode = '".addslashes($_SESSION['ship_zipcode'])."',
						ship_day_telephone = '".addslashes($_SESSION['ship_day_telephone'])."',					
						fname = '".addslashes($_SESSION['fname'])."',					
						lname = '".addslashes($_SESSION['lname'])."',
						address1 = '".addslashes($_SESSION['address1'])."',
						address2 = '".addslashes($_SESSION['address2'])."',
						city = '".addslashes($_SESSION['city'])."',
						state = '".addslashes($_SESSION['state'])."',
						country = '".addslashes($_SESSION['country'])."',
						zipcode = '".addslashes($_SESSION['zipcode'])."',
						day_telephone = '".addslashes($_SESSION['day_telephone'])."',					
						email= '".addslashes($CURRENTgetuserwryRow['email'])."',
						orderstatus = 'In process',
						ispaid= 'notpaid'";
		mysql_query($query_order) or die(mysql_error()); 
		$_SESSION['orderid'] = mysql_insert_id();
		
		$temp_ord=$_SESSION['orderid'];
		$orderno="ORD".substr("0000000".$temp_ord,-7);
		$query_order2 = mysql_query("update ordermaster set orderid = '".$orderno."' where id='".$temp_ord."'");
		
		//order details		
		$query_product_detail = "insert into orderdetail 
								 set orderid = '".$_SESSION['orderid']."',
								 pid = '".$_SESSION['LIVESID']."',
								 quantity = '1',
								 price = '".$_SESSION['total']."'";
		mysql_query($query_product_detail) or die(mysql_error()); 
		//order details
			
		header("location:paypal.php");
		exit;
}

function fillsstate($scountry, $sstate)
  {
	if($scountry!="")
	{
		$qry="SELECT state_name from state where id_country=(SELECT id_country from country where country_name='".$scountry."') order by state_name";
		$res=mysql_query($qry);
		$statelist="<select name='ship_state' id='ship_state' class='register_textfield2' style='width:153px; ' ><option value=''>Select State</option>";
		if(mysql_affected_rows()>0)
		{
		  while($row=mysql_fetch_array($res))
		  {
			if($sstate==$row['state_name'])
			  $statelist.="<option value='".$row['state_name']."' selected>".$row['state_name']."</option>";
			else
			  $statelist.="<option value='".$row['state_name']."'>".$row['state_name']."</option>";
		  }
		}
		$statelist.="</select>";
		echo $statelist;
	}
  }

  function fillbstate($bcountry, $bstate)
  {
	if($bcountry!="")
	{
		$qry="SELECT state_name from state where id_country=(SELECT id_country from country where country_name='".$bcountry."') order by state_name";
		$res=mysql_query($qry);
		$statelist="<select name='state' id='state' class='register_textfield2' style='width:153px;' ><option value=''>Select State</option>";
		if(mysql_affected_rows()>0)
		{
		  while($row=mysql_fetch_array($res))
		  {
			if($bstate==$row['state_name'])
			  $statelist.="<option value='".$row['state_name']."' selected>".$row['state_name']."</option>";
			else
			  $statelist.="<option value='".$row['state_name']."'>".$row['state_name']."</option>";
		  }
		}
		$statelist.="</select>";
		echo $statelist;
	}
  }
if($SelUserInfoRow->ship_country=="") {$scountry="USA";}else{$scountry=$SelUserInfoRow->ship_country;}
if($SelUserInfoRow->country=="") {$bcountry="USA";}else{$bcountry=$SelUserInfoRow->country;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo $SITE_TITLE;?></title>
<link href="css/opening_styles.css" rel="stylesheet" type="text/css" media="screen">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/JavaScript" language="javascript" src="ajax_validation.js"></script>
</head>
<body>
<? include("top.php");?>
<div id="top_line"></div>
<br />
<div id="headline_titles"> </div>
<style type="text/css">
body{background-image:url('images/background3.png');background-color:#e6e6e6;background-position:top center; background-size:100%;background-repeat:no-repeat;background-attachment:fixed;background-border:0px 5px 0px 5px;color:#FFFFFF;}
</style>
<div id="pad_wrapper">
  	<div id="pad_selectavatar">
		<form name="frmShipInfo" id="frmShipInfo"  enctype="multipart/form-data" method="post">
		<div id="bottom_border_newlife">
		  <p align="left">
		  	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
				<tr>
					<td align="left" valign="middle" height="50" ><h1 style="text-align:left;padding:0px;">Payment Information </h1></td>
				  </tr>
				  <? if($_REQUEST['msg']!=''){?>
				  <tr>
                      <td align="center" style="color:#FF0000;" valign="top"><? echo $_REQUEST['msg'];?></td>
                  </tr>
				 <? }?>	
				 <tr>
				  <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td width="50%" align="left" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
							<tr>
							  <td height="30" align="left" valign="middle" style="vertical-align:middle;">Billing Information</td>
							</tr>
							<tr>
							  <td align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="5">
								  <tr>
									<td width="32%" align="left" valign="middle">First Name: <span class="font_11_red">*</span></td>
									<td width="68%" align="left" valign="middle"><input name="firstname" type="text" class="register_textfield2" id="firstname" value="<?=$_SESSION['fname'];?>"/></td>
								  </tr>
								  <tr>
									<td align="left" valign="middle">Last Name: <span class="font_11_red">*</span></td>
									<td align="left" valign="middle"><input name="lastname" type="text" class="register_textfield2" id="lastname" value="<?=stripslashes($_SESSION['lname']);?>"/></td>
								  </tr>
								  <tr>
									<td align="left" valign="middle">Address1: <span class="font_11_red">*</span></td>
									<td align="left" valign="middle"><input name="address1" type="text" class="register_textfield2" id="address1" value="<?=stripslashes($_SESSION['address1']);?>"/></td>
								  </tr>
								  <tr>
									<td align="left" valign="middle">Address2:</td>
									<td align="left" valign="middle"><input name="address2" type="text" class="register_textfield2" id="address2" value="<?=stripslashes($_SESSION['address2']);?>"/></td>
								  </tr>
								  <tr>
									<td align="left" valign="middle">City: <span class="font_11_red">*</span></td>
									<td align="left" valign="middle"><input name="city" type="text" class="register_textfield2" id="city" value="<?=stripslashes($_SESSION['city']);?>"/></td>
								  </tr>
								  <tr>
									<td align="left" valign="middle">Country: <span class="font_11_red">*</span></td>
									<td align="left" valign="middle"><select name="country" id="country"  class="register_textfield2" style="width:153px;" onchange="LoadCountry_States('LoadCountr_States_ID',this.value,'state','153');" >
										<option value="">Select Country</option>
										<?=GetDropdown(country_name,country_name,country,' order by country_name asc',$_SESSION['country']);?>
								  </select></td>
								  </tr>
								  <tr>
									<td align="left" valign="middle">State/Province: <span class="font_11_red">*</span></td>
									<td align="left" valign="middle" id="LoadCountr_States_ID"><span id="bstate2"><?  fillbstate($bcountry,$_SESSION['state']); ?></span></td>
								  </tr>
								  <tr>
									<td align="left" valign="middle">Zip Code: <span class="font_11_red">*</span></td>
									<td align="left" valign="middle"><input name="zip" type="text" class="register_textfield2" id="zip" value="<?=stripslashes($_SESSION['zipcode']);?>"/></td>
								  </tr>
								  <tr>
									<td align="left" valign="middle">Phone#: <span class="font_11_red">*</span></td>
									<td align="left" valign="middle"><input name="phone" type="text" class="register_textfield2" id="phone" value="<?=stripslashes($_SESSION['day_telephone']);?>"/></td>
								  </tr>
								</table></td>
							</tr>
						  </table></td>
						<td width="50%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
							
							<tr>
							  <td height="30" align="left" valign="middle" style="vertical-align:middle;">Shipping Information <span class="font-12-gra">&nbsp;<input type="checkbox" name="sameasship" onClick="chk_ship();" /> Same as Billing</span></td>
							</tr>
							<tr>
							  <td align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="5">
								  <tr>
									<td width="32%" align="left" valign="middle" class="txt_grey12_ari">First Name: <span class="font_11_red">*</span></td>
									<td width="68%" align="left" valign="middle"><input name="ship_firstname" type="text" class="register_textfield2" id="ship_firstname" value="<?=stripslashes($_SESSION['ship_fname']);?>"/></td>
								  </tr>
								  <tr>
									<td align="left" valign="middle" class="txt_grey12_ari">Last Name: <span class="font_11_red">*</span></td>
									<td align="left" valign="middle"><input name="ship_lastname" type="text" class="register_textfield2" id="ship_lastname" value="<?=stripslashes($_SESSION['ship_lname']);?>"/></td>
								  </tr>
								  <tr>
									<td align="left" valign="middle" class="txt_grey12_ari">Address1: <span class="font_11_red">*</span></td>
									<td align="left" valign="middle"><input name="ship_address1" type="text" class="register_textfield2" id="ship_address1" value="<?=stripslashes($_SESSION['ship_address1']);?>"/></td>
								  </tr>
								  <tr>
									<td align="left" valign="middle" class="txt_grey12_ari">Address2:  </td>
									<td align="left" valign="middle"><input name="ship_address2" type="text" class="register_textfield2" id="ship_address2" value="<?=stripslashes($_SESSION['ship_address2']);?>"/></td>
								  </tr>
								  <tr>
									<td align="left" valign="middle" class="txt_grey12_ari">City: <span class="font_11_red">*</span></td>
									<td align="left" valign="middle"><input name="ship_city" type="text" class="register_textfield2" id="ship_city" value="<?=stripslashes($_SESSION['ship_city']);?>"/></td>
								  </tr>
								  <tr>
									<td align="left" valign="middle" class="txt_grey12_ari">Country: <span class="font_11_red">*</span></td>
									<td align="left" valign="middle"><select name="ship_country" id="ship_country"  class="register_textfield2"   style="width:153px;"   onchange="LoadCountry_States('LoadCountr_States_ID2',this.value,'ship_state','153');" >
												<option value="">Select Country</option>
												<?=GetDropdown(country_name,country_name,country,' order by country_name asc',$_SESSION['ship_country']);?>
										  </select></td>
								  </tr>
								  <tr>
									<td align="left" valign="middle" class="txt_grey12_ari">State/Province: <span class="font_11_red">*</span></td>
									<td align="left" valign="middle" id="LoadCountr_States_ID2"><span id="sstate1"><? fillsstate($scountry,$_SESSION['ship_state']); ?></span></td>
								  </tr>
								  <tr>
									<td align="left" valign="middle" class="txt_grey12_ari">Zip Code: <span class="font_11_red">*</span></td>
									<td align="left" valign="middle"><input name="ship_zip" type="text" class="register_textfield2" id="ship_zip" value="<?=stripslashes($_SESSION['ship_zipcode']);?>"/></td>
								  </tr>
								  <tr>
									<td align="left" valign="middle" class="txt_grey12_ari">Phone#: <span class="font_11_red">*</span></td>
									<td align="left" valign="middle"><input name="ship_phone" type="text" class="register_textfield2" id="ship_phone" value="<?=stripslashes($_SESSION['ship_day_telephone']);?>"/></td>
								  </tr>
								</table></td>
							</tr>
						  </table></td>
					  </tr>
					</table></td>
				</tr>
				
				
				
				<tr>
					<td align="left" height="40"  style="vertical-align:middle;"  >Payment Information</td>
				</tr>
				<tr>
					<td valign="top">
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="5">
						<tr>
						  <td width="16%" align="left" valign="middle" >Card Type: <span class="font_11_red">*</span></td>
						  <td width="84%"  align="left" valign="middle"><select name="cardtype" id="cardtype" class="register_textfield2" style="width:153px;">
							  <option value="">Select Card Type</option>
							  <?=GetDropdown(cardtype,cardtype,cardtype,' order by id asc',$_SESSION['cctype']);?>
						  </select></td>
						</tr>
						<tr>
						  <td align="left" valign="middle">Card Number: <span class="font_11_red">*</span></td>
						  <td  align="left" valign="middle"><input name="cnumber" type="text" class="register_textfield2" id="cnumber" value="<? echo $_SESSION['ccnumber'];?>"  maxlength="16" autocomplete="off"/></td>
						</tr>
						<tr>
						  <td align="left" valign="middle">Expiration: <span class="font_11_red">*</span></td>
						  <td  align="left" valign="middle"><select name="month" size="1" class="register_textfield2"  style="width:83px;">
							  <option value="" >Month </option>
							  <option value="01" <? if($_SESSION['ccmonth']=="01") echo selected;?>>January </option>
							  <option value="02" <? if($_SESSION['ccmonth']=="02") echo selected;?>>February </option>
							  <option value="03" <? if($_SESSION['ccmonth']=="03") echo selected;?>>March </option>
							  <option value="04" <? if($_SESSION['ccmonth']=="04") echo selected;?>>April </option>
							  <option value="05" <? if($_SESSION['ccmonth']=="05") echo selected;?>>May </option>
							  <option value="06" <? if($_SESSION['ccmonth']=="06") echo selected;?>>June </option>
							  <option value="07" <? if($_SESSION['ccmonth']=="07") echo selected;?>>July </option>
							  <option value="08" <? if($_SESSION['ccmonth']=="08") echo selected;?>>August </option>
							  <option value="09" <? if($_SESSION['ccmonth']=="09") echo selected;?>>September </option>
							  <option value="10" <? if($_SESSION['ccmonth']=="10") echo selected;?>>October </option>
							  <option value="11" <? if($_SESSION['ccmonth']=="11") echo selected;?>>November </option>
							  <option value="12" <? if($_SESSION['ccmonth']=="12") echo selected;?>>December </option>
							</select>
							<select name="year" class="register_textfield2" style="width:66px;" >
							  <option value="" selected="selected">Year</option>
							  <? for($i=date('Y');$i<date('Y')+15;$i++){ ?>
							  <option value="<?=$i;?>" <? if($_SESSION['ccyear']==$i) echo "selected='selected'";?>><? echo $i; ?></option>
							  <? } ?>
							</select>
						  </td>
						</tr>
						<tr>
						  <td align="left" valign="middle">CVV Number: <span class="font_11_red">*</span></td>
						  <td  align="left" valign="middle"><input name="cvv" type="password" class="register_textfield2" id="cvv" value="<? echo $_SESSION['cvv'];?>" maxlength="4" autocomplete="off"/></td>
						</tr>
					  </table>
					</td>
				</tr>
				<tr>
						<td height="50" align="center" valign="top"  >
						<input type="hidden" name="HidContinueCheckout" id="HidContinueCheckout" value="" /> 
						<input type="submit" name="submitorder" value="Submit"  onclick="return FrmChkInfo();" style="cursor:pointer;"  border="0" />
						</td>
				  </tr>
				
			  </table>
		  </p>
		</div>
		</form>
	</div>
</div>
<script language="javascript" type="text/javascript">

ocntid=0;
ostid=0;
function chk_ship()
{
	form=document.frmShipInfo;
	if(form.sameasship.checked)
	{
		form.ship_firstname.value=form.firstname.value;
		form.ship_lastname.value=form.lastname.value;		
		form.ship_address1.value=form.address1.value;
		form.ship_address2.value=form.address2.value;
		form.ship_city.value=form.city.value;
		form.ship_zip.value=form.zip.value;
		form.ship_phone.value=form.phone.value;
		ocntid=form.country.selectedIndex;
		if(ocntid!=0)
		   ostid=form.state.selectedIndex;
		form.ship_country.selectedIndex=form.country.selectedIndex;
		LoadCountry_States('LoadCountr_States_ID2',form.country.value,'ship_state','188')
	}
	else
	{
		form.ship_firstname.value="";
		form.ship_lastname.value="";
		form.ship_address1.value="";
		form.ship_address2.value="";
		form.ship_city.value="";
		form.ship_zip.value="";
		form.ship_phone.value="";
		form.ship_country.selectedIndex=0;
		LoadCountry_States('LoadCountr_States_ID2',form.ship_country.value,'ship_state','188')
	}
}

function fillst2()
{
	form=document.frmShipInfo;
	form.ship_state.selectedIndex=ostid;
}
function FrmChkInfo()
{
	form=document.frmShipInfo;
	if(form.firstname.value.split(" ").join("")=="")
	{
		alert("Please enter first name.")
		form.firstname.focus();
		return false;
	}
	if(form.lastname.value.split(" ").join("")=="")
	{
		alert("Please enter last name.")
		form.lastname.focus();
		return false;
	}
	if(form.address1.value.split(" ").join("")=="")
	{
		alert("Please enter billing address line 1.")
		form.address1.focus();
		return false;
	}
	if(form.city.value.split(" ").join("")=="")
	{
		alert("Please enter city.")
		form.city.focus();
		return false;
	}
	
	if(form.country.value.split(" ").join("")=="")
	{
		alert("Please enter billing country.")
		form.country.focus();
		return false;
	}
	if(form.state.value.split(" ").join("")=="")
	{
		alert("Please select billing state.")
		form.state.focus();
		return false;
	}
	if(form.zip.value.split(" ").join("")=="")
	{
		alert("Please enter billing zip code.")
		form.zip.focus();
		return false;
	}
	if(form.phone.value.split(" ").join("")=="")
	{
		alert("Please enter billing phone number.")
		form.phone.focus();
		return false;
	}
	if(form.ship_firstname.value.split(" ").join("")=="")
	{
		alert("Please enter shipping first name.")
		form.ship_firstname.focus();
		return false;
	}
	if(form.ship_lastname.value.split(" ").join("")=="")
	{
		alert("Please enter shipping first name.")
		form.ship_lastname.focus();
		return false;
	}
	if(form.ship_address1.value.split(" ").join("")=="")
	{
		alert("Please enter shipping address line 1.")
		form.ship_address1.focus();
		return false;
	}
	if(form.ship_city.value.split(" ").join("")=="")
	{
		alert("Please enter shipping city.")
		form.ship_city.focus();
		return false;
	}
	
	if(form.ship_country.value.split(" ").join("")=="")
	{
		alert("Please enter shipping country.")
		form.ship_country.focus();
		return false;
	}
	if(form.ship_state.value.split(" ").join("")=="")
	{
		alert("Please select shipping state.")
		form.ship_state.focus();
		return false;
	}
	if(form.ship_zip.value.split(" ").join("")=="")
	{
		alert("Please enter shipping zip code.")
		form.ship_zip.focus();
		return false;
	}
	if(form.ship_phone.value.split(" ").join("")=="")
	{
		alert("Please enter shipping phone number.")
		form.ship_phone.focus();
		return false;
	}
	
	if(document.frmShipInfo.cardtype.value=="")	
    {
    	alert("Please select the credit card type.");
		document.frmShipInfo.cardtype.focus();
		return false;
 	}
  
  	if(document.frmShipInfo.cnumber.value=="")
  	{
  		alert("Please enter credit card number.");
		document.frmShipInfo.cnumber.select();
		return false;
  	}
	if(document.frmShipInfo.cnumber.value)
  	{
    	var ccnum = document.frmShipInfo.cnumber.value;
		if(isNaN(ccnum))
		{
	   		alert("Invalid credit card number.") ;
	  		document.frmShipInfo.cnumber.select();
	  		return false;
	  	}
		if(document.frmShipInfo.cnumber.value.length < 13 || document.frmShipInfo.cnumber.value.length > 16)
		{
	   		alert("Please check the credit card number.") ;
	  		document.frmShipInfo.cnumber.select();
	  		return false;
	    }
		if(document.frmShipInfo.cvv.value == "")
		{
			alert("Please enter card security code.");
			document.frmShipInfo.cvv.focus();
			return false;
		}
		if(isNaN(document.frmShipInfo.cvv.value))
		{
			alert("Invalid card security code.");
			document.frmShipInfo.cvv.focus();
			return false;
		}
		if(document.frmShipInfo.month.value=="")
		{
			 alert("Please select the month.");
			 document.frmShipInfo.month.focus();
			 return false;
		}
		if(document.frmShipInfo.year.value=="")
		{
			alert("Please select the year of credit card expiration.");
			document.frmShipInfo.year.focus();
			return false;
		}
		
	}
	form.HidContinueCheckout.value=1;
	//form.submit();
	return true;
}

</script>
<? include("googleanalytic.php");?>
</body>
</html>