<section class="blog-detail">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <h1><?php echo $post->title; ?></h1>
                        <article><?php echo date('F d, Y', strtotime($post->created)); ?></article>
                        <?php if (!empty($post->image)): ?>
                          <img src="<?php echo base_url() ?>assets/uploads/news/<?php echo $post->image; ?>" class="detail-photo">
                        <?php endif ?>
                        <?php echo str_replace('src="../', 'src="../../', $post->description); ?>
                        <ul class="social_menu dark">
                            <li class="facebook"><a href="javascript:void(0);" id="fshare"><span class="inner">facebook</span></a></li>
                            <li class="twitter"><a target='_blank' href="http://twitter.com/intent/tweet?text=<?php echo $post->title ?>&url=<?php echo current_url(); ?>"><span class="inner">twitter</span></a></li>
                            <li class="google"><a href="https://plus.google.com/share?url=<?php echo current_url(); ?>" rel="author" target="_blank"><span class="inner">google</span></a></li>
                            <!--li class="instagram"><a href="#" target="_blank"><span class="inner">instagram</span></a></li-->
                        </ul>

                        <div style="display:none" id="sharedis">
                            <?php echo str_replace('src="../', 'src="../../', $post->description); ?>
                        </div>
                        <?php $admin_info =  get_row('users',array('id'=>$post->admin_id)); ?>
                       
    <?php /*if(!empty($admin_info)): ?>
                        <div class="autor">
                            <span>Written By</span>
                            <div class="row">
                                <div class="col-sm-3"><img  src="<?php echo base_url() ?>assets/uploads/profile/thumbs/<?php echo $admin_info->image ?>" class="img-responsive"></div>
                                <div class="col-sm-9">
                                    <h2><?php echo $admin_info->first_name." ".$admin_info->last_name; ?></h2>
                                    <p><?php echo $admin_info->description ?></p>
                                    <a href="<?php echo base_url() ?>blog/index/<?php echo $admin_info->id ?>">
                                       View Posts
                                       <img src="<?php echo base_url() ?>assets/images/arr.png">
                                    </a>
                                </div>
                            </div>
                        </div>
    <?php endif; */ ?>
                    </div>
                </div>
            </div>
        </section>
        <?php $a = str_replace( '"' , "'", $post->excerpt); $cap = str_replace( "'" , "", $a); //print_r($cap); die();  ?>
        <input type="hidden" id="cap" value="<?php echo $cap; ?>">
         <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '307256612785560',
          status     : true,
          xfbml      : true
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/all.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    
//post to facebook
  $('#fshare').click(function(){
    var cap = $('#cap').val();
      FB.ui(
      {
       method: 'feed',
       name: "<?php echo str_replace( '"' , "'", $post->title) ?>",
       caption: cap,
       description: (
          $("#sharedis").html()         
       ),
       link: "<?php echo current_url() ?>",
       picture: "<?php echo base_url() ?>assets/uploads/news/<?php echo $post->image; ?>"
      },
      function(response) {
        if (response && response.post_id) {
          alert('News shared.');
        } else {
          alert('News was not shared.');
        }
      }
    );

  })
 </script>