          <?php $header_profile = get_row('header_content',array('slug'=>'in_the_kitchen')); ?>
       <?php if(!empty($header_profile->image)): ?>
             <div class="page-heading toflip parallax" style="background-image: url('<?php echo base_url() ?>assets/uploads/header/<?php echo $header_profile->image ?>'); ">
       <?php else: ?> 
             <div class="page-heading toflip parallax" style="background-image: url('<?php echo base_url() ?>assets/theme/img/header-5.jpg'); ">
         <?php endif; ?>
              <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2><small><?php if(!empty($header_profile->heading)) echo '—'.$header_profile->heading.'—'; else echo "— MORGAN MANUFACTURING —"; ?></small>
                        <?php if(!empty($header_profile->content)): ?>
                           <?php echo strtoupper($header_profile->content) ?>
                        <?php endif; ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <section class="white-bg p-50">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-4 col-lg-4 products ">
                        <div class="inner text-center toflip">
                            <a href="#">
                                <img width="360" height="240" src="<?php echo base_url() ?>assets/theme/img/gallery/1.jpg" class="img-responsive wp-post-image" alt="strudel" />                  
                                <p>7 May 2014</p>
                                <h5>SNOW CRAB COCKTAIL</h5>
                            </a>
                        </div>
                    </div>
    
                    <div class="col-sm-6 col-md-4 col-lg-4 products ">
                        <div class="inner text-center toflip">
                            <a href="#">
                                <img width="360" height="240" src="<?php echo base_url() ?>assets/theme/img/gallery/2.jpg" class="img-responsive wp-post-image" alt="Arista alle Prugne 1" />                  
                                <p>6 May 2014</p>
                                <h5>SEAFOOD TOWER</h5>
                            </a>
                        </div>
                    </div>

    
                    <div class="col-sm-6 col-md-4 col-lg-4 products ">
                        <div class="inner text-center toflip">
                            <a href="#">           
                                <img width="360" height="240" src="<?php echo base_url() ?>assets/theme/img/gallery/3.jpg" class="img-responsive wp-post-image" alt="bistecchina di maiale con cipolle caramellate e prugne" />
                                <p>23 April 2014</p>
                                <h5>SALMON BELLY TARTARE</h5>
                            </a>
                        </div>
                    </div>

                    <div class="clearfix hidden-xs hidden-sm visible-md visible-lg"></div>

                    <div class="col-sm-6 col-md-4 col-lg-4 products ">
                        <div class="inner text-center toflip">
                            <a href="#">        
                                <img width="360" height="240" src="<?php echo base_url() ?>assets/theme/img/gallery/14.jpg" class="img-responsive wp-post-image" alt="torta-yogurt-e-fragole" />                  
                                <p>22 April 2014</p>
                                <h5>STRIPE BASS</h5>
                            </a>
                        </div>
                    </div>
    
                    <div class="col-sm-6 col-md-4 col-lg-4 products ">
                        <div class="inner text-center toflip">
                            <a href="#">
                                <img width="360" height="240" src="<?php echo base_url() ?>assets/theme/img/gallery/5.jpg" class="img-responsive wp-post-image" alt="MC_settembre_2010_p107_775--420x520" />                  
                                <p>3 April 2014</p>
                                <h5>SKUNA BAY SALMON</h5>
                            </a>
                        </div>
                    </div>

    
                    <div class="col-sm-6 col-md-4 col-lg-4 products ">
                        <div class="inner text-center toflip">
                            <a href="#">
                                <img width="360" height="240" src="<?php echo base_url() ?>assets/theme/img/gallery/6.jpg" class="img-responsive wp-post-image" alt="pasticceria-visciole_01" />                  
                                <p>26 March 2014</p>   
                                <h5>DRUNK DEVILS ON HORSEBACK</h5>
                            </a>
                        </div>
                    </div>

                    <div class="clearfix hidden-xs hidden-sm visible-md visible-lg"></div>

                    <div class="col-sm-6 col-md-4 col-lg-4 products ">
                        <div class="inner text-center toflip">
                            <a href="#">
                                <img width="360" height="240" src="<?php echo base_url() ?>assets/theme/img/gallery/7.jpg" class="img-responsive wp-post-image" alt="La grande cucina#Antipasti#Involtini di prugne e bacon #Ricetta#2339" />                  
                                <p>19 March 2014</p>
                                <h5>LAMB & BEEF MEATBALLS</h5>
                            </a>
                        </div>
                    </div>
    
                    <div class="col-sm-6 col-md-4 col-lg-4 products ">
                        <div class="inner text-center toflip">
                            <a href="#">          
                                <img width="360" height="240" src="<?php echo base_url() ?>assets/theme/img/gallery/8.jpg" class="img-responsive wp-post-image" alt="1088_z_Involtini_Tacchino_Pere" />                  
                                <p>28 February 2014</p>
                                <h5>PIG TAIL ARANCINI</h5>
                            </a>
                        </div>
                    </div>
    
                    <div class="col-sm-6 col-md-4 col-lg-4 products ">
                        <div class="inner text-center toflip">
                            <a href="#">           
                                <img width="360" height="240" src="<?php echo base_url() ?>assets/theme/img/gallery/9.jpg" class="img-responsive wp-post-image" alt="piatto-servito-terrina-cereali" />                  
                                <p>18 February 2014</p>
                                <h5>PORK SHOULDER SPOON BREAD</h5>
                            </a>
                        </div>
                    </div>

                    <div class="clearfix hidden-xs hidden-sm visible-md visible-lg"></div>

                    <div class="col-sm-6 col-md-4 col-lg-4 products ">
                        <div class="inner text-center toflip">
                            <a href="#">
                                <img width="360" height="240" src="<?php echo base_url() ?>assets/theme/img/gallery/10.jpg" class="img-responsive wp-post-image" alt="" />                  
                                <p>30 January 2014</p>
                                <h5>GRILLED ZUCCHINI SALAD</h5>
                            </a>
                        </div>
                    </div>
    
                    <div class="col-sm-6 col-md-4 col-lg-4 products ">
                        <div class="inner text-center toflip">
                            <a href="#">
                                <img width="360" height="240" src="<?php echo base_url() ?>assets/theme/img/gallery/11.jpg" class="img-responsive wp-post-image" alt="" />                  
                                <p>30 December 2013</p>
                                <h5>BLUE OYSTER MUSHROOM PAPARDELLE</h5>
                            </a>
                        </div>
                    </div>
    
                    <div class="col-sm-6 col-md-4 col-lg-4 products ">
                        <div class="inner text-center toflip">
                            <a href="#">
                                <img width="360" height="240" src="<?php echo base_url() ?>assets/theme/img/gallery/12.jpg" class="img-responsive wp-post-image" alt="" />                  
                                <p>15 October 2013</p>
                                <h5>KENNENBEC FRITES</h5>
                            </a>
                        </div>
                    </div>

                    <div class="clearfix hidden-xs hidden-sm visible-md visible-lg"></div>

                    <div class="col-sm-6 col-md-4 col-lg-4 products ">
                        <div class="inner text-center toflip">
                            <a href="#">           
                                <img width="360" height="240" src="<?php echo base_url() ?>assets/theme/img/gallery/13.jpg" class="img-responsive wp-post-image" alt="torta-prugne-e-cocco" />                  
                                <p>25 June 2013</p> 
                                <h5>SMOKED ‘N GRILLED HALF CHICKEN</h5>
                            </a>
                        </div>
                    </div>
    
                    <div class="col-sm-6 col-md-4 col-lg-4 products ">
                        <div class="inner text-center toflip">
                            <a href="#">
                                <img width="360" height="240" src="<?php echo base_url() ?>assets/theme/img/gallery/14.jpg" class="img-responsive wp-post-image" alt="" />                  
                                <p>4 January 2013</p>
                                <h5>LITTLE GEM SALAD</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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
                        <div  style="background: url('<?php echo base_url() ?>assets/uploads/sections/image/<?php echo $row->image ?>') no-repeat center center ;background-size:cover" class="half-block toflip bg_image">
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


