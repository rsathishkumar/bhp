<?php
//$sql_model=@mysqli_query("SELECT node.title,node.nid, file_managed.uri,field_data_field_nr_make.field_nr_make_nid,field_data_field_model_dashboard.field_model_dashboard_fid FROM node,file_managed,field_data_field_nr_make,field_data_field_model_dashboard WHERE field_data_field_model_dashboard.field_model_dashboard_fid = file_managed.fid AND field_data_field_model_dashboard.entity_id = node.nid AND node.status =1 AND field_data_field_nr_make.entity_id=field_data_field_model_dashboard.entity_id order by node.changed desc limit 0,5");
$sql_modelalternative=@mysqli_query("SELECT node.title,node.nid,field_data_field_model_alternatives.field_model_alternatives_nid from node,field_data_field_model_alternatives WHERE field_data_field_model_alternatives.field_model_alternatives_nid = node.nid AND node.status =1  and field_data_field_model_alternatives.entity_id =".$node->nid." order by node.changed desc");
$numberofrows=@mysqli_num_rows($sql_modelalternative);
if($numberofrows>0)
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
		?>
			<li>
			<p><?php echo $data_model['title'];?></p>
			<div class="ReviewBtns">
				<a href="<?php echo url("node/".$data_model['nid'])?>"><img width="47" height="12" alt="<?php echo $data_model['title'];?>" src="/themes/mobilebhp/images/buttons/review.png" /></a>
				<a href="#compare.php" class="add"><img width="57" height="12" alt="Compare" src="/themes/mobilebhp/images/buttons/compare.png" /></a>
			</div>
			</li>
			<?php
				
				}
			?>

		<!--  <li>
			<p>Hyundai Sonata</p>
			<div class="ReviewBtns">
				<a href="overview.php"><img width="47" height="12" alt="Review" src="/themes/mobilebhp/images/buttons/review.png" /></a>
				<a href="compare.php" class="add"><img width="57" height="12" alt="Compare" src="/themes/mobilebhp/images/buttons/compare.png" /></a>										</div>
		</li>
		<li>
			<p>Nissan Teana</p>
			<div class="ReviewBtns">
				<a href="overview.php"><img width="47" height="12" alt="Review" src="/themes/mobilebhp/images/buttons/review.png" /></a>
				<a href="compare.php" class="add"><img width="57" height="12" alt="Compare" src="/themes/mobilebhp/images/buttons/compare.png" /></a>
			</div>
		</li>
		<li>
			<p>BMW 5 Series</p>
			<div class="ReviewBtns">
				<a href="overview.php"><img width="47" height="12" alt="Review" src="/themes/mobilebhp/images/buttons/review.png" /></a>
				<a href="compare.php" class="add"><img width="57" height="12" alt="Compare" src="/themes/mobilebhp/images/buttons/compare.png" /></a>													
			</div>
		</li>
	
		<li>
			<p>Ferrari 612</p>
			<div class="ReviewBtns">
				<a href="overview.php"><img width="47" height="12" alt="Review" src="/themes/mobilebhp/images/buttons/review.png" /></a>
				<a href="compare.php" class="add"><img width="57" height="12" alt="Compare" src="/themes/mobilebhp/images/buttons/compare.png" /></a>													
			</div>
		</li>

		<li>
			<p>Ferrari F430</p>
			<div class="ReviewBtns">
				<a href="overview.php"><img width="47" height="12" alt="Review" src="/themes/mobilebhp/images/buttons/review.png" /></a>
				<a href="compare.php" class="add"><img width="57" height="12" alt="Compare" src="/themes/mobilebhp/images/buttons/compare.png" /></a>													
			</div>
		</li>

		<li>
			<p>Honda Accord</p>
			<div class="ReviewBtns">
				<a href="overview.php"><img width="47" height="12" alt="Review" src="/themes/mobilebhp/images/buttons/review.png" /></a>
				<a href="compare.php" class="add"><img width="57" height="12" alt="Compare" src="/themes/mobilebhp/images/buttons/compare.png" /></a>													
			</div>
		</li>

		<li>
			<p>Lexus GS 300</p>
			<div class="ReviewBtns">
				<a href="overview.php"><img width="47" height="12" alt="Review" src="/themes/mobilebhp/images/buttons/review.png" /></a>
				<a href="compare.php" class="add"><img width="57" height="12" alt="Compare" src="/themes/mobilebhp/images/buttons/compare.png" /></a>													
			</div>
		</li>
		<li>
			<p>Lexus LS 450</p>
			<div class="ReviewBtns">
				<a href="overview.php"><img width="47" height="12" alt="Review" src="/themes/mobilebhp/images/buttons/review.png" /></a>
				<a href="compare.php" class="add"><img width="57" height="12" alt="Compare" src="/themes/mobilebhp/images/buttons/compare.png" /></a>													
			</div>
		</li>
	
		<li>
			<p>BMW 6 Series</p>
			<div class="ReviewBtns">
				<a href="overview.php"><img width="47" height="12" alt="Review" src="/themes/mobilebhp/images/buttons/review.png" /></a>
				<a href="compare.php" class="add"><img width="57" height="12" alt="Compare" src="/themes/mobilebhp/images/buttons/compare.png" /></a>													
			</div>
		</li>
		<li>
			<p>Audi A6</p>
			<div class="ReviewBtns">
				<a href="overview.php"><img width="47" height="12" alt="Review" src="/themes/mobilebhp/images/buttons/review.png" /></a>
				<a href="compare.php" class="add"><img width="57" height="12" alt="Compare" src="/themes/mobilebhp/images/buttons/compare.png" /></a>													
			</div>
		</li>
		<li>
			<p>Audi A8</p>
			<div class="ReviewBtns">
				<a href="overview.php"><img width="47" height="12" alt="Review" src="/themes/mobilebhp/images/buttons/review.png" /></a>
				<a href="compare.php" class="add"><img width="57" height="12" alt="Compare" src="/themes/mobilebhp/images/buttons/compare.png" /></a>													
			</div>
		</li>
		<li>
			<p>Mitsubishi Montero</p>
			<div class="ReviewBtns">
				<a href="overview.php"><img width="47" height="12" alt="Review" src="/themes/mobilebhp/images/buttons/review.png" /></a>
				<a href="compare.php" class="add"><img width="57" height="12" alt="Compare" src="/themes/mobilebhp/images/buttons/compare.png" /></a>													
			</div>
		</li>
		<li>
			<p>Mitsubishi Pajero</p>
			<div class="ReviewBtns">
				<a href="overview.php"><img width="47" height="12" alt="Review" src="/themes/mobilebhp/images/buttons/review.png" /></a>
				<a href="compare.php" class="add"><img width="57" height="12" alt="Compare" src="/themes/mobilebhp/images/buttons/compare.png" /></a>													
			</div>
		</li>
	
		<li>
			<p>Jaguar XJ</p>
			<div class="ReviewBtns">
				<a href="overview.php"><img width="47" height="12" alt="Review" src="/themes/mobilebhp/images/buttons/review.png" /></a>
				<a href="compare.php" class="add"><img width="57" height="12" alt="Compare" src="/themes/mobilebhp/images/buttons/compare.png" /></a>													
			</div>
		</li>
		<li>
			<p>Toyota Camry</p>
			<div class="ReviewBtns">
				<a href="overview.php"><img width="47" height="12" alt="Review" src="/themes/mobilebhp/images/buttons/review.png" /></a>
				<a href="compare.php" class="add"><img width="57" height="12" alt="Compare" src="/themes/mobilebhp/images/buttons/compare.png" /></a>													
			</div>
		</li>
		<li>
			<p>Hyundai Sonata</p>
			<div class="ReviewBtns">
				<a href="overview.php"><img width="47" height="12" alt="Review" src="/themes/mobilebhp/images/buttons/review.png" /></a>
				<a href="compare.php" class="add"><img width="57" height="12" alt="Compare" src="/themes/mobilebhp/images/buttons/compare.png" /></a>													
			</div>
		</li>
		<li>
			<p>Nissan Teana</p>
			<div class="ReviewBtns">
				<a href="overview.php"><img width="47" height="12" alt="Review" src="/themes/mobilebhp/images/buttons/review.png" /></a>
				<a href="compare.php" class="add"><img width="57" height="12" alt="Compare" src="/themes/mobilebhp/images/buttons/compare.png" /></a>													
			</div>
		</li>
		<li>
			<p>BMW 5 Series</p>
			<div class="ReviewBtns">
				<a href="overview.php"><img width="47" height="12" alt="Review" src="/themes/mobilebhp/images/buttons/review.png" /></a>
				<a href="compare.php" class="add"><img width="57" height="12" alt="Compare" src="/themes/mobilebhp/images/buttons/compare.png" /></a>													
			</div>
		</li>-->
	</ul>
</div><!-- mar T20 -->
</div>
<?php
}
?>
