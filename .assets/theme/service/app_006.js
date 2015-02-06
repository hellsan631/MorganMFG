(function(sk, app, $){

		app.Loader = {
			util: new sk.utils.Loader()
		};
		app.Loader.$element = $('#page-loader');
		app.Loader.$text = app.Loader.$element.find('.status');
		app.Loader.$progress = app.Loader.$element.find('.circle');
		app.Loader.$logo = app.Loader.$element.find('.logo-status').get(0);
		app.Loader.Countdown = new sk.widgets.CountdownCircle( $('<span />').appendTo( app.Loader.$progress ), {time: 0} ).init();
		app.Loader.tween = null;
		app.Loader.imgLoad = null;
		app.Loader.isFirstLoad = app.Loader.$element.hasClass('loader-main');
		app.Loader.restart = function()
		{
			this.$element.appendTo( app.$visible );
			this.$text.text( 0 );
			this.Countdown.barReset( );
			this.loadObj = {
				prc: 0
			};
		}
		app.Loader.change = function(prc)
		{
			this.tween = TweenMax.to(this.loadObj, (app.Loader.isFirstLoad ? 1 : 0.4), {
				prc: prc,
				//ease:Expo.easeOut,
				overwrite: true,
				onComplete: prc >= 100 ? this.complete : null,
				onCompleteScope: this,
				onUpdate: this.update,
				onUpdateScope: this,
				ease: Linear.easeNone
			})
		}
		app.Loader.update = function()
		{
			if(!this.isFirstLoad)
			{
				this.$text.text( Math.round( this.loadObj.prc ) );
				this.Countdown.barTick( this.loadObj.prc );
			}
			else
			{
				app.Loader.$logo.style.width = this.loadObj.prc + '%';
			}
		}
		app.Loader.complete = function()
		{
			this.$loadElement.trigger('afterload');
			this.tween = null;
			this.imgLoad = null;
		}

		app.Loader.loadingImages = function( prcMax )
		{
			var _this = this;
			this.tween && this.tween.kill();
			var currentPrc = Math.round( this.loadObj.prc );
			var prcMax = 100 - currentPrc;


			// označit obrázky z galerie které nebudeme stahovat
			this.$loadElement.find('.crossroad-services .scroll .item:nth-child(n+3)').find('img, .bg').addClass('no-load');
			this.$loadElement.find('.box-gallery .scroll .item.item:nth-child(n+3)').find('img, .bg').addClass('no-load');

			// responsive images, neresponsivovat nenačtené obrázky z galerie
			app.Images.replace( this.$loadElement, '.responsive:not(.no-load)' );

			// load
			this.imgLoad = this.util.load(
				this.util.getImages( this.$loadElement,
				{
					'selector': '*:not(iframe, object, embed, script, style, .no-load)'
				})
			);

			var fn = function(obj)
			{
				var tested = obj.tested || 1;
				var length = obj.length || 1;
				var prc = Math.round( prcMax / length * tested );
				_this.change( currentPrc + prc );
			}

			this.imgLoad.dfr
				.progress(fn)
				.done(fn);
		};

		app.Loader.show = function()
		{
			TweenMax.to( this.$element, 1, { autoAlpha: 1, overwrite: true })
		}

		app.Loader.hide = function()
		{
			TweenMax.to( this.$element, 1.15, {
				autoAlpha: 0,
				overwrite: true,
				ease: Cubic.easeIn,
				onComplete: function()
				{
					if( this.isFirstLoad )
					{
						this.isFirstLoad = false;
						this.$element.removeClass('loader-main');

						// second load no ajax browser
						if(!Modernizr.history)
						{
							var date = new Date();
							var minutes = 10;
							date.setTime( date.getTime() + (minutes * 60 * 1000) );
							$.cookie( "secondLoad", "true", { expires: date } );
						}
					}
				},
				onCompleteScope: this,
			})
		}

		app.Loader.stop = function()
		{
			this.tween && this.tween.kill();
			this.imgLoad && this.imgLoad.abort();
		}

})(sk, App, jQuery);