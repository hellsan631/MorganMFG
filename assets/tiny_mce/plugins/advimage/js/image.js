var ImageDialog={preInit:function(){var a;tinyMCEPopup.requireLangPack(),(a=tinyMCEPopup.getParam("external_image_list_url"))&&document.write('<script language="javascript" type="text/javascript" src="'+tinyMCEPopup.editor.documentBaseURI.toAbsolute(a)+'"></script>')},init:function(a){var b=document.forms[0],c=b.elements,a=tinyMCEPopup.editor,d=a.dom,e=a.selection.getNode(),f=tinyMCEPopup.getParam("external_image_list","tinyMCEImageList");tinyMCEPopup.resizeToInnerSize(),this.fillClassList("class_list"),this.fillFileList("src_list",f),this.fillFileList("over_list",f),this.fillFileList("out_list",f),TinyMCE_EditableSelects.init(),"IMG"==e.nodeName&&(c.src.value=d.getAttrib(e,"src"),c.width.value=d.getAttrib(e,"width"),c.height.value=d.getAttrib(e,"height"),c.alt.value=d.getAttrib(e,"alt"),c.title.value=d.getAttrib(e,"title"),c.vspace.value=this.getAttrib(e,"vspace"),c.hspace.value=this.getAttrib(e,"hspace"),c.border.value=this.getAttrib(e,"border"),selectByValue(b,"align",this.getAttrib(e,"align")),selectByValue(b,"class_list",d.getAttrib(e,"class"),!0,!0),c.style.value=d.getAttrib(e,"style"),c.id.value=d.getAttrib(e,"id"),c.dir.value=d.getAttrib(e,"dir"),c.lang.value=d.getAttrib(e,"lang"),c.usemap.value=d.getAttrib(e,"usemap"),c.longdesc.value=d.getAttrib(e,"longdesc"),c.insert.value=a.getLang("update"),/^\s*this.src\s*=\s*\'([^\']+)\';?\s*$/.test(d.getAttrib(e,"onmouseover"))&&(c.onmouseoversrc.value=d.getAttrib(e,"onmouseover").replace(/^\s*this.src\s*=\s*\'([^\']+)\';?\s*$/,"$1")),/^\s*this.src\s*=\s*\'([^\']+)\';?\s*$/.test(d.getAttrib(e,"onmouseout"))&&(c.onmouseoutsrc.value=d.getAttrib(e,"onmouseout").replace(/^\s*this.src\s*=\s*\'([^\']+)\';?\s*$/,"$1")),a.settings.inline_styles&&(d.getAttrib(e,"align")&&this.updateStyle("align"),d.getAttrib(e,"hspace")&&this.updateStyle("hspace"),d.getAttrib(e,"border")&&this.updateStyle("border"),d.getAttrib(e,"vspace")&&this.updateStyle("vspace"))),document.getElementById("srcbrowsercontainer").innerHTML=getBrowserHTML("srcbrowser","src","image","theme_advanced_image"),isVisible("srcbrowser")&&(document.getElementById("src").style.width="260px"),document.getElementById("onmouseoversrccontainer").innerHTML=getBrowserHTML("overbrowser","onmouseoversrc","image","theme_advanced_image"),isVisible("overbrowser")&&(document.getElementById("onmouseoversrc").style.width="260px"),document.getElementById("onmouseoutsrccontainer").innerHTML=getBrowserHTML("outbrowser","onmouseoutsrc","image","theme_advanced_image"),isVisible("outbrowser")&&(document.getElementById("onmouseoutsrc").style.width="260px"),a.getParam("advimage_constrain_proportions",!0)&&(b.constrain.checked=!0),this.setSwapImage(c.onmouseoversrc.value||c.onmouseoutsrc.value?!0:!1),this.changeAppearance(),this.showPreviewImage(c.src.value,1)},insert:function(){var a=tinyMCEPopup.editor,b=this,c=document.forms[0];return""===c.src.value?("IMG"==a.selection.getNode().nodeName&&(a.dom.remove(a.selection.getNode()),a.execCommand("mceRepaint")),void tinyMCEPopup.close()):tinyMCEPopup.getParam("accessibility_warnings",1)&&!c.alt.value?void tinyMCEPopup.confirm(tinyMCEPopup.getLang("advimage_dlg.missing_alt"),function(a){a&&b.insertAndClose()}):void b.insertAndClose()},insertAndClose:function(){var a,b=tinyMCEPopup.editor,c=document.forms[0],d=c.elements,e={};tinyMCEPopup.restoreSelection(),tinymce.isWebKit&&b.getWin().focus(),e=b.settings.inline_styles?{vspace:"",hspace:"",border:"",align:""}:{vspace:d.vspace.value,hspace:d.hspace.value,border:d.border.value,align:getSelectValue(c,"align")},tinymce.extend(e,{src:d.src.value.replace(/ /g,"%20"),width:d.width.value,height:d.height.value,alt:d.alt.value,title:d.title.value,"class":getSelectValue(c,"class_list"),style:d.style.value,id:d.id.value,dir:d.dir.value,lang:d.lang.value,usemap:d.usemap.value,longdesc:d.longdesc.value}),e.onmouseover=e.onmouseout="",c.onmousemovecheck.checked&&(d.onmouseoversrc.value&&(e.onmouseover="this.src='"+d.onmouseoversrc.value+"';"),d.onmouseoutsrc.value&&(e.onmouseout="this.src='"+d.onmouseoutsrc.value+"';")),a=b.selection.getNode(),a&&"IMG"==a.nodeName?b.dom.setAttribs(a,e):(tinymce.each(e,function(a,b){""===a&&delete e[b]}),b.execCommand("mceInsertContent",!1,tinyMCEPopup.editor.dom.createHTML("img",e),{skip_undo:1}),b.undoManager.add()),tinyMCEPopup.editor.execCommand("mceRepaint"),tinyMCEPopup.editor.focus(),tinyMCEPopup.close()},getAttrib:function(a,b){var c,d,e=tinyMCEPopup.editor,f=e.dom;if(e.settings.inline_styles)switch(b){case"align":if(c=f.getStyle(a,"float"))return c;if(c=f.getStyle(a,"vertical-align"))return c;break;case"hspace":if(c=f.getStyle(a,"margin-left"),d=f.getStyle(a,"margin-right"),c&&c==d)return parseInt(c.replace(/[^0-9]/g,""));break;case"vspace":if(c=f.getStyle(a,"margin-top"),d=f.getStyle(a,"margin-bottom"),c&&c==d)return parseInt(c.replace(/[^0-9]/g,""));break;case"border":if(c=0,tinymce.each(["top","right","bottom","left"],function(b){return b=f.getStyle(a,"border-"+b+"-width"),!b||b!=c&&0!==c?(c=0,!1):void(b&&(c=b))}),c)return parseInt(c.replace(/[^0-9]/g,""))}return(c=f.getAttrib(a,b))?c:""},setSwapImage:function(a){var b=document.forms[0];b.onmousemovecheck.checked=a,setBrowserDisabled("overbrowser",!a),setBrowserDisabled("outbrowser",!a),b.over_list&&(b.over_list.disabled=!a),b.out_list&&(b.out_list.disabled=!a),b.onmouseoversrc.disabled=!a,b.onmouseoutsrc.disabled=!a},fillClassList:function(a){var b,c,d=tinyMCEPopup.dom,e=d.get(a);(b=tinyMCEPopup.getParam("theme_advanced_styles"))?(c=[],tinymce.each(b.split(";"),function(a){var b=a.split("=");c.push({title:b[0],"class":b[1]})})):c=tinyMCEPopup.editor.dom.getClasses(),c.length>0?(e.options.length=0,e.options[e.options.length]=new Option(tinyMCEPopup.getLang("not_set"),""),tinymce.each(c,function(a){e.options[e.options.length]=new Option(a.title||a["class"],a["class"])})):d.remove(d.getParent(a,"tr"))},fillFileList:function(a,b){var c=tinyMCEPopup.dom,d=c.get(a);b="function"==typeof b?b():window[b],d.options.length=0,b&&b.length>0?(d.options[d.options.length]=new Option("",""),tinymce.each(b,function(a){d.options[d.options.length]=new Option(a[0],a[1])})):c.remove(c.getParent(a,"tr"))},resetImageData:function(){var a=document.forms[0];a.elements.width.value=a.elements.height.value=""},updateImageData:function(a,b){var c=document.forms[0];b||(c.elements.width.value=a.width,c.elements.height.value=a.height),this.preloadImg=a},changeAppearance:function(){var a=tinyMCEPopup.editor,b=document.forms[0],c=document.getElementById("alignSampleImg");c&&(a.getParam("inline_styles")?a.dom.setAttrib(c,"style",b.style.value):(c.align=b.align.value,c.border=b.border.value,c.hspace=b.hspace.value,c.vspace=b.vspace.value))},changeHeight:function(){var a,b=document.forms[0],c=this;b.constrain.checked&&c.preloadImg&&""!=b.width.value&&""!=b.height.value&&(a=parseInt(b.width.value)/parseInt(c.preloadImg.width)*c.preloadImg.height,b.height.value=a.toFixed(0))},changeWidth:function(){var a,b=document.forms[0],c=this;b.constrain.checked&&c.preloadImg&&""!=b.width.value&&""!=b.height.value&&(a=parseInt(b.height.value)/parseInt(c.preloadImg.height)*c.preloadImg.width,b.width.value=a.toFixed(0))},updateStyle:function(a){var b,c,d,e,f=tinyMCEPopup.dom,g=tinymce.isIE,h=document.forms[0],i=f.create("img",{style:f.get("style").value});if(tinyMCEPopup.editor.settings.inline_styles){if("align"==a&&(f.setStyle(i,"float",""),f.setStyle(i,"vertical-align",""),e=getSelectValue(h,"align"),e&&("left"==e||"right"==e?f.setStyle(i,"float",e):i.style.verticalAlign=e)),"border"==a&&(b=i.style.border?i.style.border.split(" "):[],c=f.getStyle(i,"border-style"),d=f.getStyle(i,"border-color"),f.setStyle(i,"border",""),e=h.border.value,e||"0"==e))if("0"==e)i.style.border=g?"0":"0 none none";else{var j=tinymce.isIE&&(!document.documentMode||document.documentMode<9);3==b.length&&b[j?2:1]?c=b[j?2:1]:c&&"none"!=c||(c="solid"),3==b.length&&b[g?0:2]?d=b[j?0:2]:d&&"none"!=d||(d="black"),i.style.border=e+"px "+c+" "+d}"hspace"==a&&(f.setStyle(i,"marginLeft",""),f.setStyle(i,"marginRight",""),e=h.hspace.value,e&&(i.style.marginLeft=e+"px",i.style.marginRight=e+"px")),"vspace"==a&&(f.setStyle(i,"marginTop",""),f.setStyle(i,"marginBottom",""),e=h.vspace.value,e&&(i.style.marginTop=e+"px",i.style.marginBottom=e+"px")),f.get("style").value=f.serializeStyle(f.parseStyle(i.style.cssText),"img")}},changeMouseMove:function(){},showPreviewImage:function(a,b){return a?(!b&&tinyMCEPopup.getParam("advimage_update_dimensions_onchange",!0)&&this.resetImageData(),a=tinyMCEPopup.editor.documentBaseURI.toAbsolute(a),void(b?tinyMCEPopup.dom.setHTML("prev",'<img id="previewImg" src="'+a+'" border="0" onload="ImageDialog.updateImageData(this, 1);" />'):tinyMCEPopup.dom.setHTML("prev",'<img id="previewImg" src="'+a+'" border="0" onload="ImageDialog.updateImageData(this);" onerror="ImageDialog.resetImageData();" />'))):void tinyMCEPopup.dom.setHTML("prev","")}};ImageDialog.preInit(),tinyMCEPopup.onInit.add(ImageDialog.init,ImageDialog);