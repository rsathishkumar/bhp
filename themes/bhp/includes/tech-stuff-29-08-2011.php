<?php
$q_tstuff="select title,nid from node where node.status=1 and node.type='tech_stuff' order by node.changed desc limit 0,5";
$res_tstuff=@mysqli_query($q_tstuff);
$nof_tstuff=@mysqli_num_rows($res_tstuff);
if($nof_tstuff>0)
	{
?>
<div class="primBlock">
	<h4 class="TLR5"><span>Tech Stuff</span></h4>
	<div class="BLR5 primBlockPad">
		<ul class="marB10 normalList">
			<?php
			while($d_tstuff=mysqli_fetch_array($res_tstuff))
				{
			?>
			<li><a href="<?php echo url("node/".$d_tstuff['nid']);?>"><?php echo $d_tstuff['title'];?></a></li>
			<?php
				}
			?>
			<!-- <li><a href="#">Suspension issues.</a></li>
			<li><a href="#">Nano technology in cars.</a></li>
			<li><a href="#">Torque & power graph of Indan cars.</a></li>
			<li><a href="#">Fuel gauge problems.</a></li> -->
		</ul>
		<div class="clearfix">
			<a href="?q=node/12" class="fright btnRight">
				<span>View All</span>
			</a>
		</div>
	</div><!-- primBlockPad -->
</div><!-- primBlock -->
<?php
	}
?>
