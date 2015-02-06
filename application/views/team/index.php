    <?php $header_profile = get_row('header_content',array('slug'=>'team')); ?>
        <?php if(!empty($header_profile->image)): ?>
            <div class="page-heading tofade parallax" style="background-image: url('<?php echo base_url() ?>assets/uploads/header/<?php echo $header_profile->image ?>'); ">
        <?php else: ?>
        <div class="page-heading tofade parallax" style="background-image: url('<?php echo base_url() ?>assets/theme/img/header-1.jpg'); ">
     <?php endif; ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>
                            <?php if(!empty($header_profile->heading)){ ?>
                            <small><?php echo $header_profile->heading;?></small>
                            <?php } ?>
                        <?php if(!empty($header_profile->content)): ?>
                           <?php echo strtoupper($header_profile->content) ?>
                        <?php endif; ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        
                
                <div class="row prod-bl padder-cont hero" id="uno1">
                    <div class="col-lg-8 col-lg-offset-2 tofade animated flipInY" style="opacity: 0;">
                        <div class="inner">
                            <h3 class="page-title">
                                <?php if(!empty($header_profile->midhead)) echo $header_profile->midhead; ?>
                            </h3>
                            <p>
                                <?php if(!empty($header_profile->middescription)): ?>
                                    <?php echo $header_profile->middescription; ?>
                                <?php endif; ?>
                            </p>

                            <?php if(!empty($header_profile->midbuttonlink)){ ?>

                            <p class="incididuntp">
                                <a class="incididunta" href="<?php if(!empty($header_profile->midbuttonlink)) echo $header_profile->midbuttonlink; ?>">
                                    <?php if(!empty($header_profile->midbuttontext)) echo $header_profile->midbuttontext; ?>
                                </a>
                            </p>

                <?php } ?>

                        </div>
                    </div>
                </div>

                <style type="text/css">
                    a.incididunta {
                        background: #fff;
                        width: 300px;
                        border-radius: 2px;
                        display: inline-block;
                        padding: 10px 0;
                        font-family: 'Roboto' sans-serif;
                        font-size: 16px;
                        margin-top: 15px;
                        text-transform: uppercase;
                        text-decoration: none;
                        font-weight: 500;
                    }
                </style>

                
         

        <section class="white-bg team-list">
            <div class="row">
                <?php if ($team): $i=1; foreach($team as $row): ?>
                <div class="col-md-3 col-sm-4">
                    <div id="team<?php echo $i ?>" class="half-block tofade animated flipInY" style="opacity: 0; background-image:url('<?php echo base_url() ?>assets/uploads/team/<?php echo $row->member_image; ?>')">
                        
                        <div class="inner p-90">
                            <h1><a href="<?php echo base_url() ?>team/detail/<?php echo $row->slug; ?>"><?php echo ucwords($row->member_name); ?></a></h1>
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