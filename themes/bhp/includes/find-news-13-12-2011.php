<?php
if (arg(0) == 'node' && is_numeric(arg(1))) {
    $nid = arg(1);
    $node = node_load(array('nid' => $nid));
}
include_once("connect.php");
$sql_brand = mysqli_query("select title, nid from node, field_data_field_make_filter where node.nid=field_data_field_make_filter.entity_id and node.type='make' and field_data_field_make_filter.field_make_filter_value='1'") or die(mysql_error());
//$sql_tag = @mysqli_query("select field_data_field_news_tag.field_news_tag_tid as nid, node.title as title from node, field_data_field_news_tag, taxonomy_term_data where node.type='news_category' and node.nid=field_data_field_news_tag.entity_id and field_data_field_news_tag.field_news_tag_tid=taxonomy_term_data.tid ORDER BY node.changed DESC") or die(mysql_error());
$sql_tag = @mysqli_query("select title,nid from node  where type='news_category' ORDER BY node.changed DESC") or die(mysql_error());
if(mysqli_num_rows($sql_brand)>0 or mysqli_num_rows($sql_tag)>0)
{
?>
<div class="roundAll5 marB10 findNews clearfix">
	<h4 class="padL5">Find News</h4>
	<?php
	if(mysqli_num_rows($sql_brand)>0)
	{
	?>
	<div class="findNewsInner roundAll3">
		<div class="head">By Brand</div>
		<select id="newsBrandList"<?php if($node->type=='news') { ?> onchange="shownews_brand();"<?php } else if ($node->type=='page') { ?> onchange="shownews_bybrand();"<?php } ?>>
			<option value="%">Any Brand</option>
			<?php
			while($r_b=mysqli_fetch_array($sql_brand))
				{
			?>
			<!--<option<?php if($_REQUEST['model']==$r_b['nid']) { ?> selected="selected"<?php } ?> value="<?php echo $r_b['nid']?>"<?php if($node->type=='page') { ?> onclick="shownews_bybrand('<?php echo $r_b['nid']?>')"<?php } ?>><?php echo $r_b['title']?></option>-->
			<option<?php if($_REQUEST['model']==$r_b['nid']) { ?> selected="selected"<?php } ?> value="<?php echo $r_b['nid']?>"><?php echo $r_b['title']?></option>
			<?php
				}
			?>
		</select>
	</div><!-- findNewsInner -->
	<div class="or">Or</div>
	<?php
	}
	if(mysqli_num_rows($sql_tag)>0)
	{
	?>
	<div class="findNewsInner roundAll3 marT10">
		<div class="head">By Category</div>
		<select id="newsTagList"<?php if($node->type=='news') { ?> onchange="shownews_tag()"<?php } else if ($node->type=='page') { ?> onchange="shownews_bytag();"<?php } ?>>
			<option value="%">Any Category</option>
			<?php
			while($r_s=mysqli_fetch_array($sql_tag))
				{
			?>
			<!--<option<?php if($_REQUEST['tag']==$r_s['nid']) { ?> selected="selected"<?php } ?> value="<?php echo $r_s['nid']?>"<?php if($node->type=='page') { ?> onclick="shownews_bytag('<?php echo $r_s['nid']?>')"<?php } ?>><?php echo $r_s['title']?></option>-->
			<option<?php if($_REQUEST['tag']==$r_s['nid']) { ?> selected="selected"<?php } ?> value="<?php echo $r_s['nid']?>"><?php echo $r_s['title']?></option>
			<?php
				}
			?>			
		</select>
	</div><!-- findNewsInner -->
	<?php
	}
	?>
</div><!-- find a News  -->
<?php
}
?>
