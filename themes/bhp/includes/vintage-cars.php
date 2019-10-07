<?php
$sql_vcars="select title,nid,file_managed.uri,field_ext_link_url from node,file_managed,field_data_field_super_car_image,field_data_field_ext_link where field_data_field_super_car_image.entity_id=node.nid and field_data_field_ext_link.entity_id=field_data_field_super_car_image.entity_id and field_data_field_super_car_image.field_super_car_image_fid=file_managed.fid and node.status=1 and node.type='super_car' order by node.changed desc limit 0,3";
$res_vcars=@mysqli_query($sql_vcars);
$novcars=mysqli_num_rows($res_vcars);
	if($novcars>0)
		{
?><div class="roundAll5 vintageCars">
	<div id="vintageCars" class="picBox">
		<?php
		$cntvcar=1;
		while($d_vcars=mysqli_fetch_array($res_vcars))
			{
			$str='';
			$str=strstr($d_vcars['field_ext_link_url'],"http://");
			$lnk='';
			if($str=='')
				{
				$lnk.="http://".$d_vcars['field_ext_link_url'];
				}
				else
				{
				$lnk.=$d_vcars['field_ext_link_url'];
				}
		?>
		<a href="<?php echo bhp_replace_http_strings($d_vcars['field_ext_link_url']);?>" target="_blank">
		<img title="<?php echo $d_vcars['title'];?>" id="vintage-<?php echo $cntvcar;?>"<?php if($cntvcar!=1){?> style="display:none"<?php }?> src="sites/default/files/<?php echo str_replace("public://","",$d_vcars['uri']);?>"  alt="<?php echo $d_vcars['title'];?>"/> 
		</a>
		<?php
		$cntvcar++;
			}
			$res_vcars=@mysqli_query($sql_vcars);
		?>
		<!--  <img id="vintage-2" style="display:none" src="themes/bhp/images/temp/4x4Car.jpg" width="280" height="228" alt="4 x 4 Cars"/>
		<img id="vintage-3" style="display:none" src="themes/bhp/images/temp/vintageCars.jpg" width="280" height="228" alt="Vintage Cars"/>-->
	</div>
	<div class="vintageBtn clearfix">
		<ul class="fright clearfix">
			<?php
			$cntvcarnew=1;
			while($d_vcars=mysqli_fetch_array($res_vcars))
			{
			?>
			<li rel="#vintage-<?php echo $cntvcarnew;?>"<?php if($cntvcarnew==1){?> class="active"<?php }?>>&nbsp;</li>
			<?php
			$cntvcarnew++;
			}
			?>
			<!--  <li rel="#vintage-2">&nbsp;</li>
			<li rel="#vintage-3">&nbsp;</li>-->
		</ul>
	</div>
</div>
<?php
	}
?>
