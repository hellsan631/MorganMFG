!function(a){a.fn.inputDefaultText=function(b){return b=a.extend({text:""},b),this.val(b.text).bind("focus",function(){this.value==b.text&&(this.value="")}).bind("blur",function(){""==this.value&&(this.value=b.text)})},a.support.placeholder=function(){var a=document.createElement("input");return"placeholder"in a}();window.App={options:{},run:function(b){var c=this;c.options=a.extend(!0,c.options,b),c.MQ=new sk.utils.MediaQueries({selector:a('<div id="mq" />').appendTo("body"),queries:{"0px":{state:"desktop-1024",params:{width:1024}},"10px":{state:"desktop-1600",params:{width:1600}},"20px":{state:"desktop-1900",params:{width:1920}}}}).init(),TweenLite.defaultEase=Expo.easeInOut,c.$body=a("body"),c.$holder=a("#mother"),c.$front=a("#front"),c.$back=a("#back"),c.isBack=c.$holder.hasClass("back"),c.$visible=c.isBack?c.$back:c.$front,c.$hidden=c.isBack?c.$front:c.$back,c.isIE=function(){var a=-1;if("Microsoft Internet Explorer"==navigator.appName){var b=navigator.userAgent,c=new RegExp("MSIE ([0-9]{1,}[.0-9]{0,})");null!=c.exec(b)&&(a=parseFloat(RegExp.$1))}return navigator.userAgent.match(/Trident.*rv[ :]*11\./)&&(a=11),a}();var d=new TimelineMax({delay:.25});if(c.Loader.restart(),navigator.userAgent.match(/iPad;.*CPU.*OS 7_\d/i)&&window.innerHeight!=document.documentElement.clientHeight){var e=function(){document.documentElement.style.height=window.innerHeight+"px",0!==document.body.scrollTop&&window.scrollTo(0,0)}.bind(this);window.addEventListener("scroll",e,!1),window.addEventListener("orientationchange",e,!1),e(),document.body.style.webkitTransform="translate3d(0,0,0)"}d.set(c.$hidden.find(".header"),{top:0}).set(c.$hidden.find("#footer"),{bottom:0}).addCallback(function(){setTimeout(function(){c.Loader.$loadElement=c.$visible.find(".main"),c.Loader.loadingImages()},200)}).to(c.Loader.$element,1,{autoAlpha:1,delay:-.2});var f={$popup:null,$win:a(window),open:function(b){var c="player"+a.now();this.$popup=a('						<div class="popup-holder"> 							<div class="popup-overlay"></div> 							<div class="popup-window"> 								<div class="popup-content"> 									<div class="box-youtube-holder"> 										<div class="box-youtube" data-youtube="'+b+'"> 											<div id="'+c+'" class="player"></div> 											<a href="#" class="play"><span>Přehrát</span></a> 											<a href="#" class="pause"><span>Zastavit</span></a> 											<div class="status-wrap"> 												<div class="status"><div class="in"></div></div> 											</div> 										</div> 									</div> 									<span class="popup-close"><span></span></span> 								</div> 							</div> 						</div> 					'),this.$popup.css("opacity","0").appendTo("body"),this.$win.on("resize",a.proxy(this.resize,this)),this.resize(),this.$popup.on("click touchdown",".popup-overlay, .popup-close",a.proxy(this.close,this)),this.$popup.trigger("contentload").fadeTo(400,1)},close:function(){var a=this;this.$popup.fadeOut(function(){a.$popup.remove(),a.$win.off("resize",this.resize)}).find(".box-youtube").trigger("destroy")},resize:function(){this.$popup.find(".popup-window").css("margin-top",function(){return a(this).outerHeight()/-2})}};if(a(document).one("afterload",".main",function(){new TimelineMax({delay:.4}).to(c.$visible.find(".header"),.5,{top:0}).to(c.$visible.find("#footer"),.3,{bottom:0,delay:-.2}),a(document).trigger("contentload");var b=a(this);c.Loader.hide(),TweenMax.to(b,1,{autoAlpha:1}),setTimeout(function(){b.trigger("contentplay",!0)},400)}).on("click",".box-message .close",function(b){b.preventDefault(),b.stopImmediatePropagation(),a(this).closest(".box-message").addClass("hidden")}).on("click",".crossroad-contact .close, .crossroad-contact .toggle",function(b){b.preventDefault(),b.stopImmediatePropagation(),a(".box-outlet").removeClass("show-contact"),a(this).closest("li").toggleClass("show-contact").siblings().removeClass("show-contact"),a(this).closest("ul").toggleClass("disabled",a(this).closest("li").hasClass("show-contact"))}).on("click",".crossroad-contact .btn-wrap a, .crossroad-contact .link .btn",function(b){b.preventDefault(),b.stopImmediatePropagation(),a(".box-outlet").toggleClass("show-contact"),a(".crossroad-contact li").removeClass("show-contact"),a(".crossroad-contact ul").toggleClass("disabled",a(".box-outlet").hasClass("show-contact"))}).on("click",".box-gallery .btn-expand, .box-gallery .btn-reduce",function(b){b.preventDefault(),b.stopImmediatePropagation(),a(".pager-img-wrap").trigger("recalc.skcarousel"),a(this).closest(".box-gallery").toggleClass("full")}).on("click",".box-gallery .btn-open, .box-gallery .btn-close",function(b){b.preventDefault(),b.stopImmediatePropagation(),a(this).closest(".box-gallery").toggleClass("show-detail")}).on("click",".popup-video",function(b){b.preventDefault();var c=a(this).attr("href");c=c.split("/"),c=c[c.length-1],f.open(c)}).on("contentload",function(b){c.Images.replace(c.Loader.$loadElement,".responsive.no-load"),c.Loader.imgLoad=c.Loader.util.load(c.Loader.util.getImages(c.Loader.$loadElement,{selector:"*.no-load"})),a.support.placeholder||a("input[placeholder]",b.target).each(function(){a(this).inputDefaultText({text:a(this).attr("placeholder")})}),a(".box-youtube",b.target).each(function(){var b=a(this),c=b.data("youtube"),d=b.find(".play"),e=b.find(".stop"),f=b.find(".pause"),g=b.find(".status .in"),h=a("#"+b.find("> div:first-child").attr("id")),i=null,j=b.closest(".popup-window").length,k=j?c:c.initialVideo;h.tubeplayer({width:b.width(),height:b.height(),showControls:!1,autoPlay:!0,modestbranding:1,allowFullScreen:"true",initialVideo:k,preferredQuality:"auto",onPlayerPlaying:function(){e.show(),f.show(),d.hide(),i=setInterval(function(){g.width(h.tubeplayer("data").currentTime/(h.tubeplayer("data").duration/100)+"%")},250)},onPause:function(){e.hide(),f.hide(),d.show(),clearInterval(i)},onStop:function(){e.hide(),f.hide(),d.show(),clearInterval(i),g.width(0)},onSeek:function(){},onMute:function(){},onUnMute:function(){},onPlayerEnded:function(){l(0,a(this))}});var l=function(a,c){c.closest(".scroll").cycle("pause"),h.tubeplayer("play",{id:k,time:a}).tubeplayer("size",{width:b.width(),height:b.height()})};d.on("click",function(c){c.preventDefault(),b.hasClass("paused")?(b.removeClass("paused"),h.tubeplayer("play")):l(0,a(this))}),e.on("click",function(a){a.preventDefault(),h.tubeplayer("stop")}),f.on("click",function(a){a.preventDefault(),b.addClass("paused"),h.tubeplayer("pause")}),b.on("destroy",function(){clearInterval(i)}),g.closest(".status-wrap").on("click",function(b){g.width((b.pageX-a(this).offset().left)/(a(this).width()/100)+"%"),l(h.tubeplayer("data").duration/100*((b.pageX-a(this).offset().left)/(a(this).width()/100)),a(this))})}),a(".box-gallery",b.target).each(function(){var b=(a(this),a(this).find(".content-detail")),c=a(this).find(".content-wrap h1.h2");c.length&&b.css("padding-top",c.position().top)}),a("#custom-video",b.target).length&&a(document).on("touchend",function(){a("#custom-video")[0].play()}),a(".crossroad-download",b.target).each(function(){var b=a(this),c=b.find(".btn-expand"),d=b.find(".filter .btn"),e=b.find(".item"),f=b.find(".item li"),g=b.find(".title"),h=b.find(".overlay");c.add(h).on("click",function(a){a.preventDefault(),a.stopImmediatePropagation(),b.toggleClass("open")}),d.on("click",function(c){c.preventDefault(),c.stopImmediatePropagation(),a(this).hasClass("status-active")||(d.removeClass("status-active"),a(this).addClass("status-active"),g.text(a(this).text()),f.hide().filter("."+a(this).attr("href").split("#")[1]).show(),e.show().each(function(){a(this).find("li:visible").length||a(this).hide()})),c.isTrigger||b.removeClass("open")}),d.first().trigger("click")}),a(".crossroad-category",b.target).each(function(){var b,c,d,e,f,g,h={7:{hoverCoef:5,width:600},3:{hoverCoef:2.5,width:851},2:{hoverCoef:1.8,width:1496}},i=a(this),j=function(){b=i.find("li").length,c=Math.ceil(a(window).width()/b),d=Math.ceil(a(window).width()/h[b].hoverCoef),e=Math.ceil(c-(d-c)/(b-1)),f=a(window).height(),g=100/900*i.find("li").height()/100,i.find("li").each(function(d){TweenMax.set(a(this),{width:h[b].width*g,x:d*c,clip:"rect(0px,"+c+"px,"+f+"px,0px)"}),TweenMax.set(a(this).find("> a").add(a(this).find("> .box-contact")).add(a(this).find("> .box-contact.left .close")),{x:-((h[b].width*g-c)/2),force3D:!0}),TweenMax.set(a(this).find("> .box-contact.right .close"),{x:(h[b].width*g-c)/2,force3D:!0}),TweenMax.set(a(this).find(".name"),{width:.9*c})})},k=function(){i.find("li").on("mouseenter",function(){a(this).closest("ul").hasClass("disabled")||(Ease=Quad.easeOut,time=.3,Delay=.01,$this=a(this),TweenMax.killTweensOf(a(this)),TweenMax.killTweensOf(a(this).find("> a").add(a(this).find("> .box-contact")).add(a(this).find("> .box-contact .close"))),TweenMax.to($this,time,{clip:"rect(0px,"+d+"px,"+f+"px,0px)",x:$this.data("index")*e,ease:Ease}),TweenMax.to($this.find("> a").add(a(this).find("> .box-contact")).add(a(this).find("> .box-contact.left .close")),time,{x:-((h[b].width*g-d)/2),ease:Ease}),TweenMax.to(a(this).find("> .box-contact.right .close"),time,{x:(h[b].width*g-d)/2,ease:Ease}),TweenMax.to($this.find(".overlay"),time,{backgroundColor:"rgba(0,0,0,0)",ease:Linear.easeNone,force3D:!0}),i.find("li").each(function(c){a(this).data("index")!=$this.data("index")&&(TweenMax.killTweensOf(a(this)),TweenMax.killTweensOf(a(this).find("> a").add(a(this).find("> .box-contact")).add(a(this).find("> .box-contact .close"))),a(this).data("index")<$this.data("index")?TweenMax.to(a(this),time,{clip:"rect(0px,"+e+"px,"+f+"px,0px)",x:e*c,ease:Ease}):TweenMax.to(a(this),time,{clip:"rect(0px,"+e+"px,"+f+"px,0px)",x:e*(c-1)+d,ease:Ease}),TweenMax.to(a(this).find("> a").add(a(this).find("> .box-contact")).add(a(this).find("> .box-contact.left .close")),time,{x:-((h[b].width*g-e)/2),ease:Ease}),TweenMax.to(a(this).find("> .box-contact.right .close"),time,{x:(h[b].width*g-e)/2,ease:Ease}))}))}),i.find("li").on("mouseleave",function(){Ease=Quad.easeOut,time=.3,Delay=0,TweenMax.killTweensOf(a(this)),TweenMax.killTweensOf(a(this).find("> a").add(a(this).find("> .box-contact")).add(a(this).find("> .box-contact .close"))),TweenMax.to(a(this),time,{clip:"rect(0px,"+c+"px,"+f+"px,0px)",x:$this.data("index")*c,ease:Ease,delay:Delay,overwrite:"all"}),TweenMax.to($this.find("> a").add(a(this).find("> .box-contact")).add(a(this).find("> .box-contact.left .close")),time,{x:-((h[b].width*g-c)/2),ease:Ease}),TweenMax.to(a(this).find("> .box-contact.right .close"),time,{x:(h[b].width*g-c)/2,ease:Ease}),TweenMax.to($this.find(".overlay"),time,{backgroundColor:"rgba(0,0,0,.6)",ease:Linear.easeNone,delay:Delay,overwrite:"all"}),i.find("li").each(function(d){a(this).data("index")!=$this.data("index")&&(TweenMax.killTweensOf(a(this)),TweenMax.killTweensOf(a(this).find("> a").add(a(this).find("> .box-contact")).add(a(this).find("> .box-contact .close"))),TweenMax.to(a(this),time,{clip:"rect(0px,"+c+"px,"+f+"px,0px)",x:c*d,ease:Ease,delay:Delay,overwrite:"all",onComplete:clear3D,onCompleteParams:[a(this)]}),TweenMax.to(a(this).find("> a").add(a(this).find("> .box-contact")).add(a(this).find("> .box-contact.left .close")),time,{x:-((h[b].width*g-c)/2),ease:Ease}),TweenMax.to(a(this).find("> .box-contact.right .close"),time,{x:(h[b].width*g-c)/2,ease:Ease}))})}),i.find("li").on("mouseup",function(){a(this).closest("ul").find(".box-contact").length&&a(this).trigger("mouseleave")})};clear3D=function(a){a.find(".overlay").css("backgroundColor","")},a(window).on("resize",j),j(),k()}),a(".crossroad-category2",b.target).each(function(){var b,c,d,e,f,g,h={7:{hoverCoef:5,width:600},3:{hoverCoef:2.5,width:851},2:{hoverCoef:1.8,width:1496}},i=a(this),j=function(){b=i.find("li").length,c=Math.ceil(a(window).width()/b),d=Math.ceil(a(window).width()/h[b].hoverCoef),e=Math.ceil(c-(d-c)/(b-1)),f=a(window).height(),g=100/900*i.find("li").height()/100,i.find("li").each(function(d){TweenMax.set(a(this),{width:h[b].width*g,x:d*c,clip:"rect(0px,"+c+"px,"+f+"px,0px)"}),TweenMax.set(a(this).find("> a").add(a(this).find("> .box-contact")).add(a(this).find("> .box-contact.left .close")),{x:-((h[b].width*g-c)/2),force3D:!0}),TweenMax.set(a(this).find("> .box-contact.right .close"),{x:(h[b].width*g-c)/2,force3D:!0}),TweenMax.set(a(this).find(".name"),{width:.9*c})})},k=function(){i.find("li").on("mouseenter",function(){a(this).closest("ul").hasClass("disabled")||(Ease=Quad.easeOut,time=.3,Delay=.01,$this=a(this),TweenMax.killTweensOf(a(this)),TweenMax.killTweensOf(a(this).find("> a").add(a(this).find("> .box-contact")).add(a(this).find("> .box-contact .close"))),TweenMax.to($this,time,{clip:"rect(0px,"+d+"px,"+f+"px,0px)",x:$this.data("index")*e,ease:Ease}),TweenMax.to($this.find("> a").add(a(this).find("> .box-contact")).add(a(this).find("> .box-contact.left .close")),time,{x:-((h[b].width*g-d)/2),ease:Ease}),TweenMax.to(a(this).find("> .box-contact.right .close"),time,{x:(h[b].width*g-d)/2,ease:Ease}),TweenMax.to($this.find(".overlay"),time,{backgroundColor:"rgba(0,0,0,0)",ease:Linear.easeNone,force3D:!0}),i.find("li").each(function(c){a(this).data("index")!=$this.data("index")&&(TweenMax.killTweensOf(a(this)),TweenMax.killTweensOf(a(this).find("> a").add(a(this).find("> .box-contact")).add(a(this).find("> .box-contact .close"))),a(this).data("index")<$this.data("index")?TweenMax.to(a(this),time,{clip:"rect(0px,"+e+"px,"+f+"px,0px)",x:e*c,ease:Ease}):TweenMax.to(a(this),time,{clip:"rect(0px,"+e+"px,"+f+"px,0px)",x:e*(c-1)+d,ease:Ease}),TweenMax.to(a(this).find("> a").add(a(this).find("> .box-contact")).add(a(this).find("> .box-contact.left .close")),time,{x:-((h[b].width*g-e)/2),ease:Ease}),TweenMax.to(a(this).find("> .box-contact.right .close"),time,{x:(h[b].width*g-e)/2,ease:Ease}))}))}),i.find("li").on("mouseleave",function(){Ease=Quad.easeOut,time=.3,Delay=0,TweenMax.killTweensOf(a(this)),TweenMax.killTweensOf(a(this).find("> a").add(a(this).find("> .box-contact")).add(a(this).find("> .box-contact .close"))),TweenMax.to(a(this),time,{clip:"rect(0px,"+c+"px,"+f+"px,0px)",x:$this.data("index")*c,ease:Ease,delay:Delay,overwrite:"all"}),TweenMax.to($this.find("> a").add(a(this).find("> .box-contact")).add(a(this).find("> .box-contact.left .close")),time,{x:-((h[b].width*g-c)/2),ease:Ease}),TweenMax.to(a(this).find("> .box-contact.right .close"),time,{x:(h[b].width*g-c)/2,ease:Ease}),TweenMax.to($this.find(".overlay"),time,{backgroundColor:"rgba(0,0,0,.6)",ease:Linear.easeNone,delay:Delay,overwrite:"all"}),i.find("li").each(function(d){a(this).data("index")!=$this.data("index")&&(TweenMax.killTweensOf(a(this)),TweenMax.killTweensOf(a(this).find("> a").add(a(this).find("> .box-contact")).add(a(this).find("> .box-contact .close"))),TweenMax.to(a(this),time,{clip:"rect(0px,"+c+"px,"+f+"px,0px)",x:c*d,ease:Ease,delay:Delay,overwrite:"all",onComplete:clear3D,onCompleteParams:[a(this)]}),TweenMax.to(a(this).find("> a").add(a(this).find("> .box-contact")).add(a(this).find("> .box-contact.left .close")),time,{x:-((h[b].width*g-c)/2),ease:Ease}),TweenMax.to(a(this).find("> .box-contact.right .close"),time,{x:(h[b].width*g-c)/2,ease:Ease}))})}),i.find("li").on("mouseup",function(){a(this).closest("ul").find(".box-contact").length&&a(this).trigger("mouseleave")})};clear3D=function(a){a.find(".overlay").css("backgroundColor","")},a(window).on("resize",j),j(),k()}),a(".box-intro.home",b.target).each(function(){var b=a(this),d=new c.widgets.Slideshow.create(b,{timeout:0,Pager:{pagerPages:b.find(".pages")}}).init();a(d).on("initplay",function(c,e){a(d).trigger("beforechange"),TweenMax.to(b.find(".pager"),.5,{right:20,ease:Quad.easeOut,overwrite:!0,delay:e?.3:.1,onComplete:function(){a(d).trigger("afterchange")}})}).on("initstop",function(){var a=this.$currentSlide.data("tween");if(a&&a.kill&&a.kill(),this.$beforeSlide){var a=this.$beforeSlide.data("tween");a&&a.kill&&a.kill()}}).on("beforechange",function(){this.$currentSlide.find(".content > *").css({left:"",opacity:""}),TweenMax.set(this.$currentSlide.find("> .bg"),{x:0,y:0,z:0,scale:1,opacity:1});var a=this.$currentSlide.find("> .bg");this.$currentSlide.data("tween",TweenMax.to(a,10,{css:{scale:1.1,x:-(.05*a.width()),y:-(.05*a.height()),z:.1,rotationZ:"0.01deg",transformOrigin:"0 0",force3D:!0},ease:Linear.easeNone,force3D:!0,overwrite:!0}))}).on("afterchange",function(){if(this.$beforeSlide){var a=this.$beforeSlide.data("tween");a&&a.kill&&a.kill();var a=this.$beforeSlide.data("timeline");a&&a.kill&&a.kill()}var b=new TimelineMax;this.$currentSlide.data("timeline",b),b.to(this.$currentSlide.find("> .bg"),.8,{opacity:.7,ease:Quad.easeInOut},"0.15").staggerTo(this.$currentSlide.find(".content > *"),1,{opacity:1,left:0,ease:Quad.easeOut},.2,"-=0.3")}),b.data("app-slideshow",d)}),a(".menu-section",b.target).each(function(){var b=a(this),d=b.prev(".section-scroll"),e=new c.widgets.Sections.create(d,{durationScroll:Modernizr.touch?.3:.6,Scroll:{},Pager:{pagerPrev:b.find(".prev"),pagerNext:b.find(".next"),pagerPages:b.find(".wrap"),pagerMask:b.find(".pages"),pagerMaskAdd:d.find(".crossroad-section").length?0:1}});e.init(),a(e).on("afterinit afterchange",function(){e.$sections.not(":eq("+e.currentIndex+")").find(".img .scroll").cycle("pause"),e.$sections.eq(e.currentIndex).find(".img .scroll").cycle("resume"),e.$sections.not(":eq("+e.currentIndex+")").find(".box-youtube .stop").trigger("click"),e.$sections.eq(e.currentIndex).find(".box-youtube .play").trigger("click"),e.$sections.not(":eq("+e.currentIndex+")").find("#custom-video").length&&e.$sections.not(":eq("+e.currentIndex+")").find("#custom-video")[0].pause(),e.$sections.eq(e.currentIndex).find("#custom-video").length&&e.$sections.eq(e.currentIndex).find("#custom-video")[0].play()}),d.on("click",".crossroad-section .menu a, .section-link",function(b){b.preventDefault(),b.stopPropagation(),e.Pager.$parerPagesItem.filter('[href="'+a(this).prop("hash")+'"]').trigger("mousedown")}),a(this).data("app-sections",e)}),a(".crossroad-services .img, .box-gallery",b.target).each(function(){var b=a(this);b.on("click",".btn-prev, .btn-next, .pager",function(a){a.stopPropagation()}).find(".scroll:first").cycle({paused:!0,timeout:b.is(".img")?4e3:8e3,fx:"fadeout",slides:"> *",prev:b.find(".btn-prev"),next:b.find(".btn-next"),pager:b.find(".pages, .pager-img"),autoHeight:"calc",pagerTemplate:"",pagerActiveClass:"active",updateView:0}).on("cycle-before",function(){a(".box-youtube .stop").trigger("click")}).on("cycle-next cycle-prev cycle-pager-activated",function(a,b){b.timeout=0})}),a(".crossroad-team",b.target).each(function(){{var b=a(this),c=a.extend({animation:350,easing:Expo.easeInOut,repeat:!1,fullscreen:!1,pagerNext:b.find(".btn-next"),pagerPrev:b.find(".btn-prev"),pagerPages:b.find(".pages"),timeout:0,scroll:3,infinite:!1},c||{});new sk.widgets.Carousel(b.find(".scroll"),c).init()}}),a(".pager-img-wrap",b.target).each(function(){var b=a(this),c=b.hasClass("crossroad-team"),d=b.hasClass("pager-img-wrap"),e=a.extend({animation:350,easing:Linear.easeIn,repeat:!1,fullscreen:!1,pagerNext:b.find(".next"),pagerPrev:b.find(".prev"),timeout:0,infinite:!1,offset:c?40:20},e||{}),f=null,g=b.find(d?".pager-img":".scroll");if(b.on("recalc.skcarousel",function(){f=f?f.destroy():new sk.widgets.Carousel(g,e),f.init()}).trigger("recalc.skcarousel"),c||d){var h,i=200,j=0,k=0,l=2;b.find(".sk-carousel").on("mouseenter",function(){h=b.width()/2,j=parseInt(f.$element.css("left"))}).on("mousemove",function(a){if(f.delta){var b=a.pageX;b-h>i?1!==k&&(k=1,f.options.animation=(f.delta+j)*l,f.setPosition(f.max,!0,!1,!0)):-i>b-h?-1!==k&&(k=-1,f.options.animation=-1*j*l,f.setPosition(f.min,!0,!1,!0)):0!==k&&(f.anim&&f.anim.kill(),k=0,j=parseInt(f.$element.css("left")))}}).on("mouseleave",function(){f.anim&&f.anim.kill(),k=0})}b.data("app-carousel",f)}),a(".crossroad-sortiment",b.target).each(function(){var b=a(this),c=b.find(".wrap"),d=b.find("img"),e=b.find(".point");d.each(function(){b.width()/d.width()<b.height()/d.height()?(d.height(b.height()),c.height(b.height()),c.width(d.width())):(d.width(b.width()),c.width(b.width()),c.height(d.height())),e.each(function(){a(this).offset().left<0?a(this).css("left",-1*c.offset().left+30):a(this).offset().left>b.width()&&a(this).css("left",b.width()-c.offset().left-30).addClass("left"),a(this).offset().top<b.offset().top?a(this).css("top",-1*c.position().top+30):a(this).offset().top>b.height()+b.offset().top&&a(this).css("top",b.height()-c.offset().top+30)})})}),a("input:file",b.target).each(function(){var b=a(this);b.addClass("sk-fake-file-file").attr({size:500}).wrap('<span class="sk-fake-file"></span>').after('<span class="sk-fake-file-wrap-text"><span>'+b.data("before")+"</span></span>").wrap('<span class="sk-fake-file-wrap"></span>');var c=b.closest(".sk-fake-file"),d=c.find(".sk-fake-file-wrap-text span");b.on("change",function(){c.addClass("done"),d.text(b.data("after"))})}),a("ol[start]",b.target).css("counter-reset",function(){return"item "+(a(this).prop("start")-1)}),a("html.ie7 ol",b.target).each(function(){var b=1*a(this).prop("start");a(this).find("li").each(function(c){a(this).prepend('<span class="ie-counter">'+(b+c)+".</span>")})})}).on("contentplay",function(b,c){a(".box-intro",b.target).each(function(){var b=a(this),d=b.data("app-slideshow");d&&(d.options.timeout=5e3,d.resetInterval(),a(d).trigger("initplay",c))}),a(".box-magazin",b.target).each(function(){TweenMax.staggerTo(a(this).find(".content > *"),1,{opacity:1,left:0,delay:.3},.4)}),a(".crossroad-sortiment",b.target).each(function(){TweenMax.staggerTo(a(this).find(".point"),.7,{opacity:1,scale:1,delay:.3},.25)}),a(".menu-section",b.target).each(function(){TweenMax.to(this,.5,{right:a.scrollbarWidth?a.scrollbarWidth():0,delay:.3})}),a(".box-gallery .scroll",b.target).cycle("resume"),a("#video",b.target).each(function(){var b=a(this),c=b.find("video"),d=b.data(),e=d.width,f=d.height,g=e/f;b.on("resize.bg",function(a){a.preventDefault();var d=b.closest(".img").width(),h=b.closest(".img").height(),i=d/h;if(g>i){var j=h/f*e;c.css({height:h,width:j,"margin-top":-h/2,"margin-left":-j/2,top:"50%",left:"50%"})}else{var k=d/e*f;c.css({height:k,width:d,"margin-top":-k/2,"margin-left":-d/2,top:"50%",left:"50%"})}}).trigger("resize.bg")})}).on("contentunload",function(b){a(".box-intro",b.target).each(function(){var b=a(this),c=b.data("app-slideshow");c&&(c.destroy(),a(c).trigger("initstop").off("beforechange afterchange"))}),a(".menu-section",b.target).each(function(){var b=a(this),c=b.data("app-sections");c&&c.destroy()}),a(".crossroad-team",b.target).each(function(){var b=a(this),c=b.data("app-carousel");c&&c.destroy()}),a(".crossroad-services .img .scroll, .box-gallery .scroll",b.target).cycle("destroy"),a(".crossroad-sortiment",b.target).off("recalc.width"),a("#video").off("resize.bg")}),a(c.MQ).on("changeMedia resizeMedia",function(){a(".pager-img-wrap").trigger("recalc.skcarousel"),a(".crossroad-sortiment").trigger("recalc.width"),a("#video").trigger("resize.bg")}).on("changeMedia",function(){c.Images.resize(".responsive")}),Modernizr.history)c.Ajaxify.init();else{var g=a(".menu-subpage");g.length&&(g.appendTo(c.$visible.find(".header")),c.$visible.find(".header .inner").hide())}}}}(jQuery);