!function(){tinymce.PluginManager.requireLangPack("jbimages"),tinymce.create("tinymce.plugins.jbImagesPlugin",{init:function(a,b){a.addCommand("jbImages",function(){var c=(new Date).getTime();a.windowManager.open({file:b+"/dialog.htm?z"+c,width:330+parseInt(a.getLang("jbimages.delta_width",0)),height:155+parseInt(a.getLang("jbimages.delta_height",0)),inline:1},{plugin_url:b})}),a.addButton("jbimages",{title:"jbimages.desc",cmd:"jbImages",image:b+"/img/jbimages-bw.gif"}),a.onNodeChange.add(function(a,b,c){b.setActive("jbimages","IMG"==c.nodeName)})},createControl:function(){return null},getInfo:function(){return{longname:"JustBoil.me Images Plugin",author:"Viktor Kuzhelnyi",authorurl:"http://justboil.me/",infourl:"http://justboil.me/",version:"2.3"}}}),tinymce.PluginManager.add("jbimages",tinymce.plugins.jbImagesPlugin)}();
//# sourceMappingURL=editor_plugin.map