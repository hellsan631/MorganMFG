(function(){

	// Check for jquery
	if(jQuery == undefined){
		console.log("Jquery not included!");
		return;
	}

	if(Modernizr.video == undefined){
		console.log("Modernizr not included!");
		return;
	}

	var $ = jQuery;

	//IS IE
	var isIE = jQuery.browser.msie;

	var players = 0;
	var youtube_api_state = 0;

	//Jquery extend ensure load for images (caching issue)
	jQuery.fn.extend({
	    ensureLoad: function(handler) {
	        return this.each(function() {
	            if(this.complete || this.readyState === 4) {
	                handler.call(this);
	            } 
	            // Check if data URI images is supported, fire 'error' event if not
	            else if ( this.readyState === 'uninitialized' && this.src.indexOf('data:') === 0 ) {
	                $(this).trigger('error');
	                handler.call(this);
	            }
	            else {
	                $(this).one("load", handler);

	                if(isIE && this.src != undefined && this.src.indexOf("?") == -1)
	                    this.src = this.src+ "?" + new Date().getTime();

	            }
	        });
	    }
	});


	// Video Background call
	video_background = function($holder, in_parameters){
		this.hidden = false;
		this.$holder = $holder;

		this.id = "video_background_video_"+players;
		players++;


		// Parameters
		this.parameters = {
			"position": "absolute",
			"z-index": "-1",
			"video_ratio": false,
			"loop": true,
			"autoplay": true,
			"muted": false,
			"mp4": false,
			"webm": false,
			"ogg": false,
			"flv": false,
			"youtube": false,
			"priority": "html5", // flash || html5 
			"fallback_image": false,
			"sizing": "fill", // fill || adjust
			"start": 0 
		};

		//Over ride parameters from user options
		$.each(in_parameters, $.proxy(function(index, obj){
			this.parameters[index] = obj;
		}, this));



		//video holder
		this.$video_holder = $('<div id="'+this.id+'"></div>').appendTo($holder).css({
			"z-index": this.parameters["z-index"],
			"position": this.parameters.position,
			"top":0, "left": 0, "right": 0, "bottom": 0,
			"overflow": "hidden"
		});


		this.ismobile=navigator.userAgent.match(/(iPad)|(iPhone)|(iPod)|(android)|(webOS)/i);

		var flash_version = swfobject.getFlashPlayerVersion();
		this.supports_flash = flash_version["major"] > 9 && (this.parameters.mp4 !== false || this.parameters.flv !== false);
		this.supports_video = Modernizr.video && (	(Modernizr.video.h264 && this.parameters.mp4 !== false) || 
													(Modernizr.video.ogg && this.parameters.ogg !== false) || 
													(Modernizr.video.webm && this.parameters.webm !== false) );

		this.decision = "image";

		//Decide what to use
		if(!this.ismobile && (this.supports_flash || this.supports_video || this.parameters.youtube !== false)){
			this.decision = this.parameters.priority;
			if(this.parameters.youtube !== false){
				this.decision = "youtube";
			}
			else if(this.parameters.priority == "flash" && this.supports_flash){
				this.decision = "flash";
			}
			else if(this.parameters.priority == "html5" && this.supports_video){
				this.decision = "html5";
			}
			else if(this.supports_flash){
				this.decision = "flash";
			}
			else if(this.supports_video){
				this.decision = "html5";
			}
		}


		//Image Fallback
		if(this.decision == "image"){
			this.make_image();
		}

		//Youtube
		else if(this.decision == "youtube"){
			this.make_youtube();
		}

		//Video
		else{
			//Html5 video
			if(this.decision == "html5"){
				this.make_video();
			}
			//Flash
			else{
				this.make_flash();
			}
		}

		return this;
	}

	video_background.prototype = {

		// Make html5 video
		make_video: function(){
			var parameters = (this.parameters.autoplay ? "autoplay " : "") + (this.parameters.loop ? "loop " : "");

			var str = '<video width="100%" height="100%" '+parameters+'>';

			//mp4
			if(this.parameters.mp4 !== false){
				str += '<source src="'+this.parameters.mp4+'" type="video/mp4"></source>';
			}

			//webm
			if(this.parameters.webm !== false){
				str += '<source src="'+this.parameters.webm+'" type="video/webm"></source>';
			}

			//mp4
			if(this.parameters.ogg !== false){
				str += '<source src="'+this.parameters.ogg+'" type="video/ogg"></source>';
			}
			str += "</video>";

			//html5 video tag
			this.$video = $(str).css({
				"position": "absolute"
			});

			this.$video_holder.append(this.$video);

			this.video = this.$video.get(0);

			//Fill resize
			if(this.parameters.video_ratio !== false){
				this.resize_timeout = false;

				//On window resize
				$(window).resize( $.proxy(function(){
					clearTimeout(this.resize_timeout);
					this.resize_timeout = setTimeout($.proxy(this.video_resize, this) , 10);
				}, this) ) ;

				this.video_resize();
			}

			if(this.parameters.muted)
				this.mute();
		},

		video_resize: function(){
			var w = this.$video_holder.width();
			var h = this.$video_holder.height();

			var new_width = w;
			var new_height = w / this.parameters.video_ratio;

			if( new_height < h ){
				new_height = h;
				new_width = h * this.parameters.video_ratio;
			}

			//Round
			new_height = Math.ceil(new_height);
			new_width = Math.ceil(new_width);

			//adjust
			var top = Math.round( h/2 - new_height/2 );
			var left = Math.round( w/2 - new_width/2 );

			this.$video.attr("width", new_width);
			this.$video.attr("height", new_height);

			this.$video.css({
				"top": top+"px",
				"left": left+"px"
			});
		},




		//Make youtube
		make_youtube: function(){
			var $html = $("html");
			this.$video = $('<div id="'+this.id+'_yt"></div>').appendTo(this.$video_holder).css({
				"position": "absolute"
			});

      		this.youtube_ready = false;

      		if(youtube_api_state == 0){
      			//Load it
      			var tag = document.createElement('script');

				tag.src = "https://www.youtube.com/iframe_api";
				var firstScriptTag = document.getElementsByTagName('script')[0];
				firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      			youtube_api_state = 1;

      			window.onYouTubeIframeAPIReady = $.proxy(function() {
      				$html.trigger("yt_loaded");
					this.build_youtube();

					youtube_api_state = 2;
				}, this);
      		}
      		else if(youtube_api_state == 1){
      			$html.bind("yt_loaded", $.proxy(this.build_youtube, this));
      		}
      		else if(youtube_api_state == 2){
      			this.build_youtube();
      		}

		},

		build_youtube: function(){
			var pars = { 'loop': this.parameters.loop ? 1 : 0, 'start': this.parameters.start, 'autoplay': this.parameters.autoplay ? 1 : 0, 'controls': 0, 'showinfo': 0, 'wmode': 'transparent', 'iv_load_policy': 3, 'modestbranding':1, 'rel':0};

			if(this.parameters.loop){
				pars['playlist'] = this.parameters.youtube; 
			}

			this.player = new YT.Player(this.id+"_yt", {
				height: '100%',
				width: '100%',
				playerVars: pars,
				videoId: this.parameters.youtube,
				events: {
					'onReady': $.proxy(this.youtube_ready_fun, this)
				}
			});
		},

      	youtube_ready_fun: function(event) {
      		this.youtube_ready = true;

      		this.$video = $("#"+this.id+"_yt");

			//Fill resize
			if(this.parameters.video_ratio !== false){
				this.resize_timeout = false;

				//On window resize
				$(window).resize( $.proxy(function(){
					clearTimeout(this.resize_timeout);
					this.resize_timeout = setTimeout($.proxy(this.video_resize, this) , 10);
				}, this) ) ;

				this.video_resize();
			}


			if(this.parameters.muted)
				this.mute();

			//this.player.setPlaybackQuality("highres");
      	},





		// Make flash video
		make_flash: function(){
			var flashvars = { 
				"url"		: (this.parameters.mp4 != false ? this.parameters.mp4 : this.parameters.flv),
				"loop"		: this.parameters.loop,
				"autoplay"	: this.parameters.autoplay,
				"muted"		: this.parameters.muted
			};

			this.$video_holder.append('<div id="'+this.id+'_flash"></div>');

			swfobject.embedSWF("flash/video.swf", this.id+"_flash", "100%", "100%", "9.0", null, flashvars, {allowfullscreen:true, allowScriptAccess:"always", wmode:"transparent"}, { name:"background-video-swf" }, $.proxy(this.flash_callback, this));
		},

		flash_callback: function(e) {
			this.video = $(e.target).get(0);//document.getElementById(e.id);

			if(this.parameters.muted)
				this.mute();
		},



		// Make image
		make_image: function(){
			if(this.parameters.fallback_image === false){
				return;
			}

			//Make image
			this.$img = $('<img src="'+this.parameters.fallback_image+'" alt=""/>').appendTo(this.$video_holder).css({
				"position":"absolute"
			});

			// On Image load
			this.$img.ensureLoad( $.proxy(this.image_loaded, this) );
		},

		image_loaded: function(){
			this.original_width = this.$img.width();
			this.original_height = this.$img.height();

			this.resize_timeout = false;

			//On window resize
			$(window).resize( $.proxy(function(){
				clearTimeout(this.resize_timeout);
				this.resize_timeout = setTimeout($.proxy(this.image_resize, this) , 10);
			}, this) ) ;

			this.image_resize();
		},

		image_resize: function(){
			var w = this.$video_holder.width();
			var h = this.$video_holder.height();

			var new_width = w;
			var new_height = this.original_height / ( this.original_width / w );

			if( (this.parameters.sizing == "adjust" && new_height > h) || (this.parameters.sizing == "fill" && new_height < h) ){
				new_height = h;
				new_width = this.original_width / ( this.original_height / h );
			}

			//Round
			new_height = Math.ceil(new_height);
			new_width = Math.ceil(new_width);

			//adjust
			var top = Math.round( h/2 - new_height/2 );
			var left = Math.round( w/2 - new_width/2 );

			this.$img.css({
				"width": new_width+"px",
				"height": new_height+"px",
				"top": top+"px",
				"left": left+"px"
			});
		},




		// User Callable Functions

		isPlaying: function(){
			if(this.decision == "html5")
				return !this.video.paused;
			else if(this.decision == "flash")
				return video.isPlaying();
			else if(this.decision =="youtube" && this.youtube_ready)
				return this.player.getPlayerState() === 1;

			return false;
		},

		// Play
		play: function(){
			if(this.decision == "html5")
				this.video.play();
			else if(this.decision == "flash")
				this.video.resume();
			else if(this.decision =="youtube" && this.youtube_ready)
				this.player.playVideo();
		},

		// Pause
		pause: function(){
			if(this.decision == "html5" || this.decision == "flash")
				this.video.pause();
			else if(this.decision =="youtube" && this.youtube_ready)
				this.player.pauseVideo();
		},

		// Toogle play
		toggle_play: function(){
			if(this.isPlaying())
				this.pause();
			else
				this.play();
		},

		// Is mute
		isMuted: function(){
			if(this.decision == "html5")
				return !(this.video.volume);
			else if(this.decision == "flash")
				return video.isMute();
			else if(this.decision =="youtube" && this.youtube_ready)
				return this.player.isMuted();

			return false;
		},

		// Mute
		mute: function(){
			if(this.decision == "html5")
				this.video.volume = 0;
			else if(this.decision == "flash")
				this.video.mute();
			else if(this.decision =="youtube" && this.youtube_ready)
				this.player.mute();
		},

		//Unmute
		unmute: function(){
			if(this.decision == "html5")
				this.video.volume = 1;
			else if(this.decision == "flash")
				this.video.unmute();
			else if(this.decision =="youtube" && this.youtube_ready)
				this.player.unMute();
		},

		//Toogle mute
		toggle_mute: function(){
			if(this.isMuted())
				this.unmute();
			else
				this.mute();
		},

		//Hide
		hide: function(){
			//Pause
			this.pause();

			this.$video_holder.stop().fadeTo(700, 0);
			this.hidden = true;
		},

		//Show
		show: function(){
			this.play();

			this.$video_holder.stop().fadeTo(700, 1);
			this.hidden = false;
		},

		//Toogle Hidden
		toogle_hidden: function(){
			if(this.hidden)
				this.show();
			else
				this.hide();
		},

		//Rewind
		rewind: function(){
			if(this.decision == "html5")
				this.video.currentTime = 0;
			else if(this.decision == "flash")
				this.video.rewind();
			else if(this.decision =="youtube" && this.youtube_ready)
				this.player.seekTo(0);
		}
	};


})(undefined);