<?php
$sql_relatedartcle = @mysqli_query("select node.title,node.nid,field_data_field_safety_related_articles.field_safety_related_articles_nid from node,field_data_field_safety_related_articles where field_data_field_safety_related_articles.field_safety_related_articles_nid=node.nid and field_data_field_safety_related_articles.entity_id=" . $node->nid . " and node.status=1");
$nofra = @mysqli_num_rows($sql_relatedartcle);

if ($nofra > 0) {
	?>
	<div class="container-fluid" style="padding-top: 30px;">
		<h4 class="section-title text-center"><span>Related Articles</span></h4>
		<div class="threadsList with-thumb">
			<ul>
				<?php
				while ($d_ra = mysqli_fetch_array($sql_relatedartcle)) {
					$safety_node=node_load($d_ra['nid']);
	
					?>
					<li>
						<a href="<?php echo url("node/" . $d_ra['nid']);?>" ripple-background="radial-gradient(red, yellow,green)"
						   ripple-opacity="0.7" title="<?php echo $d_ra['title'];?>" class="ripple">
						   <span style="background-image: url('/?q=sites/default/files/styles/check_mobile_thumb/public/<?php echo str_replace('public://','',$safety_node->field_safety_image['und'][0]['uri']);?>'); overflow: hidden;" class="thumb">
                    <!-- img(src="images/thumb-1.jpg" alt="" title="")--></span>
                        <span class="text">
                            <span class="ellipsis-3-line"><?php echo $d_ra['title'];?></span>
                        </span>
						</a>
					</li>

				<?php
				}
				?>

			</ul>
		</div>
		<!--button-->
		<div class="text-center">
			<a href="/safety" ripple-background="radial-gradient(red, yellow)" ripple-opacity="0.7" class="btn btn-red ripple">All Articles</a>
		</div>
	</div><!-- realated News -->
<?php
}
?>
