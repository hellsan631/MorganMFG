<section class="blog-list">
            <ul>
              <?php if ($posts): foreach($posts as $row): ?>                
                <li class="row tofade">
                    <div class="col-sm-6">
                      <?php if (!empty($row->image)): ?>
                        <img src="<?php echo base_url() ?>assets/uploads/news/<?php echo $row->image; ?>">                
                      <?php endif ?>
                    </div>
                    <div class="col-sm-6 info">
                        <span><?php echo date('F d, Y', strtotime($row->created)); ?></span>
                        <h1><?php echo $row->title; ?></h1>
                        <div class="dvdr"></div>
                        <p><?php echo word_limiter($row->excerpt,20); ?></p>
                        <a href="<?php echo base_url().'news/detail/'.$row->slug; ?>">Read More</a>
                    </div>
                </li>                
              <?php  endforeach; endif; ?>
            </ul>
        </section>





<script type="text/javascript">

  $(function(){

    var $start=3;

    var $window=$(window);

    var $loading=$('#loading');

    var $moreResultAvailable=$("#moreResultAvailable");

    var $status=true;  

    <?php if($this->uri->segment(2) != ''): ?>  

    var newURL = "<?php echo current_url(); ?>"

    <?php else: ?>

    var newURL = "<?php echo base_url() ?>news/category/ALL";

    // var newURL = "http://" + window.location.host + window.location.pathname;

    <?php endif; ?>    

    // $window.bind( 'scroll',function(eS){        

    // alert($status);

        // if($(this).scrollTop() /( $(document).height() - $(this).height()) > 0.85 && $status ){        

            var doMouseWheel = 1;

            function infinitescroll(){

                offset = $('.nws').length;

            $.ajax({

               type:'post',

               url: newURL,

               dataType:'html', 

               data:{offset: offset},

               beforeSend:function(){

                $status=false;

                  if($moreResultAvailable.val() != "0"){                                                         

                    $loading.show();   

                  }

               },

               success:function(data){                   

                     var obj = jQuery.parseJSON(data);

                      $('#lastPostsLoader').html('');

                      doMouseWheel = 1 ;

                      if (obj.status) {

                          $('.appenblog').append(obj.res);                          

                      }else

                          doMouseWheel = 0 ;                  

               },

               complete:function(){

                    $status=true;

                    $loading.fadeOut();

                    $start+=1; 

               },

               error:function(){

                alert('Error, please try reloading the page.')

               }

            });                

        }

    // });









 $(window).scroll(function(){

              if (!doMouseWheel)  {

                  return ;

              } ;

              var wintop = $(window).scrollTop(), docheight = $(document).height(), winheight = $(window).height();

              var  scrolltrigger = 0.85;

              if  ((wintop/(docheight-winheight)) > scrolltrigger) {

               doMouseWheel = 0 ; 

               infinitescroll();

              }

          });



 });

</script>