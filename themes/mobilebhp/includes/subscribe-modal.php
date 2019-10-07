<?php
/**
 * Created by PhpStorm.
 * User: cliste2
 * Date: 28/09/16
 * Time: 5:07 PM
 */
?>

<section class="subscribe-modal">
        <div style="display: none;" id="subscribeModal" tabindex="-1" role="dialog" class="modal fade subscribe-popup">
          <div role="document" class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body"><a href="javascript:void(0)" class="text-center"><span class="circle"><i class="icon-mail"></i></span></a>
                <p>Sign up for Team-BHP's Weekly Newsletter...</p>
                <form id="mc_newsletter" action="//team-bhp.us4.list-manage.com/subscribe/post?u=10e084528b02b3c554ebf47a8&amp;id=39df29de53" method="post" name="mc_newsletter" class="mc_validate" novalidate>
                 <div class="forn-group">

                    <input type="email" value="" size="28" name="EMAIL" class="form-control text-center" id="mce-EMAIL" placeholder="Email Address">
                    </div>

                  <!--button-->
                    <div class="text-center">
                    <input type="submit" ripple-background="radial-gradient(red, yellow)" ripple-opacity="0.7" class="btn btn-red ripple btn-subscribe" value="Subscribe to List" name="subscribe" id="mc-embedded-subscribe">
                    </div>
                    </form>
              </div>
            </div>
          </div>
        </div>
</section>
