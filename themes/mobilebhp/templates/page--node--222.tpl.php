<!-- page node tpl for contact us -->
<div class="page-wrapper">

<!--    contact us 222-->
<!--header-->
<?php include(drupal_get_path('theme', 'mobilebhp').'/templates/header.tpl.php'); ?>

	<h1>Contact Us</h1>
	<div class="container-fluid">
        <div id="accordion" role="tablist" aria-multiselectable="true" class="panel-group contact-group">
            <div class="panel panel-default contact-panel">
                <div id="collapseOne" role="tabpanel" class="panel-collapse">
                    <div class="panel-body text-center">
                        <div class="social-circle text-center"><span class="circle"><i class="icon-letter"></i></span></div>
<!--                        <p>Found anything interesting to share with the BHPians?</p>-->
                        <p>Share scoops &amp; insider information with other enthusiasts. 100&#37; confidentiality assured.</p>
                        <div class="share-expanded contact-expanded">
<!--                            <p>Whether facts, scoops or any news relevant to Indian cars, we'd be happy to publish it on Team-BHP if it is of value to the car community.</p>-->
<!--                            <p>Team-BHP is incredibly serious about maintaining your privacy; do include a mention whether you prefer to remain anonymous or be duly credited.</p>-->
<!--                            <p>Write us at <a href="mailto:share@team-bhp.com">share@team-bhp.com</a> along with pictures</p>-->

                            <p>If you'd like to share any information on the Indian car scene with other enthusiasts, please send an email
                                (with pictures etc.) to <a href="mailto:share@team-bhp.com">share@team-bhp.com</a>. We welcome scoops &amp; news relevant to Indian cars.
                            </p>
                            <p>Team-BHP is <strong>incredibly serious</strong> about maintaining your privacy; do include a mention of whether you prefer to remain anonymous or be duly credited in the article. If anonymous, <strong>only GTO</strong> will know your identity.</p>
                            <p>Should you provide an interesting automotive product or service, email us full details on <a href="mailto:share@team-bhp.com">share@team-bhp.com</a>. If it is of value to our readers, we will publish the same on Team-BHP.</p>
                            <p>Thanks for sharing!</p>

                        </div>
                        <!--//button-->
                        <button type="button" ripple-background="radial-gradient(red, yellow)" ripple-opacity="0.7" data-toggle="collapse" data-parent="#accordion" id="#collapseOne" aria-controls="collapseOne" aria-expanded="false" class="btn btn-red ripple btn-contact">Share</button>
                    </div>
                </div>
            </div>
<!-- -->
            <div class="panel panel-default contact-panel">
                <div id="collapseTwo" role="tabpanel" class="panel-collapse">
                    <div class="panel-body text-center">
                        <div class="social-circle text-center"><span class="circle"><i class="icon-advertise"></i></span></div>
                        <p>Advertise your brand on India&#39;s best car website!</p>
                        <div class="advertise-expanded contact-expanded">
<!--                            <p>Team-BHP enjoys a unique position in the automotive domain, owing to its thoroughly unbiased car reviews & opinions, and the passionate clan of petrol-head members. It is this love for cars that has brought us together as India's foremost online community.</p>-->
<!--                            <p>Please note that Team-BHP does NOT permit any advertisements from car manufacturers.This rule has been in place since Team-BHP’s inception, and is crucial to our impartial opinions on the industry.</p>-->
<!--                            <p>Write us at <a href="mailto:advertising@team-bhp.com">advertising@team-bhp.com</a> to know about the available options</p>-->

                            <p>Thank you for your interest in advertising with the Definitive resource on the Indian Car Scene.</p>
                            <p>Team-BHP enjoys a unique position in the automotive domain, owing to its thoroughly unbiased car reviews &amp; opinions, and the passionate clan of petrol-head members. It is this love for cars that has brought us together as India's foremost online community.</p>


            <p>Please note that Team-BHP does NOT permit any car advertisements. This rule has been in place since Team-BHP’s inception, and is crucial to our impartial opinions on the industry.</p>

            <p>Email us at <a href="mailto:advertising@team-bhp.com">advertising@team-bhp.com</a> to know more about the advertising options available on Team-BHP.</p>


            <!--                <p>Please note that Team-BHP does NOT permit any advertisements from car manufacturers. This rule has been in place since Team-BHP’s inception, and is crucial to our impartial opinions on the industry.</p>
                            <p>Email us at <a href="mailto:advertising@team-bhp.com">advertising@team-bhp.com</a> to know more about the advertising options available on Team-BHP.</p>-->

                        </div>
                        <!--button-->
                        <button type="button" ripple-background="radial-gradient(red, yellow)" ripple-opacity="0.7" data-toggle="collapse" data-parent="#accordion" id="#collapseTwo" aria-controls="collapseTwo" aria-expanded="false" class="btn btn-red ripple btn-contact">Advertise</button>
                    </div>
                </div>
            </div>
<!-- -->
            <div class="panel panel-default contact-panel">
                <div id="collapseThree" role="tabpanel" class="panel-collapse">
                    <div class="panel-body text-center">
                        <div class="social-circle text-center"><span class="circle"><i class="icon-write"></i></span></div>
                        <p>Write to us with compliments, suggestions &amp; concerns. We&#39;re all ears.</p>
                        <div class="write-expanded contact-expanded">
<!--                            <p>Fill the form below and we&#39;ll get in touch with you!</p>-->
                            <p>&nbsp;</p>
                            <?php include_once("./themes/mobilebhp/basicpage-speak.php"); ?>
                        </div>
                        <!--button-->
                        <button type="button" ripple-background="radial-gradient(red, yellow)" ripple-opacity="0.7" data-toggle="collapse" data-parent="#accordion" id="#collapseThree" aria-controls="collapseThree" aria-expanded="false" class="btn btn-red ripple btn-contact">Write Us</button>
                    </div>
                </div>
            </div>

        </div>

      </div>
	
	


<?php include(drupal_get_path('theme', 'mobilebhp').'/templates/footer.tpl.php'); ?>

</div>
