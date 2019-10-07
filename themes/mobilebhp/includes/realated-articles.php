<?php
$sql_relatedartcle=@mysqli_query("select node.title,node.nid,field_data_field_advice_related.field_advice_related_nid from node,field_data_field_advice_related where field_data_field_advice_related.field_advice_related_nid=node.nid and field_data_field_advice_related.entity_id=".$node->nid." and node.status=1");
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
//				$tech_stuff_node=node_load($d_ra['nid']);

			$nid = $d_ra['nid'];
			$node=node_load($nid);
//			echo "<pre>"; print_r($node);echo "</pre>";
			$img_news['uri']=$node->field_advice_images['und'][0]['uri'];
		?>


				<li>
					<a href="<?php echo url("node/".$d_ra['nid']);?>" title="<?php echo $d_ra['title'];?>" ripple-background="radial-gradient(red, yellow,green)" ripple-opacity="0.7" class="ripple">

                    	<span style="background-image: url('<?php print $base_url; ?>/sites/default/files/styles/check_mobile_thumb/public/<?php echo str_replace('public://','',$img_news['uri']);?>'); overflow: hidden;" class="thumb">
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
</div><!-- realated News -->
<?php
	}
?>
