<? require_once("connect.php"); 
include("checklogin.php");
$productdesc = "KARMA ".stripslashes(GetName1("lifes","totallives","id",$_SESSION['LIVESID']))." LIVES AVATAR";
if($_POST['HidContinueCheckout']=="1")
{
	if ($AUTHORIZEACTIVE!="Y")
	{
			header("Location:$SITE_URL/afterpay.php?Paid=Y&orid=".$_SESSION['orderid']."");
			exit;
	}
	else
	{
			$sql_query = "select * from ordermaster where id='".$_SESSION['orderid']."'";
			$result = mysql_query($sql_query);
			$row = mysql_fetch_object($result);
			$YYRR=substr($row->ccyear,2);
			$expirydate=$row->ccmonth.$YYRR;
			
			include("authorizenet.php"); 
			
			$ac = new AuthorizenetClass(); 
			$Address=$row->address1." ".$row->address2;
			$ShipAddress=$row->ship_address1." ".$row->ship_address2;
			
			$ac->setParameter("x_Login", ""); ///login
			$ac->setParameter("x_Test_Request", "True");  ///True if in test mode
			$ac->setParameter("x_cust_id", $row->userid); 
			$ac->setParameter("x_First_Name", $row->fname); 
			$ac->setParameter("x_Last_name", $row->lname); 
			$ac->setParameter("x_company", $row->company); 
			$ac->setParameter("x_Address", $Address);
			$ac->setParameter("x_City", $row->city);
			$ac->setParameter("x_State", $row->state);
			$ac->setParameter("x_Zip", $row->zipcode); 
			$ac->setParameter("x_Country", $row->country); 
			$ac->setParameter("x_phone", $row->day_telephone); 
			$ac->setParameter("x_email", $row->email); 
			$ac->setParameter("x_ship_to_first_name", $row->ship_fname); 
			$ac->setParameter("x_ship_to_last_name", $row->ship_lname); 
			$ac->setParameter("x_ship_to_company", $row->ship_company); 
			$ac->setParameter("x_ship_to_address", $ShipAddress);
			$ac->setParameter("x_ship_to_city", $row->ship_city);
			$ac->setParameter("x_ship_to_state", $row->ship_state);
			$ac->setParameter("x_ship_to_zip", $row->ship_zipcode); 
			$ac->setParameter("x_ship_to_country", $row->ship_country); 
			$ac->setParameter("x_tax", $row->tax); 
			$ac->setParameter("x_Amount", $row->grandtotal); 
			$ac->setParameter("x_currency_code", "USD"); 
			$ac->setParameter("x_Card_Num", $_SESSION['ccnumber']);
			$ac->setParameter("x_Card_Code", $_SESSION['cvv']); 
			$ac->setParameter("x_Exp_Date", "$expirydate"); 
			$ac->setParameter("x_Invoice_Num", $row->orderid); 
			$ac->setParameter("x_description", $productdesc);
				
			$result_code = $ac->process();    // 1 = accepted, 2 = declined, 3 = error 
			$result_array = $ac->getResults();    // return results array 
			
			foreach($result_array as $key => $value) {
				if($key=="x_response_code")
				{
					if($value==1)
					{
						header("Location:$SITE_URL/afterpay.php?Paid=Y&orid=".$_SESSION['orderid']."");
						exit;
					}
				}
				if($key=="x_response_reason_text")
				{
					$Error=$value;
				}
			}	
			if($Error)
			{
				$response_text=$Error;
				//include("message.php");
				$UpdateOrder_query = "Update ordermaster set orderstatus='In process' where id='".$_SESSION['orderid']."'";
				$UpdateOrder_queryRs = mysql_query($UpdateOrder_query);
				//header("Location:$SECURE_URL/orderreview.php?msg=$response_text");
				header("Location:$SECURE_URL/payment.php?msg=$response_text");
				exit;
			}
	}
}		
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
		<p align="center" style="padding:20px;">
		<font style="font-size:20px;">Thank you, you are now being transferred to payment page to complete the payment.</font>
		<br /><br /><font style="font-size:20px;">Please wait a few moments while we process your request...</font>
		<br /><br /><img src="images/ajax2loader.gif" />
		<input type="hidden" name="HidContinueCheckout" id="HidContinueCheckout" value="" /> 
		</p>
		</form>
	</div>
</div>
<script language="JavaScript">
function redirect()
{
	setTimeout(submitpage, 3000);
}
function submitpage()
{
	document.frmShipInfo.HidContinueCheckout.value=1;
	document.frmShipInfo.submit();
}
</script>
<script>redirect();</script>
<? include("googleanalytic.php");?>
</body>
</html>