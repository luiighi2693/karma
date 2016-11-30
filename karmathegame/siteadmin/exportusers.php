<?
include("connect.php"); 
ini_set('memory_limit','400000M'); // set memory to prevent fatal errors
define('MEMORY_TO_ALLOCATE','400000M');
function exportTableCSV($filename = 'Members.csv')
{
    global $SITE_URL;
	$csv_terminated = "\n";
    $csv_separator = ",";
    $csv_enclosed = '"';
    $csv_escaped = "\\";
	
	
	//$sql_query="select * from  users order by firstname asc";
	$sql_query=$_SESSION["EXPORT_MEMBER_QRYY"];
	$result = mysql_query($sql_query);
	if(mysql_affected_rows()>0) 
	{
		$fields_cnt = mysql_num_fields($result);
		
		$schema_insert = '';
		$schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, "User Name") . $csv_enclosed;
		$schema_insert .= $csv_separator;
		$schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, "Code") . $csv_enclosed;
		$schema_insert .= $csv_separator;
		$schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, "Email") . $csv_enclosed;
		$schema_insert .= $csv_separator;
		$schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, "Token") . $csv_enclosed;
		$schema_insert .= $csv_separator;
		$schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, "Free Lives") . $csv_enclosed;
		$schema_insert .= $csv_separator;
		$schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, "Date") . $csv_enclosed;
		$schema_insert .= $csv_separator;
		$out .= $schema_insert;
		$out .= $csv_terminated;
	 
		// Format the data
		$count=0;
		while($roww = mysql_fetch_object($result))
		{
			$schema_insert = '';
			$count++;
			
			$users_lifes=GetName1("users_lifes","totallifes","userid",$roww->id);
			$schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, stripslashes($roww->username)) . $csv_enclosed;
			$schema_insert .= $csv_separator;
			$schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, "".stripslashes($roww->marketer)."") . $csv_enclosed;
			$schema_insert .= $csv_separator;
			$schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, stripslashes($roww->email)) . $csv_enclosed;
			$schema_insert .= $csv_separator;
			$schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, ''.stripslashes($roww->couponcode).'') . $csv_enclosed;
			$schema_insert .= $csv_separator;
			$schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, ''.$users_lifes.'') . $csv_enclosed;
			$schema_insert .= $csv_separator;
			$schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, date("m/d/Y H:i:s",strtotime($roww->regdate))) . $csv_enclosed;
			$schema_insert .= $csv_separator;
			
			for ($j = 1; $j < ($fields_cnt-2); $j++)
			{
				if ($row[$j] == '0' || $row[$j] != '')
				{
	 
					if ($csv_enclosed == '')
					{
						$schema_insert .= $row[$j];
					} 
					else
					{
						$schema_insert .= $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $row[$j]) . $csv_enclosed;
					}
				} 
				else
				{
					$schema_insert .= '';
				}
	 
				if ($j < $fields_cnt - 1)
				{
					$schema_insert .= $csv_separator;
				}
			} // end for
			$out .= $schema_insert;
			$out .= $csv_terminated;
		}
			
	}
	// end while
    $filename="Users.csv";
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Length: " . strlen($out));
    // Output to browser with appropriate mime type, you choose ;)
    header("Content-type: text/x-csv");
    //header("Content-type: text/csv");
    //header("Content-type: application/csv");
    header("Content-Disposition: attachment; filename=$filename");
    echo $out;
    exit;
}

exportTableCSV();
