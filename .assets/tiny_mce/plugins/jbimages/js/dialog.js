tinyMCEPopup.requireLangPack();var jbImagesDialog={resized:!1,iframeOpened:!1,timeoutStore:!1,init:function(){document.getElementById("upload_target").src+="/"+tinyMCEPopup.getLang("jbimages_dlg.lang_id","english"),navigator.userAgent.indexOf("Opera")>-1&&(document.getElementById("close_link").style.display="block")},inProgress:function(){document.getElementById("upload_infobar").style.display="none",document.getElementById("upload_additional_info").innerHTML="",document.getElementById("upload_form_container").style.display="none",document.getElementById("upload_in_progress").style.display="block",this.timeoutStore=window.setTimeout(function(){document.getElementById("upload_additional_info").innerHTML=tinyMCEPopup.getLang("jbimages_dlg.longer_than_usual",0)+"<br />"+tinyMCEPopup.getLang("jbimages_dlg.maybe_an_error",0)+'<br /><a href="#" onClick="jbImagesDialog.showIframe()">'+tinyMCEPopup.getLang("jbimages_dlg.view_output",0)+"</a>",tinyMCEPopup.editor.windowManager.resizeBy(0,30,tinyMCEPopup.id)},2e4)},showIframe:function(){0==this.iframeOpened&&(document.getElementById("upload_target").className="upload_target_visible",tinyMCEPopup.editor.windowManager.resizeBy(0,190,tinyMCEPopup.id),this.iframeOpened=!0)},uploadFinish:function(a){"failed"==a.resultCode?(window.clearTimeout(this.timeoutStore),document.getElementById("upload_in_progress").style.display="none",document.getElementById("upload_infobar").style.display="block",document.getElementById("upload_infobar").innerHTML=a.result,document.getElementById("upload_form_container").style.display="block",0==this.resized&&(tinyMCEPopup.editor.windowManager.resizeBy(0,30,tinyMCEPopup.id),this.resized=!0)):(document.getElementById("upload_in_progress").style.display="none",document.getElementById("upload_infobar").style.display="block",document.getElementById("upload_infobar").innerHTML=tinyMCEPopup.getLang("jbimages_dlg.upload_complete",0),tinyMCEPopup.editor.execCommand("mceInsertContent",!1,'<img src="'+a.filename+'" />'),tinyMCEPopup.close())}};tinyMCEPopup.onInit.add(jbImagesDialog.init,jbImagesDialog);
//# sourceMappingURL=dialog.map