<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MODA MENTORE</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url() ?>assets/theme/assets/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!--Font Awesome-->
    <link href="<?php echo base_url() ?>assets/theme/assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!--VIdeo Slider-->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/css/flexslider.css" type="text/css" media="screen" charset="utf-8" />

    <!--fancy box-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/theme/assets/fancybox/jquery.fancybox-1.3.4.css" media="screen" />

    <!--Responsive Munu-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/theme/css/component.css" />

    <!--Pages Style-->
    <link href="<?php echo base_url() ?>assets/theme/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/theme/css/responsive.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/theme/css/changefont.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
  </head>
  <body>

    <header id="header">
      <div class="container">
        <a href="<?php echo base_url() ?>" class="logo"><img src="<?php echo base_url() ?>assets/theme/img/logo.png"></a>
        <ul class="nav navbar-nav">
          <li <?php if(@$menuactive == 'about') echo "class='active'"; ?> ><a href="<?php echo base_url() ?>about">ABOUT<span class="line"></span></a></li>          
          <li class="dropdown" <?php if(@$menuactive == 'services') echo "class='active'"; ?> >
             <a id="drop1" href="<?php echo base_url() ?>services" role="button" >
              SERVICES &nbsp; <!-- <b class="caret"></b> -->
             </a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                <li><a tabindex="-1" href="<?php echo base_url() ?>closet">WARDROBE TUNE-UP</a></li>
                <li class="divider"></li>
                <li><a tabindex="-1" href="<?php echo base_url() ?>styling">STYLE SESSION</a></li>
                <li class="divider"></li>
                <li><a tabindex="-1" href="<?php echo base_url() ?>personal_shopping">PERSONAL SHOPPING</a></li>
              </ul>
            </li>
            
          <li <?php if(@$menuactive == 'blog') echo "class='active'"; ?> ><a href="<?php echo base_url() ?>blog">BLOG<span class="line"></span></a></li>
          <!-- <li <?php if(@$menuactive == '00') echo "class='active'"; ?> ><a href="#">MOBILE APP<span class="line"></span></a></li> -->
          <li <?php if(@$menuactive == 'contactus') echo "class='active'"; ?> ><a href="<?php echo base_url() ?>contactus">CONTACT US<span class="line"></span></a></li>
          <!-- <li <?php if(@$menuactive == 'myaccount') echo "class='active'"; ?> ><a href="<?php echo base_url() ?>myaccount">MY ACCOUNT<span class="line"></span></a></li> -->
           
        </ul>
        <ul class="soc">
          <?php $social = get_social_links(); ?>
          <li><a href="<?php echo $social->facebook ?>" target="_blank " ><i class="fa fa-facebook"></i></a></li>
          <li><a href="<?php echo $social->twitter ?>" target="_blank" ><i class="fa fa-twitter"></i></a></li>
          <li><a href="<?php echo $social->instagram ?>" target="_blank" ><i class="fa fa-instagram"></i></a></li>
          <li><a href="<?php echo $social->pinterest ?>" target="_blank" ><i class="fa fa-pinterest"></i></a></li>
        </ul>
        <div id="dl-menu" class="dl-menuwrapper">
          <button class="dl-trigger">Open Menu</button>
          <ul class="dl-menu">
            <li><a href="<?php echo base_url() ?>about">ABOUT</a></li>
            <li><a href="<?php echo base_url() ?>services">SERVICES</a></li>
            <li><a href="<?php echo base_url() ?>closet">WARDROBE TUNE-UP</a></li>
            <li><a href="<?php echo base_url() ?>styling">STYLE SESSION</a></li>
            <li><a href="<?php echo base_url() ?>personal_shopping">PERSONAL SHOPPING</a></li>
            <li><a href="<?php echo base_url() ?>blog">BLOG</a></li>
            <!-- <li><a href="#">MOBILE APP</a></li> -->
            <li><a href="<?php echo base_url() ?>contactus">CONTACT US</a></li>
            <!-- <li><a href="<?php echo base_url() ?>myaccount">MY ACCOUNT</a></li> -->
          </ul>
        </div>
      </div>
    </header>

    <style type="text/css">
      .dropdown:hover .dropdown-menu {
          display: block;
       }

     .dropdown-menu{
        background: rgba(0,0,0,.9);
       
      }
    </style>







<style type="text/css">
  #slider {
    height: auto !important; 
  }
  .slide-desc a{
    position: relative;
    bottom: -25%;
  }

  .slide-desc p{
    font-style: normal;
    font-size: 30px;
  }

  .slide-desc{
    width: 68%;
    left: 40%;
  }


  .slide-desc h1{
  margin-top: 20%;
  font-size: 75px;
  }

  .video_black_cover{
    /*height: 800px;*/
    width:100%;
    position: absolute;
    background: #000;
    top: 0;
    opacity: .5;
  }
</style>







<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/vBackground/js/libs/swfobject.js"></script> 
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/vBackground/js/libs/modernizr.video.js"></script> 
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/vBackground/js/video_background.js"></script> 








<section id="slider">

  

      <div class="flexsliderr">

        <ul class="slidess">

      <?php if($homevideos): $i=0; foreach($homevideos as $video):  ?>
          <li id="slide-<?php echo $i ?>">

            
                <div id="cover-<?php echo $i ?>" class="video_black_cover"></div>


            <div class="slide-desc">

              <?php if($video->heading != ''){ ?>
                <h1><?php echo $video->heading ?></h1>
              <?php } ?>

              <?php if($video->subheading != ''){ ?>
                <p><?php echo $video->subheading ?></p>
              <?php } ?>

              <?php if($video->btn_text != '' && $video->btn_link != '' ){ ?>  
                <button onclick="window.location = '<?php echo $video->btn_link ?>'"><?php echo $video->btn_text ?></button>
              <?php } ?>

              <a href="#blog1"><img src="<?php echo base_url() ?>assets/theme/img/arrow.png" class="img-responsive"></a>

            </div>

          </li>

        <!--   <li id="slide-1">

            <video id="video-1" >

              <source type="video/mp4" src="<?php echo base_url() ?>assets/theme/video/Mark.mp4">

              <source type="video/webm" src="<?php echo base_url() ?>assets/theme/video/Mark.webm">

              <source type="video/ogg" src="<?php echo base_url() ?>assets/theme/video/Mark.ogv">

            </video>

            <div class="slide-desc">

              <h1>Do More With Less</h1>

              <p>Stop buying clothes. Start building a wardrobe.</p>

              <button>GET STARTED</button>

              <a href="#blog1"><img src="<?php echo base_url() ?>assets/theme/img/arrow.png" class="img-responsive"></a>

            </div>

          </li>

          <li id="slide-2">

            <video id="video-2" >

              <source type="video/mp4" src="<?php echo base_url() ?>assets/theme/video/Kathy.mp4">

              <source type="video/webm" src="<?php echo base_url() ?>assets/theme/video/Kathy.webm">

              <source type="video/ogg" src="<?php echo base_url() ?>assets/theme/video/Kathy.ogv">

            </video>

            <div class="slide-desc">

              <h1>Do More With Less</h1>

              <p>Stop buying clothes. Start building a wardrobe.</p>

              <button>GET STARTED</button>

              <a href="#blog1"><img src="<?php echo base_url() ?>assets/theme/img/arrow.png" class="img-responsive"></a>

            </div>

          </li> -->
          <?php  $i++; break; endforeach; endif; ?>

        </ul>

      </div>

    </section>   

    <script>
      jQuery(document).ready(function($) {
        var Video_back = new video_background($("#for_example"), { 
          "position": "absolute", //Stick within the div
          "z-index": "-1",    //Behind everything

          "loop": true,       //Loop when it reaches the end
          "autoplay": true,   //Autoplay at start
          "muted": true,      //Muted at start

          "mp4":"<?php echo base_url() ?>assets/plugins/vBackground/videos/intro.mp4" ,  //Path to video mp4 format
          "webm":"<?php echo base_url() ?>assets/plugins/vBackground/videos/intro.webm" ,  //Path to video webm format
          "video_ratio": 1.7778,    // width/height -> If none provided sizing of the video is set to adjust

          "fallback_image": "<?php echo base_url() ?>assets/plugins/vBackground/videos/main.jpg",  //Fallback image path
        });



        <?php if($homevideos): $i=0; foreach($homevideos as $video):  ?>

        var Video_back<?php echo $i ?> = new video_background($("#slider"), { 
          "position": "absolute", //Stick within the div
          "z-index": "-1",    //Behind everything

          "loop": true,       //Loop when it reaches the end
          "autoplay": true,   //Autoplay at start
          "muted": true,      //Muted at start

          "mp4":"<?php echo base_url() ?>assets/uploads/videos/<?php echo $video->mp4; ?>",
          "webm":"<?php echo base_url() ?>assets/uploads/videos/<?php echo $video->webm; ?>",
          "video_ratio": 1.7778,    // width/height -> If none provided sizing of the video is set to adjust

          "fallback_image": "<?php echo base_url() ?>assets/plugins/vBackground/videos/main.jpg",  //Fallback image path
        });

        <?php  $i++; break; endforeach; endif; ?>

        
      });
    </script>



    <section id="blog1" style="margin-top: 39%;">

      <div class="container">

        <h1 class="text-center">BLOG</h1>

        <div class="small-dvd"></div>

        <h5 class="text-center"><?php echo $page_content->home_blog_subheading; ?></h5>

        <div class="row blog-blocks">

          <?php if($posts): foreach($posts as $row): ?>

          <div class="col-sm-4">

            <img src="<?php echo base_url() ?>assets/uploads/news/<?php echo $row->image ?>">

            <div class="text">

              <p><strong><?php echo $row->title ?></strong></p>

              <!-- <p>By Jessie Pinkman in Photography</p> -->

              <p><?php echo word_limiter($row->excerpt, 20); ?></p>

              <a href="<?php echo base_url() ?>blog/detail/<?php echo $row->slug; ?>" class="btn btn-grey">READ MORE</a>

            </div>

          </div>

        <?php endforeach; endif; ?>

        <!--   <div class="col-sm-4">

            <img src="<?php echo base_url() ?>assets/theme/img/blog2.png">

            <div class="text">

              <p><strong>Imagine your look</strong></p>

              <p>By Jessie Pinkman in Photography</p>

              <p>Quisque ullamcorper pretium turpis, in iaculis ectus euismod phasellus at quam fringilla, rutrum nisl ac, porta arcu. Pellentesque venenatis leo. </p>

              <a href="#" class="btn btn-grey">READ MORE</a>

            </div>

          </div>

          <div class="col-sm-4">

            <img src="<?php echo base_url() ?>assets/theme/img/blog3.png">

            <div class="text">

              <p><strong>Never ending winter blues</strong></p>

              <p>By Jessie Pinkman in Photography</p>

              <p>Quisque ullamcorper pretium turpis, in iaculis ectus euismod phasellus at quam fringilla, rutrum nisl ac, porta arcu. Pellentesque venenatis leo. </p>

              <a href="#" class="btn btn-grey">READ MORE</a>

            </div>

          </div> -->

        </div>

      </div>

    </section>  



    <section id="mentions">

      <div class="container">

        <a href="<?php echo base_url() ?>mentions" style="text-decoration:none;">
          <h1 class="text-center">MODA MENTORE MENTIONS</h1>
        </a>

        <div class="small-dvd"></div>

        <h5 class="text-center"><?php echo $page_content->home_mention_subheading; ?></h5>

        <div class="row">         
          <?php if ($mentions): foreach ($mentions as $row): ?>
          <a href="<?php echo base_url() ?>mentions/detail/<?php echo $row->slug ?>" style="text-decoration:none;">
            <div class="col-sm-6">
              <div class="row mentions-bl">
                <div class="col-sm-3"><img src="<?php echo base_url() ?>assets/uploads/mentions/<?php echo $row->image ?>" class="img-circle img-responsive"></div>
                <div class="col-sm-9">
                  <h4><?php echo $row->title ?></h4>
                  <p><?php echo $row->excerpt; ?></p>
                  <a href="<?php echo base_url() ?>mentions/detail/<?php echo $row->slug ?>" class="btn btn-white">READ MORE</a>
                </div>
              </div>
            </div>
          </a>
        <?php endforeach; endif; ?>   
        </div>

      </div>

    </section>   



    <section class="clients">

      <div class="container">

        <h1 class="text-center">HAPPY CLIENTS</h1>

        <div class="small-dvd"></div>

        <div class="text-center filter">

          <a href="#" data-filter="*" class="btn btn-white current">ALL</a>

          <a href="#" data-filter=".wardrobe" class="btn btn-white">WARDROBE TUNE-UP</a>

          <a href="#" data-filter=".styling" class="btn btn-white">STYLING</a>

          <a href="#" data-filter=".pers" class="btn btn-white">PERSONAL SHOPPING</a>

        </div>

        <div class="row gallery">

          <?php if($happy_clients):  foreach($happy_clients as $row): ?>

            <?php
              switch ($row->category) {
                case '1':
                  $class = 'wardrobe';
                  break;
                
                case '2':
                  $class = 'styling';
                  break;

                case '3':
                  $class = 'pers';
                  break;
              }
            ?>

            <div class="col-sm-4 <?php echo $class ?>">

              <a class="example4" title="<?php echo str_replace('"', "'", $row->testimonial);   //echo wordwrap(, 80, "<br />") ?>" href="<?php echo base_url() ?>assets/uploads/happy_clients/<?php echo $row->image ?>"><img src="<?php echo base_url() ?>assets/uploads/happy_clients/<?php echo $row->image ?>"></a>

              <h5> <a class="example4" title="<?php echo str_replace('"', "'", $row->testimonial);   //echo wordwrap(, 80, "<br />") ?>" href="<?php echo base_url() ?>assets/uploads/happy_clients/<?php echo $row->image ?>"><?php echo $row->name ?></a></h5>

              <p><?php echo $row->location ?></p>

            </div>

          <?php endforeach; endif; ?>

          <!-- <div class="col-sm-4 styling">

            <a id="example4" href="<?php echo base_url() ?>assets/theme/img/gall2.jpg"><img src="<?php echo base_url() ?>assets/theme/img/gall2.jpg"></a>

            <h5>Cyndy Phillips</h5>

            <p>San Francisco</p>

          </div>

          <div class="col-sm-4 app">

            <a id="example4" href="<?php echo base_url() ?>assets/theme/img/gall3.jpg"><img src="<?php echo base_url() ?>assets/theme/img/gall3.jpg"></a>

            <h5>Julie Denneky</h5>

            <p>Chicago</p>

          </div>

          <div class="col-sm-4 closet">

            <a id="example4" href="<?php echo base_url() ?>assets/theme/img/gall4.jpg"><img src="<?php echo base_url() ?>assets/theme/img/gall4.jpg"></a>

            <h5>Sandi Tinnamon</h5>

            <p>Los Angeles</p>

          </div>

          <div class="col-sm-4 styling">

            <a id="example4" href="<?php echo base_url() ?>assets/theme/img/gall5.jpg"><img src="<?php echo base_url() ?>assets/theme/img/gall5.jpg"></a>

            <h5>Betsy Najoski</h5>

            <p>Dallas</p>

          </div>

          <div class="col-sm-4 app">

            <a id="example4" href="<?php echo base_url() ?>assets/theme/img/gall6.jpg"><img src="<?php echo base_url() ?>assets/theme/img/gall6.jpg"></a>

            <h5>Lupi Sanchez</h5>

            <p>New York</p>

          </div> -->

        </div>

      </div>

    </section>



    <section class="carusel text-center">

      <img src="<?php echo base_url() ?>assets/theme/img/twt.png">

      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->

        <ol class="carousel-indicators">

          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>

          <li data-target="#carousel-example-generic" data-slide-to="1"></li>

          <li data-target="#carousel-example-generic" data-slide-to="2"></li>

          <!-- <li data-target="#carousel-example-generic" data-slide-to="3"></li> -->

        </ol>



        <!-- Wrapper for slides -->
        <?php $tweets = get_twitter_feed();  ?>
        <div class="carousel-inner">        
           <?php if($tweets): $i=1; foreach ($tweets as $tweet): ?>            
          <div class="item <?php if($i == 1) echo 'active'; ?>">            
            <p><?php echo $tweet->text; ?></p>
          </div>
          <?php  $i++; endforeach; endif; ?>
        </div>

      </div>

    </section>

    <style type="text/css">
      .blog-blocks img{
        width: auto;
        max-width: 100%;
        max-height: 350px;
      }


      #fancybox-title{
        margin-left: 0px !important;
        padding: 10px;
      }

      .gallery h5 a{
        color: #1f1f1f;
        text-decoration: none;
      }
  
    .gallery h5 a{
        color: #fff;
      }
    </style>
    <script type="text/javascript">
      $(document).ready(function(){
        setInterval(function(){
          var i = 0;
          var height;
          $('.flexslider ul.slides li').each(function(){
            height = $(this).find('video').height();
            $('#cover-'+i).height(height);
            i++;
          });
        },500);
      });
    </script>














     <?php /* $uri = $this->uri->segment(1); if ($uri != "" && $uri !="blog" && $uri !="home" ): */ ?>
 <footer class="last">
      <div class="container">
        <div class="row">
          <?php  $uri = $this->uri->segment(1); if ($uri == "closet" || $uri =="styling" || $uri =="personal_shopping" || $uri =="consultation" ):  ?>
          <div class="col-sm-12 text-right">
            <a href="<?php echo base_url() ?>services" id="bktoservice" class="top">BACK TO SERVICES<i class="fa fa-reply"></i></a>
          </div>
          <?php else:  ?>
            <div class="col-sm-12 text-right">
            <a href="#" class="top">BACK TO TOP <i class="fa fa-long-arrow-up"></i></a>
            </div>
          <?php endif; ?>
          <div class="col-sm-5">
            <img src="<?php echo base_url() ?>assets/theme/img/sub.png">
            <form class="form-inline" role="form">
              <div class="form-group">
                <label class="sr-only" for="exampleInputEmail2">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail2" placeholder="your-email@gmail.com">
              </div>
              <button type="submit" class="btn btn-grey">SUBMIT</button>
            </form>
          </div>
          <div class="col-sm-7">
            <ul class="footer-menu">
              <!-- <li><a href="#">Press</a></li> -->
              <li><a href="<?php echo base_url() ?>partners">PARTNER WITH MODA MENTORE</a></li>
              <?php $footer = get_footer_links(); ?>
              <?php if($footer){ ?>
              <?php foreach($footer as $row){ ?>
                <li><a href="<?php echo base_url() ?>page/<?php echo $row->slug ?>"><?php echo $row->title ?></a></li>
              <?php } ?>
              <?php } ?>
            </ul>
            <ul class="soc">
              <?php $social = get_social_links(); ?>
              <li><a href="<?php echo $social->facebook ?>" target="_blank " ><i class="fa fa-facebook"></i></a></li>
              <li><a href="<?php echo $social->twitter ?>" target="_blank" ><i class="fa fa-twitter"></i></a></li>
              <li><a href="<?php echo $social->instagram ?>" target="_blank" ><i class="fa fa-instagram"></i></a></li>
              <li><a href="<?php echo $social->pinterest ?>" target="_blank" ><i class="fa fa-pinterest"></i></a></li>
            </ul>
          </div>
          <div class="col-sm-12 text-center copy">
            <img src="<?php echo base_url() ?>assets/theme/img/footer-logo.png">
            <span class="copyright"> &copy; <?php echo date("Y"); ?> All Rights Reserved</span>
            <!-- <p>Moda Mentore is a registered trademark of Moda Mentore</p> -->
          </div>
        </div>
      </div>
    </footer>
  <?php /* else: ?>
    <footer id="footer">
      <div class="container">
        Copyright <?php echo date("Y"); ?> &copy; Moda Mentore LLC
      </div>
    </footer>

    a.top {
margin-bottom: 25px;
display: inline-block;
font-family: 'Roboto Condensed', sans-serif;
font-weight: bold;
color: #b9b9b9;
font-size: 20px;
}

    <?php endif */ ?> 

   
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url() ?>assets/theme/assets/bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url() ?>assets/theme/assets/fancybox/jquery.fancybox-1.3.4.js"></script>
    <script src="<?php echo base_url() ?>assets/theme/js/jquery.isotope.js" type="text/javascript"></script> 
 
    <script type="text/javascript">

      $(window).load(function(){
          var $container = $('.gallery');
          $container.isotope({
              filter: '*',
              animationOptions: {
                  duration: 750,
                  easing: 'linear',
                  queue: false
              }
          });
       
          $('.filter a').click(function(){
              $('.filter .current').removeClass('current');
              $(this).addClass('current');
       
              var selector = $(this).attr('data-filter');
              $container.isotope({
                  filter: selector,
                  animationOptions: {
                      duration: 750,
                      easing: 'linear',
                      queue: false
                  }
               });
               return false;
          }); 
      });


       $("#bktoservice").click(function(){        
          window.location.href='<?php echo base_url() ?>services';
        });

    </script>

    <script src="<?php echo base_url() ?>assets/theme/js/modernizr.custom.js"></script>
    <script src="<?php echo base_url() ?>assets/theme/js/jquery.dlmenu.js"></script>
    <script>
      $(function() {
        $( '#dl-menu' ).dlmenu();
      });
    </script>

    <script type="text/javascript" src="<?php echo base_url() ?>assets/theme/js/modernizr.custom.26584.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/theme/js/jquery.flexslider.js"></script>
    <script type="text/javascript">


            $(document).ready(function() {

              $('#slider').css({
                height: (($(window).height()/3) *2)
              });

              $('.slide-desc').css({
                height: $('#slider').height()
              });

              // $("a#example4").fancybox({
              //   'opacity'   : true,
              //   'overlayShow' : false,
              //   'transitionIn'  : 'elastic',
              //   'transitionOut' : 'none',
              //   'titlePosition' : 'inside'
              // });

            $(".gallery .example4").each(function(){
              $(this).fancybox({
                'opacity'   : true,
                'overlayShow' : false,
                'transitionIn'  : 'elastic',
                'transitionOut' : 'none',
                'titlePosition' : 'inside'
              });
            });

                $(".slide-desc a").click(function(){

                  var block = $(this).attr("href");

                  /* Scroll Content */
                  $("body").animate({
                      scrollTop: $(block).offset().top + "px"
                  }, '500', 'swing');

                  return false;
                });

             });

            

             $(document).ready(function() {

                $("a.top").click(function(){

                  var block = $(this).attr("href");

                  /* Scroll Content */
                  $("body").animate({
                      scrollTop: $('body').offset().top + "px"
                  }, '500', 'swing');

                  return false;
                });

             });
    </script>

    <!-- blog gallery -->

    <script type="text/javascript" src="<?php echo base_url() ?>assets/theme/js/mbGallery.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/theme/js/jquery.exif.js"></script>
    <!-- blog gallery -->

  </body>
</html>