<?php
global $base_url;
include_once("connect.php");
$limit = 10;
$slice = 9;
$start = 1;
if (!isset($_GET['page']) || !is_numeric($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}


if ($_GET['catname'] == '' || $_GET['catname'] == '%' || $_GET['catname'] == 'All') {
    //$hotthread_res = @mysqli_query(" ORDER BY node.changed DESC limit ".$start.", ".$toshow."") or die(mysql_error());
    $q = "SELECT node.title,node.changed,node.created,node.nid,field_data_field_ht_summary.field_ht_summary_value,field_data_field_ht_threads.field_ht_threads_value,file_managed.uri,field_data_field_ht_forum.field_ht_forum_url,field_data_field_ht_author.field_ht_author_value as author
		FROM node,file_managed,field_data_field_ht_forum,field_data_field_ht_summary,field_data_field_ht_threads,field_data_field_ht_image,field_data_field_ht_author
		WHERE field_data_field_ht_threads.entity_id = node.nid
		AND file_managed.fid = field_data_field_ht_image.field_ht_image_fid AND node.status=1 AND field_data_field_ht_image.entity_id=node.nid AND field_data_field_ht_summary.entity_id = field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_forum.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_author.entity_id group by node.nid ORDER BY node.created DESC";
    $r = mysqli_query($q);
    $totalrows = mysqli_num_rows($r);
    $numofpages = ceil($totalrows / $limit);
    $limitvalue = $page * $limit - ($limit);

    $q = "SELECT node.title,node.changed,node.created,node.nid,field_data_field_ht_summary.field_ht_summary_value,field_data_field_ht_threads.field_ht_threads_value,file_managed.uri,field_data_field_ht_forum.field_ht_forum_url,field_data_field_ht_author.field_ht_author_value as author
		FROM node,file_managed,field_data_field_ht_forum,field_data_field_ht_summary,field_data_field_ht_threads,field_data_field_ht_image,field_data_field_ht_author
		WHERE field_data_field_ht_threads.entity_id = node.nid
		AND file_managed.fid = field_data_field_ht_image.field_ht_image_fid AND node.status=1 AND field_data_field_ht_image.entity_id=node.nid AND field_data_field_ht_summary.entity_id = field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_forum.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_author.entity_id group by node.nid ORDER BY node.created DESC LIMIT $limitvalue, $limit";
} else {
    $q = "SELECT node.title,node.changed,node.created,node.nid,field_data_field_ht_summary.field_ht_summary_value,field_data_field_ht_threads.field_ht_threads_value,file_managed.uri,field_data_field_ht_forum.field_ht_forum_url,field_data_field_ht_author.field_ht_author_value as author
		FROM node,file_managed,field_data_field_ht_forum,field_data_field_ht_summary,field_data_field_ht_threads,field_data_field_ht_image,field_data_field_ht_author
		WHERE field_data_field_ht_threads.entity_id = node.nid AND field_data_field_ht_threads.field_ht_threads_value ='" . $_GET['catname'] . "' AND file_managed.fid = field_data_field_ht_image.field_ht_image_fid AND node.status=1 AND field_data_field_ht_image.entity_id=node.nid AND field_data_field_ht_summary.entity_id = field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_forum.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_author.entity_id group by node.nid ORDER BY node.created DESC";

    $r = mysqli_query($q);
    $totalrows = mysqli_num_rows($r);
    $numofpages = ceil($totalrows / $limit);
    $limitvalue = $page * $limit - ($limit);
    $q = "SELECT node.title,node.changed,node.created,node.nid,field_data_field_ht_summary.field_ht_summary_value,field_data_field_ht_threads.field_ht_threads_value,file_managed.uri,field_data_field_ht_forum.field_ht_forum_url,field_data_field_ht_author.field_ht_author_value as author
		FROM node,file_managed,field_data_field_ht_forum,field_data_field_ht_summary,field_data_field_ht_threads,field_data_field_ht_image,field_data_field_ht_author
		WHERE field_data_field_ht_threads.entity_id = node.nid AND field_data_field_ht_threads.field_ht_threads_value ='" . $_GET['catname'] . "' AND file_managed.fid = field_data_field_ht_image.field_ht_image_fid AND node.status=1 AND field_data_field_ht_image.entity_id=node.nid AND field_data_field_ht_summary.entity_id = field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_forum.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_author.entity_id group by node.nid ORDER BY node.created DESC LIMIT $limitvalue, $limit";
}


?>

<?php
if ($r = mysqli_query($q)) {
    while ($d_thread = mysqli_fetch_array($r)) {
        $restofind = strstr($d_thread['field_ht_forum_url'], "http://");
        $noaddata = node_load($d_thread['nid']);

        $thread_url = $d_thread['field_ht_forum_url'];

        if (stristr($thread_url, 'http://')){

           $thread_url =  str_replace('http://', 'https://', $thread_url);
        }


        ?>

        <li rel="<?php echo $thread_url;?>">
            <a title="<?php echo $d_thread['title']; ?>" href="<?php echo $thread_url;?>" ripple-background="#FF8C00" ripple-opacity="0.7" class="ripple">
				        <span class="thumb"
                              style="background-image: url('/?q=sites/default/files/styles/check_mobile_thumb/public/<?php echo str_replace("public://", "", $d_thread['uri']); ?>')">
<!--																		<img alt="--><?php //echo $noaddata->title; ?><!--" src="/?q=sites/default/files/styles/check_medium_medium/public/--><?php //echo str_replace("public://", "", $d_thread['uri']); ?><!--">-->
						</span>
                        <span class="text">
                            <span class="ellipsis-2-line">
                                <?php echo $noaddata->title; ?>
                            </span>
                            <small
                                class="post-by"><?php //echo returnDate($d_thread['changed']);
                                ?>
                                By: <?php echo $d_thread['author']; ?></small>

                        </span>


            </a>
        </li><!-- thread list -->

    <?php
    }
} else {

    ?>
    <li>

        <h2>No Thread Found</a></h2>

    </li><!-- thread list -->
<?php
}
?>



<?php
if ($r = mysqli_query($q) && $totalrows > 10) {
    if (isset($_REQUEST['catname']) && ($_REQUEST['catname'] != '%') && ($_REQUEST['catname'] != 'All')) {
        $q1 .= '&catname=' . $_REQUEST['catname'];
    } else {
        $q1 .= '&catname=All';
    }
    ?>

    <!--         <ul class="pagination pagination-sm ">-->
    <?php
    if ($page != 1) {
        $pageprev = $page - 1;
        //echo '<a href="'.$_SERVER['php_SELF'].'?page='.$pageprev.'">PREV</a> - ';
        ?>
        <!--                <li>-->
        <!--                    <a class="firstbtn" href="javascript:void(0);" data-rel="--><?php //echo '&page=' . $pageprev . $q1; ?><!--">-->
        <!--                        Newer-->
        <!--                    </a>-->
        <!--                </li>-->

    <?php
    } else {
        ?>
        <!--                <li class="disabled">-->
        <!--                    <a href="javascript:void(0);">-->
        <!--                        <span>Newer</span>-->
        <!--                    </a>-->
        <!--                </li>-->


    <?php
    }
    ?>

    <?php


    if (($page + $slice) < $numofpages) {
        $this_far = $page + $slice;
    } else {
        $this_far = $numofpages;
    }

    if (($start + $page) >= 10 && ($page - 10) > 0) {
        $start = $page - 6;
    }
    for ($k = $start; $k <= $this_far; $k++) {
        if ($k == $start && $_REQUEST['page'] == '') {
            $c = " class=\"active\"";
        } else if (($_REQUEST['page'] == $k)) {
            $c = " class=\"active\"";
        } else {
            $c = "";
        }
        ?>
        <!--
                <li><a<?php if ($c == '') { ?> title="go to page <?php echo $k; ?>" href="javascript:void(0);" <?php }
        echo $c; ?> rel="<?php echo '&page=' . $k . $q1; ?>"><?php echo $k; ?></a></li>
                --> <?php
    }
    ?>

    <?php
    if (($totalrows - ($limit * $page)) > 0) {
        $pagenext = $page + 1;
        //$href='page='.$pagenext.$q1;
//                ?q=hot-thread/callback&m
        ?>
        <li class="btnnew hide" data-nextpage="/?q=hot-thread/callback<?php echo '&page=' . $pagenext . $q1; ?>">
            Next
        </li>


    <?php
    } else {
        ?>
        <!--                <li class="disabled">-->
        <!--                    <a href="javascript:void(0);">-->
        <!--                        <span>Older</span>-->
        <!--                    </a>-->
        <!--                </li>-->


    <?php
    }
    ?>
    <!--        </ul>-->
    <!---->
    <!---->
    <!--    </nav>-->

<?php
}
?>
