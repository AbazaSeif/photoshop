<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Photoshop</title>
		<meta charset="utf-8">

		<!-- IMAGE FONTS -->
		<link rel="stylesheet" href="<?php echo base_url();?>css/icomoon/style.css" type="text/css" media="screen" />

		<!-- JQUERY -->
		<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css" type="text/css" media="screen" />
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui.js"></script>
		
		<!-- ANGULAR -->
		<script type="text/javascript" src="<?php echo base_url();?>js/angular.min.js"></script>
		
		<!--COLOR PICKER -->
		<link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url();?>css/colorpicker.css" />
		<script type="text/javascript" src="<?php echo base_url();?>js/colorpicker.js"></script>

		<!-- RESPONSIVE BOOTSTRAP -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" type="text/css" media="screen" />
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/validator.js"></script>
	</head>
	
	<body id="myPage" data-spy="scroll" data-target="#myScrollspy" data-offset="100">
		<?php $this->load->view($content); ?>
	</body>
	
</html>
