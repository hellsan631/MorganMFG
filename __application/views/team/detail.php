<div class="page-heading toflip parallax" style="background-image: url('<?php echo base_url() ?>assets/theme/img/header-1.jpg'); ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2><small>— Team List View —</small>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </h2>
            </div>
        </div>
    </div>
</div>

<section class="white-bg p-50">
    <div class="container">
        <div id="team-detail" class="carousel slide" data-ride="carousel">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <a href="<?php echo base_url() ?>team" class="back">BACK</a>
                    <!-- Controls -->
                    <a class="left carousel-control" href="#team-detail" role="button" data-slide="prev">< Prev</a>
                    <a class="right carousel-control" href="#team-detail" role="button" data-slide="next">Next ></a>
                </div>
            </div>

          <!-- Wrapper for slides -->
          <div class="carousel-inner">
          <?php if ($team): foreach($team as $row): ?>                        
            <div class="item <?php if($row->slug == $slug){ echo 'active'; } ?>">
                <div class="row">
                    <div class="col-md-4 col-md-offset-1 col-sm-6">
                    <?php if(!empty($row->member_image)): ?>
                        <img src="<?php echo base_url() ?>assets/uploads/team/<?php echo $row->member_image; ?>" class="img-responsive">                        
                    <?php endif ?>
                    </div>
                    <div class="col-sm-6">
                        <h1 class="page-header"><?php echo $row->member_name; ?></h1>
                        <h3><?php echo $row->position; ?></h3>
                        <?php echo $row->bio; ?>
                        <?php if (!empty($row->email_address)): ?>
                            <a href="mailto:<?php echo $row->email_address; ?>">Contact</a>                            
                        <?php endif; ?>
                        <ul class="soc">
                        <?php if (!empty($row->fb_link)): ?>
                            <li><a href="<?php echo $row->fb_link ?>"><img src="<?php echo base_url() ?>assets/theme/img/team-fb.png"></a></li>
                        <?php endif; ?>
                        <?php if (!empty($row->twitter_link)): ?>
                            <li><a href="<?php echo $row->twitter_link; ?>"><img src="<?php echo base_url() ?>assets/theme/img/team-tw.png"></a></li>
                        <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>    
            <?php endforeach; endif; ?>          
          </div>
        </div>
    </div>
</section>