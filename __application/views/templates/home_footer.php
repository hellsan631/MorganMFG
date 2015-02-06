<?php if ($this->uri->segment(1) != 'spaces'): ?>
    

<section id="trace" class="tofade" style="">
    <div class="inner p-70">
        <img src="<?php echo base_url() ?>assets/theme/img/ico-search.png" alt="">
        <h4><small> EVENT INQUIRY </small> BOOK YOUR NEXT EVENT TODAY</h4>
        <p>Give us a little more information about yourself or company:</p>
    
        <form class="tracking-form" id="event_form" onsubmit="return false;">
            <fieldset>
                <input type="hidden" id="lingua" name="lingua" value="en" />
                <div class="container">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 ">
                                <div class="row">
                                    <div class="col-sm-12 result">
                                         <div id="error_msg" class="alert alert-danger" style="display:none;"></div>
                                         <div id="success_msg" class="alert alert-success" style="display:none;"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 ">
                                        <input type="text" class="form-control light"  name="event_first_name"  placeholder="First"    />
                                    </div>
                                    <div class="col-sm-3 ">
                                        <input type="text" class="form-control light"  name="event_last_name"  placeholder="Last"    />
                                    </div>
                                    <div class="col-sm-3 ">
                                        <input type="text" class="form-control light"  name="event_phone"  placeholder="Phone"    />
                                    </div>
                                    <div class="col-sm-3 ">
                                        <input type="text" class="form-control light"  name="event_email"  placeholder="Email"    />
                                    </div>
                                </div>
                                &nbsp;
                                <div class="row">
                                    <div class="col-sm-12 result">
                                        <input class="btn btn-large btn-block btn-light" onclick="event_form_submit()" type="submit" value="CHECK AVAILABILITY">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</section>

<?php endif ?>


<footer id="footer" class="tofade">        
        <?php if(isset($footspaces)): ?>
            <div class="crossroad-category" style="display:none">
                    <ul class="reset">
                        <li style="clip: rect(0px, 411px, 633px, 0px); width: 756.444px;" data-index="0">
                            <a style="transform: translate3d(-172.722px, 0px, 0px);" href="room_detail.html">
                                <span class="img" style="background-image: url('<?php echo base_url() ?>assets/images/services-1.jpg');"></span>
                                <span style="transform: translate3d(0px, 0px, 0px); background-color: rgba(0, 0, 0, 0.6);" class="overlay"></span>
                                <span style="width: 410.4px;" class="name">Design and realization of complete interior and kitchen</span>
                            </a>
                        </li>
                        <li style="clip: rect(0px, 411px, 633px, 0px); width: 756.444px;" data-index="1">
                            <a style="transform: translate3d(-172.722px, 0px, 0px);" href="room_detail.html">
                                <span class="img" style="background-image: url('<?php echo base_url() ?>assets/images/services-1.jpg');"></span>
                                <span style="transform: translate3d(0px, 0px, 0px); background-color: rgba(0, 0, 0, 0.6);" class="overlay"></span>
                                <span style="width: 410.4px;" class="name">Design and realization of complete interior and kitchen</span>
                            </a>
                        </li>
                        <li style="clip: rect(0px, 411px, 633px, 0px); width: 756.444px;" data-index="2">
                            <a style="transform: translate3d(-172.722px, 0px, 0px);" href="room_detail.html">
                                <span class="img" style="background-image: url('<?php echo base_url() ?>assets/images/services-1.jpg');"></span>
                                <span style="transform: translate3d(0px, 0px, 0px); background-color: rgba(0, 0, 0, 0.6);" class="overlay"></span>
                                <span style="width: 410.4px;" class="name">Design and realization of complete interior and kitchen</span>
                            </a>
                        </li>
                        </ul>
                    </div>
        <?php endif; ?>

            <div class="prima p-70 home_footer0">
                <img src="<?php echo base_url() ?>assets/theme/img/ico-newsletter.png" alt="">
                <h4><small>CONNECT</small>SUBSCRIBE TO OUR NEWSLETTER</h4>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                            <form id="newsletter-form" class="newsletter-form" >
                                <fieldset>
                                    <div class="form-group input-wrapper">
                                        <input type="text" class="form-control light"  name="newsletter_email" placeholder="Enter your email and hit enter">
                                        <p id="result"></p>
                                    </div>
                                    <div class="col-sm-12 result">
                                         <div id="n_error_msg" class="alert alert-danger" style="display:none;font-size:14px;"></div>
                                         <div id="n_success_msg" class="alert alert-success" style="display:none;font-size:14px;"></div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>

                <p><img src="<?php echo base_url() ?>assets/theme/img/new/logo.png" alt="Morgan"></p>
                
               <!-- Site Content starts -->
            <?php $site_content = get_row('site_content',array('slug'=>'site_content')); ?>
            <?php if(!empty($site_content)): ?>             
                <p><?php echo $site_content->heading ?>
                <br><?php echo $site_content->address ?> - 
                <?php echo $site_content->city ?>,
                 <?php echo $site_content->zipcode ?>  - 
                Ph. <?php echo $site_content->phone ?> - 
                Fax <?php echo $site_content->fax ?> - 
                <?php echo $site_content->country ?>
                </p>
            <?php endif; ?>
            
            <?php $social_links = get_row('social_links',array('id'=>1)); ?>
                <ul class="social_menu light">
                    <li class="facebook"><a href="<?php echo $social_links->facebook ?>" target="_blank"><span class="inner">facebook</span></a></li>
                    <li class="twitter"><a href="<?php echo $social_links->twitter ?>" target="_blank"><span class="inner">twitter</span></a></li>   
                    <li class="google"><a href="<?php echo $social_links->googleplus ?>" rel="author" target="_blank"><span class="inner">google</span></a></li>
                    <li class="instagram"><a href="<?php echo $social_links->instagram ?>" target="_blank"><span class="inner">instagram</span></a></li>
                </ul>
               <!-- Site Content Ends -->

            </div>

            <div class="seconda p-50">
                <p>© Morgan Manufacturing - 312.314.2144 - info@morganmanufacturing.com - 
                    <span class="qtrans_language_chooser" id="qtranslate-chooser">
                       <!--
                        <span class="lang-it">
                            <a href="#" hreflang="it" title="Italiano">
                                <span>Italiano</span>
                            </a>
                        </span>
                        <span class="lang-en active">
                            <a href="#" hreflang="en" title="English">
                                <span>English</span>
                            </a>
                        </span>
                    </span>--> 
                    <a href="#" target="_blank">CREDITS</a></p>
            </div>

        </footer>



        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->       
        <script src='<?php echo base_url() ?>assets/theme/js/jquery-migrate-1.2.1.js'></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo base_url() ?>assets/theme/bootstrap/js/bootstrap.min.js"></script>

        <script src="<?php echo base_url() ?>assets/theme/js/plugin.min.js"></script>
        <script src="<?php echo base_url() ?>assets/theme/js/core.min.js"></script>

    </body>
</html>

<script type="text/javascript">
function event_form_submit()
{
      first_name = $('input[name=event_first_name]').val();
      last_name = $('input[name=event_last_name]').val();
      phone = $('input[name=event_phone]').val();
      email = $('input[name=event_email]').val();
      atpos = email.indexOf("@");
      dotpos = email.lastIndexOf(".");

    if(first_name=="" || last_name=="" || phone=="" || email=="")
    {
        $('#success_msg').fadeOut();
        $('#error_msg').html('All Fields are Required');
        $('#error_msg').fadeOut();
        $('#error_msg').fadeIn();
        return false;
    }
    else if(isNaN(phone)==true)
    {
        $('#success_msg').fadeOut();
        $('#error_msg').html('Please Enter a valid phone number');
        $('#error_msg').fadeOut();
        $('#error_msg').fadeIn();
        return false;
    }
    else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
    {
        $('#success_msg').fadeOut();
        $('#error_msg').html('Please enter a valid email address');
        $('#error_msg').fadeOut();
        $('#error_msg').fadeIn();
        return false;
    }

    $.ajax
    ({
          type:"post",
          url:"<?php echo base_url() ?>event_inquiry/submit_event_inquiry",
          data:$('#event_form').serialize(),
          success:function(res)
          {
            $('#error_msg').fadeOut('fast');
            $('#success_msg').fadeOut();
            $('#success_msg').html('Submitted successfully');
            $('#success_msg').fadeIn();
          }
    });
}


$(document).ready(function()
{
   $('#newsletter-form').submit(function(event)
    {
      event.preventDefault();
      newsletter_form_submit();
    });
});

function newsletter_form_submit()
{
      email = $('input[name=newsletter_email]').val();
      atpos = email.indexOf("@");
      dotpos = email.lastIndexOf(".");

     if(email=="")
    {
        $('#n_success_msg').fadeOut();
        $('#n_error_msg').html('Email fields are Required');
        $('#n_error_msg').fadeOut();
        $('#n_error_msg').fadeIn();
        return false;
    }
    else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
    {
        $('#n_success_msg').fadeOut();
        $('#n_error_msg').html('Please enter a valid email address');
        $('#n_error_msg').fadeOut();
        $('#n_error_msg').fadeIn();
        return false;
    }

    $.ajax
    ({
          type:"post",
          url:"<?php echo base_url() ?>newsletter/ajax_save_newletter",
          data:{email:email},
          success:function(res)
          {
            $('#n_error_msg').fadeOut('fast');
            $('#n_success_msg').fadeOut();
            $('#n_success_msg').html('Submitted successfully');
            $('#n_success_msg').fadeIn();
          }
    });
}
</script>
