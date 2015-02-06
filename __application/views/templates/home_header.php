<!DOCTYPE html>
<html lang="en">
  <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Morgan Manufacturing</title>

        <!-- Bootstrap -->
        <link href="<?php echo base_url() ?>assets/theme/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!--page style-->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/css/style.css" type="text/css">

        <!--Jquery-->
        <script src="<?php echo base_url() ?>assets/theme/js/jquery-1.11.0.js"></script>
        
    </head>

    <body>

        <header id="header">
            <?php 
                if(isset($fixednav)){
                    $navcls = 'navbar-fixed-top navbar-scroll navbar-inverse animated';
                }else{
                    $navcls = 'navbar navbar-default navbar-statica animated';
                }
             ?>

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
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown"  href="<?php echo base_url() ?>about" onclick="return linktopage('about')" ><span class="line">About</span></a>
                            <ul class="dropdown-menu ev">
                                <li><a href="<?php echo base_url() ?>spaces"><span class="line">Spaces</span></a></li>
                                <li><a href="<?php echo base_url() ?>about"><span class="line">Profile</span></a></li>
                                <li><a href="<?php echo base_url() ?>team"><span class="line">Team</span></a></li>
                                <li><a href="<?php echo base_url() ?>about/in_the_kitchen"><span class="line">In The Kitchen</span></a></li>
                                <!--li><a href="#"><span class="line">Space</span></a></li>
                                <li><a href="#"><span class="line">History</span></a></li>
                                <li><a href="#"><span class="line">Story</span></a></li>
                                <li><a href="#"><span class="line">Purpose</span></a></li-->
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown"  href="#"><span class="line">Gallery</span></a>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown"  href="<?php echo base_url() ?>events" onclick="return linktopage('events');"><span class="line">Events</span></a>
                            <ul class="dropdown-menu ev">
                                <li><a href="#"><span class="line">Philosophy</span></a></li>
                                <li><a href="#"><span class="line">Amenities</span></a></li>
                                <li><a href="#"><span class="line">Meetings and expos</span></a></li>
                                <li><a href="#"><span class="line">Floorplans</span></a></li>
                                <li><a href="#"><span class="line">Catering</span></a></li>
                                <li><a href="#"><span class="line">Contact</span></a></li>
                            </ul>
                        </li>
                        <li><a href="#"><span class="line">Calendar</span></a></li>
                        <li><a href="<?php echo base_url() ?>blog"><span class="line">News</span></a></li>
                        <li><a href="<?php echo base_url() ?>contactus"><span class="line">Contact</span></a></li>
                    </ul>
                </div>
            </nav><!-- #site-navigation -->

        </header>
        <script type="text/javascript">
            function linktopage(page){               
                window.location.href="<?php echo base_url() ?>"+page;
            }
        </script>