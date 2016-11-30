<?php 
include("admin.config.inc.php"); 
include("connect.php");
include("admin.cookie.php");
//include("fckeditor/fckeditor.php") ;
if($ADMIN_TOP_newsletter=="N" && $ADMIN_TOP_newsletter_E=="N" && $ADMIN_TOP_newsletter_D=="N"){header("location:inner.php");exit;}
$mlevel=5;
if($_GET["id"])
{	
	$cid=$_GET["id"];
	$dqry="delete from newsletter where id=$cid";
	mysql_query($dqry);	
	header("location:manage_newsletter.php?msgs=15&start=".$_GET['start']."");
	exit;
}

if($_POST["sendnews"])
{
	$subject = $_POST["news_subject"];
	$mailnews = stripslashes($_POST["rte1"]);
	$semail = $_POST["sendn"];	
	
	//$mailcontent = "<html><body><table align='left'><tr><td align='left'>".$mailnews."</td></tr></table></body></html>";		
	$mailcontent1="<html>
					<body>
							<table cellpadding=\"2\" cellspacing=\"2\">
									<tr><td align='left'>".$mailnews."</td></tr>
					</table>
					</body>
			</html>";
				
	for($i=0;$i<count($semail);$i++)
	{
		$toemail = $semail[$i];
		//SendHTMLMail($toemail,$subject,$mailcontent,$ADMIN_MAIL);
		if($_SERVER['HTTP_HOST']!="yogs")
		{
			//HtmlMailSend($toemail,$subject1,$mailcontent1,$from1);
			$headers2  = "MIME-Version: 1.0" . "\r\n";
			$headers2 .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
			$headers2 .= "From: ".$_POST['news_email']." <".$_POST['news_email'].">" ;
			mail($toemail,$subject,$mailcontent1,$headers2);	
		}
	}	
	$Message="E-Mail Successfully Sent to $i Subscriber(s)<br>";
}
	
$order=$_GET["order"];
if($order != "")
{
	$strQueryPerPage="select * from newsletter where email like '$order%' order by id desc";
	$strResultPerPage=mysql_query($strQueryPerPage);
	$strTotalPerPage=mysql_affected_rows(); 
}
else
{
	$strQueryPerPage="select * from newsletter order by id desc  ";
	$strResultPerPage=mysql_query($strQueryPerPage);
	$strTotalPerPage=mysql_affected_rows(); 
}	
if($strTotalPerPage<1)
$Error = 1;
	
if($_GET["msgs"]==1 && !$_GET["start"])
{
	$Message2 = "Newsletter Added Successfully!!";
}
if($_GET["msgs"]==3 && !$_GET["start"])
{
	$Message2 = "Newsletter Updated Successfully!!";
}
if($_GET["msgs"]==15 && !$_GET["start"])
{
	$Message2 = "Newsletter Deleted Successfully!!";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.0 Transitional//EN">
<html>
<head>
<title><?php echo $ADMIN_MAIN_SITE_NAME ?></title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta content="MSHTML 6.00.2600.0" name=GENERATOR>
<link rel="stylesheet" href="main.css" type="text/css">
</head>
<body bgColor="#ffffff" leftMargin="0" topMargin="0" marginwidth="0" marginheight="0">
<script language="javascript" src="body.js" ></script>
<table align="left" width="100%" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td height=60 valign="top"  colspan="2"><? include("top.php") ?>
      </td>
    </tr>
    <tr>
      <td width="20%" valign="top" class="rightbdr" ><? include("inner_left_admin.php"); ?>
      </td>
      <td width="80%" valign="top"><table width="100%"  border=0 cellpadding="2" cellspacing="2">
          <tr>
            <td width="100%" height="35" class=form111>Manage Newsletter Subscribers </td>
          </tr>
          <tr>
            <td align="center"  class="formbg"><table width="100%"  border=0 cellPadding=0 cellSpacing=0 align="left">
                <tbody>
                  <tr>
                    <td align="center" width="100%" class="a-l" ><font color="#FF0000"><?php echo $Message2 ; ?></font></td>
                  </tr>
                  <tr>
                    <td background="images/vdots.gif"><IMG height=1  src="images/spacer.gif" width=1 border=0></td>
                  </tr>
                <td valign="top"><table cellSpacing=0 cellPadding=1 border=0  >
                      <tbody>
                        <tr>
                          <td colspan="25" height="20"><b>View By Email </b></td>
                        </tr>
                        <?=$prs_pageing->order();?>
                      </tbody>
                    </table>
                    <?php if(!$strTotalPerPage) { ?>
                    <table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" >
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="t-b">
                            <tr>
                              <td height="150" ><div align="center" ><strong>No  Newsletter Subscribers To Display</strong></div></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table>
                    <?php } else { ?>
                    <form id="mngnewsletter" name="mngnewsletter"  method="post" enctype="multipart/form-data" action="#">
                      <table class="t-b" cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                          <tr>
                            <td align="right" height="30" colspan=12><? $result=$prs_pageing->number_pageing($strQueryPerPage,25,10,"Y");?></td>
                          </tr>
                          <? if($Message) {?>
                          <tr>
                            <td colspan="3" align="center"  ><font color="#FF0000"><? echo $Message; ?></font></td>
                          </tr>
                          <? } ?>
                          <tr class="form_back" >
                            <td  align="left" width="559"><strong>Newsletter Subscribers </strong></td>
                            <td   align="center" nowrap="nowrap"><strong>Send</strong></td>
                            <td align="center" nowrap="nowrap"><strong>Options</strong> </td>
                          </tr>
                          <?
								  while($row =mysql_fetch_object($result))
								  {
							  ?>
                          <tr>
                            <td  align="left" width="559"><a href="mailto:<? echo $row->email; ?>" ><? echo $row->email; ?></a>&nbsp;</td>
                            <td  align="center" width="83"><input type="checkbox" value="<?php echo($row->email); ?>" name="sendn[]" class="inputCheck"/>
                            </td>
                            <td  align="center" width="125">
							<input name="button22" type="button" onClick="window.location.href='add_newsletter.php?id=<?=$row->id;?>'" value="Edit" class="bttn-s">
							<input name="button2" type="button" onClick="deleteconfirm('Are you sure you want to delete Newsletter subscriber?. \n','manage_newsletter.php?id=<?php echo($row->id); ?>');" value="Delete" class="bttn-s">
                            </td>
                          </tr>
                          <? } ?>
                          <tr>
                            <td align="right" >Check/Uncheck All</td>
                            <td align="center" ><input type="checkbox" name="chkall" value="Y" onClick="checkall();" class="inputCheck"/></td>
                            <td  >&nbsp;</td>
                          </tr>
                          <tr>
                            <td  colspan="3"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td width="18%" align="right" ><strong>Mail From Email:</strong></td>
                                  <td width="80%" ><input name="news_email" id="news_email" value="<? echo $ADMIN_MAIL?>" type="text"  style="width:95%;" class="solidinput"/></td>
                                </tr>
							    <tr>
                                  <td width="18%" align="right" ><strong>Mail Subject:</strong></td>
                                  <td width="80%" ><input name="news_subject" type="text"  style="width:95%;" class="solidinput"/></td>
                                </tr>
                                <tr>
                                  <td   align="right" valign="top"><strong>Mail Content:</strong></td>
                                  <td ><?php /*?><?php
											$oFCKeditor = new fckeditor('rte1') ;
											$oFCKeditor->BasePath = 'fckeditor/';					
											$oFCKeditor->Height = 450;
											$oFCKeditor->Create() ;
										?><?php */?>
										<?php
										include("ckeditor/ckeditor.php");
										include("ckeditor/ckfinder/ckfinder.php");
										$CKEditor = new CKEditor();
										$CKEditor->basePath = 'ckeditor/';
										$CKEditor->config['width'] = 850;
										$CKEditor->config['height'] = 300;
										CKFinder::SetupCKEditor( $CKEditor, 'ckeditor/ckfinder/' ) ;
										$CKEditor->editor("rte1","");
										?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td  align="left" ><input type="submit" value="Send Newsletter" name="sendnews" id="sendnews" class="bttn-s" onClick="return frmvalidate();"></td>
                                </tr>
                              </table></td>
                          </tr>
                        </tbody>
                      </table>
                    </form>
                    <?php } ?>
                  </td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </tbody>
</table>
<script language="javascript" type="text/javascript"> 
<!--
function checkall()
{
	var dom = document.mngnewsletter;
	if(dom.chkall.checked == true)
	{
		for(i=0;i<dom.length;i++)
		{
			if(dom.elements[i].type == "checkbox")
			{
				dom.elements[i].checked = true;
			}
		}
	}
	else
	{
		for(i=0;i<dom.length;i++)
		{
			if(dom.elements[i].type == "checkbox")
			{
				dom.elements[i].checked = false;
			}
		}
	}
}
function frmvalidate()
{
	var dom1 = document.mngnewsletter;
	var dom2 = document.mngnewsletter;
	var chkcount =0 ;
	
		for(i=0;i<dom1.length;i++)
		{
			if(dom1.elements[i].type == "checkbox")
			{
				if(dom1.elements[i].checked == true)
				{
					chkcount++;
				}
			}
		}
	
	if(chkcount==0)
	{
		alert("Please select atleast one E-Mail to send newsletter");
		return false;
	}
	else if(dom2.news_subject.value == "")
	{
		alert("Please enter subject for newsletter");
		dom2.news_subject.focus();
		return false;
	}
	else
	{
		return true;
	}
}//-->
</script>
</body>
</html>