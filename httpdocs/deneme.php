<html>
<head>
<link rel="Stylesheet" type="text/css" href="css/croppie.css" />
<link rel="Stylesheet" type="text/css" href="css/prism.css" />
</head>
<body>
<div class="col-1-2">
    <div class="demo-cropper croppie-container" id="cropper-1">
		<div class="boundary" style="width: 300px; height: 300px;">
			<img class="image" id="item" src="images/background-img-6.jpg" style="height:600px; width:1000px; transform: translate3d(-91.9748px, -188.049px, 0px) scale(0.41); transform-origin: 241.975px 338.048px 0px;">
			<div class="viewport cr-vp-circle" style="width: 150px; height: 150px;"></div>
			<div class="overlay" style="width: 524.8px; height: 295.2px; top: 11.4002px; left: 50.7903px;"></div>
		</div>
		<div class="slider-wrap">
			<input type="range" class="slider" step="0.01" min="0.21" max="1.50">
		</div>
	</div>
</div>
</body>

<script>
			var c = new Croppie(document.getElementById('#item'), {
				viewport: {
					width: 100,
					height: 100,
					type: 'square|circle' //default 'square'
				},
				boundary: {
					width: 100,
					height: 100
				},
				customClass: '',
				enableZoom: true|false, //default true // previously showZoom
				showZoomer: true|false, //default true
				mouseWheelZoom: true|false, //default true
				update: function (cropper) { }
			});
			// bind an image to croppie
			c.bind({
				url: 'images/background-img-6.jpg',
				points: [x1, y1, x2, y2]
			});
			// set the zoom programatically. Restricted to the min/max values of the slider
			c.setZoom(1.5);
			// get crop points from croppie
			var data = c.get();
			// get result from croppie
			// returns Promise
			var result = c.result('html|canvas').then(function (img) {
				//img is html positioning & sizing the image correctly if resultType is 'html'
				//img is base64 url of cropped image if resultType is 'canvas' 
			});
			
			
			$('#item').croppie(opts);

			$('#item').croppie(method, args);
</script>
<script src="js/croppie.js" />
<script src="js/prism.js" />
</html>