<?
include("connect.php");
if($_GET['fvalue']==2)
{
	$pid=GetName1('promotional','ordlimit',id,$_GET["promoid"]);
	$data.='$<input type="text" name="ordlimit" id="ordlimit" class="solidinput" value="'.$pid.'" >';
	echo $data;
}
else if($_GET['fvalue']==3)
{
	$pid=GetName1('products','name',id,$_GET["promoid"]);
	$pid=stripslashes($pid);
	if($pid=='')
	$pid='Select Item';
	$data='<label id="forpro" style="background-color:#fff;color:blue;" onClick="document.getElementById(\'getdd\').style.display=\'block\'">'.$pid.'</label>
	 <div class="dropdown" id="getdd">
		<br><input name="pidname" id="pidname" type="text" style="color:#000000;width:300px;" onBlur="chkpidval(this.value,\'forpro\');" onChange="chkpidval(this.value,\'forpro\');"  />
		<input name="pid" id="pid" type="hidden1"  value="" />				
	 </div>
	  <script>
		 $(function(){
			$(\'#pidname\').autocomplete(\'example160/data.php\', { 
				width: 338,
				max: 500
			});
		});
	</script>';
	echo $data;				 
}
else
{
	echo $data;
}
?>