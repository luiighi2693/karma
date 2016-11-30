<?php
include("connect.php");
global $THUMBNAIL_IMAGEPATH;
if($_REQUEST["Type"]=="AJAX_getarival")
{
	function validate($departure_point,$selectedarrival)
	{
		$plcode=$departure_point;
		$PGROUP=GetName1("arspick4","PGROUP","PCODE",$plcode);
		$PLCODE=GetName1("arspick4","PLCODE","PCODE",$plcode);
		$PDIR1=GetName1("arspick4","PDIR1","PCODE",$plcode);
		$PDIR2=GetName1("arspick4","PDIR2","PCODE",$plcode);
		$PORDER=GetName1("arspick4","PORDER","PCODE",$plcode);
		
		$PLCODE_length=strlen($PLCODE);
		for ($i = 0; $i < $PLCODE_length; $i++) 
		{
			$andqry.=" PLCODE like '%".$PLCODE[$i]."%' OR" ;
		}  
		
		if($andqry!='')
		{
			$andqry=substr($andqry,0,-2);
			$andqry=" and ( $andqry )";
		}	
		if($PDIR1=='P')
		{
			$orqry=" and (PDIR1='D' or PDIR1='B')";
		}
		else if($PDIR2=='P')
		{
			$orqry=" and (PDIR2='D' or PDIR2='B')";
		}
		else if($PDIR1=='B')
		{
			$orqry=" and (PDIR1='D' or PDIR1='B')";
			$andqryporder=" and CAST(PORDER AS UNSIGNED)>$PORDER";
		}
		else if($PDIR2=='B')
		{
			$orqry=" and (PDIR2='D' or PDIR2='B')";
			$andqryporder=" and CAST(PORDER AS UNSIGNED)<$PORDER";
		}
		$drop.='<select name="arrival_point" id="arrival_point" style="width:240px;">' ;
		$drop.="<option value=''>Please make a selection...</option>" ;
		$SelLeavingLocationQryRs1=mysql_query("SELECT `PGROUP` FROM arspick4 WHERE 1=1 $orqry  $andqry $andqryporder GROUP BY `PGROUP` ASC");
		$TotSelLeavingLocationQryRs1=mysql_affected_rows();
		$cnt_alert=0;
	    $iaarr=0;
	    $arr_neighbor=array();
		for($LLoc=0;$LLoc<$TotSelLeavingLocationQryRs1;$LLoc++)
		{
			while($SelLeavingLocationQryRow1=mysql_fetch_array($SelLeavingLocationQryRs1))
			{
				$Mainvall=$SelLeavingLocationQryRow1["PGROUP"];
				if(strlen($Mainvall)>1) 
				{
					for ($iX=0; $iX<strlen($Mainvall); $iX++) 
					{
						$retval=strpos($PGROUP,trim($Mainvall[$iX]));
						if(trim($Mainvall[$iX])!="" && $retval!== false)
						{
							$arr_neighbor[$iaarr]=$Mainvall[$iX];
							$iaarr=$iaarr+1; 
						}
					}
				}
				else
				{
					
					for ($iX=0; $iX<strlen($Mainvall); $iX++) 
					{
						if(trim($Mainvall[$iX])!="")
						{
							$arr_neighbor[$iaarr]=$Mainvall[$iX];
							$iaarr=$iaarr+1; 
						}
					}
				}
			}			
		}
		
		$Tot1=count($arr_neighbor);	
		
		if($Tot1>0)
		{
			array_multisort($arr_neighbor, SORT_ASC);
		}
		$resultSort =array_unique($arr_neighbor);
		$resultSort = array_values($resultSort);
		//print_r($resultSort);
		$Tot2=count($resultSort);
		$TotSelLeavingLocationDevideTwo=round($Tot2/3);
		if($Tot2>0)
		{
			for($po=0;$po<$Tot2;$po++)
			{
				$GRP_name=trim($resultSort[$po]);
				if($GRP_name!="")
				{
					$linename=GetName1("rp_stopslines","name","id",$GRP_name);
					$drop.= "<optgroup label='".$linename."'>".$linename."" ;
						
						$SelLeavingLocationQryRs2=mysql_query("SELECT * FROM arspick4 WHERE PGROUP like '%".$GRP_name."%' $orqry  $andqry $andqryporder ORDER by CAST(PORDER AS UNSIGNED) ASC");
						$TotSelLeavingLocationQryRs2=mysql_affected_rows();
						for($LLoc2=0;$LLoc2<$TotSelLeavingLocationQryRs2;$LLoc2++)
						{
							$SelLeavingLocationQryRow2=mysql_fetch_array($SelLeavingLocationQryRs2);
							
							if($SelLeavingLocationQryRow2['PCODE'] == $selectedarrival)
							{
								$selected ="selected";
							}
							else
							{
								$selected = "";
							}
							$drop.= "<option $selected value='".$SelLeavingLocationQryRow2['PCODE']."'>".stripslashes($SelLeavingLocationQryRow2['PSDESC'])."</option>" ;
						}
					$drop.= "</optgroup>";
				}
			}		
		}	
		$drop.= "</select>";
		return $drop;
	}
	echo validate(trim($_REQUEST['departure_point']),trim($_REQUEST['selectedarrival']));
}
else if($_REQUEST["Type"]=="AJAX_getdeparture")
{
	function validate($arrival_point,$selectedarrival)
	{
		$plcode=$arrival_point;
		$PLCODE=GetName1("arspick4","PLCODE","PCODE",$plcode);
		$PDIR1=GetName1("arspick4","PDIR1","PCODE",$plcode);
		$PDIR2=GetName1("arspick4","PDIR2","PCODE",$plcode);
		$PORDER=GetName1("arspick4","PORDER","PCODE",$plcode);
		
		$PLCODE_length=strlen($PLCODE);
		for ($i = 0; $i < $PLCODE_length; $i++) 
		{
			$andqry.=" PLCODE like '%".$PLCODE[$i]."%' OR" ;
		}  
		
		if($andqry!='')
		{
			$andqry=substr($andqry,0,-2);
			$andqry=" and ( $andqry )";
		}	
		if($PDIR1=='D')
		{
			$orqry=" and (PDIR1='P' or PDIR1='B')";
		}
		else if($PDIR2=='D')
		{
			$orqry=" and (PDIR2='P' or PDIR2='B')";
		}
		else if($PDIR2=='B')
		{
			$orqry=" and (PDIR2='P' or PDIR2='B')";
			$andqryporder=" and CAST(PORDER AS UNSIGNED)>$PORDER";
		}
		else if($PDIR1=='B')
		{
			$orqry=" and (PDIR1='P' or PDIR1='B')";
			$andqryporder=" and CAST(PORDER AS UNSIGNED)<$PORDER";
		}
		$drop.='<select name="arrival_point" id="arrival_point" style="width:240px;">' ;
		$drop.="<option value=''>Please make a selection...</option>" ;
		$SelLeavingLocationQryRs1=mysql_query("SELECT `PGROUP` FROM arspick4 WHERE 1=1 $orqry  $andqry $andqryporder GROUP BY `PGROUP` ASC");
		$TotSelLeavingLocationQryRs1=mysql_affected_rows();
		$cnt_alert=0;
	    $iaarr=0;
	    $arr_neighbor=array();
		for($LLoc=0;$LLoc<$TotSelLeavingLocationQryRs1;$LLoc++)
		{
			while($SelLeavingLocationQryRow1=mysql_fetch_array($SelLeavingLocationQryRs1))
			{
				$Mainvall=$SelLeavingLocationQryRow1["PGROUP"];
				for ($iX=0; $iX<strlen($Mainvall); $iX++) 
				{
					if(trim($Mainvall[$iX])!="")
					{
						//$arr_neighbor[$iaarr][0]=$Mainvall[$iX];
						$arr_neighbor[$iaarr]=$Mainvall[$iX];
						$iaarr=$iaarr+1; 
					}
				}
			}			
		}
		$Tot1=count($arr_neighbor);	
		
		if($Tot1>0)
		{
			array_multisort($arr_neighbor, SORT_ASC);
		}
		$resultSort =array_unique($arr_neighbor);
		$resultSort = array_values($resultSort);
		//print_r($resultSort);
		$Tot2=count($resultSort);
		$TotSelLeavingLocationDevideTwo=round($Tot2/3);
		if($Tot2>0)
		{
			for($po=0;$po<$Tot2;$po++)
			{
				$GRP_name=trim($resultSort[$po]);
				if($GRP_name!="")
				{
					$linename=GetName1("rp_stopslines","name","id",$GRP_name);
					$drop.= "<optgroup label='".$linename."'>".$linename."" ;
						
						$SelLeavingLocationQryRs2=mysql_query("SELECT * FROM arspick4 WHERE PGROUP like '%".$GRP_name."%' $orqry  $andqry $andqryporder ORDER by CAST(PORDER AS UNSIGNED) ASC");
						$TotSelLeavingLocationQryRs2=mysql_affected_rows();
						for($LLoc2=0;$LLoc2<$TotSelLeavingLocationQryRs2;$LLoc2++)
						{
							$SelLeavingLocationQryRow2=mysql_fetch_array($SelLeavingLocationQryRs2);
							
							if($SelLeavingLocationQryRow2['PCODE'] == $selectedarrival)
							{
								$selected ="selected";
							}
							else
							{
								$selected = "";
							}
							$drop.= "<option $selected value='".$SelLeavingLocationQryRow2['PCODE']."'>".stripslashes($SelLeavingLocationQryRow2['PSDESC'])."</option>" ;
						}
					$drop.= "</optgroup>";
				}
			}		
		}	
		$drop.= "</select>";
		return $drop;
	}
	echo validate(trim($_REQUEST['arrival_point']),trim($_REQUEST['selectedarrival']));
}
else if($_REQUEST["Type"]=="UpdateDisplayOrder")
{
	function validate($id,$val)
	{
		$SE="update groups_subcategory set displayorder='$val' where id='".$id."'";
		$SERs=mysql_query($SE);
		return "Saved";
	}
	echo validate(trim($_REQUEST['id']),trim($_REQUEST['val']));
}
else if($_REQUEST["Type"]=="UpdateDisplayOrder_Questions")
{
	function validate($id,$val)
	{
		$SE="update questions set displayorder='$val' where id='".$id."'";
		$SERs=mysql_query($SE);
		return "Saved";
	}
	echo validate(trim($_REQUEST['id']),trim($_REQUEST['val']));
}
?>