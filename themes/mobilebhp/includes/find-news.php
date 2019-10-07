<?php
if (arg(0) == 'node' && is_numeric(arg(1))) {
    $nid = arg(1);
    $node = node_load(array('nid' => $nid));

}
include_once("connect.php");
$sql_brand = mysqli_query("select title, nid from node, field_data_field_make_filter where node.nid=field_data_field_make_filter.entity_id and node.type='make' and field_data_field_make_filter.field_make_filter_value='1' order by node.title") or die(mysql_error());
//$sql_tag = @mysqli_query("select field_data_field_news_tag.field_news_tag_tid as nid, node.title as title from node, field_data_field_news_tag, taxonomy_term_data where node.type='news_category' and node.nid=field_data_field_news_tag.entity_id and field_data_field_news_tag.field_news_tag_tid=taxonomy_term_data.tid ORDER BY node.changed DESC") or die(mysql_error());
$sql_tag = @mysqli_query("select title,nid from node  where type='news_category' ORDER BY node.title") or die(mysql_error());
if (mysqli_num_rows($sql_brand) > 0 or mysqli_num_rows($sql_tag) > 0) {
    ?>
    <div class="news-filters text-center">

        <?php
        if (mysqli_num_rows($sql_brand) > 0) {
            ?>

            <button type="button" class="btn btn-brand all-news">
                <span class="ellipsis">All Brands</span>
                <i class="icon-angle-down"></i>
            </button>

            <!-- By category -->
        <?php
        }
        if (mysqli_num_rows($sql_tag) > 0) {
            ?>

            <button type="button" class="btn btn-category all-news ellipsis">
                <span class="ellipsis">All Categories</span>
                <i class="icon-angle-down"></i>
            </button>



        <?php
        }
        ?>
    </div>

    <!--brand names-->
    <?php
    if (mysqli_num_rows($sql_brand) > 0) {
        ?>
        <div class="news-brands" style="display: none;">
            <div class="brand-lists">
                <!-- By Brand -->
                <ul id="newsBrandList">
                    <li>
                        <a href="javascript:void(0)" class="text-center brand-all" data-brandname="All Brands"
                           data-id="">
                            <span class="c-logo">
                                <i class="icon-all-brand"></i>
                            </span>

							<span class="text"> All Brands</span>
                        </a>
                    </li>

                    <?php
                    while ($r_b = mysqli_fetch_array($sql_brand)) {

                        ?>
                        <!--<option<?php if ($_REQUEST['model'] == $r_b['nid']) { ?> selected="selected"<?php } ?> value="<?php echo $r_b['nid']?>"<?php if ($node->type == 'page') { ?> onclick="shownews_bybrand('<?php echo $r_b['nid'] ?>')"<?php } ?>><?php echo $r_b['title']?></option>-->
                        <li>
                            <?php
                            $node = node_load($r_b['nid']);
                            if (!empty($node->field_make_logo['und'][0]['uri'])) {
                                $logo = $base_url . '/sites/default/files/' . str_replace("public://", "", $node->field_make_logo['und'][0]['uri']);
                            } else {
                                $logo = "http://placehold.it/80x80";
                            }
                            ?>
                            <a href="javascript:void(0)" class="text-center" data-brandname="<?php echo $r_b['title']?>"
                               data-id="<?php echo $r_b['nid']?>">
                                <span class="c-logo">
                                    <img src="<?php echo $logo;?>" alt="" title="">
                                </span>
							<span class="text">
								<?php echo $r_b['title']?>

							</span>
                            </a>

                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>

    <?php
    }
    ?>
    <!--brand names-->
    <!--category names-->
    <?php
    if (mysqli_num_rows($sql_tag) > 0) {
        ?>
        <div class="news-category" style="display: none;">
            <div class="brand-lists">
                <ul id="newsCatList">
                    <li>
                        <a href="javascript:void(0)" class="text-center brand-all" data-catname="All Categories"
                           data-id="">
                            <i class="icon-all-brand"></i>
                            <span class="text">All Categories</span>
                        </a>
                    </li>

                    <?php
                    while ($r_s = mysqli_fetch_array($sql_tag)) {        //categories coming from vocabulary tag.

                        $nwwname = str_replace(' ','-', strtolower($r_s['title']));
                        $nwwname = str_replace('&','-', $nwwname);


                        ?>

                        <li>
                            <a href="javascript:void(0)" class="text-center" data-catname="<?php echo $r_s['title']?>"
                               data-id="<?php echo $r_s['nid']?>">
                                <i class="icon-<?php print ($nwwname); ?>"></i>
                                <span class="text"><?php echo $r_s['title']?></span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>

                </ul>
            </div>
        </div>

    <?php
    }
    ?>
    <!--category names-->


<?php
}
?>
