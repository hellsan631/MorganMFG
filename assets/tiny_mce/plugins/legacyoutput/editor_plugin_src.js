!function(a){a.onAddEditor.addToTop(function(a,b){b.settings.inline_styles=!1}),a.create("tinymce.plugins.LegacyOutput",{init:function(b){b.onInit.add(function(){var c="p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img",d=a.explode(b.settings.font_size_style_values),e=b.schema;b.formatter.register({alignleft:{selector:c,attributes:{align:"left"}},aligncenter:{selector:c,attributes:{align:"center"}},alignright:{selector:c,attributes:{align:"right"}},alignfull:{selector:c,attributes:{align:"justify"}},bold:[{inline:"b",remove:"all"},{inline:"strong",remove:"all"},{inline:"span",styles:{fontWeight:"bold"}}],italic:[{inline:"i",remove:"all"},{inline:"em",remove:"all"},{inline:"span",styles:{fontStyle:"italic"}}],underline:[{inline:"u",remove:"all"},{inline:"span",styles:{textDecoration:"underline"},exact:!0}],strikethrough:[{inline:"strike",remove:"all"},{inline:"span",styles:{textDecoration:"line-through"},exact:!0}],fontname:{inline:"font",attributes:{face:"%value"}},fontsize:{inline:"font",attributes:{size:function(b){return a.inArray(d,b.value)+1}}},forecolor:{inline:"font",attributes:{color:"%value"}},hilitecolor:{inline:"font",styles:{backgroundColor:"%value"}}}),a.each("b,i,u,strike".split(","),function(a){e.addValidElements(a+"[*]")}),e.getElementRule("font")||e.addValidElements("font[face|size|color|style]"),a.each(c.split(","),function(a){var b=e.getElementRule(a);b&&(b.attributes.align||(b.attributes.align={},b.attributesOrder.push("align")))}),b.onNodeChange.add(function(b,c){var e,f,g,h;f=b.dom.getParent(b.selection.getNode(),"font"),f&&(g=f.face,h=f.size),(e=c.get("fontselect"))&&e.select(function(a){return a==g}),(e=c.get("fontsizeselect"))&&e.select(function(b){var c=a.inArray(d,b.fontSize);return c+1==h})})})},getInfo:function(){return{longname:"LegacyOutput",author:"Moxiecode Systems AB",authorurl:"http://tinymce.moxiecode.com",infourl:"http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/legacyoutput",version:a.majorVersion+"."+a.minorVersion}}}),a.PluginManager.add("legacyoutput",a.plugins.LegacyOutput)}(tinymce);