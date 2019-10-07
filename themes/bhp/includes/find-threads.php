<?php
$sql_thread_cat="select DISTINCT(field_ht_threads_value) from field_data_field_ht_threads order by FIELD(field_ht_threads_value, 'On the Road','Miscellaneous','Motorbikes','4x4','Motorsports','Street Experiences','In-Car-Entertainment','Modifications','Technical Stuff','Commercial Vehicles','Vintage Cars','Super Cars','Travelogues','Scoops','Reviews','Indian Car Scene','All-Time-Favourites') desc";
//$sql_thread_cat4x4=@mysqli_query("select DISTINCT(field_ht_threads_value) from field_data_field_ht_threads where field_ht_threads_value='4x4' order by field_ht_threads_value");
$res=@mysqli_query($sql_thread_cat);
?>
<div class="roundAll5 clearfix marB10 findNews">
	<h4 class="padL5">Find Threads</h4>
	<div class="findNewsInner roundAll3">
		<div class="head">By Category</div>
		<select class="" onchange="showthread_bycat(this.value);return false;">
			<option value="All">All</option>
			<?php
			while($row_thread=@mysqli_fetch_array($res))
				{
			?>
			<option value="<?php echo stripslashes($row_thread['field_ht_threads_value']);?>" <?php if($_GET['catname']==$row_thread['field_ht_threads_value']) {?> selected="selected"<?php }?>><?php echo $row_thread['field_ht_threads_value'];?></option>
			<?php
				}
				/*if(@mysqli_num_rows($sql_thread_cat4x4)>0)
				{
				$row_thread4x4=mysqli_fetch_array($sql_thread_cat4x4) */
			?>
			<?php
				// }
			?>
			
		</select>
	</div><!-- findNewsInner -->		
</div><!-- find a News  -->








