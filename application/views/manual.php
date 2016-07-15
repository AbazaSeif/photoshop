<script>
$(document).ready(function(){
	$("#innerNav a").on('click', function(event) {
		event.preventDefault();

		var hash = this.hash;

		$('body').animate({
				scrollTop: $(hash).offset().top
			}, 900, function(){
				window.location.hash = hash;
		});
	});
})
</script>
<style>
body{
	background: #c4e4da;
}

#navigation{
	height:100px;
	background-image: url('<?php echo base_url().'images/nav.png'; ?>');
	background-size: 100% 100%;
}

#navigation div ul{
	list-style-type: none;
    margin: 0;
    padding: 0;
}

#navigation div ul li {
    display: inline;
	margin-left:5px;
}

#navigation {
	position: fixed;
	z-index: 8888;
	width:100%;
}

.content{
	font-size:18px;
}
</style>
<div id="navigation" class="container-fluid">
	<div style="position: relative; top: 45px; left: 1044px;">
		<ul>
			<li>
				<a href="<?php echo base_url()."index.php/process/index"; ?>">
					<img 
						height="60" src="<?php echo base_url().'images/home.png'; ?>" 
						onmouseover="this.src='<?php echo base_url().'images/home_high.png'; ?>'"
						onmouseout="this.src='<?php echo base_url().'images/home.png'; ?>'"
						border="0" alt=""/>
				</a>
			</li>
			<li>
				<a href="#">
					<img 
						height="60" src="<?php echo base_url().'images/manual_high.png'; ?>" 
						onmouseover="this.src='<?php echo base_url().'images/manual_high.png'; ?>'"
						onmouseout="this.src='<?php echo base_url().'images/manual_high.png'; ?>'"
						border="0" alt=""/>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url()."index.php/process/about"; ?>">
					<img 
						height="60" src="<?php echo base_url().'images/about.png'; ?>" 
						onmouseover="this.src='<?php echo base_url().'images/about.png'; ?>'"
						onmouseout="this.src='<?php echo base_url().'images/about.png'; ?>'"
						border="0" alt=""/>
				</a>
			</li>
		</ul>
	</div>
</div>

<style>
ul.nav-pills {
	position: fixed;
	z-index: 8888;
}

.sectioning{
	padding-top:100px;
}

.content{
	padding-top:20px;
}
</style>

<div class="container">
	<div class="row">
		<div class="col-sm-12" style="height:141px;">
		</div>
		<div class="col-sm-2">
			<nav class="text-center" id="myScrollspy">
				<ul id="innerNav" class="nav nav-pills nav-stacked">
					<li class="active"><a href="#section1">Getting Started</a></li>
					<li><a href="#section2">Changing Color</a></li>
					<li><a href="#section15">Brush</a></li>
					<li><a href="#section3">Background</a></li>
					<li><a href="#section4">Eraser</a></li>
					<li><a href="#section5">Stroke Width</a></li>
					<li><a href="#section6">Adding Layer</a></li>
					<li><a href="#section7">Changing Layer</a></li>
					<li><a href="#section8">Layer Visibility</a></li>
					<li><a href="#section9">Layer Opacity</a></li>
					<li><a href="#section10">Layer Order</a></li>
					<li><a href="#section11">Importing Images</a></li>
					<li><a href="#section12">Cropping</a></li>
					<li><a href="#section13">Undo and Redo</a></li>
					<li><a href="#section14">Downloading</a></li>
				</ul>
			</nav>
		</div>
		<div class="col-sm-10">
			<div id="section1" class="sectioning">    
				<h1><u>Getting Started</u></h1>
				<div class="row well">
					<div class="col-sm-6">
						<img class="img-rounded img-responsive" src="<?php echo base_url().'images/1.png'; ?>">
					</div>
					<div class="col-sm-6 text-justify content">
						Place the width and height of the canvas. This will determine the
						dimension the image will be when downloaded.
					</div>
				</div>
			</div>
			<div id="section2" class="sectioning">    
				<h1><u>Changing Color</u></h1>
				<div class="row well">
					<div class="col-sm-6 text-justify content">
						Drag the color controls around to change the color of the brush or background tool.
						You can also input the hex value of the color you want.
					</div>
					<div class="col-sm-6">
						<img class="img-rounded img-responsive" src="<?php echo base_url().'images/2.png'; ?>">
					</div>
				</div>
			</div>
			<div id="section15" class="sectioning">    
				<h1><u>Brush</u></h1>
				<div class="row well">
					<div class="col-sm-6">
						<img class="img-rounded img-responsive" src="<?php echo base_url().'images/3.png'; ?>">
					</div>
					<div class="col-sm-6 text-justify content">
						Click on the brush on enable the tool then hold down the left click while dragging on the canvas
						to create drawings.
					</div>
				</div>
			</div>
			<div id="section3" class="sectioning">    
				<h1><u>Background</u></h1>
				<div class="row well">
					<div class="col-sm-6 text-justify content">
						Click on the background button to set the current canvas background color.
					</div>
					<div class="col-sm-6">
						<img class="img-rounded img-responsive" src="<?php echo base_url().'images/4.png'; ?>">
					</div>
				</div>
			</div>
			<div id="section4" class="sectioning">    
				<h1><u>Eraser</u></h1>
				<div class="row well">
					<div class="col-sm-6">
						<img class="img-rounded img-responsive" src="<?php echo base_url().'images/5.png'; ?>">
					</div>
					<div class="col-sm-6 text-justify content">
						To use the eraser tool, simply click on the eraser tool. It has the same functionality of a brush except that
						it makes the erased part transparent not just covering it white.
					</div>
				</div>
			</div>
			<div id="section5" class="sectioning">    
				<h1><u>Stroke Width</u></h1>
				<div class="row well">
					<div class="col-sm-6 text-justify content">
						The first slider you will see below the drawing tools allows the user to increase or decrease the radius of the
						drawing tools. This applies to the brush and eraser.
					</div>
					<div class="col-sm-6">
						<img class="img-rounded img-responsive" src="<?php echo base_url().'images/6.png'; ?>">
					</div>
				</div>
			</div>
			<div id="section6" class="sectioning">    
				<h1><u>Adding Layer</u></h1>
				<div class="row well">
					<div class="col-sm-6">
						<img class="img-rounded img-responsive" src="<?php echo base_url().'images/7.png'; ?>">
					</div>
					<div class="col-sm-6 text-justify content">
						Instead of having all your drawings into one layer, you can divide them in multiple layers which will
						make editing easier. To add another layer, just click on the Add Layer button. Once clicked, a new layer
						will be added and set as the current layer.
					</div>
				</div>
			</div>
			<div id="section7" class="sectioning">    
				<h1><u>Changing Layer</u></h1>
				<div class="row well">
					<div class="col-sm-6 text-justify content">
						To change from one working layer to another, simply click on the radio button. A green color background on the
						layer indicates the current layer you are working on.
					</div>
					<div class="col-sm-6">
						<img class="img-rounded img-responsive" src="<?php echo base_url().'images/8.png'; ?>">
					</div>
				</div>
			</div>
			<div id="section8" class="sectioning">    
				<h1><u>Layer Visibility</u></h1>
				<div class="row well">
					<div class="col-sm-6">
						<img class="img-rounded img-responsive" src="<?php echo base_url().'images/9.png'; ?>">
					</div>
					<div class="col-sm-6 text-justify content">
						Given the example on the left. Layer 1 consists of the background color, Layer 2 consists of the sun, and Layer 3
						consists of the terrain. Layer 2 visibility has been set to hidden indicated by the closed eye thus hiding the
						sun. You can toggle from eye open to eye close by clicking on it.
					</div>
				</div>
			</div>
			<div id="section9" class="sectioning">    
				<h1><u>Layer Opacity</u></h1>
				<div class="row well">
					<div class="col-sm-6 text-justify content">
						Given the same example above, you can see that the terrain which was drawn on Layer 3 has changed its opacity. This is
						done by sliding left to right to control the opacity. Right being opaque.
					</div>
					<div class="col-sm-6">
						<img class="img-rounded img-responsive" src="<?php echo base_url().'images/10.png'; ?>">
					</div>
				</div>
			</div>
			<div id="section10" class="sectioning">    
				<h1><u>Layer Order</u></h1>
				<div class="row well">
					<div class="col-sm-6">
						<img class="img-rounded img-responsive" src="<?php echo base_url().'images/11.png'; ?>">
					</div>
					<div class="col-sm-6 text-justify content">
						Given the same example you can easily interchange the order of the layers. Recall that we drew the sun on Layer 2 then
						the terrain on Layer 3 thus having the sun behind the mountain. But by simply dragging Layer 2 below Layer 3 we changed
						the order of the Layers 2 and 3. Now the sun is in front of the mountain.
					</div>
				</div>
			</div>
			<div id="section11" class="sectioning">    
				<h1><u>Importing Images</u></h1>
				<div class="row well">
					<div class="col-sm-6">
						<img class="img-rounded img-responsive" src="<?php echo base_url().'images/12.png'; ?>">
					</div>
					<div class="col-sm-6">
						<img class="img-rounded img-responsive" src="<?php echo base_url().'images/13.png'; ?>">
					</div>
					<div class="col-sm-12 text-justify content">
						<br>
						<br>
						(Left Image)<br>
						To import images simply click the Import Images button and select the images to be uploaded. Uploaded images will appear
						below the button.
						<br>
						<br>
						(Right Image)<br>
						You can select the image by clicking on it. Once the image is clicked you can now place it on the canvas by dragging the image. You can manipulate
						the image by changing its height and width by dragging on the square found on the vertices of the image. Once done, click the Paste
						button to embed the image on the current working canvas.
					</div>
				</div>
			</div>
			<div id="section12" class="sectioning">    
				<h1><u>Cropping</u></h1>
				<div class="row well">
					<div class="col-sm-6">
						<img class="img-rounded img-responsive" src="<?php echo base_url().'images/15.png'; ?>">
					</div>
					<div class="col-sm-6">
						<img class="img-rounded img-responsive" src="<?php echo base_url().'images/16.png'; ?>">
					</div>
					<div class="col-sm-12 text-justify content">
						<br>
						<br>
						(Left Image)<br>
						 The Paint system also allows the user to select certain part of a drawing or image. To use the crop function, click on the
						 Crop button then a box with blue background will appear, you can drag and resize the box on the part of the canvas you want
						 to crop. Once you have selected an area simply click on the Crop button on top of the box.
						<br>
						<br>
						(Right Image)<br>
						Once you clicked the Crop button on top of the box, the selected area will be copied from the canvas. You can now choose to
						download the cropped area as image. This is useful if you want to create icons.
					</div>
				</div>
			</div>
			<div id="section13" class="sectioning">    
				<h1><u>Undo and Redo</u></h1>
				<div class="row well">
					<div class="col-sm-12 text-justify content">
						This is what you think it is. I hope we are thinking of the same thing.
					</div>
				</div>
			</div>
			<div id="section14" class="sectioning">    
				<h1><u>Downloading</u></h1>
				<div class="row well">
					<div class="col-sm-6 text-justify content">
						Once you have finished your masterpiece, you can press the Dowload button to download the image to your computer.
						This function will combine all your layers into one picture. NOTE! Only visible layers will be combined to a single image.
						Remember the eye thingy?
					</div>
					<div class="col-sm-6">
						<img class="img-rounded img-responsive" src="<?php echo base_url().'images/17.png'; ?>">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

