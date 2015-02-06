(function(sk, app, $){

	app.widgets = app.widgets || {};

	app.widgets.Sections = function(element, options)
	{
		var options = $.extend(true, {
			sectionSelector: '.page',
			// app custom
			'startOpacity': .5,
			'startRotate': 20 //deg
		}, options)

		sk.widgets.SectionFull.call(this, element, options);
	};

	app.widgets.Sections.create = function(element, options)
	{
		var scrollOptions = options.Scroll;
		delete options.Scroll;

		var pagerOptions = options.Pager;
		delete options.Pager;

		return new app.widgets.Sections(element, $.extend({
			// scroll
			'Scroll': new sk.widgets.SectionScroll( element, $.extend({

			}, scrollOptions) ),
			// pager
			'Pager': new sk.widgets.Pager( $.extend({
				infinite: false,
				pagerMaskString: '<strong>{$active}</strong>/{$all}'
			}, pagerOptions) )

		}, options) )
	};

	// extend
	sk.extend(app.widgets.Sections, sk.widgets.SectionFull);

	// prototype
	var _fn = app.widgets.Sections.prototype;
	var _super = app.widgets.Sections._super;


	_fn.init = function()
	{
		_super.init.call(this);

		// this.$element
		// 	.on('scroll', $.proxy(this.handleScroll, this))
		// 	.trigger('scroll');
/*
		$(this)
			.on('beforechange', function(event)
			{
				app.$body.addClass('is-animation');
			})
			.on('afterchange', function(event)
			{
				app.$body.removeClass('is-animation');
			});*/
	};

	_fn.destroy = function()
	{
		_super.destroy.call(this);

		// this.$element
		// 	.off('scroll', this.handleScroll);
	};

	_fn.handleScroll = function(event)
	{
		var top = this.$element.scrollTop();
		var index = Math.ceil( top / this.height );

		// var r = 20 / 100 * 60
		// var o = 0.5 / 100 * 60

		if( index < 0 )
		{
			this.$sections.slice(1).css({'transform': 'perspective(1000px) rotateX(-20deg)', 'opacity': .5 });
		}
		else
		{
			var sectionTop = ( top - ( this.height * ( index - 1) ) );
			var rotate = 20 - 20 / this.height * sectionTop;
			var opacity = 0.5 + 0.5 / this.height * sectionTop;

			this.$sections.slice(0, index).css({'transform':'perspective(1000px) rotateX(0deg)', 'opacity': 1});
			this.$sections.eq(index).css({'transform':'perspective(1000px) rotateX('+ (-rotate) +'deg)', 'opacity': opacity});
		}
	};



})(sk, App, jQuery);