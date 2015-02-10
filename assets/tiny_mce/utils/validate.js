var Validator={isEmail:function(a){return this.test(a,"^[-!#$%&'*+\\./0-9=?A-Z^_`a-z{|}~]+@[-!#$%&'*+\\/0-9=?A-Z^_`a-z{|}~]+.[-!#$%&'*+\\./0-9=?A-Z^_`a-z{|}~]+$")},isAbsUrl:function(a){return this.test(a,"^(news|telnet|nttp|file|http|ftp|https)://[-A-Za-z0-9\\.]+\\/?.*$")},isSize:function(a){return this.test(a,"^[0-9.]+(%|in|cm|mm|em|ex|pt|pc|px)?$")},isId:function(a){return this.test(a,"^[A-Za-z_]([A-Za-z0-9_])*$")},isEmpty:function(a){var b,c;if("SELECT"==a.nodeName&&a.selectedIndex<1)return!0;if("checkbox"==a.type&&!a.checked)return!0;if("radio"==a.type){for(c=0,b=a.form.elements;c<b.length;c++)if("radio"==b[c].type&&b[c].name==a.name&&b[c].checked)return!1;return!0}return new RegExp("^\\s*$").test(1==a.nodeType?a.value:a)},isNumber:function(a,b){return!(isNaN(1==a.nodeType?a.value:a)||b&&this.test(a,"^-?[0-9]*\\.[0-9]*$"))},test:function(a,b){return a=1==a.nodeType?a.value:a,""==a||new RegExp(b).test(a)}},AutoValidator={settings:{id_cls:"id",int_cls:"int",url_cls:"url",number_cls:"number",email_cls:"email",size_cls:"size",required_cls:"required",invalid_cls:"invalid",min_cls:"min",max_cls:"max"},init:function(a){var b;for(b in a)this.settings[b]=a[b]},validate:function(a){var b,c,d=this.settings,e=0;for(c=this.tags(a,"label"),b=0;b<c.length;b++)this.removeClass(c[b],d.invalid_cls),c[b].setAttribute("aria-invalid",!1);return e+=this.validateElms(a,"input"),e+=this.validateElms(a,"select"),e+=this.validateElms(a,"textarea"),3==e},invalidate:function(a){this.mark(a.form,a)},getErrorMessages:function(a){var b,c,d,e,f=this.settings,g=[],h=tinyMCEPopup.editor;for(b=this.tags(a,"label"),c=0;c<b.length;c++)this.hasClass(b[c],f.invalid_cls)&&(d=document.getElementById(b[c].getAttribute("for")),e={field:b[c].textContent},this.hasClass(d,f.min_cls,!0)?(message=h.getLang("invalid_data_min"),e.min=this.getNum(d,f.min_cls)):message=h.getLang(this.hasClass(d,f.number_cls)?"invalid_data_number":this.hasClass(d,f.size_cls)?"invalid_data_size":"invalid_data"),message=message.replace(/{\#([^}]+)\}/g,function(a,b){return e[b]||"{#"+b+"}"}),g.push(message));return g},reset:function(a){var b,c,d,e=["label","input","select","textarea"],f=this.settings;if(null!=a)for(b=0;b<e.length;b++)for(d=this.tags(a.form?a.form:a,e[b]),c=0;c<d.length;c++)this.removeClass(d[c],f.invalid_cls),d[c].setAttribute("aria-invalid",!1)},validateElms:function(a,b){var c,d,e,f,g=this.settings,h=!0,i=Validator;for(c=this.tags(a,b),d=0;d<c.length;d++)e=c[d],this.removeClass(e,g.invalid_cls),this.hasClass(e,g.required_cls)&&i.isEmpty(e)&&(h=this.mark(a,e)),this.hasClass(e,g.number_cls)&&!i.isNumber(e)&&(h=this.mark(a,e)),this.hasClass(e,g.int_cls)&&!i.isNumber(e,!0)&&(h=this.mark(a,e)),this.hasClass(e,g.url_cls)&&!i.isAbsUrl(e)&&(h=this.mark(a,e)),this.hasClass(e,g.email_cls)&&!i.isEmail(e)&&(h=this.mark(a,e)),this.hasClass(e,g.size_cls)&&!i.isSize(e)&&(h=this.mark(a,e)),this.hasClass(e,g.id_cls)&&!i.isId(e)&&(h=this.mark(a,e)),this.hasClass(e,g.min_cls,!0)&&(f=this.getNum(e,g.min_cls),(isNaN(f)||parseInt(e.value)<parseInt(f))&&(h=this.mark(a,e))),this.hasClass(e,g.max_cls,!0)&&(f=this.getNum(e,g.max_cls),(isNaN(f)||parseInt(e.value)>parseInt(f))&&(h=this.mark(a,e)));return h},hasClass:function(a,b,c){return new RegExp("\\b"+b+(c?"[0-9]+":"")+"\\b","g").test(a.className)},getNum:function(a,b){return b=a.className.match(new RegExp("\\b"+b+"([0-9]+)\\b","g"))[0],b=b.replace(/[^0-9]/g,"")},addClass:function(a,b,c){var d=this.removeClass(a,b);a.className=c?b+(""!=d?" "+d:""):(""!=d?d+" ":"")+b},removeClass:function(a,b){return b=a.className.replace(new RegExp("(^|\\s+)"+b+"(\\s+|$)")," "),a.className=" "!=b?b:""},tags:function(a,b){return a.getElementsByTagName(b)},mark:function(a,b){var c=this.settings;return this.addClass(b,c.invalid_cls),b.setAttribute("aria-invalid","true"),this.markLabels(a,b,c.invalid_cls),!1},markLabels:function(a,b,c){var d,e;for(d=this.tags(a,"label"),e=0;e<d.length;e++)(d[e].getAttribute("for")==b.id||d[e].htmlFor==b.id)&&this.addClass(d[e],c);return null}};