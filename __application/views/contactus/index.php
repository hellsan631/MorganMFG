          <?php $header_profile = get_row('header_content',array('slug'=>'contact')); ?>
       <?php if(!empty($header_profile->image)): ?>
             <div class="page-heading toflip parallax" style="background-image: url('<?php echo base_url() ?>assets/uploads/header/<?php echo $header_profile->image ?>'); ">
        <?php else: ?> 
          <div class="page-heading toflip parallax" style="background-image: url('<?php echo base_url() ?>assets/theme/img/new/Contact_LadiesRoom.jpg'); ">
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
                <div class="row ">
                  <?php alert(); ?>
                    <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2 tofade">
                        <div class="inner ">
                            <h3 class="page-title">CONTACT US TODAY<br>BOOK YOUR NEXT EVENT WITH US</h3>
                            <p class="page-intro">
                             <?php $site_content = get_row('site_content',array('slug'=>'site_content')); ?>
                                    <?php if(!empty($site_content)): ?>             
                                        <?php echo $site_content->address ?> - 
                                        <?php echo $site_content->city ?>,
                                         <?php echo $site_content->zipcode ?>  - 
                                        Ph. <?php echo $site_content->phone ?> - 
                                        Fax <?php echo $site_content->fax ?>
                                        <br>
                                <a href="mailto:<?php echo $site_content->contact_email ?>"><?php echo $site_content->contact_email ?></a>
                            </p>
                            <p class="text-center">
                            HOURS 
                            <br>
                            monday to thursday 
                            <?php echo $site_content->contact_mon_to_thursday_start    ?>
                             - 
                            <?php echo $site_content->contact_mon_to_thursday_end ?> 
                            <br> friday 
                            <?php echo $site_content->contact_friday_start    ?>
                            -
                            <?php echo $site_content->contact_friday_end    ?>
                        </p>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row form-wrapper">
                    <div class="col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 toflip">
                        <div class="inner p-30">
                        <?php echo form_open(base_url().'contactus/index', array('class'=>"contact-form", "id"=>"contact-form")); ?>                            
                                <p class="text-center">Book your next event with us. We will contact you soon.</p>
                                <fieldset>
                                    <input id="lang" type="hidden" name="lang" value="en" />
                                    <input class="form-control " id="nome" type="text" name="name" placeholder="NAME" maxlength="30" autocomplete="off" required />
                                    <!--
                                    <input class="form-control " id="cognome" type="text" name="cognome" placeholder="SURNAME" maxlength="30" autocomplete="off" required />
                                    -->
                                    <input class="form-control " id="telefono" type="text" name="phone" placeholder="PHONE" pattern="[0-9]{1,30}" autocomplete="off" required />
                                    <input class="form-control " id="email" type="email" name="email" placeholder="E-MAIL" maxlength="50" autocomplete="off" required />
                                    <textarea class="form-control " id="messaggio" name="message" required="" rows="1">MESSAGE</textarea>
                                    <input class="btn btn-large btn-block btn-viola" type="submit" value="SEND" />
                                    <p class="text-center"><small>All fields are required.</small></p>                                                                        
                                </fieldset>
                            </form>
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

