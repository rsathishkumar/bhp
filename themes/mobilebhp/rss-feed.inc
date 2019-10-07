<?php
header("Content-type: application/xml");
?>
<rss xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" version="2.0">
  <channel>
    <title>Team-BHP : News</title>
    <link>http://<?php echo $_SERVER['SERVER_NAME']; ?>rss-feed</link>
    <description>Team-BHP latest news and hot threads</description>
    <pubDate>Fri, 08 Feb 2013 14:01:02 GMT</pubDate>
    <generator>Team-BHP</generator>
    <language>en</language>
    <?php
    require_once("./themes/mobilebhp/connect.php");
	$limit = 30;
	$newsRes = mysqli_query("select node.nid as nid, node.created as created, title, field_news_content_value from node,field_data_field_news_content where type='news' and node.nid=field_data_field_news_content.entity_id and node.status=1 order by node.created desc limit 0,".$limit) or die(mysql_error());
    $newsRows = @mysqli_num_rows($newsRes);
    if($newsRows>0)
    {
    	while($newsRow = mysqli_fetch_array($newsRes))
    	{
    		$newsNode = node_load($newsRow['nid']);
    		$newsTitle = $newsRow['title'];
    		$newsURL  = "http://".$_SERVER['SERVER_NAME'].url('node/'.$newsRow['nid']);
    		//$newsDesc  = htmlspecialchars($newsRow['field_news_content_value']);
    		$newsDesc  = $newsNode->field_news_content['und'][0]['safe_value'];
    		$newsDate  = date("D, d M Y H:i:s", $newsRow['created'])." +0000";
    		$newsImage = "http://".$_SERVER['SERVER_NAME']."?q=sites/default/files/styles/check_extra_large_for_review/public/".str_replace("public://","",$newsNode->field_news_images['und'][0]['uri']);
    ?>
		<item>
		  <title><![CDATA[<?php echo $newsTitle; ?>]]></title>
		  <link><![CDATA[<?php echo $newsURL; ?>]]></link>
		  <description><![CDATA[<?php echo $newsDesc; ?>]]></description>
		  <category domain="http://<?php echo $_SERVER['SERVER_NAME']; ?>/news">news</category>
		  <pubDate><?php echo $newsDate; ?></pubDate>
		  <author>Team-BHP</author>
		  <image>
			<url><![CDATA[<?php echo $newsImage; ?>]]></url>
			<title><![CDATA[<?php echo $newsTitle; ?>]]></title>
			<link><![CDATA[<?php echo $newsURL; ?>]]></link>
		  </image>
		  <guid><![CDATA[<?php echo $newsURL; ?>]]></guid>
		</item>
    <?php
    	}
    }
    /*
    $hotRes = mysqli_query("SELECT node.title,node.created,node.nid,field_data_field_ht_summary.field_ht_summary_value,file_managed.uri,field_data_field_ht_forum.field_ht_forum_url FROM node,file_managed,field_data_field_ht_forum,field_data_field_ht_summary,field_data_field_ht_threads,field_data_field_ht_image,field_data_field_ht_author WHERE field_data_field_ht_threads.entity_id = node.nid AND file_managed.fid = field_data_field_ht_image.field_ht_image_fid AND node.status=1 AND field_data_field_ht_image.entity_id=node.nid AND field_data_field_ht_summary.entity_id = field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_forum.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_author.entity_id group by node.nid ORDER BY node.created DESC limit 0, ".$limit);
    $hotRows = @mysqli_num_rows($hotRes);
    if($hotRows>0)
    {
    	while($hotRow = mysqli_fetch_array($hotRes))
    	{
    		$hotNode = node_load($hotRow['nid']);
    		$hotTitle = $hotRow['title'];
    		$hotURL = $hotRow['field_ht_forum_url'];
    		//$hotDesc = htmlspecialchars($hotRow['field_ht_summary_value']);
    		$hotDesc = $hotNode->field_ht_summary_value['und'][0]['safe_value'];
    		$hotDate = date("D, d M Y H:i:s", $hotRow['created'])." +0000";
    		$hotImage = "http://".$_SERVER['SERVER_NAME']."?q=sites/default/files/styles/check_extra_large_for_review/public/".str_replace("public://","",$hotNode->field_ht_image['und'][0]['uri']);
    ?>
		<item>
		  <title><![CDATA[<?php echo $hotTitle; ?>]]></title>
		  <link><![CDATA[<?php echo $hotURL; ?>]]></link>
		  <description><![CDATA[<?php echo $hotDesc; ?>]]></description>
		  <category domain="http://<?php echo $_SERVER['SERVER_NAME']; ?>/hot-threads">hot-threads</category>
		  <pubDate><?php echo $hotDate; ?></pubDate>
		  <author>Team-BHP</author>
		  <image>
			<url><![CDATA[<?php echo $hotImage; ?>]]></url>
			<title><![CDATA[<?php echo $hotTitle; ?>]]></title>
			<link><![CDATA[<?php echo $hotURL; ?>]]></link>
		  </image>
		  <guid><![CDATA[<?php echo $hotURL; ?>]]></guid>
		</item>
    <?php
    	}
    }*/
    ?>
  </channel>
</rss>
