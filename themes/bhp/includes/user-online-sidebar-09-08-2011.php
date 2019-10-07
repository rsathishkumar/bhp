<?php
$interval = time() - variable_get('user_block_seconds_online', 900); // 15 mins in seconds
$users_online =@mysqli_query('SELECT COUNT(uid) FROM users WHERE access >= '.$interval.' AND uid !=0 ORDER BY access DESC'); 
?>
<div class="roundAll5 clearfix UserOnlineSidebar marB10">

		<h4 class="TLR5">Users Online</h4>
		<div class="cta userOnline clearfix padB20">
	
			<ul class="userCount clearfix">
				<li>0</li>
				<li>4</li>
				<li>3</li>
				<li>5</li>
				<li class="last">8</li>
			</ul><!-- userCount -->
			
			<ul class="siteStats clearfix">
				<li class="clearfix">
					<span>Members:</span>
					<strong>56929</strong>
				</li>
				<li class="clearfix">
					<span>Threads:</span>
					<strong>60780</strong>
				</li>
				<li class="clearfix last">
					<span>Posts:</span>
					<strong>1041293</strong>
				</li>
			</ul><!-- siteStats -->
		</div>

</div>
