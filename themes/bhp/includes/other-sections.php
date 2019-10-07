<?php
	$linkPage = '';
	$Page_Title = '';
  if (arg(0) == 'node' && is_numeric(arg(1))) {
    $nid = arg(1);
    $node = node_load(array('nid' => $nid));
    }
    if($nid==9)
    {
    	$linkPage = '/advice';
    	$Page_Title = 'Advice';
    }
    else  if($nid==12)
    {
    	$linkPage = '/tech-stuff';
    	$Page_Title = 'Tech Stuff';
    }
  ?>
  
<div class="roundAll5 marB10 OtherSections clearfix">
	<h4>Other Sections</h4>
	<ul>
		<?php if($nid==19)
		 {
		?>
		<li><a href="/advice" class="<?php if($nid== 9 || $nid== 12) { echo " active"; }  ?>" title="Advice"><span class="adviceicon">Advice</span></a></li>
		<?php
		 }
		?>
		<li><a href="/safety" class="<?php if($nid=='19') { echo " active"; }  ?>" title="Road Safety"><span class="safetyIcon">Road Safety</span></a></li>
		<li><a href="/abbreviations" class="BLR5<?php if($nid=='46') { echo " active"; }  ?>" title="Glossary"><span class="glossaryIcon">Glossary</span></a></li>
	</ul>
</div><!-- most viewed -->
