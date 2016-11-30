<?
include("connect.php");
$cid=$_REQUEST['cid'];
$sub2=$_REQUEST['sub2'];
$cmbid=$_REQUEST['cmbid'];

$sql="select * from options_group_values where groupid='".$cid."' order by name";

$rs=mysql_query($sql);
$tot=mysql_affected_rows();


if($tot>0)
{
	for($w=0;$w<$tot;$w++)
	{
		$aj=mysql_fetch_object($rs);
		$id=stripslashes($aj->id);
		$name=stripslashes($aj->name);
			$data.="<img src='images/checkbox-selected.jpg' width='15' align='absmiddle'>&nbsp;".$name."<br>";
	}
}
else
{
		$data.="";
}
echo $data; 

?>