<!--<div class="maintestimonialBox">-->
<!--	<div class="mainTestimonial">-->
<!--		“<em>Rtech</em> - Robin Shroff <br />-->
<!--27th June 1978 - 23rd December 2007 <br />-->
<!--A Beautiful human being, Ace biker & Team-BHP Moderator” -->
<!--       </div>-->
<!--</div> -->
<?php
include_once("connect.php");
$sql_teseti=@mysqli_query("SELECT node.title, field_data_field_rtech_relation.field_rtech_relation_value, field_data_field_rtech_comment.field_rtech_comment_value
FROM node, field_data_field_rtech_relation, field_data_field_rtech_comment
WHERE field_data_field_rtech_comment.entity_id = node.nid
AND field_data_field_rtech_comment.entity_id = node.nid
AND field_data_field_rtech_comment.entity_id = field_data_field_rtech_relation.entity_id
AND node.type = 'rtech_memorial'
AND node.status =1 AND field_data_field_rtech_relation.entity_id=node.nid ORDER BY node.created");
$numbof_testi=@mysqli_num_rows($sql_teseti);
$numofpages = ceil($numbof_testi / $limit);
$limitvalue = $page * $limit - ($limit);
$sql_teseti=@mysqli_query("SELECT node.title, field_data_field_rtech_relation.field_rtech_relation_value, field_data_field_rtech_comment.field_rtech_comment_value
FROM node, field_data_field_rtech_relation, field_data_field_rtech_comment
WHERE field_data_field_rtech_comment.entity_id = node.nid
AND field_data_field_rtech_comment.entity_id = node.nid
AND field_data_field_rtech_comment.entity_id = field_data_field_rtech_relation.entity_id
AND node.type = 'rtech_memorial'
AND node.status =1 AND field_data_field_rtech_relation.entity_id=node.nid ORDER BY node.created limit $limitvalue, $limit");
		if($numbof_testi>0)
		{
?>

<ul class="testimonial-text">
	<?php
	while($data_testi=mysqli_fetch_array($sql_teseti))
		{
	?>
	<li class="text-center">
<!--		<p class="text">Robin,</p>-->
		<?php echo $data_testi['field_rtech_comment_value'];?>
		<p class="text"><?php echo $data_testi['title'];?><span>(<?php echo $data_testi['field_rtech_relation_value'];?>)</span></p>

	</li>
<?php
	}
?>
</ul>
<?php
	}
?>
