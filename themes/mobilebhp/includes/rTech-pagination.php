<?php
if ($numbof_testi > $limit) //pagination
	{
?>
<nav aria-label="Page navigation" class="text-center">
		<ul class="pagination pagination-sm">
			<!--newer-->
			<?php
			if($page!= 1)
			{
				$pageprev = $page - 1;
				$q1 = '?page='.($pageprev);
				?>
<!--				<li>-->
<!--					<a aria-label="Newer" href="--><?php //echo $q1; ?><!--&m">-->
<!--						<span>Newer</span>-->
<!--					</a>-->
<!--				</li>-->

			<?php
			}
			else
			{
//				echo '<li class="disabled"><span onclick="return false;">
//				<span>Newer</span></span></li>';
			}
			?>
			<!--newer-->

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
				<li><a<?php if($c=='') {?> title="go to page <?php echo $k; ?>"  href="<?php echo $q1;?>&m" <?php } echo $c; ?>><?php echo $k; ?></a></li>
				<?php
				}
				?>
			<!--older-->
			<?php
			if(($numbof_testi - ($limit * $page)) > 0)
			{
				$pagenext = $page + 1;
				$q1 = '?page='.($pagenext);
				?>
<!--				<li>-->
<!--					<a aria-label="Older" href="--><?php //echo $q1;?><!--&m">-->
<!--						<span>Older</span>-->
<!--					</a>-->
<!--				</li>-->
			<?php
			}
			else
			{
//				echo '<li class="disabled"><span onclick="return false;"><span>Older</span></span></li>';
			}
			?>

			<!--older-->

		</ul>

	</nav>
<?php
	}//pagination
?>
