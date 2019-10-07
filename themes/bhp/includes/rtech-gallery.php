<style type="text/css">
#overviewGallery .imgBlock { z-index:1; }
#overviewGallery .show { z-index:100; }
</style>
<?php
include_once("connect.php");
$limit = 8;
$slice = 7;
$start = 1;
if(!isset($_REQUEST['page']) || !is_numeric($_REQUEST['page']))
{
	$page = 1;
} 
else 
{
	$page = $_REQUEST['page'];
}
// commented as on 27-02-2012 $sql_rgallery=@mysqli_query("SELECT field_data_field_rtech_image.field_rtech_image_title as title,field_data_field_rtech_image.field_rtech_image_fid,file_managed.uri from node,field_data_field_rtech_image,file_managed where file_managed.fid=field_data_field_rtech_image.field_rtech_image_fid and field_data_field_rtech_image.entity_id=node.nid and node.type='rtech_memorial' and node.status=1 order by node.changed desc");
$sql_rgallery=@mysqli_query("select title,uri from node,file_managed,field_data_field_rtech_image where node.nid=field_data_field_rtech_image.entity_id and field_data_field_rtech_image.field_rtech_image_fid=file_managed.fid and node.status=1 and node.type='rtech_image' order by created desc");

$numbof_rgallery=@mysqli_num_rows($sql_rgallery);
		if($numbof_rgallery>0)
		{
?>
<div class="marB20" id="gallery">
			<?php
			$i=0;
			while($data_gallery=mysqli_fetch_array($sql_rgallery))
			{
			?>
		<div class="imgBlock<?php if($i==0) {?> show<?php }?>">
			<img width="648" height="375" rel="<?php if($page){ echo $data_gallery['title']; } ?>" title="<?php echo $data_gallery['title'];?>" alt="<?php echo $data_gallery['title'];?>" src="/sites/default/files/<?php echo str_replace("public://","",$data_gallery['uri']);?>">
		</div>
			<?php
				if($i==0)
				{
				$caption = $data_gallery['title'];
				}
			$i++;
			}
			?>
		<!--  <div>
			<img width="648" height="375" rel="Ut enim ad minim veniam, quis nostrud " title="Ut enim ad minim veniam, quis nostrud " alt="Grass Blades" src="themes/bhp/images/temp/grass-blades.jpg">
		</div>
		
		<div>
			<img width="648" height="375" rel="Duis aute irure dolor in reprehenderit in voluptate " title="Duis aute irure dolor in reprehenderit in voluptate" alt="Ladybug" src="themes/bhp/images/temp/ladybug.jpg">
		</div>
		
		<div>
			<img width="648" height="375" rel="Excepteur sint occaecat cupidatat non proident, " title="Excepteur sint occaecat cupidatat non proident, " alt="Lightning" src="themes/bhp/images/temp/lightning.jpg">
		</div>
		
		<div>
			<img width="648" height="375" rel="Sed ut perspiciatis unde omnis iste natus error sit voluptatem " title="Sed ut perspiciatis unde omnis iste natus error sit voluptatem" alt="Lotus" src="themes/bhp/images/temp/lotus.jpg">
		</div>
		
		<div class="caption">
			<div class="content" style="opacity: 0.7;">Moderators camp- Mumbai,  2009</div>
		</div>-->
		<div class="caption">
			<div class="content" style="opacity: 0.7;"><?php echo $caption; ?></div>
		</div>
	</div>
	
<script type="text/javascript">		    
(function ($) {
			slideShow();

			function slideShow() {
				//Set the opacity of all images to 0
				$('#gallery div').css({opacity: 0.0});
				
				//Get the first image and display it (set it to full opacity)
				$('#gallery div:first').css({opacity: 1.0});
				
				//Set the caption background to semi-transparent
				$('#gallery .caption').css({opacity: 0.7});
			
				//Resize the width of the caption according to the image width
				$('#gallery .caption').css({width: $('#gallery div').find('img').css('width')});
				
				//Get the caption of the first image from REL attribute and display it
				$('#gallery .content').html($('#gallery div:first').find('img').attr('rel')).animate({opacity: 0.7}, 200);
				
				//Call the gallery function to run the slideshow, 6000 = change to next image after 6 seconds
				//setInterval('gallery()',6000);
				setInterval(function(){
				//if no IMGs have the show class, grab the first image
				//var current = ($('#gallery div.show')?  $('#gallery div.show') : $('#gallery div:first'));

				//Get next image, if it reached the end of the slideshow, rotate it back to the first image
				//var next = ((current.next().length) ? ((current.next().hasClass('caption'))? $('#gallery div:first') :current.next()) : $('#gallery div:first'));	
				
				//Get next image caption
				//var caption = next.find('img').attr('rel');	
				var current = (($('#gallery div.show')?  $('#gallery div.show') : $('#gallery div:first')));
				var next = ((current.next().length) ? ((current.next().hasClass('caption'))? $('#gallery div:first') :current.next()) : $('#gallery div:first'));
				var caption = next.find('img').attr('rel');	
				
				//Set the fade in effect for the next image, show class has higher z-index
				next.css({opacity: 0.0})
				.addClass('show')
				.animate({opacity: 1.0}, 1000);

				//Hide the current image
				current.animate({opacity: 0.0}, 1000)
				.removeClass('show');
				
				//Set the opacity to 0 and height to 1px
				$('#gallery .caption').animate({opacity: 0.0}, { queue:false, duration:0 }).animate({height: '1px'}, { queue:true, duration:300 });	
				
				//Animate the caption, opacity to 0.7 and heigth to 100px, a slide up effect
				$('#gallery .caption').animate({opacity: 0.7},100 ).animate({height: '30px'},500 );
				
				//Display the content
				$('#gallery .content').html(caption);
				},6000);
				
			}

})(jQuery);
		</script>
	<?php
	}
	?>
