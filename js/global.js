$(document).ready(function() {

	$('form').on('submit', function(){
		$('input[type="submit"]', this).val('Working...');
	});

	(function(){
			$('.items').css('display', 'none');
			$('.feed').on('loadstart',function(){
				$('.items-load').html('<img src="img/loader.GIF"> Loading');
			});
			$('.feed').on('loaded',function(){
				$('.items-load').html('Load More');
				$('.items').css('display', 'block');
			});

			if (document.getElementById('dropzone')) {
				var dropzone = document.getElementById('dropzone');
				var upload = function(files) {
					var reader = new FileReader();
				    reader.onload = function(e){
				    	$(dropzone).html('<img src="'+e.target.result +'"/>'); 
				    };
				    reader.readAsDataURL(files[0]);
				};

				dropzone.ondrop = function(e) {
					e.preventDefault();
					this.className = 'drop';
					upload(e.dataTransfer.files);
				};

				dropzone.ondragover = function() {
					this.className = 'drop dragover';
					return false;
				}

				dropzone.ondragleave = function() {
					this.className = 'drop';
					return false;
				};


				$(dropzone).on('click', function(){
					$('.avatar-upload').trigger('click');
				});

				$('.avatar-upload').on('change', function(){
					var input = this;
			        var reader = new FileReader();

			        reader.onload = function (e) {
			        	$(dropzone).html('<img src="' + e.target.result + '"/>');
			        }

			        reader.readAsDataURL(input.files[0]);
				});
			};

		})();
	$('.all-blogs').loadmore({
		source: 'getposts.php',
		step: 3
	});
	$('.blog-feed').loadmore({
		source: 'getposts.php',
		step: 3,
		links: {
			readmore: 'showpost.php?id={id}',
			blog: 'showblog.php?id={id}'
		},
		id: $('.blog-feed').data('id')
	});
});

(function($){
	$.fn.loadmore = function(options) {
		var self = this,
			settings = $.extend({
				source: '',
				step: 2,
			}, options),

			stepped = 1,
			item = self.find('.item'),
			items = self.find('.items'),

			finished = function() {
				self.find('.items-load').remove();
			},

			append = function(value) {
				var name, part;
				console.log(value);
				item.remove();

				// console.log(value);
				for(name in value) {
					if (value.hasOwnProperty(name)) {
						part = item.find('*[data-field="' + name + '"]');
						
						if (part.length) {
							part.text(value[name]);
						};

						link = item.find('*[data-link="' + name + '"]');
						if (link.length) {
							console.log(value);
							link.attr('href', link.data('base') + value[name]);
						};
					};
				}

				item.clone().appendTo(items);
			},

			load = function(start, count) {
				$(self).trigger('loadstart');
				$.ajax({
					url: settings.source,
					type: 'get',
					dataType: 'json',
					data: {start: start, count: count, id: settings.id},
					success: function(data){
						// console.log(data);
						var items = data.items;

						if (items.length) {
							$(items).each(function(index, value) {
								append(value);
							});
							stepped += count;
	
							$(self).trigger('loaded');
						};

						if (data.last === true) {
							finished();
						};
					}
				});
			};

		if (settings.source.length) {

			self.find('.items-load').on('click', function(){
				load(stepped, settings.step);
				return false;
			});
			load(1, settings.step);
		}else {
			console.log('Source is required for load more.');
		}

	};
})(jQuery);	