!function(a){function b(a,b){function c(a){return a.replace(/%(\w+)/g,"")}var d,e,f,h=a.dom,i="";return previewStyles=a.settings.preview_styles,previewStyles===!1?"":(previewStyles||(previewStyles="font-family font-size font-weight text-decoration text-transform color background-color"),d=b.block||b.inline||"span",e=h.create(d),g(b.styles,function(a,b){a=c(a),a&&h.setStyle(e,b,a)}),g(b.attributes,function(a,b){a=c(a),a&&h.setAttrib(e,b,a)}),g(b.classes,function(a){a=c(a),h.hasClass(e,a)||h.addClass(e,a)}),h.setStyles(e,{position:"absolute",left:-65535}),a.getBody().appendChild(e),f=h.getStyle(a.getBody(),"fontSize",!0),f=/px$/.test(f)?parseInt(f,10):0,g(previewStyles.split(" "),function(b){var c=h.getStyle(e,b,!0);if("background-color"!=b||!/transparent|rgba\s*\([^)]+,\s*0\)/.test(c)||(c=h.getStyle(a.getBody(),b,!0),"#ffffff"!=h.toHex(c).toLowerCase())){if("font-size"==b&&/em|%$/.test(c)){if(0===f)return;c=parseFloat(c,10)/(/%$/.test(c)?100:1),c=c*f+"px"}i+=b+":"+c+";"}}),h.remove(e),i)}var c,d=a.DOM,e=a.dom.Event,f=a.extend,g=a.each,h=a.util.Cookie,i=a.explode;a.ThemeManager.requireLangPack("advanced"),a.create("tinymce.themes.AdvancedTheme",{sizes:[8,10,12,14,18,24,36],controls:{bold:["bold_desc","Bold"],italic:["italic_desc","Italic"],underline:["underline_desc","Underline"],strikethrough:["striketrough_desc","Strikethrough"],justifyleft:["justifyleft_desc","JustifyLeft"],justifycenter:["justifycenter_desc","JustifyCenter"],justifyright:["justifyright_desc","JustifyRight"],justifyfull:["justifyfull_desc","JustifyFull"],bullist:["bullist_desc","InsertUnorderedList"],numlist:["numlist_desc","InsertOrderedList"],outdent:["outdent_desc","Outdent"],indent:["indent_desc","Indent"],cut:["cut_desc","Cut"],copy:["copy_desc","Copy"],paste:["paste_desc","Paste"],undo:["undo_desc","Undo"],redo:["redo_desc","Redo"],link:["link_desc","mceLink"],unlink:["unlink_desc","unlink"],image:["image_desc","mceImage"],cleanup:["cleanup_desc","mceCleanup"],help:["help_desc","mceHelp"],code:["code_desc","mceCodeEditor"],hr:["hr_desc","InsertHorizontalRule"],removeformat:["removeformat_desc","RemoveFormat"],sub:["sub_desc","subscript"],sup:["sup_desc","superscript"],forecolor:["forecolor_desc","ForeColor"],forecolorpicker:["forecolor_desc","mceForeColor"],backcolor:["backcolor_desc","HiliteColor"],backcolorpicker:["backcolor_desc","mceBackColor"],charmap:["charmap_desc","mceCharMap"],visualaid:["visualaid_desc","mceToggleVisualAid"],anchor:["anchor_desc","mceInsertAnchor"],newdocument:["newdocument_desc","mceNewDocument"],blockquote:["blockquote_desc","mceBlockQuote"]},stateControls:["bold","italic","underline","strikethrough","bullist","numlist","justifyleft","justifycenter","justifyright","justifyfull","sub","sup","blockquote"],init:function(b,c){var e,h,i,j=this;j.editor=b,j.url=c,j.onResolveName=new a.util.Dispatcher(this),e=b.settings,b.forcedHighContrastMode=b.settings.detect_highcontrast&&j._isHighContrast(),b.settings.skin=b.forcedHighContrastMode?"highcontrast":b.settings.skin,e.theme_advanced_buttons1||(e=f({theme_advanced_buttons1:"bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect",theme_advanced_buttons2:"bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code",theme_advanced_buttons3:"hr,removeformat,visualaid,|,sub,sup,|,charmap"},e)),j.settings=e=f({theme_advanced_path:!0,theme_advanced_toolbar_location:"top",theme_advanced_blockformats:"p,address,pre,h1,h2,h3,h4,h5,h6",theme_advanced_toolbar_align:"left",theme_advanced_statusbar_location:"bottom",theme_advanced_fonts:"Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats",theme_advanced_more_colors:1,theme_advanced_row_height:23,theme_advanced_resize_horizontal:1,theme_advanced_resizing_use_cookie:1,theme_advanced_font_sizes:"1,2,3,4,5,6,7",theme_advanced_font_selector:"span",theme_advanced_show_current_color:0,readonly:b.settings.readonly},e),e.font_size_style_values||(e.font_size_style_values="8pt,10pt,12pt,14pt,18pt,24pt,36pt"),a.is(e.theme_advanced_font_sizes,"string")&&(e.font_size_style_values=a.explode(e.font_size_style_values),e.font_size_classes=a.explode(e.font_size_classes||""),i={},b.settings.theme_advanced_font_sizes=e.theme_advanced_font_sizes,g(b.getParam("theme_advanced_font_sizes","","hash"),function(a,b){var c;b==a&&a>=1&&7>=a&&(b=a+" ("+j.sizes[a-1]+"pt)",c=e.font_size_classes[a-1],a=e.font_size_style_values[a-1]||j.sizes[a-1]+"pt"),/^\s*\./.test(a)&&(c=a.replace(/\./g,"")),i[b]=c?{"class":c}:{fontSize:a}}),e.theme_advanced_font_sizes=i),(h=e.theme_advanced_path_location)&&"none"!=h&&(e.theme_advanced_statusbar_location=e.theme_advanced_path_location),"none"==e.theme_advanced_statusbar_location&&(e.theme_advanced_statusbar_location=0),b.settings.content_css!==!1&&b.contentCSS.push(b.baseURI.toAbsolute(c+"/skins/"+b.settings.skin+"/content.css")),b.onInit.add(function(){b.settings.readonly||(b.onNodeChange.add(j._nodeChanged,j),b.onKeyUp.add(j._updateUndoStatus,j),b.onMouseUp.add(j._updateUndoStatus,j),b.dom.bind(b.dom.getRoot(),"dragend",function(){j._updateUndoStatus(b)}))}),b.onSetProgressState.add(function(a,b,c){var e,f,g=a.id;b?j.progressTimer=setTimeout(function(){e=a.getContainer(),e=e.insertBefore(d.create("DIV",{style:"position:relative"}),e.firstChild),f=d.get(a.id+"_tbl"),d.add(e,"div",{id:g+"_blocker","class":"mceBlocker",style:{width:f.clientWidth+2,height:f.clientHeight+2}}),d.add(e,"div",{id:g+"_progress","class":"mceProgress",style:{left:f.clientWidth/2,top:f.clientHeight/2}})},c||0):(d.remove(g+"_blocker"),d.remove(g+"_progress"),clearTimeout(j.progressTimer))}),d.loadCSS(e.editor_css?b.documentBaseURI.toAbsolute(e.editor_css):c+"/skins/"+b.settings.skin+"/ui.css"),e.skin_variant&&d.loadCSS(c+"/skins/"+b.settings.skin+"/ui_"+e.skin_variant+".css")},_isHighContrast:function(){var a,b=d.add(d.getRoot(),"div",{style:"background-color: rgb(171,239,86);"});return a=(d.getStyle(b,"background-color",!0)+"").toLowerCase().replace(/ /g,""),d.remove(b),"rgb(171,239,86)"!=a&&"#abef56"!=a},createControl:function(a,b){var c,d;if(d=b.createControl(a))return d;switch(a){case"styleselect":return this._createStyleSelect();case"formatselect":return this._createBlockFormats();case"fontselect":return this._createFontSelect();case"fontsizeselect":return this._createFontSizeSelect();case"forecolor":return this._createForeColorMenu();case"backcolor":return this._createBackColorMenu()}return(c=this.controls[a])?b.createButton(a,{title:"advanced."+c[0],cmd:c[1],ui:c[2],value:c[3]}):void 0},execCommand:function(a,b,c){var d=this["_"+a];return d?(d.call(this,b,c),!0):!1},_importClasses:function(){var a=this.editor,c=a.controlManager.get("styleselect");0==c.getLength()&&g(a.dom.getClasses(),function(d,e){var f,g="style_"+e;f={inline:"span",attributes:{"class":d["class"]},selector:"*"},a.formatter.register(g,f),c.add(d["class"],g,{style:function(){return b(a,f)}})})},_createStyleSelect:function(){var c,d=this,f=d.editor,h=f.controlManager;return c=h.createListBox("styleselect",{title:"advanced.style_select",onselect:function(b){var d,e,h=[];return g(c.items,function(a){h.push(a.value)}),f.focus(),f.undoManager.add(),d=f.formatter.matchAll(h),a.each(d,function(a){b&&a!=b||(a&&f.formatter.remove(a),e=!0)}),e||f.formatter.apply(b),f.undoManager.add(),f.nodeChanged(),!1}}),f.onPreInit.add(function(){var a=0,e=f.getParam("style_formats");e?g(e,function(d){var e,h=0;g(d,function(){h++}),h>1?(e=d.name=d.name||"style_"+a++,f.formatter.register(e,d),c.add(d.title,e,{style:function(){return b(f,d)}})):c.add(d.title)}):g(f.getParam("theme_advanced_styles","","hash"),function(e,g){var h,i;e&&(h="style_"+a++,i={inline:"span",classes:e,selector:"*"},f.formatter.register(h,i),c.add(d.editor.translate(g),h,{style:function(){return b(f,i)}}))})}),0==c.getLength()&&c.onPostRender.add(function(a,b){c.NativeListBox?e.add(b.id,"focus",d._importClasses,d):(e.add(b.id+"_text","focus",d._importClasses,d),e.add(b.id+"_text","mousedown",d._importClasses,d),e.add(b.id+"_open","focus",d._importClasses,d),e.add(b.id+"_open","mousedown",d._importClasses,d))}),c},_createFontSelect:function(){var a,b=this,c=b.editor;return a=c.controlManager.createListBox("fontselect",{title:"advanced.fontdefault",onselect:function(b){var d=a.items[a.selectedIndex];return!b&&d?void c.execCommand("FontName",!1,d.value):(c.execCommand("FontName",!1,b),a.select(function(a){return b==a}),d&&d.value==b&&a.select(null),!1)}}),a&&g(c.getParam("theme_advanced_fonts",b.settings.theme_advanced_fonts,"hash"),function(b,d){a.add(c.translate(d),b,{style:-1==b.indexOf("dings")?"font-family:"+b:""})}),a},_createFontSizeSelect:function(){var a,b=this,c=b.editor,d=0;return a=c.controlManager.createListBox("fontsizeselect",{title:"advanced.font_size",onselect:function(b){var d=a.items[a.selectedIndex];return!b&&d?(d=d.value,void(d["class"]?(c.formatter.toggle("fontsize_class",{value:d["class"]}),c.undoManager.add(),c.nodeChanged()):c.execCommand("FontSize",!1,d.fontSize))):(b["class"]?(c.focus(),c.undoManager.add(),c.formatter.toggle("fontsize_class",{value:b["class"]}),c.undoManager.add(),c.nodeChanged()):c.execCommand("FontSize",!1,b.fontSize),a.select(function(a){return b==a}),d&&(d.value.fontSize==b.fontSize||d.value["class"]&&d.value["class"]==b["class"])&&a.select(null),!1)}}),a&&g(b.settings.theme_advanced_font_sizes,function(c,e){var f=c.fontSize;f>=1&&7>=f&&(f=b.sizes[parseInt(f)-1]+"pt"),a.add(e,c,{style:"font-size:"+f,"class":"mceFontSize"+d++ +(" "+(c["class"]||""))})}),a},_createBlockFormats:function(){var a,c={p:"advanced.paragraph",address:"advanced.address",pre:"advanced.pre",h1:"advanced.h1",h2:"advanced.h2",h3:"advanced.h3",h4:"advanced.h4",h5:"advanced.h5",h6:"advanced.h6",div:"advanced.div",blockquote:"advanced.blockquote",code:"advanced.code",dt:"advanced.dt",dd:"advanced.dd",samp:"advanced.samp"},d=this;return a=d.editor.controlManager.createListBox("formatselect",{title:"advanced.block",onselect:function(a){return d.editor.execCommand("FormatBlock",!1,a),!1}}),a&&g(d.editor.getParam("theme_advanced_blockformats",d.settings.theme_advanced_blockformats,"hash"),function(e,f){a.add(d.editor.translate(f!=e?f:c[e]),e,{"class":"mce_formatPreview mce_"+e,style:function(){return b(d.editor,{block:e})}})}),a},_createForeColorMenu:function(){var a,b,c=this,d=c.settings,e={};return d.theme_advanced_more_colors&&(e.more_colors_func=function(){c._mceColorPicker(0,{color:a.value,func:function(b){a.setColor(b)}})}),(b=d.theme_advanced_text_colors)&&(e.colors=b),d.theme_advanced_default_foreground_color&&(e.default_color=d.theme_advanced_default_foreground_color),e.title="advanced.forecolor_desc",e.cmd="ForeColor",e.scope=this,a=c.editor.controlManager.createColorSplitButton("forecolor",e)},_createBackColorMenu:function(){var a,b,c=this,d=c.settings,e={};return d.theme_advanced_more_colors&&(e.more_colors_func=function(){c._mceColorPicker(0,{color:a.value,func:function(b){a.setColor(b)}})}),(b=d.theme_advanced_background_colors)&&(e.colors=b),d.theme_advanced_default_background_color&&(e.default_color=d.theme_advanced_default_background_color),e.title="advanced.backcolor_desc",e.cmd="HiliteColor",e.scope=this,a=c.editor.controlManager.createColorSplitButton("backcolor",e)},renderUI:function(b){var c,f,h,i,j,k,l=this,m=l.editor,n=l.settings;switch(m.settings&&(m.settings.aria_label=n.aria_label+m.getLang("advanced.help_shortcut")),c=j=d.create("span",{role:"application","aria-labelledby":m.id+"_voice",id:m.id+"_parent","class":"mceEditor "+m.settings.skin+"Skin"+(n.skin_variant?" "+m.settings.skin+"Skin"+l._ufirst(n.skin_variant):"")+("rtl"==m.settings.directionality?" mceRtl":"")}),d.add(c,"span",{"class":"mceVoiceLabel",style:"display:none;",id:m.id+"_voice"},n.aria_label),d.boxModel||(c=d.add(c,"div",{"class":"mceOldBoxModel"})),c=i=d.add(c,"table",{role:"presentation",id:m.id+"_tbl","class":"mceLayout",cellSpacing:0,cellPadding:0}),c=h=d.add(c,"tbody"),(n.theme_advanced_layout_manager||"").toLowerCase()){case"rowlayout":f=l._rowLayout(n,h,b);break;case"customlayout":f=m.execCallback("theme_advanced_custom_layout",n,h,b,j);break;default:f=l._simpleLayout(n,h,b,j)}return c=b.targetNode,k=i.rows,d.addClass(k[0],"mceFirst"),d.addClass(k[k.length-1],"mceLast"),g(d.select("tr",h),function(a){d.addClass(a.firstChild,"mceFirst"),d.addClass(a.childNodes[a.childNodes.length-1],"mceLast")}),d.get(n.theme_advanced_toolbar_container)?d.get(n.theme_advanced_toolbar_container).appendChild(j):d.insertAfter(j,c),e.add(m.id+"_path_row","click",function(a){return a=a.target,"A"==a.nodeName?(l._sel(a.className.replace(/^.*mcePath_([0-9]+).*$/,"$1")),!1):void 0}),m.getParam("accessibility_focus")||e.add(d.add(j,"a",{href:"#"},"<!-- IE -->"),"focus",function(){tinyMCE.get(m.id).focus()}),"external"==n.theme_advanced_toolbar_location&&(b.deltaHeight=0),l.deltaHeight=b.deltaHeight,b.targetNode=null,m.onKeyDown.add(function(b,c){var f=121,g=122;if(c.altKey){if(c.keyCode===f)return a.isWebKit&&window.focus(),l.toolbarGroup.focus(),e.cancel(c);if(c.keyCode===g)return d.get(b.id+"_path_row").focus(),e.cancel(c)}}),m.addShortcut("alt+0","","mceShortcuts",l),{iframeContainer:f,editorContainer:m.id+"_parent",sizeContainer:i,deltaHeight:b.deltaHeight}},getInfo:function(){return{longname:"Advanced theme",author:"Moxiecode Systems AB",authorurl:"http://tinymce.moxiecode.com",version:a.majorVersion+"."+a.minorVersion}},resizeBy:function(a,b){var c=d.get(this.editor.id+"_ifr");this.resizeTo(c.clientWidth+a,c.clientHeight+b)},resizeTo:function(a,b,c){var e=this.editor,f=this.settings,g=d.get(e.id+"_tbl"),i=d.get(e.id+"_ifr");a=Math.max(f.theme_advanced_resizing_min_width||100,a),b=Math.max(f.theme_advanced_resizing_min_height||100,b),a=Math.min(f.theme_advanced_resizing_max_width||65535,a),b=Math.min(f.theme_advanced_resizing_max_height||65535,b),d.setStyle(g,"height",""),d.setStyle(i,"height",b),f.theme_advanced_resize_horizontal&&(d.setStyle(g,"width",""),d.setStyle(i,"width",a),a<g.clientWidth&&(a=g.clientWidth,d.setStyle(i,"width",g.clientWidth))),c&&f.theme_advanced_resizing_use_cookie&&h.setHash("TinyMCE_"+e.id+"_size",{cw:a,ch:b})},destroy:function(){var a=this.editor.id;e.clear(a+"_resize"),e.clear(a+"_path_row"),e.clear(a+"_external_close")},_simpleLayout:function(a,b,f,g){var h,i,j,k,l=this,m=l.editor,n=a.theme_advanced_toolbar_location,o=a.theme_advanced_statusbar_location;return a.readonly?(h=d.add(b,"tr"),h=i=d.add(h,"td",{"class":"mceIframeContainer"}),i):("top"==n&&l._addToolbars(b,f),"external"==n&&(h=k=d.create("div",{style:"position:relative"}),h=d.add(h,"div",{id:m.id+"_external","class":"mceExternalToolbar"}),d.add(h,"a",{id:m.id+"_external_close",href:"javascript:;","class":"mceExternalClose"}),h=d.add(h,"table",{id:m.id+"_tblext",cellSpacing:0,cellPadding:0}),j=d.add(h,"tbody"),"mceOldBoxModel"==g.firstChild.className?g.firstChild.appendChild(k):g.insertBefore(k,g.firstChild),l._addToolbars(j,f),m.onMouseUp.add(function(){var a=d.get(m.id+"_external");d.show(a),d.hide(c);var b=e.add(m.id+"_external_close","click",function(){return d.hide(m.id+"_external"),e.remove(m.id+"_external_close","click",b),!1});d.show(a),d.setStyle(a,"top",0-d.getRect(m.id+"_tblext").h-1),d.hide(a),d.show(a),a.style.filter="",c=m.id+"_external",a=null})),"top"==o&&l._addStatusBar(b,f),a.theme_advanced_toolbar_container||(h=d.add(b,"tr"),h=i=d.add(h,"td",{"class":"mceIframeContainer"})),"bottom"==n&&l._addToolbars(b,f),"bottom"==o&&l._addStatusBar(b,f),i)},_rowLayout:function(a,b,c){var e,f,h,j,k,l,m=this,n=m.editor,o=n.controlManager;return e=a.theme_advanced_containers_default_class||"",f=a.theme_advanced_containers_default_align||"center",g(i(a.theme_advanced_containers||""),function(g,i){var n=a["theme_advanced_container_"+g]||"";switch(g.toLowerCase()){case"mceeditor":h=d.add(b,"tr"),h=j=d.add(h,"td",{"class":"mceIframeContainer"});break;case"mceelementpath":m._addStatusBar(b,c);break;default:l=(a["theme_advanced_container_"+g+"_align"]||f).toLowerCase(),l="mce"+m._ufirst(l),h=d.add(d.add(b,"tr"),"td",{"class":"mceToolbar "+(a["theme_advanced_container_"+g+"_class"]||e)+" "+l||f}),k=o.createToolbar("toolbar"+i),m._addControls(n,k),d.setHTML(h,k.renderHTML()),c.deltaHeight-=a.theme_advanced_row_height}}),j},_addControls:function(a,b){var c,d=this,e=d.settings,f=d.editor.controlManager;e.theme_advanced_disable&&!d._disabled?(c={},g(i(e.theme_advanced_disable),function(a){c[a]=1}),d._disabled=c):c=d._disabled,g(i(a),function(a){var e;if(!c||!c[a]){if("tablecontrols"==a)return void g(["table","|","row_props","cell_props","|","row_before","row_after","delete_row","|","col_before","col_after","delete_col","|","split_cells","merge_cells"],function(a){a=d.createControl(a,f),a&&b.add(a)});e=d.createControl(a,f),e&&b.add(e)}})},_addToolbars:function(a,b){var c,e,f,g,h,i,j=this,k=j.editor,l=j.settings,m=k.controlManager,n=[],o=!1;for(i=m.createToolbarGroup("toolbargroup",{name:k.getLang("advanced.toolbar"),tab_focus_toolbar:k.getParam("theme_advanced_tab_focus_toolbar")}),j.toolbarGroup=i,h=l.theme_advanced_toolbar_align.toLowerCase(),h="mce"+j._ufirst(h),g=d.add(d.add(a,"tr",{role:"presentation"}),"td",{"class":"mceToolbar "+h,role:"toolbar"}),c=1;f=l["theme_advanced_buttons"+c];c++)o=!0,e=m.createToolbar("toolbar"+c,{"class":"mceToolbarRow"+c}),l["theme_advanced_buttons"+c+"_add"]&&(f+=","+l["theme_advanced_buttons"+c+"_add"]),l["theme_advanced_buttons"+c+"_add_before"]&&(f=l["theme_advanced_buttons"+c+"_add_before"]+","+f),j._addControls(f,e),i.add(e),b.deltaHeight-=l.theme_advanced_row_height;o||(b.deltaHeight-=l.theme_advanced_row_height),n.push(i.renderHTML()),n.push(d.createHTML("a",{href:"#",accesskey:"z",title:k.getLang("advanced.toolbar_focus"),onfocus:"tinyMCE.getInstanceById('"+k.id+"').focus();"},"<!-- IE -->")),d.setHTML(g,n.join(""))},_addStatusBar:function(a,b){var c,f,g=this,i=g.editor,j=g.settings;c=d.add(a,"tr"),c=f=d.add(c,"td",{"class":"mceStatusbar"}),c=d.add(c,"div",{id:i.id+"_path_row",role:"group","aria-labelledby":i.id+"_path_voice"}),j.theme_advanced_path?(d.add(c,"span",{id:i.id+"_path_voice"},i.translate("advanced.path")),d.add(c,"span",{},": ")):d.add(c,"span",{},"&#160;"),j.theme_advanced_resizing&&(d.add(f,"a",{id:i.id+"_resize",href:"javascript:;",onclick:"return false;","class":"mceResize",tabIndex:"-1"}),j.theme_advanced_resizing_use_cookie&&i.onPostRender.add(function(){{var a=h.getHash("TinyMCE_"+i.id+"_size");d.get(i.id+"_tbl")}a&&g.resizeTo(a.cw,a.ch)}),i.onPostRender.add(function(){e.add(i.id+"_resize","click",function(a){a.preventDefault()}),e.add(i.id+"_resize","mousedown",function(a){function b(a){a.preventDefault(),p=n+(a.screenX-l),q=o+(a.screenY-m),g.resizeTo(p,q)}function c(a){e.remove(d.doc,"mousemove",f),e.remove(i.getDoc(),"mousemove",h),e.remove(d.doc,"mouseup",j),e.remove(i.getDoc(),"mouseup",k),p=n+(a.screenX-l),q=o+(a.screenY-m),g.resizeTo(p,q,!0),i.nodeChanged()}var f,h,j,k,l,m,n,o,p,q,r;a.preventDefault(),l=a.screenX,m=a.screenY,r=d.get(g.editor.id+"_ifr"),n=p=r.clientWidth,o=q=r.clientHeight,f=e.add(d.doc,"mousemove",b),h=e.add(i.getDoc(),"mousemove",b),j=e.add(d.doc,"mouseup",c),k=e.add(i.getDoc(),"mouseup",c)})})),b.deltaHeight-=21,c=a=null},_updateUndoStatus:function(a){var b=a.controlManager,c=a.undoManager;b.setDisabled("undo",!c.hasUndo()&&!c.typing),b.setDisabled("redo",!c.hasRedo())},_nodeChanged:function(b,c,e,f,h){function i(a){var b,c=h.parents,d=a;for("string"==typeof a&&(d=function(b){return b.nodeName==a}),b=0;b<c.length;b++)if(d(c[b]))return c[b]}function j(a,b){(m=c.get(a))&&(b||(b=m.settings.default_color),b!==m.value&&m.displayColor(b))}function j(a,b){(m=c.get(a))&&(b||(b=m.settings.default_color),b!==m.value&&m.displayColor(b))}var k,l,m,n,o,p,q,r,s,t,u=this,v=0,w=u.settings;a.each(u.stateControls,function(a){c.setActive(a,b.queryCommandState(u.controls[a][1]))}),c.setActive("visualaid",b.hasVisual),u._updateUndoStatus(b),c.setDisabled("outdent",!b.queryCommandState("Outdent")),k=i("A"),(m=c.get("link"))&&(m.setDisabled(!k&&f||k&&!k.href),m.setActive(!!k&&!k.name&&!k.id)),(m=c.get("unlink"))&&(m.setDisabled(!k&&f),m.setActive(!!k&&!k.name&&!k.id)),(m=c.get("anchor"))&&m.setActive(!f&&!!k&&(k.name||k.id&&!k.href)),k=i("IMG"),(m=c.get("image"))&&m.setActive(!f&&!!k&&-1==e.className.indexOf("mceItem")),(m=c.get("styleselect"))&&(u._importClasses(),s=[],g(m.items,function(a){s.push(a.value)}),t=b.formatter.matchAll(s),m.select(t[0]),a.each(t,function(a,b){b>0&&m.mark(a)})),(m=c.get("formatselect"))&&(k=i(b.dom.isBlock),k&&m.select(k.nodeName.toLowerCase())),i(function(a){return"SPAN"===a.nodeName&&!n&&a.className&&(n=a.className),b.dom.is(a,w.theme_advanced_font_selector)&&(!o&&a.style.fontSize&&(o=a.style.fontSize),!p&&a.style.fontFamily&&(p=a.style.fontFamily.replace(/[\"\']+/g,"").replace(/^([^,]+).*/,"$1").toLowerCase()),!q&&a.style.color&&(q=a.style.color),!r&&a.style.backgroundColor&&(r=a.style.backgroundColor)),!1}),(m=c.get("fontselect"))&&m.select(function(a){return a.replace(/^([^,]+).*/,"$1").toLowerCase()==p}),(m=c.get("fontsizeselect"))&&(!w.theme_advanced_runtime_fontsize||o||n||(o=b.dom.getStyle(e,"fontSize",!0)),m.select(function(a){return a.fontSize&&a.fontSize===o?!0:a["class"]&&a["class"]===n?!0:void 0})),w.theme_advanced_show_current_color&&(j("forecolor",q),j("backcolor",r)),w.theme_advanced_show_current_color&&(j("forecolor",q),j("backcolor",r)),w.theme_advanced_path&&w.theme_advanced_statusbar_location&&(k=d.get(b.id+"_path")||d.add(b.id+"_path_row","span",{id:b.id+"_path"}),u.statusKeyboardNavigation&&(u.statusKeyboardNavigation.destroy(),u.statusKeyboardNavigation=null),d.setHTML(k,""),i(function(c){var e,f=c.nodeName.toLowerCase(),g="";if(!(1!=c.nodeType||"br"===f||c.getAttribute("data-mce-bogus")||d.hasClass(c,"mceItemHidden")||d.hasClass(c,"mceItemRemoved"))){switch(a.isIE&&"HTML"!==c.scopeName&&c.scopeName&&(f=c.scopeName+":"+f),f=f.replace(/mce\:/g,"")){case"b":f="strong";break;case"i":f="em";break;case"img":(l=d.getAttrib(c,"src"))&&(g+="src: "+l+" ");break;case"a":(l=d.getAttrib(c,"name"))&&(g+="name: "+l+" ",f+="#"+l),(l=d.getAttrib(c,"href"))&&(g+="href: "+l+" ");break;case"font":(l=d.getAttrib(c,"face"))&&(g+="font: "+l+" "),(l=d.getAttrib(c,"size"))&&(g+="size: "+l+" "),(l=d.getAttrib(c,"color"))&&(g+="color: "+l+" ");break;case"span":(l=d.getAttrib(c,"style"))&&(g+="style: "+l+" ")}(l=d.getAttrib(c,"id"))&&(g+="id: "+l+" "),(l=c.className)&&(l=l.replace(/\b\s*(webkit|mce|Apple-)\w+\s*\b/g,""),l&&(g+="class: "+l+" ",(b.dom.isBlock(c)||"img"==f||"span"==f)&&(f+="."+l))),f=f.replace(/(html:)/g,""),f={name:f,node:c,title:g},u.onResolveName.dispatch(u,f),g=f.title,f=f.name,e=d.create("a",{href:"javascript:;",role:"button",onmousedown:"return false;",title:g,"class":"mcePath_"+v++},f),k.hasChildNodes()?(k.insertBefore(d.create("span",{"aria-hidden":"true"}," » "),k.firstChild),k.insertBefore(e,k.firstChild)):k.appendChild(e)}},b.getBody()),d.select("a",k).length>0&&(u.statusKeyboardNavigation=new a.ui.KeyboardNavigation({root:b.id+"_path_row",items:d.select("a",k),excludeFromTabOrder:!0,onCancel:function(){b.focus()}},d)))},_sel:function(a){this.editor.execCommand("mceSelectNodeDepth",!1,a)},_mceInsertAnchor:function(){var a=this.editor;a.windowManager.open({url:this.url+"/anchor.htm",width:320+parseInt(a.getLang("advanced.anchor_delta_width",0)),height:90+parseInt(a.getLang("advanced.anchor_delta_height",0)),inline:!0},{theme_url:this.url})},_mceCharMap:function(){var a=this.editor;a.windowManager.open({url:this.url+"/charmap.htm",width:550+parseInt(a.getLang("advanced.charmap_delta_width",0)),height:265+parseInt(a.getLang("advanced.charmap_delta_height",0)),inline:!0},{theme_url:this.url})},_mceHelp:function(){var a=this.editor;a.windowManager.open({url:this.url+"/about.htm",width:480,height:380,inline:!0},{theme_url:this.url})},_mceShortcuts:function(){var a=this.editor;a.windowManager.open({url:this.url+"/shortcuts.htm",width:480,height:380,inline:!0},{theme_url:this.url})},_mceColorPicker:function(a,b){var c=this.editor;b=b||{},c.windowManager.open({url:this.url+"/color_picker.htm",width:375+parseInt(c.getLang("advanced.colorpicker_delta_width",0)),height:250+parseInt(c.getLang("advanced.colorpicker_delta_height",0)),close_previous:!1,inline:!0},{input_color:b.color,func:b.func,theme_url:this.url})},_mceCodeEditor:function(){var a=this.editor;a.windowManager.open({url:this.url+"/source_editor.htm",width:parseInt(a.getParam("theme_advanced_source_editor_width",720)),height:parseInt(a.getParam("theme_advanced_source_editor_height",580)),inline:!0,resizable:!0,maximizable:!0},{theme_url:this.url})},_mceImage:function(){var a=this.editor;-1==a.dom.getAttrib(a.selection.getNode(),"class","").indexOf("mceItem")&&a.windowManager.open({url:this.url+"/image.htm",width:355+parseInt(a.getLang("advanced.image_delta_width",0)),height:275+parseInt(a.getLang("advanced.image_delta_height",0)),inline:!0},{theme_url:this.url})},_mceLink:function(){var a=this.editor;a.windowManager.open({url:this.url+"/link.htm",width:310+parseInt(a.getLang("advanced.link_delta_width",0)),height:200+parseInt(a.getLang("advanced.link_delta_height",0)),inline:!0},{theme_url:this.url})},_mceNewDocument:function(){var a=this.editor;a.windowManager.confirm("advanced.newdocument",function(b){b&&a.execCommand("mceSetContent",!1,"")})},_mceForeColor:function(){var a=this;this._mceColorPicker(0,{color:a.fgColor,func:function(b){a.fgColor=b,a.editor.execCommand("ForeColor",!1,b)}})},_mceBackColor:function(){var a=this;this._mceColorPicker(0,{color:a.bgColor,func:function(b){a.bgColor=b,a.editor.execCommand("HiliteColor",!1,b)}})},_ufirst:function(a){return a.substring(0,1).toUpperCase()+a.substring(1)}}),a.ThemeManager.add("advanced",a.themes.AdvancedTheme)}(tinymce);
//# sourceMappingURL=editor_template.map