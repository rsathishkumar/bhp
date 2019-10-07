<?php

?>

<!--overview - 11-->
<!--team - 15-->
<!--philosophy - 17-->
<!--history - 18-->
<!--features -  3592-->

<style>
    .home-services li {
        display: none;
    }
    .home-services li.active {
        display: block;
    }
</style>

<section class="home-services">
    <div class="container-fluid">
        <h4 class="section-title text-center"><span>Also See</span></h4>
        <ul>
            <li class="<?php if ($nid == 15 || $nid == 17 || $nid == 18 || $nid == 3592) {echo "active";} ?>">
                <a href="/aboutus/team" class="text-center"><span class="circle"><i
                            class="icon-overview"></i></span><span class="text text-center">Overview</span></a></li>
            <li class="<?php if ($nid == 11 || $nid == 17 || $nid == 18 || $nid == 3592) {echo "active";} ?>">
                <a href="/aboutus/team" class="text-center"><span class="circle"><i
                            class="icon-team"></i></span><span class="text text-center">Team</span></a></li>
            <li class="<?php if ($nid == 15 || $nid == 17 || $nid == 18 || $nid == 11) {echo "active";} ?>">
                <a href="/aboutus/key-features" class="text-center"><span class="circle"><i
                            class="icon-features"></i></span><span
                        class="text text-center">Features</span></a></li>
            <li class="<?php if ($nid == 15 || $nid == 11 || $nid == 18 || $nid == 3592) {echo "active";} ?>">
                <a href="/aboutus/philosophy" class="text-center"><span class="circle"><i
                            class="icon-philosophy"></i></span><span
                        class="text text-center">Philosophy</span></a></li>
            <li class="<?php if ($nid == 15 || $nid == 17 || $nid == 11 || $nid == 3592) {echo "active";} ?>">
                <a href="/aboutus/history" class="text-center"><span class="circle"><i
                            class="icon-history"></i></span><span class="text text-center">History</span></a></li>

        </ul>
    </div>
</section>