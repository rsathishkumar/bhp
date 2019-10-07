<?php ?>

<style type="text/css">
    .mob-search-page {
        font-family: "open_sansregular", Helvetica, Arial, sans-serif;

    }
    form.gsc-search-box,.gsc-refinementsArea {
        background-color: #000;
        padding: 10px;
        margin-bottom: 0;
    }

    .gsc-control-cse {
        border: none!important;
    }
    table.gsc-search-box > tbody > tr {
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-flex-wrap: nowrap;
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap;
        -webkit-justify-content: flex-start;
        -ms-flex-pack: start;
        justify-content: flex-start;
        -webkit-align-content: stretch;
        -ms-flex-line-pack: stretch;
        align-content: stretch;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
    }
    .gsib_a {
        padding: 10px;
    }
    .gsc-resultsbox-visible {
        padding: 20px;
    }
    .mob-search-page .gsib_a {
        padding-bottom: 0;
    }
    .gsc-input-box {
        height: auto;
        border: 0;
        background: none;
        position: relative!important;
    }

    .gsc-input-box input[type="text"] {
        color: #fff;
        background-image: none !important;
        background-color: transparent!important;
        border-top: none!important;
        border-right: none!important;
        border-left: none!important;
        border-bottom: 1px solid #616161!important;
        box-shadow: none;
        border-radius: 0;
        /*margin-bottom: 20px!important;*/
        height: 44px!important;
        font-family: "open_sansregular", Helvetica, Arial, sans-serif;
        font-size: 1.1428571429rem;
        padding-right: 32px!important;

    }
    .gsc-input-box input[type="text"]::-webkit-input-placeholder {
        color: #616161;
    }

    .gsc-input-box input[type="text"]:-moz-placeholder { /* Firefox 18- */
        color: #616161;
    }

    .gsc-input-box input[type="text"]::-moz-placeholder {  /* Firefox 19+ */
        color: #616161;
    }

    .gsc-input-box input[type="text"]:-ms-input-placeholder {
        color: #616161;
    }

    .gsst_a .gscb_a {
        vertical-align: middle;
        color: #666;
        font-family: "open_sansregular", Helvetica, Arial, sans-serif!important;
        font-size: 1.5rem;

    }
    .gsc-input, .gsc-control-cse,.gsc-thumbnail-inside,.gsc-url-top {
        padding: 0;
    }

    .gsc-input {
        padding: 0!important;
        width: 100%;
    }
    .gsib_b {
        position: absolute;
        right: 5px;
        z-index: 9;
        top: 20px;
    }
    .gsc-tabsArea,
    .gsc-adBlock,
    .gsc-thumbnail,
    .gs-per-result-labels span,
    .gsc-above-wrapper-area {
        display: none!important;
    }
    .gsc-refinementsArea {
        padding: 0;
        overflow-y: hidden;
        overflow-x: scroll;
        padding-top: 10px;
    }
    /*.gsc-refinementHeader {
        padding: 0;
        line-height: 25px;
        text-align: center;
        margin-right: 0;
        font-weight: 300;
            }*/

    .gsc-refinementsArea > div {
        height: 30px;
        padding-bottom: 10px;
        max-height: 30px;
        /*overflow-y: hidden;*/
        /*overflow-x: scroll;*/
        width: 575px;
        /*width: 100%;*/

    }
    .gsc-refinementHeader {
        width: 88px;
        text-align: center;
        padding: 0;
        margin: 0;
    }
    .gsc-refinementHeader > span {
        display: inline-block;
    }
    .gsc-refinementHeader.gsc-refinementhActive,
    .gs-spelling a {
        color: #d00f15;
        /*border-bottom: 2px solid  #d00f15;*/
    }
    td.gsc-search-button {
        width: 100%;
        text-align: center;
    }
    .gsc-search-button {
        width: 100%;
        text-align: center;
        padding: 20px 0;
    }
    input.gsc-search-button-v2 {
        display: inline-block;
        margin-bottom: 0;
        font-weight: normal;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        background-image: none;
        border: 1px solid transparent;
        white-space: nowrap;
        font-size: 14px;
        line-height: 1.428571429;
        border-radius: 4px;
        background-color: #d00f15;
        color: #ffffff !important;
        box-shadow: 0 2px 0 0 #ac0d12;
        border-top-right-radius: 1.4285714286rem;
        border-top-left-radius: 1.4285714286rem;
        border-bottom-right-radius: 1.4285714286rem;
        border-top-right-radius: 1.4285714286rem;
        border-bottom-right-radius: 1.4285714286rem;
        border-bottom-left-radius: 1.4285714286rem;
        border-bottom-left-radius: 1.4285714286rem;
        border-top-left-radius: 1.4285714286rem;
        /*padding: 12px 50px;*/
        transition: all ease 0.3s;
        width: auto;
        height: auto;

    }

    input.gsc-search-button-v2:hover,
    input.gsc-search-button-v2:focus,
    input.gsc-search-button-v2:active,
    input.gsc-search-button-v2:active:hover {
        box-shadow: 0 2px 0 0 #54080a;
        background: #AC0D12;
        color: #ffffff;
        outline: none;
    }


    .gsc-results {
        width: 100%;

    }

    .gsc-result {
        margin-bottom: 0.8571428571rem!important;
        display: -moz-flex;
        display: flex;
        -moz-flex-direction: column;
        flex-direction: column;
        flex-wrap: nowrap;
        transition: all ease 0.5s;
        border-radius: 0.3571428571rem;
        box-shadow: 0 0.1428571429rem 0 0 rgba(0, 0, 0, 0.1);
        background-color: #ffffff!important;
        color: #000000;
        text-decoration: none;
        padding: 1.0714285714rem!important;
    }

    .gs-title {
        font-family: "open_sansregular", Helvetica, Arial, sans-serif;
        font-size: 14px!important;
        margin-bottom: 1rem;
        text-decoration: none!important;
        height: 100%!important;
    }
    .gs-snippet,.gs-visibleUrl {
        font-family: "open_sansregular", Helvetica, Arial, sans-serif;
        font-size: 0.8571428571rem;
        color: #333333!important;
        margin-bottom: 10px!important;
    }
    .gs-per-result-labels .gs-label {
        display: inline;
        background-color: #777;
        font-size: 75%;
        font-weight: bold;
        line-height: 1;
        color: #fff!important;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 1.4285714286rem;
        padding: 0.1428571429rem 1.5714285714rem 0.2857142857rem!important;
        text-decoration: none!important;
        pointer-events: none;
    }
    .gsc-completion-container td,.gsc-cursor-page {
        font-family: "open_sansregular", Helvetica, Arial, sans-serif!important;
        font-size: 0.8571428571rem!important;
    }
    .search-box {
        background-color: #000;
    }
    .search-icon,.search-icon:active,.search-icon:focus,.search-icon:hover,.search-icon:active:hover {
        padding: 1.5rem;
        color: #fff;
        text-decoration: none;
    }

    .gsc-cursor {
        display: inline-block;
    }
    .gsc-cursor-box {
        text-align: center;
        margin: 20px 10px!important;
    }
    .gsc-cursor-page {
        padding: 5px 8px;
        margin-right: 0!important;
    }
    .gsc-cursor-current-page {
        background-color: #fff!important;
        color: #d00f15!important;
    }


    .gssb_a table tr td {
        padding: 5px;
        font-family: "open_sansbold", Helvetica ,Arial ,sans-serif!important;

    }
    .gssb_a table tr td b  {
        font-family: "open_sansregular", Helvetica ,Arial ,sans-serif!important;
        font-weight: normal;
    }

    #gsc-i-id1 {
        background: transparent!important;
        margin-top: 0!important;
    }

    /*.search-suggesstions {*/
        /*padding-top: 70px;*/
    /*}*/

    .gsc-search-box-tools {
        min-height: 220px;
    }
    td#gs_tti50 {
        width: 100%;
    }

</style>



<div class="search-wrapper border-top-red">
    <div class="search-box">
        <a href="<?php echo 'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>" class="gsst_a pull-right search search-icon" id="clear-close-search">
            <i class="icon-close"></i>
        </a>



        <div id="cse-search-results"></div>

        <script>
            (function() {

                var cx = 'partner-pub-8422315737402856:zcmboq-gw8i';

                var gcse = document.createElement('script');
                gcse.type = 'text/javascript';
                gcse.async = true;
                gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
                '//www.google.com/cse/cse.js?cx=' + cx;
                var s = document.getElementsByTagName('script')[0];

                s.parentNode.insertBefore(gcse, s);


            })();



            window.onload = function(){

                document.getElementById('gsc-i-id1').placeholder = 'What are you looking for';

                //google search button with text
//                $('td.gsc-search-button').empty().html('<input type="submit" src="http://www.team-bhp.com/themes/mobilebhp/images/img-search-text.png" class="gsc-search-button gsc-search-button-v2" title="search">');

//                $('td.gsc-search-button').empty().html('<input type="submit" title="search" value="Search" placeholder="Search" class="gsc-search-button gsc-search-button-v2">');


//                $(document).on("click",".search-suggesstions a", function(){
//                    var suggestTxt = $(this).text();
//                    console.log(suggestTxt);
//
//                    $("#gsc-i-id1").val(suggestTxt);
//                    $('input[type="image"]').trigger('click');
//                    $(".search-suggesstions").hide();
//
//
//                });

//                $(document).on("click",".gsst_a", function(){
//                    $(".search-suggesstions").show();
//                    $("#gsc-i-id1").val("");
//                });

            };


        </script>

        <gcse:searchbox-only autoSearchOnLoad="true" linktarget="_parent" resultsUrl="https://www.team-bhp.com/searchmobilebhp.php"></gcse:searchbox-only>

<!--        <gcse:search linktarget="_parent" autoSearchOnLoad="true"></gcse:search>
-->


        <!--    sugesstions-->

<!--        <div class="search-suggesstions">-->
<!--            <h4>You can search for...</h4>-->
<!--            <ul>-->
<!--                <li><a href="javascript:void(0);">Audi A8 review</a></li>-->
<!--                <li><a href="javascript:void(0);">Latest Reviews</a></li>-->
<!--                <li><a href="javascript:void(0);">Weekend drive around Bangalore</a></li>-->
<!--                <li><a href="javascript:void(0);">Honda Civic</a></li>-->
<!--                <li><a href="javascript:void(0);">Motorcycles</a></li>-->
<!--                <li><a href="javascript:void(0);">Road trip to Ooty</a></li>-->
<!--            </ul>-->
<!--        </div>-->

    </div>





</div>

<script>

</script>


