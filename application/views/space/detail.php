<link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/service/developers.css" media="screen, projection">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/service/print.css" media="print">    

<link rel="stylesheet" href="<?php echo base_url() ?>assets/theme/css/newstyle.css" type="text/css">

 <div class="contentslide">
        <div id="mother" class="">
            <div class="content_page">
                <div class="content_left"><img src="<?php echo base_url() ?>assets/uploads/space/<?php echo $space->image ?>" /></div>
                <div class="content_right">
		            <div id="team-detail">
			            <div class="row">
			                <div  class="btn_div col-md-10 col-md-offset-1">
			                    <a href="<?php echo base_url() ?>space" class="back">BACK</a>
			                    <!-- Controls -->
			                    <?php if($previus): ?>
			                     <a class="left carousel-control" href="<?php echo base_url() ?>space/detail/<?php echo $previus->slug ?>" role="button" data-slide="prev">< Prev</a>
			                    <?php endif; ?>
			                    <?php if($next): ?>
			                    <a class="right carousel-control" href="<?php echo base_url() ?>space/detail/<?php echo $next->slug ?>" role="button" data-slide="next">Next ></a>
			                    <?php endif; ?>
			                </div>
			            </div>
		            </div>
                    <h1 id="titlee" class="title">
                    <span style="border-bottom:2px solid black">
	                    <?php echo $space->title; ?>
                    </span>
                    </h1>
                    <div class="content">
                        <?php echo $space->description ?>                         
                        <p>
                        <?php if (!empty($space->link) && !empty($space->btn_txt)): ?>                            
                        <a href="<?php echo $space->link ?>" class="btn" data-text="<?php echo $space->btn_txt ?>">
                            <span><?php echo $space->btn_txt; ?></span>
                        </a>
                        <?php endif ?>
                    </p>
                    </div>
                </div>
            </div>
        </div>

     </div>
<style type="text/css">
/*.navbar{
    height: auto !important;
}

.navbar-brand {
    margin-top: 30px !important;
}
*/
#footer{
    position: relative;
}

/*.navbar-statica .navbar-nav {
    margin-top: 160px !important;
}*/
</style>

<script type="text/javascript">


$(window).resize(function(){
    // contentslideheight();
    // window.location.reload();
    alignleftright();
});


$(window).load(function(){
    contentslideheight();
    alignleftright();
});

function contentslideheight(){
	$(".content_page").css('margin-top', $("nav").height()+'px');
    var hl = $('.content_left').height();
    var hr = $('.content_right').height();
    if(hl > hr){
        var hi = hl;
    }else{
        var hi = hr;
    }
    // hi = hl;
    $('.contentslide').css('max-height',hi+87);
    $('.contentslide').css('overflow','hidden');
    // $('.contentslide').css('min-height',hi+155);
}

function alignleftright(){

    var hl = $('.content_left').height();
    var hr = $('.content_right').height();
	  $('.content_right').css('height',hl+'px');
	  $('.content_right').css('overflow-y','scroll');
	  $('.content_right').css('overflow-x','hidden');
}

</script>



    <style>
    @media (max-width: 795px){
        .content_left{
            width: 100%;
            clear:both;            
        }
        .content_right{
            width: 100%;
            clear:both;            
        }
    }
    .btn_div{
    	margin-left:19px;
    }
    #titlee{
    	text-align: left;
        padding-left: 32px;
    }
    .content_right .content{
        width: 100%;
        /*text-align: left;*/
        padding: 20px 35px;
    }
	.content_right .content p{
		text-align: left;
	}
	#team-detail{
		margin-top: 37px;
	}
	@media(max-width:1195px){
		.back{
			font-size: 13px !important;
			padding: 8px 22px !important;
		}
		.left{
			font-size: 13px !important;
			padding: 8px 22px !important;
		}
		.right{
			font-size: 13px !important;
			padding: 8px 22px !important;
		}
	}
	@media(max-width:980px){
		.back{
			font-size: 12px !important;
			padding: 8px 20px !important;
		}
		.left{
			font-size: 12px !important;
			padding: 8px 20px !important;
		}
		.right{
			font-size: 12px !important;
			padding: 8px 20px !important;
		}
	}
	@media(max-width:800px){
		.back{
			font-size: 10px !important;
			padding: 8px 12px !important;
		}
		.left{
			font-size: 10px !important;
			padding: 8px 12px !important;
		}
		.right{
			font-size: 10px !important;
			padding: 8px 12px !important;
		}
	}
    </style>

