!function(a){var b,c,d="autosave",e="restoredraft",f=!0,g=a.util.Dispatcher;a.create("tinymce.plugins.AutoSave",{init:function(h){function i(a){var b={s:1e3,m:6e4};return a=/^(\d+)([ms]?)$/.exec(""+a),(a[2]?b[a[2]]:1)*parseInt(a)}var j=this,k=h.settings;j.editor=h,a.each({ask_before_unload:f,interval:"30s",retention:"20m",minlength:50},function(a,c){c=d+"_"+c,k[c]===b&&(k[c]=a)}),k.autosave_interval=i(k.autosave_interval),k.autosave_retention=i(k.autosave_retention),h.addButton(e,{title:d+".restore_content",onclick:function(){h.getContent({draft:!0}).replace(/\s|&nbsp;|<\/?p[^>]*>|<br[^>]*>/gi,"").length>0?h.windowManager.confirm(d+".warning_message",function(a){a&&j.restoreDraft()}):j.restoreDraft()}}),h.onNodeChange.add(function(){var a=h.controlManager;a.get(e)&&a.setDisabled(e,!j.hasDraft())}),h.onInit.add(function(){h.controlManager.get(e)&&(j.setupStorage(h),setInterval(function(){h.removed||(j.storeDraft(),h.nodeChanged())},k.autosave_interval))}),j.onStoreDraft=new g(j),j.onRestoreDraft=new g(j),j.onRemoveDraft=new g(j),c||(window.onbeforeunload=a.plugins.AutoSave._beforeUnloadHandler,c=f)},getInfo:function(){return{longname:"Auto save",author:"Moxiecode Systems AB",authorurl:"http://tinymce.moxiecode.com",infourl:"http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/autosave",version:a.majorVersion+"."+a.minorVersion}},getExpDate:function(){return new Date((new Date).getTime()+this.editor.settings.autosave_retention).toUTCString()},setupStorage:function(b){var c=this,e=d+"_test",g="OK";c.key=d+b.id,a.each([function(){return localStorage&&(localStorage.setItem(e,g),localStorage.getItem(e)===g)?(localStorage.removeItem(e),localStorage):void 0},function(){return sessionStorage&&(sessionStorage.setItem(e,g),sessionStorage.getItem(e)===g)?(sessionStorage.removeItem(e),sessionStorage):void 0},function(){return a.isIE?(b.getElement().style.behavior="url('#default#userData')",{autoExpires:f,setItem:function(a,d){var e=b.getElement();e.setAttribute(a,d),e.expires=c.getExpDate();try{e.save("TinyMCE")}catch(f){}},getItem:function(a){var c=b.getElement();try{return c.load("TinyMCE"),c.getAttribute(a)}catch(d){return null}},removeItem:function(a){b.getElement().removeAttribute(a)}}):void 0}],function(a){try{if(c.storage=a(),c.storage)return!1}catch(b){}})},storeDraft:function(){var a,b,c=this,d=c.storage,e=c.editor;if(d){if(!d.getItem(c.key)&&!e.isDirty())return;b=e.getContent({draft:!0}),b.length>e.settings.autosave_minlength&&(a=c.getExpDate(),c.storage.autoExpires||c.storage.setItem(c.key+"_expires",a),c.storage.setItem(c.key,b),c.onStoreDraft.dispatch(c,{expires:a,content:b}))}},restoreDraft:function(){var a,b=this,c=b.storage;c&&(a=c.getItem(b.key),a&&(b.editor.setContent(a),b.onRestoreDraft.dispatch(b,{content:a})))},hasDraft:function(){var a,b,c=this,d=c.storage;if(d&&(b=!!d.getItem(c.key))){if(c.storage.autoExpires)return f;if(a=new Date(d.getItem(c.key+"_expires")),(new Date).getTime()<a.getTime())return f;c.removeDraft()}return!1},removeDraft:function(){var a,b=this,c=b.storage,d=b.key;c&&(a=c.getItem(d),c.removeItem(d),c.removeItem(d+"_expires"),a&&b.onRemoveDraft.dispatch(b,{content:a}))},"static":{_beforeUnloadHandler:function(){var b;return a.each(tinyMCE.editors,function(a){a.plugins.autosave&&a.plugins.autosave.storeDraft(),a.getParam("fullscreen_is_enabled")||!b&&a.isDirty()&&a.getParam("autosave_ask_before_unload")&&(b=a.getLang("autosave.unload_msg"))}),b}}}),a.PluginManager.add("autosave",a.plugins.AutoSave)}(tinymce);
//# sourceMappingURL=editor_plugin.map