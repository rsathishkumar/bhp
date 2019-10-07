<?php
include_once("connect.php");
if($_POST['action']=='show')
	{
		if($_POST['makeid']!=0)
		{
		$sql_model=@mysqli_query("SELECT node.title,node.nid, file_managed.uri,field_data_field_nr_make.field_nr_make_nid,field_data_field_model_dashboard.field_model_dashboard_fid
FROM node,file_managed,field_data_field_nr_make,field_data_field_model_dashboard
WHERE field_data_field_model_dashboard.field_model_dashboard_fid = file_managed.fid
AND field_data_field_model_dashboard.entity_id = node.nid AND field_data_field_nr_make.field_nr_make_nid=".$_POST['makeid']." AND node.status =1 AND field_data_field_nr_make.entity_id=field_data_field_model_dashboard.entity_id order by node.changed desc limit 0,6");
		

		}
		else
		{
$sql_model=@mysqli_query("SELECT node.title,node.nid, file_managed.uri,field_data_field_nr_make.field_nr_make_nid,field_data_field_model_dashboard.field_model_dashboard_fid
FROM node,file_managed,field_data_field_nr_make,field_data_field_model_dashboard
WHERE field_data_field_model_dashboard.field_model_dashboard_fid = file_managed.fid
AND field_data_field_model_dashboard.entity_id = node.nid
AND node.status =1 AND field_data_field_nr_make.entity_id=field_data_field_model_dashboard.entity_id order by node.changed desc limit 0,6");		
		}
		$numberofrows=@mysqli_num_rows($sql_model);
?>
<div class="reviewContent BLR5">
	
		<ul class="reviewList clearfix">
			<?php
				if($numberofrows>0)
					{
					while($data_model=mysqli_fetch_array($sql_model))
						{
						$url_res = @mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$data_model['nid']."'"));
						$url = $url_res['alias'];
			?>
			<li>
				<a href="?q=<?php echo $url; ?>" title="<?php echo $data_model['title'];?>">
					<!-- <img width="175" height="130" src="sites/default/files/<?php echo str_replace("public://","",$data_model['uri']);?>" alt="<?php echo $data_model['title'];?>" /> -->
					<img width="175" height="130" src="http://www.team-bhp.com/?q=sites/default/files/styles/medium_medium/public/<?php echo str_replace("public://","",$data_model['uri']);?>" alt="<?php echo $data_model['title'];?>" />
					
					<b>&nbsp;</b>
					<span><?php echo $data_model['title'];?></span>
				</a>
			</li>
			<?php
						}
					}
					else
					{
			?>
			<li>
				<a>
					<span>No review found</span>
				</a>
			</li>
			<?php
					}
			?>
		</ul><!-- reviewList -->
		<div class="marR12 clearfix">
			<a href="?q=review" class="fright btnRight">
				<span>View All Car Reviews</span>
			</a>
		</div>
	</div><!-- reviewContent -->
<?php
	}
	
?>
