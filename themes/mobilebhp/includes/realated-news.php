<?php
global $base_url;
 $qrelatednews="SELECT node.title,node.nid from node,field_data_field_news_tags where field_data_field_news_tags.entity_id=node.nid and node.status=1 and field_data_field_news_tags.field_news_tags_tid in (".@substr($tid,0,-1).") and node.nid!=".$node->nid." group by node.nid order by node.changed  limit 0,5";
$res=@mysqli_query($qrelatednews);
$nofrelatednews=@mysqli_num_rows($res);
	if($nofrelatednews>0)
	{
?>
<section class="container-fluid related-container">
	<h4 class="section-title text-center">
		<span>
			Related News
		</span>
	</h4>
	<div class="threadsList with-thumb">
		<ul>
			<?php
			while($d_r_news=mysqli_fetch_array($res))
			{
				$nid = $d_r_news['nid'];
				$node=node_load($nid);
				//echo "<pre>"; print_r($node);echo "</pre>";
				$img_news['uri']=$node->field_news_images['und'][0]['uri'];
				?>
				<li>
					<a href="<?php echo url("node/".$d_r_news['nid']);?>" title="<?php echo $d_r_news['title'];?>">
						<span class="thumb" style="background-image: url('<?php print $base_url; ?>/sites/default/files/styles/check_mobile_thumb/public/<?php echo str_replace('public://','',$img_news['uri']);?>'); overflow: hidden;">

		<!--				<img src="--><?php //print $base_url; ?><!--/sites/default/files/styles/check_medium_medium/public/--><?php //echo str_replace('public://','',$img_news['uri']);?><!--">	-->

						</span>
						<span class="text">
							<span class="ellipsis-3-line"><?php echo $d_r_news['title'];?></span>
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
		<a href="/news/" ripple-background="radial-gradient(red, yellow)" ripple-opacity="0.7" class="btn btn-red ripple">All News</a>
	</div>
	<!-- realated News -->
</section>

<?php
	}
?>
