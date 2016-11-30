<?
include("connect.php");
if(isset($_REQUEST['mn'])) $mn=$_REQUEST['mn'];
else $mn=date("m");
if(isset($_REQUEST['yr'])) $yr=$_REQUEST['yr'];
else $yr=date("Y");
//Search Queries


$AjxUrlsx="";

$dddate=$_REQUEST['yr']."-".$_REQUEST['mn']."-".$_REQUEST['pg'];
$getDateee=date("Y-m-d",strtotime($dddate));

$montharr=array("01"=>"January","02"=>"February","03"=>"March","04"=>"April",	"05"=>"May","06"=>"June","07"=>"July","08"=>"August",	"09"=>"September","10"=>"October","11"=>"November","12"=>"December");
$dayarr=array("Sun"=>"01","Mon"=>"02","Tue"=>"03","Wed"=>"04","Thu"=>"05","Fri"=>"06","Sat"=>"07");

if($mn==1)
{
	$plink="?yr=".($yr-1)."&mn=12";
	$prvyrr=$yr-1;
	$prvmnn="12";
}
else
{
	$plink="?yr=".$yr."&mn=".substr("0".($mn-1),-2);
	$prvyrr=$yr;
	$prvmnn=$mn-1;
}

if($mn==12)
{
	$nlink="?yr=".($yr+1)."&mn=01";
	$nxtyrr=$yr+1;
	$nxtmnn="01";
}
else
{
	$nlink="?yr=".$yr."&mn=".substr("0".($mn+1),-2);
	$nxtyrr=$yr;
	$nxtmnn=$mn+1;
}	

if(strlen($nxtmnn)=="1") { $nxtmnn="0".$nxtmnn; }
if(strlen($prvmnn)=="1") { $prvmnn="0".$prvmnn; }

$pday=date("t",mktime(0,0,0,$mn-1,1,$yr));
$cday=$dayarr[date("D",mktime(0,0,0,$mn,1,$yr))];
$tday=date("t",mktime(0,0,0,$mn,1,$yr));
$cd=1;
$chk=1;

if($tday>=30 && $cday==7) { $cd=30; $chk=0; }
if($tday==31 && $cday==6) { $cd=31; $chk=0; }

$allcaldta='';
$allcaldta.='<table width="100%" height="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
	<tr align="center" valign="top" bgcolor="#000000">
	  <td width="100%" height="34" valign="middle" ><table width="98%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="15%" align="left" valign="middle" ><a href="#" onclick="Get_Result111(\'user_all\',\''.$prvyrr.'\',\''.$prvmnn.'\',\'0\');return false;" ><img src="images/tab_back_big.png"  height="30" border="0"></a></td>
			<td width="70%" align="center" valign="middle" style="color:#FFFFFF;padding-top:2px;font-size:30px;"><b>'.ucfirst($montharr[$mn]).' '.$yr.'</b></td>
			<td width="15%" align="right" valign="middle" ><a href="#" onclick="Get_Result111(\'user_all\',\''.$nxtyrr.'\',\''.$nxtmnn.'\',\'0\');return false;"><img src="images/tab_forward_big.png"  height="30"   border="0"></a></td>
		  </tr>
		</table></td>
	</tr>
	<tr>
	  <td width="100%"  valign="top"><table  width="100%" border="0" cellpadding="1" cellspacing="1">
		<tr bgcolor="#E3E3E3" >
		<td width="14%" height="40" align="center" valign="middle" style="font-size:24px;"><strong>SUN</strong></td>
		<td width="14%" align="center" valign="middle" style="font-size:24px;"><strong>MON</strong></td>
		<td width="14%" align="center" valign="middle" style="font-size:24px;"><strong>TUE</strong></td>
		<td width="14%" align="center" valign="middle" style="font-size:24px;"><strong>WED</strong></td>
		<td width="14%" align="center" valign="middle" style="font-size:24px;"><strong>THU</strong></td>
		<td width="15%" align="center" valign="middle" style="font-size:24px;"><strong>FRI</strong></td>
		<td width="15%" align="center" valign="middle" style="font-size:24px;"><strong>SAT</strong></td>
	  </tr>
	  <tr>';
	   for($a=1;$a<=35;$a++) 
	   { 
			if((($a>=$cday && $cd<=$tday) || ($a<=7 && $cd>=30)) && $chk<=1) 
			{ 
				$chkdt=date("m/d/Y",mktime(0,0,0,$mn,$cd,$yr));
				$chkdtYMD=date("Y-m-d",mktime(0,0,0,$mn,$cd,$yr));
				$goouticon='';
				$getGoOutQryRs=mysql_query("SELECT id FROM users_goout WHERE userid_to='".$_SESSION['UsErIdFrOnT']."' and outdate='$chkdt'");
				$TotgetGoOut=mysql_affected_rows();
				if($TotgetGoOut>0)
				{
					while($getGoOutQryRow=mysql_fetch_array($getGoOutQryRs))
					{
						$goouticon.="<img src='images/goout-blue.png' width='30' height='30' align='right' />";
					}
				}
				
				$groupicon='';
				$getGroupQryRs=mysql_query("SELECT id FROM users_groups_members WHERE  	userid_to='".$_SESSION['UsErIdFrOnT']."' and addeddate like '$chkdtYMD%'");
				$TotgetGroup=mysql_affected_rows();
				if($TotgetGroup>0)
				{
					while($getGroupQryRow=mysql_fetch_array($getGroupQryRs))
					{
						$groupicon.="<img src='images/group-blue.png' width='30' height='30' align='right' />";
					}
				}
				
				$allcaldta.='<td bgcolor="#FFFFFF" ><div style="min-height:65px;height:100%;font-size:16px;padding:3px;">';					
				//$allcaldta.='<tr><td align="center" valign="middle"  style="font-size:12px;cursor:pointer;'.$fontcolodr.''.$bgcolodr.'" >'.$cd.'</td></tr>';
				$allcaldta.='<strong>'.$cd.'</strong>';
				if($goouticon!='')
				{
					$allcaldta.='<span style="text-align:right">'.$goouticon.'</span>';
				}
				if($groupicon!='')
				{
					$allcaldta.='<span style="text-align:right">'.$groupicon.'</span>';
				}	
				$allcaldta.='</div></td>';
				$cd++; 
			} 
			else 
			{ 
				$allcaldta.='<td bgcolor="#FFFFFF" ><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr></table></td>';
			} 
			if($cd>$tday) { $cd=1; $chk++; }
				
			if($a%7==0 && $chk>1) { break; } elseif($a%7==0) 
			{ 
				$allcaldta.='</tr><tr>';
			} 
	   } 
$allcaldta.='</tr></table></td></tr></table>';
echo $allcaldta;
?>