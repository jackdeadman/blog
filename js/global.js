$(document).ready(function() {

	$('form').on('submit', function(){
		$('input[type="submit"]', this).val('Working...');
	});

	(function(){
			var dropzone = document.getElementById('dropzone');

			var upload = function(files) {
				var reader = new FileReader();
			    reader.onload = function(e){
			    	$(dropzone).html('<img src="'+e.target.result +'"/>'); 
			    };
			    reader.readAsDataURL(files[0]);



				var formData = new FormData(),
					xhr = new XMLHttpRequest(),
					x;

				formData.append('file', files[0]);

				xhr.onload = function() {
					var data = this.responseText;
				};
				dropzone.innerHTML = 'Uploading...';
				xhr.open('post', 'upload.php');
				xhr.send(formData);
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

		})();

});