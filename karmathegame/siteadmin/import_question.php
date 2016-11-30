<?

include("admin.config.inc.php"); 

include("connect.php");

include("admin.cookie.php");

$mlevel=1;

$Msgg="";

$Message="";



if($_POST['HidSubmitAddUser']=="1")

{

	$i=0;

	$j=0;

	$tes=0;

	

	$photo_name = $_FILES["importfile"]['tmp_name'];

	$photo_name1= $_FILES['importfile']['name'];

	

	$filename=ereg_replace(" ","_",$photo_name1);

	$filename=ereg_replace("'","_",stripslashes($filename));

	

	$path ="temp/".$filename;

	move_uploaded_file($photo_name,$path);

	

	$fp=fopen("temp/".$filename,"r");

	

	$row = 1;$notdone='';
$totalresult=0;
	$totalresultnotdone=0;
	$notimportedlist='';
	if (($handle = fopen("temp/".$filename, "r")) !== FALSE) 

	{

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 

		{

			$tlist = count($data);

			$row++;

			//echo $data[0]."<br>";

			if(trim($data[0])!="")

			{
				if(trim($data[0])=='VALUE')
				{
					$groupid=2;
				}
				else if(trim($data[0])=='INTIMACY')
				{
					$groupid=3;
				}
				else if(trim($data[0])=='COMPATIBILITY')
				{
					$groupid=1;
				}	
				$sel=mysql_query("SELECT * FROM  groups_subcategory WHERE groupid='".$groupid."' and name='".addslashes(trim($data[1]))."'");
				$Totsel=mysql_affected_rows();
				if($Totsel>0)
				{
					$selRow=mysql_fetch_array($sel);
					$subgroupid=$selRow['id'];
				}
					$insertqry="insert into   questions set
					  `question`='".addslashes(trim($data[2]))."',	
					  `groupid`='".addslashes(trim($groupid))."',
					  `subgroupid`='".addslashes(trim($subgroupid))."',
					  `addeddate`=now()";  
					mysql_query($insertqry);
					echo $insertqry."<br><br>";
				$totalresult++;
			}
			
		}
		fclose($handle);
	}
	$msggg="Total result imported: <strong>$totalresult</strong><br><br>Total result not imported: <strong>$totalresultnotdone</strong><br>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.0 Transitional//EN">
<html>
<head>
<title><?php echo $ADMIN_MAIN_SITE_NAME ?></title>
<link rel="stylesheet" href="main.css" type="text/css">
<script language="javascript" type="text/javascript">

function frmvalid()

{

	frm=document.addprod;

	

	if(frm.importfile.value=="")

	{

		alert("Please Upload CSV File");

		frm.importfile.focus();

		return false;

	}

	

	frm.HidSubmitAddUser.value=1;

	frm.submit();		

	return  true;

}

function in_ext_lib(str)

{

	var x;

	var flag = 0;

	var myext = new Array();

	myext[0] = ".csv";

	

	for (x in myext)

	{

		if(str.substr(str.lastIndexOf(".",str)).toLowerCase() == myext[x])

		{

			flag = 1;

			break;	

		}

	}

	if(flag == 0)

	{

		alert("Please upload only .csv file");

		return false;

	}

	else

	{

		return true;

	}

}

</script>
<script language="javascript" src="body.js"></script>
</head>
<body bgColor="#ffffff" leftMargin="0" topMargin="0" marginwidth="0" marginheight="0">
<table align="left" width="100%" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td height=60 valign="top"  colspan="2"><? include("top.php") ?>
      </td>
    </tr>
    <tr>
      <td width="20%" valign="top" class="rightbdr" ><? include("left_users.php"); ?>
      </td>
      <td width="80%" valign="top"><table width="100%"  border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="left" height="35" class=form111>Import Students </td>
                  <td align="right" height="35" class=form111></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td align="center"  class="formbg"><table width="100%"  border="0" cellPadding="0" cellSpacing="0" align="left">
                <tbody>
                  <tr>
                    <td align="left" width="100%" class="a-l" ><? if($msggg){?>
                      <font color="#FF0000"><? echo $msggg;?></font>
                      <? }?></td>
                  </tr>
                  <? if($notimportedlist){?>
                  <tr>
                    <td align="left" width="100%"><br>
                      Below results are not imported. Please dont refresh browser.<br>
                      <br>
                      <font color="#993300"><? echo $notimportedlist;?></font></td>
                  </tr>
                  <? }?>
                  <tr>
                    <td background="images/vdots.gif"><IMG height=1  src="images/spacer.gif" width=1 border=0></td>
                  </tr>
                <td valign="top"><form id="addprod" name="addprod" method="post"  enctype="multipart/form-data">
                      <table width="100%"    align="left" >
                        <tr>
                          <td   ><table width="100%"  border="0" align="left" cellpadding="0" >
                              <tr>
                                <td   valign="top"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                                    <? if($_GET["msg"]=="1") { ?>
                                    <tr>
                                      <TD align="center" colspan="2" vAlign=middle><b style="color:#FF0000">Result Imported Successfully.</b></TD>
                                    </tr>
                                    <? } ?>
                                    <tr>
                                      <td align="right" colspan="2"><span class="a">*</span> Required field</td>
                                    </tr>
                                    <tr>
                                      <td width="12%" height="25" align="left" class="black12"><strong>CSV file:</strong></td>
                                      <td width="88%" align="left"><input type="file" name="importfile" id="importfile" class="buttonXX"></td>
                                    </tr>
                                    <tr>
                                      <td height="35" colspan="2" align="left"><input name="btn_submit" type="button"  value="Import" onClick="frmvalid();" class="bttn-a"></td>
                                    </tr>
                                  </table></td>
                              </tr>
                            </table></td>
                        </tr>
                      </table>
                      <input type="hidden" name="HidSubmitAddUser" id="HidSubmitAddUser" value="0" />
                    </form></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>
