        <div class="carousel slide home-slider carousel-overlay tofade" id="carousel" data-ride="carousel">
            <?php  if ($slider): ?>
            <ol class="carousel-indicators">
            <?php $i=0; foreach ($slider as $key): if($i==0){ ?>
                    <li data-target="#carousel" data-slide-to="<?php echo $i; ?>" class="active"></li>
                <?php }else{ ?>
                    <li data-target="#carousel" data-slide-to="<?php echo $i; ?>"></li>                
            <?php } $i++; endforeach; ?>                
            </ol>


                <div class="carousel-inner">               
            <?php $j = 0; foreach ($slider as $row): ?>            
                    <div class="item <?php if($j==0){ echo 'active'; } ?> slide<?php echo $j; ?> " style="background:url('<?php echo base_url() ?>assets/uploads/slider/<?php echo $row->image; ?>') no-repeat center center ;background-size:cover">
                        <div class="carousel-caption">
                            <h2><?php echo $row->headline ?></h2>
                            <?php if(!empty($row->sub_headline)): ?>
                               <p><?php echo $row->sub_headline ?></p>
                             <?php endif; ?>  
                        </div>
                    </div>    
            <?php $j++; endforeach ?>
                </div>
            <?php endif;  /* ?>

             <ol class="carousel-indicators">
                <li data-target="#carousel" data-slide-to="0" class="active"></li>
                <li data-target="#carousel" data-slide-to="1"></li>
                <li data-target="#carousel" data-slide-to="2"></li>
                <li data-target="#carousel" data-slide-to="3"></li>
                <!--
                
                <li data-target="#carousel" data-slide-to="4"></li>
                <li data-target="#carousel" data-slide-to="5"></li>
                -->
            </ol>

            <div class="carousel-inner">

               
                <div class="item active slide4">
                    <div class="carousel-caption">
                        <h2>CAPTIVATING ENERGY FOR YOUR EVENT</h2>
                        <p>Intimate or celebratory, our event space can cater to a variety of vibrant occasions.</p>
                    </div>
                </div>
                
                <div class="item  slide1">
                    <div class="carousel-caption text-center">
                        <h2>QUALITY AND SIMPLICITY</h2>
                        <p>Morgan Manufacturing offers seasonally-prepared recipes that are meant to excite your palette.</p>
                    </div>
                </div>

                <div class="item slide2">
                    <div class="carousel-caption">
                        <h2>HISTORIC DIING EXPERIENCE</h2>
                        <p>Capturing the atmosphere of the original interior hardware, <br />the library dining room surrounds you with history and beauty.</p>
                    </div>
                </div>

                <div class="item slide3">
                    <div class="carousel-caption">
                        <h2>DELICATE AND SUCCULENT</h2>
                        <p>Mastered chefs pair fresh ingredients and delicate <br />flavors to entice your every sense.</p>
                    </div>
                </div>
            </div> */?>

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



