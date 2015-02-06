(function(sk, app, $){

	// var width = app.$visible.width();
	// var height = app.$visible.height();

	// $(window)
	// 	.on('resize', function(event)
	// 	{
	// 		var width = app.$visible.width();
	// 		var height = app.$visible.height();
	// 	});

	app.Animation = {

		busy: false,
		fade: function(options)
		{
			var _this = this
			_this.busy = true;

			var tl = new TimelineMax({
				onComplete: function()
				{
					options.onComplete && options.onComplete();
					_this.busy = false;
					app.$body.removeClass('is-animation');
				}
			});

			app.$body.addClass('is-animation');

			if( options.dir === 'in' )
			{
				tl
					.set( options.elementIn, { opacity: 0, position: 'absolute', left: 0, top:0, zIndex: 2 } )
					.set( options.elementOut, { zIndex: 1 } )
					.to( options.elementOut, .5, { scale: .9, opacity: .9 })
					.to( options.elementIn, 1.5, { opacity: 1, force3D: true } )
			}
			else
			{
				tl
					.set( options.elementOut, { opacity: 1, position: 'absolute', left: 0, top:0, zIndex: 2 } )
					.set( options.elementIn, { scale: .9, opacity: .9, zIndex: 1 } )
					.to( options.elementOut, 1.5, { opacity: 0, force3D: true } )
					.to( options.elementIn, .5, { scale: 1, opacity: 1, delay: -.5 })
			}

		},
		slideTimeline: null,
		slide: function(options)
		{
			var _this = this
			_this.busy = true;

			var dir = options.dir === 'bottom' || options.dir === 'right' ? -1 : 1;
			var prop;
			var val;
			var animInBefore = {};
			var animInAfter = {};
			var animOut = {};

			if( options.dir === 'top' || options.dir === 'bottom' )
			{
				prop = 'y';
				val = 'height';
			}
			else
			{
				prop = 'x';
				val = 'width';
			}

			val = options.elementIn.parent()[val]();

			animOut[prop] = val * dir;
			animInBefore[prop] = val  * dir * (-1);
			animInAfter[prop] = 0;

			_this.slideTimeline = new TimelineMax({
				onComplete: function()
				{
					options.onComplete && options.onComplete();
					options.elementOut.hide().css('position', '');
					options.elementIn.css('position', '');
					_this.busy = false;
					_this.slideTimeline = null;

					app.$body.removeClass('is-animation');
				}
			});

			app.$body.addClass('is-animation');

			_this.slideTimeline
				.set( options.elementIn, $.extend({ scale: .9, position: 'absolute', display: 'block', left: 0, top:0, opacity: .9 }, animInBefore ) )
				.to( options.elementOut, .5, { scale: .9, opacity: .9 })
				.to( options.elementOut, 1, animOut )
				.to( options.elementIn, 1, $.extend({ delay: -1 }, animInAfter ) )
				.to( options.elementIn, .5, { scale: 1, opacity: 1 } )
		},
		slideshowTimeline: null,
		slideshow: function(options)
		{
			var _this = this
			_this.busy = true;

			_this.slideshowTimeline = new TimelineMax({
				onComplete: function()
				{
					options.onComplete && options.onComplete();
					options.elementOut.hide();
					_this.busy = false;
					_this.slideshowTimeline = null;

					app.$body.removeClass('is-animation');
				}
			});

			app.$body.addClass('is-animation');


			_this.slideshowTimeline
				.set( options.elementIn, { y:0} )
				.set( options.elementOut, { y:0} )
				.to( options.elementOut, 1, { y: -options.elementIn.parent().height() } )
		}
	};



})(sk, App, jQuery);