function preinit(){var a;(a=tinyMCEPopup.getParam("external_link_list_url"))&&document.write('<script language="javascript" type="text/javascript" src="'+tinyMCEPopup.editor.documentBaseURI.toAbsolute(a)+'"></script>')}function changeClass(){var a=document.forms[0];a.classes.value=getSelectValue(a,"classlist")}function init(){tinyMCEPopup.resizeToInnerSize();var a,b=document.forms[0],c=tinyMCEPopup.editor,d=c.selection.getNode(),e="insert";if(document.getElementById("hrefbrowsercontainer").innerHTML=getBrowserHTML("hrefbrowser","href","file","advlink"),document.getElementById("popupurlbrowsercontainer").innerHTML=getBrowserHTML("popupurlbrowser","popupurl","file","advlink"),document.getElementById("targetlistcontainer").innerHTML=getTargetListHTML("targetlist","target"),a=getLinkListHTML("linklisthref","href"),""==a?document.getElementById("linklisthrefrow").style.display="none":document.getElementById("linklisthrefcontainer").innerHTML=a,a=getAnchorListHTML("anchorlist","href"),""==a?document.getElementById("anchorlistrow").style.display="none":document.getElementById("anchorlistcontainer").innerHTML=a,isVisible("hrefbrowser")&&(document.getElementById("href").style.width="260px"),isVisible("popupurlbrowser")&&(document.getElementById("popupurl").style.width="180px"),d=c.dom.getParent(d,"A"),null==d){var f=c.dom.create("p",null,c.selection.getContent());1===f.childNodes.length&&(d=f.firstChild)}if(null!=d&&"A"==d.nodeName&&(e="update"),b.insert.value=tinyMCEPopup.getLang(e,"Insert",!0),setPopupControlsDisabled(!0),"update"==e){var g=c.dom.getAttrib(d,"href"),h=c.dom.getAttrib(d,"onclick"),i=c.dom.getAttrib(d,"target")?c.dom.getAttrib(d,"target"):"_self";setFormValue("href",g),setFormValue("title",c.dom.getAttrib(d,"title")),setFormValue("id",c.dom.getAttrib(d,"id")),setFormValue("style",c.dom.getAttrib(d,"style")),setFormValue("rel",c.dom.getAttrib(d,"rel")),setFormValue("rev",c.dom.getAttrib(d,"rev")),setFormValue("charset",c.dom.getAttrib(d,"charset")),setFormValue("hreflang",c.dom.getAttrib(d,"hreflang")),setFormValue("dir",c.dom.getAttrib(d,"dir")),setFormValue("lang",c.dom.getAttrib(d,"lang")),setFormValue("tabindex",c.dom.getAttrib(d,"tabindex","undefined"!=typeof d.tabindex?d.tabindex:"")),setFormValue("accesskey",c.dom.getAttrib(d,"accesskey","undefined"!=typeof d.accesskey?d.accesskey:"")),setFormValue("type",c.dom.getAttrib(d,"type")),setFormValue("onfocus",c.dom.getAttrib(d,"onfocus")),setFormValue("onblur",c.dom.getAttrib(d,"onblur")),setFormValue("onclick",h),setFormValue("ondblclick",c.dom.getAttrib(d,"ondblclick")),setFormValue("onmousedown",c.dom.getAttrib(d,"onmousedown")),setFormValue("onmouseup",c.dom.getAttrib(d,"onmouseup")),setFormValue("onmouseover",c.dom.getAttrib(d,"onmouseover")),setFormValue("onmousemove",c.dom.getAttrib(d,"onmousemove")),setFormValue("onmouseout",c.dom.getAttrib(d,"onmouseout")),setFormValue("onkeypress",c.dom.getAttrib(d,"onkeypress")),setFormValue("onkeydown",c.dom.getAttrib(d,"onkeydown")),setFormValue("onkeyup",c.dom.getAttrib(d,"onkeyup")),setFormValue("target",i),setFormValue("classes",c.dom.getAttrib(d,"class")),null!=h&&-1!=h.indexOf("window.open")?parseWindowOpen(h):parseFunction(h),selectByValue(b,"dir",c.dom.getAttrib(d,"dir")),selectByValue(b,"rel",c.dom.getAttrib(d,"rel")),selectByValue(b,"rev",c.dom.getAttrib(d,"rev")),selectByValue(b,"linklisthref",g),"#"==g.charAt(0)&&selectByValue(b,"anchorlist",g),addClassesToList("classlist","advlink_styles"),selectByValue(b,"classlist",c.dom.getAttrib(d,"class"),!0),selectByValue(b,"targetlist",i,!0)}else addClassesToList("classlist","advlink_styles")}function checkPrefix(a){a.value&&Validator.isEmail(a)&&!/^\s*mailto:/i.test(a.value)&&confirm(tinyMCEPopup.getLang("advlink_dlg.is_email"))&&(a.value="mailto:"+a.value),/^\s*www\./i.test(a.value)&&confirm(tinyMCEPopup.getLang("advlink_dlg.is_external"))&&(a.value="http://"+a.value)}function setFormValue(a,b){document.forms[0].elements[a].value=b}function parseWindowOpen(a){var b=document.forms[0];-1!=a.indexOf("return false;")?(b.popupreturn.checked=!0,a=a.replace("return false;","")):b.popupreturn.checked=!1;var c=parseLink(a);if(null!=c){b.ispopup.checked=!0,setPopupControlsDisabled(!1);var d=parseOptions(c.options),e=c.url;b.popupname.value=c.target,b.popupurl.value=e,b.popupwidth.value=getOption(d,"width"),b.popupheight.value=getOption(d,"height"),b.popupleft.value=getOption(d,"left"),b.popuptop.value=getOption(d,"top"),-1!=b.popupleft.value.indexOf("screen")&&(b.popupleft.value="c"),-1!=b.popuptop.value.indexOf("screen")&&(b.popuptop.value="c"),b.popuplocation.checked="yes"==getOption(d,"location"),b.popupscrollbars.checked="yes"==getOption(d,"scrollbars"),b.popupmenubar.checked="yes"==getOption(d,"menubar"),b.popupresizable.checked="yes"==getOption(d,"resizable"),b.popuptoolbar.checked="yes"==getOption(d,"toolbar"),b.popupstatus.checked="yes"==getOption(d,"status"),b.popupdependent.checked="yes"==getOption(d,"dependent"),buildOnClick()}}function parseFunction(a){document.forms[0],parseLink(a)}function getOption(a,b){return"undefined"==typeof a[b]?"":a[b]}function setPopupControlsDisabled(a){var b=document.forms[0];b.popupname.disabled=a,b.popupurl.disabled=a,b.popupwidth.disabled=a,b.popupheight.disabled=a,b.popupleft.disabled=a,b.popuptop.disabled=a,b.popuplocation.disabled=a,b.popupscrollbars.disabled=a,b.popupmenubar.disabled=a,b.popupresizable.disabled=a,b.popuptoolbar.disabled=a,b.popupstatus.disabled=a,b.popupreturn.disabled=a,b.popupdependent.disabled=a,setBrowserDisabled("popupurlbrowser",a)}function parseLink(a){a=a.replace(new RegExp("&#39;","g"),"'");var b=a.replace(new RegExp("\\s*([A-Za-z0-9.]*)\\s*\\(.*","gi"),"$1"),c=templates[b];if(c){for(var d=c.match(new RegExp("'?\\$\\{[A-Za-z0-9.]*\\}'?","gi")),e="\\s*[A-Za-z0-9.]*\\s*\\(",f="",g=0;g<d.length;g++)e+=-1!=d[g].indexOf("'${")?"'(.*)'":"([0-9]*)",f+="$"+(g+1),d[g]=d[g].replace(new RegExp("[^A-Za-z0-9]","gi"),""),g!=d.length-1?(e+="\\s*,\\s*",f+="<delim>"):e+=".*";e+="\\);?";var h=[];h._function=b;for(var i=a.replace(new RegExp(e,"gi"),f).split("<delim>"),g=0;g<d.length;g++)h[d[g]]=i[g];return h}return null}function parseOptions(a){if(null==a||""==a)return[];a=a.toLowerCase(),a=a.replace(/;/g,","),a=a.replace(/[^0-9a-z=,]/g,"");for(var b=a.split(","),c=[],d=0;d<b.length;d++){var e=b[d].split("=");2==e.length&&(c[e[0]]=e[1])}return c}function buildOnClick(){var a=document.forms[0];if(!a.ispopup.checked)return void(a.onclick.value="");var b="window.open('",c=a.popupurl.value;b+=c+"','",b+=a.popupname.value+"','",a.popuplocation.checked&&(b+="location=yes,"),a.popupscrollbars.checked&&(b+="scrollbars=yes,"),a.popupmenubar.checked&&(b+="menubar=yes,"),a.popupresizable.checked&&(b+="resizable=yes,"),a.popuptoolbar.checked&&(b+="toolbar=yes,"),a.popupstatus.checked&&(b+="status=yes,"),a.popupdependent.checked&&(b+="dependent=yes,"),""!=a.popupwidth.value&&(b+="width="+a.popupwidth.value+","),""!=a.popupheight.value&&(b+="height="+a.popupheight.value+","),""!=a.popupleft.value&&(b+="c"!=a.popupleft.value?"left="+a.popupleft.value+",":"left='+(screen.availWidth/2-"+a.popupwidth.value/2+")+',"),""!=a.popuptop.value&&(b+="c"!=a.popuptop.value?"top="+a.popuptop.value+",":"top='+(screen.availHeight/2-"+a.popupheight.value/2+")+',"),","==b.charAt(b.length-1)&&(b=b.substring(0,b.length-1)),b+="');",a.popupreturn.checked&&(b+="return false;"),a.onclick.value=b,""==a.href.value&&(a.href.value=c)}function setAttrib(a,b,c){var d=document.forms[0],e=d.elements[b.toLowerCase()],f=tinyMCEPopup.editor.dom;("undefined"==typeof c||null==c)&&(c="",e&&(c=e.value)),"style"==b&&(c=f.serializeStyle(f.parseStyle(c),"a")),f.setAttrib(a,b,c)}function getAnchorListHTML(a,b){var c,d,e,f=tinyMCEPopup.editor,g=f.dom.select("a"),h="";for(d=0,e=g.length;e>d;d++)""!=(c=f.dom.getAttrib(g[d],"name"))&&(h+='<option value="#'+c+'">'+c+"</option>"),""==(c=g[d].id)||g[d].href||(h+='<option value="#'+c+'">'+c+"</option>");return""==h?"":h='<select id="'+a+'" name="'+a+'" class="mceAnchorList" onchange="this.form.'+b+'.value=this.options[this.selectedIndex].value"><option value="">---</option>'+h+"</select>"}function insertAction(){var a,b,c,d=tinyMCEPopup.editor;if(a=d.selection.getNode(),checkPrefix(document.forms[0].href),a=d.dom.getParent(a,"A"),!document.forms[0].href.value)return c=d.selection.getBookmark(),d.dom.remove(a,1),d.selection.moveToBookmark(c),tinyMCEPopup.execCommand("mceEndUndoLevel"),void tinyMCEPopup.close();if(null==a)for(d.getDoc().execCommand("unlink",!1,null),tinyMCEPopup.execCommand("mceInsertLink",!1,"#mce_temp_url#",{skip_undo:1}),b=tinymce.grep(d.dom.select("a"),function(a){return"#mce_temp_url#"==d.dom.getAttrib(a,"href")}),c=0;c<b.length;c++)setAllAttribs(a=b[c]);else setAllAttribs(a);(1!=a.childNodes.length||"IMG"!=a.firstChild.nodeName)&&(d.focus(),d.selection.select(a),d.selection.collapse(0),tinyMCEPopup.storeSelection()),tinyMCEPopup.execCommand("mceEndUndoLevel"),tinyMCEPopup.close()}function setAllAttribs(a){var b=document.forms[0],c=b.href.value.replace(/ /g,"%20"),d=getSelectValue(b,"targetlist");setAttrib(a,"href",c),setAttrib(a,"title"),setAttrib(a,"target","_self"==d?"":d),setAttrib(a,"id"),setAttrib(a,"style"),setAttrib(a,"class",getSelectValue(b,"classlist")),setAttrib(a,"rel"),setAttrib(a,"rev"),setAttrib(a,"charset"),setAttrib(a,"hreflang"),setAttrib(a,"dir"),setAttrib(a,"lang"),setAttrib(a,"tabindex"),setAttrib(a,"accesskey"),setAttrib(a,"type"),setAttrib(a,"onfocus"),setAttrib(a,"onblur"),setAttrib(a,"onclick"),setAttrib(a,"ondblclick"),setAttrib(a,"onmousedown"),setAttrib(a,"onmouseup"),setAttrib(a,"onmouseover"),setAttrib(a,"onmousemove"),setAttrib(a,"onmouseout"),setAttrib(a,"onkeypress"),setAttrib(a,"onkeydown"),setAttrib(a,"onkeyup"),tinyMCE.isMSIE5&&(a.outerHTML=a.outerHTML)}function getSelectValue(a,b){var c=a.elements[b];return c&&null!=c.options&&-1!=c.selectedIndex?c.options[c.selectedIndex].value:""}function getLinkListHTML(a,b,c){if("undefined"==typeof tinyMCELinkList||0==tinyMCELinkList.length)return"";var d="";d+='<select id="'+a+'" name="'+a+'"',d+=' class="mceLinkList" onchange="this.form.'+b+".value=",d+="this.options[this.selectedIndex].value;","undefined"!=typeof c&&(d+=c+"('"+b+"',this.options[this.selectedIndex].text,this.options[this.selectedIndex].value);"),d+='"><option value="">---</option>';for(var e=0;e<tinyMCELinkList.length;e++)d+='<option value="'+tinyMCELinkList[e][1]+'">'+tinyMCELinkList[e][0]+"</option>";return d+="</select>"}function getTargetListHTML(a,b){var c=tinyMCEPopup.getParam("theme_advanced_link_targets","").split(";"),d="";d+='<select id="'+a+'" name="'+a+'" onchange="this.form.'+b+".value=",d+='this.options[this.selectedIndex].value;">',d+='<option value="_self">'+tinyMCEPopup.getLang("advlink_dlg.target_same")+"</option>",d+='<option value="_blank">'+tinyMCEPopup.getLang("advlink_dlg.target_blank")+" (_blank)</option>",d+='<option value="_parent">'+tinyMCEPopup.getLang("advlink_dlg.target_parent")+" (_parent)</option>",d+='<option value="_top">'+tinyMCEPopup.getLang("advlink_dlg.target_top")+" (_top)</option>";for(var e=0;e<c.length;e++){var f,g;""!=c[e]&&(f=c[e].split("=")[0],g=c[e].split("=")[1],d+='<option value="'+f+'">'+g+" ("+f+")</option>")}return d+="</select>"}tinyMCEPopup.requireLangPack();var templates={"window.open":"window.open('${url}','${target}','${options}')"};preinit(),tinyMCEPopup.onInit.add(init);