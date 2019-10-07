<?php
include_once("connect.php");
$q="SELECT field_data_field_team_image.field_team_image_fid,node.nid,field_data_field_team_nickname.field_team_nickname_value,
field_data_field_team_intro_text.field_team_intro_text_value, file_managed.uri, node.title,node.nid FROM node, field_data_field_team_nickname, file_managed, field_data_field_team_image,
field_data_field_team_intro_text WHERE field_data_field_team_nickname.entity_id = field_data_field_team_image.entity_id AND field_data_field_team_intro_text.entity_id = node.nid AND
field_data_field_team_image.entity_id=node.nid AND file_managed.fid = field_data_field_team_image.field_team_image_fid AND node.status =1 AND node.type = 'team_member'
GROUP BY field_data_field_team_image.field_team_image_fid ORDER BY field_team_nickname_value";
$sql_memberfotos=@mysqli_query($q);
$numbof_fotos=@mysqli_num_rows($sql_memberfotos);
		if($numbof_fotos>0)
		{
?>
		
<script type="text/javascript" src="themes/bhp/js/jquery.lightbox.js"></script>
<script type="text/javascript">
(function ($) {
	    
			$(function(){
				$(".lightbox").lightbox();
				
				$(".TeamMember").click(function(){
					if ($(this).find(".teamInfo").css("display")=="none") {
						$(".TeamMember").css("cursor","pointer");
						$(".TeamMember").removeClass("TeamMemberActive");
						$(".teamInfo").fadeOut(600);
						$(this).addClass("TeamMemberActive");
						$(this).css("cursor","default");
						$(".TeamMemberActive .teamInfo").fadeIn(600);
						$('html, body').animate({scrollTop: $(".TeamMemberActive em").offset().top-10}, 300);
						return false;
					}
				});
				
				$(".TeamMember .close").click(function(){
					$(".TeamMember").removeClass("TeamMemberActive");
					$(".teamInfo").fadeOut(600);
					return false;
				});
			
			
				$(".TeamMember").hover(
					function(){
						$(this).addClass("TeamMemberHover");
					},
					function(){
						$(this).removeClass("TeamMemberHover");
					}
				);
				
			});
})(jQuery);
		
</script>

<div class="clearfix teamContainer">
	<ul class="clearfix TeamUL fleft"><!-- team group -->
	<?php
	$i=1;
	while($data_menber=mysqli_fetch_array($sql_memberfotos))
		{
			if($i%2!=0)
			{
				$sql_mod_avtar=@mysqli_fetch_array(mysqli_query("SELECT file_managed.uri
FROM field_data_field_moderator_avatar, file_managed
WHERE file_managed.fid = field_data_field_moderator_avatar.field_moderator_avatar_fid
AND field_data_field_moderator_avatar.entity_id =".$data_menber['nid']));
	?>
		<li class="TeamMember">
			<a href="" class="close" title>&nbsp;</a>
			<div class="clearfix">
				<div class="fleft memberImg">
					<img src="/sites/default/files/<?php if($sql_mod_avtar!='') {echo str_replace("public://","",$sql_mod_avtar['uri']); } else { echo str_replace("public://","",$data_menber['uri']); }?>" alt="<?php echo
$data_menber['title'];?>" />
				</div><!-- team pic -->
				
				<div class="fright w200">
					<em><?php echo $data_menber['field_team_nickname_value'];?></em>
					<h4><?php echo $data_menber['title'];?></h4>
				</div>
			</div><!-- clearfix -->
			
			<div class="teamInfo">
				<!-- <a href="/sites/default/files/<?php echo str_replace("public://","",$data_menber['uri']);?>" class="lightbox teamInfoImg"> -->
					<img src="/sites/default/files/<?php echo str_replace("public://","",$data_menber['uri']);?>" alt="<?php echo
$data_menber['title'];?>"  class="marB10"/>
				<!-- </a> -->
				<?php echo $data_menber['field_team_intro_text_value'];?>
			</div><!-- team Info -->
		</li><!-- team member -->
		<?php
		
			}
			$i++;
		}
		$sql_memberfotosone=@mysqli_query($q);
		?>
		<!-- team member -->	
	</ul><!-- team Group -->
	<ul class="clearfix TeamUL fright"><!-- team group -->
		<?php
		$i=1;
		while($data_menberone=mysqli_fetch_array($sql_memberfotosone))
		{
			if($i%2==0)
			{
				$sql_mod_avtarnew=@mysqli_fetch_array(mysqli_query("SELECT file_managed.uri
FROM field_data_field_moderator_avatar, file_managed
WHERE file_managed.fid = field_data_field_moderator_avatar.field_moderator_avatar_fid
AND field_data_field_moderator_avatar.entity_id =".$data_menberone['nid']));
			$node_data=node_load($data_menberone['nid']);
		?>
		<li class="TeamMember">
			<a href="#" class="close" title>&nbsp;</a>
			<div class="clearfix">
				<div class="fleft memberImg">
					<img src="/sites/default/files/<?php  if($sql_mod_avtarnew!='') { echo str_replace("public://","",$sql_mod_avtarnew['uri']); } else { echo str_replace("public://","",$data_menberone['uri']);} ?>" alt="<?php echo
$data_menberone['title'];?>"
 />
				</div><!-- team pic -->
				
				<div class="fright w200">
					<em><?php echo $data_menberone['field_team_nickname_value'];?></em>
					<h4><?php echo $data_menberone['title'];?></h4>
				</div>
			</div><!-- clearfix -->
			
			<div class="teamInfo">
					<!-- <a href="/sites/default/files/<?php echo str_replace("public://","",$data_menberone['uri']);?>"  alt="<?php echo
$data_menberone['title'];?>" class="lightbox teamInfoImg"> -->
					<img src="/sites/default/files/<?php echo str_replace("public://","",$data_menberone['uri']);?>" alt="<?php echo
$data_menberone['title'];?>" class="marB10"/>
					<!-- </a> -->
					<?php echo $node_data->field_team_intro_text['und'][0]['value']//$data_menberone['field_team_intro_text_value'];?>
			</div><!-- team Info -->
		</li><!-- team member -->		
		<?php
			}
			$i++;	
		}
		?>
		 	
	</ul><!-- team Group -->
</div><!-- team container -->
<?php
	}
?>
