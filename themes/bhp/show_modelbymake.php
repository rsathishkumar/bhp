<?php
	include_once("connect.php");
	if($_POST['action']=='show')
	{
			/*if($_POST['makeid']!=0)
			{*/ 
			if($_POST['makeid']==0)
			{ 
				$q_model="SELECT node.title,node.nid, field_data_field_make_home_page.field_make_home_page_nid 
				FROM node,field_data_field_make_home_page WHERE field_data_field_make_home_page.entity_id = node.nid  AND node.status =1  order by node.created desc limit 0,6";
				
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
				$sql_modelrand=@mysqli_query("SELECT node.title,node.nid, field_data_field_make_home_page.field_make_home_page_nid 
				FROM node,field_data_field_make_home_page WHERE field_data_field_make_home_page.entity_id = node.nid  AND node.status =1 AND node.nid not in (".@substr($mid,0,-1).") order by rand() limit 0,3");
				$numberofrowsrand=@mysqli_num_rows($sql_modelrand);
				
		?>
		  <div class="reviewContent BLR5">
		
		   <ul class="reviewList clearfix">
				<?php
				if($numberofrows>0)
				{
					$sql_model=@mysqli_query($q_model);
					while($data_model=@mysqli_fetch_array($sql_model))
					{
						$sql_img=@mysqli_fetch_array(mysqli_query("SELECT  field_home_page_review_image_fid as fid,uri FROM `field_data_field_home_page_review_image`,file_managed WHERE file_managed.fid=field_data_field_home_page_review_image.field_home_page_review_image_fid and field_data_field_home_page_review_image.entity_id='".$data_model['nid']."'"));
						$makeRow = @mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_model['field_make_home_page_nid']));
						$url_res = @mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$data_model['nid']."'"));
						$Link = @mysqli_fetch_array(mysqli_query("select field_home_page_review_url_link_value from field_data_field_home_page_review_url_link where entity_id=".$data_model['nid']));
				?>
				<li>
					<a href="<?php echo $Link['field_home_page_review_url_link_value'];//echo $url_res['alias'];?>" title="<?php echo $data_model['title']; //echo $makeRow['title']." ".$data_model['title'];?>">
					<!-- <img width="175" height="131" src="sites/default/files/<?php echo str_replace("public://","",$data_model['uri']);?>" alt="<?php echo $data_model['title'];?>" /> -->
					<img src="/sites/default/files/styles/check_car_review_home/public/<?php echo str_replace("public://","",$sql_img['uri']);?>" alt="<?php echo $data_model['title'];?>" />
					<b>
					<span><?php echo /*$makeRow['title']." ".*/$data_model['title'];?></span>
					</b>
				</a>
				</li>
			<?php
					}
				}
				else
				{
		     ?>
				<li>
					<span>No review found</span>
				</li>
		  	 <?php
				}
		  	 ?>
		  </ul><!-- reviewList -->
		<div class="marR12 marT10 clearfix">
			<a title="View all car reviews" href="/forum/official-new-car-reviews/?pp=25&sort=dateline&order=desc&daysprune=-1" class="fright btnRight">
				<span>View All Car Reviews</span>
			</a>
		</div>
		</div><!-- reviewContent -->
		<?php
		 }
		 else
		 {
				$sql_model=@mysqli_query("SELECT node.title,node.nid, field_data_field_make_home_page.field_make_home_page_nid
		FROM node,field_data_field_make_home_page,field_data_field_moel_launched WHERE field_data_field_make_home_page.entity_id = node.nid AND field_data_field_make_home_page.field_make_home_page_nid=".$_POST['makeid']." AND node.status =1 group by node.nid order by node.created desc limit 0,6");
				$numberofrows=@mysqli_num_rows($sql_model);
		?>
				<div class="reviewContent BLR5">
				<ul class="clearfix<?php if($numberofrows > 0){?> reviewList<?php }?>">
					<?php
					//echo "SELECT node.title FROM node,field_data_field_make_home_page,field_data_field_moel_launched WHERE field_data_field_make_home_page.entity_id = node.nid AND field_data_field_make_home_page.field_make_home_page_nid=".$_POST['makeid']." AND node.status =1 AND field_data_field_moel_launched.entity_id=node.nid order by field_moel_launched_value desc limit 0,7";
					$Counter = 0;
					if($numberofrows > 0)
					{
						while($data_model=mysqli_fetch_array($sql_model))
						{	
							$sql_img=@mysqli_fetch_array(mysqli_query("SELECT  field_home_page_review_image_fid as fid,uri FROM `field_data_field_home_page_review_image`,file_managed WHERE file_managed.fid=field_data_field_home_page_review_image.field_home_page_review_image_fid and field_data_field_home_page_review_image.entity_id='".$data_model['nid']."'"));
							$url_res = @mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$data_model['nid']."'"));
							$makeRow = @mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_model['field_make_home_page_nid']));
							$Link = @mysqli_fetch_array(mysqli_query("select field_home_page_review_url_link_value from field_data_field_home_page_review_url_link where entity_id=".$data_model['nid']));
					?>
							<li>
								<a href="<?php echo $Link['field_home_page_review_url_link_value']; ?>" title="<?php echo $data_model['title'];?>">
									<!-- <img width="175" height="130" src="sites/default/files/<?php echo str_replace("public://","",$data_model['uri']);?>" alt="<?php echo $data_model['title'];?>" /> -->
									<img src="/sites/default/files/styles/check_car_review_home/public/<?php echo str_replace("public://","",$sql_img['uri']);?>" alt="<?php echo $data_model['title'];?>" />
									<b>
									<span><?php echo /*$makeRow['title']." ".*/$data_model['title'];?></span>
									</b>
								</a>
							</li>
					<?php
						$Counter++;
						}
					}
					else
					{
					?>
					<li class="aln_center">
						<span><strong>No review found</strong></span>
					</li>
				<?php
					}
				?>
				</ul><!-- reviewList -->
				<?php if($numberofrows > 0)
				{
				?>
				<div class="marR12 clearfix">
				<a title="View All Car Reviews" href="/forum/official-new-car-reviews/?pp=25&sort=dateline&order=desc&daysprune=-1" class="fright btnRight">
				<span>View All Car Reviews</span>
				</a>
			    </div>
			    <?php
			    }
			    ?>
		</div><!-- reviewContent -->
		<?php
		}
	}
?>
