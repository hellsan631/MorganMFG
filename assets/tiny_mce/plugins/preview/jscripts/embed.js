function writeFlash(a){writeEmbed("D27CDB6E-AE6D-11cf-96B8-444553540000","http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0","application/x-shockwave-flash",a)}function writeShockWave(a){writeEmbed("166B1BCA-3F9C-11CF-8075-444553540000","http://download.macromedia.com/pub/shockwave/cabs/director/sw.cab#version=8,5,1,0","application/x-director",a)}function writeQuickTime(a){writeEmbed("02BF25D5-8C17-4B23-BC80-D3488ABDDC6B","http://www.apple.com/qtactivex/qtplugin.cab#version=6,0,2,0","video/quicktime",a)}function writeRealMedia(a){writeEmbed("CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA","http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0","audio/x-pn-realaudio-plugin",a)}function writeWindowsMedia(a){a.url=a.src,writeEmbed("6BF52A52-394A-11D3-B153-00C04F79FAA6","http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701","application/x-mplayer2",a)}function writeEmbed(a,b,c,d){var e,f="";f+='<object classid="clsid:'+a+'" codebase="'+b+'"',f+="undefined"!=typeof d.id?'id="'+d.id+'"':"",f+="undefined"!=typeof d.name?'name="'+d.name+'"':"",f+="undefined"!=typeof d.width?'width="'+d.width+'"':"",f+="undefined"!=typeof d.height?'height="'+d.height+'"':"",f+="undefined"!=typeof d.align?'align="'+d.align+'"':"",f+=">";for(e in d)f+='<param name="'+e+'" value="'+d[e]+'">';f+='<embed type="'+c+'"';for(e in d)f+=e+'="'+d[e]+'" ';f+="></embed></object>",document.write(f)}
//# sourceMappingURL=embed.map