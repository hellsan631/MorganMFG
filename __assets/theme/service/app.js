(function(sk, app, $){

	app.Images = {

		replace: function($element, selector)
		{
			$element.find(selector)
				.each(function()
				{
					var $this = $(this);

					var data = $this.data();
					var url = data['image'+ app.MQ.params.width];

					if(url)
					{
						if( $this[0].tagName.toLowerCase() === 'img')
						{
							$this.attr('src', url);
						}
						else
						{
							$this.css('background-image', 'url('+url+')' );
						}
					}
				});
		},
		resize: function(selector)
		{
			$(selector)
				.each(function(index, el)
				{
					var $this = $(this);
					var data = $this.data();
					var url = data['image'+ app.MQ.params.width];

					if(url)
					{
						$('<img />')
							.on('load', function(event)
							{
								if( $this[0].tagName.toLowerCase() === 'img')
								{
									$this.attr('src', url);
								}
								else
								{
									$this.css('background-image', 'url('+url+')' );
								}
							})
							.attr('src', url)
					}
				});
		}
	};



})(sk, App, jQuery);