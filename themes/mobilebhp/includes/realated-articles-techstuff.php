<?php
$sql_relatedartcle=@mysqli_query("select node.title,node.nid,field_data_field_tech_related_articles.field_tech_related_articles_nid from node,field_data_field_tech_related_articles where field_data_field_tech_related_articles.field_tech_related_articles_nid=node.nid and field_data_field_tech_related_articles.entity_id=".$node->nid." and node.status=1");
$nofra=@mysqli_num_rows($sql_relatedartcle);
	if($nofra>0)
		{
?>
<div class="container-fluid" style="padding-top: 30px;">
	<h4 class="section-title text-center"><span>Related Articles</span></h4>
	<div class="threadsList with-thumb">
		<ul>
		<?php
		while($d_ra=mysqli_fetch_array($sql_relatedartcle))
			{				
				$tech_stuff_node=node_load($d_ra['nid']);
				
		?>
				<li>
					<a href="<?php echo url("node/".$d_ra['nid']);?>" title="<?php echo $d_ra['title'];?>" ripple-background="radial-gradient(red, yellow,green)" ripple-opacity="0.7" class="ripple">
						

                    	<span style="background-image: url('/?q=sites/default/files/styles/check_mobile_thumb/public/<?php echo str_replace('public://','',$tech_stuff_node->field_tech_stuff_image['und'][0]['uri']);?>'); overflow: hidden;" class="thumb">
                    	</span>

					

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
</div><!-- realated News -->
<?php
	}
?>
