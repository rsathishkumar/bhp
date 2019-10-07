
<?php
include_once("./themes/mobilebhp/connect.php");
$limit = 10;
$slice = 9;
$start = 1;
if (!isset($_REQUEST['page']) || !is_numeric($_REQUEST['page'])) {
    $page = 1;
} else {
    $page = $_REQUEST['page'];
}
if ($_GET['catname'] == '') {
    $cname = 'On Buying';
} else {
    if ($_GET['catname'] == 'All' || $_GET['catname'] == '%') {
        $cname = "%";
    } else {
        $cname = $_GET['catname'];
    }
}

$q = "SELECT node.title,node.nid, field_data_field_advice_categories.field_advice_categories_value
	FROM node, field_data_field_advice_categories WHERE field_data_field_advice_categories.entity_id = node.nid 
	AND node.status =1
	AND node.nid = field_data_field_advice_categories.entity_id
	AND field_data_field_advice_categories.field_advice_categories_value like '%" . $cname . "%' order by node.created desc";
$r = mysqli_query($q);
$totalrows = mysqli_num_rows($r);
$numofpages = ceil($totalrows / $limit);
$limitvalue = $page * $limit - ($limit);
$q = "SELECT node.title,node.nid, field_data_field_advice_categories.field_advice_categories_value
	FROM node, field_data_field_advice_categories WHERE field_data_field_advice_categories.entity_id = node.nid 
	AND node.status =1
	AND node.nid = field_data_field_advice_categories.entity_id
	AND field_data_field_advice_categories.field_advice_categories_value like '%" . $cname . "%' order by node.created desc limit $limitvalue, $limit";

//truncate function was here

?>


            <?php
            if ($r = mysqli_query($q)) {
                if (mysqli_num_rows(mysqli_query($q)) > 0) {
                    while ($d_advice = mysqli_fetch_array($r)) {
                        $node_data = node_load($d_advice['nid']);

                        //echo "<pre>"; print_r($node_data); echo "</pre>";
                        //print_r($node_data->field_advice_content['und'][0]['value']);
                        $sql_img_check = @mysqli_fetch_array(mysqli_query("select field_advice_media_type_value from field_data_field_advice_media_type where entity_id =" . $d_advice['nid']));
                        $sql_advice = mysqli_fetch_array(mysqli_query("select field_advice_content_value from field_data_field_advice_content where entity_id=" . $d_advice['nid']));
                        if ($sql_img_check['field_advice_media_type_value'] == 'Image') {
                            $sql_img = mysqli_fetch_array(mysqli_query("select file_managed.uri from field_data_field_advice_images, file_managed where file_managed.fid = field_data_field_advice_images.field_advice_images_fid and field_data_field_advice_images.entity_id=" . $d_advice['nid']));
                        } else {
                            $sql_img = mysqli_fetch_array(mysqli_query("select file_managed.uri from field_data_field_advice_optional_image, file_managed where file_managed.fid = field_data_field_advice_optional_image.field_advice_optional_image_fid and field_data_field_advice_optional_image.entity_id=" . $d_advice['nid']));
                        }
                        if ($_GET['tab'] != '' || $_GET['catname'] == 'All' || $_GET['catname'] == '%') {
                            //echo "select alias from url_alias where source = 'node/".$d_advice['nid']."'";
                            $url_alias1 = mysqli_fetch_array(mysqli_query("select alias from url_alias where source = 'node/" . $d_advice['nid'] . "'"));
                            $url_alias = "/?q=" . $url_alias1['alias'] . "&tab=1";
                        } else {
                            $url_alias = url('node/' . $d_advice['nid']);
                        }
                        ?>

                        <li rel="<?php echo $url_alias; ?>">
                            <a title="<?php echo $node_data->title;?>" href="<?php echo $url_alias; ?>"
                               ripple-background="radial-gradient(red, yellow,green)" ripple-opacity="0.7"
                               class="ripple">
											<span
                                                style="background-image: url('/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://", "", $sql_img['uri']);?>'); overflow: hidden;"
                                                class="thumb">
											</span>
											<span class="text">

                                                <?php if($cname != "%"){?>
												    <span class="ellipsis-3-line"><?php echo $node_data->title;?></span>
                                                <?php } ?>

                                                <?php if($cname=="%"){?>
                                                    <span class="ellipsis-2-line"><?php echo $node_data->title;?></span>
                  								    <span class="label label-default label-advice"><?php print $node_data->field_advice_categories['und'][0]['value']; ?></span>
                                                <?php } ?>

											</span>
                            </a>
                        </li>

                    <?php
                    }
                } else {
                    ?>
                    <li class="text-center text-danger">
                        No data found
                    </li>

                <?php
                }
            }
            ?>
            <!-- news list -->

<?php
if ($r = mysqli_query($q) && $totalrows > 10) {

    ?>


        <?php
        if ($page != 1) {
            $pageprev = $page - 1;
            $q1 = '&page=' . ($pageprev);
            if (isset($_REQUEST['catname'])) {
                $q1 .= '&catname=' . $_REQUEST['catname'];
                if ($_GET['tab'] != '' || $_GET['catname'] == 'All' || $_GET['catname'] == '%') {
                    $q1 .= '&tab=1';
                }
            } else {
                $q1 .= '&catname=On Buying';
                if ($_GET['tab'] != '' || $_GET['catname'] == 'All' || $_GET['catname'] == '%') {
                    $q1 .= '&tab=1';
                }
            }
            //echo '<a href="'.$_SERVER['php_SELF'].'?page='.$pageprev.'">PREV</a> - ';


            ?>
<!--            <a class="paging btnLeft fleft" href="#" rel="--><?php //echo $q1; ?><!--">-->
<!--                <span>Newer</span>-->
<!--            </a>-->
        <?php
        } else {
          //  echo '<a class="btnLeft fleft btnLeftDisabled " href="#" onclick="return false;"> <span>Newer</span></a>';
        }
        ?>

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
                $q1 = '&page=' . $k;
                if (isset($_REQUEST['catname'])) {
                    $q1 .= '&catname=' . $_REQUEST['catname'];
                    if ($_GET['tab'] != '' || $_GET['catname'] == 'All' || $_GET['catname'] == '%') {
                        $q1 .= '&tab=1';
                    }
                } else {
                    $q1 .= '&catname=On Buying';
                    if ($_GET['tab'] != '' || $_GET['catname'] == 'All' || $_GET['catname'] == '%') {
                        $q1 .= '&tab=1';
                    }
                }
                ?>
<!--                <li><a--><?php //if ($c == '') { ?><!-- title="go to page --><?php //echo $k; ?><!--"  href="#" --><?php //}
//                    echo $c; ?><!-- rel="--><?php //echo $q1;?><!--">--><?php //echo $k; ?><!--</a></li>-->
            <?php

            }


            ?>

        <?php
        if (($totalrows - ($limit * $page)) > 0) {
            $pagenext = $page + 1;
            $q1 = '&page=' . ($pagenext);
            if (isset($_REQUEST['catname'])) {
                $q1 .= '&catname=' . $_REQUEST['catname'];
                if ($_GET['tab'] != '' || $_GET['catname'] == 'All' || $_GET['catname'] == '%') {
                    $q1 .= '&tab=1';
                }
            } else {
                $q1 .= '&catname=On Buying';
                if ($_GET['tab'] != '' || $_GET['catname'] == 'All' || $_GET['catname'] == '%') {
                    $q1 .= '&tab=1';
                }
            }
            ?>
            <li class="btnnew hide" data-nextpage="/?q=advice-list/callback<?php echo $q1; ?>" >
              Older
            </li>
        <?php
        } else {
           // echo '<a class="btnRight fright btnRightDisabled" href="#" onclick="return false;"><span>Older</span></a>';
        }

}
?>
