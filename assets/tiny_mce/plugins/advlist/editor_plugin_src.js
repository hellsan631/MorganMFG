!function(){var a=tinymce.each;tinymce.create("tinymce.plugins.AdvListPlugin",{init:function(b){function c(b){var c=[];return a(b.split(/,/),function(a){c.push({title:"advlist."+("default"==a?"def":a.replace(/-/g,"_")),styles:{listStyleType:"default"==a?"":a}})}),c}var d=this;d.editor=b,d.numlist=b.getParam("advlist_number_styles")||c("default,lower-alpha,lower-greek,lower-roman,upper-alpha,upper-roman"),d.bullist=b.getParam("advlist_bullet_styles")||c("default,circle,disc,square"),tinymce.isIE&&/MSIE [2-7]/.test(navigator.userAgent)&&(d.isIE7=!0)},createControl:function(b,c){function d(b,c){var d=!0;return a(c.styles,function(a,c){return i.dom.getStyle(b,c)!=a?(d=!1,!1):void 0}),d}function e(){var a,c=i.dom,e=i.selection;a=c.getParent(e.getNode(),"ol,ul"),(!a||a.nodeName==("bullist"==b?"OL":"UL")||d(a,g))&&i.execCommand("bullist"==b?"InsertUnorderedList":"InsertOrderedList"),g&&(a=c.getParent(e.getNode(),"ol,ul"),a&&(c.setStyles(a,g.styles),a.removeAttribute("data-mce-style"))),i.focus()}var f,g,h=this,i=h.editor;return"numlist"==b||"bullist"==b?("advlist.def"==h[b][0].title&&(g=h[b][0]),f=c.createSplitButton(b,{title:"advanced."+b+"_desc","class":"mce_"+b,onclick:function(){e()}}),f.onRenderMenu.add(function(c,f){f.onHideMenu.add(function(){h.bookmark&&(i.selection.moveToBookmark(h.bookmark),h.bookmark=0)}),f.onShowMenu.add(function(){var c,e=i.dom,j=e.getParent(i.selection.getNode(),"ol,ul");(j||g)&&(c=h[b],a(f.items,function(b){var e=!0;b.setSelected(0),j&&!b.isDisabled()&&(a(c,function(a){return a.id!=b.id||d(j,a)?void 0:(e=!1,!1)}),e&&b.setSelected(1))}),j||f.items[g.id].setSelected(1)),i.focus(),tinymce.isIE&&(h.bookmark=i.selection.getBookmark(1))}),f.add({id:i.dom.uniqueId(),title:"advlist.types","class":"mceMenuItemTitle",titleItem:!0}).setDisabled(1),a(h[b],function(a){h.isIE7&&"lower-greek"==a.styles.listStyleType||(a.id=i.dom.uniqueId(),f.add({id:a.id,title:a.title,onclick:function(){g=a,e()}}))})}),f):void 0},getInfo:function(){return{longname:"Advanced lists",author:"Moxiecode Systems AB",authorurl:"http://tinymce.moxiecode.com",infourl:"http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/advlist",version:tinymce.majorVersion+"."+tinymce.minorVersion}}}),tinymce.PluginManager.add("advlist",tinymce.plugins.AdvListPlugin)}();
//# sourceMappingURL=editor_plugin_src.map