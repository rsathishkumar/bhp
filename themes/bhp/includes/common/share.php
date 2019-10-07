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
<ul class="shareCTA clearfix">
	<li class="print"><a href="javascript:window.print();" class="print" title="Print">&nbsp;</a></li>
	<li class="Email"><a href="#" title="Share via Email" class="email" onclick="javascript:document.getElementById('successMsg').style.display='none';document.getElementById('shareForm').style.display='block'">&nbsp;</a>
		<div class="shareForm" style="display:none" >
		<div class="shareFormPad">
			<a href="#" class="close closeShareForm">&nbsp;</a>
			<form id="shareForm" name="shareForm" action="#" onsubmit="validate_shareForm(); return false;">
				<div class="marT5">To</div>
				<div><input type="text" id="toShareForm" name="toShareForm" value="Receipient's email" class="medium itl" /></div>
				<div class="shareNote">Seperate multiple addresses with “ ; ”</div> 
				
				<div class="marT20">From</div>
				<div class="marB10"><input type="text" id="fromShareForm" name="fromShareForm" value="Your email" class="medium itl" /></div>
				
				<div class="clearfix">
					<button id="submitShareForm" name="submitShareForm" type="submit" class="saveBtn" value=""></button>
				</div>
	
			</form>
			<div id="successMsg" style="display:none;padding-top:10px;">Your email(s) has been successfully sent.</div>
		</div>	
		</div>
		</li>	
			<!--  <li><fb:like href="<?php //echo urlencode('http://'.$_SERVER['HTTP_HOST'].url("node/".$node->nid));?>" layout="button_count" show_faces="false" width="100" font="lucida grande"></fb:like></li>	-->
		<li class="twitter">
		<a href="http://twitter.com/share?text=Check out <?php echo $title." at TEAM-BHP"; ?>&url=<?php echo $twurl; ?>" class="twitter" title="share on Twitter" target="_blank">&nbsp;</a>
		</li>	
		<li class="last">
			<div class="fb-like" data-href="<?php echo $fburl; ?>" data-send="false" data-layout="button_count" data-width="60" data-show-faces="false" data-font="tahoma"></div>
		</li>	
	</ul>
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
