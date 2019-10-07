<script type="text/javascript">		    
jQuery(function(){
	jQuery(".listHolder").hover(
	function(){
			jQuery(this).addClass("hover");
		},
	function(){
			jQuery(this).removeClass("hover");
			}
	);
	
	jQuery(".mv_tab_content li .listBox").hover(
	function(){
			jQuery(this).addClass("hover");
		},
	function(){
			jQuery(this).removeClass("hover");
			}
	);
	
	jQuery(function()
		{	
			jQuery(".mv_tab_content li").click(function(){
				 //window.location="news-details.php";
			});
		}
	);
});
</script>
<?php
$sql_memberfotos=mysqli_query("SELECT field_data_field_team_image.field_team_image_fid,field_data_field_team_intro.field_team_intro_value,field_data_field_team_nickname.field_team_nickname_value,file_managed.uri,node.title from node,file_managed,field_data_field_team_image,field_data_field_team_intro,field_data_field_team_nickname where field_data_field_team_nickname.entity_id=field_data_field_team_image.entity_id and field_data_field_team_intro.entity_id=node.nid and file_managed.fid=field_data_field_team_image.field_team_image_fid and node.status=1 and node.type='team_member' group by field_data_field_team_image.field_team_image_fid order by node.changed desc limit 0,1");
$numbof_fotos=@mysqli_num_rows($sql_memberfotos);
	if($numbof_fotos>0)
		{
		$data_foto=@mysqli_fetch_array($sql_memberfotos);
?>
<div class="roundAll5 clearfix mostViewed marB10">
	<h4>Member Photos</h4>
	
	<div class="mv_tab_content forumPhoto BLR5 clearfix" style="display:block">	
		<a href="#" title="<?php echo $data_foto['title'];?>">
			<img src="/sites/default/files/<?php echo str_replace("public://","",$data_foto['uri']);?>" alt="<?php echo $data_foto['title'];?>" width="165" height="123" />
		</a>
		<div class="clearfix fright">
			<a href="#" class="buttonSmall marT5" title=""><span>More</span></a>
		</div>
	</div>					
</div><!-- most viewed -->
<?php
	   }
?>
