function init(){tinyMCEPopup.resizeToInnerSize(),document.getElementById("backgroundimagebrowsercontainer").innerHTML=getBrowserHTML("backgroundimagebrowser","backgroundimage","image","table"),document.getElementById("bgcolor_pickcontainer").innerHTML=getColorPickerHTML("bgcolor_pick","bgcolor");var a=tinyMCEPopup.editor,b=a.dom,c=b.getParent(a.selection.getStart(),"tr"),d=document.forms[0],e=b.parseStyle(b.getAttrib(c,"style")),f=c.parentNode.nodeName.toLowerCase(),g=b.getAttrib(c,"align"),h=b.getAttrib(c,"valign"),i=trimSize(getStyle(c,"height","height")),j=b.getAttrib(c,"class"),k=convertRGBToHex(getStyle(c,"bgcolor","backgroundColor")),l=getStyle(c,"background","backgroundImage").replace(new RegExp("url\\(['\"]?([^'\"]*)['\"]?\\)","gi"),"$1"),m=b.getAttrib(c,"id"),n=b.getAttrib(c,"lang"),o=b.getAttrib(c,"dir");selectByValue(d,"rowtype",f),setActionforRowType(d,f),0==b.select("td.mceSelected,th.mceSelected",c).length?(addClassesToList("class","table_row_styles"),TinyMCE_EditableSelects.init(),d.bgcolor.value=k,d.backgroundimage.value=l,d.height.value=i,d.id.value=m,d.lang.value=n,d.style.value=b.serializeStyle(e),selectByValue(d,"align",g),selectByValue(d,"valign",h),selectByValue(d,"class",j,!0,!0),selectByValue(d,"dir",o),isVisible("backgroundimagebrowser")&&(document.getElementById("backgroundimage").style.width="180px"),updateColor("bgcolor_pick","bgcolor")):tinyMCEPopup.dom.hide("action")}function updateAction(){var a,b,c=tinyMCEPopup.editor,d=c.dom,e=document.forms[0],f=getSelectValue(e,"action");if(!AutoValidator.validate(e))return tinyMCEPopup.alert(AutoValidator.getErrorMessages(e).join(". ")+"."),!1;if(tinyMCEPopup.restoreSelection(),a=d.getParent(c.selection.getStart(),"tr"),b=d.getParent(c.selection.getStart(),"table"),d.select("td.mceSelected,th.mceSelected",a).length>0)return tinymce.each(b.rows,function(a){var b;for(b=0;b<a.cells.length;b++)if(d.hasClass(a.cells[b],"mceSelected"))return void updateRow(a,!0)}),c.addVisual(),c.nodeChanged(),c.execCommand("mceEndUndoLevel"),void tinyMCEPopup.close();switch(f){case"row":updateRow(a);break;case"all":for(var g=b.getElementsByTagName("tr"),h=0;h<g.length;h++)updateRow(g[h],!0);break;case"odd":case"even":for(var g=b.getElementsByTagName("tr"),h=0;h<g.length;h++)(h%2==0&&"odd"==f||h%2!=0&&"even"==f)&&updateRow(g[h],!0,!0)}c.addVisual(),c.nodeChanged(),c.execCommand("mceEndUndoLevel"),tinyMCEPopup.close()}function updateRow(a,b,c){var d=tinyMCEPopup.editor,e=document.forms[0],f=d.dom,g=a.parentNode.nodeName.toLowerCase(),h=getSelectValue(e,"rowtype"),i=d.getDoc();if(b||f.setAttrib(a,"id",e.id.value),f.setAttrib(a,"align",getSelectValue(e,"align")),f.setAttrib(a,"vAlign",getSelectValue(e,"valign")),f.setAttrib(a,"lang",e.lang.value),f.setAttrib(a,"dir",getSelectValue(e,"dir")),f.setAttrib(a,"style",f.serializeStyle(f.parseStyle(e.style.value))),f.setAttrib(a,"class",getSelectValue(e,"class")),f.setAttrib(a,"background",""),f.setAttrib(a,"bgColor",""),f.setAttrib(a,"height",""),a.style.height=getCSSSize(e.height.value),a.style.backgroundColor=e.bgcolor.value,a.style.backgroundImage=""!=e.backgroundimage.value?"url('"+e.backgroundimage.value+"')":"",g!=h&&!c){for(var j=a.cloneNode(1),k=f.getParent(a,"table"),l=h,m=null,n=0;n<k.childNodes.length;n++)k.childNodes[n].nodeName.toLowerCase()==l&&(m=k.childNodes[n]);null==m&&(m=i.createElement(l),"CAPTION"==k.firstChild.nodeName?d.dom.insertAfter(m,k.firstChild):k.insertBefore(m,k.firstChild)),m.appendChild(j),a.parentNode.removeChild(a),a=j}f.setAttrib(a,"style",f.serializeStyle(f.parseStyle(a.style.cssText)))}function changedBackgroundImage(){var a=document.forms[0],b=tinyMCEPopup.editor.dom,c=b.parseStyle(a.style.value);c["background-image"]="url('"+a.backgroundimage.value+"')",a.style.value=b.serializeStyle(c)}function changedStyle(){var a=document.forms[0],b=tinyMCEPopup.editor.dom,c=b.parseStyle(a.style.value);a.backgroundimage.value=c["background-image"]?c["background-image"].replace(new RegExp("url\\('?([^']*)'?\\)","gi"),"$1"):"",c.height&&(a.height.value=trimSize(c.height)),c["background-color"]&&(a.bgcolor.value=c["background-color"],updateColor("bgcolor_pick","bgcolor"))}function changedSize(){var a=document.forms[0],b=tinyMCEPopup.editor.dom,c=b.parseStyle(a.style.value),d=a.height.value;c.height=""!=d?getCSSSize(d):"",a.style.value=b.serializeStyle(c)}function changedColor(){var a=document.forms[0],b=tinyMCEPopup.editor.dom,c=b.parseStyle(a.style.value);c["background-color"]=a.bgcolor.value,a.style.value=b.serializeStyle(c)}function changedRowType(){var a=document.forms[0],b=getSelectValue(a,"rowtype");setActionforRowType(a,b)}function setActionforRowType(a,b){"tbody"===b?a.action.disabled=!1:(selectByValue(a,"action","row"),a.action.disabled=!0)}tinyMCEPopup.requireLangPack(),tinyMCEPopup.onInit.add(init);
//# sourceMappingURL=row.map