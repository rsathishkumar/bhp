
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


//function to format date in 'xx days ago'
/*
function returnDate($querydate)
{
    $minusdate = date('ymdHi') - date("ymdHi", $querydate);

    if ($minusdate > 88697640 && $minusdate < 100000000) {
        $minusdate = $minusdate - 88697640;
    }

    switch ($minusdate) {

        case ($minusdate < 99):
            if ($minusdate == 1) {
                $date_string = '1 minute ago';
            } elseif ($minusdate > 59) {
                $date_string = ($minusdate - 40) . ' minutes ago';
            } elseif ($minusdate > 1 && $minusdate < 59) {
                $date_string = $minusdate . ' minutes ago';
            }
            break;

        case ($minusdate > 99 && $minusdate < 2359):
            $flr = floor($minusdate * .01);
            if ($flr == 1) {
                $date_string = '1 hour ago';
            } else {
                $date_string = $flr . ' hours ago';
            }
            break;

        case ($minusdate > 2359 && $minusdate < 310000):
            $flr = floor($minusdate * .0001);
            if ($flr == 1 || $flr == 0) {
                $date_string = '1 day ago';
            } else {
                $date_string = $flr . ' days ago';
            }
            break;

        case ($minusdate > 310001 && $minusdate < 12320000):
            $flr = floor($minusdate * .000001);
            if ($flr == 1 || $flr == 0) {
                $date_string = "1 month ago";
            } else {
                $date_string = $flr . ' months ago';
            }
            break;

        case ($minusdate > 100000000):
            $flr = floor($minusdate * .00000001);
            if ($flr == 1 || $flr == 0) {
                $date_string = '1 year ago.';
            } else {
                $date_string = $flr . ' years ago';
            }
    }
    return $date_string;
}
*/

?>



<div id="war-htread" class="threadsList with-thumb">
    <ul>
        <?php
        if ($r = mysqli_query($q)) {
            while ($d_thread = mysqli_fetch_array($r)) {
                $restofind = strstr($d_thread['field_ht_forum_url'], "http://");
                $noaddata = node_load($d_thread['nid']);

                ?>

                <li rel="<?php if ($restofind == '') {
                    echo "http://";
                }
                echo $d_thread['field_ht_forum_url'];?>">
                    <a title="<?php echo $d_thread['title']; ?>" href="<?php if ($restofind == '') {
                        echo "http://";
                    }
                    echo $d_thread['field_ht_forum_url'];?>" target="_blank" ripple-background="#FF8C00"
                       ripple-opacity="0.7" class="ripple">
																	<span class="thumb">
																		<img alt="<?php echo $noaddata->title;?>"
                                                                             src="/?q=sites/default/files/styles/check_mobile_thumb/public/<?php echo str_replace("public://", "", $d_thread['uri']);?>">
																	</span>
																	<span class="text">
                                                                        <span class="ellipsis-2-line">
                                                                            <?php echo $noaddata->title;?>
                                                                        </span>
                                                                        <small class="post-by"><?php //echo returnDate($d_thread['changed']);
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

    </ul>
</div>


<?php
if ($r = mysqli_query($q) && $totalrows > 10) {
    if (isset($_REQUEST['catname']) && ($_REQUEST['catname'] != '%') && ($_REQUEST['catname'] != 'All')) {
        $q1 .= '&catname=' . $_REQUEST['catname'];
    } else {
        $q1 .= '&catname=%';
    }
    ?>
    <div class="marT10 clearfix">

        <div class="clearfix w100p">
            <?php
            if ($page != 1) {
                $pageprev = $page - 1;
                //echo '<a href="'.$_SERVER['php_SELF'].'?page='.$pageprev.'">PREV</a> - ';

                ?>
                <a class="firstbtn btnLeft fleft" href="#" rel="<?php echo '&page=' . $pageprev . $q1; ?>">
                    <span>Newer</span>
                </a>
            <?php
            } else {
                ?>
                <a class="btnLeft fleft btnLeftDisabled" href="#" onclick="return false;">
                    <span>Newer</span>
                </a>
            <?php
            }
            ?>
            <ul class="pagination">
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
                    <li><a<?php if ($c == '') { ?> title="go to page <?php echo $k; ?>" href="#" <?php }
                        echo $c; ?> rel="<?php echo '&page=' . $k . $q1; ?>"><?php echo $k; ?></a></li>
                <?php
                }
                ?>
            </ul>
            <?php
            if (($totalrows - ($limit * $page)) > 0) {
                $pagenext = $page + 1;
                //$href='page='.$pagenext.$q1;
                ?>
                &nbsp;&nbsp;<a class="btnnew btnRight fright rPos" href="#"
                               rel="<?php echo '&page=' . $pagenext . $q1; ?>">
                    <span>Older</span></a>
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
<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">	</script> -->
<script type="text/javascript">
    function nav_hotthreads(link) {
        //jQuery.url.setUrl(url);
        //var url = Drupal.settings.basePath +'?q=hot-thread/callback';
        $('html, body').animate({scrollTop: $("h1").offset().top - 10}, 300);
        var url = Drupal.settings.basePath + '?q=hot-thread/callback';
        url += link;
        //jQuery.url.setUrl(url);
        $.ajax(
            {
                cache: false,
                url: url,
                dataType: 'text',
                error: function (request, status, error) {
                    alert(status);
                    //$('#container').html(request.responseText);
                },
                success: function (data, status, request) {
                    $('#ajax').html(data);
                }
            });
    }
    $('.pagination li a').click(function () {
        if ($(this).hasClass("active")) {
            return false;
        }
        else {
            //alert(this.href);
            nav_hotthreads(this.rel);
            $(".threadlist").html("<div class='loader'>&nbsp;" + "<" + "/div>");
            //alert(this.attr("rel"));
            return (false);
        }
    });
    $('.btnnew').click(function () {
        nav_hotthreads(this.rel);
        $(".threadlist").html("<div class='loader'>&nbsp;" + "<" + "/div>");
        //alert(this.attr("rel"));
        return (false);
    });

    $('.firstbtn').click(function () {
        nav_hotthreads(this.rel);
        $(".threadlist").html("<div class='loader'>&nbsp;" + "<" + "/div>");
        //alert(this.attr("rel"));
        return (false);
    });



    /* onclick event calling in find-thread.php */

    $(document).on('click', '.btn-htread', function () {
        var catname = $(this).attr('data-catid');
        $('.btn-htread').removeClass('active');
        $(this).addClass('active');

        $("#war-htread").html("<div class='loader'>&nbsp;" + "<" + "/div>");
        var url = "<?php echo $base_url;?>?q=hot-thread/callback&catname=" + catname;
        $.ajax({
            cache: false,
            url: url,
            dataType: 'text',
            error: function (request, status, error) {
                $("#war-htread").html("<div>some error while fetching records...</div>");
            },
            success: function (data, status, request) {
                console.log(data);
                $('#war-htread').html(data);
            }
        });
    });



function showthread_bycat(cat)
                    {
                        $("ul#threadlist").html("<div class='loader'>&nbsp;"+"<"+"/div>");
                        var url = Drupal.settings.basePath  +'?q=hot-thread/callback';
                        url += "&catname="+cat;
                        //jQuery.url.setUrl(url);
                        $.ajax( 
                        {
                        cache: false,
                        url: url,
                        dataType: 'text',
                        error: function(request, status, error) 
                        {
                            alert(status);
                            //$('#container').html(request.responseText);
                        },
                        success: function(data, status, request) 
                        {
                            $('#ajax').html(data);
                        }
                        });
                }

</script>
