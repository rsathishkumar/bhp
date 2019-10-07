<script type="text/javascript">
	$(function () {
		$(".newslist li").click(function (e) {
			window.location.href = $(this).attr("rel");
		});
		$(".newslist li a").click(function (e) {
			e.stopPropagation();
		});
	});
</script>

<?php
include_once("./themes/mobilebhp/connect.php");
$limit = 100;
$slice = 9;
$start = 1;
if (!isset($_REQUEST['page']) || !is_numeric($_REQUEST['page'])) {
	$page = 1;
} else {
	$page = $_REQUEST['page'];
}
$q = "SELECT node.title,node.nid,body_value
FROM node,field_data_body WHERE field_data_body.entity_id = node.nid 
AND node.status =1 and field_data_body.bundle='safety' order by node.created desc";
$r = mysqli_query($q);
$totalrows = mysqli_num_rows($r);
$numofpages = ceil($totalrows / $limit);
$limitvalue = $page * $limit - ($limit);

$q = "SELECT node.title,node.nid,body_value
FROM node,field_data_body WHERE field_data_body.entity_id = node.nid 
AND node.status =1 and field_data_body.bundle='safety' order by node.created desc limit $limitvalue, $limit";

function truncate($text, $length = 195, $ending = '...', $exact = false, $considerHtml = true)
{
	if ($considerHtml) {
		// if the plain text is shorter than the maximum length, return the whole text
		if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
			return $text;
		}
		// splits all html-tags to scanable lines
		preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
		$total_length = strlen($ending);
		$open_tags = array();
		$truncate = '';
		foreach ($lines as $line_matchings) {
			// if there is any html-tag in this line, handle it and add it (uncounted) to the output
			if (!empty($line_matchings[1])) {
				// if it's an "empty element" with or without xhtml-conform closing slash
				if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
					// do nothing
					// if tag is a closing tag
				} else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
					// delete tag from $open_tags list
					$pos = array_search($tag_matchings[1], $open_tags);
					if ($pos !== false) {
						unset($open_tags[$pos]);
					}
					// if tag is an opening tag
				} else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
					// add tag to the beginning of $open_tags list
					array_unshift($open_tags, strtolower($tag_matchings[1]));
				}
				// add html-tag to $truncate'd text
				$truncate .= $line_matchings[1];
			}
			// calculate the length of the plain text part of the line; handle entities as one character
			$content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
			if ($total_length + $content_length > $length) {
				// the number of characters which are left
				$left = $length - $total_length;
				$entities_length = 0;
				// search for html entities
				if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
					// calculate the real length of all entities in the legal range
					foreach ($entities[0] as $entity) {
						if ($entity[1] + 1 - $entities_length <= $left) {
							$left--;
							$entities_length += strlen($entity[0]);
						} else {
							// no more characters left
							break;
						}
					}
				}
				$truncate .= substr($line_matchings[2], 0, $left + $entities_length);
				// maximum lenght is reached, so get off the loop
				break;
			} else {
				$truncate .= $line_matchings[2];
				$total_length += $content_length;
			}
			// if the maximum length is reached, get off the loop
			if ($total_length >= $length) {
				break;
			}
		}
	} else {
		if (strlen($text) <= $length) {
			return $text;
		} else {
			$truncate = substr($text, 0, $length - strlen($ending));
		}
	}
	// if the words shouldn't be cut in the middle...
	if (!$exact) {
		// ...search the last occurance of a space...
		$spacepos = strrpos($truncate, ' ');
		if (isset($spacepos)) {
			// ...and cut the text in this position
			$truncate = substr($truncate, 0, $spacepos);
		}
	}
	// add the defined ending to the text
	$truncate .= $ending;
	if ($considerHtml) {
		// close all unclosed html-tags
		foreach ($open_tags as $tag) {
			$truncate .= '</' . $tag . '>';
		}
	}
	return $truncate;
}

?>


<div class="road-safety">
	<div class="container-fluid">
		<div class="threadsList with-thumb">
			<ul id="safetylist">
				<?php
				if ($r = mysqli_query($q)) {
					while ($d_safety = mysqli_fetch_array($r)) {
						$safety_data = node_load($d_safety['nid']);
						$sql_img = mysqli_fetch_array(mysqli_query("select file_managed.uri from field_data_field_safety_image,file_managed where file_managed.fid =field_data_field_safety_image.field_safety_image_fid and field_data_field_safety_image.entity_id=" . $d_safety['nid']));
						?>


						<li rel="<?php echo url("node/" . $d_safety['nid']);?>">
							<a href="<?php echo url("node/" . $d_safety['nid']);?>" ripple-background="radial-gradient(red, yellow,green)" ripple-opacity="0.7" class="ripple">
                                <span style="background-image: url('/?q=sites/default/files/styles/check_mobile_thumb/public/<?php echo str_replace('public://', '', $sql_img['uri']);?>'); overflow: hidden;" class="thumb" title="<?php echo $d_safety['title'];?>" >
                                    <!-- img(src="/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://", "", $sql_img['uri']);?>" alt="" title="")-->
                                </span>
                                <span class="text">
                                    <span class="ellipsis-3-line"><?php echo $safety_data->title;?></span>
                                </span>
							</a>
						</li>

					<?php
					}
				} else {


					?>
					<li>
						<div class="clearfix">
							No Tech Stuff found
						</div>
					</li><!-- news list -->
				<?php
				}
				?>
			</ul>
		</div>
	</div>
</div>

<!--other sections-->



<?php
if ($r = mysqli_query($q) && $totalrows > 10) {
	?>
	<div class="marT10 clearfix">
		<div class="clearfix w100p">
			<?php
			if ($page != 1) {
				$pageprev = $page - 1;
				$q = '&page=' . ($pageprev);

				//echo '<a href="'.$_SERVER['php_SELF'].'?page='.$pageprev.'">PREV</a> - ';
				?><a class="paging btnLeft fleft" href="#" rel="<?php echo $q; ?>"><span>Newer</span></a>
			<?php
			} else {
				echo "<a class='btnLeft fleft btnLeftDisabled' href='#' onclick='return false;'><span>Newer</span></a>";
			}?>
			<!--<a class="btnLeft fleft btnLeftDisabled" href="#" onclick="return false;"><span>Newer</span></a>-->
			<ul class="pagination">
				<?php
				if (($page + $slice) < $numofpages) {
					$this_far = $page + $slice;
				} else {
					$this_far = $numofpages;
				}

				if (($start + $page) >= 10 && ($page - 10) > 0) {
					$start = $page - 10;
				}

				for ($k = $start; $k <= $this_far; $k++) {
					if ($k == $start && $_REQUEST['page'] == '') {
						$c = " class=\"active\"";
					} else if (($_REQUEST['page'] == $k)) {
						$c = " class=\"active\"";
					} else {
						$c = "";
					}

					$q = '&page=' . $k;

					?>
					<li><a<?php if ($c == '') { ?> title="go to page <?php echo $k; ?>" href="#" <?php }
						echo $c; ?> rel="<?php echo $q; ?>"><?php echo $k; ?></a></li>
				<?php

				}
				?>
			</ul>
			<?php
			if (($totalrows - ($limit * $page)) > 0) {
				$pagenext = $page + 1;
				$q = '&page=' . ($pagenext);
				?>
				<a class="paging btnRight fright rPos" rel="<?php echo $q;?>" href="#"><span>Older</span></a>
			<?php
			} else {
				echo '<a class="btnRight fright btnRightDisabled" href="#" onclick="return false;"><span>Older</span></a>';
			}
			?>

		</div>
	</div>
<?php
}
?>
