(function($){
	// zavreni novinky na HP navzdy
	$(document).on('click', '.box-message .close', function(){
		$markup = $(this).closest('.box-message').data('content');
		$datefrom = $(this).closest('.box-message').data('datefrom');
		$dateto = $(this).closest('.box-message').data('dateto');
		console.log($markup);
		console.log($markup.length);
		$.ajax({
			url: "/ajax/miniclose",
			data: {markup: $markup, datefrom: $datefrom, dateto: $dateto},
			type: 'POST'
		})
		  .done(function(data){
		  	console.log(data);
		  });
	});
	
	// disable image saving (context menu on right click)
	$(document).on('contextmenu', 'img', function(){
		return false;
	});
	
	$('.crossroad-category.condensed li').on('mouseenter', function(){
		//TweenMax.to($(this), .3, {width:"20%", force3D:true})
	});
	
	$('.crossroad-category.condensed li').on('mouseleave', function(){
		//TweenMax.to($(this), .3, {width:"14.25%", force3D:true})
	});
	
	// mobile desktop version cookie set
	$('.mobile .desktop .btn').on('click', function(){
		document.cookie="desktop=true";
	});
	
	// main menu logo over
	var timmm = new TimelineMax({paused:true});
	timmm.to($('.mainLogo'), .7, {lineHeight: 100, height:100, width:160, backgroundColor:"rgba(0,0,0,1)", ease:Expo.easeInOut}, 0);
	timmm.to($('.mainLogo img'), .7, {width:113, height:52, paddingTop:15, ease:Expo.easeInOut, force3D:true}, 0);
	timmm.to($('.mainLogo .claim'), .8, {opacity:1, delay:.2, ease:Expo.easeInOut}, 0);
	
	$('.mainLogo').on('mouseenter', function(){
		timmm.play();
	});
	$('.mainLogo').on('mouseleave', function(){
		timmm.reverse();
	});
	
	
	// architekti schovani prazdnych znacek
	$(document).on('ready contentchange', function(){
		//console.log('zmena contentu');
		//console.log($('.section:last-child').find('*[data-redirect]:first').data('redirect'));
		
		$('#back .main .filter a').each(function(){
			var href = $(this).attr('href').replace('#', '');
			if(!$('li.'+href).length)
				$(this).hide();
		});
		
		
		
		// pridani GA eventu na uspesnou registraci
		if($('.regSuccess').length){
			//console.log('GA trackuji');
			if(window.location.hostname == 'stopka.cz')
				_gaq.push(['_trackEvent', 'Registrace', 'Success'], ['b._trackEvent', 'Registrace', 'Success']);
			//_gaq.push(['b._trackEvent', 'Registrace', 'Success']);
		}
	});
	
	$(document).on('ready contentafterload', function(){
		// redirect pokud je
		var currentContent = $('.main .section').last();
		var redirect = currentContent.find('*[data-redirect]:first').data('redirect');

		if(redirect)
		{
			//console.log('ted bych redirectoval', currentContent)
			$('<a href="'+ redirect +'" />').appendTo( currentContent ).trigger('click');
		}
		
		// shortflash
		$('.shortflash').each(function(){
			TweenMax.to($(this), .8, {autoAlpha:1, repeat:1, yoyo:true, repeatDelay:2});
		});
	});
	
	// retrieve email tlacitko klikatelne pouze jednou
	$(document).on('click', 'button[type=submit].once', function(e){
		if($(this).hasClass('clicked'))
			e.preventDefault();
		$(this).addClass('clicked');
	});
	
})(jQuery);
