!function(){var a=tinymce.dom.Event,b=(tinymce.each,tinymce.DOM);tinymce.create("tinymce.plugins.ContextMenu",{init:function(b){function c(b,c){return f=0,c&&2==c.button?void(f=c.ctrlKey):void(h._menu&&(h._menu.removeAll(),h._menu.destroy(),a.remove(b.getDoc(),"click",g),h._menu=null))}var d,e,f,g,h=this;h.editor=b,e=b.settings.contextmenu_never_use_native,h.onContextMenu=new tinymce.util.Dispatcher(this),g=function(a){c(b,a)},d=b.onContextMenu.add(function(b,c){(0!==f?f:c.ctrlKey)&&!e||(a.cancel(c),"IMG"==c.target.nodeName&&b.selection.select(c.target),h._getMenu(b).showMenu(c.clientX||c.pageX,c.clientY||c.pageY),a.add(b.getDoc(),"click",g),b.nodeChanged())}),b.onRemove.add(function(){h._menu&&h._menu.removeAll()}),b.onMouseDown.add(c),b.onKeyDown.add(c),b.onKeyDown.add(function(b,c){!c.shiftKey||c.ctrlKey||c.altKey||121!==c.keyCode||(a.cancel(c),d(b,c))})},getInfo:function(){return{longname:"Contextmenu",author:"Moxiecode Systems AB",authorurl:"http://tinymce.moxiecode.com",infourl:"http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/contextmenu",version:tinymce.majorVersion+"."+tinymce.minorVersion}},_getMenu:function(a){var c,d,e=this,f=e._menu,g=a.selection,h=g.isCollapsed(),i=g.getNode()||a.getBody();return f&&(f.removeAll(),f.destroy()),d=b.getPos(a.getContentAreaContainer()),f=a.controlManager.createDropMenu("contextmenu",{offset_x:d.x+a.getParam("contextmenu_offset_x",0),offset_y:d.y+a.getParam("contextmenu_offset_y",0),constrain:1,keyboard_focus:!0}),e._menu=f,f.add({title:"advanced.cut_desc",icon:"cut",cmd:"Cut"}).setDisabled(h),f.add({title:"advanced.copy_desc",icon:"copy",cmd:"Copy"}).setDisabled(h),f.add({title:"advanced.paste_desc",icon:"paste",cmd:"Paste"}),("A"==i.nodeName&&!a.dom.getAttrib(i,"name")||!h)&&(f.addSeparator(),f.add({title:"advanced.link_desc",icon:"link",cmd:a.plugins.advlink?"mceAdvLink":"mceLink",ui:!0}),f.add({title:"advanced.unlink_desc",icon:"unlink",cmd:"UnLink"})),f.addSeparator(),f.add({title:"advanced.image_desc",icon:"image",cmd:a.plugins.advimage?"mceAdvImage":"mceImage",ui:!0}),f.addSeparator(),c=f.addMenu({title:"contextmenu.align"}),c.add({title:"contextmenu.left",icon:"justifyleft",cmd:"JustifyLeft"}),c.add({title:"contextmenu.center",icon:"justifycenter",cmd:"JustifyCenter"}),c.add({title:"contextmenu.right",icon:"justifyright",cmd:"JustifyRight"}),c.add({title:"contextmenu.full",icon:"justifyfull",cmd:"JustifyFull"}),e.onContextMenu.dispatch(e,f,i,h),f}}),tinymce.PluginManager.add("contextmenu",tinymce.plugins.ContextMenu)}();
//# sourceMappingURL=editor_plugin.map