!function(){tinymce.create("tinymce.plugins.PageBreakPlugin",{init:function(a){var b,c='<img src="'+a.theme.url+'/img/trans.gif" class="mcePageBreak mceItemNoResize" />',d="mcePageBreak",e=a.getParam("pagebreak_separator","<!-- pagebreak -->");b=new RegExp(e.replace(/[\?\.\*\[\]\(\)\{\}\+\^\$\:]/g,function(a){return"\\"+a}),"g"),a.addCommand("mcePageBreak",function(){a.execCommand("mceInsertContent",0,c)}),a.addButton("pagebreak",{title:"pagebreak.desc",cmd:d}),a.onInit.add(function(){a.theme.onResolveName&&a.theme.onResolveName.add(function(b,c){"IMG"==c.node.nodeName&&a.dom.hasClass(c.node,d)&&(c.name="pagebreak")})}),a.onClick.add(function(a,b){b=b.target,"IMG"===b.nodeName&&a.dom.hasClass(b,d)&&a.selection.select(b)}),a.onNodeChange.add(function(a,b,c){b.setActive("pagebreak","IMG"===c.nodeName&&a.dom.hasClass(c,d))}),a.onBeforeSetContent.add(function(a,d){d.content=d.content.replace(b,c)}),a.onPostProcess.add(function(a,b){b.get&&(b.content=b.content.replace(/<img[^>]+>/g,function(a){return-1!==a.indexOf('class="mcePageBreak')&&(a=e),a}))})},getInfo:function(){return{longname:"PageBreak",author:"Moxiecode Systems AB",authorurl:"http://tinymce.moxiecode.com",infourl:"http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/pagebreak",version:tinymce.majorVersion+"."+tinymce.minorVersion}}}),tinymce.PluginManager.add("pagebreak",tinymce.plugins.PageBreakPlugin)}();