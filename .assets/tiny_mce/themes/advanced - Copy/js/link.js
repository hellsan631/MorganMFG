tinyMCEPopup.requireLangPack();var LinkDialog={preInit:function(){var a;(a=tinyMCEPopup.getParam("external_link_list_url"))&&document.write('<script language="javascript" type="text/javascript" src="'+tinyMCEPopup.editor.documentBaseURI.toAbsolute(a)+'"></script>')},init:function(){var a=document.forms[0],b=tinyMCEPopup.editor;document.getElementById("hrefbrowsercontainer").innerHTML=getBrowserHTML("hrefbrowser","href","file","theme_advanced_link"),isVisible("hrefbrowser")&&(document.getElementById("href").style.width="180px"),this.fillClassList("class_list"),this.fillFileList("link_list","tinyMCELinkList"),this.fillTargetList("target_list"),(e=b.dom.getParent(b.selection.getNode(),"A"))&&(a.href.value=b.dom.getAttrib(e,"href"),a.linktitle.value=b.dom.getAttrib(e,"title"),a.insert.value=b.getLang("update"),selectByValue(a,"link_list",a.href.value),selectByValue(a,"target_list",b.dom.getAttrib(e,"target")),selectByValue(a,"class_list",b.dom.getAttrib(e,"class")))},update:function(){var a,b,c=document.forms[0],d=tinyMCEPopup.editor,e=c.href.value.replace(/ /g,"%20");return tinyMCEPopup.restoreSelection(),a=d.dom.getParent(d.selection.getNode(),"A"),!c.href.value&&a?(b=d.selection.getBookmark(),d.dom.remove(a,1),d.selection.moveToBookmark(b),tinyMCEPopup.execCommand("mceEndUndoLevel"),void tinyMCEPopup.close()):(null==a?(d.getDoc().execCommand("unlink",!1,null),tinyMCEPopup.execCommand("mceInsertLink",!1,"#mce_temp_url#",{skip_undo:1}),tinymce.each(d.dom.select("a"),function(b){"#mce_temp_url#"==d.dom.getAttrib(b,"href")&&(a=b,d.dom.setAttribs(a,{href:e,title:c.linktitle.value,target:c.target_list?getSelectValue(c,"target_list"):null,"class":c.class_list?getSelectValue(c,"class_list"):null}))})):(d.dom.setAttribs(a,{href:e,title:c.linktitle.value}),c.target_list&&d.dom.setAttrib(a,"target",getSelectValue(c,"target_list")),c.class_list&&d.dom.setAttrib(a,"class",getSelectValue(c,"class_list"))),(1!=a.childNodes.length||"IMG"!=a.firstChild.nodeName)&&(d.focus(),d.selection.select(a),d.selection.collapse(0),tinyMCEPopup.storeSelection()),tinyMCEPopup.execCommand("mceEndUndoLevel"),void tinyMCEPopup.close())},checkPrefix:function(a){a.value&&Validator.isEmail(a)&&!/^\s*mailto:/i.test(a.value)&&confirm(tinyMCEPopup.getLang("advanced_dlg.link_is_email"))&&(a.value="mailto:"+a.value),/^\s*www\./i.test(a.value)&&confirm(tinyMCEPopup.getLang("advanced_dlg.link_is_external"))&&(a.value="http://"+a.value)},fillFileList:function(a,b){var c=tinyMCEPopup.dom,d=c.get(a);b=window[b],b&&b.length>0?(d.options[d.options.length]=new Option("",""),tinymce.each(b,function(a){d.options[d.options.length]=new Option(a[0],a[1])})):c.remove(c.getParent(a,"tr"))},fillClassList:function(a){var b,c,d=tinyMCEPopup.dom,e=d.get(a);(b=tinyMCEPopup.getParam("theme_advanced_styles"))?(c=[],tinymce.each(b.split(";"),function(a){var b=a.split("=");c.push({title:b[0],"class":b[1]})})):c=tinyMCEPopup.editor.dom.getClasses(),c.length>0?(e.options[e.options.length]=new Option(tinyMCEPopup.getLang("not_set"),""),tinymce.each(c,function(a){e.options[e.options.length]=new Option(a.title||a["class"],a["class"])})):d.remove(d.getParent(a,"tr"))},fillTargetList:function(a){var b,c=tinyMCEPopup.dom,d=c.get(a);d.options[d.options.length]=new Option(tinyMCEPopup.getLang("not_set"),""),d.options[d.options.length]=new Option(tinyMCEPopup.getLang("advanced_dlg.link_target_same"),"_self"),d.options[d.options.length]=new Option(tinyMCEPopup.getLang("advanced_dlg.link_target_blank"),"_blank"),(b=tinyMCEPopup.getParam("theme_advanced_link_targets"))&&tinymce.each(b.split(","),function(a){a=a.split("="),d.options[d.options.length]=new Option(a[0],a[1])})}};LinkDialog.preInit(),tinyMCEPopup.onInit.add(LinkDialog.init,LinkDialog);
//# sourceMappingURL=link.map