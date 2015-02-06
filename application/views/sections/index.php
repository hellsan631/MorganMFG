          <?php $header_profile = get_row('header_content',array('slug'=>'team')); ?>
       <?php if(!empty($header_profile->image)): ?>
         <div class="page-heading tofade parallax" style="background-image: url('<?php echo base_url() ?>assets/uploads/header/<?php echo $header_profile->image ?>'); ">
       <?php else: ?>
        <div class="page-heading tofade parallax" style="background-image: url('<?php echo base_url() ?>assets/theme/img/header-1.jpg'); ">
     <?php endif; ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2><small><?php if(!empty($header_profile->heading)) echo '—'.$header_profile->heading.'—'; else echo "— MORGAN MANUFACTURING —"; ?></small>
                        <?php if(!empty($header_profile->content)): ?>
                           <?php echo strtoupper($header_profile->content) ?>
                        <?php endif; ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <section class="incididunt p-70 text-center">
            <div class="container">
                <h1>Incididunt ut labore et dolore magna aliqua. </h1>
                <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </h2>
                <h2>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</h2>
                <a href="#">Find A Startup Community</a>
            </div>
        </section>

        <section class="white-bg team-list">
            <div class="row">
                <?php if ($team): $i=1; foreach($team as $row): ?>
                <div class="col-md-3 col-sm-4">
                    <div id="team<?php echo $i ?>" class="half-block tofade animated flipInY" style="opacity: 0; background-image:url('<?php echo base_url() ?>assets/uploads/team/<?php echo $row->member_image; ?>')">
                        
                        <div class="inner p-90">
                            <h1><a href="<?php echo base_url() ?>team/detail/<?php echo $row->slug; ?>"><?php echo $row->member_name; ?></a></h1>
                            <div class="dvdr"></div>
                            <p><?php echo $row->position; ?></p>
                            <?php if (!empty($row->fb_link)): ?>
                                <a href="<?php echo $row->fb_link ?>"><img src="<?php echo base_url() ?>assets/theme/img/team-fbw.png"></a>                                
                            <?php endif ?>
                            <?php if (!empty($row->twitter_link)): ?>
                                <a href="<?php echo $row->twitter_link ?>"><img src="<?php echo base_url() ?>assets/theme/img/team-tww.png"></a>
                            <?php endif ?>
                        </div>
                        
                    </div>        
                </div>
                <?php $i++; endforeach; endif ?>
            </div>
        </section>