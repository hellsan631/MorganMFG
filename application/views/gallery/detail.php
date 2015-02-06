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

        <?php $gallery_info = $gallery_info; ?>
        <?php if(!empty($gallery_info->image)): ?>
             <div class="page-heading tofade parallax" style="background-image: url('<?php echo base_url() ?>assets/uploads/gallery/<?php echo $gallery_info->image ?>'); ">
        <?php else: ?> 
             <div class="page-heading tofade parallax" style="background-image: url('<?php echo base_url() ?>assets/theme/img/header-5.jpg'); ">
         <?php endif; ?>
              <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>
                        <?php if(!empty($gallery_info->name)): ?>
                           <?php echo strtoupper($gallery_info->name) ?>
                        <?php endif; ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <section class="white-bg">
            <!-- <div class="container"> -->
                <div class="row">
                    <?php if(!empty($gallery_images_info)): ?>
                    <?php $i=1; ?>
                    <?php foreach ($gallery_images_info as $row):?>
                        <div class="col-sm-6 col-md-4 col-lg-4 products m-n-p-0">
                            <div class="inner text-center tofade m-n-p-0">
                                <a
                                    href='<?php echo base_url() ?>assets/uploads/gallery_images/<?php echo $row->image ?>' 
                                    class='fresco serv-bl m-n-p-0' 
                                    data-fresco-group='example' 
                                    data-fresco-caption="<?php echo $row->name ?>"
                                    >
                                    <img width="100%" src="<?php echo base_url() ?>assets/uploads/gallery_images/<?php echo $row->image ?>" class="img-responsive wp-post-image m-n-p-0" alt="strudel" />                  
                                    
                                <!--     <p><?php //echo date('d F Y',strtotime($row->created)); ?></p>
                                    <h5><?php //echo $row->name ?></h5> -->
                                
                                </a>
                            </div>
                        </div>
                        <?php if($i%3 == 0): ?>
                            <div class="clearfix hidden-xs hidden-sm visible-md visible-lg"></div>
                        <?php endif; ?>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                    <?php else: ?>
                        Images Not Found.
                    <?php endif; ?>
                </div>
            <!-- </div> -->
        </section>

        <div class="scroll-top tofade p-70"> 
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <a href="#" class="btn btn-light scroll-top">TOP</a>
                    </div>
                </div>
            </div>
        </div>

           <?php $sections = get_sections() ?>
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
            <?php endif; ?>

<style type="text/css">
    .m-n-p-0{
        margin: 0 !important;
        padding: 0 !important;
    }
</style>