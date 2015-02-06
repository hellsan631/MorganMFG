       <?php $header_profile = get_row('header_content',array('slug'=>'profile')); ?>
       <?php if(!empty($header_profile->image)): ?>
         <div class="page-heading tofade parallax" style="background-image: url('<?php echo base_url() ?>assets/uploads/header/<?php echo $header_profile->image ?>'); ">
       <?php else: ?>
         <div class="page-heading tofade parallax" style="background-image: url('<?php echo base_url() ?>assets/theme/img/new/profileheader2.jpg'); ">
       <?php endif; ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center abouthead">
                        
                        <h3 class="page-title">
                            <?php if(!empty($header_profile->heading)){ ?>
                            <?php echo $header_profile->heading; ?>
                            <?php } ?>
                        </h3>
                        
                        <?php if(!empty($header_profile->content)): ?>
                          <p class="headp"> <?php echo $header_profile->content ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>



        <?php if ($content): $i=1; foreach($content as $row): ?>
        	<?php if($i==1): ?>
	            <?php if ($row->type == 1){ ?>
	                <div class="img-block b1" style="background-image:url('<?php echo base_url() ?>assets/uploads/about/<?php echo $row->image; ?>')"></div>
	            <?php }elseif($row->type == 2){ ?>
	            <div class="row prod-bl padder-cont <?php //if($i==0){ echo 'hero'; } ?>" id="uno<?php echo $row->id ?>">
	                <div class="col-lg-8 col-lg-offset-2 tofade">
	                    <div class="inner">
	                        <h3 class="page-title body_heading"><?php echo $row->heading; ?></h3>
	                        <span class="body_sub_heading">
		                        <?php echo $row->description; ?>
                             </span>
	                    </div>
	                </div>
	            </div>
	            <?php } ?>
        	<?php endif; ?>
        <?php $i++; endforeach; endif ?>  

        <?php if($event): ?>
        <div class="row eventsection">
            <?php foreach ($event as $event): ?>
             <div class="col-lg-3 col-md-3 overflowcontrol">                
                <p class="hoverdiv" style="display:none">
                    <?php echo $event->title ?> <br>
                </p>
				<span class="hoverdiv" style="display:none">
	                <?php echo $event->description ?>
				</span>

                <p class="normal">
                    <?php if(trim($event->image)): ?>
                    <img src="<?php echo base_url() ?>assets/uploads/event/<?php echo $event->image ?>" alt="Event Image">
                     <?php endif; ?>
                    <br>
                    <br>
                    <span class="event_heading">
	                    <?php echo $event->title ?>
                    </span>	
                </p>
            </div>
            <?php endforeach ?>
        </div>
		<?php endif; ?>

        <?php if ($content): $i=1; foreach($content as $row): ?>
        	<?php if($i!=1): ?>
	            <?php if ($row->type == 1){ ?>
	                <div class="img-block b1" style="background-image:url('<?php echo base_url() ?>assets/uploads/about/<?php echo $row->image; ?>')"></div>
	            <?php }elseif($row->type == 2){ ?>
	            <div class="row prod-bl padder-cont <?php //if($i==0){ echo 'hero'; } ?>" id="uno<?php echo $row->id ?>">
	                <div class="col-lg-8 col-lg-offset-2 tofade">
	                    <div class="inner">
	                        <h3 class="page-title body_heading"><?php echo $row->heading; ?></h3>
	                        <span class="body_sub_heading">
	                        	<?php echo $row->description; ?>
	                        </span>
	                    </div>
	                </div>
	            </div>
	            <?php } ?>
        	<?php endif; ?>
        <?php $i++; endforeach; endif ?>  


        <nav id="block-navigation">
            <ul id="section_nav">
                <?php if ($content): $j=0; foreach($content as $row): if($row->type == 2){ ?>
                <li class="<?php if($j ==0){ echo 'active'; } ?>"><a href="#uno<?php echo $row->id; ?>" title="<?php echo $row->heading ?>" data-toggle="tooltip" data-placement="left"></a></li>                
                <?php } $j++; endforeach; endif ?>        
            </ul>
        </nav>

        <!-- <div class="scroll-top tofade p-70"> 
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <a href="#" class="btn btn-light scroll-top">TOP</a>
                    </div>
                </div>
            </div>
        </div> -->

   		<?php $sections = get_sections() ?>
        <?php if($sections):?>
        <section class="row-1 padder-cont">
            <div class="row">
               <?php foreach($sections as $row): ?>
                    <div class="col-sm-6">
                        <div  style="background: url('<?php echo base_url() ?>assets/uploads/sections/image/<?php echo $row->image ?>') no-repeat center center ;background-size:cover" class="half-block tofade bg_image">
                            <div class="inner p-90">
                                <h3  class="call-to-action-heading page-title"  ><?php echo $row->heading ?></h3>
                                <p class="call-to-action-subheading  whttxt"><?php echo $row->sub_heading ?></p>
                                <p><a href="<?php echo $row->button_link ?>" class="btn btn-light btn-new "><?php echo $row->button_text ?></a></p>
                            </div>
                        </div>        
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

<style type="text/css">
    .prod-bl{
        padding: 100px 0 100px;
    }

    .abouthead{
        padding-left: 10%;
        padding-right: 10%;
    }    

    .page-heading:before {
    background-color: #fff;
    opacity: 0;
    }

    .eventsection{
        text-align: center;
    }  

    /*.eventsection .col-lg-3:first-child{
        background-color: #1f1206;
    }*/


    .eventsection .col-lg-3:hover{
        background-color: #1f1206;
    }
    .eventsection .col-lg-3:hover .normal{
        display: none
    }

    .eventsection .col-lg-3:hover .hoverdiv{
        display: block !important;
    }


    .eventsection .col-lg-3{
        padding-top: 40px;
        padding-bottom: 30px;
        min-height: 220px;
        background-color: #593420;
        color:#fff;
    }
    .eventsection .col-lg-3 p{
        text-transform: uppercase;
        text-align: center;
        font-weight: bold;
        font-size: 14px;
        padding-left: 20px;
        padding-right: 20px;
        
    }

    .page-heading{
    	margin-top: 0px;
    }

    .home-slider .carousel-caption{
        top: 25%;
    }
    .overflowcontrol{
    	max-height: 220px;
    	overflow: hidden !important;
    }

</style>