(function(sk, app, $){

	app.Ajaxify = {
		currentTarget: null,
		currentPage: null,
		currentContent: null,
		currentSubmenu: null,
		oldPage: null,
		oldContent: null,
		oldSubmenu: null,
		loaderTimer: null,
		lastFrontUrl: null,
		lastBackUrl: null,
		cache: {},
		isCached: false,

		metaWords: $('meta[name="keywords"]').get(0),
		metaDesc: $('meta[name="description"]').get(0),

		init: function()
		{
			$(document)
				.on('click', '.header .arrow a', $.proxy(function(event)
				{
					var lastUrl = app.isBack ? this.lastFrontUrl : this.lastBackUrl;

					if( lastUrl )
					{
						event.preventDefault();
						event.stopImmediatePropagation();

						$('<a href="'+ lastUrl +'" />').appendTo( this.currentContent ).trigger('click');
					}

				}, this));

			this.Ajaxify = new sk.utils.Ajaxify({
				'pageTree': app.options.links,
				'linksSelector': 'a:not(.no-ajax)',
				'formsSelector': 'form.ajax',
				'ajaxData': {
					'ajax': true
				}
			}).init();

			$(this.Ajaxify)
				.on('start.ajaxify', $.proxy( this.handleStart, this ) )
				.on('done.ajaxify', $.proxy( this.handleDone, this ) )
				.on('fail.ajaxify', $.proxy( this.handleFail, this ) );


			this.oldSubmenu = app.$visible.find('.menu-subpage').appendTo( app.$visible.find('.header') );
			this.currentContent = app.$visible.find('.main > *:last');

			// Pokud je submenu schovám hlavičku
			this.oldSubmenu.length && app.$visible.find('.header .inner').css('top', '-120px');

			// holder nastavení otočení
			//app.$holder.css('transform', 'rotateY('+ (app.isBack ? -180 : 0) +'deg) scale(1)');
			TweenMax.set(app.$front, { rotationY:(app.isBack ? -180 : 0), scale:1, force3D: true });
			TweenMax.set(app.$back, { rotationY:(app.isBack ? 0 : -180), scale:1, force3D: true });


			this.changePage();
			this.changeLinks();

			this.cache[this.currentPage.url] = true;
		},

		handleStart: function()
		{
			this.isCached = false;

			this.currentTarget = $( this.Ajaxify.state.data.target );
			this.changePage();
			this.changeLinks();

			this.loadingStart();

			this.isNewContext = ( this.currentPage.backend !== this.oldPage.backend );
			this.setContext();

			if( app.isBack )
			{
				this.lastBackUrl = this.currentPage.url;
			}
			else
			{
				this.lastFrontUrl = this.currentPage.url;
			}

			// GA
			if(typeof _gaq !== 'undefined'){
				_gaq.push(['_trackPageview', this.currentPage.url]);
				_gaq.push(['b._trackPageview', this.currentPage.url]);
			}
		},

		handleDone: function(event, response)
		{
			this.loadingAjax();
			this.changeContent( response );
			this.changeSubmenu();

			this.currentContent
				.one('afterload', $.proxy( this.handleAfterLoad, this) );

			this.loadingImages();

			//this.isCached && this.currentContent.trigger('afterload');
		},

		handleFail: function(jqXHR, textStatus, errorThrown)
		{
			this.loadingEnd();
			location.reload();
		},

		handleAfterLoad: function()
		{
			this.cache[this.currentPage.url] = true;

			this.loadingEnd();

			if( app.$visible.find('.main').css('opacity') === '0' )
			{
				TweenMax.to( app.$visible.find('.main'), 1, { autoAlpha: 1 });
			}

			// form
			if( this.currentTarget.is('form') )
			{
				// odstranit starý obsah
				this.oldContent
					.trigger('contentunload');

				this.oldContent.replaceWith( this.currentContent )

				// redirect pokud je
				var redirect = this.currentContent.find('*[data-redirect]:first').data('redirect');

				if(redirect)
				{
					//$('<a href="'+ redirect +'" />').appendTo( this.currentContent ).trigger('click');
					// nahrazeno v developers.js - univerzalni i pro first load a content change
				}

				// bind nových
				this.currentContent
					.css({position: '', display: '', left: '', top:'', opacity: ''})
					.trigger('contentload')
					.trigger('contentplay');
			}
			// Odkazy
			else
			{
				if( !this.isNewContext )
				{
					this.animationPage();
				}
				else
				{
					this.animationPageContext();
				}
			}

			$(document).trigger('contentafterload')
		},

		// Převrácení stránky
		animationPageContext: function()
		{
			var currentContent = this.currentContent;
			var oldContent = this.oldContent;

			currentContent.appendTo( app.$visible.find('.main').empty() ).scrollTop(0).trigger('contentload');

			var tl = new TimelineMax({
				onComplete: function()
				{
					currentContent.trigger('contentplay');
					oldContent.trigger('contentunload').remove();
					currentContent = null;
					oldContent = null;

				}
			})

			currentContent
				//reset
				.css({position: '', display: '', left: '', top:'', opacity: ''})

			if(app.isIE === 10)
			{
				tl
					.to(app.$front, 0, {rotationY:(app.isBack ? -180 : 0), scale:1, ease:Expo.easeOut })
					.to(app.$back, 0, {rotationY: (app.isBack ? 0 : -180), scale:1, ease:Expo.easeOut })
			}
			else
			{
				tl
					.to(app.$front, .75, {rotationY: -90, scale: .6, ease:Expo.easeIn })
					.to(app.$back, .75, {rotationY: -90, scale: .6, ease:Expo.easeIn }, '-=0.75')
					.to(app.$front, .75, {rotationY:(app.isBack ? -180 : 0), scale:1, ease:Expo.easeOut })
					.to(app.$back, .75, {rotationY: (app.isBack ? 0 : -180), scale:1, ease:Expo.easeOut }, '-=0.75')
			}
		},

		// Průchod stránkama
		animationPage: function()
		{
			var fx = 'right';
			var fxType = 'slide';
			var oldPage = this.oldPage;
			var page = this.currentPage;

			// Rodič je jinej stejnej rodič
			if( oldPage.topParent !== page.topParent  )
			{
				oldPage = this.Ajaxify.getPage( oldPage.topParent );
				page = this.Ajaxify.getPage( page.topParent );
			}

			// Level je stejnej
			if( oldPage.level === page.level )
			{
				// pokud je to vyloženě pager nebo index je větší
				if( this.currentTarget.hasClass('prev') || !this.currentTarget.hasClass('next') && oldPage.index > page.index )
				{
					fx = 'left';
				}
			}
			// stránka je detail, otevírat fadem
			else if( oldPage.detail || page.detail )
			{
				fxType = 'fade';
				fx = page.detail ? 'in' : 'out';
			}
			else
			{
				fx = oldPage.level > page.level ? 'top' : 'bottom';
			}

			var currentContent = this.currentContent;
			var oldContent = this.oldContent;

			// Změna stavu
			app.Animation[fxType]({
				dir: fx,
				elementOut: oldContent,
				elementIn: currentContent.scrollTop(0).trigger('contentload'),
				onComplete: $.proxy(function()
				{
					currentContent.trigger('contentplay');
					currentContent.prevAll().trigger('contentunload').remove();
					currentContent = null;
					oldContent = null;

				}, this)
			});
		},

		changePage: function()
		{
			this.oldPage = this.Ajaxify.oldPage;
			this.currentPage = this.Ajaxify.page;

			this.isCached = this.currentPage.url in this.cache;
		},

		changeContent: function( response )
		{
			var $response = $( response );
			var scripts = $($.parseHTML( response, document, true)).filter('script');

			var $metas = $response.filter('.metas').first();

			this.oldContent = this.currentContent;
			this.currentContent = $response.filter('.section').first();

			if($metas.length)
			{
				document.title = $metas.find('.metaTitle').text();
				this.metaWords.content = $metas.find('.metaKeywords').text();
				this.metaDesc.content = $metas.find('.metaDescription').text();
			}

			this.currentContent
				.css({position: 'absolute', display: 'block', left: 0, top:0, opacity: 0})
				.appendTo( app.$visible.find('.main') );



			$(document).trigger('contentchange');
		},

		changeSubmenu: function()
		{
			var change = false;
			this.currentSubmenu = this.currentContent.find('.menu-subpage').detach();

			// Máme nové submenu
			if( this.currentSubmenu.length)
			{
				// Staré menu není
				if( !this.oldSubmenu || !this.oldSubmenu.length )
				{
					// Přidání do hlavičky
					this.currentSubmenu.appendTo( app.$visible.find('.header') );
					// hlavní menu pryč
					TweenMax.to( app.$visible.find('.header .inner'), .5, {
						top: -120,
						overwrite: true,
						ease: Quad.easeIn
					});

					change = true;
				}
				// Staré menu je ale má jiné id
				else if( this.oldSubmenu.attr('id') !== this.currentSubmenu.attr('id') )
				{
					// Přepsání
					this.oldSubmenu.replaceWith( this.currentSubmenu );
					change = true;
				}
				// Pokud je menu stejné nic se neděje, odkazy se aktivovali předtím
				if(change)
				{
					this.changeLinks( this.currentSubmenu );
					this.oldSubmenu = this.currentSubmenu;
				}
			}
			// Odstraníme staré submenu
			else if( this.oldSubmenu && this.oldSubmenu.length )
			{
				// hlavní menu zpět
				TweenMax.to( app.$visible.find('.header .inner'), .5, {
					top: 0,
					overwrite: true,
					ease: Quad.easeOut,
					onComplete: function(){
						this.oldSubmenu.remove();
						this.oldSubmenu = null;
					},
					onCompleteScope: this
				});
			}
		},

		changeLinks: function(context)
		{
			var treeArr = this.getTreeFromPage( this.currentPage );
			var selector = 'a[href="'+  treeArr.join('"], a[href="')   +'"]';

			this.activeLinks && this.activeLinks.not(selector).removeClass('active').parent('li').removeClass('active-parent');
			this.activeLinks = $( selector );
			this.activeLinks.addClass('active').parent('li').addClass('active-parent');
		},

		getTreeFromPage: function( page )
		{
			var _this = this;
			var url = [page.url];

			var get = function( parent )
			{
				if(parent)
				{
					var page = _this.Ajaxify.getPage( parent );
					url.push( page.url );
					get( page.parent );
				}
				else
				{
					return;
				}
			};
			get(page.parent);

			_this = null;

			return url;
		},

		setContext: function()
		{
			if( this.isNewContext )
			{
				app.$holder.toggleClass('back');
				app.isBack = app.$holder.hasClass('back');
				app.$visible = app.isBack ? app.$back : app.$front;
				app.$hidden = app.isBack ? app.$front : app.$back;

				app.$visible.find('.main').css('opacity', 1);

				this.oldSubmenu = app.$visible.find('.header .menu-subpage');
				//this.currentContent = app.$visible.find('.main > *:last');
			}
		},

		loadingStart: function()
		{
			app.Loader.stop();
			app.Loader.restart();

			if(!this.isCached)
			{
				app.Loader.show();

				this.loadingTick();
			}
		},

		loadingTick: function()
		{
			// Časovač který přičítá 10% aby se uživateli zdálo že se něco děje
			this.loaderTimer = clearInterval( this.loaderTimer );
			this.loaderTimer = setInterval(function()
			{
				if(app.Loader.loadObj.prc < 50)
				{
					app.Loader.change( app.Loader.loadObj.prc + 5 );
				}
				else
				{
					this.loaderTimer = clearInterval( this.loaderTimer );
				}

			}, 750);
		},

		loadingAjax: function()
		{
			if(!this.isCached)
			{
				// Resetnu časovač
				this.loaderTimer = clearInterval( this.loaderTimer );
				// Pokud je aktuální načtení menší než 50% tak po ajaxu nastavím 50%
				( app.Loader.loadObj.prc < 50 ) && app.Loader.change( 50 );
			}
		},

		loadingImages: function()
		{
			if(!this.isCached)
			{
				this.loaderTimer = clearInterval( this.loaderTimer );
			}
			// Načítám obrázky
			app.Loader.$loadElement = this.currentContent;
			app.Loader.loadingImages();
		},

		loadingEnd: function()
		{
			this.loaderTimer = clearInterval( this.loaderTimer );
			// Načítám obrázky
			app.Loader.hide();
		}
	};

})(sk, App, jQuery);