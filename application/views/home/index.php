<style>
#trace{
	margin-top:-70px !important; 
}
</style>
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
                            <h3 class='home-slider-heading'>
                            	<?php echo strtoupper($row->headline) ?>
                        	</h3>
                            <?php if(!empty($row->sub_headline)): ?>
                            	<h2 class='home-slider-subheading'>
                            		<?php echo $row->sub_headline ?>
                        		</h2>
                            <?php endif; ?>  
                             <p class='home-slider-content' style="background:none; margin-top:0; padding-top:0">
                             	<?php echo @$row->content; ?>
                         	</p><br>
                             <?php if (@$row->btn_txt !="" && @$row->btn_link !="" ): ?>                                 
                                <a href="<?php echo @$row->btn_link ?>" class="home-slider-button btn btn-light btn-new"><?php echo @$row->btn_txt ?></a>
                             <?php endif ?>

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
        <div class="row prod-bl padder-cont " id="uno3">
            <div class="col-lg-8 col-lg-offset-2 tofade animated fadeInUp" style="opacity: 0;">
                <div class="inner">
                    <h3 class="page-title blackheading">
						<?php echo $intro_content->headline; ?>	                    	
                    </h3>
                    <p><span>
                		<?php echo $intro_content->description; ?>    	
                    </span></p>                    
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

        <div class="row prod-bl padder-cont " id="uno3">

            <div class="row">
                <div class="tofade animated fadeInUp" style="opacity: 0;">
                <div class="inner">
                    <h3 class="page-title blackheading">Find us on <br> social media</h3>
                    <?php  $social_links = get_row('social_links',array('id'=>1)); ?>
                <ul class="socialmenu">
                    <li class="facebook">
                    <a href="<?php echo $social_links->facebook ?>" target="_blank">
                    <div class="icondiv fbimg"></div>
                    </a>
                    </li>
                    <li class="twitter"><a href="<?php echo $social_links->twitter ?>" target="_blank"><div class="icondiv twtimg"></div></a></li>   
                    <li class="pinterest"><a href="<?php echo @$social_links->pinterest ?>" target="_blank"><div class="icondiv pimg"></div></a></li>   
                    <li class="google"><a href="<?php echo $social_links->googleplus ?>" rel="author" target="_blank"><div class="icondiv gimg"></div></a></li>
                    <li class="linkedin"><a href="<?php echo @$social_links->linkedin ?>" target="_blank"><div class="icondiv limg"></div></a></li>   
                    <li class="instagram"><a href="<?php echo $social_links->instagram ?>" target="_blank"><div class="icondiv insimg"></div></a></li>
                </ul>
                </div>
            </div>
            </div>            
            <?php $post = get_post(4);  ?>
            <div class="row">
                <div class="col-lg-12 postsection">              
                <?php if ($post): foreach ($post as $row) { ?>
                    <div class="col-lg-3 col-md-3" style="background:url(<?php echo base_url() ?>assets/uploads/news/<?php echo $row->image; ?>); background-repeat:no-repeat; background-size:cover; background-position:center; " >
                    <div class="opdiv"></div>
                    <p class="datep"><?php echo date('F d', strtotime($row->created)); ?></p>
                    <h3 class="posth3"><?php echo word_limiter($row->title,3); ?></h3>
                    <br>
                    <a href="<?php echo base_url() ?>news/detail/<?php echo $row->slug; ?>" class="btn new-btn btn-light">VIEW POST</a>
                    </div>                
                <?php } endif;  ?>
            </div>
            </div>
        </div>

<style>
.socialmenu{
	margin: 0 auto !important; 
	display:table !important;
	padding-left: 0px !important;
}
@media(min-width:361px){
	.socialmenu li:first-child a .icondiv{
		margin-left: 0px !important;
	}
}
</style>

<style type="text/css">
    .socialmenu li a .icondiv{
        width: 80px;
        height: 80px;
        background-size: cover;
        float: left;
        margin-left: 40px;
    }

    .socialmenu li a .fbimg{
        background-image: url('<?php echo base_url() ?>assets/theme/socialicon/fb.png');
    }
    .socialmenu li a .fbimg:hover{
        background-image: url('<?php echo base_url() ?>assets/theme/socialicon/fb_hover.png');
    }

    .socialmenu li a .twtimg{
        background-image: url('<?php echo base_url() ?>assets/theme/socialicon/twitter.png');
    }
    .socialmenu li a .twtimg:hover{
        background-image: url('<?php echo base_url() ?>assets/theme/socialicon/twitter_hover.png');
    }

    .socialmenu li a .gimg{
        background-image: url('<?php echo base_url() ?>assets/theme/socialicon/gplus.png');
    }
    .socialmenu li a .gimg:hover{
        background-image: url('<?php echo base_url() ?>assets/theme/socialicon/gplus_hover.png');
    }

    .socialmenu li a .insimg{
        background-image: url('<?php echo base_url() ?>assets/theme/socialicon/insta.png');
    }
    .socialmenu li a .insimg:hover{
        background-image: url('<?php echo base_url() ?>assets/theme/socialicon/insta_hover.png');
    }

    .socialmenu li a .pimg{
        background-image: url('<?php echo base_url() ?>assets/theme/socialicon/pinterest.png');
    }
    .socialmenu li a .pimg:hover{
        background-image: url('<?php echo base_url() ?>assets/theme/socialicon/pinterest_hover.png');
    }

    .socialmenu li a .limg{
        background-image: url('<?php echo base_url() ?>assets/theme/socialicon/linked.png');
    }
    .socialmenu li a .limg:hover{
        background-image: url('<?php echo base_url() ?>assets/theme/socialicon/linked_hover.png');
    }

    .datep{
        background:url("<?php echo base_url() ?>assets/theme/img/spacer_white.png") no-repeat scroll center bottom rgba(0, 0, 0, 0);
        padding-bottom: 10px;
        text-transform: uppercase;
    }

    .postsection{
        margin-top: 50px;
    }

    .postsection .col-lg-3{
        width: 23%;
        min-height: 400px;
        margin-left: 20px
    }

    .postsection .col-lg-3{
        text-align: center;
        padding: 80px 20px;
        z-index: 1;    
        color: #fff;  

    }

    .postsection .col-lg-3 .opdiv{
        content: ' ';
        height: 100%;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        background-color: rgba(94,56,39,.6);
        z-index: -1;
    
        transition-duration: 0.4s;
		transition-property: background-color;
    }

    h3.posth3{
        font-size: 16px;
        color: #fff;
    }


    .postsection .col-lg-3:hover .opdiv{
        background-color: rgba(0,0,0,.7);
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
    }

    @media(min-width: 360px) and (max-width: 480px){
        .postsection .col-lg-3{
            width: auto;
            margin-left: 0px;
        }

        .socialmenu li a .icondiv{
            width: 40px;
            height: 40px;
            margin-top: 10px;
        }
    }

    @media(min-width: 768px) and (max-width: 1024px){
        .postsection .col-lg-3{
            width: auto;
            margin-left: 0px;
        }
    }


    .carousel-inner .item h3{
        color: #fff;
    }
</style>
<style>
.carousel-indicators li{
	width:35px !important; 
	background-color:rgba(0,0,0,0) !important; 
	border:2px solid #fff !important; 
	border-radius:0px !important;
}
.carousel-indicators li.active{
	background-color:rgba(255,255,255,1) !important; 
}
.carousel-indicators{
	margin-left: 0px !important;
	padding-right: 1% !important;
	left:0 !important;
	width: 100% !important;
	text-align: right !important;
	bottom: 0 !important;
}
.carousel-caption{
	top:15% !important;
}
.home-slider .carousel-caption h2{
    margin-top: 20px;
}
</style>
