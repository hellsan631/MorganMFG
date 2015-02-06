<!DOCTYPE html>
<html lang="en">
  <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">


		<?php $slug = $this->uri->segment(1); if($slug == ""){ $slug = "index"; }  $meta = get_seo_page($slug); ?>
		<title><?php if(isset($meta) && !empty($meta->title)){ echo $meta->title; }else{ echo 'Morgan Manufacturing'; } ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, height=device-height" />        
		<?php if($meta): ?>
			<meta name="description" content="<?php echo $meta->description; ?>">
			<meta name="keywords" content="<?php echo $meta->keyword; ?>">
		<?php endif; ?>

		<!-- Bootstrap -->
		<link href="<?php echo base_url() ?>assets/theme/bootstrap/css/bootstrap.css" rel="stylesheet">

		<!--page style-->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/css/style.css" type="text/css">

		<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/font-awesome/css/font-awesome.css">

		<!--Jquery-->
		<script src="<?php echo base_url() ?>assets/theme/js/jquery-1.11.0.js"></script>
		
		<?php if($this->uri->segment(1) != 'home' && $this->uri->segment(1) != '' ){ ?>
		<style type="text/css">
			.navbar-statica .navbar-nav li{
				min-width: 10% !important;
			}

			.navbar-statica{
				background: #1b171c;
				border-bottom: solid 2px #744430;
			}
		</style>
		<?php } ?>

		<!-- EMAIL -->
		<style type="text/css" media="screen">
			ul.nav{
				display: none;
			}
			.navbar-statica{
				border: none;
			}
			nav.navbar.animated.navbar-fixed-top.navbar-scroll.navbar-inverse{
				display: none;
			}
			nav.navbar-mobile{
				display: none;
			}
		</style>
		<!-- EMAIL END -->
	</head>
	<!--serv-page -->
	<?php if($this->uri->segment(1) == 'amenities'){ $ser = 'serv-page';  }else{ $ser = ""; } ?>
	<body class="<?php echo $ser; ?>">

		<header id="header">
			<?php 
				if(FALSE){ // isset($fixednav)
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
					   
					   

						<li class="aboutli"><a href="<?php echo base_url(); ?>about"><span class="line">About</span></a></li>
						<li class="spaceli"><a href="<?php echo base_url(); ?>space"><span class="line">Space</span></a></li>
						<li class="floorplanli" style="padding-left:22px; padding-right:22px;" ><a href="<?php echo base_url(); ?>downloadfloorplan"><span class="line">Floor Plans</span></a></li>
						
						<?php get_center_logo(); ?>

						<li class="catringli"><a href="<?php echo base_url() ?>catering"><span class="line cp">Catering</span></a></li>
						<!--li><a href="<?php echo base_url() ?>catering_partners"><span class="line cp">Catering Partners</span></a></li-->
						<li><a href="<?php echo base_url() ?>news"><span class="line">News</span></a></li>
						<li><a href="<?php echo base_url() ?>contact"><span class="line">Contact</span></a></li>
					</ul>
				</div>
			</nav><!-- #site-navigation -->

		</header>
		<script type="text/javascript">
			function linktopage(page){               
				window.location.href="<?php echo base_url() ?>"+page;
			}
		</script>
		<?php $logo = getlogo(); if($logo){ ?>
			<style type="text/css">
				.navbar-statica .navbar-brand{
					background: url('<?php echo base_url() ?>assets/uploads/home/<?php echo $logo; ?>') no-repeat left center
				}
			</style>
		<?php } ?>

		<style type="text/css">
			.navbar-statica .navbar-brand{
				margin-top: 30px;
				background-size: cover;
				width: 160px;
				height: 120px;
			}
			.cp{
				width:100%;
			}
			.navbar-scroll .navbar-brand
			{
				display: block;
			}
		</style>
		<style>
			@media(max-width: 770px){
				.page-heading{
					background-size: cover;
				}
			}
			@media(min-width: 770px){
				.page-heading{
					margin-top:220px; 
					position: relative !important;
				}
			}
		</style>



	<script>
	$(window).scroll(function(){
		doubleHeader();
	});
	$(window).ready(function(){
		doubleHeader();
	});
	$(window).resize(function(){
		doubleHeader();
	});
	
	function doubleHeader()
	{
		var top = $(window).scrollTop();
		if(top < 150)
		{
			doubleHeaderFirst();
		}
		else if(top > 200)
		{
			doubleHeaderSecond();
		}
	}        


	function doubleHeaderFirst()    
	{   
		var width = $(window).width();
		$('.cp').css('margin-left','0%');
		if(width >= 1280)
		{
			$('.navbar-statica .navbar-nav li').css('min-width','10%');
			$('.navbar-statica .navbar-nav li').css('font-size','13px');
		}
		if(width<1280 && width>=980)
		{
			$('.navbar-statica .navbar-nav li').css('min-width','10%');
			$('.navbar-statica .navbar-nav li').css('font-size','13px');
		}
		if(width<980 && width>=800)
		{
			$('.navbar-statica .navbar-nav li').css('min-width','0%');
			$('.navbar-statica .navbar-nav li').css('font-size','11px');
		}
		if(width<800)
		{
			$('.navbar-statica .navbar-nav li').css('font-size','13px');
		}
	}
	
	function doubleHeaderSecond()
	{
		var width = $(window).width();
		if(width >= 1280)
		{
			$('.navbar-scroll .navbar-nav li').css('min-width','12%');
			$('.navbar-scroll .navbar-nav li').css('font-size','13px');
		}
		if(width<1280 && width>=980)
		{
			$('.navbar-scroll .navbar-nav li').css('min-width','10%');
			$('.navbar-scroll .navbar-nav li').css('font-size','13px');
		}
		if(width<980 && width>=800)
		{
			$('.navbar-scroll .navbar-nav li').css('min-width','8%');
			$('.navbar-scroll .navbar-nav li').css('font-size','8px');
		}
		if(width<800)
		{
			$('.navbar-scroll .navbar-nav li').css('font-size','13px');
		}
	}
	</script>        

