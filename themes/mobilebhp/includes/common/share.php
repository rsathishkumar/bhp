<script type="text/javascript">
	(function ($) {
	$(function(){
		$("#toShareForm").bind("focus click", function(){
		 	if($(this).val()=="Receipient's email")
		 		{
		 			$(this).val('');
		 		}
		 });
		 
		 $("#toShareForm").bind("blur", function(){
		 	if(($(this).val()=="Receipient's email") || ($(this).val()==''))
		 		{
		 			$(this).val("Receipient's email");
		 		}
		 });
		 
		 $("#fromShareForm").bind("focus click", function(){
		 	if($(this).val()=="Your email")
		 		{
		 			$(this).val('');
		 		}
		 });
		 
		 $("#fromShareForm").bind("blur", function(){
		 	if(($(this).val()=="Your email") || ($(this).val()==''))
		 		{
		 			$(this).val("Your email");
		 		}
		 });
	});
	})(jQuery);



    $(document).ready(function() {
        $(document).on("click", '.mct_whatsapp_btn', function() {
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                var text = $(this).attr("data-text");
                var url = $(this).attr("data-link");
                var message = encodeURIComponent(text) + " - " + encodeURIComponent(url);
                var whatsapp_url = "whatsapp://send?text=" + message;
                window.location.href = whatsapp_url;
            } else {
                alert("Please use an Mobile Device having whatsapp installed, to Share this Article");
            }
        });


    });


</script>
<?php
$fburl='';
$flaglink='';
//print_r($node);
if(strpos($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'glossary')>1)
{
	$flaglink='glossary';
	$fburl='http://'.$_SERVER['HTTP_HOST']."/glossary";
}
else if(strpos($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'abbreviations')>1)
{
	$flaglink='abbreviations';
	$fburl='http://'.$_SERVER['HTTP_HOST']."/abbreviations";
}
else if(($_GET['q']!='') && ($sql_modeldata['type']=='model') && ($_GET['models']==''))
{
	$flaglink='forum-review';
	$fburl='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}
else if(strpos($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'glossary')==0 && strpos($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'abbreviations')==0 && $sql_modeldata['type']!='model' && $_GET['models']=='')
{
	$fburl='http://'.$_SERVER['HTTP_HOST'].url("node/".$node->nid);
}
else if($_GET['models']!='')
{
	$flaglink='compare';
	$fburl='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}
$twurl = file_get_contents("http://api.bit.ly/v3/shorten?login=paperplane&apiKey=R_00a59a6b87bfbe0712c58d244812f7f5&longUrl=".$fburl."&format=txt");
?>


<div class="share-news">
	<div class="shareCTA text-center">

        <a class="circle facebook-share-button" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $fburl; ?>" target="_blank">
            <i class="icon-facebook"></i>
        </a>

        <a href="javascript:void(0);" data-text="<?php echo $title." at TEAM-BHP"; ?>" data-link="<?php echo $fburl; ?>" class="circle mct_whatsapp_btn">
            <i class="icon-whatsapp"></i>
        </a>

        <a href="mailto:?subject=<?php echo $title." at TEAM-BHP"; ?>&body=<?php echo $fburl; ?>" class="circle">
            <i class="icon-mail"></i>
        </a>

		<a href="http://twitter.com/share?text=Check out <?php echo $title." at TEAM-BHP"; ?>&url=<?php echo $twurl; ?>" class="circle" target="_blank">
			<i class="icon-twitter"></i>
		</a>


	</div>
</div>




		<?php
			if($flaglink=='')
			{
		?>
			<input type="hidden" name="current_url" id="current_url" value="<?php echo "http://".$_SERVER['HTTP_HOST'].url("node/".$node->nid);?>">
		<?php
			}
			else
			{
				if($flaglink=='glossary')
				{
			?>
			<input type="hidden" name="current_url" id="current_url" value="<?php echo "http://".$_SERVER['HTTP_HOST']."/glossary";?>">
			<?php
				}
				else if($flaglink=='abbreviations')
				{
			?>
			<input type="hidden" name="current_url" id="current_url" value="<?php echo "http://".$_SERVER['HTTP_HOST']."/abbreviations";?>">
			<?php
				}
				else if($flaglink=='forum-review')
				{
			?>
		<input type="hidden" name="current_url" id="current_url" value="<?php echo "http://".$_SERVER['HTTP_HOST']."/forum-review";?>">
		<?php
				}
				else if($flaglink=='compare')
				{
		?>
		<input type="hidden" name="current_url" id="current_url" value="<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>">
		<?php
				}
			}
		?>
