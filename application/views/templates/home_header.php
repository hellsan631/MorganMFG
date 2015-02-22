<!DOCTYPE html>
<html lang="en">
  <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <?php $slug = $this->uri->segment(1); if($slug == ""){ $slug = "index"; }  $meta = get_seo_page($slug); ?>
        <title><?php if(isset($meta) && !empty($meta->title)){ echo $meta->title; }else{ echo 'Morgan Manufacturing'; } ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, height=device-height" />        
        <?php if($meta): ?>
            <meta name="description" content="<?php echo $meta->description; ?>">
            <meta name="keywords" content="<?php echo $meta->keyword; ?>">
        <?php endif; ?>

        <!-- Bootstrap -->
        <link href="<?php echo base_url() ?>assets/theme/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!--page style-->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/css/style.css" type="text/css">

        <!--Jquery-->
        <script src="<?php echo base_url() ?>assets/theme/js/jquery-1.11.0.js"></script>
        
        <?php if($this->uri->segment(1) != 'home' && $this->uri->segment(1) != '' ){ ?>
        <style type="text/css">
/*            .navbar-statica .navbar-nav li{
                min-width: 10% !important;
            }
*/
            .navbar-statica{
                background: #1b171c;
                border-bottom: solid 2px #1b171c;
            }
        </style>
        <?php } ?>

    </head>
    <!--serv-page -->
    <?php if($this->uri->segment(1) == 'amenities'){ $ser = 'serv-page';  }else{ $ser = ""; } ?>
    <body class="<?php echo $ser; ?>">

        <header id="header">
            <?php 
                if(FALSE){ // isset($fixednav)
                    $navcls = 'navbar-fixed-top navbar-scroll navbar-inverse animated';
                }else{
                    $navcls = 'navbar navbar-default navbar-statica animated';
                }
             ?>

<?php /*
            <nav class="<?php echo $navcls; ?>" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand animated" href="<?php echo base_url() ?>"></a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="navbar-collapse collapse">
                    <ul id="main-nav" class="nav navbar-nav">
                       
                       

                        <li class="aboutli"><a href="<?php echo base_url(); ?>about"><span class="line">About</span></a></li>
                        <li class="spaceli"><a href="<?php echo base_url(); ?>space"><span class="line">Space</span></a></li>
                        <li class="floorplanli" style="padding-left:22px; padding-right:22px;" ><a href="<?php echo base_url(); ?>downloadfloorplan"><span class="line">Floor Plans</span></a></li>
                        
                        <?php get_center_logo(); ?>

                        <li class="catringli"><a href="<?php echo base_url() ?>catering"><span class="line cp">Catering</span></a></li>
                        <!--li><a href="<?php echo base_url() ?>catering_partners"><span class="line cp">Catering Partners</span></a></li-->
                        <li><a href="<?php echo base_url() ?>news"><span class="line">News</span></a></li>
                        <li><a href="<?php echo base_url() ?>contact"><span class="line">Contact</span></a></li>
                    </ul>
                </div>
            </nav>
        */ ?>


<style type="text/css">
	.div2
	{
	margin-left: 0px;
    /*margin-right: auto;*/
    padding-left: 30px;
    padding-right: 10px;
	}

	.navbar-statica .navbar-brand{
		position: relative;
	}

	@media(min-width: 800px) and (max-width: 1280px){
		/*.div2{
			margin-left: 60px;
		}*/
	}

    @media(min-width: 768px) and (max-width: 1024px){
     /*   .div2{
            margin-left: 60px;
        }*/
    }

</style>
        

        <style type="text/css">
        /*new css*/
            section#trace h4, footer#footer h4{
                font-size: 36px;                
            }

            section#trace p{
                background:url("<?php echo base_url() ?>assets/theme/img/spacer_white.png") no-repeat top center;
                margin-top: 10px;

            }

            footer#footer p.spacer {
                padding: 0px;
                padding-top: 5px;
                margin: 10px 0 0 0;
                text-align: center;
                background:url("<?php echo base_url() ?>assets/theme/img/spacer_white.png") no-repeat top center;                
            }

            footer#footer .prima{
                background-color: #000;
            }

            .form-control.light, .result .btn.btn-large.btn-block.btn-light{
                border-color:#fff;
            }

            .btn-new{
                font-size: 14px;
                font-family: 'Josefin Sans', sans-serif;
                /*font-weight: normal;*/
                text-transform: uppercase;
            }

            .p-30{
                padding-top: 30px;
                padding-bottom: 30px;
            }

            h3.whitetxt{
                color: #fff;
                background:url("<?php echo base_url() ?>assets/theme/img/spacer_white.png") no-repeat scroll center bottom rgba(0, 0, 0, 0);
                margin-bottom: 20px;
            }

           

            .page-heading  h3.page-title{
                padding-top: 180px;
            }

            

            .whttxt{
                color: #fff;
            }

            .inner p{
                padding-top: 10px;
            }

            section#trace{
                background-image: url('<?php echo base_url() ?>assets/theme/img/form_bg.png');
            }

            .headp{
                color: #fff;
                text-align: center;
            }

             .prod-bl{
                padding: 100px 0 100px;
            }

            h3.page-title{                
                background:url("<?php echo base_url() ?>assets/theme/img/spacer.png") no-repeat scroll center bottom rgba(0, 0, 0, 0);                
            }

            h3.blackheading{
                color: #000;
            }

            ul.socialmenu{
                list-style: none;               
            }
            ul.socialmenu li{
                display: inline;
            }

             @media(min-width: 320px) and (max-width: 480px){
                .page-heading h3.page-title{
                    padding-top: 40px
                }
            }

        </style>

<style>
.light{
    font-family: 'Josefin Sans',sans-serif !important;
    text-align: center !important;
}
.light::-moz-placeholder{
    color: #fff;
    opacity: 1;
}
.light::-webkit-input-placeholder{
    color: #fff;
    opacity: 1;
}
.limg{
    width: 160px;
}
@media(max-width: 770px){
    .page-heading{
        background-size: cover;
    }
}
@media(min-width: 770px){
    .page-heading{
        margin-top:90px; 
        position: relative !important;
    }
}
h3.call-to-action-heading{
    background:url("<?php echo base_url() ?>assets/theme/img/spacer_white.png") no-repeat scroll center bottom rgba(0, 0, 0, 0);
}
</style>

<?php add_dynamic_css(); ?>


			<nav class="navbar navbar-inverse navbar-fixed-top">
			  <div class="div2">
			    <div class="navbar-header">
			      <a  href="<?php echo base_url() ?>" class="navbar-brand animated">
			      </a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
			    </div>
			    <div  class="navbar-collapse collapse" id="navbar">
                    <ul id="main-nav" class="nav navbar-nav">                        
                        <li id="mhome" style="display:none"><a href="<?php echo base_url(); ?>"><span >Home</span></a></li>
                        <li ><a href="<?php echo base_url(); ?>about"><span >About</span></a></li>
                        <li ><a href="<?php echo base_url(); ?>space"><span >Space</span></a></li>
                        <li ><a href="<?php echo base_url(); ?>downloadfloorplan"><span >Floor Plans</span></a></li>
                        <li ><a href="<?php echo base_url() ?>catering"><span class="line cp">Catering</span></a></li>
                        <li><a href="<?php echo base_url() ?>news"><span >News</span></a></li>
                        <li><a href="<?php echo base_url() ?>contact"><span >Contact</span></a></li>
                       <?php $tour_btn = get_row('site_content',array('slug'=>'site_content')) ?>
                        <li><a id="tour_btn"  href="<?php echo $tour_btn->tour_btn_link ?>"><button class="btn btn-light btn-new"><?php echo $tour_btn->tour_btn_text ?></button></a></li>
                    </ul>
			    </div>
			  </div>
			</nav>


        </header>
        <script type="text/javascript">
            function linktopage(page){               
                window.location.href="<?php echo base_url() ?>"+page;
            }
        </script>
        <?php $logo = getlogo(); if($logo){ ?>
            <style type="text/css">
                .navbar-statica .navbar-brand{
                    background: url('<?php echo base_url() ?>assets/uploads/home/<?php echo $logo; ?>') no-repeat left center
                }
            </style>
        <?php } ?>

    

<?php if(isset($pagetitle) && $pagetitle=="Homepage"): ?>
<style type="text/css">
	.navbar-statica{
	 border-bottom: 2px none;
	}
</style>
<?php endif; ?>


<?php if($this->uri->segment(1)=="home" || $this->uri->segment(1)=="" || $this->uri->segment(1)=="about"): ?>
    <script type="text/javascript">
    $(window).scroll(function(){
        scrollHeader();
    });
    $(window).ready(function(){
        scrollHeader();
    });
    $(window).resize(function(){
        scrollHeader();
    });

    function scrollHeader()
    {
        var top = $(window).scrollTop();
        if(top < 90)
        {
            $('.navbar-statica').css('background','none repeat scroll 0 0 transparent');
            $('.navbar-statica').css('border-bottom','2px none');
        }
        else
        {
            $('.navbar-statica').css('background','none repeat scroll 0 0 #1B171C');
            $('.navbar-statica').css('border-bottom','2px solid #1b171c');
        }
    }   
    </script>  
<?php endif; ?>  


