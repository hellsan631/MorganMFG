(function($)
{
	/*******************************************************
		APP
	********************************************************/
	$.fn.inputDefaultText = function(options)
	{
		options = $.extend({
			text: ''
		}, options);

		return this
			.val(options.text)
			.bind('focus', function(){ if(this.value == options.text) this.value = ''; })
			.bind('blur', function(){ if(this.value == '') this.value = options.text; });
	};

	$.support.placeholder = (function(){
		var i = document.createElement('input');
		return 'placeholder' in i;
	})();

	var App = window.App =
	{
		options: {

		},

		run: function(options)
		{
			var app = this;
			// nastavení
			app.options = $.extend(true, app.options, options);

			app.MQ = new sk.utils.MediaQueries({
				'selector' : $('<div id="mq" />').appendTo('body'),
				'queries': {
					'0px': {
						state: 'desktop-1024',
						params: {
							width: 1024
						}
					},
					'10px': {
						state: 'desktop-1600',
						params: {
							width: 1600
						}
					},
					'20px': {
						state: 'desktop-1900',
						params: {
							width: 1920
						}
					}
				}
			}).init();

			// Default ease
			TweenLite.defaultEase = Expo.easeInOut;

			// cache proměných
			app.$body = $('body');
			app.$holder = $('#mother');
			app.$front = $('#front');
			app.$back = $('#back');
			app.isBack = app.$holder.hasClass('back');
			app.$visible = app.isBack ? app.$back : app.$front;
			app.$hidden = app.isBack ? app.$front : app.$back;

			app.isIE= (function getInternetExplorerVersion()
			// Returns the version of Internet Explorer or a -1
			// (indicating the use of another browser).
			{
				var rv = -1; // Return value assumes failure.
				if (navigator.appName == 'Microsoft Internet Explorer')
				{
					var ua = navigator.userAgent;
					var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
					if (re.exec(ua) != null)
						rv = parseFloat( RegExp.$1 );
				}
				if (!!navigator.userAgent.match(/Trident.*rv[ :]*11\./))
				{
					rv = 11;
				}
				return rv;
			})();

			// Page load
			var pageAnim = new TimelineMax({
				delay: .25
			})

			app.Loader.restart();

			// IPad height fix iOS7
			if (navigator.userAgent.match(/iPad;.*CPU.*OS 7_\d/i) && window.innerHeight != document.documentElement.clientHeight) {
				var fixViewportHeight = function() {
					document.documentElement.style.height = window.innerHeight + "px";
					if (document.body.scrollTop !== 0) {
						window.scrollTo(0, 0);
					}
				}.bind(this);

				window.addEventListener("scroll", fixViewportHeight, false);
				window.addEventListener("orientationchange", fixViewportHeight, false);
				fixViewportHeight();

				document.body.style.webkitTransform = "translate3d(0,0,0)";
			}


			pageAnim
				.set( app.$hidden.find('.header'), { top: 0 })
				.set( app.$hidden.find('#footer'), { bottom: 0 })
				.addCallback(function()
				{
					setTimeout(function()
					{
						app.Loader.$loadElement = app.$visible.find('.main');
						app.Loader.loadingImages();
					}, 200)
				})
				.to( app.Loader.$element, 1, { autoAlpha: 1, delay: -.2 });


			var Popup = {
				$popup: null,
				$win: $(window),
				open: function(videoUrl)
				{
					var videoId = 'player' + $.now();

					this.$popup = $('\
						<div class="popup-holder"> \
							<div class="popup-overlay"></div> \
							<div class="popup-window"> \
								<div class="popup-content"> \
									<div class="box-youtube-holder"> \
										<div class="box-youtube" data-youtube="'+ videoUrl +'"> \
											<div id="'+ videoId +'" class="player"></div> \
											<a href="#" class="play"><span>Přehrát</span></a> \
											<a href="#" class="pause"><span>Zastavit</span></a> \
											<div class="status-wrap"> \
												<div class="status"><div class="in"></div></div> \
											</div> \
										</div> \
									</div> \
									<span class="popup-close"><span></span></span> \
								</div> \
							</div> \
						</div> \
					');

					this.$popup
						.css('opacity', '0')
						.appendTo('body');

					this.$win.on('resize', $.proxy(this.resize, this));
					this.resize();

					this.$popup.on('click touchdown', '.popup-overlay, .popup-close', $.proxy(this.close, this));

					this.$popup
						.trigger('contentload')
						.fadeTo(400, 1);
				},
				close: function()
				{
					var _this = this;


					this.$popup
						.fadeOut(function()
						{
							_this.$popup.remove();
							_this.$win.off('resize', this.resize);
						})
						.find('.box-youtube')
							.trigger('destroy');
				},
				resize: function()
				{
					this.$popup
						.find('.popup-window')
							.css('margin-top', function()
							{
								return $(this).outerHeight() / -2
							})
				}
			}

			// Plugins call
			$(document)
				.one('afterload', '.main', function(event)
				{
					(new TimelineMax({
						delay: .4
					}))
						.to( app.$visible.find('.header'), .5, { top: 0 })
						.to( app.$visible.find('#footer'), .3, { bottom: 0, delay: -.2 });


					$(document).trigger('contentload');

					var $main = $(this);

					app.Loader.hide();

					TweenMax.to( $main, 1, { autoAlpha: 1 });

					setTimeout(function()
					{
						$main.trigger('contentplay', true);
					}, 400)
				})
				// Důležitá zpráva
				.on('click', '.box-message .close', function(event)
				{
					event.preventDefault();
					event.stopImmediatePropagation();

					$(this).closest('.box-message').addClass('hidden');
				})
				// Kontakt
				.on('click', '.crossroad-contact .close, .crossroad-contact .toggle', function(event)
				{
					event.preventDefault();
					event.stopImmediatePropagation();

					$('.box-outlet').removeClass('show-contact');
					$(this).closest('li').toggleClass('show-contact').siblings().removeClass('show-contact');
					$(this).closest('ul').toggleClass('disabled', $(this).closest('li').hasClass('show-contact') );
				})
				// Outlet
				.on('click', '.crossroad-contact .btn-wrap a, .crossroad-contact .link .btn', function(event)
				{
					event.preventDefault();
					event.stopImmediatePropagation();

					$('.box-outlet').toggleClass('show-contact');
					$('.crossroad-contact li').removeClass('show-contact');
					$('.crossroad-contact ul').toggleClass('disabled', $('.box-outlet').hasClass('show-contact'));
				})
				.on('click', '.box-gallery .btn-expand, .box-gallery .btn-reduce', function(event)
				{
					event.preventDefault();
					event.stopImmediatePropagation();

					$('.pager-img-wrap').trigger('recalc.skcarousel');
					$(this).closest('.box-gallery').toggleClass('full');
				})
				.on('click', '.box-gallery .btn-open, .box-gallery .btn-close', function(event)
				{
					event.preventDefault();
					event.stopImmediatePropagation();

					$(this).closest('.box-gallery').toggleClass('show-detail');
				})
				.on('click', '.popup-video', function(event)
				{
					event.preventDefault();

					var videoUrl = $(this).attr('href');
						videoUrl = videoUrl.split('/');
						videoUrl = videoUrl[ videoUrl.length - 1 ];

					Popup.open(videoUrl);

				})
				.on('contentload', function(event)
				{
					// responsive images, vše
					app.Images.replace( app.Loader.$loadElement, '.responsive.no-load' );

					// load
					app.Loader.imgLoad = app.Loader.util.load(
						app.Loader.util.getImages( app.Loader.$loadElement,
						{
							'selector': '*.no-load'
						})
					);

					// placeholder
					if( !$.support.placeholder ){
						$('input[placeholder]', event.target).each(function(){
							$(this).inputDefaultText({text: $(this).attr('placeholder')});
						});
					}

					// Youtube Player
					$('.box-youtube', event.target).each(function(){
						var $this = $(this),
							data = $this.data('youtube'),
							$play = $this.find('.play'),
							$stop = $this.find('.stop'),
							$pause = $this.find('.pause'),
							$status = $this.find('.status .in'),
							$youtube = $('#'+$this.find('> div:first-child').attr('id')),
							timer = null;

						var isPopup = $this.closest('.popup-window').length;
						var videoUrl = isPopup ? data : data.initialVideo

						$youtube.tubeplayer({
							width: $this.width(), // the width of the player
							height: $this.height(), // the height of the player
							showControls: false,
							autoPlay: true,
							modestbranding: 1,
							allowFullScreen: "true", // true by default, allow user to go full screen
							initialVideo: videoUrl, // the video that is loaded into the player
							preferredQuality: "auto",// preferred quality: default, small, medium, large, hd720
							onPlayerPlaying: function(id){
								$stop.show();
								$pause.show();
								$play.hide();
								timer = setInterval(function(){
									$status.width($youtube.tubeplayer('data').currentTime/($youtube.tubeplayer('data').duration/100)+'%');
								}, 250)
							}, // after the play method is called
							onPause: function(){
								$stop.hide();
								$pause.hide();
								$play.show();
								clearInterval(timer);
							}, // after the pause method is called
							onStop: function(){
								$stop.hide();
								$pause.hide();
								$play.show();
								clearInterval(timer);
								$status.width(0);
							}, // after the player is stopped
							onSeek: function(time){
								//console.log(time)
							}, // after the video has been seeked to a defined point
							onMute: function(){}, // after the player is muted
							onUnMute: function(){}, // after the player is unmuted
							onPlayerEnded: function(){play(0, $(this));}
						});


						var play = function(time, $that){

							$that.closest('.scroll').cycle('pause');

							$youtube
								.tubeplayer('play', {
									id: videoUrl,
									time: time
								})
								.tubeplayer("size", {
									width: $this.width(),
									height: $this.height()
								});
						};

						$play.on('click', function(e){
							e.preventDefault();

							if($this.hasClass('paused'))
							{
								$this.removeClass('paused');
								$youtube.tubeplayer('play');
							}
							else
							{
								play(0, $(this));
							}
						});

						$stop.on('click', function(e){
							e.preventDefault();

							$youtube.tubeplayer('stop');
						});

						$pause.on('click', function(e){
							e.preventDefault();
							$this.addClass('paused');
							$youtube.tubeplayer('pause');
						});

						$this.on('destroy', function(event)
						{
							clearInterval(timer);
						});

						$status.closest('.status-wrap').on('click', function(e){
							//console.log( ($youtube.tubeplayer('data').duration / 100) * ( (e.pageX - $(this).offset().left)/($(this).width()/100) ) )
							//console.log((e.pageX - $(this).offset().left)/($(this).width()/100))

							$status.width((e.pageX - $(this).offset().left)/($(this).width()/100) + '%');
							play( ($youtube.tubeplayer('data').duration / 100) * ( (e.pageX - $(this).offset().left)/($(this).width()/100)), $(this) );
						})
					})

					// Brand content detail padding top
					$('.box-gallery', event.target)
						.each(function(index, el)
						{
							var $box = $(this);
							var $content = $(this).find('.content-detail');
							var $annot = $(this).find('.content-wrap h1.h2');

							$annot.length && $content.css('padding-top', $annot.position().top );
						});

					// video touchend
					if ($('#custom-video', event.target).length){
						$(document)
							.on('touchend', function(e){
								$('#custom-video')[0].play();
							})
					}

					// crossroad download
					$('.crossroad-download', event.target)
						.each(function(index, el)
						{
							var $this = $(this),
								$btn = $this.find('.btn-expand'),
								$filter = $this.find('.filter .btn'),
								$item = $this.find('.item'),
								$li = $this.find('.item li'),
								$title = $this.find('.title'),
								$overlay = $this.find('.overlay');

							$btn.add($overlay)
								.on('click', function(event){
									event.preventDefault();
									event.stopImmediatePropagation();

									$this.toggleClass('open');
								})

							$filter
								.on('click', function(event){
									event.preventDefault();
									event.stopImmediatePropagation();

									if ( !$(this).hasClass('status-active') ){

										$filter.removeClass('status-active');
										$(this).addClass('status-active');

										$title.text($(this).text());
										$li
											.hide()
											.filter('.'+$(this).attr('href').split('#')[1])
												.show();

										$item
											.show()
											.each(function(){
												if ( !$(this).find('li:visible').length ){
													$(this).hide();
												}
											})

									}

									if(!event.isTrigger){
										$this.removeClass('open');
									}
								})

							$filter.first().trigger('click');

						})

					// crossroad category ---- OMNIDER -----
				    $('.crossroad-category', event.target)
						.each(function(index, el)
						{
							var sizes = {7: {hoverCoef:5, width:600}, 3:{hoverCoef:2.5, width:851}, 2:{hoverCoef:1.8, width:1496}}
							var $cat = $(this);
							var	liNum,
								liWidth,
								liHoverWidth,
								liRestWidth,
								liHeight,
								liCoef;
							var resize = function(){
								liNum = $cat.find('li').length;
								liWidth = Math.ceil($(window).width() / liNum);
								liHoverWidth = Math.ceil($(window).width() / sizes[liNum].hoverCoef);
								liRestWidth = Math.ceil(liWidth - ((liHoverWidth - liWidth) / (liNum - 1)));
								liHeight = $(window).height();
								liCoef = 100 / 900 * $cat.find('li').height() / 100;
								//console.log(liCoef)
								//console.log('liWidth: '+liWidth)
								//console.log('liHover: '+liHoverWidth)
								//console.log('liRest: '+liRestWidth)
								$cat.find('li').each(function(index){
								  	TweenMax.set($(this), {width:sizes[liNum].width*liCoef, x: index*liWidth, clip:'rect(0px,'+liWidth+'px,'+liHeight+'px,0px)'})
								  	TweenMax.set(
								  		$(this).find('> a')
								  			.add($(this).find('> .box-contact'))
								  			.add($(this).find('> .box-contact.left .close')), {x:-((sizes[liNum].width*liCoef - liWidth) / 2 ), force3D:true})
								  	TweenMax.set($(this).find('> .box-contact.right .close'), {x:((sizes[liNum].width*liCoef - liWidth) / 2 ), force3D:true})
								  	TweenMax.set($(this).find('.name'), {width:liWidth*.9 });
								  	//TweenMax.set($(this).find('.overlay'), {width:liWidth, x: ((600*liCoef - liWidth) / 2 ), force3D:true })
								})
							};

							var addListeners = function(){
								$cat.find('li').on('mouseenter', function(e){
									if(!$(this).closest('ul').hasClass('disabled')){
										Ease = Quad.easeOut;
										time = .3;
										Delay = 0.01;
										$this = $(this);
										TweenMax.killTweensOf($(this));
										TweenMax.killTweensOf($(this).find('> a').add($(this).find('> .box-contact')).add($(this).find('> .box-contact .close')));
										TweenMax.to($this, time, {clip:'rect(0px,'+liHoverWidth+'px,'+liHeight+'px,0px)', x: $this.data('index') * liRestWidth,   ease: Ease});
										TweenMax.to($this.find('> a').add($(this).find('> .box-contact')).add($(this).find('> .box-contact.left .close')), time, {x:-((sizes[liNum].width*liCoef - liHoverWidth) / 2 ), ease: Ease})
										TweenMax.to($(this).find('> .box-contact.right .close'), time, {x:((sizes[liNum].width*liCoef - liHoverWidth) / 2 ), ease: Ease})
										TweenMax.to($this.find('.overlay'), time, {backgroundColor:'rgba(0,0,0,0)', ease: Linear.easeNone,/*width:liHoverWidth, x: ((600*liCoef - liHoverWidth) / 2 ),*/ force3D:true})
										$cat.find('li').each(function(index, element){
											if($(this).data('index') != $this.data('index')){
												TweenMax.killTweensOf($(this));
												TweenMax.killTweensOf($(this).find('> a').add($(this).find('> .box-contact')).add($(this).find('> .box-contact .close')));
												if($(this).data('index') < $this.data('index'))
													TweenMax.to($(this), time, {clip:'rect(0px,'+liRestWidth+'px,'+liHeight+'px,0px)', x:liRestWidth*index,  ease: Ease});
												else
													TweenMax.to($(this), time, {clip:'rect(0px,'+liRestWidth+'px,'+liHeight+'px,0px)', x:(liRestWidth*(index-1)) + liHoverWidth,  ease: Ease});
												TweenMax.to($(this).find('> a').add($(this).find('> .box-contact')).add($(this).find('> .box-contact.left .close')), time, {x:-((sizes[liNum].width*liCoef - liRestWidth) / 2 ), ease: Ease})
												TweenMax.to($(this).find('> .box-contact.right .close'), time, {x:((sizes[liNum].width*liCoef - liRestWidth) / 2 ), ease: Ease})
											}
										})
									}
								});


								$cat.find('li').on('mouseleave', function(e){
									Ease = Quad.easeOut;
									time = .3;
									Delay = 0.00;
									TweenMax.killTweensOf($(this));
									TweenMax.killTweensOf($(this).find('> a').add($(this).find('> .box-contact')).add($(this).find('> .box-contact .close')));
									TweenMax.to($(this), time, {clip:'rect(0px,'+liWidth+'px,'+liHeight+'px,0px)', x: $this.data('index') * liWidth, ease: Ease, delay:Delay, overwrite:'all'})
									TweenMax.to($this.find('> a').add($(this).find('> .box-contact')).add($(this).find('> .box-contact.left .close')), time, {x:-((sizes[liNum].width*liCoef - liWidth) / 2 ), ease: Ease})
									TweenMax.to($(this).find('> .box-contact.right .close'), time, {x:((sizes[liNum].width*liCoef - liWidth) / 2 ), ease: Ease})
									TweenMax.to($this.find('.overlay'), time, {backgroundColor:'rgba(0,0,0,.6)', ease: Linear.easeNone,/*width:liWidth, x: ((600*liCoef - liWidth) / 2 ),*/ delay:Delay, overwrite:'all', })
									$cat.find('li').each(function(index, element){
										if($(this).data('index') != $this.data('index')){
											TweenMax.killTweensOf($(this));
											TweenMax.killTweensOf($(this).find('> a').add($(this).find('> .box-contact')).add($(this).find('> .box-contact .close')));
											TweenMax.to($(this), time, {clip:'rect(0px,'+liWidth+'px,'+liHeight+'px,0px)', x:liWidth*index,  ease: Ease, delay:Delay, overwrite:'all', onComplete:clear3D, onCompleteParams:[$(this)]});
											TweenMax.to($(this).find('> a').add($(this).find('> .box-contact')).add($(this).find('> .box-contact.left .close')), time, {x:-((sizes[liNum].width*liCoef - liWidth) / 2 ), ease: Ease})
											TweenMax.to($(this).find('> .box-contact.right .close'), time, {x:((sizes[liNum].width*liCoef - liWidth) / 2 ), ease: Ease})
										}
									})
								});

								$cat.find('li').on('mouseup', function(e){
									if($(this).closest('ul').find('.box-contact').length){ // pokud kontakty
										$(this).trigger('mouseleave');
									}
								});
							};

							clear3D = function(element){
								//element.css({'transform': '', '-webkit-transform': ''})
								//resize();
								element.find('.overlay').css('backgroundColor', '')
							}

							$(window).on('resize', resize);
							resize();
							addListeners();
						});
                        
                    $('.crossroad-category2', event.target)
						.each(function(index, el)
						{
							var sizes = {7: {hoverCoef:5, width:600}, 3:{hoverCoef:2.5, width:851}, 2:{hoverCoef:1.8, width:1496}}
							var $cat = $(this);
							var	liNum,
								liWidth,
								liHoverWidth,
								liRestWidth,
								liHeight,
								liCoef;
							var resize = function(){
								liNum = $cat.find('li').length;
								liWidth = Math.ceil($(window).width() / liNum);
								liHoverWidth = Math.ceil($(window).width() / sizes[liNum].hoverCoef);
								liRestWidth = Math.ceil(liWidth - ((liHoverWidth - liWidth) / (liNum - 1)));
								liHeight = $(window).height();
								liCoef = 100 / 900 * $cat.find('li').height() / 100;
								//console.log(liCoef)
								//console.log('liWidth: '+liWidth)
								//console.log('liHover: '+liHoverWidth)
								//console.log('liRest: '+liRestWidth)
								$cat.find('li').each(function(index){
								  	TweenMax.set($(this), {width:sizes[liNum].width*liCoef, x: index*liWidth, clip:'rect(0px,'+liWidth+'px,'+liHeight+'px,0px)'})
								  	TweenMax.set(
								  		$(this).find('> a')
								  			.add($(this).find('> .box-contact'))
								  			.add($(this).find('> .box-contact.left .close')), {x:-((sizes[liNum].width*liCoef - liWidth) / 2 ), force3D:true})
								  	TweenMax.set($(this).find('> .box-contact.right .close'), {x:((sizes[liNum].width*liCoef - liWidth) / 2 ), force3D:true})
								  	TweenMax.set($(this).find('.name'), {width:liWidth*.9 });
								  	//TweenMax.set($(this).find('.overlay'), {width:liWidth, x: ((600*liCoef - liWidth) / 2 ), force3D:true })
								})
							};

							var addListeners = function(){
								$cat.find('li').on('mouseenter', function(e){
									if(!$(this).closest('ul').hasClass('disabled')){
										Ease = Quad.easeOut;
										time = .3;
										Delay = 0.01;
										$this = $(this);
										TweenMax.killTweensOf($(this));
										TweenMax.killTweensOf($(this).find('> a').add($(this).find('> .box-contact')).add($(this).find('> .box-contact .close')));
										TweenMax.to($this, time, {clip:'rect(0px,'+liHoverWidth+'px,'+liHeight+'px,0px)', x: $this.data('index') * liRestWidth,   ease: Ease});
										TweenMax.to($this.find('> a').add($(this).find('> .box-contact')).add($(this).find('> .box-contact.left .close')), time, {x:-((sizes[liNum].width*liCoef - liHoverWidth) / 2 ), ease: Ease})
										TweenMax.to($(this).find('> .box-contact.right .close'), time, {x:((sizes[liNum].width*liCoef - liHoverWidth) / 2 ), ease: Ease})
										TweenMax.to($this.find('.overlay'), time, {backgroundColor:'rgba(0,0,0,0)', ease: Linear.easeNone,/*width:liHoverWidth, x: ((600*liCoef - liHoverWidth) / 2 ),*/ force3D:true})
										$cat.find('li').each(function(index, element){
											if($(this).data('index') != $this.data('index')){
												TweenMax.killTweensOf($(this));
												TweenMax.killTweensOf($(this).find('> a').add($(this).find('> .box-contact')).add($(this).find('> .box-contact .close')));
												if($(this).data('index') < $this.data('index'))
													TweenMax.to($(this), time, {clip:'rect(0px,'+liRestWidth+'px,'+liHeight+'px,0px)', x:liRestWidth*index,  ease: Ease});
												else
													TweenMax.to($(this), time, {clip:'rect(0px,'+liRestWidth+'px,'+liHeight+'px,0px)', x:(liRestWidth*(index-1)) + liHoverWidth,  ease: Ease});
												TweenMax.to($(this).find('> a').add($(this).find('> .box-contact')).add($(this).find('> .box-contact.left .close')), time, {x:-((sizes[liNum].width*liCoef - liRestWidth) / 2 ), ease: Ease})
												TweenMax.to($(this).find('> .box-contact.right .close'), time, {x:((sizes[liNum].width*liCoef - liRestWidth) / 2 ), ease: Ease})
											}
										})
									}
								});


								$cat.find('li').on('mouseleave', function(e){
									Ease = Quad.easeOut;
									time = .3;
									Delay = 0.00;
									TweenMax.killTweensOf($(this));
									TweenMax.killTweensOf($(this).find('> a').add($(this).find('> .box-contact')).add($(this).find('> .box-contact .close')));
									TweenMax.to($(this), time, {clip:'rect(0px,'+liWidth+'px,'+liHeight+'px,0px)', x: $this.data('index') * liWidth, ease: Ease, delay:Delay, overwrite:'all'})
									TweenMax.to($this.find('> a').add($(this).find('> .box-contact')).add($(this).find('> .box-contact.left .close')), time, {x:-((sizes[liNum].width*liCoef - liWidth) / 2 ), ease: Ease})
									TweenMax.to($(this).find('> .box-contact.right .close'), time, {x:((sizes[liNum].width*liCoef - liWidth) / 2 ), ease: Ease})
									TweenMax.to($this.find('.overlay'), time, {backgroundColor:'rgba(0,0,0,.6)', ease: Linear.easeNone,/*width:liWidth, x: ((600*liCoef - liWidth) / 2 ),*/ delay:Delay, overwrite:'all', })
									$cat.find('li').each(function(index, element){
										if($(this).data('index') != $this.data('index')){
											TweenMax.killTweensOf($(this));
											TweenMax.killTweensOf($(this).find('> a').add($(this).find('> .box-contact')).add($(this).find('> .box-contact .close')));
											TweenMax.to($(this), time, {clip:'rect(0px,'+liWidth+'px,'+liHeight+'px,0px)', x:liWidth*index,  ease: Ease, delay:Delay, overwrite:'all', onComplete:clear3D, onCompleteParams:[$(this)]});
											TweenMax.to($(this).find('> a').add($(this).find('> .box-contact')).add($(this).find('> .box-contact.left .close')), time, {x:-((sizes[liNum].width*liCoef - liWidth) / 2 ), ease: Ease})
											TweenMax.to($(this).find('> .box-contact.right .close'), time, {x:((sizes[liNum].width*liCoef - liWidth) / 2 ), ease: Ease})
										}
									})
								});

								$cat.find('li').on('mouseup', function(e){
									if($(this).closest('ul').find('.box-contact').length){ // pokud kontakty
										$(this).trigger('mouseleave');
									}
								});
							};

							clear3D = function(element){
								//element.css({'transform': '', '-webkit-transform': ''})
								//resize();
								element.find('.overlay').css('backgroundColor', '')
							}

							$(window).on('resize', resize);
							resize();
							addListeners();
						});

					// Homepage intro
					$('.box-intro.home', event.target)
						.each(function(index, el)
						{
							var $box = $(this);

							var Slideshow = new app.widgets.Slideshow.create($box, {
								timeout: 0,
								Pager: {
									// vygenerovat menu pro kroky
									pagerPages: $box.find('.pages')
								}
							}).init();

							$(Slideshow)
								.on('initplay', function(event, firstPlay)
								{
									$(Slideshow).trigger('beforechange');

									TweenMax.to( $box.find('.pager'), .5, {
										right: 20,
										ease:Quad.easeOut,
										overwrite: true,
										delay: firstPlay ? .3 : .1,
										onComplete: function()
										{
											$(Slideshow).trigger('afterchange')
										}
									});

								})
								.on('initstop', function(event)
								{
									// kill all zoom
									var tween = this.$currentSlide.data('tween');
									tween && tween.kill && tween.kill();

									if(this.$beforeSlide)
									{
										var tween = this.$beforeSlide.data('tween');
										tween && tween.kill && tween.kill();
									}

								})
								.on('beforechange', function(event)
								{
									this.$currentSlide.find('.content > *').css({'left': '', 'opacity': ''});

									TweenMax.set( this.$currentSlide.find('> .bg'), {x: 0, y:0, z:0, scale: 1, opacity: 1});

									var $bg = this.$currentSlide.find('> .bg')

									// if(app.isIE === -1)
									// {
										this.$currentSlide.data(
											'tween',
											TweenMax.to( $bg, 10, {
										        css: {
										            scale: 1.1,
										            x: -( $bg.width() * 0.05 ),
										            y: -( $bg.height() * 0.05 ),
										           	z: 0.1,
										            rotationZ: "0.01deg",
										            transformOrigin: "0 0",
										            force3D: true
										        },
										        ease:Linear.easeNone,
										        force3D:true,
										        overwrite: true
										    })
										)
									// }
								})
								.on('afterchange', function(event, state)
								{
									// kill old zoom
									if(this.$beforeSlide)
									{
										var tween = this.$beforeSlide.data('tween');
										tween && tween.kill && tween.kill();

										var tween = this.$beforeSlide.data('timeline');
										tween && tween.kill && tween.kill();
									}

									var tl = new TimelineMax();

									this.$currentSlide.data('timeline', tl)

									tl
										.to( this.$currentSlide.find('> .bg'), .8, {opacity: .7, ease:Quad.easeInOut}, '0.15')
										.staggerTo( this.$currentSlide.find('.content > *'), 1, {opacity:1, left:0, ease:Quad.easeOut}, 0.2, '-=0.3');
								});

							$box.data('app-slideshow', Slideshow)
						});

					// Scrollovací sekce
					$('.menu-section', event.target)
						.each(function(index, el)
						{
							var $menu = $(this);
							var $section = $menu.prev('.section-scroll');
							var Sections = new app.widgets.Sections.create( $section, {
								durationScroll: Modernizr.touch ? 0.3 : 0.6,
								Scroll: {

								},
								Pager: {
									// ovládací prvek pro předchozí
									pagerPrev: $menu.find('.prev'),
									// ovládací prvek pro další
									pagerNext: $menu.find('.next'),
									// vygenerovat menu pro kroky
									pagerPages: $menu.find('.wrap'),
									// mask
									pagerMask: $menu.find('.pages'),
									// přidat do masky
									pagerMaskAdd: $section.find('.crossroad-section').length ? 0 : 1
								}
							});
							Sections.init();


							$(Sections)
								.on('afterinit afterchange', function(event)
								{
									Sections.$sections.not(':eq('+ Sections.currentIndex +')').find('.img .scroll').cycle('pause');
									Sections.$sections.eq( Sections.currentIndex ).find('.img .scroll').cycle('resume');

									// youtube video
									Sections.$sections.not(':eq('+ Sections.currentIndex +')').find('.box-youtube .stop').trigger('click');
									Sections.$sections.eq( Sections.currentIndex ).find('.box-youtube .play').trigger('click');

									// custom video
									if (Sections.$sections.not(':eq('+ Sections.currentIndex +')').find('#custom-video').length){
										Sections.$sections.not(':eq('+ Sections.currentIndex +')').find('#custom-video')[0].pause();
									}
									if (Sections.$sections.eq( Sections.currentIndex ).find('#custom-video').length) {
										Sections.$sections.eq( Sections.currentIndex ).find('#custom-video')[0].play();
									}
								});

							// Rozcestník sekcí - trigger kliku
							$section
								.on('click', '.crossroad-section .menu a, .section-link', function(event)
								{
									event.preventDefault();
									event.stopPropagation();

									Sections.Pager.$parerPagesItem.filter('[href="'+ $(this).prop('hash') +'"]').trigger('mousedown');
								})

							$(this).data('app-sections', Sections);
						});

					// Cycle
					$('.crossroad-services .img, .box-gallery', event.target)
						.each(function()
						{
							var $box = $(this);

							$box
								// zákaz bublání do ajaxify
								.on('click', '.btn-prev, .btn-next, .pager', function(event)
								{
									event.stopPropagation();
								})
								.find('.scroll:first')
									.cycle({
										paused: true,
										timeout: $box.is('.img') ? 4000 : 8000,
										fx: 'fadeout',
										slides: '> *',
										prev: $box.find('.btn-prev'),
										next: $box.find('.btn-next'),
										pager: $box.find('.pages, .pager-img'),
										autoHeight: 'calc',
										pagerTemplate: '',
										pagerActiveClass: 'active',
										updateView: 0
									})
									.on('cycle-before', function(){
										$('.box-youtube .stop').trigger('click');
									})
									.on('cycle-next cycle-prev cycle-pager-activated', function(event, options)
									{
										options.timeout = 0;
										//$(this).cycle('stop');
									})
						});

					// Cycle team
					$('.crossroad-team', event.target)
						.each(function()
						{
							var $this = $(this),
								options = $.extend({
									animation: 350,
									easing: Expo.easeInOut,
									repeat: false,
									fullscreen: false,
									pagerNext: $this.find('.btn-next'),
									pagerPrev: $this.find('.btn-prev'),
									pagerPages: $this.find('.pages'),
									timeout: 0,
									scroll: 3,
									infinite: false
								}, options || {});

							var carousel = new sk.widgets.Carousel( $this.find('.scroll'), options ).init();

						});

					// Carousel
					$('.pager-img-wrap', event.target).each(function(i)
					{

						var $box = $(this);
						var isTeam = $box.hasClass('crossroad-team');
						var isPager = $box.hasClass('pager-img-wrap');

						var options = $.extend({
							animation: 350,
							easing: Linear.easeIn,
							repeat: false,
							fullscreen: false,
							pagerNext: $box.find('.next'),
							pagerPrev: $box.find('.prev'),
							timeout: 0,
							infinite: false,
							offset: isTeam ? 40 : 20
						}, options || {});

						var Carousel = null;

						var $scroll = isPager? $box.find('.pager-img'): $box.find('.scroll');

						$box
							.on('recalc.skcarousel', function(event)
							{
								Carousel = !Carousel ? new sk.widgets.Carousel($scroll, options ) : Carousel.destroy();
								Carousel.init();
							})
							.trigger('recalc.skcarousel');

						if( isTeam || isPager )
						{
							var center;
							var offset = 200;
							var actualX = 0;
							var isScroll = 0;
							var speedCoef = 2;

							// Na startu carousel vycentrovat
							// actualX = -Carousel.delta/2;
							// Carousel.$element.css('left', actualX)

							$box.find('.sk-carousel')
								.on('mouseenter', function(event)
								{
									center = $box.width() / 2
									actualX = parseInt( Carousel.$element.css('left') );
								})
								.on('mousemove', function(event)
								{
									if( Carousel.delta )
									{
										var x = event.pageX;

										if( x - center > offset )
										{
											if(isScroll !== 1)
											{
												isScroll = 1;
												Carousel.options.animation = (Carousel.delta + actualX) * speedCoef;
												Carousel.setPosition(Carousel.max, true, false, true)
											}
										}
										else if(x - center < -offset )
										{
											if(isScroll !== -1)
											{
												isScroll = -1;
												Carousel.options.animation = (actualX * (-1)) * speedCoef;
												Carousel.setPosition(Carousel.min, true, false, true)
											}
										}
										else if(isScroll !== 0)
										{
											Carousel.anim && Carousel.anim.kill()
											isScroll = 0;
											actualX = parseInt( Carousel.$element.css('left') );
										}
									}
								})
								.on('mouseleave', function(event)
								{
									Carousel.anim && Carousel.anim.kill()
									isScroll = 0;
								});
						}


						$box.data('app-carousel', Carousel);
					});

					// sortiment img center
					$('.crossroad-sortiment', event.target).each(function(i)
					{
						var $this = $(this),
							$wrap = $this.find('.wrap'),
							$img = $this.find('img'),
							$point = $this.find('.point');

						// $img
						// 	.one('load', function() {
						// 		$this.trigger('recalc.width');
						// 	})

						$img
							.each(function() {

								if( $this.width()/$img.width() < $this.height()/$img.height() )
								{
									$img.height($this.height())
									$wrap.height($this.height())
									$wrap.width($img.width())
								}
								else{
									$img.width($this.width())
									$wrap.width($this.width())
									$wrap.height($img.height())
								}

								$point
									.each(function(){
										if( $(this).offset().left < 0 ){
											$(this)
												.css('left', $wrap.offset().left*-1 + 30);

										}
										else if( $(this).offset().left > $this.width() ){
											$(this)
												.css('left', $this.width() - $wrap.offset().left - 30 )
												.addClass('left');
										}

										if( $(this).offset().top < $this.offset().top ){

											$(this)
												.css('top', $wrap.position().top*-1 + 30) ;
										}
										else if( $(this).offset().top > $this.height() + $this.offset().top ){
											$(this)
												.css('top', $this.height() - $wrap.offset().top + 30 );

										}

									})
							});

						// $this
						// 	.on('recalc.width', function(event)
						// 	{
						// 		$img.add($wrap).removeAttr('style');

						// 		if( $this.width()/$img.width() < $this.height()/$img.height() )
						// 		{
						// 			$img.height($this.height())
						// 			$wrap.height($this.height())
						// 			$wrap.width($img.width())
						// 		}
						// 		else{
						// 			$img.width($this.width())
						// 			$wrap.width($this.width())
						// 			$wrap.height($img.height())
						// 		}
						// 	});

					});


					// Input file
					$('input:file', event.target)
						.each(function(){
							var $file = $(this);

							$file
								.addClass('sk-fake-file-file')
								.attr({'size': 500})
								.wrap('<span class="sk-fake-file"></span>')
								.after('<span class="sk-fake-file-wrap-text"><span>'+$file.data('before')+'</span></span>')
								.wrap('<span class="sk-fake-file-wrap"></span>')

							var $wrap = $file.closest('.sk-fake-file'),
								$text = $wrap.find('.sk-fake-file-wrap-text span');

							$file
								.on('change', function(){
									$wrap.addClass('done');
									$text.text($file.data('after'));
								});
						});

					// Beautify OL
					$('ol[start]', event.target)
						.css('counter-reset', function()
						{
							 return 'item ' + ( $(this).prop('start') - 1 )
						})

					// ie 7 OL
					$('html.ie7 ol', event.target)
						.each(function(i)
						{
							var start = $(this).prop('start') * 1;

							$(this).find('li')
								.each(function(i)
								{
									$(this).prepend('<span class="ie-counter">' + (start + i) + '.</span>');
								});
						});
				})
				// Start stránky ( animace )
				.on('contentplay', function(event, firstPlay)
				{
					$('.box-intro', event.target)
						.each(function(index, el)
						{
							var $box = $(this);
							var Slideshow = $box.data('app-slideshow');

							if(Slideshow)
							{
								Slideshow.options.timeout = 5000;
								Slideshow.resetInterval();

								// TweenMax.staggerTo( Slideshow.$currentSlide.find('.content > *') , 1, {opacity:1, left:0, delay: .3, ease:Quad.easeOut}, 0.2);
								$(Slideshow)
									.trigger('initplay', firstPlay)
							}
						});

					$('.box-magazin', event.target)
						.each(function(index, el)
						{
							TweenMax.staggerTo( $(this).find('.content > *') , 1, {opacity:1, left:0, delay: .3}, 0.4);
						});

					$('.crossroad-sortiment', event.target)
						.each(function(index, el)
						{
							TweenMax.staggerTo( $(this).find('.point') , .7, {opacity:1, scale:1, delay: .3}, 0.25);
						});

					$('.menu-section', event.target)
						.each(function(index, el)
						{
							TweenMax.to( this, .5, { right: $.scrollbarWidth ? $.scrollbarWidth() : 0, delay: .3 });
						});

					// Pusť cycle
					$('.box-gallery .scroll', event.target).cycle('resume');

					// video resize
					$('#video', event.target).each(function(){
						var $this = $(this);
						var $video = $this.find('video');
						var data = $this.data();

						var width = data.width;
						var height = data.height;
						var ratio = width / height;

						$this.on('resize.bg', function(event)
						{
							event.preventDefault();

							var wWidth = $this.closest('.img').width();
							var wHeight = $this.closest('.img').height();
							var wRatio = wWidth / wHeight;

							if(ratio > wRatio)
							{
								var w = wHeight / height * width;

								$video
									.css({'height': wHeight, 'width': w, 'margin-top': -wHeight/2, 'margin-left': -w/2, 'top': '50%', 'left': '50%'});
							}
							else
							{
								var h = wWidth / width * height;

								$video
									.css({'height': h, 'width': wWidth, 'margin-top': -h/2, 'margin-left': -wWidth/2, 'top': '50%', 'left': '50%'});
							}

						})
						.trigger('resize.bg');
					})
				})
				// Destroy
				.on('contentunload', function(event)
				{
					$('.box-intro', event.target).each(function(index, el)
					{
						var $box = $(this);
						var Slideshow = $box.data('app-slideshow');

						if( Slideshow )
						{
							Slideshow.destroy();
							$(Slideshow)
								.trigger('initstop')
								.off('beforechange afterchange');
						}
					});

					// Scrollovací sekce
					$('.menu-section', event.target).each(function(index, el)
					{
						var $box = $(this);
						var Sections = $box.data('app-sections');

						if( Sections )
						{
							Sections.destroy();
						}
					});

					//
					$('.crossroad-team', event.target)
					.each(function(index, el)
					{
						var $box = $(this);
						var Carousel = $box.data('app-carousel');

						if( Carousel )
						{
							Carousel.destroy();
						}
					});

					// Destroy cycle
					$('.crossroad-services .img .scroll, .box-gallery .scroll', event.target).cycle('destroy');

					// destroy bing
					$('.crossroad-sortiment', event.target).off('recalc.width');

					// video resize destroy
					$('#video').off('resize.bg');
				})

			$(app.MQ)
				.on('changeMedia resizeMedia', function(event)
				{
					$('.pager-img-wrap').trigger('recalc.skcarousel');
					$('.crossroad-sortiment').trigger('recalc.width');
					$('#video').trigger('resize.bg');
				})
				.on('changeMedia', function()
				{
					app.Images.resize('.responsive');
				});


			if(Modernizr.history)
			{
				app.Ajaxify.init();
			}
			else
			{
				var $submenu = $('.menu-subpage');

				if($submenu.length)
				{
					$submenu.appendTo( app.$visible.find('.header') );
					 app.$visible.find('.header .inner').hide();
				}
			}
			//console.log(app.Ajaxify)
		}
	};
})(jQuery)
