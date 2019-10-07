<?php
$sql_thread_cat="select DISTINCT(field_ht_threads_value) from field_data_field_ht_threads order by FIELD(field_ht_threads_value, 'On the Road','Miscellaneous','Motorbikes','4x4','Motorsports','Street Experiences','In-Car-Entertainment','Modifications','Technical Stuff','Commercial Vehicles','Vintage Cars','Super Cars','Travelogues','Scoops','Reviews','Indian Car Scene','All-Time-Favourites') desc";
$res=@mysqli_query($sql_thread_cat);
?>
<!--<div class="roundAll5 clearfix marB10 findNews">-->
<!--	<h4 class="padL5">Find Threads</h4>-->
<!--	<div class="findNewsInner roundAll3">-->
<!--		<div class="head">By Category</div>-->
<!--		<select class="" onchange="showthread_bycat(this.value);return false;">-->
<!--			<option value="All">All</option>-->
<!--			--><?php
//			while($row_thread=@mysqli_fetch_array($res))
//				{
//			?>
<!--			<option value="--><?php //echo stripslashes($row_thread['field_ht_threads_value']);?><!--" --><?php //if($_GET['catname']==$row_thread['field_ht_threads_value']) {?><!-- selected="selected"--><?php //}?><!--><?php //echo $row_thread['field_ht_threads_value'];?><!--</option>-->
<?php //} ?>
<!---->
<!--		</select>-->
<!--	</div><!-- findNewsInner-->
<!--</div><!-- find a News-->


<!--new filters-->
<div class="sub-nav slide-content">
	<div class="selected">
		<a href="javascript:void(0)" class="btn-htread active" data-catid="All">
			<i class="icon-show-all"></i>
			<span>All</span>
		</a>
	</div>

		<?php $i=0;
      while($row_thread=@mysqli_fetch_array($res))
		{
			?>

		<div>
			<a href="javascript:void(0)" class="btn-htread" data-catid="<?php echo $row_thread['field_ht_threads_value'];?>"   title="<?php echo stripslashes($row_thread['field_ht_threads_value']);?>">

				<i class="icon-hot <?php print (str_replace(' ', '-', strtolower($row_thread['field_ht_threads_value']))); ?>"></i>
				<span><?php echo $row_thread['field_ht_threads_value'];?></span>

			</a>
			<?php //echo stripslashes($row_thread['field_ht_threads_value']);?>
		</div>
		<?php

		}
		/*if(@mysqli_num_rows($sql_thread_cat4x4)>0)
        {
        $row_thread4x4=mysqli_fetch_array($sql_thread_cat4x4) */
		?>
		<?php
		// }
		?>


	</div>
