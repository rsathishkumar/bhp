<?php
$q_tstuff="select title,nid from node where node.status=1 and node.type='tech_stuff' order by node.created desc limit 0,5";
$res_tstuff=@mysqli_query($q_tstuff);
$nof_tstuff=@mysqli_num_rows($res_tstuff);
if($nof_tstuff>0)
	{
?>
<div class="primBlock">
	<h4 class="tech_stuffspcl TLR5"><span>Tech Stuff</span></h4><!-- code for this click event wriiten in home-news-->
	<div class="BLR5 primBlockPad">
		<ul class="marB10 normalList">
			<?php
			while($d_tstuff=mysqli_fetch_array($res_tstuff))
				{
				 	 $node_tech_stuff=node_load($d_tstuff['nid']);
				 	 if(strlen($node_tech_stuff->title)>51)
					{
						$finddot=@strpos($node_tech_stuff->title,".",51);
						$findspcetostop=@strpos($node_tech_stuff->title," ",51);
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
						$desctechstuff = trim(substr($node_tech_stuff->title,0 , $pos));
					}
					else
					{
						$desctechstuff = $node_tech_stuff->title;
					}
					if(strlen($node_tech_stuff->title)>51)
					{
					trim($desctechstuff.="&hellip;");
					}
						// $node_tech_stuff = node_view(node_load($d_tstuff['nid']),'teaser');
						 //print_r($node_tech_stuff['body']);
					
			?>
			<li><a href="<?php echo url("node/".$d_tstuff['nid']);?>" title="<?php echo $node_tech_stuff->title;?>"><?php echo $desctechstuff;?></a></li>
			<?php
				}
			?>
			<!-- <li><a href="#">Suspension issues.</a></li>
			<li><a href="#">Nano technology in cars.</a></li>
			<li><a href="#">Torque & power graph of Indan cars.</a></li>
			<li><a href="#">Fuel gauge problems.</a></li> -->
		</ul>
		<div class="clearfix">
			<a title="View all" href="/tech-stuff" class="fright btnRight">
				<span>View All</span>
			</a>
		</div>
	</div><!-- primBlockPad -->
</div><!-- primBlock -->
<?php
	}
?>
