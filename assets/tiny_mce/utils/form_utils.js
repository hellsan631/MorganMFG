function getColorPickerHTML(a,b){var c="",d=tinyMCEPopup.dom;return(label=d.select("label[for="+b+"]")[0])&&(label.id=label.id||d.uniqueId()),c+='<a role="button" aria-labelledby="'+a+'_label" id="'+a+'_link" href="javascript:;" onclick="tinyMCEPopup.pickColor(event,\''+b+'\');" onmousedown="return false;" class="pickcolor">',c+='<span id="'+a+'" title="'+tinyMCEPopup.getLang("browse")+'">&nbsp;<span id="'+a+'_label" class="mceVoiceLabel mceIconOnly" style="display:none;">'+tinyMCEPopup.getLang("browse")+"</span></span></a>"}function updateColor(a,b){document.getElementById(a).style.backgroundColor=document.forms[0].elements[b].value}function setBrowserDisabled(a,b){var c=document.getElementById(a),d=document.getElementById(a+"_link");d&&(b?(d.setAttribute("realhref",d.getAttribute("href")),d.removeAttribute("href"),tinyMCEPopup.dom.addClass(c,"disabled")):(d.getAttribute("realhref")&&d.setAttribute("href",d.getAttribute("realhref")),tinyMCEPopup.dom.removeClass(c,"disabled")))}function getBrowserHTML(a,b,c,d){var e,f,g=d+"_"+c+"_browser_callback";return(e=tinyMCEPopup.getParam(g,tinyMCEPopup.getParam("file_browser_callback")))?(f="",f+='<a id="'+a+'_link" href="javascript:openBrowser(\''+a+"','"+b+"', '"+c+"','"+g+'\');" onmousedown="return false;" class="browse">',f+='<span id="'+a+'" title="'+tinyMCEPopup.getLang("browse")+'">&nbsp;</span></a>'):""}function openBrowser(a,b,c,d){var e=document.getElementById(a);"mceButtonDisabled"!=e.className&&tinyMCEPopup.openBrowser(b,c,d)}function selectByValue(a,b,c,d,e){if(a&&a.elements[b]){c||(c="");for(var f=a.elements[b],g=!1,h=0;h<f.options.length;h++){var i=f.options[h];i.value==c||e&&i.value.toLowerCase()==c.toLowerCase()?(i.selected=!0,g=!0):i.selected=!1}if(!g&&d&&""!=c){var i=new Option(c,c);i.selected=!0,f.options[f.options.length]=i,f.selectedIndex=f.options.length-1}return g}}function getSelectValue(a,b){var c=a.elements[b];return null==c||null==c.options||-1===c.selectedIndex?"":c.options[c.selectedIndex].value}function addSelectValue(a,b,c,d){var e=a.elements[b],f=new Option(c,d);e.options[e.options.length]=f}function addClassesToList(a,b){var c=document.getElementById(a),d=tinyMCEPopup.getParam("theme_advanced_styles",!1);if(d=tinyMCEPopup.getParam(b,d)){for(var e=d.split(";"),f=0;f<e.length;f++)if(""!=e){var g,h;g=e[f].split("=")[0],h=e[f].split("=")[1],c.options[c.length]=new Option(g,h)}}else tinymce.each(tinyMCEPopup.editor.dom.getClasses(),function(a){c.options[c.length]=new Option(a.title||a["class"],a["class"])})}function isVisible(a){var b=document.getElementById(a);return b&&"none"!=b.style.display}function convertRGBToHex(a){var c=new RegExp("rgb\\s*\\(\\s*([0-9]+).*,\\s*([0-9]+).*,\\s*([0-9]+).*\\)","gi"),d=a.replace(c,"$1,$2,$3").split(",");return 3==d.length?(r=parseInt(d[0]).toString(16),g=parseInt(d[1]).toString(16),b=parseInt(d[2]).toString(16),r=1==r.length?"0"+r:r,g=1==g.length?"0"+g:g,b=1==b.length?"0"+b:b,"#"+r+g+b):a}function convertHexToRGB(a){return-1!=a.indexOf("#")?(a=a.replace(new RegExp("[^0-9A-F]","gi"),""),r=parseInt(a.substring(0,2),16),g=parseInt(a.substring(2,4),16),b=parseInt(a.substring(4,6),16),"rgb("+r+","+g+","+b+")"):a}function trimSize(a){return a.replace(/([0-9\.]+)(px|%|in|cm|mm|em|ex|pt|pc)/i,"$1$2")}function getCSSSize(a){if(a=trimSize(a),""==a)return"";if(/^[0-9]+$/.test(a))a+="px";else if(!/^[0-9\.]+(px|%|in|cm|mm|em|ex|pt|pc)$/i.test(a))return"";return a}function getStyle(a,b,c){var d=tinyMCEPopup.dom.getAttrib(a,b);return""!=d?""+d:("undefined"==typeof c&&(c=b),tinyMCEPopup.dom.getStyle(a,c))}var themeBaseURL=tinyMCEPopup.editor.baseURI.toAbsolute("themes/"+tinyMCEPopup.getParam("theme"));
//# sourceMappingURL=form_utils.map