function aggregateStyles(a){var b={};return tinymce.each(a,function(a){if(""!==a){var c=tinyMCEPopup.editor.dom.parseStyle(a);for(var d in c)c.hasOwnProperty(d)&&(void 0===b[d]?b[d]=c[d]:"text-decoration"===d&&-1===b[d].indexOf(c[d])&&(b[d]=b[d]+" "+c[d]))}}),b}function init(a){var b,c=document.getElementById("container");existingStyles=aggregateStyles(tinyMCEPopup.getWindowArg("styles")),c.style.cssText=tinyMCEPopup.editor.dom.serializeStyle(existingStyles),applyActionIsInsert=a.getParam("edit_css_style_insert_span",!1),document.getElementById("toggle_insert_span").checked=applyActionIsInsert,b=getBrowserHTML("background_image_browser","background_image","image","advimage"),document.getElementById("background_image_browser").innerHTML=b,document.getElementById("text_color_pickcontainer").innerHTML=getColorPickerHTML("text_color_pick","text_color"),document.getElementById("background_color_pickcontainer").innerHTML=getColorPickerHTML("background_color_pick","background_color"),document.getElementById("border_color_top_pickcontainer").innerHTML=getColorPickerHTML("border_color_top_pick","border_color_top"),document.getElementById("border_color_right_pickcontainer").innerHTML=getColorPickerHTML("border_color_right_pick","border_color_right"),document.getElementById("border_color_bottom_pickcontainer").innerHTML=getColorPickerHTML("border_color_bottom_pick","border_color_bottom"),document.getElementById("border_color_left_pickcontainer").innerHTML=getColorPickerHTML("border_color_left_pick","border_color_left"),fillSelect(0,"text_font","style_font",defaultFonts,";",!0),fillSelect(0,"text_size","style_font_size",defaultSizes,";",!0),fillSelect(0,"text_size_measurement","style_font_size_measurement",defaultMeasurement,";",!0),fillSelect(0,"text_case","style_text_case","capitalize;uppercase;lowercase",";",!0),fillSelect(0,"text_weight","style_font_weight",defaultWeight,";",!0),fillSelect(0,"text_style","style_font_style",defaultTextStyle,";",!0),fillSelect(0,"text_variant","style_font_variant",defaultVariant,";",!0),fillSelect(0,"text_lineheight","style_font_line_height",defaultLineHeight,";",!0),fillSelect(0,"text_lineheight_measurement","style_font_line_height_measurement",defaultMeasurement,";",!0),fillSelect(0,"background_attachment","style_background_attachment",defaultAttachment,";",!0),fillSelect(0,"background_repeat","style_background_repeat",defaultRepeat,";",!0),fillSelect(0,"background_hpos_measurement","style_background_hpos_measurement",defaultMeasurement,";",!0),fillSelect(0,"background_vpos_measurement","style_background_vpos_measurement",defaultMeasurement,";",!0),fillSelect(0,"background_hpos","style_background_hpos",defaultPosH,";",!0),fillSelect(0,"background_vpos","style_background_vpos",defaultPosV,";",!0),fillSelect(0,"block_wordspacing","style_wordspacing","normal",";",!0),fillSelect(0,"block_wordspacing_measurement","style_wordspacing_measurement",defaultSpacingMeasurement,";",!0),fillSelect(0,"block_letterspacing","style_letterspacing","normal",";",!0),fillSelect(0,"block_letterspacing_measurement","style_letterspacing_measurement",defaultSpacingMeasurement,";",!0),fillSelect(0,"block_vertical_alignment","style_vertical_alignment",defaultVAlign,";",!0),fillSelect(0,"block_text_align","style_text_align","left;right;center;justify",";",!0),fillSelect(0,"block_whitespace","style_whitespace","normal;pre;nowrap",";",!0),fillSelect(0,"block_display","style_display",defaultDisplay,";",!0),fillSelect(0,"block_text_indent_measurement","style_text_indent_measurement",defaultIndentMeasurement,";",!0),fillSelect(0,"box_width_measurement","style_box_width_measurement",defaultMeasurement,";",!0),fillSelect(0,"box_height_measurement","style_box_height_measurement",defaultMeasurement,";",!0),fillSelect(0,"box_float","style_float","left;right;none",";",!0),fillSelect(0,"box_clear","style_clear","left;right;both;none",";",!0),fillSelect(0,"box_padding_left_measurement","style_padding_left_measurement",defaultMeasurement,";",!0),fillSelect(0,"box_padding_top_measurement","style_padding_top_measurement",defaultMeasurement,";",!0),fillSelect(0,"box_padding_bottom_measurement","style_padding_bottom_measurement",defaultMeasurement,";",!0),fillSelect(0,"box_padding_right_measurement","style_padding_right_measurement",defaultMeasurement,";",!0),fillSelect(0,"box_margin_left_measurement","style_margin_left_measurement",defaultMeasurement,";",!0),fillSelect(0,"box_margin_top_measurement","style_margin_top_measurement",defaultMeasurement,";",!0),fillSelect(0,"box_margin_bottom_measurement","style_margin_bottom_measurement",defaultMeasurement,";",!0),fillSelect(0,"box_margin_right_measurement","style_margin_right_measurement",defaultMeasurement,";",!0),fillSelect(0,"border_style_top","style_border_style_top",defaultBorderStyle,";",!0),fillSelect(0,"border_style_right","style_border_style_right",defaultBorderStyle,";",!0),fillSelect(0,"border_style_bottom","style_border_style_bottom",defaultBorderStyle,";",!0),fillSelect(0,"border_style_left","style_border_style_left",defaultBorderStyle,";",!0),fillSelect(0,"border_width_top","style_border_width_top",defaultBorderWidth,";",!0),fillSelect(0,"border_width_right","style_border_width_right",defaultBorderWidth,";",!0),fillSelect(0,"border_width_bottom","style_border_width_bottom",defaultBorderWidth,";",!0),fillSelect(0,"border_width_left","style_border_width_left",defaultBorderWidth,";",!0),fillSelect(0,"border_width_top_measurement","style_border_width_top_measurement",defaultMeasurement,";",!0),fillSelect(0,"border_width_right_measurement","style_border_width_right_measurement",defaultMeasurement,";",!0),fillSelect(0,"border_width_bottom_measurement","style_border_width_bottom_measurement",defaultMeasurement,";",!0),fillSelect(0,"border_width_left_measurement","style_border_width_left_measurement",defaultMeasurement,";",!0),fillSelect(0,"list_type","style_list_type",defaultListType,";",!0),fillSelect(0,"list_position","style_list_position","inside;outside",";",!0),fillSelect(0,"positioning_type","style_positioning_type","absolute;relative;static",";",!0),fillSelect(0,"positioning_visibility","style_positioning_visibility","inherit;visible;hidden",";",!0),fillSelect(0,"positioning_width_measurement","style_positioning_width_measurement",defaultMeasurement,";",!0),fillSelect(0,"positioning_height_measurement","style_positioning_height_measurement",defaultMeasurement,";",!0),fillSelect(0,"positioning_overflow","style_positioning_overflow","visible;hidden;scroll;auto",";",!0),fillSelect(0,"positioning_placement_top_measurement","style_positioning_placement_top_measurement",defaultMeasurement,";",!0),fillSelect(0,"positioning_placement_right_measurement","style_positioning_placement_right_measurement",defaultMeasurement,";",!0),fillSelect(0,"positioning_placement_bottom_measurement","style_positioning_placement_bottom_measurement",defaultMeasurement,";",!0),fillSelect(0,"positioning_placement_left_measurement","style_positioning_placement_left_measurement",defaultMeasurement,";",!0),fillSelect(0,"positioning_clip_top_measurement","style_positioning_clip_top_measurement",defaultMeasurement,";",!0),fillSelect(0,"positioning_clip_right_measurement","style_positioning_clip_right_measurement",defaultMeasurement,";",!0),fillSelect(0,"positioning_clip_bottom_measurement","style_positioning_clip_bottom_measurement",defaultMeasurement,";",!0),fillSelect(0,"positioning_clip_left_measurement","style_positioning_clip_left_measurement",defaultMeasurement,";",!0),TinyMCE_EditableSelects.init(),setupFormData(),showDisabledControls()}function setupFormData(){var a,b=document.getElementById("container"),c=document.forms[0];selectByValue(c,"text_font",b.style.fontFamily,!0,!0),selectByValue(c,"text_size",getNum(b.style.fontSize),!0,!0),selectByValue(c,"text_size_measurement",getMeasurement(b.style.fontSize)),selectByValue(c,"text_weight",b.style.fontWeight,!0,!0),selectByValue(c,"text_style",b.style.fontStyle,!0,!0),selectByValue(c,"text_lineheight",getNum(b.style.lineHeight),!0,!0),selectByValue(c,"text_lineheight_measurement",getMeasurement(b.style.lineHeight)),selectByValue(c,"text_case",b.style.textTransform,!0,!0),selectByValue(c,"text_variant",b.style.fontVariant,!0,!0),c.text_color.value=tinyMCEPopup.editor.dom.toHex(b.style.color),updateColor("text_color_pick","text_color"),c.text_underline.checked=inStr(b.style.textDecoration,"underline"),c.text_overline.checked=inStr(b.style.textDecoration,"overline"),c.text_linethrough.checked=inStr(b.style.textDecoration,"line-through"),c.text_blink.checked=inStr(b.style.textDecoration,"blink"),c.text_none.checked=inStr(b.style.textDecoration,"none"),updateTextDecorations(),c.background_color.value=tinyMCEPopup.editor.dom.toHex(b.style.backgroundColor),updateColor("background_color_pick","background_color"),c.background_image.value=b.style.backgroundImage.replace(new RegExp("url\\('?([^']*)'?\\)","gi"),"$1"),selectByValue(c,"background_repeat",b.style.backgroundRepeat,!0,!0),selectByValue(c,"background_attachment",b.style.backgroundAttachment,!0,!0),selectByValue(c,"background_hpos",getNum(getVal(b.style.backgroundPosition,0)),!0,!0),selectByValue(c,"background_hpos_measurement",getMeasurement(getVal(b.style.backgroundPosition,0))),selectByValue(c,"background_vpos",getNum(getVal(b.style.backgroundPosition,1)),!0,!0),selectByValue(c,"background_vpos_measurement",getMeasurement(getVal(b.style.backgroundPosition,1))),selectByValue(c,"block_wordspacing",getNum(b.style.wordSpacing),!0,!0),selectByValue(c,"block_wordspacing_measurement",getMeasurement(b.style.wordSpacing)),selectByValue(c,"block_letterspacing",getNum(b.style.letterSpacing),!0,!0),selectByValue(c,"block_letterspacing_measurement",getMeasurement(b.style.letterSpacing)),selectByValue(c,"block_vertical_alignment",b.style.verticalAlign,!0,!0),selectByValue(c,"block_text_align",b.style.textAlign,!0,!0),c.block_text_indent.value=getNum(b.style.textIndent),selectByValue(c,"block_text_indent_measurement",getMeasurement(b.style.textIndent)),selectByValue(c,"block_whitespace",b.style.whiteSpace,!0,!0),selectByValue(c,"block_display",b.style.display,!0,!0),c.box_width.value=getNum(b.style.width),selectByValue(c,"box_width_measurement",getMeasurement(b.style.width)),c.box_height.value=getNum(b.style.height),selectByValue(c,"box_height_measurement",getMeasurement(b.style.height)),selectByValue(c,"box_float",b.style.cssFloat||b.style.styleFloat,!0,!0),selectByValue(c,"box_clear",b.style.clear,!0,!0),setupBox(c,b,"box_padding","padding",""),setupBox(c,b,"box_margin","margin",""),setupBox(c,b,"border_style","border","Style"),setupBox(c,b,"border_width","border","Width"),setupBox(c,b,"border_color","border","Color"),updateColor("border_color_top_pick","border_color_top"),updateColor("border_color_right_pick","border_color_right"),updateColor("border_color_bottom_pick","border_color_bottom"),updateColor("border_color_left_pick","border_color_left"),c.elements.border_color_top.value=tinyMCEPopup.editor.dom.toHex(c.elements.border_color_top.value),c.elements.border_color_right.value=tinyMCEPopup.editor.dom.toHex(c.elements.border_color_right.value),c.elements.border_color_bottom.value=tinyMCEPopup.editor.dom.toHex(c.elements.border_color_bottom.value),c.elements.border_color_left.value=tinyMCEPopup.editor.dom.toHex(c.elements.border_color_left.value),selectByValue(c,"list_type",b.style.listStyleType,!0,!0),selectByValue(c,"list_position",b.style.listStylePosition,!0,!0),c.list_bullet_image.value=b.style.listStyleImage.replace(new RegExp("url\\('?([^']*)'?\\)","gi"),"$1"),selectByValue(c,"positioning_type",b.style.position,!0,!0),selectByValue(c,"positioning_visibility",b.style.visibility,!0,!0),selectByValue(c,"positioning_overflow",b.style.overflow,!0,!0),c.positioning_zindex.value=b.style.zIndex?b.style.zIndex:"",c.positioning_width.value=getNum(b.style.width),selectByValue(c,"positioning_width_measurement",getMeasurement(b.style.width)),c.positioning_height.value=getNum(b.style.height),selectByValue(c,"positioning_height_measurement",getMeasurement(b.style.height)),setupBox(c,b,"positioning_placement","","",["top","right","bottom","left"]),a=b.style.clip.replace(new RegExp("rect\\('?([^']*)'?\\)","gi"),"$1"),a=a.replace(/,/g," "),hasEqualValues([getVal(a,0),getVal(a,1),getVal(a,2),getVal(a,3)])?(c.positioning_clip_top.value=getNum(getVal(a,0)),selectByValue(c,"positioning_clip_top_measurement",getMeasurement(getVal(a,0))),c.positioning_clip_right.value=c.positioning_clip_bottom.value=c.positioning_clip_left.value):(c.positioning_clip_top.value=getNum(getVal(a,0)),selectByValue(c,"positioning_clip_top_measurement",getMeasurement(getVal(a,0))),c.positioning_clip_right.value=getNum(getVal(a,1)),selectByValue(c,"positioning_clip_right_measurement",getMeasurement(getVal(a,1))),c.positioning_clip_bottom.value=getNum(getVal(a,2)),selectByValue(c,"positioning_clip_bottom_measurement",getMeasurement(getVal(a,2))),c.positioning_clip_left.value=getNum(getVal(a,3)),selectByValue(c,"positioning_clip_left_measurement",getMeasurement(getVal(a,3))))}function getMeasurement(a){return a.replace(/^([0-9.]+)(.*)$/,"$2")}function getNum(a){return new RegExp("^(?:[0-9.]+)(?:[a-z%]+)$","gi").test(a)?a.replace(/[^0-9.]/g,""):a}function inStr(a,b){return new RegExp(b,"gi").test(a)}function getVal(a,b){var c=a.split(" ");return c.length>1?c[b]:""}function setValue(a,b,c){"text"==a.elements[b].type?a.elements[b].value=c:selectByValue(a,b,c,!0,!0)}function setupBox(a,b,c,d,e,f){"undefined"==typeof f&&(f=["Top","Right","Bottom","Left"]),isSame(b,d,e,f)?(a.elements[c+"_same"].checked=!0,setValue(a,c+"_top",getNum(b.style[d+f[0]+e])),a.elements[c+"_top"].disabled=!1,a.elements[c+"_right"].value="",a.elements[c+"_right"].disabled=!0,a.elements[c+"_bottom"].value="",a.elements[c+"_bottom"].disabled=!0,a.elements[c+"_left"].value="",a.elements[c+"_left"].disabled=!0,a.elements[c+"_top_measurement"]&&(selectByValue(a,c+"_top_measurement",getMeasurement(b.style[d+f[0]+e])),a.elements[c+"_left_measurement"].disabled=!0,a.elements[c+"_bottom_measurement"].disabled=!0,a.elements[c+"_right_measurement"].disabled=!0)):(a.elements[c+"_same"].checked=!1,setValue(a,c+"_top",getNum(b.style[d+f[0]+e])),a.elements[c+"_top"].disabled=!1,setValue(a,c+"_right",getNum(b.style[d+f[1]+e])),a.elements[c+"_right"].disabled=!1,setValue(a,c+"_bottom",getNum(b.style[d+f[2]+e])),a.elements[c+"_bottom"].disabled=!1,setValue(a,c+"_left",getNum(b.style[d+f[3]+e])),a.elements[c+"_left"].disabled=!1,a.elements[c+"_top_measurement"]&&(selectByValue(a,c+"_top_measurement",getMeasurement(b.style[d+f[0]+e])),selectByValue(a,c+"_right_measurement",getMeasurement(b.style[d+f[1]+e])),selectByValue(a,c+"_bottom_measurement",getMeasurement(b.style[d+f[2]+e])),selectByValue(a,c+"_left_measurement",getMeasurement(b.style[d+f[3]+e])),a.elements[c+"_left_measurement"].disabled=!1,a.elements[c+"_bottom_measurement"].disabled=!1,a.elements[c+"_right_measurement"].disabled=!1))}function isSame(a,b,c,d){var e,f,g=[];for("undefined"==typeof d&&(d=["Top","Right","Bottom","Left"]),("undefined"==typeof c||null==c)&&(c=""),g[0]=a.style[b+d[0]+c],g[1]=a.style[b+d[1]+c],g[2]=a.style[b+d[2]+c],g[3]=a.style[b+d[3]+c],e=0;e<g.length;e++){if(null==g[e])return!1;for(f=0;f<g.length;f++)if(g[f]!=g[e])return!1}return!0}function hasEqualValues(a){var b,c;for(b=0;b<a.length;b++){if(null==a[b])return!1;for(c=0;c<a.length;c++)if(a[c]!=a[b])return!1}return!0}function toggleApplyAction(){applyActionIsInsert=!applyActionIsInsert}function applyAction(){var a=document.getElementById("container"),b=tinyMCEPopup.editor;generateCSS(),tinyMCEPopup.restoreSelection();var c=tinyMCEPopup.editor.dom.parseStyle(a.style.cssText);if(applyActionIsInsert)b.formatter.register("plugin_style",{inline:"span",styles:existingStyles}),b.formatter.remove("plugin_style"),b.formatter.register("plugin_style",{inline:"span",styles:c}),b.formatter.apply("plugin_style");else{var d;d=tinyMCEPopup.getWindowArg("applyStyleToBlocks")?b.selection.getSelectedBlocks():b.selection.getNode(),b.dom.setAttrib(d,"style",tinyMCEPopup.editor.dom.serializeStyle(c))}}function updateAction(){applyAction(),tinyMCEPopup.close()}function generateCSS(){{var a,b,c=document.getElementById("container"),d=document.forms[0];new RegExp("[0-9]+","g")}c.style.cssText="",c.style.fontFamily=d.text_font.value,c.style.fontSize=d.text_size.value+(isNum(d.text_size.value)?d.text_size_measurement.value||"px":""),c.style.fontStyle=d.text_style.value,c.style.lineHeight=d.text_lineheight.value+(isNum(d.text_lineheight.value)?d.text_lineheight_measurement.value:""),c.style.textTransform=d.text_case.value,c.style.fontWeight=d.text_weight.value,c.style.fontVariant=d.text_variant.value,c.style.color=d.text_color.value,a="",a+=d.text_underline.checked?" underline":"",a+=d.text_overline.checked?" overline":"",a+=d.text_linethrough.checked?" line-through":"",a+=d.text_blink.checked?" blink":"",a=a.length>0?a.substring(1):a,d.text_none.checked&&(a="none"),c.style.textDecoration=a,c.style.backgroundColor=d.background_color.value,c.style.backgroundImage=""!=d.background_image.value?"url("+d.background_image.value+")":"",c.style.backgroundRepeat=d.background_repeat.value,c.style.backgroundAttachment=d.background_attachment.value,""!=d.background_hpos.value&&(a="",a+=d.background_hpos.value+(isNum(d.background_hpos.value)?d.background_hpos_measurement.value:"")+" ",a+=d.background_vpos.value+(isNum(d.background_vpos.value)?d.background_vpos_measurement.value:""),c.style.backgroundPosition=a),c.style.wordSpacing=d.block_wordspacing.value+(isNum(d.block_wordspacing.value)?d.block_wordspacing_measurement.value:""),c.style.letterSpacing=d.block_letterspacing.value+(isNum(d.block_letterspacing.value)?d.block_letterspacing_measurement.value:""),c.style.verticalAlign=d.block_vertical_alignment.value,c.style.textAlign=d.block_text_align.value,c.style.textIndent=d.block_text_indent.value+(isNum(d.block_text_indent.value)?d.block_text_indent_measurement.value:""),c.style.whiteSpace=d.block_whitespace.value,c.style.display=d.block_display.value,c.style.width=d.box_width.value+(isNum(d.box_width.value)?d.box_width_measurement.value:""),c.style.height=d.box_height.value+(isNum(d.box_height.value)?d.box_height_measurement.value:""),c.style.styleFloat=d.box_float.value,c.style.cssFloat=d.box_float.value,c.style.clear=d.box_clear.value,d.box_padding_same.checked?c.style.padding=d.box_padding_top.value+(isNum(d.box_padding_top.value)?d.box_padding_top_measurement.value:""):(c.style.paddingTop=d.box_padding_top.value+(isNum(d.box_padding_top.value)?d.box_padding_top_measurement.value:""),c.style.paddingRight=d.box_padding_right.value+(isNum(d.box_padding_right.value)?d.box_padding_right_measurement.value:""),c.style.paddingBottom=d.box_padding_bottom.value+(isNum(d.box_padding_bottom.value)?d.box_padding_bottom_measurement.value:""),c.style.paddingLeft=d.box_padding_left.value+(isNum(d.box_padding_left.value)?d.box_padding_left_measurement.value:"")),d.box_margin_same.checked?c.style.margin=d.box_margin_top.value+(isNum(d.box_margin_top.value)?d.box_margin_top_measurement.value:""):(c.style.marginTop=d.box_margin_top.value+(isNum(d.box_margin_top.value)?d.box_margin_top_measurement.value:""),c.style.marginRight=d.box_margin_right.value+(isNum(d.box_margin_right.value)?d.box_margin_right_measurement.value:""),c.style.marginBottom=d.box_margin_bottom.value+(isNum(d.box_margin_bottom.value)?d.box_margin_bottom_measurement.value:""),c.style.marginLeft=d.box_margin_left.value+(isNum(d.box_margin_left.value)?d.box_margin_left_measurement.value:"")),d.border_style_same.checked?c.style.borderStyle=d.border_style_top.value:(c.style.borderTopStyle=d.border_style_top.value,c.style.borderRightStyle=d.border_style_right.value,c.style.borderBottomStyle=d.border_style_bottom.value,c.style.borderLeftStyle=d.border_style_left.value),d.border_width_same.checked?c.style.borderWidth=d.border_width_top.value+(isNum(d.border_width_top.value)?d.border_width_top_measurement.value:""):(c.style.borderTopWidth=d.border_width_top.value+(isNum(d.border_width_top.value)?d.border_width_top_measurement.value:""),c.style.borderRightWidth=d.border_width_right.value+(isNum(d.border_width_right.value)?d.border_width_right_measurement.value:""),c.style.borderBottomWidth=d.border_width_bottom.value+(isNum(d.border_width_bottom.value)?d.border_width_bottom_measurement.value:""),c.style.borderLeftWidth=d.border_width_left.value+(isNum(d.border_width_left.value)?d.border_width_left_measurement.value:"")),d.border_color_same.checked?c.style.borderColor=d.border_color_top.value:(c.style.borderTopColor=d.border_color_top.value,c.style.borderRightColor=d.border_color_right.value,c.style.borderBottomColor=d.border_color_bottom.value,c.style.borderLeftColor=d.border_color_left.value),c.style.listStyleType=d.list_type.value,c.style.listStylePosition=d.list_position.value,c.style.listStyleImage=""!=d.list_bullet_image.value?"url("+d.list_bullet_image.value+")":"",c.style.position=d.positioning_type.value,c.style.visibility=d.positioning_visibility.value,""==c.style.width&&(c.style.width=d.positioning_width.value+(isNum(d.positioning_width.value)?d.positioning_width_measurement.value:"")),""==c.style.height&&(c.style.height=d.positioning_height.value+(isNum(d.positioning_height.value)?d.positioning_height_measurement.value:"")),c.style.zIndex=d.positioning_zindex.value,c.style.overflow=d.positioning_overflow.value,d.positioning_placement_same.checked?(a=d.positioning_placement_top.value+(isNum(d.positioning_placement_top.value)?d.positioning_placement_top_measurement.value:""),c.style.top=a,c.style.right=a,c.style.bottom=a,c.style.left=a):(c.style.top=d.positioning_placement_top.value+(isNum(d.positioning_placement_top.value)?d.positioning_placement_top_measurement.value:""),c.style.right=d.positioning_placement_right.value+(isNum(d.positioning_placement_right.value)?d.positioning_placement_right_measurement.value:""),c.style.bottom=d.positioning_placement_bottom.value+(isNum(d.positioning_placement_bottom.value)?d.positioning_placement_bottom_measurement.value:""),c.style.left=d.positioning_placement_left.value+(isNum(d.positioning_placement_left.value)?d.positioning_placement_left_measurement.value:"")),d.positioning_clip_same.checked?(a="rect(",b=isNum(d.positioning_clip_top.value)?d.positioning_clip_top.value+d.positioning_clip_top_measurement.value:"auto",a+=b+" ",a+=b+" ",a+=b+" ",a+=b+")","rect(auto auto auto auto)"!=a&&(c.style.clip=a)):(a="rect(",a+=(isNum(d.positioning_clip_top.value)?d.positioning_clip_top.value+d.positioning_clip_top_measurement.value:"auto")+" ",a+=(isNum(d.positioning_clip_right.value)?d.positioning_clip_right.value+d.positioning_clip_right_measurement.value:"auto")+" ",a+=(isNum(d.positioning_clip_bottom.value)?d.positioning_clip_bottom.value+d.positioning_clip_bottom_measurement.value:"auto")+" ",a+=isNum(d.positioning_clip_left.value)?d.positioning_clip_left.value+d.positioning_clip_left_measurement.value:"auto",a+=")","rect(auto auto auto auto)"!=a&&(c.style.clip=a)),c.style.cssText=c.style.cssText}function isNum(a){return new RegExp("[0-9]+","g").test(a)}function showDisabledControls(){var a,b,c=document.forms;for(a=0;a<c.length;a++)for(b=0;b<c[a].elements.length;b++)c[a].elements[b].disabled?tinyMCEPopup.editor.dom.addClass(c[a].elements[b],"disabled"):tinyMCEPopup.editor.dom.removeClass(c[a].elements[b],"disabled")}function fillSelect(a,b,c,d,e,f){var g,h,i,j;for(a=document.forms[a],e="undefined"==typeof e?";":e,f&&addSelectValue(a,b,"",""),h=tinyMCEPopup.getParam(c,d).split(e),g=0;g<h.length;g++)j=!1,"+"==h[g].charAt(0)&&(h[g]=h[g].substring(1),j=!0),i=h[g].split("="),i.length>1?(addSelectValue(a,b,i[0],i[1]),j&&selectByValue(a,b,i[1])):(addSelectValue(a,b,i[0],i[0]),j&&selectByValue(a,b,i[0]))}function toggleSame(a,b){var c=document.forms[0].elements;a.checked?(c[b+"_top"].disabled=!1,c[b+"_right"].disabled=!0,c[b+"_bottom"].disabled=!0,c[b+"_left"].disabled=!0,c[b+"_top_measurement"]&&(c[b+"_top_measurement"].disabled=!1,c[b+"_right_measurement"].disabled=!0,c[b+"_bottom_measurement"].disabled=!0,c[b+"_left_measurement"].disabled=!0)):(c[b+"_top"].disabled=!1,c[b+"_right"].disabled=!1,c[b+"_bottom"].disabled=!1,c[b+"_left"].disabled=!1,c[b+"_top_measurement"]&&(c[b+"_top_measurement"].disabled=!1,c[b+"_right_measurement"].disabled=!1,c[b+"_bottom_measurement"].disabled=!1,c[b+"_left_measurement"].disabled=!1)),showDisabledControls()}function synch(a,b){var c=document.forms[0];c.elements[b].value=c.elements[a].value,c.elements[a+"_measurement"]&&selectByValue(c,b+"_measurement",c.elements[a+"_measurement"].value)}function updateTextDecorations(){var a=document.forms[0].elements,b=["text_underline","text_overline","text_linethrough","text_blink"],c=a.text_none.checked;tinymce.each(b,function(b){a[b].disabled=c,c&&(a[b].checked=!1)})}tinyMCEPopup.requireLangPack();var defaultFonts="Arial, Helvetica, sans-serif=Arial, Helvetica, sans-serif;Times New Roman, Times, serif=Times New Roman, Times, serif;Courier New, Courier, mono=Courier New, Courier, mono;Times New Roman, Times, serif=Times New Roman, Times, serif;Georgia, Times New Roman, Times, serif=Georgia, Times New Roman, Times, serif;Verdana, Arial, Helvetica, sans-serif=Verdana, Arial, Helvetica, sans-serif;Geneva, Arial, Helvetica, sans-serif=Geneva, Arial, Helvetica, sans-serif",defaultSizes="9;10;12;14;16;18;24;xx-small;x-small;small;medium;large;x-large;xx-large;smaller;larger",defaultMeasurement="+pixels=px;points=pt;inches=in;centimetres=cm;millimetres=mm;picas=pc;ems=em;exs=ex;%",defaultSpacingMeasurement="pixels=px;points=pt;inches=in;centimetres=cm;millimetres=mm;picas=pc;+ems=em;exs=ex;%",defaultIndentMeasurement="pixels=px;+points=pt;inches=in;centimetres=cm;millimetres=mm;picas=pc;ems=em;exs=ex;%",defaultWeight="normal;bold;bolder;lighter;100;200;300;400;500;600;700;800;900",defaultTextStyle="normal;italic;oblique",defaultVariant="normal;small-caps",defaultLineHeight="normal",defaultAttachment="fixed;scroll",defaultRepeat="no-repeat;repeat;repeat-x;repeat-y",defaultPosH="left;center;right",defaultPosV="top;center;bottom",defaultVAlign="baseline;sub;super;top;text-top;middle;bottom;text-bottom",defaultDisplay="inline;block;list-item;run-in;compact;marker;table;inline-table;table-row-group;table-header-group;table-footer-group;table-row;table-column-group;table-column;table-cell;table-caption;none",defaultBorderStyle="none;solid;dashed;dotted;double;groove;ridge;inset;outset",defaultBorderWidth="thin;medium;thick",defaultListType="disc;circle;square;decimal;lower-roman;upper-roman;lower-alpha;upper-alpha;none",applyActionIsInsert,existingStyles;tinyMCEPopup.onInit.add(init);