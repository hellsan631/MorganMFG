!function(){var a=tinymce.DOM;tinymce.ThemeManager.requireLangPack("simple"),tinymce.create("tinymce.themes.SimpleTheme",{init:function(b,c){var d=this,e=["Bold","Italic","Underline","Strikethrough","InsertUnorderedList","InsertOrderedList"],f=b.settings;d.editor=b,b.contentCSS.push(c+"/skins/"+f.skin+"/content.css"),b.onInit.add(function(){b.onNodeChange.add(function(a,b){tinymce.each(e,function(c){b.get(c.toLowerCase()).setActive(a.queryCommandState(c))})})}),a.loadCSS((f.editor_css?b.documentBaseURI.toAbsolute(f.editor_css):"")||c+"/skins/"+f.skin+"/ui.css")},renderUI:function(b){var c,d,e,f=this,g=b.targetNode,h=f.editor,i=h.controlManager;return g=a.insertAfter(a.create("span",{id:h.id+"_container","class":"mceEditor "+h.settings.skin+"SimpleSkin"}),g),g=e=a.add(g,"table",{cellPadding:0,cellSpacing:0,"class":"mceLayout"}),g=d=a.add(g,"tbody"),g=a.add(d,"tr"),g=c=a.add(a.add(g,"td"),"div",{"class":"mceIframeContainer"}),g=a.add(a.add(d,"tr",{"class":"last"}),"td",{"class":"mceToolbar mceLast",align:"center"}),d=f.toolbar=i.createToolbar("tools1"),d.add(i.createButton("bold",{title:"simple.bold_desc",cmd:"Bold"})),d.add(i.createButton("italic",{title:"simple.italic_desc",cmd:"Italic"})),d.add(i.createButton("underline",{title:"simple.underline_desc",cmd:"Underline"})),d.add(i.createButton("strikethrough",{title:"simple.striketrough_desc",cmd:"Strikethrough"})),d.add(i.createSeparator()),d.add(i.createButton("undo",{title:"simple.undo_desc",cmd:"Undo"})),d.add(i.createButton("redo",{title:"simple.redo_desc",cmd:"Redo"})),d.add(i.createSeparator()),d.add(i.createButton("cleanup",{title:"simple.cleanup_desc",cmd:"mceCleanup"})),d.add(i.createSeparator()),d.add(i.createButton("insertunorderedlist",{title:"simple.bullist_desc",cmd:"InsertUnorderedList"})),d.add(i.createButton("insertorderedlist",{title:"simple.numlist_desc",cmd:"InsertOrderedList"})),d.renderTo(g),{iframeContainer:c,editorContainer:h.id+"_container",sizeContainer:e,deltaHeight:-20}},getInfo:function(){return{longname:"Simple theme",author:"Moxiecode Systems AB",authorurl:"http://tinymce.moxiecode.com",version:tinymce.majorVersion+"."+tinymce.minorVersion}}}),tinymce.ThemeManager.add("simple",tinymce.themes.SimpleTheme)}();
//# sourceMappingURL=editor_template.map