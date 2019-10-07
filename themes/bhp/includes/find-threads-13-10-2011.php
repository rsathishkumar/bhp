<?php
$sql_thread_cat="select DISTINCT(field_ht_threads_value) from field_data_field_ht_threads where field_ht_threads_value!='4x4' order by field_ht_threads_value";
$sql_thread_cat4x4=@mysqli_query("select DISTINCT(field_ht_threads_value) from field_data_field_ht_threads where field_ht_threads_value='4x4' order by field_ht_threads_value");
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
			<option value="<?php echo $row_thread['field_ht_threads_value'];?>"><?php echo $row_thread['field_ht_threads_value'];?></option>
			<?php
				}
				if(@mysqli_num_rows($sql_thread_cat4x4)>0)
				{
				$row_thread4x4=mysqli_fetch_array($sql_thread_cat4x4)
			?>
			<option value="<?php echo $row_thread4x4['field_ht_threads_value'];?>"><?php echo $row_thread4x4['field_ht_threads_value'];?></option>
			<?php
				}
			?>
			<!--  <option value="Commercial Vehicles">Commercial Vehicles</option>
			<option value="Introductions">Introductions</option>
			<option value="Indian Car Scene">Indian Car Scene</option>		
			<option value="In-Car Entertainment">In-Car Entertainment</option>
			<option value="Modifications">Modifications</option>
			<option value="Motorsports">Motorsports</option>
			<option value="Motorbikes">Motorbikes</option>	
			<option value="Miscellaneous">Miscellaneous</option>	
			<option value="Super Cars">Super Cars</option>
			<option value="Technical Stuff">Technical Stuff</option>
			<option value="Travelogues">Travelogues</option>
			<option value="Vintage Cars">Vintage Cars</option>
			<option value="4x4">4x4</option>-->
		</select>
	</div><!-- findNewsInner -->		
</div><!-- find a News  -->








