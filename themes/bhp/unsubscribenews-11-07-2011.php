<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include_once("connect.php");
if(isset($_GET['e']))
	{
	$email=base64_decode($_GET['e']);
//$sql_user_news=mysqli_fetch_array(mysqli_query("select mail,uid from users where mail ='".$email."'"));
$sql_user_news=@mysqli_num_rows(mysqli_query("select email from subscribefornewsletter where email ='".$email."'"));
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
	<head>
    <?php print $head ?>
    <title>Unsubscribe to the TEAM-BHP Newsletter</title>

	<link rel="stylesheet" href="<?php print $base_path; ?><?php print $directory; ?>/css/main.css" />	
    <?php print $scripts ?>
	<script type="text/javascript">
	$(function(){
		$(".click").click(function(){
			$(".bg h1:first").css("display", "none");
			$(".slideInfo, .bookTable").css("display", "block");
		  $("#dine").animate({ 
			height: "400px"
		  }, 900 );
		  $("#dine").attr("class", $(this).attr("rel"));
		  $(".click").removeClass("active");
		  $(this).addClass("active");
		});
		$(".tab ul li").click(function(){
			$(".tab ul li a").removeClass("active");
			$(this).find("a").addClass("active");
			$("div.tab_content").css("display", "none");
			$($(this).find("a").attr("href")).fadeIn(600);
			return false;
		});
		
		$("#links a").click(function(){
			$('html, body').animate({scrollTop: $($(this).attr("href")).offset().top-10}, 600);
			return false;
		});
		
		$("a.top").click(function(){
			$('html, body').animate({scrollTop: 0}, 600);
			return false;
		});
		
	});
	</script>	
	</head>
	<body class="unsubscribe">
	<div id="wrapper" class="clear-block" >
		<div id="header-region" class="clear-block">
		</div> <!-- header region -->
		
		<div id="container" class="clearfix TwoColLeft">
			<div class="center">
				<?php 
				if(isset($_GET['e']))
					{
						if($sql_user_news>0){
					?>
				<div class="Heading clearfix">
					
					<h1 class="Big">Are you sure to unsubscribe <?php echo $email;?> to the TEAM-BHP newsletter?</h1>
					<div id='uns'>
					<p class="titleHead">To unsubscribe please click on the button below and we will delete your email address from the subscription list</p>
					</div>
					<div id="subdiv" style="display:none">
					<p class="titleHead">You have successfully unsubscribed. <br/>We're sorry to see you go</p>
					</div>
					<a href="#" class="blueBtn clearfix" onclick="javascript: unsubscribed('<?php echo $_GET['e'];?>');return(false);">
					<span id="unsubbtn">Unsubscribe</span>
					</a>
				<div id='unserror' style="display:none">
				</div>
				</div>
					
					<?php
						}
						else
						{
					?>
					<h1 class="Big">Unsubscribe to the TEAM-BHP newsletter</h1>
					<p class="titleHead">Looks like you have already unsubscribed! <br/> Your email address is not available in our subscription list</p>
				<?php
						}
				}
				?>
											
			</div><!-- center -->
				<div class="sidebar-right" class="sidebarRight">
			</div><!-- sidebarRight -->
		</div><!-- container -->
		
		
						
		
		
	</div><!-- Wrapper -->
<?php print $closure ?>
</body>
</html>
