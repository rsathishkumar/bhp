<?php
//$q_model="SELECT node.title,node.nid, field_data_field_nr_make.field_nr_make_nid FROM node,field_data_field_nr_make WHERE field_data_field_nr_make.entity_id = node.nid AND node.status =1  order by node.created desc limit 0,3";
$q_model = "SELECT node.title,node.nid, field_data_field_make_home_page.field_make_home_page_nid 
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
if($numberofrows<6)
{
	$Minus = 6 - $numberofrows;
}
else
{
	$Minus = 1 ;
}
$sql_modelrand=@mysqli_query("SELECT node.title,node.nid, field_data_field_make_home_page.field_make_home_page_nid
				FROM node,field_data_field_make_home_page WHERE field_data_field_make_home_page.entity_id = node.nid  AND node.status =1 AND node.nid not in (".@substr($mid,0,-1).") order by rand() limit 0,".$Minus);
$numberofrowsrand=@mysqli_num_rows($sql_modelrand);
//$sql_make=@mysqli_query("select node.title,node.nid from node,field_data_field_nr_make where field_data_field_nr_make.field_nr_make_nid=node.nid and node.status=1 group by field_data_field_nr_make.field_nr_make_nid order by node.title");
$sql_make=@mysqli_query("select node.title,node.nid from node,field_data_field_make_home_page where field_data_field_make_home_page.field_make_home_page_nid=node.nid and node.status=1 group by field_data_field_make_home_page.field_make_home_page_nid order by node.title");
$nofmake=mysqli_num_rows($sql_make);
?>
<div class="homeReview">
	<h4 class="TLR5 clearfix">
		<strong class="title" id="car_rview">Car Reviews</strong><!-- code for this click event writen in home-news-->
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
				if($numberofrows>0)
				{
					while($data_model=@mysqli_fetch_array($sql_model))
					{
						$sql_img=@mysqli_fetch_array(mysqli_query("SELECT  field_home_page_review_image_fid as fid,uri FROM `field_data_field_home_page_review_image`,file_managed WHERE file_managed.fid=field_data_field_home_page_review_image.field_home_page_review_image_fid and field_data_field_home_page_review_image.entity_id='".$data_model['nid']."'"));
						//$model_imgname="sites/default/files/defaultmodel_131.gif";
						//$makeRow = @mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_model['field_nr_make_nid']));
						$makeRow = @mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_model['field_make_home_page_nid']));
						$Link = @mysqli_fetch_array(mysqli_query("select field_home_page_review_url_link_value from field_data_field_home_page_review_url_link where entity_id=".$data_model['nid']));
	 		     ?>
						<li>

							<?php

							    $xlink = $Link['field_home_page_review_url_link_value'];

							    if (stristr($xlink, 'http://')) {

							            $xlink = str_replace('http://', 'https://', $xlink);
							    }

							?>
							<a href="<?php echo $xlink;?>" title="<?php echo $data_model['title'];?>">
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
				 <a>
					<span>No review found</span>
				 </a>
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
	</div><!-- end of ajax -->
</div><!-- homeReview -->
