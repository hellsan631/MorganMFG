!function(){tinymce.create("tinymce.plugins.StylePlugin",{init:function(a,b){a.addCommand("mceStyleProps",function(){var c=!1,d=a.selection.getSelectedBlocks(),e=[];1===d.length?e.push(a.selection.getNode().style.cssText):(tinymce.each(d,function(b){e.push(a.dom.getAttrib(b,"style"))}),c=!0),a.windowManager.open({file:b+"/props.htm",width:480+parseInt(a.getLang("style.delta_width",0)),height:340+parseInt(a.getLang("style.delta_height",0)),inline:1},{applyStyleToBlocks:c,plugin_url:b,styles:e})}),a.addCommand("mceSetElementStyle",function(b,c){(e=a.selection.getNode())&&(a.dom.setAttrib(e,"style",c),a.execCommand("mceRepaint"))}),a.onNodeChange.add(function(a,b,c){b.setDisabled("styleprops","BODY"===c.nodeName)}),a.addButton("styleprops",{title:"style.desc",cmd:"mceStyleProps"})},getInfo:function(){return{longname:"Style",author:"Moxiecode Systems AB",authorurl:"http://tinymce.moxiecode.com",infourl:"http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/style",version:tinymce.majorVersion+"."+tinymce.minorVersion}}}),tinymce.PluginManager.add("style",tinymce.plugins.StylePlugin)}();