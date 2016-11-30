<?
include("connect.php");
$cid=$_REQUEST['cid'];
$sub2=$_REQUEST['sub2'];
$cmbid=$_REQUEST['cmbid'];

$sql="select * from groups_subcategory where groupid='".$cid."' order by name";

$rs=mysql_query($sql);
$tot=mysql_affected_rows();

if($sub2=="Y")
	$data='<select name="'.$cmbid.'" id="'.$cmbid.'" class="solidinput" style="width:250px">';
else
	$data='<select name="'.$cmbid.'" id="'.$cmbid.'" class="solidinput" style="width:250px">';

if($tot>0)
{
	$data.="<option value=''>Select Sub Group</option>";
	for($w=0;$w<$tot;$w++)
	{
		$aj=mysql_fetch_object($rs);
		$id=stripslashes($aj->id);
		$name=stripslashes($aj->name);
			$data.="<option value=".$id.">".$name."</option>";
	}
}
else
{
		$data.="<option value='0'>No Sub Group</option>";
}

$data.="</select>";
echo $data; 

?>