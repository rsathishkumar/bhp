<?php
 $qrelatednews="SELECT node.title,node.nid from node,field_data_field_news_tags where field_data_field_news_tags.entity_id=node.nid and node.status=1 and field_data_field_news_tags.field_news_tags_tid in (".@substr($tid,0,-1).") and node.nid!=".$node->nid." group by node.nid order by node.changed desc limit 0,5";
$res=@mysqli_query($qrelatednews);
$nofrelatednews=@mysqli_num_rows($res);
	if($nofrelatednews>0)
	{
?>
<div class="clearfix relatedNews roundAll5">
	<h3>Related News</h3>
	<ul class="marT10">
		<?php
		while($d_r_news=mysqli_fetch_array($res))
			{
		?>
		<li>
			<a href="<?php echo url("node/".$d_r_news['nid']);?>" title="<?php echo $d_r_news['title'];?>">
				<?php echo $d_r_news['title'];?> 
			</a>
		</li>
		<?php
			}
		?>
		<!--  <li>
			<a href="#" title="">
				Bangalore International Auto Expo 2010:  March 11-15
			</a>
		</li>
		<li>
			<a href="#" title="">
				Mercedes Benz launches the E250 V6 petrol and E250 CDI Blue Efficiency V6 petrol and E250 CDI Blue Efficiency 
			</a>
		</li>
		<li>
			<a href="#" title="">
				Honda Launches Special Edition Jazz 
			</a>
		</li>
		<li>
			<a href="#" title="">
				Mahindra launched Thar at 6.5 lakhs
			</a>
		</li>-->
	</ul>
</div><!-- realated News -->
<?php
	}
?>
