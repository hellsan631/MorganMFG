          <?php /* $header_profile = get_row('header_content',array('slug'=>'gallery')); ?>
       <?php if(!empty($header_profile->image)): ?>
             <div class="page-heading tofade parallax" style="background-image: url('<?php echo base_url() ?>assets/uploads/header/<?php echo $header_profile->image ?>'); ">
       <?php else: ?> 
             <div class="page-heading tofade parallax" style="background-image: url('<?php echo base_url() ?>assets/theme/img/header-5.jpg'); ">
         <?php endif; ?>
              <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2><small><?php if(!empty($header_profile->heading)) echo '— '.ucwords($header_profile->heading).' —'; ?></small>
                        <?php if(!empty($header_profile->content)): ?>
                           <?php echo strtoupper($header_profile->content) ?>
                        <?php endif; ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <?php */ ?>

          <div class="carousel slide home-slider carousel-overlay tofade" id="carousel" data-ride="carousel">
            <?php  if ($gallery): ?>
            <!-- <ol class="carousel-indicators">
            <?php $i=0; foreach ($gallery as $key): if($i==0){ ?>
                    <li data-target="#carousel" data-slide-to="<?php echo $i; ?>" class="active"></li>
                <?php }else{ ?>
                    <li data-target="#carousel" data-slide-to="<?php echo $i; ?>"></li>                
            <?php } $i++; endforeach; ?>                
            </ol> -->


                <div class="carousel-inner">               
            <?php $j = 0; foreach ($gallery as $row): ?>            
                        <div class="item <?php if($j==0){ echo 'active'; } ?> slide<?php echo $j; ?> " style="background:url('<?php echo base_url() ?>assets/uploads/gallery/<?php echo $row->image ?>') no-repeat center center ;background-size:cover">                        
                            <div class="carousel-caption">
                                <h2 class="dynamic_image_heading" style="margin-top:0"><?php echo $row->name; ?></h2>
                                <?php  $gallery_images = get_gallery_images($row->id); ?>
                                <?php $i=1; if ($gallery_images): foreach($gallery_images as $gimage){ ?>     
                               <?php /* 
                                <a  href='<?php echo base_url() ?>assets/uploads/gallery_images/<?php echo $gimage->image ?>' 
                                    class='dynamic_image_button_text fresco serv-bl m-n-p-0 btn btn-light btn-new'  
                                    data-fresco-group='example<?php echo $row->id ?>' 
                                    data-fresco-caption="<?php echo $gimage->name ?>"
                                    style="padding:10px 30px !important; <?php if($i != 1){ echo 'display:none'; } ?>"
                                    >VIEW MORE
                                </a>
                                */ ?>
                                    
                                <?php $i++; } endif;  ?>
                            </div>                        
                        </div>    
            <?php $j++; endforeach; //die(); ?>
                </div>
            <?php endif;  ?>
            <a class="left carousel-control" href="#carousel" data-slide="prev" style="z-index: 10;">
                <img src="<?php echo base_url() ?>assets/theme/img/left.png" alt="" style="width:20px; height:40px; position: absolute; top: 50%; z-index: 5; display: inline-block;">
            </a>
            <a class="right carousel-control" href="#carousel" data-slide="next" style="z-index: 10;">
                <img src="<?php echo base_url() ?>assets/theme/img/right.png" alt="" style="width:20px; height:40px; position: absolute; top: 50%; z-index: 5; display: inline-block;">
                <span class="sr-only">Next</span> -->
                <!-- NEXT -->
            </a> 
            <!--  <a class="carousel-control left" href="#carousel" data-slide="prev">&lsaquo;</a>
            <a class="carousel-control right" href="#carousel" data-slide="next">&rsaquo;</a> -->
            </div>

            <?php $update_gallery = get_row('contents',array('slug'=>'gallery')); ?>

        <div class="row prod-bl padder-cont " id="uno1">
            <div class="col-lg-8 col-lg-offset-2 tofade animated fadeInUp" style="opacity: 0;">
                <div class="inner">
                    <h3 class="page_heading_text page-title"><?php echo $update_gallery->headline ?></h3>
                  <span class="page_button_text"><?php echo $update_gallery->description ?></span>
               </div>
            </div>
        </div>

        <?php /* ?>
        <section class="white-bg">
            <!-- <div class="container"> -->
                <div class="row">
                    <?php if(!empty($gallery)): ?>
                    <?php $i=1; ?>
                    <?php foreach ($gallery as $row):?>
                        
                    <?php $is_empty = is_gallery_empty($row->id); ?>    
                    <?php if($is_empty == 0): ?>
                        <div class="col-sm-6 col-md-4 col-lg-4 products m-n-p-0">
                            <div class="inner text-center tofade m-n-p-0">
                                <a href="<?php echo base_url() ?>gallery/detail/<?php echo $row->slug ?>" class="serv-bl m-n-p-0">
                                    <img width="100%" src="<?php echo base_url() ?>assets/uploads/gallery/<?php echo $row->image ?>" class="img-responsive wp-post-image" alt="strudel" />                  
                                    <p><?php echo date('d F Y',strtotime($row->created)); ?></p>
                                    <h5><?php echo $row->name ?></h5>
                                </a>
                            </div>
                        </div>
                        <?php if($i%3 == 0): ?>
                            <div class="clearfix hidden-xs hidden-sm visible-md visible-lg"></div>
                        <?php endif; ?>
                        <?php $i++; ?>
                    <?php endif; ?>    
                    

                    <?php endforeach; ?>
                    <?php else: ?>
                        No Gallery Found.
                    <?php endif; ?>
                </div>
            <!-- </div> -->
        </section>
        <?php */ ?>

       <!--  <div class="scroll-top tofade p-70"> 
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <a href="#" class="btn btn-light scroll-top">TOP</a>
                    </div>
                </div>
            </div>
        </div>
 -->
           <?php /* $sections = get_sections() ?>
            <?php if($sections):?>
        <section class="row-1 padder-cont">
            <div class="row">
               <?php foreach($sections as $row): ?>
                    <div class="col-sm-6">
                        <div  style="background: url('<?php echo base_url() ?>assets/uploads/sections/image/<?php echo $row->image ?>') no-repeat center center ;background-size:cover" class="half-block tofade bg_image">
                            <div class="inner p-90">
                                <img style="width:60px;height:60px;" src="<?php echo base_url() ?>assets/uploads/sections/icon/<?php echo $row->icon ?>" alt="">
                                <h4><small> <?php echo $row->heading ?> </small> <?php echo $row->sub_heading ?></h4>
                                <p><a href="<?php echo $row->button_link ?>" class="btn btn-light"><?php echo $row->button_text ?></a></p>
                            </div>
                        </div>        
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
            <?php endif; */ ?>


<style type="text/css">
    .m-n-p-0{
        margin: 0 !important;
        padding: 0 !important;
    }

    .carousel-control.right, .carousel-control.left{
        background-image: none;
    }
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fresco/css/fresco.css" />
<script src="<?php echo base_url() ?>assets/plugins/fresco/js/fresco.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        setInterval(function(){
            $("canvas").css('position', 'fixed');
            $("canvas").css('bottom', '-100px');
        },10);
    });
</script>