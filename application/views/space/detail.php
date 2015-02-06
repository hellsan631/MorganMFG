<link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/service/style.css" media="screen, projection">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/service/developers.css" media="screen, projection">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/service/print.css" media="print">    
<link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/css/newstyle.css" type="text/css">

 <div class="contentslide">
        <div id="mother" class="">
            <div class="content_page">
                <div class="content_left"><img src="<?php echo base_url() ?>assets/uploads/space/<?php echo $space->image ?>" /></div>
                <div class="content_right">
                    <h1 class="title"><?php echo $space->title; ?></h1>
                    <div class="separator"></div>
                    <div class="content">
                        <?php echo $space->description ?>                         
                        <p>
                        <?php if (!empty($space->link) && !empty($space->btn_txt)): ?>                            
                        <a href="<?php echo $space->link ?>" class="btn" data-text="<?php echo $space->btn_txt ?>">
                            <span><?php echo $space->btn_txt; ?></span>
                        </a>
                        <?php endif ?>
                    </p>
                    </div>
                </div>
            </div>
        </div>

     </div>
<style type="text/css">
.navbar{
    height: auto !important;
}

.navbar-brand {
    margin-top: 30px !important;
}

#footer{
    position: relative;
}

.navbar-statica .navbar-nav {
    margin-top: 160px !important;
}
</style>

<script type="text/javascript">
$(window).resize(function(){
    $(".content_page").css('margin-top', $("nav").height()+'px');
    var hl = $('.content_left').height();
    var hr = $('.content_right').height();
    if(hl > hr){
        var hi = hl;
    }else{
        var hi = hr;
    }
    $('.contentslide').height(hi+180);                        
});
$(window).load(function(){
    $(".content_page").css('margin-top', $("nav").height()+'px');
    var hl = $('.content_left').height();
    var hr = $('.content_right').height();
    if(hl > hr){
        var hi = hl;
    }else{
        var hi = hr;
    }
    $('.contentslide').height(hi+180);                        
});
</script>


    <style>
    @media (max-width: 795px){
        .content_left{
            width: 100%;
            clear:both;            
        }
        .content_right{
            width: 100%;
            clear:both;            
        }
    }
    .content_right .content{
        width: 100%;
        text-align: center;
    }
    </style>

