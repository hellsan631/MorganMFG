tinyMCEPopup.requireLangPack();var TemplateDialog={preInit:function(){var a=tinyMCEPopup.getParam("template_external_list_url");null!=a&&document.write('<script language="javascript" type="text/javascript" src="'+tinyMCEPopup.editor.documentBaseURI.toAbsolute(a)+'"></script>')},init:function(){var a,b,c,d=tinyMCEPopup.editor;if(a=d.getParam("template_templates",!1),b=document.getElementById("tpath"),!a&&"undefined"!=typeof tinyMCETemplateList)for(c=0,a=[];c<tinyMCETemplateList.length;c++)a.push({title:tinyMCETemplateList[c][0],src:tinyMCETemplateList[c][1],description:tinyMCETemplateList[c][2]});for(c=0;c<a.length;c++)b.options[b.options.length]=new Option(a[c].title,tinyMCEPopup.editor.documentBaseURI.toAbsolute(a[c].src));this.resize(),this.tsrc=a},resize:function(){var a,b,c;self.innerWidth?(a=self.innerWidth-50,b=self.innerHeight-170):(a=document.body.clientWidth-50,b=document.body.clientHeight-160),c=document.getElementById("templatesrc"),c&&(c.style.height=Math.abs(b)+"px",c.style.width=Math.abs(a-5)+"px")},loadCSSFiles:function(a){var b=tinyMCEPopup.editor;tinymce.each(b.getParam("content_css","").split(","),function(c){a.write('<link href="'+b.documentBaseURI.toAbsolute(c)+'" rel="stylesheet" type="text/css" />')})},selectTemplate:function(a,b){var c,d=window.frames.templatesrc.document,e=this.tsrc;if(a)for(d.body.innerHTML=this.templateHTML=this.getFileContents(a),c=0;c<e.length;c++)e[c].title==b&&(document.getElementById("tmpldesc").innerHTML=e[c].description||"")},insert:function(){tinyMCEPopup.execCommand("mceInsertTemplate",!1,{content:this.templateHTML,selection:tinyMCEPopup.editor.selection.getContent()}),tinyMCEPopup.close()},getFileContents:function(a){function b(a){c=0;try{c=new ActiveXObject(a)}catch(a){}return c}var c,d="text/plain";return c=window.ActiveXObject?b("Msxml2.XMLHTTP")||b("Microsoft.XMLHTTP"):new XMLHttpRequest,c.overrideMimeType&&c.overrideMimeType(d),c.open("GET",a,!1),c.send(null),c.responseText}};TemplateDialog.preInit(),tinyMCEPopup.onInit.add(TemplateDialog.init,TemplateDialog);
//# sourceMappingURL=template.map