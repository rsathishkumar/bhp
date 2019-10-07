<?php
  if (arg(0) == 'node' && is_numeric(arg(1))) {
    $nid = arg(1);
    $node = node_load(array('nid' => $nid));
    }
  ?>
  
<div class="roundAll5 marB10 OtherSections clearfix">
	<h4>Other Sections</h4>
	<ul>
		<li><a href="/safety" class="<?php if(($nid=='19') or ($node->type=='safety')) { echo " active"; }  ?>" title="Safety"><span class="safetyIcon">Safety</span></a></li>
		<li><a href="/glossary" class="BLR5<?php if($_GET['q']=='node/45') { echo " active"; }  ?>" title="Glossary"><span class="glossaryIcon">Glossary</span></a></li>
	</ul>
</div><!-- most viewed -->
