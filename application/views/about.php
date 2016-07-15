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
				<a href="<?php echo base_url()."index.php/process/manual#section1"; ?>">
					<img 
						height="60" src="<?php echo base_url().'images/manual.png'; ?>" 
						onmouseover="this.src='<?php echo base_url().'images/manual_high.png'; ?>'"
						onmouseout="this.src='<?php echo base_url().'images/manual.png'; ?>'"
						border="0" alt=""/>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url()."index.php/process/about"; ?>">
					<img 
						height="60" src="<?php echo base_url().'images/about_high.png'; ?>" 
						onmouseover="this.src='<?php echo base_url().'images/about_high.png'; ?>'"
						onmouseout="this.src='<?php echo base_url().'images/about_high.png'; ?>'"
						border="0" alt=""/>
				</a>
			</li>
		</ul>
	</div>
</div>

<style>
#about{
	font-size:24px;
}
</style>

<div class="container" style="margin-top:40px;">
	<div class="row">
		<div id="about" class="col-sm-12 text-justify">
		Paint is a simple program that allows users to draw, scribble, create icons and
		manipulate images. Paint combines some of the photoshop features such as layering,
		opacity and image cropping. This system was intended for everyone both developers
		and users especially those who just love playing around with images but does own
		or have any knowledge of photoshop.
		<br>
		<br>
		For developers, this is a free system with downloadable source code. Paint system
		was created using HTML5 Canvas combined with a lot of Javascript, jQuery and Ajax.
		I always wanted to contribute and give something back to the web especially to
		my fellow developers who are having a hard time implementing web apps with canvas.
		Hopefully some of the source code will help you.
		<br>
		<br>
		This system is still a work in progress and I am open to any suggestion on how we
		can improve it. Ow, and I like to thank the author of the beautiful color picker,
		whoever you are I admire your work.
		</div>
	</div>
</div>