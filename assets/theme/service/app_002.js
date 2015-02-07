!function(a,b,c){b.Ajaxify={currentTarget:null,currentPage:null,currentContent:null,currentSubmenu:null,oldPage:null,oldContent:null,oldSubmenu:null,loaderTimer:null,lastFrontUrl:null,lastBackUrl:null,cache:{},isCached:!1,metaWords:c('meta[name="keywords"]').get(0),metaDesc:c('meta[name="description"]').get(0),init:function(){c(document).on("click",".header .arrow a",c.proxy(function(a){var d=b.isBack?this.lastFrontUrl:this.lastBackUrl;d&&(a.preventDefault(),a.stopImmediatePropagation(),c('<a href="'+d+'" />').appendTo(this.currentContent).trigger("click"))},this)),this.Ajaxify=new a.utils.Ajaxify({pageTree:b.options.links,linksSelector:"a:not(.no-ajax)",formsSelector:"form.ajax",ajaxData:{ajax:!0}}).init(),c(this.Ajaxify).on("start.ajaxify",c.proxy(this.handleStart,this)).on("done.ajaxify",c.proxy(this.handleDone,this)).on("fail.ajaxify",c.proxy(this.handleFail,this)),this.oldSubmenu=b.$visible.find(".menu-subpage").appendTo(b.$visible.find(".header")),this.currentContent=b.$visible.find(".main > *:last"),this.oldSubmenu.length&&b.$visible.find(".header .inner").css("top","-120px"),TweenMax.set(b.$front,{rotationY:b.isBack?-180:0,scale:1,force3D:!0}),TweenMax.set(b.$back,{rotationY:b.isBack?0:-180,scale:1,force3D:!0}),this.changePage(),this.changeLinks(),this.cache[this.currentPage.url]=!0},handleStart:function(){this.isCached=!1,this.currentTarget=c(this.Ajaxify.state.data.target),this.changePage(),this.changeLinks(),this.loadingStart(),this.isNewContext=this.currentPage.backend!==this.oldPage.backend,this.setContext(),b.isBack?this.lastBackUrl=this.currentPage.url:this.lastFrontUrl=this.currentPage.url,"undefined"!=typeof _gaq&&(_gaq.push(["_trackPageview",this.currentPage.url]),_gaq.push(["b._trackPageview",this.currentPage.url]))},handleDone:function(a,b){this.loadingAjax(),this.changeContent(b),this.changeSubmenu(),this.currentContent.one("afterload",c.proxy(this.handleAfterLoad,this)),this.loadingImages()},handleFail:function(){this.loadingEnd(),location.reload()},handleAfterLoad:function(){if(this.cache[this.currentPage.url]=!0,this.loadingEnd(),"0"===b.$visible.find(".main").css("opacity")&&TweenMax.to(b.$visible.find(".main"),1,{autoAlpha:1}),this.currentTarget.is("form")){this.oldContent.trigger("contentunload"),this.oldContent.replaceWith(this.currentContent);{this.currentContent.find("*[data-redirect]:first").data("redirect")}this.currentContent.css({position:"",display:"",left:"",top:"",opacity:""}).trigger("contentload").trigger("contentplay")}else this.isNewContext?this.animationPageContext():this.animationPage();c(document).trigger("contentafterload")},animationPageContext:function(){var a=this.currentContent,c=this.oldContent;a.appendTo(b.$visible.find(".main").empty()).scrollTop(0).trigger("contentload");var d=new TimelineMax({onComplete:function(){a.trigger("contentplay"),c.trigger("contentunload").remove(),a=null,c=null}});a.css({position:"",display:"",left:"",top:"",opacity:""}),10===b.isIE?d.to(b.$front,0,{rotationY:b.isBack?-180:0,scale:1,ease:Expo.easeOut}).to(b.$back,0,{rotationY:b.isBack?0:-180,scale:1,ease:Expo.easeOut}):d.to(b.$front,.75,{rotationY:-90,scale:.6,ease:Expo.easeIn}).to(b.$back,.75,{rotationY:-90,scale:.6,ease:Expo.easeIn},"-=0.75").to(b.$front,.75,{rotationY:b.isBack?-180:0,scale:1,ease:Expo.easeOut}).to(b.$back,.75,{rotationY:b.isBack?0:-180,scale:1,ease:Expo.easeOut},"-=0.75")},animationPage:function(){var a="right",d="slide",e=this.oldPage,f=this.currentPage;e.topParent!==f.topParent&&(e=this.Ajaxify.getPage(e.topParent),f=this.Ajaxify.getPage(f.topParent)),e.level===f.level?(this.currentTarget.hasClass("prev")||!this.currentTarget.hasClass("next")&&e.index>f.index)&&(a="left"):e.detail||f.detail?(d="fade",a=f.detail?"in":"out"):a=e.level>f.level?"top":"bottom";var g=this.currentContent,h=this.oldContent;b.Animation[d]({dir:a,elementOut:h,elementIn:g.scrollTop(0).trigger("contentload"),onComplete:c.proxy(function(){g.trigger("contentplay"),g.prevAll().trigger("contentunload").remove(),g=null,h=null},this)})},changePage:function(){this.oldPage=this.Ajaxify.oldPage,this.currentPage=this.Ajaxify.page,this.isCached=this.currentPage.url in this.cache},changeContent:function(a){var d=c(a),e=(c(c.parseHTML(a,document,!0)).filter("script"),d.filter(".metas").first());this.oldContent=this.currentContent,this.currentContent=d.filter(".section").first(),e.length&&(document.title=e.find(".metaTitle").text(),this.metaWords.content=e.find(".metaKeywords").text(),this.metaDesc.content=e.find(".metaDescription").text()),this.currentContent.css({position:"absolute",display:"block",left:0,top:0,opacity:0}).appendTo(b.$visible.find(".main")),c(document).trigger("contentchange")},changeSubmenu:function(){var a=!1;this.currentSubmenu=this.currentContent.find(".menu-subpage").detach(),this.currentSubmenu.length?(this.oldSubmenu&&this.oldSubmenu.length?this.oldSubmenu.attr("id")!==this.currentSubmenu.attr("id")&&(this.oldSubmenu.replaceWith(this.currentSubmenu),a=!0):(this.currentSubmenu.appendTo(b.$visible.find(".header")),TweenMax.to(b.$visible.find(".header .inner"),.5,{top:-120,overwrite:!0,ease:Quad.easeIn}),a=!0),a&&(this.changeLinks(this.currentSubmenu),this.oldSubmenu=this.currentSubmenu)):this.oldSubmenu&&this.oldSubmenu.length&&TweenMax.to(b.$visible.find(".header .inner"),.5,{top:0,overwrite:!0,ease:Quad.easeOut,onComplete:function(){this.oldSubmenu.remove(),this.oldSubmenu=null},onCompleteScope:this})},changeLinks:function(){var a=this.getTreeFromPage(this.currentPage),b='a[href="'+a.join('"], a[href="')+'"]';this.activeLinks&&this.activeLinks.not(b).removeClass("active").parent("li").removeClass("active-parent"),this.activeLinks=c(b),this.activeLinks.addClass("active").parent("li").addClass("active-parent")},getTreeFromPage:function(a){var b=this,c=[a.url],d=function(a){if(a){var e=b.Ajaxify.getPage(a);c.push(e.url),d(e.parent)}};return d(a.parent),b=null,c},setContext:function(){this.isNewContext&&(b.$holder.toggleClass("back"),b.isBack=b.$holder.hasClass("back"),b.$visible=b.isBack?b.$back:b.$front,b.$hidden=b.isBack?b.$front:b.$back,b.$visible.find(".main").css("opacity",1),this.oldSubmenu=b.$visible.find(".header .menu-subpage"))},loadingStart:function(){b.Loader.stop(),b.Loader.restart(),this.isCached||(b.Loader.show(),this.loadingTick())},loadingTick:function(){this.loaderTimer=clearInterval(this.loaderTimer),this.loaderTimer=setInterval(function(){b.Loader.loadObj.prc<50?b.Loader.change(b.Loader.loadObj.prc+5):this.loaderTimer=clearInterval(this.loaderTimer)},750)},loadingAjax:function(){this.isCached||(this.loaderTimer=clearInterval(this.loaderTimer),b.Loader.loadObj.prc<50&&b.Loader.change(50))},loadingImages:function(){this.isCached||(this.loaderTimer=clearInterval(this.loaderTimer)),b.Loader.$loadElement=this.currentContent,b.Loader.loadingImages()},loadingEnd:function(){this.loaderTimer=clearInterval(this.loaderTimer),b.Loader.hide()}}}(sk,App,jQuery);
//# sourceMappingURL=app_002.map