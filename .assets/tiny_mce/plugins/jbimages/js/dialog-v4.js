var jbImagesDialog={resized:!1,iframeOpened:!1,timeoutStore:!1,inProgress:function(){document.getElementById("upload_infobar").style.display="none",document.getElementById("upload_additional_info").innerHTML="",document.getElementById("upload_form_container").style.display="none",document.getElementById("upload_in_progress").style.display="block",this.timeoutStore=window.setTimeout(function(){document.getElementById("upload_additional_info").innerHTML='This is taking longer than usual.<br />An error may have occurred.<br /><a href="#" onClick="jbImagesDialog.showIframe()">View script\'s output</a>'},2e4)},showIframe:function(){0==this.iframeOpened&&(document.getElementById("upload_target").className="upload_target_visible",this.iframeOpened=!0)},uploadFinish:function(a){if("failed"==a.resultCode)window.clearTimeout(this.timeoutStore),document.getElementById("upload_in_progress").style.display="none",document.getElementById("upload_infobar").style.display="block",document.getElementById("upload_infobar").innerHTML=a.result,document.getElementById("upload_form_container").style.display="block",0==this.resized&&(this.resized=!0);else{document.getElementById("upload_in_progress").style.display="none",document.getElementById("upload_infobar").style.display="block",document.getElementById("upload_infobar").innerHTML="Upload Complete";var b=this.getWin();tinymce=b.tinymce,tinymce.EditorManager.activeEditor.insertContent('<img src="'+a.filename+'">'),this.close()}},getWin:function(){return!window.frameElement&&window.dialogArguments||opener||parent||top},close:function(){function a(){tinymce.EditorManager.activeEditor.windowManager.close(window),tinymce=tinyMCE=b.editor=b.params=b.dom=b.dom.doc=null}var b=this;tinymce.isOpera?this.getWin().setTimeout(a,0):a()}};
//# sourceMappingURL=dialog-v4.map