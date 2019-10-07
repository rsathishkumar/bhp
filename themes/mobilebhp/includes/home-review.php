<script type="text/javascript">

	$(document).on('click', '.review-list li a', function (e) {
					e.preventDefault();
					var loaders = $('#loaderWrap').html();
					$('#wrapNewsList').html(loaders);
					var makeid = $(this).attr('data-value');
					$('.dropdown-toggle').html($(this).html() + '<i class="icon-angle-down"></i>');					
					$.ajax(
						{
							cache: false,
							url: "/themes/mobilebhp/show_modelbymake.php",
							type: "POST",
							data: "makeid="+makeid+"&action=show",
							error: function(request, status, error)
							{
								alert(status);
								$('.review-list').html(request.responseText);
							},
							success: function(data, status, request)
							{
								//console.log(data);
				   			 $("div#ajax").html(data);
								//$('.review-list').html(data);
							}
						});
				});

</script>
<?php

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

 $sql_make=@mysqli_query("select node.title,node.nid from node,field_data_field_make_home_page where field_data_field_make_home_page.field_make_home_page_nid=node.nid and node.status=1 group by field_data_field_make_home_page.field_make_home_page_nid order by node.title");
$data_make=mysqli_fetch_array($sql_make); 
$nofmake=mysqli_num_rows($sql_make);
?>
<section id="home-reviews" class="home-reviews">
	<div class="container-fluid">
		<h4 class="section-title text-center"><span>Reviews</span></h4>
		


<!--new design selectbox-->
		<div class="review-list text-center">
			<div class="btn-group btn-block">
				<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-default btn-block dropdown-toggle">Pick a make<i class="icon-angle-down"></i></button>
				<ul class="dropdown-menu review-drop">
					<?php
					$sql_model=@mysqli_query($q_model);
					
					if($nofmake>0)
					{
					while($data_make=mysqli_fetch_array($sql_make))
					{
						
					?>
					<li><a href="#home-reviews" data-value="<?php echo $data_make['nid'];?>"><?php echo $data_make['title'];?></a>
					</li>

					<?php
					}
					}
					?>

				</ul>
			</div>
		</div>



	<div id="ajax">
	<div class="review-slider car-slider">

				<?php
				if($numberofrows>=1)
				{
					while($data_model=@mysqli_fetch_array($sql_model))
					{
						$sql_img=@mysqli_fetch_array(mysqli_query("SELECT  field_home_page_review_image_fid as fid,uri FROM `field_data_field_home_page_review_image`,file_managed WHERE file_managed.fid=field_data_field_home_page_review_image.field_home_page_review_image_fid and field_data_field_home_page_review_image.entity_id='".$data_model['nid']."'"));
						//$model_imgname="sites/default/files/defaultmodel_131.gif";
						//$makeRow = @mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_model['field_nr_make_nid']));
						$makeRow = @mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_model['field_make_home_page_nid']));
						$Link = @mysqli_fetch_array(mysqli_query("select field_home_page_review_url_link_value from field_data_field_home_page_review_url_link where entity_id=".$data_model['nid']));
	 		     ?>


						<div class="text-center">
							<a href="<?php echo $Link['field_home_page_review_url_link_value'];?>" title="<?php echo $data_model['title'];?>">

								<span style="background-image: url('/sites/default/files/styles/check_mobile_thumb/public/<?php echo str_replace("public://","",$sql_img['uri']);?>'); overflow: hidden ;" class="slider-image"></span>
								  <span class="text">
									<span class="ellipsis"><?php echo /*$makeRow['title']." ".*/$data_model['title'];?></span>
								  </span>
<!--								-->
<!--								<img class="slider-image" src="/sites/default/files/styles/check_car_review_home/public/--><?php //echo str_replace("public://","",$sql_img['uri']);?><!--" alt="--><?php //echo $data_model['title'];?><!--" />-->
<!--								<div class="caption">--><?php //echo /*$makeRow['title']." ".*/$data_model['title'];?><!--</div>-->
							</a>
						</div>


				<?php
					}
			    }
			    else
			    {
			    ?>
				 <div>
					<span>No review found</span>
				 </div>
			    <?php
			    }
			    ?>

	</div>

		<!--button-->
		<div class="text-center">
<!--			<a href="/forum/official-new-car-reviews/?pp=25&sort=dateline&order=desc&daysprune=-1" ripple-background="radial-gradient(red, yellow)" ripple-opacity="0.7" class="btn btn-red ripple">All Reviews</a>-->
			<a href="/team-bhp-reviews/" ripple-background="radial-gradient(red, yellow)" ripple-opacity="0.7" class="btn btn-red ripple">All Reviews</a>
		</div>

	</div><!-- end of ajax -->





	</div>
</section>