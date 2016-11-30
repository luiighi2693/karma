<?
class get_pageing{
var $record_per_page=10;
var	$pages=5;
var $tbl,$file_names,$order,$query;

///////// GET THE VALUE OF START VARIABLE////////////////CREATED BY 
	function start()
	{
		if($_GET["start"])
			return	$start=$_GET["start"];
		else
			return	$start=0;
	}
	function start1()
	{
		if($_GET["start1"])
			return	$start=$_GET["start1"];
		else
			return	$start=0;
	}
	
	function start2()
	{
		if($_GET["start"])
			return	$start=$_GET["start"];
		else
			return	$start=1;
	}
//////////////  END OF START FUNCTION///////////////////CREATED BY 	

//////////////  GET THE CURRENT FILE NAME ///////////////////CREATED BY 
	function file_names()
	{
		//$pt=explode("/",$_SERVER['SCRIPT_FILENAME']);
		$pt=explode("/",$_SERVER['PHP_SELF']);
		$totpt=count($pt);
		return $this->file_names=$pt[$totpt-1];
	}
//////////////  END OF FILE_NAME FUNCTION///////////////////CREATED BY 	

//////////////  DISPLAY THE NUMERIC PAGING WITHOUT RECORD DETAIL///////////////////CREATED BY 
	function number_pageing_nodetail($query,$record_per_page='',$pages='')
	{
			return $this->number_pageing($query,$record_per_page,$pages,"N");
	}
	function number_pageing_bottom_nodetail($query,$record_per_page='',$pages='')
	{
			return $this->number_pageing($query,$record_per_page,$pages,"N","Y");
	}
	
	function number_pageing_bottom_product($query,$record_per_page='',$pages='')
	{
			return $this->pageing_bottom_product($query,$record_per_page,$pages,"","Y");
	}
	function number_pageing_bottom_searchlisting($query,$record_per_page='',$pages='',$pgnm)
	{
			return $this->pageing_bottom_searchlisting($query,$record_per_page,$pages,"","Y","",$pgnm);
	}
	
	function number_pageing_bottom_admin($query,$record_per_page='',$pages='')
	{
			return $this->number_pageing_admin($query,$record_per_page,$pages,"Y","Y");
	}

//////////////  END OF NUMERIC PAGING FUNCTION ///////////////////CREATED BY 	

	function runquery($query)
	{
		return	mysql_query($query);
	}
	
	function table($result,$titles,$fields,$passfield="",$edit,$delete,$parent="")
	{
			if($parent=="")
				$parent="Y";
			
			if($passfield=="")
				$passfield="id";

			$cont="<table width='100%' cellspacing='0' cellpadding='3' border='0' ><tr>";
			foreach($titles as $K=>$V)
			{
				$cont1.="<td";
				$cont1.=(is_numeric($V))?" width='$V%' align='center'><strong>$K</strong></td>":" align='center'><strong>$V</strong></td>";
			}
			$cont.=$cont1."</tr>";
			$cont.="<tr><td colspan='".count($titles)."'><script language=javascript>
					msg=\"<table border=0 cellpadding=3 cellspacing=1 width='100%'><TR>$cont1</TR></table>\";
					
					</script>
			<script src='topmsg.js'></script>			
			</td></tr>";
			$j=0;
			while($gets=mysql_fetch_object($result))
			{
				$j=1;
				$cont.="<tr onMouseOver=\"this.className='yellowdark3bdr'\" onmouseout=\"this.className=''\">";
				foreach($fields as $K=>$V)
				{
					$cont.="<td align='center'>";
					$tmps=explode(",",$V);
					$newval="";
					foreach($tmps as $val)
					{
						$newval.=$gets->$val." ";
					}
					$cont.=(is_numeric($K))?$newval:"<a href='$K?$passfield=".$gets->$passfield."' onMouseOver=\"smsg('View Detail of ".addslashes($newval)."');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">".$newval."</a>";
					$cont.="&nbsp;</td>";
				}
				$cont.="<td><INPUT name='button' type='button' onClick=\"";
				$cont.=($parent=="N")?"window":"parent.body";
				$cont.=".location.href='$edit?$passfield=".$gets->$passfield."'\" value='Edit' onMouseOver=\"smsg('Edit This Record -> $newval');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">&nbsp;&nbsp;<INPUT onClick=\"deleteconfirm('Are you sure you want to delete this Record?.','$delete?$passfield=".$gets->$passfield."');\" type='button' value='Delete' onMouseOver=\"smsg('Delete This Record -> $newval');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">&nbsp;</td>";
				$cont.="</tr>";
			}
			
			if($j==0)
			{
				$cont.="<tr><td colspan='".(count($fields)+1)."' align='center'><font color='red'><strong>No Record To Display</strong></font></td></tr>";
			}
			echo	$cont.="</table>";
	}
///////////// NUMERIC FUNCTION WITH RECORD DESTAIL//////////////////////////////////////
function number_pageing($query,$record_per_page='',$pages='',$detail='',$bottom='',$simple='')
{

		$this->file_names();
		$this->query=$query;
		
		if($record_per_page>0)
			$this->record_per_page=$record_per_page;
		
		if($pages>0)
			$this->pages=$pages;

		$result=$this->runquery($this->query);
		$totalrows= mysql_affected_rows();										
		
		$start=$this->start();
		
		$order=$_GET['order'];
		$this->query.=" limit $start,".$this->record_per_page;  
		$result=$this->runquery($this->query);
		$total= mysql_affected_rows();
		
		$total_pages=ceil($totalrows/$this->record_per_page);
		$current_page=($start+$this->record_per_page)/$this->record_per_page;
		$loop_counter=ceil($current_page/$this->pages);
		$start_loop=($loop_counter*$this->pages-$this->pages)+1;
		$end_loop=($this->pages*$loop_counter)+1;

		if($end_loop>$total_pages)
			$end_loop=$total_pages+1;

		$tmpva="";
		foreach($_GET as $V=>$K)
		{
			if($V!="start")
				$tmpva.="&".$V."=".$K;
		}
		
		$this->tbl="<table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0' ><tr><td width='15%' align='left'><strong>&nbsp;&nbsp;";
		
		
		if($start>0)
		{ 
			$this->tbl.="<a href='".$this->file_names."?start=".($start-$this->record_per_page).$tmpva."'  class='ttt'  onMouseOver=\"smsg('previous Page');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">&lt;&lt;Previous</a>&nbsp;&nbsp;"; 
		} 

		$this->tbl.="</strong>&nbsp;</td><td width='70%' class='blogDate'  align='center'>&nbsp;";
		if($detail!="N" and $simple !="N")
			$this->tbl.="<strong>Result ".($start+1)." - ".($start+$total)." of ".$totalrows." Records</strong><BR>";
		if($simple!='N')
		{
			for($i=$start_loop;$i<$end_loop;$i++) 
			{
				if($current_page==$i)	
				{
					$this->tbl.="<strong><span class='ttt'>".$i."</span></strong>&nbsp;&nbsp;";	
				}	
				else 
				{ 
					$this->tbl.="<strong><a href='".$this->file_names."?start=".($i-1)*$this->record_per_page.$tmpva."'  class='ttt' onMouseOver=\"smsg('View Page Number $i');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">".$i."</a></strong>&nbsp;&nbsp;"; 
				}
			}
		}
		
		$this->tbl.="&nbsp;</td><td width='15%' align='right'><strong>";
		if($start+$this->record_per_page<$totalrows) 
		{ 
			$this->tbl.="<a href='".$this->file_names."?start=".($start+$this->record_per_page).$tmpva."' class='ttt' onMouseOver=\"smsg('Next Page');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">Next&gt;&gt;</a>"; 
		} 
		$this->tbl.="&nbsp;&nbsp;</strong>&nbsp;</td></tr></table>";
		
		if($bottom=="Y")
		{
			if($totalrows>0)
				return $result=array($result,$this->tbl);
			else
				return $result=array($result,"");
		}
		else
		{
			if($totalrows>0)
			{
				echo $this->tbl;		
				return $result;
			}
			else
			{
				return $result;
			}
		}
	
}
///////////// NUMERIC FUNCTION WITH RECORD DESTAIL//////////////////////////////////////
function number_pageing_FRONT($query,$record_per_page='',$pages='',$detail='',$bottom='',$simple='')
{

		$this->file_names();
		$this->query=$query;
		
		if($record_per_page>0)
			$this->record_per_page=$record_per_page;
		
		if($pages>0)
			$this->pages=$pages;

		$result=$this->runquery($this->query);
		$totalrows= mysql_affected_rows();										
		
		$start=$this->start();
		
		$order=$_GET['order'];
		$this->query.=" limit $start,".$this->record_per_page;  
		$result=$this->runquery($this->query);
		$total= mysql_affected_rows();
		
		$total_pages=ceil($totalrows/$this->record_per_page);
		$current_page=($start+$this->record_per_page)/$this->record_per_page;
		$loop_counter=ceil($current_page/$this->pages);
		$start_loop=($loop_counter*$this->pages-$this->pages)+1;
		$end_loop=($this->pages*$loop_counter)+1;

		if($end_loop>$total_pages)
			$end_loop=$total_pages+1;

		$tmpva="";
		foreach($_GET as $V=>$K)
		{
			if($V!="start")
				$tmpva.="&".$V."=".$K;
		}
		
		//$this->tbl="<div style='position:absolute;background-color:#FFFF00;margin:0 auto;top:300px;width:88%;max-width:88%;'>";
		
		
		if($start>0)
		{ 
			$this->tbl.="<a href='".$this->file_names."?start=".($start-$this->record_per_page).$tmpva."'  ><img    src='images/tab_back.png' width=40  border=0></a>&nbsp;&nbsp;"; 
		} 

		
		$this->tbl.="";
		if($start+$this->record_per_page<$totalrows) 
		{ 
			$this->tbl.="<a href='".$this->file_names."?start=".($start+$this->record_per_page).$tmpva."'   ><img  src='images/tab_forward.png' width=40 border=0></a>"; 
		} 
		
		//$this->tbl.="</div>";
		if($bottom=="Y")
		{
			if($totalrows>0)
				return $result=array($result,$this->tbl);
			else
				return $result=array($result,"");
		}
		else
		{
			if($totalrows>0)
			{
				echo $this->tbl;		
				return $result;
			}
			else
			{
				return $result;
			}
		}
	
}
//////////////////////BY //////////////////////
function pageing_bottom_product($query,$record_per_page='',$pages='',$detail='',$bottom='',$simple='')
{
		$this->file_names();
		$this->query=$query;
		
		if($record_per_page>0)
			$this->record_per_page=$record_per_page;
		
		if($pages>0)
			$this->pages=$pages;

		$result=$this->runquery($this->query);
		$totalrows= mysql_affected_rows();										
		global $start;
		$start=$this->start();
		
		$order=$_GET['order'];
		$this->query.=" limit $start,".$this->record_per_page;  
		//echo $this->query;
		$result=$this->runquery($this->query);
		$total= mysql_affected_rows();
		
		$total_pages=ceil($totalrows/$this->record_per_page);
		$current_page=($start+$this->record_per_page)/$this->record_per_page;
		$loop_counter=ceil($current_page/$this->pages);
		$start_loop=($loop_counter*$this->pages-$this->pages)+1;
		$end_loop=($this->pages*$loop_counter)+1;

		if($end_loop>$total_pages)
			$end_loop=$total_pages+1;

		//$tmpva="&Search=".$_REQUEST['Search']."";
		foreach($_GET as $V=>$K)
		{
			if($V!="start")
				$tmpva.="&".$V."=".$K;
		}
		
		$this->tbl="<table border='0' cellspacing='0' cellpadding='0' width='300' align='right'><tr><td align='right'><table border='0' align='right' cellpadding='0' cellspacing='6'><tr><td width='1'>&nbsp;</td>";
		
		if($start>0)
		{ 
			$this->tbl.="<td width='14' height='16' align='center' class='grey-link_2' onclick='window.location.href=\"search.php?start=".($start-$this->record_per_page).$tmpva."\"'>&nbsp;Previous&nbsp;&nbsp;</td>"; 
		} 

		//$this->tbl.="</td>";
		/*if($detail!="N" and $simple !="N")
			$this->tbl.="<strong>Result ".($start+1)." - ".($start+$total)." of ".$totalrows." Records</strong><BR>";*/	
		if($simple!='N')
		{
			for($i=$start_loop;$i<$end_loop;$i++) 
			{
				if($current_page==$i)	
				{
					$this->tbl.="<td width='14' height='16' align='center' class='grey-link' style='background-color: #336699;'>".$i."</td>";	
				}	
				else 
				{ 
					$this->tbl.="<td width='14' height='16' align='center' class='grey-link' onclick='window.location.href=\"search.php?start=".($i-1)*$this->record_per_page.$tmpva."\"'>".$i."</td>"; 
				}
			}
		}
		
		//$this->tbl.="&nbsp;<td width='15%' align='right'><strong>";
		if($start+$this->record_per_page<$totalrows) 
		{ 
			$this->tbl.="<td width='14' height='16' align='center' class='grey-link_2' onclick='window.location.href=\"".$this->file_names."?start=".($start+$this->record_per_page).$tmpva."\"'>&nbsp;Next&nbsp;&nbsp;</td>"; 
		} 
		$this->tbl.="</tr></table></td></tr></table>";
		
		if($bottom=="Y")
		{
			if($totalrows>0)
				return $result=array($result,$this->tbl);
			else
				return $result=array($result,"");
		}
		else
		{
			if($totalrows>0)
			{
				echo $this->tbl;		
				return $result;
			}
			else
			{
				return $result;
			}
		}
	
}
////////////////////END OF PAGING BY //////////

//////////////////////BY  -- search listing page//////////////////////
function pageing_bottom_searchlisting($query,$record_per_page='',$pages='',$detail='',$bottom='',$simple='',$pgnm)
{
		$this->file_names();
		$this->query=$query;
		
		if($record_per_page>0)
			$this->record_per_page=$record_per_page;
		
		if($pages>0)
			$this->pages=$pages;

		$result=$this->runquery($this->query);
		$totalrows= mysql_affected_rows();										
		global $start;
		$start=$this->start();
		
		$order=$_GET['order'];
		$this->query.=" limit $start,".$this->record_per_page;  
		//echo $this->query;
		$result=$this->runquery($this->query);
		$total= mysql_affected_rows();
		
		$total_pages=ceil($totalrows/$this->record_per_page);
		$current_page=($start+$this->record_per_page)/$this->record_per_page;
		$loop_counter=ceil($current_page/$this->pages);
		$start_loop=($loop_counter*$this->pages-$this->pages)+1;
		$end_loop=($this->pages*$loop_counter)+1;

		if($end_loop>$total_pages)
			$end_loop=$total_pages+1;

		//$tmpva="&Search=".$_REQUEST['Search']."";
		foreach($_GET as $V=>$K)
		{
			if($V!="start")
				$tmpva.="&".$V."=".$K;
		}
		
		$this->tbl="<table border='0' cellspacing='0' cellpadding='0' width='600' align='left'><tr><td align='right'><table border='0' align='left' cellpadding='0' cellspacing='2'><tr><td width='190' align='left' class='footer-link-txt'>";
		$this->tbl.="&nbsp;&nbsp;<strong class='black-14-b'>".$totalrows." Records Found</strong></td>";
		if($totalrows>$this->record_per_page)
		{
			$this->tbl.="<td width='14' height='16' align='right' class='footer-link-txt'>Page:</td>"; 
			if($start>0)
			{ 
				$this->tbl.="<td width='14' height='16' align='right' class='footer-link-txt'>&lt;&nbsp;<a href='".$pgnm."?start=".($start-$this->record_per_page).$tmpva."' class='footer-link-txt'>Previous</a>&nbsp;</td>"; 
			} 
	
			//$this->tbl.="</td>";
			if($simple!='N')
			{
				for($i=$start_loop;$i<$end_loop;$i++) 
				{
					if($current_page==$i)	
					{
						$this->tbl.="<td width='14' height='16' align='center' class='footer-link-txt' >|&nbsp;<strong>".$i."</strong></td>";	
					}	
					else 
					{ 
						$this->tbl.="<td width='14' height='16' align='center' class='footer-link-txt'>|&nbsp;<a href='".$pgnm."?start=".($i-1)*$this->record_per_page.$tmpva."' class='footer-link-txt'>".$i."</a></td>"; 
					}
				}
			}
			
			//$this->tbl.="&nbsp;<td width='15%' align='right'><strong>";
			if($start+$this->record_per_page<$totalrows) 
			{ 
				$this->tbl.="<td width='14' height='16' align='center' class='footer-link-txt'>|&nbsp;<a href='".$pgnm."?start=".($start+$this->record_per_page).$tmpva."' class='footer-link-txt'>Next</a>&nbsp;&gt;</td>"; 
			} 
		}	
		$this->tbl.="</tr></table></td></tr></table>";
		
		if($bottom=="Y")
		{
			if($totalrows>0)
				return $result=array($result,$this->tbl);
			else
				return $result=array($result,"");
		}
		else
		{
			if($totalrows>0)
			{
				echo $this->tbl;		
				return $result;
			}
			else
			{
				return $result;
			}
		}
	
}
////////////////////END OF PAGING BY //////////


function number_pageing_admin($query,$record_per_page='',$pages='',$detail='',$bottom='',$simple='')
{

		$this->file_names();
		$this->query=$query;
		
		if($record_per_page>0)
			$this->record_per_page=$record_per_page;
		
		if($pages>0)
			$this->pages=$pages;

		$result=$this->runquery($this->query);
		$totalrows= mysql_affected_rows();										
		
		$start=$this->start();
		
		$order=$_GET['order'];
		$this->query.=" limit $start,".$this->record_per_page;  
		$result=$this->runquery($this->query);
		$total= mysql_affected_rows();
		
		$total_pages=ceil($totalrows/$this->record_per_page);
		$current_page=($start+$this->record_per_page)/$this->record_per_page;
		$loop_counter=ceil($current_page/$this->pages);
		$start_loop=($loop_counter*$this->pages-$this->pages)+1;
		$end_loop=($this->pages*$loop_counter)+1;

		if($end_loop>$total_pages)
			$end_loop=$total_pages+1;

		$tmpva="";
		foreach($_GET as $V=>$K)
		{
			if($V!="start")
				$tmpva.="&".$V."=".$K;
		}
		
		$this->tbl="<table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0' ><tr><td width='15%' align='left'><strong>&nbsp;&nbsp;";
		
		
		if($start>0)
		{ 
			$this->tbl.="<a href='".$this->file_names."?start=".($start-$this->record_per_page).$tmpva."'  class='ttt'  onMouseOver=\"smsg('previous Page');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">&lt;&lt;previous</a>&nbsp;&nbsp;"; 
		} 

		$this->tbl.="</strong>&nbsp;</td><td width='70%' class='blogDate'  align='center'>&nbsp;";
		if($detail!="N" and $simple !="N")
			$this->tbl.="<strong>Result ".($start+1)." - ".($start+$total)." of ".$totalrows." Records</strong><BR>";
		if($simple!='N')
		{
			for($i=$start_loop;$i<$end_loop;$i++) 
			{
				if($current_page==$i)	
				{
					$this->tbl.="<strong><span class='ttt'>".$i."</span></strong>&nbsp;&nbsp;";	
				}	
				else 
				{ 
					$this->tbl.="<strong><a href='".$this->file_names."?start=".($i-1)*$this->record_per_page.$tmpva."'  class='ttt' onMouseOver=\"smsg('View Page Number $i');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">".$i."</a></strong>&nbsp;&nbsp;"; 
				}
			}
		}
		
		$this->tbl.="&nbsp;</td><td width='15%' align='right'><strong>";
		if($start+$this->record_per_page<$totalrows) 
		{ 
			$this->tbl.="<a href='".$this->file_names."?start=".($start+$this->record_per_page).$tmpva."' class='ttt' onMouseOver=\"smsg('Next Page');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">Next&gt;&gt;</a>"; 
		} 
		$this->tbl.="&nbsp;&nbsp;</strong>&nbsp;</td></tr></table>";
		
		if($bottom=="Y")
		{
			if($totalrows>0)
				return $result=array($result,$this->tbl);
			else
				return $result=array($result,"");
		}
		else
		{
			if($totalrows>0)
			{
				echo $this->tbl;		
				return $result;
			}
			else
			{
				return $result;
			}
		}
	
}	
////////////
function number_pageing_admin_with_alldetail($query,$record_per_page='',$pages='',$detail='',$bottom='',$simple='')
{

		$this->file_names();
		$this->query=$query;
		
		if($record_per_page>0)
			$this->record_per_page=$record_per_page;
		
		if($pages>0)
			$this->pages=$pages;

		$result=$this->runquery($this->query);
		$totalrows= mysql_affected_rows();										
		
		$start=$this->start();
		
		$order=$_GET['order'];
		$this->query.=" limit $start,".$this->record_per_page;  
		$result=$this->runquery($this->query);
		$total= mysql_affected_rows();
		
		$total_pages=ceil($totalrows/$this->record_per_page);
		$current_page=($start+$this->record_per_page)/$this->record_per_page;
		$loop_counter=ceil($current_page/$this->pages);
		$start_loop=($loop_counter*$this->pages-$this->pages)+1;
		$end_loop=($this->pages*$loop_counter)+1;

		if($end_loop>$total_pages)
			$end_loop=$total_pages+1;

		$tmpva="";
		foreach($_GET as $V=>$K)
		{
			if($V!="start")
				$tmpva.="&".$V."=".$K;
		}
		
		$this->tbl="<table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0' ><tr><td width='15%' align='left'><strong>&nbsp;&nbsp;";
		
		
		if($start>0)
		{ 
			$this->tbl.="<a href='".$this->file_names."?start=".($start-$this->record_per_page).$tmpva."'  class='ttt'  onMouseOver=\"smsg('previous Page');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">&lt;&lt;previous</a>&nbsp;&nbsp;"; 
		} 

		$this->tbl.="</strong>&nbsp;</td><td width='70%' class='blogDate'  align='center'>&nbsp;";
		if($detail!="N" and $simple !="N")
			$this->tbl.="<strong>Result ".($start+1)." - ".($start+$total)." of ".$totalrows." Records</strong><BR>";
		if($simple!='N')
		{
			for($i=$start_loop;$i<$end_loop;$i++) 
			{
				if($current_page==$i)	
				{
					$this->tbl.="<strong><span class='ttt'>".$i."</span></strong>&nbsp;&nbsp;";	
				}	
				else 
				{ 
					$this->tbl.="<strong><a href='".$this->file_names."?start=".($i-1)*$this->record_per_page.$tmpva."'  class='ttt' onMouseOver=\"smsg('View Page Number $i');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">".$i."</a></strong>&nbsp;&nbsp;"; 
				}
			}
		}
		
		$this->tbl.="&nbsp;</td><td width='15%' align='right'><strong>";
		if($start+$this->record_per_page<$totalrows) 
		{ 
			$this->tbl.="<a href='".$this->file_names."?start=".($start+$this->record_per_page).$tmpva."' class='ttt' onMouseOver=\"smsg('Next Page');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">Next&gt;&gt;</a>"; 
		} 
		$this->tbl.="&nbsp;&nbsp;</strong>&nbsp;</td></tr></table>";
		
		if($bottom=="Y")
		{
			if($totalrows>0)
				return $result=array($result,$this->tbl);
			else
				return $result=array($result,"");
		}
		else
		{
			if($totalrows>0)
			{
				echo $this->tbl;		
				return $result;
			}
			else
			{
				return $result;
			}
		}
	
}	
////////////
//////////////  SIMPLE NEXT-PRI PAGING ///////////////////CREATED BY 	
	function pageing($query,$record_per_page="",$pages="")
	{
			return $this->number_pageing($query,$record_per_page,$pages,'','','N');
	}
//////////////  END OF SIMPLE PAGING FUNCTION///////////////////CREATED BY 	

//////////////  WRITE ALL,A TO Z CHARACTER WITH CURRENT PAGE LINK ///////////////////CREATED BY 
	function order()
	{
		$this->file_names();
		$this->order.="<TR><TD><a href='".$this->file_names."' onMouseOver=\"smsg('View All Records');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">All</a></TD><TD >|</TD>";
		for($i=65;$i<91;$i++)
		{		
			$this->order.="<TD><a class=la href='$file_names?order=".chr($i)."' onMouseOver=\"smsg('View By ".chr($i)."');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">".chr($i)."</a></TD><TD class=lg>|</TD>";
		}
		return $this->order.="</TR>";
	}
	
}

$prs_pageing= new get_pageing;

function run($query)
	{
		return	mysql_query($query);
	}

function addlink($title,$file,$class="")
{
	$str="<a href='$file'";
	$str.=(strlen($class)>0)?" class='$class'":"";
	$str.=" onMouseOver=\"smsg('$title');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">$title</a>";
	echo $str;
}


function ads($str)
{
	return $newstr=htmlentities($str,ENT_QUOTES);
}
function rms($str)
{
	return $newstr=stripslashes($str);
}
//////////////  END OF ORDER FUNCTION///////////////////CREATED BY 


function getvalue($tbl,$condition="",$return_true,$return_false="")
{
	$values=getuser($condition,$return_true,$return_false,$tbl);
	return $values;
}

function getvar()
{
	$sel="select * from affiliate where id=".$_COOKIE["AID"];
	$run=mysql_query($sel);
}
?>