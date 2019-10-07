<?php
/*$sql_thread_cat="select DISTINCT(field_ht_threads_value) from field_data_field_ht_threads where field_ht_threads_value!='4x4' order by field_ht_threads_value";
$sql_thread_cat4x4=@mysqli_query("select DISTINCT(field_ht_threads_value) from field_data_field_ht_threads where field_ht_threads_value='4x4' order by field_ht_threads_value");
$res=@mysqli_query($sql_thread_cat);*/
$arr=array("All-Time-Favourites","Indian Car Scene","Reviews","Scoops","Travelogues","Super Cars","Vintage Cars","Commercial Vehicles","Technical Stuff","Modifications","In-Car Entertainment","Street Experiences","Motorsports","4x4","Motorbikes and Misc","On the Road");
?>
<div class="roundAll5 clearfix marB10 findNews">
	<h4 class="padL5">Find Threads</h4>
	<div class="findNewsInner roundAll3">
		<div class="head">By Category</div>
		<select class="" onchange="showthread_bycat(this.value);return false;">
			<option value="All">All</option>
			<?php
			for($k=0;$k<=count($arr);$k++)
					{
					$row_thread=@mysqli_fetch_array(mysqli_query("select DISTINCT(field_ht_threads_value) from field_data_field_ht_threads where field_ht_threads_value='".$arr[$k]."' order by field_ht_threads_value"));
					  /*while($row_thread=@mysqli_fetch_array($res))
						  {*/
						  if($row_thread!='')
						  	{
			?>
			<option value="<?php echo $row_thread['field_ht_threads_value'];?>" <?php if($_GET['catname']==$row_thread['field_ht_threads_value']) {?> selected="selected"<?php }?>><?php echo $row_thread['field_ht_threads_value'];?></option>
			<?php
							}
						//}
					} // end of for
				
			?>
			
		</select>
	</div><!-- findNewsInner -->		
</div><!-- find a News  -->








