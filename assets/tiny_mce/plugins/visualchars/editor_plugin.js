!function(){tinymce.create("tinymce.plugins.VisualChars",{init:function(a){var b=this;b.editor=a,a.addCommand("mceVisualChars",b._toggleVisualChars,b),a.addButton("visualchars",{title:"visualchars.desc",cmd:"mceVisualChars"}),a.onBeforeGetContent.add(function(a,c){b.state&&"raw"!=c.format&&!c.draft&&(b.state=!0,b._toggleVisualChars(!1))})},getInfo:function(){return{longname:"Visual characters",author:"Moxiecode Systems AB",authorurl:"http://tinymce.moxiecode.com",infourl:"http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/visualchars",version:tinymce.majorVersion+"."+tinymce.minorVersion}},_toggleVisualChars:function(a){var b,c,d,e,f,g=this,h=g.editor,i=(h.getDoc(),h.getBody()),j=h.selection;if(g.state=!g.state,h.controlManager.setActive("visualchars",g.state),a&&(f=j.getBookmark()),g.state)for(b=[],tinymce.walk(i,function(a){3==a.nodeType&&a.nodeValue&&-1!=a.nodeValue.indexOf(" ")&&b.push(a)},"childNodes"),c=0;c<b.length;c++){for(d=b[c].nodeValue,d=d.replace(/(\u00a0)/g,'<span data-mce-bogus="1" class="mceItemHidden mceItemNbsp">$1</span>'),e=h.dom.create("div",null,d);node=e.lastChild;)h.dom.insertAfter(node,b[c]);h.dom.remove(b[c])}else for(b=h.dom.select("span.mceItemNbsp",i),c=b.length-1;c>=0;c--)h.dom.remove(b[c],1);j.moveToBookmark(f)}}),tinymce.PluginManager.add("visualchars",tinymce.plugins.VisualChars)}();
//# sourceMappingURL=editor_plugin.map