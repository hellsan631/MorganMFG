!function(a){var b=window.sk={mediator:a({}),base:{},utils:{},widgets:{},events:{}};b.extend=function(a,b){var c=function(){};c.prototype=b.prototype,a.prototype=new c,a._super=b.prototype,a.prototype.constructor=a}}(jQuery),function(){var a=function(a,b){return function(){return a.apply(b,arguments)}};sk.widgets.SectionFull=function(){function b(b,c){this.handleResize=a(this.handleResize,this),this.handlePagerChange=a(this.handlePagerChange,this),this.handleScrollCancel=a(this.handleScrollCancel,this),this.handleScrollChange=a(this.handleScrollChange,this),this.setCurrent=a(this.setCurrent,this),this.$element=b.jquery?b:$(b),this.options=$.extend(!0,{current:0,sectionSelector:"",durationScroll:.8,durationScrollCancel:.3,Scroll:null,Pager:null},c),this.$sections=this.$element.find(this.options.sectionSelector),this.Pager=this.options.Pager,this.Scroll=this.options.Scroll,this.$win=$(window),this.oldIndex=this.currentIndex=this.options.current,this.lockTimer=null}return b.prototype.init=function(){var a;return this.$element.length&&this.$sections.length&&null!=this.Pager?(a=this.options,this.setCurrent(),this.Pager.current=this.Pager.options.current=this.currentIndex,this.Pager.max=this.Pager.options.max=this.$sections.length-1,this.Pager.init(),$(this.Pager).on("change",this.handlePagerChange),null!=this.Scroll&&(this.Scroll.init(),$(this.Scroll).on("scrollup",this.handleScrollChange).on("scrolldown",this.handleScrollChange).on("scrollcancel",this.handleScrollCancel)),this.$win.on("resize",this.handleResize),$(this).trigger("afterinit"),this):this},b.prototype.destroy=function(){return this.Pager.destroy(),$(this.Pager).off("change",this.handlePagerChange),null!=this.Scroll&&(this.Scroll.destroy(),$(this.Scroll).off("scrollup",this.handleScrollChange).off("scrolldown",this.handleScrollChange).off("scrollcancel",this.handleScrollCancel)),this.$win.off("resize",this.handleResize),this},b.prototype.setCurrent=function(){return this.$element.scrollTop(this.$sections.eq(this.currentIndex)[0].offsetTop)},b.prototype.handleScrollChange=function(a){return this.Pager.page(this.currentIndex+("scrollup"===a.type?-1:1))},b.prototype.handleScrollCancel=function(){return this.scrollTo(this.Pager.current,this.options.durationScrollCancel)},b.prototype.handlePagerChange=function(){return this.scrollTo(this.Pager.current)},b.prototype.handleResize=function(){var a,b;return null!=(a=this.Scroll)&&a.lock(!0),this.setCurrent(),null!=(b=this.Scroll)?b.lock(!1):void 0},b.prototype.scrollTo=function(a,b){var c,d,e=this;return this.oldIndex=this.currentIndex,this.currentIndex=a,c=this.$sections.eq(this.currentIndex)[0].offsetTop,this.lockTimer=clearTimeout(this.lockTimer),null!=(d=this.Scroll)&&d.lock(!0),this.oldIndex!==this.currentIndex&&$(this).trigger("beforechange"),TweenLite.to(this.$element,b||this.options.durationScroll,{scrollTo:c,ease:Expo.easeOut,overwrite:!0,onComplete:function(){return e.oldIndex!==e.currentIndex&&$(e).trigger("afterchange"),e.lockTimer=setTimeout(function(){var a;return null!=(a=e.Scroll)?a.lock(!1):void 0},200),e.anim=null}})},b}(),sk.widgets.SectionScroll=function(){function b(b,c){this.handleMouseup=a(this.handleMouseup,this),this.handleMousemove=a(this.handleMousemove,this),this.handleMousedown=a(this.handleMousedown,this),this.handleTouch=a(this.handleTouch,this),this.handleMousewheel=a(this.handleMousewheel,this),this.$element=b.jquery?b:$(b),this.options=$.extend({minDelta:50,scrollbarTimerDelay:0,mousewheelTimerDelay:200},c),this.oldTop=0,this.top=0,this.delta=0,this.mousewheelTimer=!1,this.scrollbarTimer=!1,this.isLocked=!1,this.$doc=$(document)}return b.prototype.init=function(){var a;return this.$element.length?(a=this.options,this.$element.on("mousewheel scroll",this.handleMousewheel).on("mousedown",this.handleMousedown).on("touchstart touchmove",this.handleTouch),this):this},b.prototype.destroy=function(){return this.$element.off("mousewheel scroll",this.handleMousewheel).off("mousedown",this.handleMousedown).off("touchstart touchmove",this.handleTouch),this},b.prototype.handleMousewheel=function(a){var b=this;return this.isLocked?a.preventDefault():(this.top=this.$element.scrollTop(),this.scrollTimer?this.scrollTimer=clearTimeout(this.scrollTimer):(this.delta=0,this.oldTop=this.top),this.delta=this.top-this.oldTop,Math.abs(this.delta)>=this.options.minDelta?(a.preventDefault(),this.checkScroll(),this.scrollTimer=clearTimeout(this.scrollTimer),this.scrollTimer=!1):this.scrollTimer=setTimeout(function(){return b.delta=b.$element.scrollTop()-b.oldTop,b.checkScroll(),b.scrollTimer=!1},this.options.mousewheelTimerDelay))},b.prototype.handleTouch=function(a){return this.isLocked?a.preventDefault():void 0},b.prototype.handleMousedown=function(a){return a.currentTarget===a.target?(this.oldTop=this.$element.scrollTop(),this.$doc.on("mousemove",this.handleMousemove).on("mouseup",this.handleMouseup)):void 0},b.prototype.handleMousemove=function(){var a=this;return this.scrollbarTimer=setTimeout(function(){return a.top=a.$element.scrollTop(),a.oldTop!==a.top?(a.lock(!0),a.$doc.off("mousemove",a.handleMousemove)):void 0},0)},b.prototype.handleMouseup=function(){return this.top=this.$element.scrollTop(),this.scrollbarTimer=clearTimeout(this.scrollbarTimer),this.$doc.off("mousemove",this.handleMousemove),this.$doc.off("mouseup",this.handleMouseup),this.delta=this.top-this.oldTop,this.lock(!1),this.checkScroll()},b.prototype.checkScroll=function(){var a;return this.delta?(a="scrollcancel",Math.abs(this.delta)>=this.options.minDelta&&(a=this.delta>0?"scrolldown":"scrollup"),$(this).trigger(a,{scrollTop:this.top})):void 0},b.prototype.lock=function(a){return this.isLocked=null!=a?a:!this.isLocked,this},b}()}.call(this),function(a,b){a.utils.Ajaxify=function(a){this.options=b.extend({pageTree:[],linksSelector:"",formsSelector:"",ajaxData:{},pushStateOnly:!0},a),this.$D=b(document)};var c=a.utils.Ajaxify.prototype;c.init=function(){return"file:"===document.location.protocol?(this.log("historie ani ajax nejede na file://. Spusť si server"),this):History.enabled===!1||this.options.pushStateOnly&&History.emulated.pushState?(this.log("historie v prohlížeči není povolena"),this):this.options.pageTree&&this.options.pageTree.length?(this.initUrls(),this.initState(),this.oldState=this.state=History.getState(),this.options.linksSelector&&this.$D.on("click",this.options.linksSelector,b.proxy(this.handleLinks,this)),this.options.formsSelector&&this.$D.on("submit",this.options.formsSelector,b.proxy(this.handleForms,this)),History.Adapter.bind(window,"statechange",b.proxy(function(){var a=History.getState();a.data.ajaxify&&this.setState(a)},this)),this):(this.log("není předán strom url webu"),this)},c.initUrls=function(){this.pageUrls={},this.prepareUrls(this.options.pageTree)},c.prepareUrls=function(a,c,d,e){for(var f=0,g=a.length;g>f;f++){var h=a[f],e=e||0,c=c||null,d=0===e?h.url:d;this.pageUrls[h.url]=b.extend({},h,{level:e,index:f,parent:c,topParent:d}),h.children&&h.children.length&&this.prepareUrls(h.children,h.url,d,e+1)}},c.getPageNearest=function(a,c){var a=a,c=c||1,d=a.split("/");if(d.pop(),d.length<3)return!1;a=d.join("/");var e=this.pageUrls[a];return"undefined"==typeof e?this.getPageNearest(a,c+1):(e=b.extend({},e),e.level+=c,e)},c.getPage=function(a){var b=this.pageUrls[a];return"undefined"==typeof b&&(b=this.getPageNearest(a),b&&(b.parent=b.url,b.url=a,b.detail=!0,this.pageUrls[a]=b)),"undefined"!=typeof b?b:!1},c.setState=function(a){this.oldState=this.state,this.state=a,this.oldPage=this.page,this.page=this.getPage(a.data.page),this.changeState()},c.getState=function(){return this.state},c.initState=function(){var a=this.getUrl(location.href),b=this.getPage(a.pathname);return b||this.log("aktuální url není ve stromu stránek"),this.page=this.oldPage=b,this},c.pushState=function(a,c,d){b(this).trigger("push.ajaxify",a),History.pushState(a,c,d)},c.changeState=function(){var a=b(this.state.data.target);this.ajax&&this.ajax.abort(),this.ajaxStart(),a.is("form")?a.ajaxSubmit({data:this.options.ajaxData,beforeSend:b.proxy(function(a){this.ajax=a},this),success:b.proxy(this.ajaxDone,this),error:b.proxy(this.ajaxFail,this),complete:b.proxy(this.ajaxEnd,this)}):this.ajax=b.ajax(this.state.data.ajax).done(b.proxy(this.ajaxDone,this)).fail(b.proxy(this.ajaxFail,this)).always(b.proxy(this.ajaxEnd,this))},c.ajaxDone=function(){b(this).trigger("done.ajaxify",arguments)},c.ajaxFail=function(){b(this).trigger("fail.ajaxify",arguments)},c.ajaxStart=function(){b(this).trigger("start.ajaxify")},c.ajaxEnd=function(){this.ajax=null,b(this).trigger("end.ajaxify")},c.handleLinks=function(a){var c=b(a.currentTarget),d=this.getUrl(c),e=this.getPage(d.pathname);if(e&&!e.noAjax&&(a.preventDefault(),this.page!==e)){var f=this.getTitle(e),g=d.hrefAttr,h={ajaxify:!0,page:d.pathname,target:this.getSelector(a.currentTarget),ajax:{url:d.href,type:d.type,data:this.options.ajaxData}};this.pushState(h,f,g)}},c.handleForms=function(a){a.preventDefault();var c=b(a.currentTarget),d=this.getUrl(c.prop("action"));console.log(c.prop("action")),this.setState({data:{ajaxify:!0,page:d.pathname,target:this.getSelector(a.currentTarget)}})},c.getUrl=function(a){var c=!1,d=a,e={type:"GET"};return"string"===b.type(d)&&(c=!0,d=b('<a href="'+a+'" />')),e.host=d.prop("host"),e.hostname=d.prop("hostname"),e.href=d.prop("href"),e.hrefAttr=d.attr("href"),e.pathname=d.prop("pathname"),e.search=d.prop("search"),c&&d.remove(),e},c.getTitle=function(a){return a.title||document.title},c.getSelector=function(a){for(var b,c,d=[];a.parentNode;a=a.parentNode){for(b=a.tagName,c=0;a.previousSibling;)a=a.previousSibling,b==a.tagName&&(c+=1);d.unshift(b+":eq("+c+")")}return d.join(" > ")},c.log=function(a){console&&console.log&&console.log(a)}}(sk,jQuery),function(a,b){a.utils.Loader=function(){this.cache={},this.dimensions=!1};var c=a.utils.Loader.prototype;c.loadItem=function(a){{var c=this,d=b.Deferred();b("<img />").on("load",function(){c.dimensions&&c.setCache(a,{width:this.width,height:this.height}),c=null,d.resolve()}).on("error",function(){d.reject()}).attr("src",a)}return d.promise()},c.load=function(a){for(var c=a.length,d=0,e=0,f=0,g=b.Deferred(),h=0;c>h;h++){var i=a[h];!function(a,h){b.when(a.loadItem(h)).done(function(){e++,d++}).fail(function(){f++,d++}).always(function(){c!==d?g.notify({length:c,tested:d}):g.resolve({length:c,tested:d})})}(this,i)}var j=c===d;return c||g.resolve({length:c,tested:d}),{done:j,length:c,tested:d,dfr:g,abort:b.proxy(function(){"pending"===g.state()&&(g.reject(),this.loadStop())},this)}},c.getImages=function(a,c){var d=[],e=a.jquery?a:b(a),c=b.extend({selector:"*:not(iframe, object, embed, script, style)"},c);return selector=c.selector,e.find(selector).each(function(){if("img"===this.nodeName.toLowerCase()){var a=b(this).attr("src");return void(a&&d.push(a))}var c=b(this).css("background-image");if(c.search("url")>-1){var e=c.replace(/url\((?:'|")?(.*?)(?:'|")?\)/g,"$1").split(/,\s?/);d=d.concat(e)}}),d},c.loadStop=function(){void 0!==window.stop?window.stop():void 0!==document.execCommand&&document.execCommand("Stop",!1)},c.setCache=function(a,b){this.cache[a]=b||!0},c.hasCache=function(a){return"undefined"!=typeof this.cache[a]}}(sk,jQuery),function(a,b){a.utils.MediaQueries=function(a){return this.options=b.extend({selector:"#mq",property:"left",timer:150,queries:{}},a),this};var c=a.utils.MediaQueries.prototype;c.init=function(){var a=this.options;return this.$w=b(window),this.selector=a.selector.jquery?a.selector:b(a.selector),this.property=a.property,this.queries=a.queries,this.state=null,this.params=null,this.timer=null,this.$w.on("resize.MediaQueries",b.proxy(this.check,this)).trigger("resize"),this},c.destroy=function(){return this.$w.off(".MediaQueries"),this},c.check=function(){if(!this.timer){var a=this,c=function(){var c,d=a.selector.css(a.property),e=a.queries[d];if(e!==c)if(a.state===e.state){var f=b.Event("resizeMedia",{state:this.state,params:e.params});b(a).trigger(f)}else{var f=b.Event("changeMedia",{state:e.state,fromState:a.state,params:e.params});a.state=e.state,a.params=e.params,b(a).trigger(f)}a.timer=null};null===this.state?c():this.timer=setTimeout(function(){c()},this.options.timer)}}}(sk,jQuery),function(a,b){a.widgets.Carousel=function(a,c){return this.$element=a.jquery?a:b(a),this.options=b.extend({item:">*",scroll:1,position:0,fullscreen:!0,repeat:!1,infinite:!1,animation:500,easing:Linear.easeNone,axis:"x",pagerPrev:null,pagerNext:null,pagerPages:null,pagerMask:null,pagerMaskString:"{$active}/{$all}",timeout:0,onChange:null,offset:0,emptyHolder:'<li class="empty"></li>'},c),this.axProps="x"==this.options.axis?{left:"left",width:"width",outerWidth:"outerWidth",scrollWidth:"scrollWidth",scrollLeft:"scrollLeft",offset:"offsetLeft"}:{left:"top",width:"height",outerWidth:"outerHeight",scrollWidth:"scrollHeight",scrollLeft:"scrollTop",offset:"offsetTop"},this.position=this.options.position,this.pager=null,this};var c=a.widgets.Carousel.prototype;c.init=function(){if(!this.$element.length)return this;var c=this.options;return this.size=this.$element[this.axProps.width]()||0,this.sizeScroll=this.$element.prop(this.axProps.scrollWidth)||0,this.delta=this.sizeScroll-this.size,this.$holder=this.$element[this.axProps.scrollLeft](0).wrap('<div class="sk-carousel sk-carousel-'+c.axis+'"></div>').parent(),this.$originalItems=this.$items=this.$element.find(c.item),this.infinite=c.infinite,this.clonedCount=0,this.infinite&&(this.clonedCount=this.createInfinite(),this.$items=this.$element.find(c.item)),this.length=this.$items.length,this.repeat=c.repeat,this.scroll=this.getScroll(),this.steps=this.getSteps(),this.min=0,this.max=this.steps.length-2*this.clonedCount-1,this.animated=c.animation?!0:!1,this.mainTimer=null,this.handled=!1,"undefined"!=typeof a.widgets.Pager&&(this.pager=new a.widgets.Pager({current:this.position,max:this.max,infinite:this.repeat||this.infinite,pagerPrev:c.pagerPrev,pagerNext:c.pagerNext,pagerPages:c.pagerPages,pagerMask:c.pagerMask,pagerMaskString:c.pagerMaskString}),this.pager.init(),b(this.pager).on("change",b.proxy(function(a,b){if(this.clearInterval(),this.handled=!0,b.prev)var c=this.infinite?this.position-1:b.current;if(b.next)var c=this.infinite?this.position+1:b.current;if(b.page)var c=b.current;this.setPosition(c,this.animated)},this))),this.max&&(this.setPosition(this.position,!1,!0),this.isInit=!0,"function"==typeof c.onStart&&c.onStart.call(this,{position:this.position,handled:this.handled})),this},c.destroy=function(){var a=this.options;return this.$element.css(this.axProps.left,"").unwrap(),this.$holder=null,delete this.$holder,this.$items=null,delete this.$items,delete this.length,this.pager&&this.pager.destroy(),a.timeout&&(this.clearInterval(),delete this.mainTimer),this.isInit=!1,this},c.setPosition=function(a,c,d,e){var f=this.options;if(this.anim&&this.anim.kill(),this.infinite)var a=a;else var a=a>this.max?this.max:a<this.min?this.min:a;if(this.position!=a||d||e){var g={};g[this.axProps.left]=this.steps[a+this.clonedCount],c?this.anim=TweenMax.to(this.$element,f.animation/1e3,b.extend(g,{ease:f.easing,force3D:!0,overwrite:!0,onComplete:function(){this.setPosition(a,!1,!1,!0),this.anim=null},onCompleteScope:this})):(this.$element.css(g),this.resetInterval()),e||(this.infinite&&(a=a<this.min?this.max:a>this.max?this.min:a),this.position=a,!this.handled&&this.pager&&(this.pager.current=a,this.pager.check())),d||e||"function"==typeof f.onChange&&f.onChange.call(this,{position:a,handled:this.handled})}this.handled=!1},c.getPosition=function(){return this.position},c.getSteps=function(){for(var a=[],b=this.options,c=this.axProps.left,d=this.delta,e=this.$items.length,f=0;e>f;f+=this.scroll)if(b.fullscreen){var g=-100*f+"%";a.push(g)}else{var g=-Math.round(this.$items.eq(f).position()[c])-(0==f?0:b.offset);if(-d>=g){g=-d,a.push(g);break}a.push(g)}return a},c.getScroll=function(){var a=this.options;return a.fullscreen?1:a.scroll>this.length-1?this.length:a.scroll},c.createInfinite=function(){var a=this.options;if(a.fullscreen){var b=this.$items.first().clone(!0).addClass("clone").removeAttr("id").data("sk-carousel-clone",0),c=this.$items.last().clone(!0).addClass("clone").removeAttr("id").data("sk-carousel-clone",this.length-1);return this.$element.append(b).prepend(c),1}return 0},c.interval=function(){this.pager&&this.pager.next()},c.clearInterval=function(){this.mainTimer=clearTimeout(this.mainTimer)},c.resetInterval=function(){this.options.timeout&&(this.mainTimer=clearTimeout(this.mainTimer),this.mainTimer=setTimeout(b.proxy(function(){this.interval()},this),this.options.timeout))}}(sk,jQuery),function(a,b){a.widgets.Countdown=function(a,c){this.$element=a.jquery?a:b(a),this.options=b.extend({widgetClass:"sk-countdown",widgetHtml:'<span class="sk-countdown-bar"></span>',barSelector:".sk-countdown-bar",time:7e3},c),this.prc=0,this.anim=null};var c=a.widgets.Countdown.prototype;c.init=function(){var a=this.options;return this.$element.addClass(a.widgetClass).append(a.widgetHtml),this.$bar=this.$element.find(a.barSelector),this.barReset(),this},c.destroy=function(){var a=this.options;return this.$element.removeClass(a.widgetClass).empty(),this},c.start=function(){var a=(100-this.prc)/100*this.options.time;this.anim=b.Animation({prc:this.prc},{prc:100},{duration:a,easing:"linear"}),this.anim.progress(b.proxy(this.animTick,this)),this.anim.done(b.proxy(this.animDone,this))},c.stop=function(){this.anim.stop(),this.prc=0,this.barReset()},c.pause=function(a){a?this.anim.stop():this.start()},c.animTick=function(a){this.prc=a.elem.prc,this.barTick(this.prc),b(this).trigger("progress",this.prc)},c.animDone=function(){b(this).trigger("success",this.prc)},c.barTick=function(a){var a=100-a,b=Math.ceil(this.options.time/100*a/1e3);this.$bar.text(b+"s")},c.barReset=function(){var a=Math.ceil(this.options.time/1e3);this.$bar.text(a+"s")}}(sk,jQuery),function(a,b){a.widgets.CountdownCircle=function(c,d){var d=b.extend({widgetClass:"sk-countdown-circle",widgetHtml:'				<span class="sk-countdown-clip"> 					<span class="sk-countdown-bar"></span> 				</span> 				<span class="sk-countdown-clip"> 					<span class="sk-countdown-bar"></span> 				</span>',barSelector:".sk-countdown-bar",time:7e3},d);a.widgets.Countdown.call(this,c,d)},a.extend(a.widgets.CountdownCircle,a.widgets.Countdown);{var c=a.widgets.CountdownCircle.prototype;a.widgets.CountdownCircle._super}c.barTick=function(a){var b=3.6*a;180>=b?this.$bar.last().css("transform","rotate("+(180+b)+"deg)"):(this.$bar.last().css("transform","rotate(0deg)"),this.$bar.first().css("transform","rotate("+b+"deg)"))},c.barReset=function(){this.$bar.css("transform","rotate(180deg)")}}(sk,jQuery),function(a,b){a.widgets.Pager=function(a){return this.options=b.extend({current:0,max:0,step:1,infinite:!1,pagerPrev:null,pagerNext:null,pagerPages:null,pagerTemplate:'<a href="#"><span>{$index}</span></a>',pagerMask:null,pagerMaskString:"{$active}/{$all}",pagerMaskAdd:1},a),this.current=this.options.current,this.step=this.options.step,this.min=0,this.max=this.options.max,this.infinite=this.options.infinite,this.isInit=!1,this};var c=a.widgets.Pager.prototype;c.init=function(){var a=this.options;if(a.pagerPrev&&(this.$pagerPrev=a.pagerPrev.jquery?a.pagerPrev:b(a.pagerPrev),this.$pagerPrev.bind("mousedown touchstart",b.proxy(this.handlePrev,this)).bind("click",b.proxy(this.handlePrevent,this)),this.prevDisabled=!1),a.pagerNext&&(this.$pagerNext=a.pagerNext.jquery?a.pagerNext:b(a.pagerNext),this.$pagerNext.bind("mousedown touchstart",b.proxy(this.handleNext,this)).bind("click",b.proxy(this.handlePrevent,this)),this.nextDisabled=!1),a.pagerPages){if(this.$pagerPages=a.pagerPages.jquery?a.pagerPages:b(a.pagerPages),this.pagerIsCreated=!1,!this.$pagerPages.children().length){this.pagerIsCreated=!0;for(var c="",d=0;d<=this.max;d++)c+=this.options.pagerTemplate.replace("{$index}",d+1);this.$pagerPages.append(c)}this.$parerPagesItem=this.$pagerPages.find("a"),this.$pagerPages.on("mousedown touchstart","a",b.proxy(this.handlePage,this)).on("click","a",b.proxy(this.handlePrevent,this))}return a.pagerMask&&(this.$pagerMask=a.pagerMask.jquery?a.pagerMask:b(a.pagerMask)),this.isInit=!0,this.check(),this},c.reinit=function(){this.check()},c.destroy=function(){this.options;return"undefined"!=typeof this.$pagerPrev&&(this.$pagerPrev.unbind("mousedown touchstart",this.handlePrev).unbind("click",this.handlePrevent),delete this.$pagerPrev,delete this.prevDisabled),"undefined"!=typeof this.$pagerNext&&(this.$pagerNext.unbind("mousedown touchstart",this.handleNext).unbind("click",this.handlePrevent),delete this.$pagerNext,delete this.nextDisabled),"undefined"!=typeof this.$pagerPages&&(this.$pagerPages.undelegate("a","mousedown touchstart",this.handlePage).undelegate("a","click",this.handlePrevent),this.pagerIsCreated&&this.$pagerPages.empty(),delete this.pagerIsCreated,delete this.$parerPagesItem,delete this.$pagerPages),"undefined"!=typeof this.$pagerMask&&(this.$pagerMask.empty(),delete this.$pagerMask),this.isInit=!1,this},c.prev=function(){if(this.min!=this.current||this.infinite){var a=this.current-this.step;this.current=this.infinite?(a+(this.max+1))%(this.max+1):a<this.min?this.min:a>this.max?this.max:a,this.check(),b(this).trigger("change",[{current:this.current,prev:!0,next:!1,page:!1}])}},c.next=function(){if(this.max!=this.current||this.infinite){var a=this.current+this.step;this.current=this.infinite?a%(this.max+1):a<this.min?this.min:a>this.max?this.max:a,this.check(),b(this).trigger("change",[{current:this.current,prev:!1,next:!0,page:!1}])}},c.page=function(a,c){if(this.current!==a){var a=a<this.min?this.min:a>this.max?this.max:a;this.current=a,this.check(),c||b(this).trigger("change",[{current:this.current,prev:!1,next:!1,page:!0}])}},c.check=function(){this.checkPrev(),this.checkNext(),this.checkPage(),this.checkPagesMask()},c.handlePrev=function(a){a.preventDefault(),a.stopPropagation(),this.prevDisabled||this.prev()},c.handleNext=function(a){a.preventDefault(),a.stopPropagation(),this.nextDisabled||this.next()},c.handlePage=function(a){a.preventDefault(),a.stopPropagation(),this.page(this.$parerPagesItem.index(a.currentTarget))},c.handlePrevent=function(a){a.preventDefault(),a.stopPropagation()},c.checkPrev=function(){if("undefined"!=typeof this.$pagerPrev){if(!this.max)return this.$pagerPrev.addClass("off"),void(this.prevDisabled=!0);this.$pagerPrev.removeClass("off"),this.min>=this.current&&!this.infinite?(this.$pagerPrev.addClass("disabled"),this.prevDisabled=!0):this.prevDisabled&&(this.$pagerPrev.removeClass("disabled"),this.prevDisabled=!1)}},c.checkNext=function(){if("undefined"!=typeof this.$pagerNext){if(!this.max)return this.$pagerNext.addClass("off"),void(this.nextDisabled=!0);this.$pagerNext.removeClass("off"),this.max<=this.current&&!this.infinite?(this.$pagerNext.addClass("disabled"),this.nextDisabled=!0):this.nextDisabled&&(this.$pagerNext.removeClass("disabled"),this.nextDisabled=!1)}},c.checkPage=function(){"undefined"!=typeof this.$pagerPages&&this.$parerPagesItem.removeClass("active").eq(this.current).addClass("active")},c.checkPagesMask=function(){"undefined"!=typeof this.$pagerMask&&this.$pagerMask.html(this.options.pagerMaskString.replace("{$active}",this.current+this.options.pagerMaskAdd).replace("{$all}",this.max+this.options.pagerMaskAdd))}}(sk,jQuery);