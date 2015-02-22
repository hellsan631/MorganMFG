      <?php $header_profile = get_row('header_content',array('slug'=>'profile')); ?>
       <?php if(!empty($header_profile->image)): ?>
         <div class="page-heading abtpg-heading tofade parallax" style="background-image: url('<?php echo base_url() ?>assets/uploads/header/<?php echo $header_profile->image ?>'); ">
       <?php else: ?>
         <div class="page-heading abtpg-heading tofade parallax" style="background-image: url('<?php echo base_url() ?>assets/theme/img/new/profileheader2.jpg'); ">
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
	                        <span class="body_sub_heading blckcontent">
		                        <?php echo $row->description; ?>
                             </span>
	                    </div>
	                </div>
	            </div>
	            <?php } ?>
        	<?php endif; ?>
        <?php $i++; endforeach; endif ?>  

        <?php if($event): ?>
        <div class="eventsection">
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
	                        <span class="body_sub_heading blckcontent">
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
                    <div class="col-md-6">
                        <div  style="background: url('<?php echo base_url() ?>assets/uploads/sections/image/<?php echo $row->image ?>') no-repeat center center ;background-size:cover" class="half-block tofade bg_image">
                            <div class="inner p-90">
                                <h3  class="section_about_head section_head page-title"  ><?php echo $row->heading ?></h3>
                                <p class="section_about_sub_head  whttxt"><?php echo $row->sub_heading ?></p>
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

    h3.section_head{
    	background: url("<?php echo base_url() ?>/assets/theme/img/spacer_white.png") no-repeat scroll center bottom rgba(0, 0, 0, 0);
        color: #fff !important;
    }

   .col-lg-3:hover>p.hoverdiv,.eventsection .col-lg-3:hover>span.hoverdiv p {
  -webkit-animation: FadeIn .3s linear;
  -moz-animation: FadeIn .3s linear;
  -o-animation: FadeIn .3s linear;
  animation: FadeIn .3s linear;
  -webkit-animation-fill-mode: both;
  -moz-animation-fill-mode: both;
  -o-animation-fill-mode: both;
  animation-fill-mode: both;
}

.eventsection .col-lg-3 p.hoverdiv:nth-child(1) {
  -webkit-animation-delay: .2s;
  -moz-animation-delay: .2s;
  -o-animation-delay: .2s;
  animation-delay: .2s;
}

.eventsection .col-lg-3:hover>span.hoverdiv p:nth-child(1) {
  -webkit-animation-delay: .4s;
  -moz-animation-delay: .4s;
  -o-animation-delay: .4s;
  animation-delay: .4s;
}

.eventsection .col-lg-3:hover>span.hoverdiv p:nth-child(2) {
  -webkit-animation-delay: .6s;
  -moz-animation-delay: .6s;
  -o-animation-delay: .6s;
  animation-delay: .6s;
}

.eventsection .col-lg-3:hover>span.hoverdiv p:nth-child(3) {
  -webkit-animation-delay: .8s;
  -moz-animation-delay: .8s;
  -o-animation-delay: .8s;
  animation-delay: .8s;
}

.eventsection .col-lg-3:hover>span.hoverdiv p:nth-child(4) {
  -webkit-animation-delay: 1s;
  -moz-animation-delay: 1s;
  -o-animation-delay: 1s;
  animation-delay: 1s;
}

.eventsection .col-lg-3:hover>span.hoverdiv p:nth-child(5) {
  -webkit-animation-delay: 1.2s;
  -moz-animation-delay: 1.2s;
  -o-animation-delay: 1.2s;
  animation-delay: 1.2s;
}

.eventsection .col-lg-3:hover>span.hoverdiv p:nth-child(6) {
  -webkit-animation-delay: 1.4s;
  -moz-animation-delay: 1.4s;
  -o-animation-delay: 1.4s;
  animation-delay: 1.4s;
}

@-webkit-keyframes FadeIn {
  0% {
    opacity: 0;
    -webkit-transform: scale(.6);
  }

  85% {
    opacity: 1;
    -webkit-transform: scale(1.05);
  }

  100% {
    -webkit-transform: scale(1);
  }
}

@-moz-keyframes FadeIn {
  0% {
    opacity: 0;
    -moz-transform: scale(.6);
  }

  85% {
    opacity: 1;
    -moz-transform: scale(1.05);
  }

  100% {
    -moz-transform: scale(1);
  }
}

@-o-keyframes FadeIn {
  0% {
    opacity: 0;
    -o-transform: scale(.5);
  }

  85% {
    opacity: 1;
    -o-transform: scale(1.05);
  }

  100% {
    -o-transform: scale(1);
  }
}

@keyframes FadeIn {
  0% {
    opacity: 0;
    transform: scale(.5);
  }

  85% {
    opacity: 1;
    transform: scale(1.05);
  }

  100% {
    transform: scale(1);
  }
}

    @media(min-width: 320px) and (max-width: 480px){
        .postsection .col-lg-3{
            width: auto;
            margin-left: 0px
        }

        .socialmenu li a .icondiv{
            width: 40px;
            height: 40px;
            margin-top: 10px;
        }
        .section_about_sub_head{
        	  font-size: 13px !important;
        }
        .section_about_head{
        	  font-size: 20px !important;
        }
    }


</style>

