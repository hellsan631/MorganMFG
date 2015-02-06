    <!--page style-->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/service/style.css" media="screen, projection">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/service/developers.css" media="screen, projection">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/service/print.css" media="print">    
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/css/newstyle.css" type="text/css">
    <script src="<?php echo base_url() ?>assets/theme/service/ga.js" async="" type="text/javascript"></script><script src="<?php echo base_url() ?>assets/theme/service/modernizr.js"></script>    
    <div class="contentslide">        
        <div id="mother" class="">
        <div style="transform: translate3d(0px, 0px, 0px);" id="front">
            <div style="visibility: inherit; opacity: 1;" class="main">
                <div class="section">
                    <h1 class="vhide">Services</h1>
                    <div class="crossroad-category">
                    <ul class="reset">

                        <?php if($space): $i=0; foreach($space as $row): ?>
                        <li style="clip: rect(0px, 411px, 633px, 0px); width: 756.444px;" data-index="<?php echo $i; ?>">
                            <a style="transform: translate3d(-172.722px, 0px, 0px);" href="<?php echo base_url() ?>spaces/detail/<?php echo $row->slug; ?>">
                                <span class="img" style="background-image: url('<?php echo base_url() ?>assets/uploads/space/<?php echo $row->image; ?>');"></span>
                                <span style="transform: translate3d(0px, 0px, 0px); background-color: rgba(0, 0, 0, 0.6);" class="overlay"></span>
                                <span style="width: 410.4px;" class="name"><?php echo $row->title; ?></span>
                            </a>
                        </li>
                    <?php $i++; endforeach;  endif; ?>
                    <?php /* ?>

                        <li style="clip: rect(0px, 411px, 633px, 0px); width: 756.444px;" data-index="0">
                            <a style="transform: translate3d(-172.722px, 0px, 0px);" href="room_detail.html">
                                <span class="img" style="background-image: url('<?php echo base_url() ?>assets/images/services-1.jpg');"></span>
                                <span style="transform: translate3d(0px, 0px, 0px); background-color: rgba(0, 0, 0, 0.6);" class="overlay"></span>
                                <span style="width: 410.4px;" class="name">Design and realization of complete interior and kitchen</span>
                            </a>
                        </li>
                        <li style="clip: rect(0px, 411px, 633px, 0px); width: 756.444px;" data-index="1">
                            <a style="transform: translate3d(-172.722px, 0px, 0px);" href="room_detail.html">
                                <span class="img" style="background-image: url('<?php echo base_url() ?>assets/images/services-1.jpg');"></span>
                                <span style="transform: translate3d(0px, 0px, 0px); background-color: rgba(0, 0, 0, 0.6);" class="overlay"></span>
                                <span style="width: 410.4px;" class="name">Design and realization of complete interior and kitchen</span>
                            </a>
                        </li>
                        <li style="clip: rect(0px, 411px, 633px, 0px); width: 756.444px;" data-index="2">
                            <a style="transform: translate3d(-172.722px, 0px, 0px);" href="room_detail.html">
                                <span class="img" style="background-image: url('<?php echo base_url() ?>assets/images/services-1.jpg');"></span>
                                <span style="transform: translate3d(0px, 0px, 0px); background-color: rgba(0, 0, 0, 0.6);" class="overlay"></span>
                                <span style="width: 410.4px;" class="name">Design and realization of complete interior and kitchen</span>
                            </a>
                        </li>
                    <?php */ ?>

                       
                    </ul>
                </div>
            </div>
        </div>
        <div class="main-overlay"></div>
            
        <div style="visibility: hidden; opacity: 0;" id="page-loader" class="loader">
            <div class="status">0</div>
            <div class="circle"><span class="sk-countdown-circle">              <span class="sk-countdown-clip">                    <span style="transform: rotate(180deg);" class="sk-countdown-bar"></span>               </span>                 <span class="sk-countdown-clip">                    <span style="transform: rotate(180deg);" class="sk-countdown-bar"></span>               </span></span></div>
            <div class="circle-status"></div>
            <div class="logo">
                <div class="logo-bar"></div>
                <div style="width: 100%;" class="logo-status"></div>
            </div>
        </div>
    </div>
        <div style="transform: matrix3d(-1, 0, 0, 0, 0, 1, 0, 0, 0, 0, -1, 0, 0, 0, 0, 1);" id="back">                
            <div class="main">
                <div class="section">
                    ﻿<div class="section">
                        <h1 class="vhide">Registration</h1>
                    </div>                  
                </div>
            </div>                
        </div>
    </div>    

    <script src="<?php echo base_url() ?>assets/theme/service/TweenMax.js"></script>
    <script src="<?php echo base_url() ?>assets/theme/service/ScrollToPlugin.js"></script>
    <script src="<?php echo base_url() ?>assets/theme/service/json3.js"></script>
    <script src="<?php echo base_url() ?>assets/theme/service/jquery_008.js"></script>
    <script src="<?php echo base_url() ?>assets/theme/service/jquery.js"></script>
    <script src="<?php echo base_url() ?>assets/theme/service/jquery_003.js"></script>

    
    <script src="<?php echo base_url() ?>assets/theme/service/sk.js"></script>
    <script src="<?php echo base_url() ?>assets/theme/service/app_003.js"></script>
    <script src="<?php echo base_url() ?>assets/theme/service/app_004.js"></script>
    <script src="<?php echo base_url() ?>assets/theme/service/app_006.js"></script>
    <script src="<?php echo base_url() ?>assets/theme/service/app_002.js"></script>
    <script src="<?php echo base_url() ?>assets/theme/service/app.js"></script>
    <script src="<?php echo base_url() ?>assets/theme/service/app_005.js"></script>
    <script src="<?php echo base_url() ?>assets/theme/service/app_007.js"></script>
    <script src="<?php echo base_url() ?>assets/theme/service/developers.js"></script>
    <script>
        var tree = [{"title":"Stopka | STOPKA","url":"\/en","slug":"en","level":"0","lft":"-1","rgt":"-1","children":[]},{"title":"News | STOPKA","url":"\/en\/news","slug":"aktuality","level":"1","lft":"2","rgt":"3","children":[]},{"title":"Services | STOPKA","url":"\/en\/services","slug":"services","level":"1","lft":"4","rgt":"11","children":[{"title":"Design and realization of complete interior and kitchen | STOPKA","url":"\/en\/sluzby\/interior-architecture","slug":"navrhy-a-realizace-interieru-a-kuchyni","level":"2","lft":"5","rgt":"6","children":[]},{"title":"Fitting interior with furniture | STOPKA","url":"\/en\/sluzby\/prodej.html","slug":"prodej-nabytku","level":"2","lft":"7","rgt":"8","children":[]},{"title":"A specialist in Miele appliances  | STOPKA","url":"\/en\/sluzby\/spotrebice.html","slug":"spotrebice","level":"2","lft":"9","rgt":"10","children":[]}]},{"title":"Sortiment | STOPKA","url":"\/en\/sortiment","slug":"sortiment","level":"1","lft":"12","rgt":"29","children":[{"title":"Kitchens and dining rooms | STOPKA","url":"\/en\/sortiment\/kuchyne-a-jidelny.html","slug":"kuchyne-a-jidelny","level":"2","lft":"13","rgt":"14","children":[]},{"title":"Living room | STOPKA","url":"\/en\/sortiment\/obyvaci-pokoje.html","slug":"obyvaci-pokoje","level":"2","lft":"15","rgt":"16","children":[]},{"title":"Bedrooms and dressing rooms | STOPKA","url":"\/en\/sortiment\/loznice-a-satny","slug":"loznice-a-satny","level":"2","lft":"17","rgt":"18","children":[]},{"title":"Bathrooms and floors | STOPKA","url":"\/en\/sortiment\/koupelny.html","slug":"koupelny-a-podlahy","level":"2","lft":"19","rgt":"20","children":[]},{"title":"Textile Product and Accessories | STOPKA","url":"\/en\/sortiment\/textil.html","slug":"textil","level":"2","lft":"23","rgt":"24","children":[]},{"title":"Terraces | STOPKA","url":"\/en\/sortiment\/terasy.html","slug":"terasy","level":"2","lft":"25","rgt":"26","children":[]},{"title":"Brands | STOPKA","url":"\/en\/sortiment\/brands","slug":"znacky","level":"2","lft":"27","rgt":"28","children":[]}]},{"title":"References | STOPKA","url":"\/en\/reference.html","slug":"reference","level":"1","lft":"30","rgt":"39","children":[{"title":"Modern | STOPKA","url":"\/en\/reference\/moderni","slug":"moderni-styl","level":"2","lft":"33","rgt":"34","children":[]},{"title":"Elegant | STOPKA","url":"\/en\/reference\/secesni-styl.html","slug":"secesni-styl","level":"2","lft":"35","rgt":"36","children":[]},{"title":"Classic | STOPKA","url":"\/en\/reference\/barokni-styl.html","slug":"barokni-styl","level":"2","lft":"37","rgt":"38","children":[]}]},{"title":"Magazine | STOPKA","url":"\/en\/magazin.html","slug":"magazin","level":"1","lft":"40","rgt":"41","children":[]},{"title":"About us | STOPKA","url":"\/en\/o-nas.html","slug":"about-us","level":"1","lft":"42","rgt":"47","children":[{"title":"Our philosophy | STOPKA","url":"\/cs\/o-nas\/nase-filozofie.html","slug":"our-philosophy","level":"2","lft":"43","rgt":"44","children":[]},{"title":"Our team | STOPKA","url":"\/cs\/o-nas\/tym.html","slug":"team","level":"2","lft":"45","rgt":"46","children":[]}]},{"title":"Contact | STOPKA","url":"\/en\/kontakt.html","slug":"kontakt","level":"1","lft":"49","rgt":"56","children":[{"title":"Prague | STOPKA","url":"\/kontakt\/praha.html","slug":"praha","level":"2","lft":"50","rgt":"51","children":[]},{"title":"Bratislava | STOPKA","url":"\/kontakt\/bratislava.html","slug":"bratislava","level":"2","lft":"52","rgt":"53","children":[]},{"title":"Outlet | STOPKA","url":"\/kontakt\/outlet.html","slug":"outlet","level":"2","lft":"54","rgt":"55","children":[]}]},{"title":"Terms en | STOPKA","url":"\/cs\/terms.html","slug":"terms","level":"1","lft":"49","rgt":"50","children":[]},{"title":"Registration | STOPKA","url":"\/en\/registration","slug":"registration","level":1,"children":[],"backend":true},{"title":"Login | STOPKA","url":"\/en\/login","slug":"login","level":1,"children":[],"backend":true},{"title":"Getting a password | STOPKA","url":"\/en\/retrieve","slug":"retrieve","level":1,"children":[],"backend":true},{"title":"To download | STOPKA","url":"\/en\/download","slug":"download","level":1,"children":[],"backend":true},{"title":"Settings | STOPKA","url":"\/en\/user","slug":"user","level":1,"children":[],"backend":true},{"title":"Business Terms and Conditions | STOPKA","url":"\/en\/terms","slug":"terms","level":1,"children":[],"backend":true},{"title":"\u00davod | STOPKA","url":"\/en\/welcome","slug":"welcome","level":1,"children":[],"backend":true},{"title":"Zap\u016fj\u010den\u00ed vzork\u016f | STOPKA","url":"\/en\/rent","slug":"rent","level":1,"children":[],"backend":true},{"title":"Prostor pro V\u00e1s | STOPKA","url":"\/en\/space","slug":"space","level":1,"children":[],"backend":true}];
        //console.log(tree);
        App.run({
            links: tree
        })
    </script>
    <div id="mq"></div>        
    </div>
    <style type="text/css">
        .navbar{
            height: auto !important;
        }

        .navbar-statica .navbar-nav{
            margin-top: 80px;
        }
    </style>
