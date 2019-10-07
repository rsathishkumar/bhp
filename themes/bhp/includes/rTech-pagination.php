<?php
if ($numbof_testi > $limit) //pagination
	{
?>
	<div class="marT10 clearfix">
		<div class="clearfix w100p">
		<?php
		if($page!= 1)
				{
				$pageprev = $page - 1;
				$q1 = '?page='.($pageprev);
		?>
			<a class="paging btnLeft fleft" href="<?php echo $q1; ?>">
				<span>Newer</span>
			</a>
			<?php
				}
			else
				{
				echo '<a class="btnLeft fleft btnLeftDisabled" href="#" onclick="return false;">
				<span>Newer</span></a>';
				}
			?>
		<ul class="pagination">
			<?php
				if (($page + $slice) < $numofpages) 
				{
				$this_far = $page + $slice;
				}
				else 
				{
				$this_far = $numofpages;
				}
				
				if (($start + $page) >= $limit && ($page - $limit) > 0) {
				$start = $page - $limit;
				}
				
				for ($k = $start; $k <= $this_far; $k++)
				{
					if($k==$start && $_REQUEST['page']=='')
							{
								$c = " class=\"active\"";
							}
						else if(($_REQUEST['page']==$k))
							{
								$c = " class=\"active\"";
							}
						else
							{
								$c = "";
							}
				$q1 = '?page='.$k;
				?>
				<li><a<?php if($c=='') {?> title="go to page <?php echo $k; ?>"  href="<?php echo $q1;?>" <?php } echo $c; ?>><?php echo $k; ?></a></li>
				<?php
				}
				?>
		</ul>
				<?php
				if(($numbof_testi - ($limit * $page)) > 0)
					{
				$pagenext = $page + 1;
				$q1 = '?page='.($pagenext);
				?>
				 <a class="paging btnRight fright rPos" href="<?php echo $q1;?>">
					<span>Older</span>
				</a>
						<?php
					}
					else
					{
					echo '<a class="btnRight fright btnRightDisabled" href="#" onclick="return false;"><span>Older</span></a>';
					}
					?>
			</div>	
	</div>
<?php
	}//pagination
?>
