function init(){var a,b,c=convertRGBToHex(tinyMCEPopup.getWindowArg("input_color"));tinyMCEPopup.resizeToInnerSize(),generatePicker(),generateWebColors(),generateNamedColors(),c&&(changeFinalColor(c),col=convertHexToRGB(c),col&&updateLight(col.r,col.g,col.b));for(a in named)b=named[a],namedLookup[b.replace(/\s+/,"").toLowerCase()]=a.replace(/#/,"").toLowerCase()}function toHexColor(a){function b(a){return a=parseInt(a).toString(16),a.length>1?a:"0"+a}var c,d,e,f,g=parseInt;if(a=tinymce.trim(a),a=a.replace(/^[#]/,"").toLowerCase(),a=namedLookup[a]||a,c=/^rgb\((\d{1,3}),(\d{1,3}),(\d{1,3})\)$/.exec(a))d=g(c[1]),e=g(c[2]),f=g(c[3]);else if(c=/^([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/.exec(a))d=g(c[1],16),e=g(c[2],16),f=g(c[3],16);else{if(c=/^([0-9a-f])([0-9a-f])([0-9a-f])$/.exec(a),!c)return"";d=g(c[1]+c[1],16),e=g(c[2]+c[2],16),f=g(c[3]+c[3],16)}return"#"+b(d)+b(e)+b(f)}function insertAction(){var a=document.getElementById("color").value,b=tinyMCEPopup.getWindowArg("func"),c=toHexColor(a);if(""===c){var d=tinyMCEPopup.editor.getLang("advanced_dlg.invalid_color_value");tinyMCEPopup.alert(d+": "+a)}else tinyMCEPopup.restoreSelection(),b&&b(c),tinyMCEPopup.close()}function showColor(a,b){b&&(document.getElementById("colorname").innerHTML=b),document.getElementById("preview").style.backgroundColor=a,document.getElementById("color").value=a.toUpperCase()}function convertRGBToHex(a){var c=new RegExp("rgb\\s*\\(\\s*([0-9]+).*,\\s*([0-9]+).*,\\s*([0-9]+).*\\)","gi");if(!a)return a;var d=a.replace(c,"$1,$2,$3").split(",");return 3==d.length?(r=parseInt(d[0]).toString(16),g=parseInt(d[1]).toString(16),b=parseInt(d[2]).toString(16),r=1==r.length?"0"+r:r,g=1==g.length?"0"+g:g,b=1==b.length?"0"+b:b,"#"+r+g+b):a}function convertHexToRGB(a){return-1!=a.indexOf("#")?(a=a.replace(new RegExp("[^0-9A-F]","gi"),""),r=parseInt(a.substring(0,2),16),g=parseInt(a.substring(2,4),16),b=parseInt(a.substring(4,6),16),{r:r,g:g,b:b}):null}function generatePicker(){var a,b=document.getElementById("light"),c="";for(a=0;detail>a;a++)c+='<div id="gs'+a+'" style="background-color:#000000; width:15px; height:3px; border-style:none; border-width:0px;" onclick="changeFinalColor(this.style.backgroundColor)" onmousedown="isMouseDown = true; return false;" onmouseup="isMouseDown = false;" onmousemove="if (isMouseDown && isMouseOver) changeFinalColor(this.style.backgroundColor); return false;" onmouseover="isMouseOver = true;" onmouseout="isMouseOver = false;"></div>';b.innerHTML=c}function generateWebColors(){var a,b=document.getElementById("webcolors"),c="";if("generated"!=b.className){for(c+='<div role="listbox" aria-labelledby="webcolors_title" tabindex="0"><table role="presentation" border="0" cellspacing="1" cellpadding="0"><tr>',a=0;a<colors.length;a++)c+='<td bgcolor="'+colors[a]+'" width="10" height="10"><a href="javascript:insertAction();" role="option" tabindex="-1" aria-labelledby="web_colors_'+a+'" onfocus="showColor(\''+colors[a]+"');\" onmouseover=\"showColor('"+colors[a]+'\');" style="display:block;width:10px;height:10px;overflow:hidden;">',tinyMCEPopup.editor.forcedHighContrastMode&&(c+='<canvas class="mceColorSwatch" height="10" width="10" data-color="'+colors[a]+'"></canvas>'),c+='<span class="mceVoiceLabel" style="display:none;" id="web_colors_'+a+'">'+colors[a].toUpperCase()+"</span>",c+="</a></td>",(a+1)%18==0&&(c+="</tr><tr>");c+="</table></div>",b.innerHTML=c,b.className="generated",paintCanvas(b),enableKeyboardNavigation(b.firstChild)}}function paintCanvas(a){tinyMCEPopup.getWin().tinymce.each(tinyMCEPopup.dom.select("canvas.mceColorSwatch",a),function(a){var b;a.getContext&&(b=a.getContext("2d"))&&(b.fillStyle=a.getAttribute("data-color"),b.fillRect(0,0,10,10))})}function generateNamedColors(){var a,b,c=document.getElementById("namedcolors"),d="",e=0;if("generated"!=c.className){for(a in named)b=named[a],d+='<a href="javascript:insertAction();" role="option" tabindex="-1" aria-labelledby="named_colors_'+e+'" onfocus="showColor(\''+a+"','"+b+"');\" onmouseover=\"showColor('"+a+"','"+b+'\');" style="background-color: '+a+'">',tinyMCEPopup.editor.forcedHighContrastMode&&(d+='<canvas class="mceColorSwatch" height="10" width="10" data-color="'+colors[e]+'"></canvas>'),d+='<span class="mceVoiceLabel" style="display:none;" id="named_colors_'+e+'">'+b+"</span>",d+="</a>",e++;c.innerHTML=d,c.className="generated",paintCanvas(c),enableKeyboardNavigation(c)}}function enableKeyboardNavigation(a){tinyMCEPopup.editor.windowManager.createInstance("tinymce.ui.KeyboardNavigation",{root:a,items:tinyMCEPopup.dom.select("a",a)},tinyMCEPopup.dom)}function dechex(a){return strhex.charAt(Math.floor(a/16))+strhex.charAt(a%16)}function computeColor(a){var b,c,d,e,f,g,h,i,j,k=tinyMCEPopup.dom.getPos(a.target);b=a.offsetX?a.offsetX:a.target?a.clientX-k.x:0,c=a.offsetY?a.offsetY:a.target?a.clientY-k.y:0,d=document.getElementById("colors").width/6,e=detail/2,f=document.getElementById("colors").height,g=(b>=0)*(d>b)*255+(b>=d)*(2*d>b)*(510-255*b/d)+(b>=4*d)*(5*d>b)*(-1020+255*b/d)+(b>=5*d)*(6*d>b)*255,h=(b>=0)*(d>b)*(255*b/d)+(b>=d)*(3*d>b)*255+(b>=3*d)*(4*d>b)*(1020-255*b/d),i=(b>=2*d)*(3*d>b)*(-510+255*b/d)+(b>=3*d)*(5*d>b)*255+(b>=5*d)*(6*d>b)*(1530-255*b/d),j=(f-c)/f,g=128+(g-128)*j,h=128+(h-128)*j,i=128+(i-128)*j,changeFinalColor("#"+dechex(g)+dechex(h)+dechex(i)),updateLight(g,h,i)}function updateLight(a,b,c){var d,e,f,g,h,i,j=detail/2;for(d=0;detail>d;d++)d>=0&&j>d?(e=d/j,f=dechex(255-(255-a)*e),g=dechex(255-(255-b)*e),h=dechex(255-(255-c)*e)):(e=2-d/j,f=dechex(a*e),g=dechex(b*e),h=dechex(c*e)),i=f+g+h,setCol("gs"+d,"#"+i)}function changeFinalColor(a){-1==a.indexOf("#")&&(a=convertRGBToHex(a)),setCol("preview",a),document.getElementById("color").value=a}function setCol(a,b){try{document.getElementById(a).style.backgroundColor=b}catch(c){}}tinyMCEPopup.requireLangPack();var detail=50,strhex="0123456789abcdef",i,isMouseDown=!1,isMouseOver=!1,colors=["#000000","#000033","#000066","#000099","#0000cc","#0000ff","#330000","#330033","#330066","#330099","#3300cc","#3300ff","#660000","#660033","#660066","#660099","#6600cc","#6600ff","#990000","#990033","#990066","#990099","#9900cc","#9900ff","#cc0000","#cc0033","#cc0066","#cc0099","#cc00cc","#cc00ff","#ff0000","#ff0033","#ff0066","#ff0099","#ff00cc","#ff00ff","#003300","#003333","#003366","#003399","#0033cc","#0033ff","#333300","#333333","#333366","#333399","#3333cc","#3333ff","#663300","#663333","#663366","#663399","#6633cc","#6633ff","#993300","#993333","#993366","#993399","#9933cc","#9933ff","#cc3300","#cc3333","#cc3366","#cc3399","#cc33cc","#cc33ff","#ff3300","#ff3333","#ff3366","#ff3399","#ff33cc","#ff33ff","#006600","#006633","#006666","#006699","#0066cc","#0066ff","#336600","#336633","#336666","#336699","#3366cc","#3366ff","#666600","#666633","#666666","#666699","#6666cc","#6666ff","#996600","#996633","#996666","#996699","#9966cc","#9966ff","#cc6600","#cc6633","#cc6666","#cc6699","#cc66cc","#cc66ff","#ff6600","#ff6633","#ff6666","#ff6699","#ff66cc","#ff66ff","#009900","#009933","#009966","#009999","#0099cc","#0099ff","#339900","#339933","#339966","#339999","#3399cc","#3399ff","#669900","#669933","#669966","#669999","#6699cc","#6699ff","#999900","#999933","#999966","#999999","#9999cc","#9999ff","#cc9900","#cc9933","#cc9966","#cc9999","#cc99cc","#cc99ff","#ff9900","#ff9933","#ff9966","#ff9999","#ff99cc","#ff99ff","#00cc00","#00cc33","#00cc66","#00cc99","#00cccc","#00ccff","#33cc00","#33cc33","#33cc66","#33cc99","#33cccc","#33ccff","#66cc00","#66cc33","#66cc66","#66cc99","#66cccc","#66ccff","#99cc00","#99cc33","#99cc66","#99cc99","#99cccc","#99ccff","#cccc00","#cccc33","#cccc66","#cccc99","#cccccc","#ccccff","#ffcc00","#ffcc33","#ffcc66","#ffcc99","#ffcccc","#ffccff","#00ff00","#00ff33","#00ff66","#00ff99","#00ffcc","#00ffff","#33ff00","#33ff33","#33ff66","#33ff99","#33ffcc","#33ffff","#66ff00","#66ff33","#66ff66","#66ff99","#66ffcc","#66ffff","#99ff00","#99ff33","#99ff66","#99ff99","#99ffcc","#99ffff","#ccff00","#ccff33","#ccff66","#ccff99","#ccffcc","#ccffff","#ffff00","#ffff33","#ffff66","#ffff99","#ffffcc","#ffffff"],named={"#F0F8FF":"Alice Blue","#FAEBD7":"Antique White","#00FFFF":"Aqua","#7FFFD4":"Aquamarine","#F0FFFF":"Azure","#F5F5DC":"Beige","#FFE4C4":"Bisque","#000000":"Black","#FFEBCD":"Blanched Almond","#0000FF":"Blue","#8A2BE2":"Blue Violet","#A52A2A":"Brown","#DEB887":"Burly Wood","#5F9EA0":"Cadet Blue","#7FFF00":"Chartreuse","#D2691E":"Chocolate","#FF7F50":"Coral","#6495ED":"Cornflower Blue","#FFF8DC":"Cornsilk","#DC143C":"Crimson","#00FFFF":"Cyan","#00008B":"Dark Blue","#008B8B":"Dark Cyan","#B8860B":"Dark Golden Rod","#A9A9A9":"Dark Gray","#A9A9A9":"Dark Grey","#006400":"Dark Green","#BDB76B":"Dark Khaki","#8B008B":"Dark Magenta","#556B2F":"Dark Olive Green","#FF8C00":"Darkorange","#9932CC":"Dark Orchid","#8B0000":"Dark Red","#E9967A":"Dark Salmon","#8FBC8F":"Dark Sea Green","#483D8B":"Dark Slate Blue","#2F4F4F":"Dark Slate Gray","#2F4F4F":"Dark Slate Grey","#00CED1":"Dark Turquoise","#9400D3":"Dark Violet","#FF1493":"Deep Pink","#00BFFF":"Deep Sky Blue","#696969":"Dim Gray","#696969":"Dim Grey","#1E90FF":"Dodger Blue","#B22222":"Fire Brick","#FFFAF0":"Floral White","#228B22":"Forest Green","#FF00FF":"Fuchsia","#DCDCDC":"Gainsboro","#F8F8FF":"Ghost White","#FFD700":"Gold","#DAA520":"Golden Rod","#808080":"Gray","#808080":"Grey","#008000":"Green","#ADFF2F":"Green Yellow","#F0FFF0":"Honey Dew","#FF69B4":"Hot Pink","#CD5C5C":"Indian Red","#4B0082":"Indigo","#FFFFF0":"Ivory","#F0E68C":"Khaki","#E6E6FA":"Lavender","#FFF0F5":"Lavender Blush","#7CFC00":"Lawn Green","#FFFACD":"Lemon Chiffon","#ADD8E6":"Light Blue","#F08080":"Light Coral","#E0FFFF":"Light Cyan","#FAFAD2":"Light Golden Rod Yellow","#D3D3D3":"Light Gray","#D3D3D3":"Light Grey","#90EE90":"Light Green","#FFB6C1":"Light Pink","#FFA07A":"Light Salmon","#20B2AA":"Light Sea Green","#87CEFA":"Light Sky Blue","#778899":"Light Slate Gray","#778899":"Light Slate Grey","#B0C4DE":"Light Steel Blue","#FFFFE0":"Light Yellow","#00FF00":"Lime","#32CD32":"Lime Green","#FAF0E6":"Linen","#FF00FF":"Magenta","#800000":"Maroon","#66CDAA":"Medium Aqua Marine","#0000CD":"Medium Blue","#BA55D3":"Medium Orchid","#9370D8":"Medium Purple","#3CB371":"Medium Sea Green","#7B68EE":"Medium Slate Blue","#00FA9A":"Medium Spring Green","#48D1CC":"Medium Turquoise","#C71585":"Medium Violet Red","#191970":"Midnight Blue","#F5FFFA":"Mint Cream","#FFE4E1":"Misty Rose","#FFE4B5":"Moccasin","#FFDEAD":"Navajo White","#000080":"Navy","#FDF5E6":"Old Lace","#808000":"Olive","#6B8E23":"Olive Drab","#FFA500":"Orange","#FF4500":"Orange Red","#DA70D6":"Orchid","#EEE8AA":"Pale Golden Rod","#98FB98":"Pale Green","#AFEEEE":"Pale Turquoise","#D87093":"Pale Violet Red","#FFEFD5":"Papaya Whip","#FFDAB9":"Peach Puff","#CD853F":"Peru","#FFC0CB":"Pink","#DDA0DD":"Plum","#B0E0E6":"Powder Blue","#800080":"Purple","#FF0000":"Red","#BC8F8F":"Rosy Brown","#4169E1":"Royal Blue","#8B4513":"Saddle Brown","#FA8072":"Salmon","#F4A460":"Sandy Brown","#2E8B57":"Sea Green","#FFF5EE":"Sea Shell","#A0522D":"Sienna","#C0C0C0":"Silver","#87CEEB":"Sky Blue","#6A5ACD":"Slate Blue","#708090":"Slate Gray","#708090":"Slate Grey","#FFFAFA":"Snow","#00FF7F":"Spring Green","#4682B4":"Steel Blue","#D2B48C":"Tan","#008080":"Teal","#D8BFD8":"Thistle","#FF6347":"Tomato","#40E0D0":"Turquoise","#EE82EE":"Violet","#F5DEB3":"Wheat","#FFFFFF":"White","#F5F5F5":"White Smoke","#FFFF00":"Yellow","#9ACD32":"Yellow Green"},namedLookup={};tinyMCEPopup.onInit.add(init);