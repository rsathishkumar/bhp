<?php
$q_ht="SELECT node.title,node.changed,node.created,node.nid from node where node.status=1 and node.type='hot_threads' order by node.changed desc limit 0 ,15";
$res=@mysqli_query($q_ht);
$noft=mysqli_num_rows($res);
	if($noft>0)
		{
?>
<div class="homeThreads">
	<h4 class="TLR5">Hot Threads</h4>
	<div class="threadsList BLR5">
		<ul>
			<?php
			
					function truncatestringwithspace($text, $char_limit) 
					{
					$truncated = substr($text,0,@strpos($text,' ',$char_limit));
					if($truncated!='')
						{
						$truncated.="&hellip;";
						return $truncated;
						}
						else
						{
						$truncated = substr($text,0,@strpos($text,'.',$char_limit));
						if($truncated!='')
							{
						$truncated.="&hellip;";	
						return $truncated;
							}
							else
							{
						return false;		
							}
						}
					 } //
			while($d_thread=mysqli_fetch_array($res))
				{
					$furl=@mysqli_fetch_array(mysqli_query("select field_ht_forum_url from field_data_field_ht_forum where entity_id=".$d_thread['nid']));
					$nod_hot_thread=node_load($d_thread['nid']);
					$desc='';
					if(strlen($nod_hot_thread->title)>30)
					 	{
						if(truncatestringwithspace($nod_hot_thread->title,24)!=false)
							{
							$desc.= truncatestringwithspace($nod_hot_thread->title,24);
							}
							else
							{
							$desc.= $nod_hot_thread->title;
							}
						}
						else
							{
						$desc.= $nod_hot_thread->title;	
							}
							
						    /* $page = FALSE;
						    $nodecontent = node_build_content(node_load(array('nid' => $d_thread['nid'])), $view_mode = 'full', $page);
						   	$nodecontent->teaser = drupal_render($nodecontent->content);
						  	echo "Here ".$nodecontent->teaser;
						  	  print_r($nodecontent); */
						   
						     //echo "Here ".node_view(node_load(array('nid' => $nid)), $teaser, $page, FALSE);
					
					//previously it is checked by 33 charachter
					/*if(strlen($nod_hot_thread->title)>30)
					{
					$finddot=@strpos($nod_hot_thread->title,".",28);
					$findspcetostop=@strpos($nod_hot_thread->title," ",28);
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
						$desc = trim(substr($nod_hot_thread->title,0 , $pos));
					}
					else
					{
						$desc = $nod_hot_thread->title;
					}
					if(strlen($nod_hot_thread->title)>30)
					{
					if(strlen($desc)>28)
					{
						$desc = trim(substr($desc, 0, 28));
					}
					trim($desc.="&hellip;");
					}*/
					$restofind=@strstr($furl['field_ht_forum_url'],"http://");
					
			?>
			<li><a href="<?php if($restofind=='') { echo "http://";}echo $furl['field_ht_forum_url'];?>" target="_blank" onclick="updatethreadcounter('<?php  echo $furl['field_ht_forum_url'];?>','<?php echo $d_thread['nid'];?>');" title="<?php echo $nod_hot_thread->title;?>"><?php echo $desc;?></a></li>
			<?php
				}
			?>
		</ul>
		<div class="marR15 clearfix">
			<a title="More hot threads" href="/hot-threads" class="fright btnRight">
				<span>More Hot Threads</span>
			</a>
		</div><!-- marR15 -->
	</div><!-- threadsList -->
</div><!-- homeThreads -->
<?php
	}
?>
