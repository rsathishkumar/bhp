<?php
include_once("connect.php");
$sql_news=mysqli_query("select node.title,node.nid from node where type='news' and node.status = 1 order by node.created desc limit 0,3");
$numberofnews=mysqli_num_rows($sql_news);
	if($numberofnews>0)
		{
		$cn=1;
?>
<div class="clearfix hotTrends roundAll5 latestNews">
	<h3 class="padL10">Latest News</h3>
	<ul>
	<?php
		while($d_news=@mysqli_fetch_array($sql_news))
			{
			$cn++;
				$sql_url_alias=@mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$d_news['nid']."'"));
				
	?>
		<li<?php if($cn>$numberofnews){?> class="last"<?php }?>><a href="/<?php echo $sql_url_alias['alias'];?>" title="<?php echo $d_news['title'];?>"><?php echo $d_news['title'];?></a></li>
	
		<?php
			
			
			}
		?>
	</ul>
	<div class="clearfix fright marT10">
		<a href="/news" class="buttonSmall" title=""><span>View All</span></a>
	</div>
</div><!-- clearfix -->
	<?php
		}
	?>
