<script type="text/javascript">	
(function ($) {
	$(function(){
		$(".newslist li").click(function(){
			 window.location=$(this).find('h2 a').attr('href');
		});
	});
})(jQuery);
	</script>
	
<div class="tab_container BLR5 marB10">								
<div style="display: block;" class="tab_content">
<ul class="newslist" id="safetylist">
<?php
include_once("connect.php");
$toshow = 10;
$q = "SELECT node.title,node.nid,body_value
FROM node,field_data_body WHERE field_data_body.entity_id = node.nid 
AND node.status =1 and field_data_body.bundle='safety' order by node.changed desc";

if(isset($_REQUEST['i']))
{
$start = $_REQUEST['i'];
}
else
{
$start = 0;
}

$total_res = @mysqli_query($q) or die(mysql_error());
$total_rows=@mysqli_num_rows($total_res);
$q .= " limit ".$start.", ".$toshow;
$tstuff_res = @mysqli_query($q) or die(mysql_error());
if($total_rows>0)
{
while($d_safety=@mysqli_fetch_array($tstuff_res))
{
$sql_img=mysqli_fetch_array(mysqli_query("select file_managed.uri from field_data_field_safety_image,file_managed where file_managed.fid =field_data_field_safety_image.field_safety_image_fid and field_data_field_safety_image.entity_id=".$d_safety['nid']));
$url_res = @mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$d_safety['nid']."'"));
$url = $url_res['alias'];
?>
<li>
<div class="clearfix listHolder">
<div class="fleft w170">
<a title="<?php echo $d_safety['title'];?>" class="holderImg" href="?q=<?php echo $url;?>">
<img alt="<?php echo $d_safety['title'];?>" src="/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$sql_img['uri']);?>">
</a>
</div><!-- News thum holder -->
<div class="fright w460 ShortNews">
<h2><a title="<?php echo $d_safety['title'];?>" href="?q=<?php echo $url;?>"><?php echo $d_safety['title'];?></a></h2>

														<div class="past_shornote">
																<?php
														if(strlen($d_safety['body_value'])>205)
															{
															$finddot=@strpos($d_safety['body_value'],".",205);
															$findspcetostop=@strpos($d_safety['body_value']," ",205);
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
																$desc = trim(substr($d_safety['body_value'],0 , $pos));
															}
															else
															{
																$desc = $d_safety['body_value'];
															}
															/*if(strlen($d_safety['body_value'])>205)
															{
															trim($desc.="<a href='?q=".$url."'>"."&hellip;"."</a>");
															}*/
															echo $desc;
														?>
															</div>
</div><!-- w460 -->
</div><!-- List holder  -->
</li><!-- news list -->
<?php 
}
}
else
{
?>
<li>
<?php
echo "No thread found" ;
?>
</li><!-- news list -->
<?php
}
?>
</div>
</div><!-- tab content -->

<?php
if($total_rows>$toshow)
{
?>
<div class="clearfix marT10">
	<div class="clearfix w100p">
	<?php
	if($start<$toshow)
	{
	?>
		<a class="btnLeft fleft btnLeftDisabled" href="#" onclick="return false;">
	<?php
	}
	else
	{
		$q = 'i='.($start-$toshow);
		
		
		
	?>
		<a class="btnLeft fleft" href="<?php echo $q; ?>" onclick="nav_safety(this); return false;">
	<?php
	}
	?>
			<span>Newer</span>
		</a>
		
		<ul class="pagination">
			<!--<li class="first disable"><a title="go to previews 10 results" href="#">É</a></li>-->
			<?php
				$j=1;
				if($total_rows<=20)
					{
						$t = $total_rows;
					}
				else
					{
						$t = 20;
					}
			for($i=0; $i<$total_rows; $i=$i+$toshow)
				{
				if($i==$start)
					{
						$c = "class=\"active\"";
					}
				else if(($start==0) && ($j==1))
					{
						$c = "class=\"active\"";
					}
				else
					{
						$c = "";
					}
					$q = 'i='.$i;
				
			?>
				<li><a title="go to page <?php echo $j; ?>"<?php echo $c; ?> href="<?php echo $q; ?>" onclick="<?php if($c=="") { ?>nav_safety(this); <?php } ?>return false;"><?php echo $j; ?></a></li>
			<?php
			$j++;
				}
$next = $start+$toshow;
			?>
			<!--<li class="first"><a title="go to next 10 results" href="#">É</a></li>-->
		</ul>
		<?php
		if($start<($t-$toshow))
		{
		$q = 'i='.($start+$toshow);
				
		?>
		<a class="btnRight fright" href="<?php echo $q; ?>" onclick="nav_safety(this); return false;">
		<?php
		}
		else
		{
		?>
		<a class="btnRight fright btnRightDisabled" href="#" onclick="return false;">
		<?php
		}
		?>
			<span>Older</span>
		</a>
	</div>
</div>
<?php
}
?>