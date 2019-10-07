
<script type="text/javascript">
    (function ($) {
        $(function () {
            $(".newslist li").click(function (e) {
                window.location.href = $(this).attr("rel");
                   
            });
            $(".newslist li a").click(function (e) {
                e.stopPropagation();
            });
        });
    })(jQuery);
</script>

<?php
include_once("./themes/mobilebhp/connect.php");
// 	truncate function was here
$limit = 100;
$slice = 9;
$start = 1;
if (!isset($_REQUEST['page']) || !is_numeric($_REQUEST['page'])) {
    $page = 1;
} else {
    $page = $_REQUEST['page'];
}
$q = "SELECT node.title,node.nid,body_value FROM node,field_data_body WHERE field_data_body.entity_id = node.nid AND node.status =1 and field_data_body.bundle='tech_stuff' order by node.created desc";
$r = mysqli_query($q);
$totalrows = mysqli_num_rows($r);
$numofpages = ceil($totalrows / $limit);
$limitvalue = $page * $limit - ($limit);

$q = "SELECT node.title,node.nid,body_value
			FROM node,field_data_body WHERE field_data_body.entity_id = node.nid 
			AND node.status =1 and field_data_body.bundle='tech_stuff' order by node.created desc LIMIT $limitvalue, $limit";
?>
<div class="tech-stuff">
    <div class="container-fluid">
        <div class="threadsList with-thumb">
            <ul class="newslist" id="tstufflist">
                <?php
                if ($r = mysqli_query($q)) {
                    if (mysqli_num_rows($r) > 0) {
                        while ($d_tstuff = mysqli_fetch_array($r)) {
                            $sql_img = mysqli_fetch_array(mysqli_query("select file_managed.uri from field_data_field_tech_stuff_image, file_managed where file_managed.fid = field_data_field_tech_stuff_image.field_tech_stuff_image_fid and field_data_field_tech_stuff_image.entity_id=" . $d_tstuff['nid']));
                            $node_data = node_load($d_tstuff['nid']);
                            ?>

                            <li rel="<?php echo url("node/" . $d_tstuff['nid']);?>">
                                <a title="<?php echo $d_tstuff['title'];?>" href="<?php echo url("node/" . $d_tstuff['nid']);?>" ripple-background="radial-gradient(red, yellow,green)" ripple-opacity="0.7" class="ripple">
									<span style="background-image: url('/?q=sites/default/files/styles/check_mobile_thumb/public/<?php echo str_replace("public://", "", $sql_img['uri']);?>'); overflow: hidden;"
                                                                      class="thumb">
                    <!-- img(src="images/thumb-1.jpg" alt="" title="")--></span>
                                    <span class="text">
                                        <span class="ellipsis-3-line"><?php echo $node_data->title;?></span></span></a>
                            </li>
                   <?php
                        }
                    } else {


                        ?>
                        <li>
                            <div class="clearfix listHolder">
                                No Tech Stuff found
                            </div>
                        </li><!-- news list -->
                    <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<!--other sections-->
<?php include(drupal_get_path('theme', 'mobilebhp').'/includes/other-sections.php');
?>

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
