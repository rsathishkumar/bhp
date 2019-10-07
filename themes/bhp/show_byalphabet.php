<?php
include_once("connect.php");
		$sql_dictionary=@mysqli_query("SELECT node.title, field_data_body.body_value FROM node, field_data_body WHERE node.type = 'dictionary' AND field_data_body.entity_id = node.nid AND node.status =1 and substr(node.title,1,1) like '%".$_POST['alphabet']."' order by node.title");
$num=mysqli_num_rows($sql_dictionary);
		if($num>0)
			{

				while($d_dic=mysqli_fetch_array($sql_dictionary))
					{
				?>
				<h3><?php echo $d_dic['title'];?></h3> 
				<p><?php echo $d_dic['body_value'];?></p>
				<?php
					}
					
			}
		else
			{
		?>
		 no match with <strong><?php echo $_POST['alphabet'];?></strong> 
		<?php
			}
		?>
