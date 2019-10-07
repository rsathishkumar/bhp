<!--<script type="text/javascript">	
(function ($) {
	$(function(){
		$(".newslist li").click(function(){
			 window.location=$(this).find('h2 a').attr('href');
		});
	});
})(jQuery);
	</script>-->
<?php
include_once("./themes/bhp/connect.php");
										$toshow =10;
										if(isset($_REQUEST['start']))
										{
											$start = $_REQUEST['start'];
										}
										else
										{
											$start = 0;
										}
/*$hotthread_res = @mysqli_query("SELECT node.title, node.changed,node.created, node.nid, field_data_field_ht_summary.field_ht_summary_value, field_data_field_ht_threads.field_ht_threads_value, file_managed.uri
FROM node, file_managed, field_data_field_ht_summary, field_data_field_ht_threads, field_data_field_ht_image
WHERE field_data_field_ht_threads.entity_id = node.nid
AND file_managed.fid = field_data_field_ht_image.field_ht_image_fid
AND node.status =1
AND field_data_field_ht_threads.field_ht_threads_value = 'All Time Favourites' AND field_data_field_ht_image.entity_id = node.nid AND field_data_field_ht_summary.entity_id = field_data_field_ht_threads.entity_id AND field_data_field_ht_summary.entity_id=field_data_field_ht_threads.entity_id 
group by node.nid ORDER BY node.changed DESC limit ".$start.", ".$toshow."") or die(mysql_error());
										
										//$total_res = @mysqli_query("SELECT node.title, node.nid,field_data_field_ht_summary.field_ht_summary_value,file_managed.uri FROM node, file_managed,field_data_field_ht_summary, field_data_field_ht_threads, field_data_field_ht_image WHERE field_data_field_ht_threads.entity_id = node.nid AND file_managed.fid = field_data_field_ht_image.field_ht_image_fid AND node.status =1 AND field_data_field_ht_threads.field_ht_threads_value = 'All Time Favourites' AND field_data_field_ht_image.entity_id = node.nid AND field_data_field_ht_summary.entity_id=field_data_field_ht_threads.entity_id AND field_data_field_ht_summary.entity_id = field_data_field_ht_threads.entity_id and field_data_field_ht_summary.entity_id=node.nid group by node.nid ORDER BY node.changed DESC ") or die(mysql_error());*/
if($_GET['catname']=='')
		{
$hotthread_res = @mysqli_query("SELECT node.title,node.changed,node.created,node.nid,field_data_field_ht_summary.field_ht_summary_value,field_data_field_ht_threads.field_ht_threads_value,file_managed.uri,field_data_field_ht_forum.field_ht_forum_url,field_data_field_ht_author.field_ht_author_value as author
FROM node,file_managed,field_data_field_ht_forum,field_data_field_ht_summary,field_data_field_ht_threads,field_data_field_ht_image,field_data_field_ht_author
WHERE field_data_field_ht_threads.entity_id = node.nid
AND file_managed.fid = field_data_field_ht_image.field_ht_image_fid AND node.status=1 AND field_data_field_ht_image.entity_id=node.nid AND field_data_field_ht_summary.entity_id = field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_forum.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_author.entity_id group by node.nid ORDER BY node.changed DESC limit ".$start.", ".$toshow."") or die(mysql_error());
								
		}
		else
		{
$hotthread_res = @mysqli_query("SELECT node.title,node.changed,node.created,node.nid,field_data_field_ht_summary.field_ht_summary_value,field_data_field_ht_threads.field_ht_threads_value,file_managed.uri,field_data_field_ht_forum.field_ht_forum_url,field_data_field_ht_author.field_ht_author_value as author
FROM node,file_managed,field_data_field_ht_forum,field_data_field_ht_summary,field_data_field_ht_threads,field_data_field_ht_image,field_data_field_ht_author
WHERE field_data_field_ht_threads.entity_id = node.nid AND field_data_field_ht_threads.field_ht_threads_value ='".$_GET['catname']."' AND file_managed.fid = field_data_field_ht_image.field_ht_image_fid AND node.status=1 AND field_data_field_ht_image.entity_id=node.nid AND field_data_field_ht_summary.entity_id = field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_forum.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_author.entity_id group by node.nid ORDER BY node.changed DESC limit ".$start.", ".$toshow."") or die(mysql_error());		
		}
if($_GET['catname']=='')
		{
										$total_res = @mysqli_query("SELECT node.title,field_data_field_ht_forum.field_ht_forum_url, node.nid,field_data_field_ht_summary.field_ht_summary_value,file_managed.uri,field_data_field_ht_author.field_ht_author_value as author FROM node, file_managed,field_data_field_ht_summary,field_data_field_ht_forum,field_data_field_ht_threads, field_data_field_ht_image, field_data_field_ht_author WHERE field_data_field_ht_threads.entity_id = node.nid AND file_managed.fid=field_data_field_ht_image.field_ht_image_fid AND node.status=1 AND field_data_field_ht_author.entity_id=field_data_field_ht_forum.entity_id AND field_data_field_ht_image.entity_id = node.nid AND field_data_field_ht_summary.entity_id = field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id = field_data_field_ht_threads.entity_id AND field_data_field_ht_summary.entity_id=node.nid group by node.nid ORDER BY node.changed DESC") or die(mysql_error());
										
            }
else
           {
$total_res = @mysqli_query("SELECT node.title,field_data_field_ht_forum.field_ht_forum_url, node.nid,field_data_field_ht_summary.field_ht_summary_value,file_managed.uri,field_data_field_ht_author.field_ht_author_value as author FROM node, file_managed,field_data_field_ht_summary,field_data_field_ht_forum,field_data_field_ht_threads, field_data_field_ht_image, field_data_field_ht_author WHERE field_data_field_ht_threads.entity_id = node.nid AND file_managed.fid=field_data_field_ht_image.field_ht_image_fid AND node.status=1 AND field_data_field_ht_author.entity_id=field_data_field_ht_forum.entity_id AND field_data_field_ht_image.entity_id = node.nid AND field_data_field_ht_summary.entity_id = field_data_field_ht_threads.entity_id AND field_data_field_ht_threads.field_ht_threads_value = '".$_GET['catname']."' AND field_data_field_ht_author.entity_id = field_data_field_ht_threads.entity_id AND field_data_field_ht_summary.entity_id=node.nid group by node.nid ORDER BY node.changed DESC") or die(mysql_error());
           }
 $total_rows=@mysqli_num_rows($total_res);
//function to format date in 'xx days ago'
function returnDate($querydate){ 

$minusdate = date('ymdHi') - date("ymdHi", $querydate);

if($minusdate > 88697640 && $minusdate < 100000000){ 
    $minusdate = $minusdate - 88697640; 
} 

    switch ($minusdate) { 

        case ($minusdate < 99): 
                    if($minusdate == 1){ 
                        $date_string = '1 minute ago'; 
                    } 
                    elseif($minusdate > 59){ 
                        $date_string =  ($minusdate - 40).' minutes ago'; 
                    } 
                    elseif($minusdate > 1 && $minusdate < 59){ 
                        $date_string = $minusdate.' minutes ago'; 
                    } 
        break; 

        case ($minusdate > 99 && $minusdate < 2359): 
                    $flr = floor($minusdate * .01); 
                    if($flr == 1){ 
                        $date_string = '1 hour ago'; 
                    } 
                    else{ 
                        $date_string =  $flr.' hours ago'; 
                    } 
        break; 
        
        case ($minusdate > 2359 && $minusdate < 310000): 
                    $flr = floor($minusdate * .0001); 
                    if($flr == 1 || $flr == 0){ 
                        $date_string = '1 day ago'; 
                    } 
                    else{ 
                        $date_string =  $flr.' days ago'; 
                    } 
        break; 
        
        case ($minusdate > 310001 && $minusdate < 12320000): 
                    $flr = floor($minusdate * .000001); 
                    if($flr == 1 || $flr == 0){ 
                        $date_string = "1 month ago"; 
                    } 
                    else{ 
                        $date_string =  $flr.' months ago'; 
                    } 
        break; 
        
        case ($minusdate > 100000000): 
                $flr = floor($minusdate * .00000001); 
                if($flr == 1 || $flr == 0){ 
                        $date_string = '1 year ago.'; 
                } 
                else{ 
                        $date_string = $flr.' years ago'; 
                } 
        } 
    return $date_string; 
}										
?>
<div class="article">
<h1>Hot Threads</h1>
							<div id="ajax">
						   <div class="compareBox active">
									<div class="campareBar">
										<h3><?php if($_GET['catname']=='') {?>All<?php } else { echo $_GET['catname'];}?></h3>
									</div>
							</div>
							
							<div class="tab_container BLR5 marB10">								
								<div style="display: block;" class="tab_content">
									<ul class="newslist" id="threadlist">
										<?php
											if($total_rows>0)
													{
											while($d_thread=mysqli_fetch_array($hotthread_res))
														{
												 $restofind=strstr($d_thread['field_ht_forum_url'],"http://");
												 $noaddata=node_load($d_thread['nid']);

												?>
										<li>
											<div class="clearfix listHolder">
												<div class="fleft w170">
													<!--<a title="<?php echo $d_thread['title']; ?>"  href="Javascript:void(0);" onclick="updatethreadcounter('<?php if($restofind=='') { echo "http://";} echo $d_thread['field_ht_forum_url'];?>','<?php echo $d_thread['nid'];?>');">
														<img width="165" height="124" alt="<?php echo  $noaddata->title;?>" src="sites/default/files/<?php echo str_replace("public://","",$d_thread['uri']);?>"> 
                                                    <img width="165" height="124" alt="<?php echo  $noaddata->title;?>" src="http://www.team-bhp.com/?q=sites/default/files/styles/medium_medium/public/<?php echo str_replace("public://","",$d_thread['uri']);?>">
													</a>-->
													<a class="holderImg" title="<?php echo $d_thread['title']; ?>"  href="<?php if($restofind=='') { echo "http://";} echo $d_thread['field_ht_forum_url'];?>" target="_blank" onclick="return updatethreadcounter('<?php if($restofind=='') { echo "http://";} echo $d_thread['field_ht_forum_url'];?>','<?php echo $d_thread['nid'];?>');">
<strong>
														<img alt="<?php echo  $noaddata->title;?>" src="http://www.team-bhp.com/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$d_thread['uri']);?>"></strong>
													</a>
												</div><!-- News thum holder -->
												
												<div class="fright w460 ShortNews">
													<h2><a title="<?php echo $noaddata->title;?>"  href="<?php if($restofind=='') { echo "http://";} echo $d_thread['field_ht_forum_url'];?>" target="_blank" onclick="return updatethreadcounter('<?php if($restofind=='') { echo "http://";} echo $d_thread['field_ht_forum_url'];?>','<?php echo $d_thread['nid'];?>');"><?php  echo $noaddata->title;?></a></h2>
													<div class="postDate">Posted <?php //echo returnDate($d_thread['changed']); ?> by: <?php echo $d_thread['author']; ?></div>
													<div class="past_shornote">
														<?php if(strlen($noaddata->field_ht_summary['und'][0]['value'])>195)
															{
															$finddot=@strpos($noaddata->field_ht_summary['und'][0]['value'],".",195);
															$findspcetostop=@strpos($noaddata->field_ht_summary['und'][0]['value']," ",195);
															if(intval($finddot)<intval($findspcetostop) && intval($finddot)>1)
																{
																$pos=$finddot;
																}
															else
																{
																$pos=$findspcetostop;
																}
																$pos=$pos+1;
															 }
															if($pos>1)
															{
																$desc = trim(substr($noaddata->field_ht_summary['und'][0]['value'],0 , $pos));
															}
															else
															{
																$desc = $noaddata->field_ht_summary['und'][0]['value'];
															}
															if(strlen($noaddata->field_ht_summary['und'][0]['value'])>200)
															{
															//trim($desc.="<a href='".url('node/'.$d_advice['nid'])."'>"."&hellip;"."</a>");
															
															$ex_url='';
															if($restofind=='') 
																{ 
																 $ex_url.="http://";
																}
																$ex_url.=$d_thread['field_ht_forum_url'];
															//trim($desc.="<a href='".$ex_url."'>"."&hellip;"."</a>");
															}
															if(strlen($noaddata->field_ht_summary['und'][0]['value'])>200)
																{
															//echo $desc."<a href='".$ex_url."'>"."&hellip;"."</a>";
                                                                                                                        echo $desc."&hellip;";
                                                                                                                      //  echo $desc;
																}
																else
																{
																echo $desc;
																} ?>
													</div>
												</div><!-- w460 -->
											</div><!-- List holder  -->
										</li><!-- thread list -->
										<?php
													}
												}
												else
												{
												
											?>
										<li>
											<div class="clearfix listHolder">
												
												
												<div class="fright w460 ShortNews">
													<h2>No Thread Found</a></h2>
													
												
												</div><!-- w460 -->
											</div><!-- List holder  -->
										</li><!-- thread list -->
										<?php
												}
										?>
									
									</ul>
								</div>																
							</div><!-- tab content -->
							
							<?php
							if($total_rows>$toshow)
							{
							?>
							<div class="marT10 clearfix">
								<div class="clearfix w100p">
									<a class="btnLeft fleft btnLeftDisabled" href="#" onclick="return false;">
										<span>Newer</span>
									</a>
	
										<ul class="pagination">
											<!--<li class="first disable"><a title="go to previews 10 results" href="#">…</a></li>-->
											<?php
												$j=1;
											for($i=0; $i<$total_rows; $i=$i+$toshow)
												{
												if($i==$start)
													{
														$c = "class=\"active\"";
													}
												else if(($start==0) && ($j==1))
													{
														$c = "class=\"active\"";
													}
												else
													{
														$c = "";
													}
											?>
												<li><a title="go to page <?php echo $j; ?>"<?php echo $c; ?> href="i=<?php echo $i; ?>&catname=%" onclick="<?php if($c=="") { ?>nav_hotthreads(this); <?php } ?>return false;"><?php echo $j; ?></a></li>
											<?php
											$j++;
												}
	$next = $start+$toshow;
											?>
											<!--<li class="first"><a title="go to next 10 results" href="#">…</a></li>-->
											</ul>
											<a class="btnRight fright rPos"  href="i=<?php echo $next; ?>&catname=All" onclick="nav_hotthreads(this); return false;">
												<span>Older</span>
											</a>
									</div>	
							</div>
							<?php
							}
							?>
						</div> <!-- End of ajax -->
						</div>
