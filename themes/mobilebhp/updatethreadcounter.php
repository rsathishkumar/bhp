<?php
include_once("connect.php");
if($con)
	{
	if($_POST['action']=='show')
		{
		$q =@mysqli_query("SELECT nid,totalcount from node_counter where nid=".$_POST['nid']);	
			if(mysqli_num_rows($q)==0)
				{
				$ins=mysqli_query("insert into node_counter values(".$_POST['nid'].",1,0,".time().")");
			
				}
				else
				{
				$d=mysql_fetch_assoc($q);
				//echo $d['totalcount'];
				$counter=$d['totalcount']+1;
				if($counter=='' || $counter==0)
					{
					$counter=1;
					}
				$upd=mysqli_query("update node_counter set totalcount=".$counter.",timestamp=".time()." where nid=".$_POST['nid']);
				}
				echo 1;
				
		}
		else
		{
		echo 2;
		}
	}
	else
	{
	echo 2;
	}
?>
