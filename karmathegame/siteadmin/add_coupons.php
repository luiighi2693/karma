<?php
include_once("admin.config.inc.php"); 
include("admin.cookie.php"); 
include("connect.php") ;
function Get_CreatePasswordXXX()
{
	$chars = "23456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";    
	srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    while ($i <= 11) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
} 
$mlevel=6;
if(isset($_POST['Submit']))
{	 
	if($_POST['chklimit']=='Y')
	{	
		$chklimit="Y";
		$notimes='';
	}
	else
	{
		$chklimit="N";
		$notimes=$_POST['notimes'];
		if($notimes=='')
		{
			$notimes=1;
		}
	}
	$disctype=$_POST['disctype'];
	$discamt=$_POST['discamt'];
	$discountfor=$_POST['discountfor'];
	$ordlimit='';
	$pid='';
	if($discountfor==2)
	{
		$ordlimit=$_POST['ordlimit'];
	}
	else if($discountfor==3)
	{
		$pid=$_POST['pid'];
	}
	if($_POST['neverexp']=="Y")
	{
		$neverexp="Y";
		$startdate=$_POST['startdate'];
		$enddate='';
	}
	else  
	{
		$neverexp="N";
		$startdate=$_POST['startdate'];
		$enddate=$_POST['enddate'];
	}
	if($_GET['id'])
	{
		$sql="UPDATE promotional  SET
		promocode='".addslashes($_POST["promocode"])."',lifes='".addslashes($_POST["lifes"])."',
		chklimit='".addslashes($chklimit)."',
		notimes='".addslashes($notimes)."',
		disctype='".addslashes($disctype)."',
		discamt='".addslashes($discamt)."',
		discountfor='".addslashes($discountfor)."',
		ordlimit='".addslashes($ordlimit)."',
		pid='".addslashes($pid)."',
		neverexp='".addslashes($neverexp)."',
		startdate='".addslashes($startdate)."',
		enddate='".addslashes($enddate)."'
		WHERE id='".$_GET['id']."'";
		mysql_query($sql);
		header("location:manage_coupons.php?msgs=3");
	}
	else
	{
	    $sql="INSERT INTO promotional  SET
	    promocode='".addslashes($_POST["promocode"])."',lifes='".addslashes($_POST["lifes"])."',
		chklimit='".addslashes($chklimit)."',
		notimes='".addslashes($notimes)."',
		disctype='".addslashes($disctype)."',
		discamt='".addslashes($discamt)."',
		discountfor='".addslashes($discountfor)."',
		ordlimit='".addslashes($ordlimit)."',
		pid='".addslashes($pid)."',
		neverexp='".addslashes($neverexp)."',
		startdate='".addslashes($startdate)."',
		enddate='".addslashes($enddate)."'";	
		mysql_query($sql);
		header("location:manage_coupons.php?msgs=1");
	}	
}
if($_GET['id'])
{
	$Buttitle="Edit";
	$SEL="SELECT * from promotional where id='".$_GET['id']."'";
	$SELRs=mysql_query($SEL);
	$ROW=mysql_fetch_object($SELRs);
} 
else
{
	$Buttitle="Add";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<title><?php echo $ADMIN_MAIN_SITE_NAME ?></title>
<LINK href="main.css" type=text/css rel=stylesheet>
<SCRIPT language=javascript src="body.js"></SCRIPT>
<script>
function showcode(fid,fvalue)
{
	document.getElementById(fid).value=fvalue;
}
function showdate(fid,fvalue)
{
	if(document.getElementById('neverexp').checked==true)
	{
		document.getElementById(fid).disabled=true;
		document.getElementById(fid).style="background-color:#999999";
	}
	else
	{
		document.getElementById(fid).disabled=false;
		document.getElementById(fid).style="";
	}
}
function showlimit(fid,fvalue)
{
	if(document.getElementById('chklimit').checked==true)
	{
		document.getElementById(fid).innerHTML='Infinite';
	}
	else
	{
		document.getElementById(fid).innerHTML='<input type="text" name="notimes" id="notimes" class="solidinput" style="width:45px;" onKeyUp="chknumeric(\'notimes\');"	value="<? echo stripslashes($ROW->notimes);?>" placeholder="1" >';
	}
}
function chkdtype(fid,fvalue)
{
	if(fvalue==2)
	dval='%';
	else
	dval='$';
	document.getElementById(fid).innerHTML=dval;
}
function valid()
{
	form=document.addprod;
	
	if(form.promocode.value.split(" ").join("")=="")
	{
		alert("Please enter coupon code.");
		form.promocode.focus();
		return false;
	}
	if(form.discamt.value.split(" ").join("")=="")
	{
		alert("Please enter discount amount.");
		form.discamt.focus();
		return false;
	}
	if(isNaN(form.discamt.value.split(" ").join("")))
	{
		alert("Please enter numeric value for discount.");
		form.discamt.value="";
		form.discamt.focus();
		return false;
	}	
	return  true;	
}
function chkpidval(fvalue,fid,frm)
{
	var pname='';
	var pid='';
	var res = fvalue.split("###");
	pname=res[0];
	pid=res[1];
	var ffval=$("#pidname").val();
	var res = ffval.split("###");
	pname=res[0];
	pid=res[1];
	document.getElementById(fid).innerHTML=pname;
	document.getElementById('pid').value=pid; 
	if(pid==undefined)
	{
		chkund(pid);
	}
	if(frm==0)
	{
		 chkpidval(fvalue,fid,1);
	} 
}
function chkund(fval)
{  
	if(fval==undefined)
	{
		pid=$("#pidname").val(); 
		pid=$("#pidname").val(); 
		pid=$("#pidname").val(); 
		chkpidval(pid,"forpro",0);
	}
}
</script>
<META content="MSHTML 6.00.2600.0" name=GENERATOR>
<link rel="stylesheet" href="dhtmlgoodies_calendar.css?random=20051112" media="screen"></link>
<script type="text/javascript" src="dhtmlgoodies_calendar.js?random=20060118"></script>
</HEAD>
<body leftMargin=0 topMargin=0 marginheight="0" marginwidth="0" >
<TABLE align="left" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="75"><? include ("top.php"); ?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY >
          <tr>
            <td width="20%" align="left"  valign="top" class="rightbdr" ><? include("inner_left_admin.php"); ?>
            </td>
            <td width="80%" valign="top" align="center"><TABLE width="100%"  border=0 cellpadding="2" cellspacing="2">
                <TR>
                  <TD height="35" class=form111><? echo $Buttitle;?> Coupon</TD>
                </TR>
                <tr>
                  <td height="222" class="formbg" valign="top"><form name="addprod"  method=post enctype="multipart/form-data">
                      <TABLE cellSpacing=2 cellPadding=2 width=98% border=0 class="t-b">
                        <TR>
                          <TD class=a align=right colSpan=4 nowrap>*= Required Information</TD>
                        </TR>
                        <TR>
                          <TD width="26%" align=left vAlign=top><strong><span style="font-size:14px;">Discount details</span>&nbsp;</strong>&nbsp;&nbsp;&nbsp;<br>
                            Create your discount code, and specify the usage limit.</TD>
                          <TD width="74%" colSpan=3 vAlign=top><strong>Discount code</strong><br>
                            <input name="promocode" id="promocode" value="<? echo htmlentities(stripslashes($ROW->promocode));?>" type="text" size="30" class="solidinput">
                            &nbsp;<input type="button" class="bttn-s" name="getcode" id="getcode" value="Generate Code" onClick="showcode('promocode','<?=Get_CreatePasswordXXX();?>');" >
                            <br><br><strong>How many times can this discount be used?</strong><br>
                            <span id="showspan" >
                            <? if($ROW->chklimit!='N'){?>Infinite<? }else{?>
                            <input type="text" name="notimes" id="notimes" class="solidinput" style="width:60px;" onKeyUp="chknumeric('notimes');"	value="<? echo stripslashes($ROW->notimes);?>" >
                            <? }?>
                            </span>&nbsp;<input type="checkbox" value="Y" name="chklimit" id="chklimit" <? if($ROW->chklimit!='N'){?> checked="checked" <? }?> onClick="showlimit('showspan','<? echo stripslashes($ROW->notimes);?>')">&nbsp; No Limit</TD>
                        </TR>
						<TR>
                          <TD width="26%" align=left vAlign=top><strong><span style="font-size:14px;">Lives details</span>&nbsp;</strong></TD>
                          <TD width="74%" colSpan=3 vAlign=top><select name="lifes" id="lifes" >
						  	  <option value=""  >Select</option>
                              <option value="1" <? if($ROW->lifes=="1"){ echo "selected";}?> >1 life $1.99</option>
                              <option value="3" <? if($ROW->lifes=="3"){ echo "selected";}?>>3 lives FREE</option>
							  <option value="6" <? if($ROW->lifes=="6"){ echo "selected";}?>>6 lives $6.99</option>
							  <option value="9" <? if($ROW->lifes=="9"){ echo "selected";}?>>9 lives $9.99</option>
                            </select></TD>
                        </TR>
                        <TR>
                          <TD width="26%" height="25" align=left vAlign=top><strong><span style="font-size:14px;">Discount type</span></strong><br>Select the type of discount, and set any extra conditions.</TD>
                          <TD height="25" colSpan=3  ><select name="disctype" id="disctype" onChange="chkdtype('dityp',this.value);">
                              <option value="1" <? if($ROW->disctype=="1"){ echo "selected";}?> >$ USD</option>
                              <option value="2" <? if($ROW->disctype=="2"){ echo "selected";}?>>% Discount</option>
                            </select>
                            Take
                            <input name="discamt" value="<? echo htmlentities(stripslashes($ROW->discamt));?>" type="text" style="width:100px;" class="solidinput">
                            &nbsp;<span id="dityp"><? if($ROW->disctype=="2"){?>%<? }else{?>$<? }?></span> Off for
                            <select name="discountfor" id="discountfor" onChange="if(this.value!=''){loaddd('ordtyp',this.value,'<?=$ROW->id?>')};">
                              <option value="1" <? if($ROW->discountfor==1){echo "selected";}?>>All orders</option>
                              <option value="2" <? if($ROW->discountfor==2){echo "selected";}?>>Orders over</option>
                            </select>
                            &nbsp; <span id="ordtyp">
                            <? if($ROW->discountfor==2){?>$ <input type="text" name="ordlimit" id="ordlimit" value="<?=$ROW->ordlimit?>" >
                            <? }else if($ROW->discountfor==3){?>
                            <br><br><div id="forpro" style="background-color:#999999;color:blue;height:20px;width:auto; " onClick="document.getElementById('getdd').style.display='block';document.getElementById('pidname').focus();">
                              <?=GetName1('products','name',id,$ROW->pid);?>
                            </div>
                            <div class="dropdown" id="getdd" style="display:none"> <br>
                              <input name="pidname" id="pidname" type="text" style="color:#000000;width:300px;"  onBlur="if(this.value!=''){chkpidval(this.value,'forpro','0');}" onChange="if(this.value!=''){chkpidval(this.value,'forpro','0');}" />
                              <input name="pid" id="pid" type="hidden1"  value="" onChange="chkund(this.value);" />
                            </div>
                            <? }?>
                            </span> </TD>
                        </TR>
                        <tr>
                          <td align="left"><strong><span style="font-size:14px;">Date range</span></strong><br>Specify when this discount begins and ends.</td>
                          <? if($ROW->startdate!='0000-00-00' && $ROW->startdate!=''){ $startdate=$ROW->startdate; }else{ $startdate=date("Y-m-d");}?>
                          <? if($ROW->enddate!='0000-00-00' && $ROW->enddate!=''){$enddate=$ROW->enddate; }else{$enddate=date("Y-m-d");}?>
                          <td align="left" colSpan=3 ><table>
                              <tr>
                                <td><strong>Discount begins</strong></td>
                                <td><strong>Discount ends</strong></td>
                              </tr>
                              <tr>
                                <td><input name="startdate" id="startdate" value="<? echo $startdate;?>" type="text" readonly   class="solidinput">
                                  &nbsp;<img src="images/calendar.gif" style="padding-top:5px;" align="absbottom"  border="0" onClick="displayCalendar(document.addprod.startdate,'yyyy-mm-dd',this)">&nbsp;&nbsp;</td>
                                <td><input name="enddate" id="enddate" value="<? echo $enddate;?>" type="text" <? if($ROW->neverexp!="N"){?>disabled="disabled" style="background-color:#999999"<? }?> readonly  class="solidinput">
                                  &nbsp;<img src="images/calendar.gif" style="padding-top:5px;" align="absbottom"  border="0"  onClick="displayCalendar(document.addprod.enddate,'yyyy-mm-dd',this)"> &nbsp;
                                  <input type="checkbox" id="neverexp" name="neverexp" value="Y" onClick="showdate('enddate','<?=$enddate?>')" <? if($ROW->neverexp!="N"){?> checked="checked" <? }?>>
                                  Never Expires </td>
                              </tr>
                            </table></td>
                        </tr>
                        <TR>
                          <TD align=left>&nbsp;</TD>
                          <TD align=left colspan="3"><INPUT type=submit name="Submit" value="<? if($_GET['id']){ echo "Save Changes";} else { echo "Add Coupon";}?>" onClick="return valid();" class="bttn-s">
                          </TD>
                        </TR>
                      </TABLE>
                    </FORM></td>
                </tr>
              </TABLE></td>
          </tr>
        </TBODY>
      </TABLE></td>
  </tr>
</table>
<script language="javascript" type="text/javascript">
function chknumeric(val)
{
   var frm_v = document.addprod;
   if(isNaN(eval("frm_v." + val).value))
   {
		eval("frm_v." + val).value="";
		eval("frm_v." + val).focus();
		return false;
   }
}
var http = false;

if(navigator.appName == "Microsoft Internet Explorer") {
  http = new ActiveXObject("Microsoft.XMLHTTP");
} else {
  http = new XMLHttpRequest();
}
function loaddd(fid,fvalue,promoid)
 {
 
  http.abort();
  http.open("GET","getcoupondd.php?fvalue="+fvalue+"&promoid="+promoid, true);
  http.onreadystatechange=function()
  {
	  if(http.readyState == 4)
	  {    
		  aa=http.responseText;
		  document.getElementById(fid).innerHTML=aa;
		  return false;
	  } 
  }
  http.send(null);
 }
</script>
</BODY>
</HTML>