(function($)
{
	var sk = window.sk = {
		mediator: $({}),
		base: {},
		utils: {},
		widgets: {},
		events: {}
	};

	sk.extend = function(child, parent) {
		var F = function(){};
		F.prototype = parent.prototype;
		child.prototype = new F();
		child._super =  parent.prototype;
		child.prototype.constructor = child;
	};

})(jQuery);

(function() {
  var __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  sk.widgets.SectionFull = (function() {
    function SectionFull(element, options) {
      this.handleResize = __bind(this.handleResize, this);
      this.handlePagerChange = __bind(this.handlePagerChange, this);
      this.handleScrollCancel = __bind(this.handleScrollCancel, this);
      this.handleScrollChange = __bind(this.handleScrollChange, this);
      this.setCurrent = __bind(this.setCurrent, this);
      this.$element = element.jquery ? element : $(element);
      this.options = $.extend(true, {
        current: 0,
        sectionSelector: '',
        durationScroll: .8,
        durationScrollCancel: .3,
        Scroll: null,
        Pager: null
      }, options);
      this.$sections = this.$element.find(this.options.sectionSelector);
      this.Pager = this.options.Pager;
      this.Scroll = this.options.Scroll;
      this.$win = $(window);
      this.oldIndex = this.currentIndex = this.options.current;
      this.lockTimer = null;
    }

    SectionFull.prototype.init = function() {
      var o;
      if (!this.$element.length || !this.$sections.length || (this.Pager == null)) {
        return this;
      }
      o = this.options;
      this.setCurrent();
      this.Pager.current = this.Pager.options.current = this.currentIndex;
      this.Pager.max = this.Pager.options.max = this.$sections.length - 1;
      this.Pager.init();
      $(this.Pager).on('change', this.handlePagerChange);
      if (this.Scroll != null) {
        this.Scroll.init();
        $(this.Scroll).on('scrollup', this.handleScrollChange).on('scrolldown', this.handleScrollChange).on('scrollcancel', this.handleScrollCancel);
      }
      this.$win.on('resize', this.handleResize);
      $(this).trigger('afterinit');
      return this;
    };

    SectionFull.prototype.destroy = function() {
      this.Pager.destroy();
      $(this.Pager).off('change', this.handlePagerChange);
      if (this.Scroll != null) {
        this.Scroll.destroy();
        $(this.Scroll).off('scrollup', this.handleScrollChange).off('scrolldown', this.handleScrollChange).off('scrollcancel', this.handleScrollCancel);
      }
      this.$win.off('resize', this.handleResize);
      return this;
    };

    SectionFull.prototype.setCurrent = function() {
      return this.$element.scrollTop(this.$sections.eq(this.currentIndex)[0].offsetTop);
    };

    SectionFull.prototype.handleScrollChange = function(event) {
      return this.Pager.page(this.currentIndex + (event.type === 'scrollup' ? -1 : 1));
    };

    SectionFull.prototype.handleScrollCancel = function() {
      return this.scrollTo(this.Pager.current, this.options.durationScrollCancel);
    };

    SectionFull.prototype.handlePagerChange = function() {
      return this.scrollTo(this.Pager.current);
    };

    SectionFull.prototype.handleResize = function() {
      var _ref, _ref1;
      if ((_ref = this.Scroll) != null) {
        _ref.lock(true);
      }
      this.setCurrent();
      return (_ref1 = this.Scroll) != null ? _ref1.lock(false) : void 0;
    };

    SectionFull.prototype.scrollTo = function(index, duration) {
      var y, _ref,
        _this = this;
      this.oldIndex = this.currentIndex;
      this.currentIndex = index;
      y = this.$sections.eq(this.currentIndex)[0].offsetTop;
      this.lockTimer = clearTimeout(this.lockTimer);
      if ((_ref = this.Scroll) != null) {
        _ref.lock(true);
      }
      if (this.oldIndex !== this.currentIndex) {
        $(this).trigger('beforechange');
      }
      return TweenLite.to(this.$element, duration || this.options.durationScroll, {
        scrollTo: y,
        ease: Expo.easeOut,
        overwrite: true,
        onComplete: function() {
          if (_this.oldIndex !== _this.currentIndex) {
            $(_this).trigger('afterchange');
          }
          _this.lockTimer = setTimeout(function() {
            var _ref1;
            return (_ref1 = _this.Scroll) != null ? _ref1.lock(false) : void 0;
          }, 200);
          return _this.anim = null;
        }
      });
    };

    return SectionFull;

  })();

  sk.widgets.SectionScroll = (function() {
    function SectionScroll(element, options) {
      this.handleMouseup = __bind(this.handleMouseup, this);
      this.handleMousemove = __bind(this.handleMousemove, this);
      this.handleMousedown = __bind(this.handleMousedown, this);
      this.handleTouch = __bind(this.handleTouch, this);
      this.handleMousewheel = __bind(this.handleMousewheel, this);
      this.$element = element.jquery ? element : $(element);
      this.options = $.extend({
        minDelta: 50,
        scrollbarTimerDelay: 0,
        mousewheelTimerDelay: 200
      }, options);
      this.oldTop = 0;
      this.top = 0;
      this.delta = 0;
      this.mousewheelTimer = false;
      this.scrollbarTimer = false;
      this.isLocked = false;
      this.$doc = $(document);
    }

    SectionScroll.prototype.init = function() {
      var o;
      if (!this.$element.length) {
        return this;
      }
      o = this.options;
      this.$element.on('mousewheel scroll', this.handleMousewheel).on('mousedown', this.handleMousedown).on('touchstart touchmove', this.handleTouch);
      return this;
    };

    SectionScroll.prototype.destroy = function() {
      this.$element.off('mousewheel scroll', this.handleMousewheel).off('mousedown', this.handleMousedown).off('touchstart touchmove', this.handleTouch);
      return this;
    };

    SectionScroll.prototype.handleMousewheel = function(event) {
      var _this = this;
      if (!this.isLocked) {
        this.top = this.$element.scrollTop();
        if (!this.scrollTimer) {
          this.delta = 0;
          this.oldTop = this.top;
        } else {
          this.scrollTimer = clearTimeout(this.scrollTimer);
        }
        this.delta = this.top - this.oldTop;
        if (Math.abs(this.delta) >= this.options.minDelta) {
          event.preventDefault();
          this.checkScroll();
          this.scrollTimer = clearTimeout(this.scrollTimer);
          return this.scrollTimer = false;
        } else {
          return this.scrollTimer = setTimeout(function() {
            _this.delta = _this.$element.scrollTop() - _this.oldTop;
            _this.checkScroll();
            return _this.scrollTimer = false;
          }, this.options.mousewheelTimerDelay);
        }
      } else {
        return event.preventDefault();
      }
    };

    SectionScroll.prototype.handleTouch = function(event) {
      if (this.isLocked) {
        return event.preventDefault();
      }
    };

    SectionScroll.prototype.handleMousedown = function(event) {
      if (event.currentTarget === event.target) {
        this.oldTop = this.$element.scrollTop();
        return this.$doc.on('mousemove', this.handleMousemove).on('mouseup', this.handleMouseup);
      }
    };

    SectionScroll.prototype.handleMousemove = function(event) {
      var _this = this;
      return this.scrollbarTimer = setTimeout(function() {
        _this.top = _this.$element.scrollTop();
        if (_this.oldTop !== _this.top) {
          _this.lock(true);
          return _this.$doc.off('mousemove', _this.handleMousemove);
        }
      }, 0);
    };

    SectionScroll.prototype.handleMouseup = function(event) {
      this.top = this.$element.scrollTop();
      this.scrollbarTimer = clearTimeout(this.scrollbarTimer);
      this.$doc.off('mousemove', this.handleMousemove);
      this.$doc.off('mouseup', this.handleMouseup);
      this.delta = this.top - this.oldTop;
      this.lock(false);
      return this.checkScroll();
    };

    SectionScroll.prototype.checkScroll = function() {
      var e;
      if (this.delta) {
        e = 'scrollcancel';
        if (Math.abs(this.delta) >= this.options.minDelta) {
          e = this.delta >  0 ? 'scrolldown' : 'scrollup';
        }
        return $(this).trigger(e, {
          scrollTop: this.top
        });
      }
    };

    SectionScroll.prototype.lock = function(bool) {
      if (bool != null) {
        this.isLocked = bool;
      } else {
        this.isLocked = !this.isLocked;
      }
      return this;
    };

    return SectionScroll;

  })();

}).call(this);

(function(sk, $){

	/**
	 * @class Ajaxify
	 * @version 0.2
	 * @author <a href="mailto:michal.matuska@superkoderi.cz">Michal Matuška</a>
	 *
	 * závislost
	 *  - jquery
	 *  - history.js, https://github.com/browserstate/history.js
	 *  - jquery.form.js, https://github.com/malsup/form/ ( pro odesálání formulářů )
	 *
	 * todo
	 *	- otestovat a připravit ajaxify na formulář s file inputem
	 */
	sk.utils.Ajaxify = function(options)
	{
		this.options = $.extend({
			'pageTree': [],
			'linksSelector': '',
			'formsSelector': '',
			'ajaxData': {},
			'pushStateOnly': true
		}, options);

		this.$D = $(document);
	};

	// SHORTCUT
	var _fn = sk.utils.Ajaxify.prototype;

	_fn.init = function()
	{
		if( document.location.protocol === 'file:')
		{
			this.log('historie ani ajax nejede na file://. Spusť si server')
			return this;
		}

		if(History.enabled === false || ( this.options.pushStateOnly && History.emulated.pushState) )
		{
			this.log('historie v prohlížeči není povolena')
			return this;
		}

		if( !this.options.pageTree || !this.options.pageTree.length )
		{
			this.log('není předán strom url webu')
			return this;
		}


		this.initUrls()
		this.initState();

		// Aktualní stav
		this.oldState = this.state = History.getState();

		// Události
		this.options.linksSelector && this.$D.on('click', this.options.linksSelector, $.proxy(this.handleLinks, this) );
		this.options.formsSelector && this.$D.on('submit', this.options.formsSelector, $.proxy(this.handleForms, this) );

		// Sleduju změny
	    History.Adapter.bind(window,'statechange', $.proxy(function()
	    {
	    	var state = History.getState();
	    	state.data.ajaxify && this.setState(state)
	    }, this));

		return this;
	};

	_fn.initUrls = function()
	{
		this.pageUrls = {};
		this.prepareUrls( this.options.pageTree );
	};

	_fn.prepareUrls = function( arr, parent, topParent, level )
	{
		for (var i = 0, l = arr.length; i < l; i++)
		{
			var link = arr[i];
			var level = level || 0;
			var parent = parent || null;
			var topParent = level === 0 ? link.url : topParent;

			this.pageUrls[ link.url ] = $.extend({}, link, {
				level: level,
				index: i,
				parent: parent,
				topParent: topParent
			});

			if( link.children && link.children.length )
			{
				this.prepareUrls( link.children, link.url, topParent, level + 1 );
			}
		}
	};

	_fn.getPageNearest = function(url, level)
	{
		var url = url;
		var level = level || 1;
		var arr = url.split('/');
		arr.pop();

		if(arr.length < 3)
		{
			return false
		}

		url = arr.join('/');

		var page = this.pageUrls[ url ];

		if( typeof page === 'undefined')
		{
			return this.getPageNearest( url, level + 1 );
		}

		page = $.extend({}, page);
		page.level += level;

		return page;
	}

	_fn.getPage = function(url)
	{
		var page = this.pageUrls[ url ];

		if( typeof page === 'undefined' )
		{
			// console.log('get nearest')
			page = this.getPageNearest(url);
			// console.log(page)

			// Pokud jsem našel nejbližší stránku
			if(page)
			{
				page.parent = page.url;
				page.url = url;
				page.detail = true;

				// cache
				this.pageUrls[ url ] = page;
			}
		}

		return ( typeof page !== 'undefined' ) ? page : false;
	}

	_fn.setState = function(state)
	{
		this.oldState = this.state;
		this.state = state;

		this.oldPage = this.page;
		this.page = this.getPage( state.data.page );

		this.changeState();
	};

	_fn.getState = function()
	{
		return this.state;
	};

	_fn.initState = function()
	{
		var url = this.getUrl( location.href );
		var page = this.getPage( url.pathname );

		if( !page )
		{
			this.log('aktuální url není ve stromu stránek')
		}

		this.page = this.oldPage = page;

		return this;
	};

	_fn.pushState = function(state, title, href)
	{
		// událost a poslání objektu pro případnou modifikaci
		$(this).trigger('push.ajaxify', state);

		History.pushState(state, title, href);
	};

	_fn.changeState = function()
	{
		var $target = $( this.state.data.target );

		// zruším rozběhlý request
		this.ajax && this.ajax.abort();

		this.ajaxStart();

		if( $target.is('form') )
		{
			$target.ajaxSubmit({
				data: this.options.ajaxData,
				beforeSend: $.proxy(function(jqXHR)
				{
					this.ajax = jqXHR;
				}, this),
				success: $.proxy(this.ajaxDone, this),
				error: $.proxy(this.ajaxFail, this),
				complete: $.proxy(this.ajaxEnd, this)
			});
		}
		else
		{
			this.ajax = $.ajax(this.state.data.ajax)
				.done($.proxy(this.ajaxDone, this))
				.fail($.proxy(this.ajaxFail, this))
				.always($.proxy(this.ajaxEnd, this));
		}
	};

	_fn.ajaxDone = function()
	{
		$(this).trigger('done.ajaxify', arguments);
	};

	_fn.ajaxFail = function()
	{
		$(this).trigger('fail.ajaxify', arguments);
	};

	_fn.ajaxStart = function()
	{
		$(this).trigger('start.ajaxify');
	};

	_fn.ajaxEnd = function()
	{
		this.ajax = null;

		$(this).trigger('end.ajaxify');
	};

	_fn.handleLinks = function(event)
	{
		var $target = $(event.currentTarget);
		var url = this.getUrl( $target );
		var page = this.getPage( url.pathname );

		if( page && !page.noAjax )
		{
			event.preventDefault();

			if(this.page !== page)
			{
				var title = this.getTitle( page );
				var href = url.hrefAttr;

				var state = {
					ajaxify: true,
					page: url.pathname,
					target: this.getSelector(event.currentTarget),
					ajax: {
						url: url.href,
						type: url.type,
						data: this.options.ajaxData
					}
				};

				this.pushState( state, title, href );
			}
		}
	};

	_fn.handleForms = function(event)
	{
		event.preventDefault();

		var $target = $(event.currentTarget);
		var url = this.getUrl( $target.prop('action') );

		console.log( $target.prop('action')  )

		this.setState({
			data: {
				ajaxify: true,
				page: url.pathname,
				target: this.getSelector(event.currentTarget)
			}
		});
	};

	_fn.getUrl = function( $element )
	{
		var created = false;
		var $a = $element;
		var url = {
			type: 'GET'
		};

		if( $.type( $a ) === 'string' )
		{
			created = true
			$a = $('<a href="'+ $element +'" />');
		}

		// pokud je element form vytvořím si a pro parsování vlastností
		// if( $element.is('form') )
		// {
		// 	created = true;
		// 	$a = $('<a href="'+ $element.attr('action') +'" />');
		// 	url.type = $element.prop('method').toUpperCase();
		// }

		// získám údaje
		url.host = $a.prop('host');
		url.hostname = $a.prop('hostname');
		url.href = $a.prop('href');
		url.hrefAttr = $a.attr('href');
		url.pathname = $a.prop('pathname');
		url.search = $a.prop('search');

		// smažu vytvořený
		created && $a.remove();

		return url;
	};

	_fn.getTitle = function( page )
	{
		return page.title || document.title;
	};

	_fn.getSelector = function(el)
	{
	     var tag, index, stack = [];

		for (; el.parentNode; el = el.parentNode) {
		tag = el.tagName;

		for (index = 0; el.previousSibling;) {
		el = el.previousSibling;
		if (tag == el.tagName)
		index += 1;
		}

		stack.unshift(tag + ':eq(' + index + ')');
		}

		return stack.join(' > ');
	}

	_fn.log = function(msg)
	{
		console && console.log && console.log(msg);
	};


})(sk, jQuery);
(function(sk, $){

	/**
	 * @class Loader
	 * @version 0.2b
	 * @author <a href="mailto:michal.matuska@superkoderi.cz">Michal Matuška</a>
	 */
	sk.utils.Loader = function()
	{
		this.cache = {};
		this.dimensions = false;
	};

	// SHORTCUT
	var _fn = sk.utils.Loader.prototype;

	/**
	*	@public
	*	@param {String}
	*	@return {jQuery.Deferred}
	*/
	_fn.loadItem = function(item)
	{

		var _this = this;
		var dfr = $.Deferred();

		var i = $('<img />')
			.on('load', function()
			{
				if(_this.dimensions)
				{
					_this.setCache(item, {
						'width': this.width,
						'height': this.height
					});


				}

				_this = null;

				dfr.resolve()
			})
			.on('error', function()
			{
				dfr.reject()
			})
			.attr('src', item);


		return dfr.promise();
	};

	/**
	*	@public
	*	@param {String []}
	*/
	_fn.load = function(arr)
	{
		var length = arr.length;
		var tested = 0;
		var loaded = 0;
		var error = 0;
		var dfr = $.Deferred();

		for(var i = 0; i < length; i++)
		{
			var item = arr[i];
			// if( !this.hasCache(item) )
			// {
			// 	this.setCache(item);

				(function(that, item){
					$
						.when( that.loadItem(item) )
						.done(function()
						{
							loaded++;
							tested++;
						})
						.fail(function()
						{
							error++;
							tested++;
						})
						.always(function()
						{
							if(length !== tested )
							{
								dfr.notify({length: length, tested: tested});
							}
							else
							{
								dfr.resolve({length: length, tested: tested});
							}
						})
				})(this, item);
			// }
			// else
			// {
			// 	loaded++;
			// 	tested++;

			// 	if(length !== tested )
			// 	{
			// 		dfr.notify({length: length, tested: tested});
			// 	}
			// 	else
			// 	{
			// 		dfr.resolve({length: length, tested: tested});
			// 	}
			// }
		}

		var isLoaded = length === tested;

		if(!length)
		{
			dfr.resolve({length: length, tested: tested});
		}

		return {
			done: isLoaded,
			length: length,
			tested: tested,
			dfr: dfr,
			abort: $.proxy( function()
			{
				if( dfr.state() === 'pending' )
				{
					dfr.reject();
					this.loadStop();
				}
			}, this)
		};
	};

	_fn.getImages = function(element, options)
	{
		var arr = [];
		var $element = element.jquery ? element : $( element );

		var options = $.extend({
			'selector': '*:not(iframe, object, embed, script, style)'
		}, options);

		selector = options.selector;

		$element
			.find(selector)
			.each(function(index, el)
			{
				if(this.nodeName.toLowerCase() === 'img')
				{
					var url = $(this).attr('src');

					if(url)
					{
						arr.push(url);
					}

					return
				}
				else
				{
					var bgImg = $(this).css('background-image');

					if( bgImg.search('url') > -1 )
					{
						var temp = bgImg.replace(/url\((?:'|")?(.*?)(?:'|")?\)/g, '$1').split(/,\s?/);
						arr = arr.concat(temp)
					}
				}
			});

		return arr;
	};

	_fn.loadStop = function()
	{
		if (window.stop !== undefined)
		{
			window.stop();
		}
		else if (document.execCommand !== undefined)
		{
			document.execCommand("Stop", false);
		}
	};

	/**
	*	@public
	*	@param {String} Klíč který chceme cachovat
	*/
	_fn.setCache = function(item, obj)
	{
		this.cache[item] = obj || true;
	};

	/**
	*	@public
	*	@param {String} Klíč k hodnotě v cache
	*	@return {Boolean}
	*/
	_fn.hasCache = function(item)
	{
		return typeof( this.cache[item] ) !== 'undefined' ;
	};

})(sk, jQuery);
(function(sk, $){

    /*
        Vytvořil:
        12.06.2012 | Michal Matuška

        Změny:
        -

        Opravené bugy:
        -

        Vyžaduje:
        - jquery

        Popis
        -

    */

    sk.utils.MediaQueries = function(options)
    {
        this.options = $.extend({
            'selector': '#mq',
            'property': 'left',
            'timer': 150,
            'queries': {}
        }, options);

        return this;
    }

    // PROTOTYPE
    var _fn = sk.utils.MediaQueries.prototype;

    _fn.init = function()
    {
        var o = this.options;

        this.$w = $(window);
        this.selector =  o.selector.jquery ? o.selector : $(o.selector);
        this.property = o.property;
        this.queries =o.queries;
        this.state = null;
        this.params = null;
        this.timer = null;

        this.$w
            .on('resize.MediaQueries', $.proxy(this.check, this))
            .trigger('resize');



        return this;
    };

    _fn.destroy = function()
    {
        this.$w
            .off('.MediaQueries');

        return this;
    };

     _fn.check = function()
    {
        if (!this.timer)
        {


            var that = this;
            var fn = function()
            {

                var prop = that.selector.css(that.property);
                var un;
                var query = that.queries[prop];

                if(query !== un)
                {
                    if(that.state === query.state)
                    {
                        var e = $.Event('resizeMedia', { state: this.state, params: query.params });
                        $(that).trigger(e);
                    }
                    else
                    {
                        var e = $.Event('changeMedia', { state: query.state, fromState: that.state, params: query.params});
                        that.state = query.state;
                        that.params = query.params;
                        $(that).trigger(e);
                    }

                }

                that.timer = null;
            }

            if(this.state === null)
            {
                fn()
            }
            else
            {
                this.timer = setTimeout(function(){ fn() }, this.options.timer);
            }

        }
    };


})(sk, jQuery);




(function(sk, $){

	/*
		Widget Carousel
		version 3

		Created:
		14.02.2012 | Michal Matuška (michal.matuska@superkoderi.cz)

		Updates:
		-

		Fixed bugs:
		-
	*/

	sk.widgets.Carousel = function (element, options)
	{
		this.$element = element.jquery ? element : $(element);
		this.options = $.extend({
			// elementy ktere se budou scrollovat
			item: '>*',
			 // počet elementů k které se bude posouvat
			scroll: 1,
			// aktuální krok
			position: 0,
			// fullscreen režim, bude scrollovat o procenta
			fullscreen: true,
			// skok na začátek
			repeat: false,
			// nekonečné scrollování
			infinite: false,
			// čas za který se provede animace kroku. 0 vypne animaci a bude jen přepínat
			animation: 500,
			// efekt animace
			easing: Linear.easeNone,
			// osa
			axis: 'x', // x, y
			// ovládací prvek pro předchozí
			pagerPrev: null,
			// ovládací prvek pro další
			pagerNext: null,
			// vygenerovat menu pro kroky
			pagerPages: null,
			// maska kroků
			pagerMask: null,
			pagerMaskString: '{$active}/{$all}', // {$active} = aktivní položka, {$all} = celkový počet
			// timeout po které se automatiky přepne na další krok. 0 znamená že se automaticky neposunuje
			timeout: 0,
			// callback
			onChange: null,
			// offset
			offset: 0,
			// prázdnej element pro doplnění kroku
			emptyHolder: '<li class="empty"></li>'
		}, options);

		this.axProps = this.options.axis == 'x' ?
			{
				left: 'left',
				width: 'width',
				outerWidth: 'outerWidth',
				scrollWidth: 'scrollWidth',
				scrollLeft: 'scrollLeft',
				offset: 'offsetLeft'
			} :
			{
				left: 'top',
				width: 'height',
				outerWidth: 'outerHeight',
				scrollWidth: 'scrollHeight',
				scrollLeft: 'scrollTop',
				offset: 'offsetTop'
			};

		this.position = this.options.position;

		this.pager = null;

		return this;
	};

	// SHORTCUT
	//-

	// PROTOTYPE
	var _fn = sk.widgets.Carousel.prototype;


	_fn.init = function()
	{
		if(!this.$element.length )
		{
			return this;
		}

		var o = this.options;

		this.size = this.$element[this.axProps.width]() || 0;
		this.sizeScroll = this.$element.prop(this.axProps.scrollWidth) || 0;
		this.delta = this.sizeScroll - this.size;

		this.$holder = this.$element[this.axProps.scrollLeft](0).wrap('<div class="sk-carousel sk-carousel-'+o.axis+'"></div>').parent();
		this.$originalItems = this.$items = this.$element.find(o.item);

		this.infinite = o.infinite;
		this.clonedCount = 0;
		if(this.infinite)
		{
			this.clonedCount = this.createInfinite();
			this.$items = this.$element.find(o.item);


		}

		this.length = this.$items.length;

		this.repeat = o.repeat;
		this.scroll = this.getScroll();
		this.steps = this.getSteps();
		this.min = 0;
		this.max = this.steps.length - this.clonedCount * 2 - 1;

		this.animated = o.animation ? true : false;
		this.mainTimer = null;
		// přepnutí událostí
		this.handled = false;

		if( typeof sk.widgets.Pager !== 'undefined' )
		{
			// pager
			this.pager = new sk.widgets.Pager({
				current: this.position,
				max: this.max,
				infinite: this.repeat || this.infinite,
				pagerPrev: o.pagerPrev,
				pagerNext: o.pagerNext,
				pagerPages: o.pagerPages,
				pagerMask: o.pagerMask,
				pagerMaskString: o.pagerMaskString
			})
			this.pager.init();

			$(this.pager)
				.on('change', $.proxy(function(e, obj)
				{
					this.clearInterval();
					this.handled = true;
					if(obj.prev) var pos = this.infinite ? (this.position - 1) : obj.current;
					if(obj.next) var pos = this.infinite ? (this.position + 1) : obj.current;
					if(obj.page) var pos = obj.current;
					this.setPosition(pos, this.animated);
				}, this));
		}


		if(this.max)
		{
			this.setPosition(this.position, false, true);
			this.isInit = true;

			// callback
			typeof o.onStart == 'function' && o.onStart.call(this, {position: this.position, handled: this.handled});
		}

		return this;
	};

	_fn.destroy = function()
	{
		var o = this.options;

		// odstraní holder
		this.$element.css(this.axProps.left, '').unwrap();
		this.$holder = null;
		delete this.$holder;

		// odstraní itemy
		this.$items = null;
		delete this.$items;
		delete this.length;

		this.pager && this.pager.destroy();

		// timer
		if(o.timeout)
		{
			this.clearInterval();
			delete this.mainTimer;
		}

		this.isInit = false;

		return this;
	};

	_fn.setPosition = function(pos, animate, init, animCall)
	{
		var o = this.options;
		this.anim && this.anim.kill()

		if(this.infinite)
		{
			var pos = pos;
		}
		else{
			var pos = (pos > this.max) ? this.max :	(pos < this.min) ? this.min : pos;
		}

		if(this.position != pos || init || animCall)
		{


			var params = {};
			params[this.axProps.left] = this.steps[pos + this.clonedCount];

			if(animate)
			{
				this.anim = TweenMax.to( this.$element, o.animation / 1000, $.extend(params, {
					ease: o.easing,
					force3D:true,
					overwrite: true,
					onComplete: function(){
						this.setPosition(pos, false, false, true);
						this.anim = null;
					},
					onCompleteScope: this
				}))
				//this.$element.css('-webkit-transform', 'translate3d('+ scroll +',0,0)');
			}
			else
			{
				//this.$element.css('-webkit-transform', 'translate3d('+ scroll +',0,0)');
				this.$element.css(params);
				this.resetInterval();
			}

			if(!animCall)
			{
				// převrátit pozice pokud je opakovaní
				if(this.infinite)
				{
					pos = (pos < this.min) ? this.max : (pos > this.max) ? this.min : pos;
				}
				this.position = pos;

				if(!this.handled && this.pager)
				{
					this.pager.current = pos;
					this.pager.check();
				}
			}


			if(!init && !animCall)
			{
				// callback
				typeof o.onChange == 'function' && o.onChange.call(this, {position: pos, handled: this.handled});
			}
		}

		this.handled = false;
	};

	_fn.getPosition = function()
	{
		return this.position;
	};

	_fn.getSteps = function()
	{
		var arr = [];
		var o = this.options;

		var prop = this.axProps.left;
		var delta = this.delta;
		var length = this.$items.length;

		for (var i = 0; i < length; i=i+this.scroll)
		{
			if(o.fullscreen)
			{
				var scroll = ( i * -100 ) + '%';
				arr.push(scroll);
			}
			else
			{
				var scroll = -Math.round( this.$items.eq(i).position()[prop] ) - ( (i == 0) ? 0 : o.offset);

				if(scroll <= -delta)
				{
					scroll = -delta;
					arr.push(scroll);
					break;
				}

				arr.push(scroll);
			}
		};

		return arr;
	};

	_fn.getScroll = function()
	{
		var o = this.options;

		if(o.fullscreen)
		{
			return 1;
		}

		return o.scroll > this.length - 1  ? this.length : o.scroll;
	};

	// vytvoření nekonečného carouselu
	_fn.createInfinite = function()
	{
		var o = this.options;

		if(o.fullscreen)
		{
			var $cloneFirst = this.$items.first().clone(true).addClass('clone').removeAttr('id').data('sk-carousel-clone', 0);
			var $cloneLast = this.$items.last().clone(true).addClass('clone').removeAttr('id').data('sk-carousel-clone', this.length-1);

			this.$element.append($cloneFirst).prepend($cloneLast);

			return 1;
		}

		// todo infinite carousel
		return 0;
	};

	// timery
	_fn.interval = function()
	{
		this.pager && this.pager.next();
	};

	_fn.clearInterval = function()
	{
		this.mainTimer = clearTimeout(this.mainTimer);
	};
	_fn.resetInterval = function()
	{
		if(this.options.timeout){
			this.mainTimer = clearTimeout(this.mainTimer);
			this.mainTimer = setTimeout($.proxy(function(){this.interval()}, this), this.options.timeout);
		}
	};

})(sk, jQuery);
(function(sk, $){

	/*
	 * @class Countdown
	 * @version 0.1b
	 * @author <a href="mailto:michal.matuska@superkoderi.cz">Michal Matuška</a>
	 * @constructs
	 */
	sk.widgets.Countdown = function(element, options)
	{
		this.$element = element.jquery ? element : $(element);

		this.options = $.extend({
			// defaultní třída widgetu
			widgetClass: 'sk-countdown',
			// html widgetu
			widgetHtml: '<span class="sk-countdown-bar"></span>',
			// selekce elemetnů které se v čase mění
			barSelector: '.sk-countdown-bar',
			// kolik času se má odpočítávat
			time: 7000
		}, options);

		this.prc = 0;
		this.anim = null;
	};


	// prototype
	var _fn = sk.widgets.Countdown.prototype;

	// prototype methods
	_fn.init = function()
	{
		var o = this.options;

		this.$element
			.addClass( o.widgetClass )
			.append( o.widgetHtml );

		this.$bar = this.$element.find( o.barSelector );

		this.barReset();

		return this;
	};

	_fn.destroy = function()
	{
		var o = this.options;

		this.$element
			.removeClass( o.widgetClass )
			.empty();

		return this;
	};

	_fn.start = function()
	{
		var time = (100 - this.prc) / 100 * this.options.time;

		this.anim = $.Animation( {prc: this.prc }, { prc: 100 }, { duration: time, easing: 'linear' });
		this.anim.progress($.proxy(this.animTick, this));
		this.anim.done($.proxy(this.animDone, this));
	};
	_fn.stop = function()
	{
		this.anim.stop();
		this.prc = 0;
		this.barReset();
	};

	_fn.pause = function(yes)
	{
		yes ? this.anim.stop() : this.start();
	};

	_fn.animTick = function(obj)
	{
		this.prc = obj.elem.prc;
		this.barTick(this.prc);
		$(this).trigger('progress', this.prc);
	};

	_fn.animDone = function()
	{
		$(this).trigger('success', this.prc);
	};

	_fn.barTick = function(prc)
	{
		// procenta času
		var prc = 100 - prc;
		var time = Math.ceil( this.options.time / 100 * prc / 1000 );

		this.$bar.text( time + 's');
	}

	_fn.barReset = function()
	{
		var time = Math.ceil( this.options.time / 1000 )

		this.$bar.text( time + 's');
	}

})(sk, jQuery);
(function(sk, $){

	/*
	 * Vytvoří kruhový odpočet času. Funkční je v prohlížečích podporující transformace
	 * @class CountdownCircle
	 * @version 0.1b
	 * @author <a href="mailto:michal.matuska@superkoderi.cz">Michal Matuška</a>
	 * @constructs
	 * @augments sk.widgets.Countdown
	 */
	sk.widgets.CountdownCircle = function(element, options)
	{
		var options = $.extend({
			// defaultní třída widgetu
			widgetClass: 'sk-countdown-circle',
			// html widgetu
			widgetHtml: '\
				<span class="sk-countdown-clip"> \
					<span class="sk-countdown-bar"></span> \
				</span> \
				<span class="sk-countdown-clip"> \
					<span class="sk-countdown-bar"></span> \
				</span>',
			// selekce elemetnů které se v čase mění
			barSelector: '.sk-countdown-bar',
			// kolik času se má odpočítávat
			time: 7000,
		}, options);

		sk.widgets.Countdown.call(this, element, options);
	};

	// extend
	sk.extend(sk.widgets.CountdownCircle, sk.widgets.Countdown);

	// prototype
	var _fn = sk.widgets.CountdownCircle.prototype;
	var _super = sk.widgets.CountdownCircle._super;

	// prototype rewrite methods
	_fn.barTick = function(prc)
	{
		// procenta ze 360
		var deg = 360 / 100 * prc;

		if(deg <= 180)
		{
			this.$bar.last().css('transform', 'rotate('+ (180 + deg) +'deg)');
		}
		else
		{
			// nastavit max hodnotu
			this.$bar.last().css('transform', 'rotate(0deg)');
			// vždy jen o 180°first
			this.$bar.first().css('transform', 'rotate('+ (deg) +'deg)');
		}
	}

	_fn.barReset = function()
	{
		this.$bar.css('transform', 'rotate(180deg)');
	}


})(sk, jQuery);
(function(sk, $){

	/*
		Widget Pager
		version 1

		Created:
		14.02.2012 | Michal Matuška (michal.matuska@superkoderi.cz)

		Updates:
		-

		Fixed bugs:
		-
	*/

	sk.widgets.Pager = function (options)
	{
		this.options = $.extend({
			// aktivní
			current: 0,
			// počet stránek
			max: 0,
			// krok
			step: 1,
			// nekonečné
			infinite: false,
			// ovládací prvek pro předchozí
			pagerPrev: null,
			// ovládací prvek pro další
			pagerNext: null,
			// vygenerovat menu pro kroky
			pagerPages: null,
			pagerTemplate: '<a href="#"><span>{$index}</span></a>',
			// maska kroků
			pagerMask: null,
			pagerMaskString: '{$active}/{$all}', // {$active} = aktivní položka, {$all} = celkový počet
			pagerMaskAdd: 1

		}, options);

		this.current = this.options.current;
		this.step = this.options.step;
		this.min = 0;
		this.max = this.options.max;
		this.infinite = this.options.infinite;
		this.isInit = false;

		return this;
	};

	// SHORTCUT
	//-

	// PROTOTYPE
	var _fn = sk.widgets.Pager.prototype;


	_fn.init = function()
	{
		/*if(!this.max)
		{
			return this;
		}*/

		var o = this.options;

		// předchozí
		if(o.pagerPrev)
		{
			this.$pagerPrev = o.pagerPrev.jquery ? o.pagerPrev : $(o.pagerPrev);

			this.$pagerPrev
				.bind('mousedown touchstart', $.proxy(this.handlePrev, this))
				.bind('click', $.proxy(this.handlePrevent, this));

			this.prevDisabled = false;
		}

		// další
		if(o.pagerNext)
		{
			this.$pagerNext = o.pagerNext.jquery ? o.pagerNext : $(o.pagerNext);

			this.$pagerNext
				.bind('mousedown touchstart', $.proxy(this.handleNext, this))
				.bind('click', $.proxy(this.handlePrevent, this));

			this.nextDisabled = false;
		}

		// stránky
		if(o.pagerPages)
		{
			this.$pagerPages = o.pagerPages.jquery ? o.pagerPages : $(o.pagerPages);
			this.pagerIsCreated = false;

			if( !this.$pagerPages.children().length )
			{
				this.pagerIsCreated = true;

				var pages = '';
				for(var i = 0; i <= this.max; i++)
				{
					pages += this.options.pagerTemplate.replace('{$index}', (i+1) );
				}

				this.$pagerPages
					.append(pages)
			}

			this.$parerPagesItem = this.$pagerPages.find('a');
			this.$pagerPages
				.on('mousedown touchstart', 'a', $.proxy(this.handlePage, this))
				.on('click', 'a', $.proxy(this.handlePrevent, this));
		}

		// mask
		if(o.pagerMask)
		{
			this.$pagerMask = o.pagerMask.jquery ? o.pagerMask : $(o.pagerMask);
		}

		this.isInit = true;

		this.check();

		return this;
	};

	_fn.reinit = function()
	{
		this.check();
	};

	_fn.destroy = function()
	{
		var o = this.options;

		// odstraní
		if(typeof this.$pagerPrev != 'undefined')
		{
			this.$pagerPrev
				.unbind('mousedown touchstart', this.handlePrev)
				.unbind('click', this.handlePrevent);

			delete this.$pagerPrev;
			delete this.prevDisabled;
		}

		// další
		if(typeof this.$pagerNext != 'undefined')
		{
			this.$pagerNext
				.unbind('mousedown touchstart', this.handleNext)
				.unbind('click', this.handlePrevent);

			delete this.$pagerNext;
			delete this.nextDisabled;
		}

		// stránky
		if(typeof this.$pagerPages != 'undefined')
		{
			this.$pagerPages
				.undelegate('a', 'mousedown touchstart', this.handlePage)
				.undelegate('a', 'click', this.handlePrevent)

			if( this.pagerIsCreated )
			{
				this.$pagerPages
					.empty();
			}

			delete this.pagerIsCreated;
			delete this.$parerPagesItem;
			delete this.$pagerPages;
		}

		// mask
		if(typeof this.$pagerMask != 'undefined')
		{
			this.$pagerMask.empty();
			delete this.$pagerMask;
		}

		this.isInit = false;

		return this;
	};

	_fn.prev = function()
	{
		if( this.min != this.current || this.infinite )
		{
			var i = this.current - this.step;

			if(this.infinite)
			{
				this.current = (i + (this.max+1)) % (this.max+1);
			}
			else
			{
				this.current = (i < this.min) ? this.min : (i > this.max) ? this.max : i;
			}

			this.check();

			$(this).trigger('change', [{current: this.current, prev: true, next: false, page: false}]);
		}
	};

	_fn.next = function()
	{
		if( this.max != this.current || this.infinite )
		{
			var i = this.current + this.step;

			if(this.infinite)
			{
				this.current = i % (this.max+1);
			}
			else
			{
				this.current = (i < this.min) ? this.min : (i > this.max) ? this.max : i;
			}

			this.check();

			$(this).trigger('change', [{current: this.current, prev: false, next: true, page: false}]);
		}
	};

	_fn.page = function(i, noCall)
	{
		if( this.current !== i )
		{
			var i = (i < this.min) ? this.min : (i > this.max) ? this.max : i;

			this.current = i;
			this.check();

			if(!noCall)
			{
				$(this).trigger('change', [{current: this.current, prev: false, next: false, page: true}]);
			}
		}
	};



	_fn.check = function()
	{
		this.checkPrev();
		this.checkNext();
		this.checkPage();
		this.checkPagesMask();
	}

	// události
	_fn.handlePrev = function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		if(!this.prevDisabled)
		{
			this.prev();
		}
	};

	_fn.handleNext = function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		if(!this.nextDisabled)
		{
			this.next();
		}
	};

	_fn.handlePage = function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		this.page( this.$parerPagesItem.index(e.currentTarget) );
	};
	_fn.handlePrevent = function(e)
	{
		e.preventDefault();
		e.stopPropagation();
	};

	// kontroly
	_fn.checkPrev = function(e)
	{
		if(typeof this.$pagerPrev != 'undefined')
		{
			if(!this.max)
			{
				this.$pagerPrev.addClass('off');
				this.prevDisabled = true;
				return;
			}
			else
			{
				this.$pagerPrev.removeClass('off');
			}

			if( this.min >= this.current && !this.infinite )
			{
				this.$pagerPrev.addClass('disabled');
				this.prevDisabled = true;
			}
			else if( this.prevDisabled )
			{
				this.$pagerPrev.removeClass('disabled');
				this.prevDisabled = false;
			}
		}
	};

	_fn.checkNext = function(e)
	{
		if(typeof this.$pagerNext != 'undefined')
		{
			if(!this.max)
			{
				this.$pagerNext.addClass('off');
				this.nextDisabled = true;
				return;
			}
			else
			{
				this.$pagerNext.removeClass('off');
			}

			if(this.max <= this.current && !this.infinite )
			{
				this.$pagerNext.addClass('disabled');
				this.nextDisabled = true;
			}
			else if( this.nextDisabled )
			{
				this.$pagerNext.removeClass('disabled');
				this.nextDisabled = false;
			}
		}
	};

	_fn.checkPage = function()
	{
		if(typeof this.$pagerPages != 'undefined')
		{
			this.$parerPagesItem
				.removeClass('active')
				.eq(this.current)
					.addClass('active');
		}
	};

	_fn.checkPagesMask = function()
	{
		if(typeof this.$pagerMask != 'undefined')
		{
			this.$pagerMask
				.html(this.options.pagerMaskString.replace('{$active}', this.current + this.options.pagerMaskAdd ).replace('{$all}', this.max + this.options.pagerMaskAdd));
		}
	};


})(sk, jQuery);