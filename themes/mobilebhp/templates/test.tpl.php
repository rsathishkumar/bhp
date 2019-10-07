<div id="page-wrapper">#####page front

    <div id="page" class="page pageWithSlide clearfix">

        <div id="leftPage" class="fleft">
            <div id="header" class="<?php print $secondary_menu ? 'with-secondary-menu': 'without-secondary-menu'; ?>">
                <div class="section clearfix">



                    <?php if ($site_name || $site_slogan): ?>
                        <div id="name-and-slogan"<?php if ($hide_site_name && $hide_site_slogan) { print ' class="element-invisible"'; } ?>>

                            <?php if ($site_name): ?>

                                <?php //print $site_name; ?>



                            <?php endif; ?>


                        </div>
                    <?php endif; ?>

                    <?php print render($page['header']); ?>

                    <?php //include_once("././themes/mobilebhp/includes/common/navigation.php"); ?>



                </div><!-- section -->
            </div> <!--  /#header -->
            <?php if ($messages): ?>
                <div id="messages"><div class="section clearfix">
                        <?php print $messages; ?>
                    </div></div> <!-- /.section, /#messages -->
            <?php endif; ?>

            <?php if ($page['featured']): ?>
                <div id="featured"><div class="section clearfix">
                        <?php print render($page['featured']); ?>
                    </div></div> <!-- /.section, /#featured -->
            <?php endif; ?>

            <div id="container" class="clearfix roundAll3">
                <!--<?php if ($breadcrumb): ?>
				  <div id="breadcrumb"><?php print $breadcrumb; ?></div>
				<?php endif; ?>-->

                <div id="content" class="column">
                    <div class="section">
                        <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
                        <a id="main-content"></a>
                        <?php print render($title_prefix); ?>
                        <!--<?php if ($title): ?>
					<h1 class="title" id="page-title">
					  <?php print $title; ?>
					</h1>
				  <?php endif; ?>-->
                        <?php print render($title_suffix); ?>
                        <?php if ($tabs): ?>
                            <div class="tabs">
                                <?php print render($tabs); ?>
                            </div>
                        <?php endif; ?>
                        <?php print render($page['help']); ?>
                        <?php if ($action_links): ?>
                            <ul class="action-links">
                                <?php print render($action_links); ?>
                            </ul>
                        <?php endif; ?>
                        <?php print render($page['content']); ?>
                        <?php //print $feed_icons; ?>
                    </div><!-- section -->
                </div> <!-- /#content -->

                <?php if ($page['sidebar_first']): ?>
                    <div id="sidebar-first" class="column sidebar">
                        <div class="section">
                            <?php print render($page['sidebar_first']); ?>
                        </div>
                    </div> <!-- /.section, /#sidebar-first -->
                <?php endif; ?>

            </div><!--  /#container -->

            <?php if ($page['triptych_first'] || $page['triptych_middle'] || $page['triptych_last']): ?>
                <div id="triptych-wrapper"><div id="triptych" class="clearfix">
                        <?php print render($page['triptych_first']); ?>
                        <?php print render($page['triptych_middle']); ?>
                        <?php print render($page['triptych_last']); ?>
                    </div></div> <!-- /#triptych, /#triptych-wrapper -->
            <?php endif; ?>
            <div id="footer-wrapper">
                <div class="section">
                    <?php if ($page['footer_firstcolumn'] || $page['footer_secondcolumn'] || $page['footer_thirdcolumn'] || $page['footer_fourthcolumn']): ?>
                        <div id="footer-columns" class="clearfix">
                            <?php print render($page['footer_firstcolumn']); ?>
                            <?php print render($page['footer_secondcolumn']); ?>
                            <?php print render($page['footer_thirdcolumn']); ?>
                            <?php print render($page['footer_fourthcolumn']); ?>
                        </div> <!-- /#footer-columns -->
                    <?php endif; ?>

                    <?php if ($page['footer']): ?>
                        <?php print "@@@@".render($page['footer']); ?>
                        <?php include_once("././themes/mobilebhp/includes/common/footer.php"); ?>
                    <?php endif; ?>
                </div><!-- section -->
            </div> <!--  /#footer-wrapper -->
        </div><!-- left page -->

        <?php if ($page['sidebar_second']): ?>
            <div id="sidebar-second" class="column sidebar"><div class="section">
                    <?php print render($page['sidebar_second']); ?>
                </div></div> <!-- /.section, /#sidebar-second -->
        <?php endif; ?>
    </div> <!-- /#page, /#page-wrapper -->
</div><!-- page wrapper -->
