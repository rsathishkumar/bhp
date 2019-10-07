<?php
//$sql_safety=@mysqli_query("select title,nid,type from node where status=1 and type='safety' order by changed desc limit 0,5");
$sql_safety=@mysqli_query("SELECT node.title,node.nid FROM node,field_data_body WHERE field_data_body.entity_id = node.nid AND node.status =1 and field_data_body.bundle='safety' order by node.created desc  limit 0,5");
$nofsafety=@mysqli_num_rows($sql_safety);
if($nofsafety>0)
	{
?>
<div class="roundAll5 safetyBlock">
	<ul>
			<?php
			while($d_safety=mysqli_fetch_array($sql_safety))
			{
				$nod_safety=node_load($d_safety['nid']);
				if(strlen($nod_safety->title)>26)
				{
					$finddot=@strpos($nod_safety->title,".",20);
					$findspcetostop=@strpos($nod_safety->title," ",20);
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
					$desc = trim(substr($nod_safety->title,0 , $pos));
				}
				else
				{
					$desc = $nod_safety->title;
				}
				if(strlen($nod_safety->title)>26)
				{
					if(strlen($desc)>24)
					{
						$desc = trim(substr($desc, 0, 24));
					}
					trim($desc.="&hellip;");
				}
	   ?>
		<li><a href="<?php echo url("node/".$d_safety['nid']);?>" title="<?php echo $nod_safety->title;?>"><?php echo $desc;?></a></li>
		 <?php
		  }
		 ?>
		<!--  <li><a href="#">Child safety in  cars</a></li>
		<li><a href="#">Consectetur adip elit...</a></li>
		<li><a href="#">Adipiscing elit. </a></li>
		<li><a href="#">Consectetur adipiscing </a></li>-->
	</ul>
	<div class="padR10 clearfix">
		<a title="More" class="fright buttonSmall" href="/safety"><span>More </span></a>
	</div>
</div><!-- safetyBlock -->
<?php
	}
?>
