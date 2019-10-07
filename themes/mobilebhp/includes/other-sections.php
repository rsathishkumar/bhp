<?php
$linkPage = '';
$Page_Title = '';
   $nid = arg(1);

if (arg(0) == 'node' && is_numeric(arg(1))) {
    $nid = arg(1);
    $node = node_load(array('nid' => $nid));
    //echo "<pre>"; print_r($node);echo "</pre>";
}
if ($nid == 9) {
    $linkPage = '/advice';
    $Page_Title = 'Advice';
} else if ($nid == 12) {
    $linkPage = '/tech-stuff';
    $Page_Title = 'Tech Stuff';
}
?>

<div class="home-services only-2">
    <ul>

            <li class="<?php if ($nid == 19 || $nid == 12 || $nid == 46) {echo "active";} ?>">
                <a href="/advice" class="text-center" title="Advice">
                    <span class="circle">
                        <i class="icon-bulb"></i>
                    </span>
                    <span class="text text-center">Advice</span>
                </a>
            </li>


        <li class="<?php if ($nid == 12 || $nid == 9 || $nid == 46) {echo "active";} ?>">
            <a href="/safety" class="text-center">
                <span class="circle">
                    <i class="icon-roadsafety"></i>
                </span>
                <span class="text text-center">ROAD SAFETY</span>
            </a>

        </li>


<!--        <li class="--><?php //if ($nid == 9 || $nid == 19 ) {echo " active";} ?><!--">-->
<!--            <a href="/abbreviations" class="text-center" title="Glossary">-->
<!--                <span class="circle">-->
<!--                    <i class="icon-glossary"></i>-->
<!--                </span>-->
<!--                <span class="text text-center">Glossary</span>-->
<!--            </a>-->
<!--        </li>-->

        <li class="<?php if ($nid == 9 || $nid == 19 ) {echo " active";} ?>">
            <a href="/tech-stuff" class="text-center" title="Tech Stuff">
                <span class="circle">
                    <i class="icon-tools"></i>
                </span>
                <span class="text text-center">Tech Stuff</span>
            </a>
        </li>

    </ul>
</div><!-- most viewed -->
