!function(a){a.fn.equalHeight=function(){tallest=0,this.each(function(){thisHeight=a(this).height(),thisHeight>tallest&&(tallest=thisHeight)}),this.each(function(){a(this).height(tallest)})}}(jQuery),function(a){"use strict";"function"==typeof define&&define.amd?define(["jquery","load-image","canvas-to-blob","./jquery.fileupload"],a):a(window.jQuery,window.loadImage)}(function(a,b){"use strict";a.widget("blueimpFP.fileupload",a.blueimp.fileupload,{options:{process:[],add:function(b,c){a(this).fileupload("process",c).done(function(){c.submit()})}},processActions:{load:function(c,d){var e=this,f=c.files[c.index],g=a.Deferred();return window.HTMLCanvasElement&&window.HTMLCanvasElement.prototype.toBlob&&("number"!==a.type(d.maxFileSize)||f.size<d.maxFileSize)&&(!d.fileTypes||d.fileTypes.test(f.type))?b(f,function(a){c.canvas=a,g.resolveWith(e,[c])},{canvas:!0}):g.rejectWith(e,[c]),g.promise()},resize:function(a,c){if(a.canvas){var d=b.scale(a.canvas,c);(d.width!==a.canvas.width||d.height!==a.canvas.height)&&(a.canvas=d,a.processed=!0)}return a},save:function(b){if(!b.canvas||!b.processed)return b;var c=this,d=b.files[b.index],e=d.name,f=a.Deferred(),g=function(a){a.name||(d.type===a.type?a.name=d.name:d.name&&(a.name=d.name.replace(/\..+$/,"."+a.type.substr(6)))),b.files[b.index]=a,f.resolveWith(c,[b])};return b.canvas.mozGetAsFile?g(b.canvas.mozGetAsFile(/^image\/(jpeg|png)$/.test(d.type)&&e||(e&&e.replace(/\..+$/,"")||"blob")+".png",d.type)):b.canvas.toBlob(g,d.type),f.promise()}},_processFile:function(b,c,d){var e=this,f=a.Deferred().resolveWith(e,[{files:b,index:c}]),g=f.promise();return e._processing+=1,a.each(d.process,function(a,b){g=g.pipe(function(a){return e.processActions[b.action].call(this,a,b)})}),g.always(function(){e._processing-=1,0===e._processing&&e.element.removeClass("fileupload-processing")}),1===e._processing&&e.element.addClass("fileupload-processing"),g},process:function(b){var c=this,d=a.extend({},this.options,b);return d.process&&d.process.length&&this._isXHRUpload(d)&&a.each(b.files,function(e){c._processingQueue=c._processingQueue.pipe(function(){var f=a.Deferred();return c._processFile(b.files,e,d).always(function(){f.resolveWith(c)}),f.promise()})}),this._processingQueue},_create:function(){a.blueimp.fileupload.prototype._create.call(this),this._processing=0,this._processingQueue=a.Deferred().resolveWith(this).promise()}})}),function(a){"use strict";"function"==typeof define&&define.amd?define(["jquery","tmpl","load-image","./jquery.fileupload-fp"],a):a(window.jQuery,window.tmpl,window.loadImage)}(function(a,b,c){"use strict";var d=(a.blueimpFP||a.blueimp).fileupload;a.widget("blueimpUI.fileupload",d,{options:{autoUpload:!1,maxNumberOfFiles:void 0,maxFileSize:void 0,minFileSize:void 0,acceptFileTypes:/.+$/i,previewSourceFileTypes:/^image\/(gif|jpeg|png)$/,previewSourceMaxFileSize:5e6,previewMaxWidth:80,previewMaxHeight:80,previewAsCanvas:!0,uploadTemplateId:"template-upload",downloadTemplateId:"template-download",filesContainer:void 0,prependFiles:!1,dataType:"json",add:function(b,c){var d=a(this).data("fileupload"),e=d.options,f=c.files;a(this).fileupload("process",c).done(function(){d._adjustMaxNumberOfFiles(-f.length),c.maxNumberOfFilesAdjusted=!0,c.files.valid=c.isValidated=d._validate(f),c.context=d._renderUpload(f).data("data",c),e.filesContainer[e.prependFiles?"prepend":"append"](c.context),d._renderPreviews(f,c.context),d._forceReflow(c.context),d._transition(c.context).done(function(){d._trigger("added",b,c)!==!1&&(e.autoUpload||c.autoUpload)&&c.autoUpload!==!1&&c.isValidated&&c.submit()})})},send:function(b,c){var d=a(this).data("fileupload");return c.isValidated||(c.maxNumberOfFilesAdjusted||(d._adjustMaxNumberOfFiles(-c.files.length),c.maxNumberOfFilesAdjusted=!0),d._validate(c.files))?(c.context&&c.dataType&&"iframe"===c.dataType.substr(0,6)&&c.context.find(".progress").addClass(!a.support.transition&&"progress-animated").attr("aria-valuenow",100).find(".bar").css("width","100%"),d._trigger("sent",b,c)):!1},done:function(b,c){var d,e=a(this).data("fileupload");c.context?c.context.each(function(f){var g=a.isArray(c.result)&&c.result[f]||{error:"emptyResult"};g.error&&e._adjustMaxNumberOfFiles(1),e._transition(a(this)).done(function(){var f=a(this);d=e._renderDownload([g]).replaceAll(f),e._forceReflow(d),e._transition(d).done(function(){c.context=a(this),e._trigger("completed",b,c)})})}):(a.isArray(c.result)&&(a.each(c.result,function(a,b){c.maxNumberOfFilesAdjusted&&b.error?e._adjustMaxNumberOfFiles(1):c.maxNumberOfFilesAdjusted||b.error||e._adjustMaxNumberOfFiles(-1)}),c.maxNumberOfFilesAdjusted=!0),d=e._renderDownload(c.result).appendTo(e.options.filesContainer),e._forceReflow(d),e._transition(d).done(function(){c.context=a(this),e._trigger("completed",b,c)}))},fail:function(b,c){var d,e=a(this).data("fileupload");c.maxNumberOfFilesAdjusted&&e._adjustMaxNumberOfFiles(c.files.length),c.context?c.context.each(function(f){if("abort"!==c.errorThrown){var g=c.files[f];g.error=g.error||c.errorThrown||!0,e._transition(a(this)).done(function(){var f=a(this);d=e._renderDownload([g]).replaceAll(f),e._forceReflow(d),e._transition(d).done(function(){c.context=a(this),e._trigger("failed",b,c)})})}else e._transition(a(this)).done(function(){a(this).remove(),e._trigger("failed",b,c)})}):"abort"!==c.errorThrown?(c.context=e._renderUpload(c.files).appendTo(e.options.filesContainer).data("data",c),e._forceReflow(c.context),e._transition(c.context).done(function(){c.context=a(this),e._trigger("failed",b,c)})):e._trigger("failed",b,c)},progress:function(a,b){if(b.context){var c=parseInt(b.loaded/b.total*100,10);b.context.find(".progress").attr("aria-valuenow",c).find(".bar").css("width",c+"%")}},progressall:function(b,c){var d=a(this),e=parseInt(c.loaded/c.total*100,10),f=d.find(".fileupload-progress"),g=f.find(".progress-extended");g.length&&g.html(d.data("fileupload")._renderExtendedProgress(c)),f.find(".progress").attr("aria-valuenow",e).find(".bar").css("width",e+"%")},start:function(b){var c=a(this).data("fileupload");c._transition(a(this).find(".fileupload-progress")).done(function(){c._trigger("started",b)})},stop:function(b){var c=a(this).data("fileupload");c._transition(a(this).find(".fileupload-progress")).done(function(){a(this).find(".progress").attr("aria-valuenow","0").find(".bar").css("width","0%"),a(this).find(".progress-extended").html("&nbsp;"),c._trigger("stopped",b)})},destroy:function(b,c){var d=a(this).data("fileupload");c.url&&(a.ajax(c),d._adjustMaxNumberOfFiles(1)),d._transition(c.context).done(function(){a(this).remove(),d._trigger("destroyed",b,c)})}},_enableDragToDesktop:function(){var b=a(this),c=b.prop("href"),d=b.prop("download"),e="application/octet-stream";b.bind("dragstart",function(a){try{a.originalEvent.dataTransfer.setData("DownloadURL",[e,d,c].join(":"))}catch(b){}})},_adjustMaxNumberOfFiles:function(a){"number"==typeof this.options.maxNumberOfFiles&&(this.options.maxNumberOfFiles+=a,this.options.maxNumberOfFiles<1?this._disableFileInputButton():this._enableFileInputButton())},_formatFileSize:function(a){return"number"!=typeof a?"":a>=1e9?(a/1e9).toFixed(2)+" GB":a>=1e6?(a/1e6).toFixed(2)+" MB":(a/1e3).toFixed(2)+" KB"},_formatBitrate:function(a){return"number"!=typeof a?"":a>=1e9?(a/1e9).toFixed(2)+" Gbit/s":a>=1e6?(a/1e6).toFixed(2)+" Mbit/s":a>=1e3?(a/1e3).toFixed(2)+" kbit/s":a+" bit/s"},_formatTime:function(a){var b=new Date(1e3*a),c=parseInt(a/86400,10);return c=c?c+"d ":"",c+("0"+b.getUTCHours()).slice(-2)+":"+("0"+b.getUTCMinutes()).slice(-2)+":"+("0"+b.getUTCSeconds()).slice(-2)},_formatPercentage:function(a){return(100*a).toFixed(2)+" %"},_renderExtendedProgress:function(a){return this._formatBitrate(a.bitrate)+" | "+this._formatTime(8*(a.total-a.loaded)/a.bitrate)+" | "+this._formatPercentage(a.loaded/a.total)+" | "+this._formatFileSize(a.loaded)+" / "+this._formatFileSize(a.total)},_hasError:function(a){return a.error?a.error:this.options.maxNumberOfFiles<0?"maxNumberOfFiles":this.options.acceptFileTypes.test(a.type)||this.options.acceptFileTypes.test(a.name)?this.options.maxFileSize&&a.size>this.options.maxFileSize?"maxFileSize":"number"==typeof a.size&&a.size<this.options.minFileSize?"minFileSize":null:"acceptFileTypes"},_validate:function(b){var c=this,d=!!b.length;return a.each(b,function(a,b){b.error=c._hasError(b),b.error&&(d=!1)}),d},_renderTemplate:function(b,c){if(!b)return a();var d=b({files:c,formatFileSize:this._formatFileSize,options:this.options});return d instanceof a?d:a(this.options.templatesContainer).html(d).children()},_renderPreview:function(b,d){var e=this,f=this.options,g=a.Deferred();return(c&&c(b,function(b){d.append(b),e._forceReflow(d),e._transition(d).done(function(){g.resolveWith(d)}),a.contains(document.body,d[0])||g.resolveWith(d)},{maxWidth:f.previewMaxWidth,maxHeight:f.previewMaxHeight,canvas:f.previewAsCanvas})||g.resolveWith(d))&&g},_renderPreviews:function(b,c){var d=this,e=this.options;return c.find(".preview span").each(function(c,f){var g=b[c];e.previewSourceFileTypes.test(g.type)&&("number"!==a.type(e.previewSourceMaxFileSize)||g.size<e.previewSourceMaxFileSize)&&(d._processingQueue=d._processingQueue.pipe(function(){var b=a.Deferred();return d._renderPreview(g,a(f)).done(function(){b.resolveWith(d)}),b.promise()}))}),this._processingQueue},_renderUpload:function(a){return this._renderTemplate(this.options.uploadTemplate,a)},_renderDownload:function(a){return this._renderTemplate(this.options.downloadTemplate,a).find("a[download]").each(this._enableDragToDesktop).end()},_startHandler:function(b){b.preventDefault();var c=a(this),d=c.closest(".template-upload"),e=d.data("data");e&&e.submit&&!e.jqXHR&&e.submit()&&c.prop("disabled",!0)},_cancelHandler:function(b){b.preventDefault();var c=a(this).closest(".template-upload"),d=c.data("data")||{};d.jqXHR?d.jqXHR.abort():(d.errorThrown="abort",b.data.fileupload._trigger("fail",b,d))},_deleteHandler:function(b){b.preventDefault();var c=a(this);b.data.fileupload._trigger("destroy",b,{context:c.closest(".template-download"),url:c.attr("data-url"),type:c.attr("data-type")||"DELETE",dataType:b.data.fileupload.options.dataType})},_forceReflow:function(b){return a.support.transition&&b.length&&b[0].offsetWidth},_transition:function(b){var c=a.Deferred();return a.support.transition&&b.hasClass("fade")?b.bind(a.support.transition.end,function(d){d.target===b[0]&&(b.unbind(a.support.transition.end),c.resolveWith(b))}).toggleClass("in"):(b.toggleClass("in"),c.resolveWith(b)),c},_initButtonBarEventHandlers:function(){var b=this.element.find(".fileupload-buttonbar"),c=this.options.filesContainer,d=this.options.namespace;b.find(".start").bind("click."+d,function(a){a.preventDefault(),c.find(".start button").click()}),b.find(".cancel").bind("click."+d,function(a){a.preventDefault(),c.find(".cancel button").click()}),b.find(".delete").bind("click."+d,function(a){a.preventDefault(),c.find(".delete input:checked").siblings("button").click(),b.find(".toggle").prop("checked",!1)}),b.find(".toggle").bind("change."+d,function(){c.find(".delete input").prop("checked",a(this).is(":checked"))})},_destroyButtonBarEventHandlers:function(){this.element.find(".fileupload-buttonbar button").unbind("click."+this.options.namespace),this.element.find(".fileupload-buttonbar .toggle").unbind("change."+this.options.namespace)},_initEventHandlers:function(){d.prototype._initEventHandlers.call(this);var a={fileupload:this};this.options.filesContainer.delegate(".start button","click."+this.options.namespace,a,this._startHandler).delegate(".cancel button","click."+this.options.namespace,a,this._cancelHandler).delegate(".delete button","click."+this.options.namespace,a,this._deleteHandler),this._initButtonBarEventHandlers()},_destroyEventHandlers:function(){var a=this.options;this._destroyButtonBarEventHandlers(),a.filesContainer.undelegate(".start button","click."+a.namespace).undelegate(".cancel button","click."+a.namespace).undelegate(".delete button","click."+a.namespace),d.prototype._destroyEventHandlers.call(this)},_enableFileInputButton:function(){this.element.find(".fileinput-button input").prop("disabled",!1).parent().removeClass("disabled")},_disableFileInputButton:function(){this.element.find(".fileinput-button input").prop("disabled",!0).parent().addClass("disabled")},_initTemplates:function(){var a=this.options;a.templatesContainer=document.createElement(a.filesContainer.prop("nodeName")),b&&(a.uploadTemplateId&&(a.uploadTemplate=b(a.uploadTemplateId)),a.downloadTemplateId&&(a.downloadTemplate=b(a.downloadTemplateId)))},_initFilesContainer:function(){var b=this.options;void 0===b.filesContainer?b.filesContainer=this.element.find(".files"):b.filesContainer instanceof a||(b.filesContainer=a(b.filesContainer))},_stringToRegExp:function(a){var b=a.split("/"),c=b.pop();return b.shift(),new RegExp(b.join("/"),c)},_initRegExpOptions:function(){var b=this.options;"string"===a.type(b.acceptFileTypes)&&(b.acceptFileTypes=this._stringToRegExp(b.acceptFileTypes)),"string"===a.type(b.previewSourceFileTypes)&&(b.previewSourceFileTypes=this._stringToRegExp(b.previewSourceFileTypes))},_initSpecialOptions:function(){d.prototype._initSpecialOptions.call(this),this._initFilesContainer(),this._initTemplates(),this._initRegExpOptions()},_create:function(){d.prototype._create.call(this),this._refreshOptionsList.push("filesContainer","uploadTemplateId","downloadTemplateId"),a.blueimpFP||(this._processingQueue=a.Deferred().resolveWith(this).promise(),this.process=function(){return this._processingQueue})},enable:function(){d.prototype.enable.call(this),this.element.find("input, button").prop("disabled",!1),this._enableFileInputButton()},disable:function(){this.element.find("input, button").prop("disabled",!0),this._disableFileInputButton(),d.prototype.disable.call(this)}})}),function(a){"use strict";"function"==typeof define&&define.amd?define(["jquery","jquery.ui.widget"],a):a(window.jQuery)}(function(a){"use strict";a.support.xhrFileUpload=!(!window.XMLHttpRequestUpload||!window.FileReader),a.support.xhrFormDataFileUpload=!!window.FormData,a.widget("blueimp.fileupload",{options:{namespace:void 0,dropZone:a(document),fileInput:void 0,replaceFileInput:!0,paramName:void 0,singleFileUploads:!0,limitMultiFileUploads:void 0,sequentialUploads:!1,limitConcurrentUploads:void 0,forceIframeTransport:!1,redirect:void 0,redirectParamName:void 0,postMessage:void 0,multipart:!0,maxChunkSize:void 0,uploadedBytes:void 0,recalculateProgress:!0,progressInterval:100,bitrateInterval:500,formData:function(a){return a.serializeArray()},add:function(a,b){b.submit()},processData:!1,contentType:!1,cache:!1},_refreshOptionsList:["namespace","dropZone","fileInput","multipart","forceIframeTransport"],_BitrateTimer:function(){this.timestamp=+new Date,this.loaded=0,this.bitrate=0,this.getBitrate=function(a,b,c){var d=a-this.timestamp;return(!this.bitrate||!c||d>c)&&(this.bitrate=(b-this.loaded)*(1e3/d)*8,this.loaded=b,this.timestamp=a),this.bitrate}},_isXHRUpload:function(b){return!b.forceIframeTransport&&(!b.multipart&&a.support.xhrFileUpload||a.support.xhrFormDataFileUpload)},_getFormData:function(b){var c;return"function"==typeof b.formData?b.formData(b.form):a.isArray(b.formData)?b.formData:b.formData?(c=[],a.each(b.formData,function(a,b){c.push({name:a,value:b})}),c):[]},_getTotal:function(b){var c=0;return a.each(b,function(a,b){c+=b.size||1}),c},_onProgress:function(a,b){if(a.lengthComputable){var c,d,e=+new Date;if(b._time&&b.progressInterval&&e-b._time<b.progressInterval&&a.loaded!==a.total)return;b._time=e,c=b.total||this._getTotal(b.files),d=parseInt(a.loaded/a.total*(b.chunkSize||c),10)+(b.uploadedBytes||0),this._loaded+=d-(b.loaded||b.uploadedBytes||0),b.lengthComputable=!0,b.loaded=d,b.total=c,b.bitrate=b._bitrateTimer.getBitrate(e,d,b.bitrateInterval),this._trigger("progress",a,b),this._trigger("progressall",a,{lengthComputable:!0,loaded:this._loaded,total:this._total,bitrate:this._bitrateTimer.getBitrate(e,this._loaded,b.bitrateInterval)})}},_initProgressListener:function(b){var c=this,d=b.xhr?b.xhr():a.ajaxSettings.xhr();d.upload&&(a(d.upload).bind("progress",function(a){var d=a.originalEvent;a.lengthComputable=d.lengthComputable,a.loaded=d.loaded,a.total=d.total,c._onProgress(a,b)}),b.xhr=function(){return d})},_initXHRData:function(b){var c,d=b.files[0],e=b.multipart||!a.support.xhrFileUpload,f=b.paramName[0];(!e||b.blob)&&(b.headers=a.extend(b.headers,{"X-File-Name":d.name,"X-File-Type":d.type,"X-File-Size":d.size}),b.blob?e||(b.contentType="application/octet-stream",b.data=b.blob):(b.contentType=d.type,b.data=d)),e&&a.support.xhrFormDataFileUpload&&(b.postMessage?(c=this._getFormData(b),b.blob?c.push({name:f,value:b.blob}):a.each(b.files,function(a,d){c.push({name:b.paramName[a]||f,value:d})})):(b.formData instanceof FormData?c=b.formData:(c=new FormData,a.each(this._getFormData(b),function(a,b){c.append(b.name,b.value)})),b.blob?c.append(f,b.blob,d.name):a.each(b.files,function(a,d){d instanceof Blob&&c.append(b.paramName[a]||f,d,d.name)})),b.data=c),b.blob=null},_initIframeSettings:function(b){b.dataType="iframe "+(b.dataType||""),b.formData=this._getFormData(b),b.redirect&&a("<a></a>").prop("href",b.url).prop("host")!==location.host&&b.formData.push({name:b.redirectParamName||"redirect",value:b.redirect})},_initDataSettings:function(a){this._isXHRUpload(a)?(this._chunkedUpload(a,!0)||(a.data||this._initXHRData(a),this._initProgressListener(a)),a.postMessage&&(a.dataType="postmessage "+(a.dataType||""))):this._initIframeSettings(a,"iframe")},_getParamName:function(b){var c=a(b.fileInput),d=b.paramName;return d?a.isArray(d)||(d=[d]):(d=[],c.each(function(){for(var b=a(this),c=b.prop("name")||"files[]",e=(b.prop("files")||[1]).length;e;)d.push(c),e-=1}),d.length||(d=[c.prop("name")||"files[]"])),d},_initFormSettings:function(b){b.form&&b.form.length||(b.form=a(b.fileInput.prop("form"))),b.paramName=this._getParamName(b),b.url||(b.url=b.form.prop("action")||location.href),b.type=(b.type||b.form.prop("method")||"").toUpperCase(),"POST"!==b.type&&"PUT"!==b.type&&(b.type="POST")},_getAJAXSettings:function(b){var c=a.extend({},this.options,b);return this._initFormSettings(c),this._initDataSettings(c),c},_enhancePromise:function(a){return a.success=a.done,a.error=a.fail,a.complete=a.always,a},_getXHRPromise:function(b,c,d){var e=a.Deferred(),f=e.promise();return c=c||this.options.context||f,b===!0?e.resolveWith(c,d):b===!1&&e.rejectWith(c,d),f.abort=e.promise,this._enhancePromise(f)},_chunkedUpload:function(b,c){var d,e,f,g,h=this,i=b.files[0],j=i.size,k=b.uploadedBytes=b.uploadedBytes||0,l=b.maxChunkSize||j,m=i.webkitSlice||i.mozSlice||i.slice;return this._isXHRUpload(b)&&m&&(k||j>l)&&!b.data?c?!0:k>=j?(i.error="uploadedBytes",this._getXHRPromise(!1,b.context,[null,"error",i.error])):(e=Math.ceil((j-k)/l),d=function(c){return c?d(c-=1).pipe(function(){var d=a.extend({},b);return d.blob=m.call(i,k+c*l,k+(c+1)*l),d.chunkIndex=c,d.chunksNumber=e,d.chunkSize=d.blob.size,h._initXHRData(d),h._initProgressListener(d),f=(a.ajax(d)||h._getXHRPromise(!1,d.context)).done(function(){d.loaded||h._onProgress(a.Event("progress",{lengthComputable:!0,loaded:d.chunkSize,total:d.chunkSize}),d),b.uploadedBytes=d.uploadedBytes+=d.chunkSize})}):h._getXHRPromise(!0,b.context)},g=d(e),g.abort=function(){return f.abort()},this._enhancePromise(g)):!1},_beforeSend:function(a,b){0===this._active&&(this._trigger("start"),this._bitrateTimer=new this._BitrateTimer),this._active+=1,this._loaded+=b.uploadedBytes||0,this._total+=this._getTotal(b.files)},_onDone:function(b,c,d,e){this._isXHRUpload(e)||this._onProgress(a.Event("progress",{lengthComputable:!0,loaded:1,total:1}),e),e.result=b,e.textStatus=c,e.jqXHR=d,this._trigger("done",null,e)},_onFail:function(a,b,c,d){d.jqXHR=a,d.textStatus=b,d.errorThrown=c,this._trigger("fail",null,d),d.recalculateProgress&&(this._loaded-=d.loaded||d.uploadedBytes||0,this._total-=d.total||this._getTotal(d.files))},_onAlways:function(a,b,c,d){this._active-=1,d.textStatus=b,c&&c.always?(d.jqXHR=c,d.result=a):(d.jqXHR=a,d.errorThrown=c),this._trigger("always",null,d),0===this._active&&(this._trigger("stop"),this._loaded=this._total=0,this._bitrateTimer=null)},_onSend:function(b,c){var d,e,f,g=this,h=g._getAJAXSettings(c),i=function(c,e){return g._sending+=1,h._bitrateTimer=new g._BitrateTimer,d=d||(c!==!1&&g._trigger("send",b,h)!==!1&&(g._chunkedUpload(h)||a.ajax(h))||g._getXHRPromise(!1,h.context,e)).done(function(a,b,c){g._onDone(a,b,c,h)}).fail(function(a,b,c){g._onFail(a,b,c,h)}).always(function(a,b,c){if(g._sending-=1,g._onAlways(a,b,c,h),h.limitConcurrentUploads&&h.limitConcurrentUploads>g._sending)for(var d=g._slots.shift();d;){if(!d.isRejected()){d.resolve();break}d=g._slots.shift()}})};return this._beforeSend(b,h),this.options.sequentialUploads||this.options.limitConcurrentUploads&&this.options.limitConcurrentUploads<=this._sending?(this.options.limitConcurrentUploads>1?(e=a.Deferred(),this._slots.push(e),f=e.pipe(i)):f=this._sequence=this._sequence.pipe(i,i),f.abort=function(){var a=[void 0,"abort","abort"];return d?d.abort():(e&&e.rejectWith(a),i(!1,a))},this._enhancePromise(f)):i()},_onAdd:function(b,c){var d,e,f,g,h=this,i=!0,j=a.extend({},this.options,c),k=j.limitMultiFileUploads,l=this._getParamName(j);if((j.singleFileUploads||k)&&this._isXHRUpload(j))if(!j.singleFileUploads&&k)for(f=[],d=[],g=0;g<c.files.length;g+=k)f.push(c.files.slice(g,g+k)),e=l.slice(g,g+k),e.length||(e=l),d.push(e);else d=l;else f=[c.files],d=[l];return c.originalFiles=c.files,a.each(f||c.files,function(e,g){var j=a.extend({},c);return j.files=f?g:[g],j.paramName=d[e],j.submit=function(){return j.jqXHR=this.jqXHR=h._trigger("submit",b,this)!==!1&&h._onSend(b,this),this.jqXHR},i=h._trigger("add",b,j)}),i},_normalizeFile:function(a,b){void 0===b.name&&void 0===b.size&&(b.name=b.fileName,b.size=b.fileSize)},_replaceFileInput:function(b){var c=b.clone(!0);a("<form></form>").append(c)[0].reset(),b.after(c).detach(),a.cleanData(b.unbind("remove")),this.options.fileInput=this.options.fileInput.map(function(a,d){return d===b[0]?c[0]:d}),b[0]===this.element[0]&&(this.element=c)},_getFileInputFiles:function(b){b=a(b);var c,d=a.each(a.makeArray(b.prop("files")),this._normalizeFile);if(!d.length){if(c=b.prop("value"),!c)return[];d=[{name:c.replace(/^.*\\/,"")}]}return d},_onChange:function(b){var c=b.data.fileupload,d={fileInput:a(b.target),form:a(b.target.form)};return d.files=c._getFileInputFiles(d.fileInput),c.options.replaceFileInput&&c._replaceFileInput(d.fileInput),c._trigger("change",b,d)===!1||c._onAdd(b,d)===!1?!1:void 0},_onPaste:function(b){var c=b.data.fileupload,d=b.originalEvent.clipboardData,e=d&&d.items||[],f={files:[]};return a.each(e,function(a,b){var c=b.getAsFile&&b.getAsFile();c&&f.files.push(c)}),c._trigger("paste",b,f)===!1||c._onAdd(b,f)===!1?!1:void 0},_onDrop:function(b){var c=b.data.fileupload,d=b.dataTransfer=b.originalEvent.dataTransfer,e={files:a.each(a.makeArray(d&&d.files),c._normalizeFile)};return c._trigger("drop",b,e)===!1||c._onAdd(b,e)===!1?!1:void b.preventDefault()},_onDragOver:function(a){var b=a.data.fileupload,c=a.dataTransfer=a.originalEvent.dataTransfer;return b._trigger("dragover",a)===!1?!1:(c&&(c.dropEffect="copy"),void a.preventDefault())},_initEventHandlers:function(){var a=this.options.namespace;this._isXHRUpload(this.options)&&this.options.dropZone.bind("dragover."+a,{fileupload:this},this._onDragOver).bind("drop."+a,{fileupload:this},this._onDrop).bind("paste."+a,{fileupload:this},this._onPaste),this.options.fileInput.bind("change."+a,{fileupload:this},this._onChange)},_destroyEventHandlers:function(){var a=this.options.namespace;this.options.dropZone.unbind("dragover."+a,this._onDragOver).unbind("drop."+a,this._onDrop).unbind("paste."+a,this._onPaste),this.options.fileInput.unbind("change."+a,this._onChange)},_setOption:function(b,c){var d=-1!==a.inArray(b,this._refreshOptionsList);d&&this._destroyEventHandlers(),a.Widget.prototype._setOption.call(this,b,c),d&&(this._initSpecialOptions(),this._initEventHandlers())},_initSpecialOptions:function(){var b=this.options;void 0===b.fileInput?b.fileInput=this.element.is("input:file")?this.element:this.element.find("input:file"):b.fileInput instanceof a||(b.fileInput=a(b.fileInput)),b.dropZone instanceof a||(b.dropZone=a(b.dropZone))},_create:function(){var b=this.options;a.extend(b,a(this.element[0].cloneNode(!1)).data()),b.namespace=b.namespace||this.widgetName,this._initSpecialOptions(),this._slots=[],this._sequence=this._getXHRPromise(!0),this._sending=this._active=this._loaded=this._total=0,this._initEventHandlers()},destroy:function(){this._destroyEventHandlers(),a.Widget.prototype.destroy.call(this)},enable:function(){a.Widget.prototype.enable.call(this),this._initEventHandlers()},disable:function(){this._destroyEventHandlers(),a.Widget.prototype.disable.call(this)},add:function(b){b&&!this.options.disabled&&(b.files=b.fileInput&&!b.files?this._getFileInputFiles(b.fileInput):a.each(a.makeArray(b.files),this._normalizeFile),this._onAdd(null,b))},send:function(b){return b&&!this.options.disabled&&(b.files=b.fileInput&&!b.files?this._getFileInputFiles(b.fileInput):a.each(a.makeArray(b.files),this._normalizeFile),b.files.length)?this._onSend(null,b):this._getXHRPromise(!1,b&&b.context)}})}),function(a){"use strict";"function"==typeof define&&define.amd?define(["jquery"],a):a(window.jQuery)}(function(a){"use strict";var b=0;a.ajaxTransport("iframe",function(c){if(c.async&&("POST"===c.type||"GET"===c.type)){var d,e;return{send:function(f,g){d=a('<form style="display:none;"></form>'),e=a('<iframe src="javascript:false;" name="iframe-transport-'+(b+=1)+'"></iframe>').bind("load",function(){var b,f=a.isArray(c.paramName)?c.paramName:[c.paramName];e.unbind("load").bind("load",function(){var b;try{if(b=e.contents(),!b.length||!b[0].firstChild)throw new Error}catch(c){b=void 0}g(200,"success",{iframe:b}),a('<iframe src="javascript:false;"></iframe>').appendTo(d),d.remove()}),d.prop("target",e.prop("name")).prop("action",c.url).prop("method",c.type),c.formData&&a.each(c.formData,function(b,c){a('<input type="hidden"/>').prop("name",c.name).val(c.value).appendTo(d)}),c.fileInput&&c.fileInput.length&&"POST"===c.type&&(b=c.fileInput.clone(),c.fileInput.after(function(a){return b[a]}),c.paramName&&c.fileInput.each(function(b){a(this).prop("name",f[b]||c.paramName)}),d.append(c.fileInput).prop("enctype","multipart/form-data").prop("encoding","multipart/form-data")),d.submit(),b&&b.length&&c.fileInput.each(function(c,d){var e=a(b[c]);a(d).prop("name",e.prop("name")),e.replaceWith(d)})}),d.append(e).appendTo(document.body)},abort:function(){e&&e.unbind("load").prop("src","javascript".concat(":false;")),d&&d.remove()}}}}),a.ajaxSetup({converters:{"iframe text":function(b){return a(b[0].body).text()},"iframe json":function(b){return a.parseJSON(a(b[0].body).text())},"iframe html":function(b){return a(b[0].body).html()},"iframe script":function(b){return a.globalEval(a(b[0].body).text())}}})});
//# sourceMappingURL=jquery.map