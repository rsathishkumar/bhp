<?php
$numberofrowsforalternative=@mysqli_num_rows($sql_modelalternative);
if($numberofrowsforalternative>0)
{
?>
<div class="reviewAlt clearfix roundAll5">
<h3 class="marB10">Alternatives
	<span>Move your mouse over a car name to view the <strong>review</strong> or <strong>compare</strong> buttons</span>
</h3>
<div>
	<ul>
		<?php
			$counter=1;
			while($data_model=@mysqli_fetch_array($sql_modelalternative))
				{
		$mktitle=@mysqli_fetch_array(mysqli_query("select title from node,field_data_field_nr_make where field_data_field_nr_make.entity_id =".$data_model['nid']." and field_data_field_nr_make.field_nr_make_nid=node.nid"));
				?>
			<li>
			<p title="<?php echo /*$mktitle['title']." ".*/$data_model['title'];?>"><?php echo /*$mktitle['title']." ".*/$data_model['title'];?></p>
			<div class="ReviewBtns">
				<a href="<?php echo url("node/".$data_model['nid'])?>" title="Overview"><img width="47" height="12" alt="<?php echo $mktitle['title']." ".$data_model['title'];?>" src="/themes/mobilebhp/images/buttons/review.png" /></a>
				<a href="#" onClick="getCarID('<?php echo $data_model['nid']; ?>'); return false;" class="add"><img width="57" height="12" alt="Compare" src="/themes/mobilebhp/images/buttons/compare.png" /></a>
			</div>
			</li>
			<?php
				
				}
			?>

	</ul>
</div><!-- mar T20 -->
</div>
<?php
}
?>
