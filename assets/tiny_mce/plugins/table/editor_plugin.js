!function(a){function b(a,b){var c,d=b.ownerDocument,e=d.createRange();return e.setStartBefore(b),e.setEnd(a.endContainer,a.endOffset),c=d.createElement("body"),c.appendChild(e.cloneContents()),0==c.innerHTML.replace(/<(br|img|object|embed|input|textarea)[^>]*>/gi,"-").replace(/<[^>]+>/g,"").length}function c(a,b){return parseInt(a.getAttribute(b)||1)}function d(b,d,f){function g(a,b){return a=a.cloneNode(b),a.removeAttribute("id"),a}function h(){var a=0;G=[],e(["thead","tbody","tfoot"],function(f){var g=d.select("> "+f+" tr",b);e(g,function(b,g){g+=a,e(d.select("> td, > th",b),function(a,b){var d,e,h,i;if(G[g])for(;G[g][b];)b++;for(h=c(a,"rowspan"),i=c(a,"colspan"),e=g;g+h>e;e++)for(G[e]||(G[e]=[]),d=b;b+i>d;d++)G[e][d]={part:f,real:e==g&&d==b,elm:a,rowspan:h,colspan:i}})}),a+=g.length})}function j(a,b){var c;return c=G[b],c?c[a]:void 0}function k(a,b,c){a&&(c=parseInt(c),1===c?a.removeAttribute(b,1):a.setAttribute(b,c,1))}function l(a){return a&&(d.hasClass(a.elm,"mceSelected")||a==J)}function m(){var a=[];return e(b.rows,function(b){e(b.cells,function(c){return d.hasClass(c,"mceSelected")||c==J.elm?(a.push(b),!1):void 0})}),a}function n(){var a=d.createRng();a.setStartAfter(b),a.setEndAfter(b),f.setRng(a),d.remove(b)}function o(b){var c;return a.walk(b,function(f){var h;return 3==f.nodeType?(e(d.getParents(f.parentNode,null,b).reverse(),function(a){a=g(a,!1),c?h&&h.appendChild(a):c=h=a,h=a}),h&&(h.innerHTML=a.isIE?"&nbsp;":'<br data-mce-bogus="1" />'),!1):void 0},"childNodes"),b=g(b,!1),k(b,"rowSpan",1),k(b,"colSpan",1),c?b.appendChild(c):a.isIE||(b.innerHTML='<br data-mce-bogus="1" />'),b}function p(){var a=d.createRng();return e(d.select("tr",b),function(a){0==a.cells.length&&d.remove(a)}),0==d.select("tr",b).length?(a.setStartAfter(b),a.setEndAfter(b),f.setRng(a),void d.remove(b)):(e(d.select("thead,tbody,tfoot",b),function(a){0==a.rows.length&&d.remove(a)}),h(),row=G[Math.min(G.length-1,H.y)],void(row&&(f.select(row[Math.min(row.length-1,H.x)].elm,!0),f.collapse(!0))))}function q(a,b,c,e){var f,g,h,i,j;for(f=G[b][a].elm.parentNode,h=1;c>=h;h++)if(f=d.getNext(f,"tr")){for(g=a;g>=0;g--)if(j=G[b+h][g].elm,j.parentNode==f){for(i=1;e>=i;i++)d.insertAfter(o(j),j);break}if(-1==g)for(i=1;e>=i;i++)f.insertBefore(o(f.cells[0]),f.cells[0])}}function r(){e(G,function(a,b){e(a,function(a,e){var f,g,h;if(l(a)&&(a=a.elm,f=c(a,"colspan"),g=c(a,"rowspan"),f>1||g>1)){for(k(a,"rowSpan",1),k(a,"colSpan",1),h=0;f-1>h;h++)d.insertAfter(o(a),a);q(e,b,g-1,f)}})})}function s(b,c,f){var g,i,m,n,o,q,s,t,b,u,v;if(b?(pos=C(b),g=pos.x,i=pos.y,m=g+(c-1),n=i+(f-1)):(H=I=null,e(G,function(a,b){e(a,function(a,c){l(a)&&(H||(H={x:c,y:b}),I={x:c,y:b})})}),g=H.x,i=H.y,m=I.x,n=I.y),s=j(g,i),t=j(m,n),s&&t&&s.part==t.part){for(r(),h(),s=j(g,i).elm,k(s,"colSpan",m-g+1),k(s,"rowSpan",n-i+1),q=i;n>=q;q++)for(o=g;m>=o;o++)G[q]&&G[q][o]&&(b=G[q][o].elm,b!=s&&(u=a.grep(b.childNodes),e(u,function(a){s.appendChild(a)}),u.length&&(u=a.grep(s.childNodes),v=0,e(u,function(a){"BR"==a.nodeName&&d.getAttrib(a,"data-mce-bogus")&&v++<u.length-1&&s.removeChild(a)})),d.remove(b)));p()}}function t(a){var b,f,h,i,j,m,n,p,q;for(e(G,function(c,d){return e(c,function(c){return l(c)&&(c=c.elm,j=c.parentNode,m=g(j,!1),b=d,a)?!1:void 0}),a?!b:void 0}),i=0;i<G[0].length;i++)if(G[b][i]&&(f=G[b][i].elm,f!=h)){if(a){if(b>0&&G[b-1][i]&&(p=G[b-1][i].elm,q=c(p,"rowSpan"),q>1)){k(p,"rowSpan",q+1);continue}}else if(q=c(f,"rowspan"),q>1){k(f,"rowSpan",q+1);continue}n=o(f),k(n,"colSpan",f.colSpan),m.appendChild(n),h=f}m.hasChildNodes()&&(a?j.parentNode.insertBefore(m,j):d.insertAfter(m,j))}function u(a){var b,f;e(G,function(c){return e(c,function(c,d){return l(c)&&(b=d,a)?!1:void 0}),a?!b:void 0}),e(G,function(e,g){var h,i,j;e[b]&&(h=e[b].elm,h!=f&&(j=c(h,"colspan"),i=c(h,"rowspan"),1==j?a?(h.parentNode.insertBefore(o(h),h),q(b,g,i-1,j)):(d.insertAfter(o(h),h),q(b,g,i-1,j)):k(h,"colSpan",h.colSpan+1),f=h))})}function v(){var b=[];e(G,function(f){e(f,function(f,g){l(f)&&-1===a.inArray(b,g)&&(e(G,function(a){var b,e=a[g].elm;b=c(e,"colSpan"),b>1?k(e,"colSpan",b-1):d.remove(e)}),b.push(g))})}),p()}function w(){function a(a){var b,f,g;b=d.getNext(a,"tr"),e(a.cells,function(a){var b=c(a,"rowSpan");b>1&&(k(a,"rowSpan",b-1),f=C(a),q(f.x,f.y,1,1))}),f=C(a.cells[0]),e(G[f.y],function(a){var b;a=a.elm,a!=g&&(b=c(a,"rowSpan"),1>=b?d.remove(a):k(a,"rowSpan",b-1),g=a)})}var b;b=m(),e(b.reverse(),function(b){a(b)}),p()}function z(){var a=m();return d.remove(a),p(),a}function A(){var a=m();return e(a,function(b,c){a[c]=g(b,!0)}),a}function B(a,b){if(a){var c=m(),f=c[b?0:c.length-1],g=f.cells.length;e(G,function(a){var b;return g=0,e(a,function(a){a.real&&(g+=a.colspan),a.elm.parentNode==f&&(b=1)}),b?!1:void 0}),b||a.reverse(),e(a,function(a){var c,e=a.cells.length;for(i=0;i<e;i++)c=a.cells[i],k(c,"colSpan",1),k(c,"rowSpan",1);for(i=e;i<g;i++)a.appendChild(o(a.cells[e-1]));for(i=g;i<e;i++)d.remove(a.cells[i]);b?f.parentNode.insertBefore(a,f):d.insertAfter(a,f)}),d.removeClass(d.select("td.mceSelected,th.mceSelected"),"mceSelected")}}function C(a){var b;return e(G,function(c,d){return e(c,function(c,e){return c.elm==a?(b={x:e,y:d},!1):void 0}),!b}),b}function D(a){H=C(a)}function E(){var a,b;return a=b=0,e(G,function(c,d){e(c,function(c,e){var f,g;l(c)&&(c=G[d][e],e>a&&(a=e),d>b&&(b=d),c.real&&(f=c.colspan-1,g=c.rowspan-1,f&&e+f>a&&(a=e+f),g&&d+g>b&&(b=d+g)))})}),{x:a,y:b}}function F(a){var b,c,e,f,g,h,i,j;if(I=C(a),H&&I){for(b=Math.min(H.x,I.x),c=Math.min(H.y,I.y),e=Math.max(H.x,I.x),f=Math.max(H.y,I.y),g=e,h=f,y=c;y<=h;y++)a=G[y][b],a.real||b-(a.colspan-1)<b&&(b-=a.colspan-1);for(x=b;x<=g;x++)a=G[c][x],a.real||c-(a.rowspan-1)<c&&(c-=a.rowspan-1);for(y=c;y<=f;y++)for(x=b;x<=e;x++)a=G[y][x],a.real&&(i=a.colspan-1,j=a.rowspan-1,i&&x+i>g&&(g=x+i),j&&y+j>h&&(h=y+j));for(d.removeClass(d.select("td.mceSelected,th.mceSelected"),"mceSelected"),y=c;y<=h;y++)for(x=b;x<=g;x++)G[y][x]&&d.addClass(G[y][x].elm,"mceSelected")}}var G,H,I,J;h(),J=d.getParent(f.getStart(),"th,td"),J&&(H=C(J),I=E(),J=j(H.x,H.y)),a.extend(this,{deleteTable:n,split:r,merge:s,insertRow:t,insertCol:u,deleteCols:v,deleteRows:w,cutRows:z,copyRows:A,pasteRows:B,getPos:C,setStartCell:D,setEndCell:F})}var e=a.each;a.create("tinymce.plugins.TablePlugin",{init:function(f,g){function h(a){var b=f.selection,c=f.dom.getParent(a||b.getNode(),"table");return c?new d(c,f.dom,b):void 0}function i(){f.getBody().style.webkitUserSelect="",l&&(f.dom.removeClass(f.dom.select("td.mceSelected,th.mceSelected"),"mceSelected"),l=!1)}var j,k,l=!0;e([["table","table.desc","mceInsertTable",!0],["delete_table","table.del","mceTableDelete"],["delete_col","table.delete_col_desc","mceTableDeleteCol"],["delete_row","table.delete_row_desc","mceTableDeleteRow"],["col_after","table.col_after_desc","mceTableInsertColAfter"],["col_before","table.col_before_desc","mceTableInsertColBefore"],["row_after","table.row_after_desc","mceTableInsertRowAfter"],["row_before","table.row_before_desc","mceTableInsertRowBefore"],["row_props","table.row_desc","mceTableRowProps",!0],["cell_props","table.cell_desc","mceTableCellProps",!0],["split_cells","table.split_cells_desc","mceTableSplitCells",!0],["merge_cells","table.merge_cells_desc","mceTableMergeCells",!0]],function(a){f.addButton(a[0],{title:a[1],cmd:a[2],ui:a[3]})}),a.isIE||f.onClick.add(function(a,b){b=b.target,"TABLE"===b.nodeName&&(a.selection.select(b),a.nodeChanged())}),f.onPreProcess.add(function(a,b){var c,d,e,f,g=a.dom;for(c=g.select("table",b.node),d=c.length;d--;)e=c[d],g.setAttrib(e,"data-mce-style",""),(f=g.getAttrib(e,"width"))&&(g.setStyle(e,"width",f),g.setAttrib(e,"width","")),(f=g.getAttrib(e,"height"))&&(g.setStyle(e,"height",f),g.setAttrib(e,"height",""))}),f.onNodeChange.add(function(a,b,c){var d;c=a.selection.getStart(),d=a.dom.getParent(c,"td,th,caption"),b.setActive("table","TABLE"===c.nodeName||!!d),d&&"CAPTION"===d.nodeName&&(d=0),b.setDisabled("delete_table",!d),b.setDisabled("delete_col",!d),b.setDisabled("delete_table",!d),b.setDisabled("delete_row",!d),b.setDisabled("col_after",!d),b.setDisabled("col_before",!d),b.setDisabled("row_after",!d),b.setDisabled("row_before",!d),b.setDisabled("row_props",!d),b.setDisabled("cell_props",!d),b.setDisabled("split_cells",!d),b.setDisabled("merge_cells",!d)}),f.onInit.add(function(d){function f(a,b,c,d){var e,f,g,h=3,i=a.dom.getParent(b.startContainer,"TABLE");return i&&(e=i.parentNode),f=b.startContainer.nodeType==h&&0==b.startOffset&&0==b.endOffset&&d&&("TR"==c.nodeName||c==e),g=("TD"==c.nodeName||"TH"==c.nodeName)&&!d,f||g}function g(b){if(a.isWebKit){var c=b.selection.getRng(),d=b.selection.getNode(),e=b.dom.getParent(c.startContainer,"TD,TH");if(f(b,c,d,e)){e||(e=d);for(var g=e.lastChild;g.lastChild;)g=g.lastChild;c.setEnd(g,g.nodeValue.length),b.selection.setRng(c)}}}function m(b,d){function f(c,d,e){var f=c?"previousSibling":"nextSibling",h=b.dom.getParent(d,"tr"),k=h[f];if(k)return q(b,d,k,c),a.dom.Event.cancel(e),!0;var l=b.dom.getParent(h,"table"),m=h.parentNode,n=m.nodeName.toLowerCase();if("tbody"===n||n===(c?"tfoot":"thead")){var o=g(c,l,m,"tbody");if(null!==o)return i(c,o,d,e)}return j(c,h,f,l,e)}function g(a,c,d,e){var f=b.dom.select(">"+e,c),g=f.indexOf(d);if(a&&0===g||!a&&g===f.length-1)return h(a,c);if(-1===g){var i="thead"===d.tagName.toLowerCase()?0:f.length-1;return f[i]}return f[g+(a?-1:1)]}function h(a,c){var d=a?"thead":"tfoot",e=b.dom.select(">"+d,c);return 0!==e.length?e[0]:null}function i(c,d,e,f){var g=k(d,c);return g&&q(b,e,g,c),a.dom.Event.cancel(f),!0}function j(c,d,e,g,h){var i=g[e];if(i)return l(i),!0;var j=b.dom.getParent(g,"td,th");if(j)return f(c,j,h);var m=k(d,!c);return l(m),a.dom.Event.cancel(h)}function k(a,c){var d=a&&a[c?"lastChild":"firstChild"];return d&&"BR"===d.nodeName?b.dom.getParent(d,"td,th"):d}function l(a){b.selection.setCursorLocation(a,0)}function m(){return u==t.UP||u==t.DOWN}function n(a){var b=a.selection.getNode(),c=a.dom.getParent(b,"tr");return null!==c}function o(a){for(var b=0,d=a;d.previousSibling;)d=d.previousSibling,b+=c(d,"colspan");return b}function p(a,b){var d=0,f=0;return e(a.children,function(a,e){return d+=c(a,"colspan"),f=e,d>b?!1:void 0}),f}function q(a,b,c,d){var e=o(a.dom.getParent(b,"td,th")),f=p(c,e),g=c.childNodes[f],h=k(g,d);l(h||g)}function r(a){var c=b.selection.getNode(),d=b.dom.getParent(c,"td,th"),e=b.dom.getParent(a,"td,th");return d&&d!==e&&s(d,e)}function s(a,c){return b.dom.getParent(a,"TABLE")===b.dom.getParent(c,"TABLE")}var t=a.VK,u=d.keyCode;if(m()&&n(b)){var v=b.selection.getNode();setTimeout(function(){r(v)&&f(!d.shiftKey&&u===t.UP,v,d)},0)}}function n(){var b;for(b=d.getBody().lastChild;b&&3==b.nodeType&&!b.nodeValue.length;b=b.previousSibling);b&&"TABLE"==b.nodeName&&(d.settings.forced_root_block?d.dom.add(d.getBody(),d.settings.forced_root_block,null,a.isIE?"&nbsp;":'<br data-mce-bogus="1" />'):d.dom.add(d.getBody(),"br",{"data-mce-bogus":"1"}))}var o,p,q,r=d.dom;j=d.windowManager,d.onMouseDown.add(function(a,b){2!=b.button&&(i(),p=r.getParent(b.target,"td,th"),o=r.getParent(p,"table"))}),r.bind(d.getDoc(),"mouseover",function(a){var b,c,e=a.target;if(p&&(q||e!=p)&&("TD"==e.nodeName||"TH"==e.nodeName)){c=r.getParent(e,"table"),c==o&&(q||(q=h(c),q.setStartCell(p),d.getBody().style.webkitUserSelect="none"),q.setEndCell(e),l=!0),b=d.selection.getSel();try{b.removeAllRanges?b.removeAllRanges():b.empty()}catch(f){}a.preventDefault()}}),d.onMouseUp.add(function(b){function c(b,c){var e=new a.dom.TreeWalker(b,b);do{if(3==b.nodeType&&0!=a.trim(b.nodeValue).length)return void(c?d.setStart(b,0):d.setEnd(b,b.nodeValue.length));if("BR"==b.nodeName)return void(c?d.setStartBefore(b):d.setEndBefore(b))}while(b=c?e.next():e.prev())}var d,e,f,g,h,i,j=b.selection;if(j.getSel(),p){if(q&&(b.getBody().style.webkitUserSelect=""),e=r.select("td.mceSelected,th.mceSelected"),e.length>0){d=r.createRng(),g=e[0],i=e[e.length-1],d.setStartBefore(g),d.setEndAfter(g),c(g,1),f=new a.dom.TreeWalker(g,r.getParent(e[0],"table"));do if("TD"==g.nodeName||"TH"==g.nodeName){if(!r.hasClass(g,"mceSelected"))break;h=g}while(g=f.next());c(h),j.setRng(d)}b.nodeChanged(),p=q=o=null}}),d.onKeyUp.add(function(){i()}),d.onKeyDown.add(function(a){g(a)}),d.onMouseDown.add(function(a,b){2!=b.button&&g(a)}),d.plugins.table.fixTableCellSelection=g,d&&d.plugins.contextmenu&&d.plugins.contextmenu.onContextMenu.add(function(a,b,c){var e,f=d.selection,g=f.getNode()||d.getBody();d.dom.getParent(c,"td")||d.dom.getParent(c,"th")||d.dom.select("td.mceSelected,th.mceSelected").length?(b.removeAll(),"A"!=g.nodeName||d.dom.getAttrib(g,"name")||(b.add({title:"advanced.link_desc",icon:"link",cmd:d.plugins.advlink?"mceAdvLink":"mceLink",ui:!0}),b.add({title:"advanced.unlink_desc",icon:"unlink",cmd:"UnLink"}),b.addSeparator()),"IMG"==g.nodeName&&-1==g.className.indexOf("mceItem")&&(b.add({title:"advanced.image_desc",icon:"image",cmd:d.plugins.advimage?"mceAdvImage":"mceImage",ui:!0}),b.addSeparator()),b.add({title:"table.desc",icon:"table",cmd:"mceInsertTable",value:{action:"insert"}}),b.add({title:"table.props_desc",icon:"table_props",cmd:"mceInsertTable"}),b.add({title:"table.del",icon:"delete_table",cmd:"mceTableDelete"}),b.addSeparator(),e=b.addMenu({title:"table.cell"}),e.add({title:"table.cell_desc",icon:"cell_props",cmd:"mceTableCellProps"}),e.add({title:"table.split_cells_desc",icon:"split_cells",cmd:"mceTableSplitCells"}),e.add({title:"table.merge_cells_desc",icon:"merge_cells",cmd:"mceTableMergeCells"}),e=b.addMenu({title:"table.row"}),e.add({title:"table.row_desc",icon:"row_props",cmd:"mceTableRowProps"}),e.add({title:"table.row_before_desc",icon:"row_before",cmd:"mceTableInsertRowBefore"}),e.add({title:"table.row_after_desc",icon:"row_after",cmd:"mceTableInsertRowAfter"}),e.add({title:"table.delete_row_desc",icon:"delete_row",cmd:"mceTableDeleteRow"}),e.addSeparator(),e.add({title:"table.cut_row_desc",icon:"cut",cmd:"mceTableCutRow"}),e.add({title:"table.copy_row_desc",icon:"copy",cmd:"mceTableCopyRow"}),e.add({title:"table.paste_row_before_desc",icon:"paste",cmd:"mceTablePasteRowBefore"}).setDisabled(!k),e.add({title:"table.paste_row_after_desc",icon:"paste",cmd:"mceTablePasteRowAfter"}).setDisabled(!k),e=b.addMenu({title:"table.col"}),e.add({title:"table.col_before_desc",icon:"col_before",cmd:"mceTableInsertColBefore"}),e.add({title:"table.col_after_desc",icon:"col_after",cmd:"mceTableInsertColAfter"}),e.add({title:"table.delete_col_desc",icon:"delete_col",cmd:"mceTableDeleteCol"})):b.add({title:"table.desc",icon:"table",cmd:"mceInsertTable"})}),a.isWebKit&&d.onKeyDown.add(m),a.isGecko&&d.onKeyDown.add(function(a,c){var d,e,f=a.dom;(37==c.keyCode||38==c.keyCode)&&(d=a.selection.getRng(),e=f.getParent(d.startContainer,"table"),e&&a.getBody().firstChild==e&&b(d,e)&&(d=f.createRng(),d.setStartBefore(e),d.setEndBefore(e),a.selection.setRng(d),c.preventDefault()))}),d.onKeyUp.add(n),d.onSetContent.add(n),d.onVisualAid.add(n),d.onPreProcess.add(function(a,b){var c=b.node.lastChild;c&&("BR"==c.nodeName||1==c.childNodes.length&&("BR"==c.firstChild.nodeName||" "==c.firstChild.nodeValue))&&c.previousSibling&&"TABLE"==c.previousSibling.nodeName&&a.dom.remove(c)}),n(),d.startContent=d.getContent({format:"raw"})}),e({mceTableSplitCells:function(a){a.split()},mceTableMergeCells:function(a){var b,c,d;d=f.dom.getParent(f.selection.getNode(),"th,td"),d&&(b=d.rowSpan,c=d.colSpan),f.dom.select("td.mceSelected,th.mceSelected").length?a.merge():j.open({url:g+"/merge_cells.htm",width:240+parseInt(f.getLang("table.merge_cells_delta_width",0)),height:110+parseInt(f.getLang("table.merge_cells_delta_height",0)),inline:1},{rows:b,cols:c,onaction:function(b){a.merge(d,b.cols,b.rows)},plugin_url:g})},mceTableInsertRowBefore:function(a){a.insertRow(!0)},mceTableInsertRowAfter:function(a){a.insertRow()},mceTableInsertColBefore:function(a){a.insertCol(!0)},mceTableInsertColAfter:function(a){a.insertCol()},mceTableDeleteCol:function(a){a.deleteCols()},mceTableDeleteRow:function(a){a.deleteRows()},mceTableCutRow:function(a){k=a.cutRows()},mceTableCopyRow:function(a){k=a.copyRows()},mceTablePasteRowBefore:function(a){a.pasteRows(k,!0)},mceTablePasteRowAfter:function(a){a.pasteRows(k)},mceTableDelete:function(a){a.deleteTable()}},function(a,b){f.addCommand(b,function(){var b=h();b&&(a(b),f.execCommand("mceRepaint"),i())})}),e({mceInsertTable:function(a){j.open({url:g+"/table.htm",width:400+parseInt(f.getLang("table.table_delta_width",0)),height:320+parseInt(f.getLang("table.table_delta_height",0)),inline:1},{plugin_url:g,action:a?a.action:0})},mceTableRowProps:function(){j.open({url:g+"/row.htm",width:400+parseInt(f.getLang("table.rowprops_delta_width",0)),height:295+parseInt(f.getLang("table.rowprops_delta_height",0)),inline:1},{plugin_url:g})},mceTableCellProps:function(){j.open({url:g+"/cell.htm",width:400+parseInt(f.getLang("table.cellprops_delta_width",0)),height:295+parseInt(f.getLang("table.cellprops_delta_height",0)),inline:1},{plugin_url:g})}},function(a,b){f.addCommand(b,function(b,c){a(c)})})}}),a.PluginManager.add("table",a.plugins.TablePlugin)}(tinymce);