<?php $header = get_headerimage(); ?>
 <section id="reimagined" style=" text-align:left; background-image:url(<?php echo base_url() ?>assets/uploads/home/<?php echo $header->contactimg ?>)">
  <!-- <img src="<?php echo base_url() ?>assets/uploads/home/<?php echo $header->contactimg; ?>"> -->
  <div class="container">
    <h1><?php echo @$header->contactxt; ?></h1>
    <p></p>
  </div>
</section>



    <section id="contact">

      <div class="container">

        <div class="row">

          <div class="col-sm-10 col-sm-offset-1">

            <h1><?php echo $page_content->contact_heading; ?></h1>

            <div class="row">

              <div class="col-sm-6">

                <?php echo $page_content->contact_address; ?>

              </div>

              <div class="col-sm-6">

                <p><a href="mailto:<?php echo $page_content->contact_email; ?>"><?php echo $page_content->contact_email; ?></a></p>

                <p><?php echo $page_content->contact_phone; ?></p>

              </div>

            </div>

            <?php if ($this->session->flashdata('success_msg')): ?>

              <p style="color:green"> <?php echo $this->session->flashdata('success_msg') ?></p>              

            <?php endif ?>



              <ul style="padding-left:0px">

                <li><?php echo form_error('fname'); ?></li>                

                <li><?php echo form_error('lname'); ?></li>                

                <li><?php echo form_error('email'); ?></li>                

              </ul>  



            <?php echo form_open(base_url().'contactus/index'); ?>

              <div class="row">

                <div class="col-sm-6">

                  <div class="form-group">

                    <input type="text" name="fname" class="form-control" id="exampleInputEmail1" placeholder="First Name" required>

                  </div>

                </div>

                <div class="col-sm-6">

                  <div class="form-group">

                    <input type="text" name="lname" class="form-control" id="exampleInputEmail1" placeholder="Last name" required>

                  </div>

                </div>

              </div>

              <div class="form-group">

                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" required>

              </div>

              <div class="text-right">

                <button class="btn btn-grey">SUBMIT</button>

              </div>

            </form>

          </div>

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

        <div class="carousel-inner">

          <?php $tweets = get_twitter_feed();  ?>
           <?php if($tweets): $i=1; foreach ($tweets as $tweet): ?>            
            <div class="item <?php if($i == 1) echo 'active'; ?>">            
              <p><?php echo $tweet->text; ?></p>
            </div>
            <?php  $i++; endforeach; endif; ?>

        </div>

      </div>

    </section>