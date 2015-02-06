       <?php $header_profile = get_row('header_content',array('slug'=>'profile')); ?>
       <?php if(!empty($header_profile->image)): ?>
         <div class="page-heading tofade parallax" style="background-image: url('<?php echo base_url() ?>assets/uploads/header/<?php echo $header_profile->image ?>'); ">
       <?php else: ?>
         <div class="page-heading tofade parallax" style="background-image: url('<?php echo base_url() ?>assets/theme/img/new/profileheader2.jpg'); ">
       <?php endif; ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        
                        <h2>
                            <?php if(!empty($header_profile->heading)){ ?>
                            <small><?php echo $header_profile->heading;?></small>
                            <?php } ?>
                        
                        <?php if(!empty($header_profile->content)): ?>
                           <?php echo strtoupper($header_profile->content) ?>
                        <?php endif; ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($content): $i=0; foreach($content as $row): ?>
            <?php if ($row->type == 1){ ?>
                <div class="img-block b1" style="background-image:url('<?php echo base_url() ?>assets/uploads/about/<?php echo $row->image; ?>')"></div>
            <?php }elseif($row->type == 2){ ?>
            <div class="row prod-bl padder-cont <?php if($i==0){ echo 'hero'; } ?>" id="uno<?php echo $row->id ?>">
                <div class="col-lg-8 col-lg-offset-2 tofade">
                    <div class="inner">
                        <h3 class="page-title"><?php echo $row->heading; ?></h3>
                        <?php echo $row->description; ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        <?php $i++; endforeach; endif ?>        
        

        <nav id="block-navigation">
            <ul id="section_nav">
                <?php if ($content): $j=0; foreach($content as $row): if($row->type == 2){ ?>
                <li class="<?php if($j ==0){ echo 'active'; } ?>"><a href="#uno<?php echo $row->id; ?>" title="<?php echo $row->heading ?>" data-toggle="tooltip" data-placement="left"></a></li>                
                <?php } $j++; endforeach; endif ?>        
            </ul>
        </nav>

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

