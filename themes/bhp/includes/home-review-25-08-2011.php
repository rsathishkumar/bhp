<?php
$q_model="SELECT node.title,node.nid, file_managed.uri,field_data_field_nr_make.field_nr_make_nid,field_data_field_model_dashboard.field_model_dashboard_fid
FROM node,file_managed,field_data_field_nr_make,field_data_field_model_dashboard
WHERE field_data_field_model_dashboard.field_model_dashboard_fid = file_managed.fid
AND field_data_field_model_dashboard.entity_id = node.nid
AND node.status =1 AND field_data_field_nr_make.entity_id=field_data_field_model_dashboard.entity_id order by node.created desc limit 0,3";

$sql_model=@mysqli_query($q_model);
$numberofrows=@mysqli_num_rows($sql_model);
			if($numberofrows>0)
					{
					$mid='';
					while($data_modelfornid=mysqli_fetch_array($sql_model))
						{
						$mid.=$data_modelfornid['nid'].",";
						}
					}
$sql_modelrand=@mysqli_query("SELECT node.title,node.nid, file_managed.uri,field_data_field_nr_make.field_nr_make_nid,field_data_field_model_dashboard.field_model_dashboard_fid
FROM node,file_managed,field_data_field_nr_make,field_data_field_model_dashboard
WHERE field_data_field_model_dashboard.field_model_dashboard_fid = file_managed.fid
AND field_data_field_model_dashboard.entity_id = node.nid
AND node.status =1 AND field_data_field_nr_make.entity_id=field_data_field_model_dashboard.entity_id and node.nid not in (".@substr($mid,0,-1).")order by rand() limit 0,3");
$numberofrowsrand=@mysqli_num_rows($sql_modelrand);
$sql_make=@mysqli_query("select node.title,node.nid from node,field_data_field_nr_make where field_data_field_nr_make.field_nr_make_nid=node.nid and node.status=1 group by field_data_field_nr_make.field_nr_make_nid order by node.title");
$nofmake=mysqli_num_rows($sql_make);
?>
<div class="homeReview">
	<h4 class="TLR5 clearfix">
		<strong class="title">Car Reviews</strong>
		<span class="options">
			<select name="make" onchange="showmodelbymake(this.value);">
				<option value="0">Select a Make</option>
				<?php
				$sql_model=@mysqli_query($q_model);
					if($nofmake>0)
					{
					while($data_make=mysqli_fetch_array($sql_make))
						{
				?>
				<option value="<?php echo $data_make['nid'];?>"><?php echo $data_make['title'];?></option>
				<?php
						}
					}
				?>
			</select>
		</span>
	</h4>
	<div id="ajax">
	<div class="reviewContent BLR5">
	
		<ul class="reviewList clearfix">
			<?php
				if($numberofrows>0 || $numberofrowsrand>0)
					{
						if($numberofrows>0)
							{
							while($data_model=mysqli_fetch_array($sql_model))
								{
					?>
					<li>
						<a href="<?php echo url("node/".$data_model['nid'])?>" title="<?php echo $data_model['title'];?>">
							<!-- <img width="175" height="131" src="sites/default/files/<?php echo str_replace("public://","",$data_model['uri']);?>" alt="<?php echo $data_model['title'];?>" /> -->
							<img width="175" height="131" src="http://www.team-bhp.com/?q=sites/default/files/styles/medium_medium/public/<?php echo str_replace("public://","",$data_model['uri']);?>" alt="<?php echo $data_model['title'];?>" />
							<b>&nbsp;</b>
							<span><?php echo $data_model['title'];?></span>
						</a>
					</li>
					<?php
								}
							}
						if($numberofrowsrand>0)
							{
							while($data_modelrand=mysqli_fetch_array($sql_modelrand))
								{
					?>
					<li>
						<a href="<?php echo url("node/".$data_modelrand['nid'])?>" title="<?php echo $data_modelrand['title'];?>">
							<!-- <img width="175" height="131" src="sites/default/files/<?php echo str_replace("public://","",$data_model['uri']);?>" alt="<?php echo $data_model['title'];?>" /> -->
							<img width="175" height="131" src="http://www.team-bhp.com/?q=sites/default/files/styles/medium_medium/public/<?php echo str_replace("public://","",$data_modelrand['uri']);?>" alt="<?php echo $data_modelrand['title'];?>" />
							<b>&nbsp;</b>
							<span><?php echo $data_modelrand['title'];?></span>
						</a>
					</li>
					<?php
								}
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
		<div class="marR12 marT10 clearfix">
			<a href="?q=reviews" class="fright btnRight">
				<span>View All Car Reviews</span>
			</a>
		</div>
	</div><!-- reviewContent -->
	</div><!-- end of ajax -->
</div><!-- homeReview -->
