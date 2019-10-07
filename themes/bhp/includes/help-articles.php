<?php
$sql_advice="select title,nid,type from node where node.status=1 and node.type='advice' order by node.changed desc limit 0,5";
$res_adv=@mysqli_query($sql_advice);
$nofadv=mysqli_num_rows($res_adv);
	if($nofadv>0)
		{
?>
<div class="primBlock marB10">
	<h4 class="TLR5"><span>Help Articles</span></h4><!-- code for this click event wriiten in home-news-->
	<div class="BLR5 primBlockPad">
		<ul class="marB10 normalList">
			<?php
				while($d_advice=mysqli_fetch_array($res_adv))
					{
						$node_advce=node_load($d_advice['nid']);
						if(strlen($node_advce->title)>51)
						{
							$finddot=@strpos($node_advce->title,".",51);
							$findspcetostop=@strpos($node_advce->title," ",51);
							if(intval($finddot)<intval($findspcetostop) && intval($finddot)>1)
							{
								$pos=$finddot;
							}
							else
							{
								$pos=$findspcetostop;
							}
							$pos=$pos+1;
						}
						if($pos>1)
						{
							$deschartcle = trim(substr($node_advce->title,0 , $pos));
						}
						else
						{
							$deschartcle = $node_advce->title;
						}
						if(strlen($node_advce->title)>51)
						{
							trim($deschartcle.="&hellip;");
						}
			?>
			<li><a href="<?php echo url("node/".$d_advice['nid']);?>" title="<?php echo $node_advce->title;?>"><?php echo $deschartcle;?></a></li>
			<?php
					}
			?>
			<!--  <li><a href="#">How to get the lowest EMI & the best finance deal.</a></li>
			<li><a href="#">How to protect your car from theft.</a></li>
			<li><a href="#">How to get the maximum Fuel Efficiency.</a></li>
			<li><a href="#">How to modify/ tune your car.</a></li>
			-->
		</ul>
		<div class="clearfix">
			<a title="View all" href="/advice" class="fright btnRight">
				<span>View All</span>
			</a>
		</div>
	</div><!-- primBlockPad -->
</div><!-- primBlock -->
<?php
		}
?>
