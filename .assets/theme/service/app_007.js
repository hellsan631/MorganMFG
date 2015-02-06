(function(sk, app, $){

	app.widgets = app.widgets || {};

	app.widgets.Slideshow = function(element, options)
	{
		this.options = $.extend(true, {
			current: 0,
			slides: '.item',
			// timeout po které se automatiky přepne na další krok. 0 znamená že se automaticky neposunuje
			timeout: 0
		}, options);

		this.$W = $(window);
		this.$element = element.jquery ? element : $( element );
		this.$slides = this.$element.find( this.options.slides );

		this.Pager = this.options.Pager;

		this.current = this.options.current
		this.$currentSlide = this.$slides.eq(this.current);
	};

	app.widgets.Slideshow.create = function(element, options)
	{
		var pagerOptions = options.Pager;
		delete options.Pager;

		return new app.widgets.Slideshow(element, $.extend({
			'Pager': new sk.widgets.Pager( $.extend({
				infinite: true
			}, pagerOptions) )
		}, options) )
	};

	// prototype
	var _fn = app.widgets.Slideshow.prototype;


	_fn.init = function()
	{
		if( this.$slides.length < 2 || this.Pager == null )
		{
			return this;
		}

		this.Pager.max = this.Pager.options.max = this.$slides.length - 1;
	    this.Pager.init();

	    $(this.Pager)
	    	.on('change', $.proxy(this.handlePagerChange, this));

	    this.$W
	    	.on('resize', $.proxy(this.handleResize, this));

	    $(this)
	    	.trigger('afterinit')

	    this.$slides
	    	.css({'position':'absolute', 'left': '0', 'top': '0', 'z-index': '2'})
	    	.not( this.$currentSlide )
	    		.hide();

	    this.resetInterval();

	    return this;
	};

	_fn.destroy = function()
	{
		this.Pager.destroy();

      	$(this.Pager)
      		.off('change', this.handlePagerChange);
	};

	_fn.changeTo = function( index, toBottom )
	{
		if(this.current !== index)
		{
			this.clearInterval();

			this.before = this.current;
			this.current = index;

			this.$beforeSlide = this.$slides.eq(this.before);
			this.$currentSlide = this.$slides.eq(index);

			this.$currentSlide.css({
				'z-index': '2',
				'display': 'block',
			});

			this.$beforeSlide.css({
				'z-index': '5',
				'display': 'block',
			});

			$(this).trigger('beforechange')

			// jump to end now
			app.Animation.slideshowTimeline && app.Animation.slideshowTimeline.seek( app.Animation.slideshowTimeline.duration() );

			// new anim
			app.Animation.slideshow({
				elementOut: this.$beforeSlide,
				elementIn: this.$currentSlide ,
				onComplete: $.proxy(function()
				{
					this.resetInterval();

					$(this).trigger('afterchange')

				}, this)
			});
		}
	}

	_fn.handlePagerChange = function(event, obj)
	{
		this.changeTo( obj.current, obj.next );
	};

	_fn.handleResize = function()
	{
		// jump to end now
		if( app.Animation.slideshowTimeline )
		{
			app.Animation.slideshowTimeline.kill();
			// reset
			this.$slides.not( this.$currentSlide ).hide().css('position', '');
			TweenMax.set( this.$currentSlide, { scale: 1, opacity: 1, y:0 } );
			// trigger change
			$(this).trigger('afterchange');

			// reset
			app.$body.removeClass('is-animation');
			app.Animation.slideshowTimeline = null;
		}

		this.resetInterval();
	};

	// timery
	_fn.interval = function()
	{
		this.Pager.next();
	};

	_fn.clearInterval = function()
	{
		this.mainTimer = clearTimeout(this.mainTimer);
	};
	_fn.resetInterval = function()
	{
		if(this.options.timeout)
		{
			this.mainTimer = clearTimeout(this.mainTimer);
			this.mainTimer = setTimeout($.proxy(function(){this.interval()}, this), this.options.timeout);
		}
	};

})(sk, App, jQuery);