 <section id="login">

      <div class="container">

        <div class="row">

          <div class="col-sm-5">

            <h1>Log into My Account</h1>

            <form role="form">

              <div class="form-group">

                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Username">

              </div>

              <div class="form-group">

                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Password">

              </div>

              <div class="checkbox">

                <button class="btn btn-grey">SUBMIT</button>

                <label>

                  <input type="checkbox"> Remember me

                </label>

              </div>

            </form>

          </div>

          <div class="col-sm-5 col-sm-offset-2">

            <h1>Log into My Account</h1>

            <p>Just need to make a payment? Enter invoice below...</p>

            <form role="form">

              <div class="form-group">

                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Invoice number">

              </div>

              <div class="text-right"><button class="btn btn-grey">SUBMIT</button></div>              

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