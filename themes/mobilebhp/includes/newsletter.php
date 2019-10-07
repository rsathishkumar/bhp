<?php
@session_start();
$sql_chk_email=@mysqli_query("select * from subscribefornewsletter where session_id='".session_id()."'");

?>


<!--<script type="text/javascript">-->
<!--	function ValidateEmail(inputText)-->
<!--	{-->
<!--		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;-->
<!--		if(inputText.value.match(mailformat))-->
<!--		{-->
<!--			document.mc_newsletter.EMAIL.focus();-->
<!--			return true;-->
<!--		}-->
<!--		else-->
<!--		{-->
<!--			alert("You have entered an invalid email address!");-->
<!--			document.mc_newsletter.EMAIL.focus();-->
<!--//			return false;-->
<!--			inputText.stopPropagation();-->
<!---->
<!--			$('.form-control').addClass('has-error');-->
<!--		}-->
<!--	}-->
<!--</script>-->

<!--subscribe section-->

<?php
@session_start();
$sql_chk_email=@mysqli_query("select * from subscribefornewsletter where session_id='".session_id()."'");


?>


<section class="home-subscribe">
        <div class="container-fluid">
          <div class="well social-well text-center btn-absol-btm subscribe-wrapper">
            <div class="social-circle text-center"><span class="circle"><i class="icon-mail"></i></span></div>
            <h4>Newsletter</h4>
            <p>Get your weekly dose of the Indian Car Scene</p>
            <!--button-->
            <button type="button" ripple-background="radial-gradient(red, yellow)" ripple-opacity="0.7" class="btn btn-red ripple subscribe">Subscribe Now</button>
<!--            <div>-->
<!--                <a class="unsubscribeLink" href="/unsubscribenews">-->
<!--                    <small>Unsubscribe</small>-->
<!--                </a>-->
<!--            </div>-->
          </div>
        </div>
    </section>




<!--<section class="subscribe-modal">-->
<!--        <div style="display: none;" id="subscribeModal" tabindex="-1" role="dialog" class="modal fade subscribe-popup">-->
<!--          <div role="document" class="modal-dialog">-->
<!--            <div class="modal-content">-->
<!--              <div class="modal-body"><a href="javascript:void(0)" class="text-center"><span class="circle"><i class="icon-mail"></i></span></a>-->
<!--                <p>Sign up for Team-BHP's Weekly Newsletter...</p>-->
<!--                <form id="mc_newsletter" action="//team-bhp.us4.list-manage.com/subscribe/post?u=10e084528b02b3c554ebf47a8&amp;id=39df29de53" method="post" name="mc_newsletter" class="mc_validate" novalidate>-->
<!--                 <div class="forn-group">-->
<!--               -->
<!--                    <input type="email" value="" size="28" name="EMAIL" class="form-control text-center" id="mce-EMAIL" placeholder="Email Address">-->
<!--                    </div>-->
<!---->
<!--                  <!--button-->
<!--                    <div class="text-center">-->
<!--                    <input type="submit" ripple-background="radial-gradient(red, yellow)" ripple-opacity="0.7" class="btn btn-red ripple btn-subscribe" value="Subscribe to List" name="subscribe" id="mc-embedded-subscribe">-->
<!--                    </div>-->
<!--                    </form>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--</section>-->

<!--        <div tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal fade confirm-popup in">-->
<!--          <div role="document" class="modal-dialog">-->
<!--            <div class="modal-content">-->
<!--              <div class="modal-body">-->
<!--                <h1>ALMOST FINISHED…</h1>-->
<!--                <p><span class="text-center">We still need to confirm your email address</span></p>-->
<!--                <p>To complete the subscription process, please click the link in the email we just                       sent you.</p>-->
<!--                <p><a href="javascript:void(0)">Add us to your address book</a></p>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </section>-->









