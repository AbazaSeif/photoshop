<script>

var width=0;
var height=0;

var canvasCnt = 1;
var canvasCrnt = 1;
var canvas = [];
var ctx = [];
var mouse = {x: 0, y: 0};
var last_mouse = {x: 0, y: 0};
var p;
var position;
var flag = false;

var canvasStroke = 10;
var canvaslineCap = 'round';
var canvaslineJoin = 'round';
var canvasstrokeStyle = '#000000';

var drawingType = 'brush';

var imageCount = 0;

var undo_list = [];
var redo_list = [];

var mainCanvas;
var mainCtx;

var onPaint = function() {
	if(flag){
		ctx[canvasCrnt].beginPath();
		ctx[canvasCrnt].moveTo(last_mouse.x, last_mouse.y);
		ctx[canvasCrnt].lineTo(mouse.x, mouse.y);
		ctx[canvasCrnt].closePath();
		ctx[canvasCrnt].stroke();
	}		
};

function color(val = 'brush'){

	if(val=='brush'){
		ctx[canvasCrnt].globalCompositeOperation = "source-over";
	}else if(val=='bg'){
		ctx[canvasCrnt].globalCompositeOperation = "source-over";
		ctx[canvasCrnt].rect(0,0,$("#canvas"+canvasCrnt+"").width(),$("#canvas"+canvasCrnt+"").height());
		ctx[canvasCrnt].fillStyle = canvasstrokeStyle;
		ctx[canvasCrnt].fill();	
	} else {
		 canvasstrokeStyle = "#ffffff";
		 ctx[canvasCrnt].strokeStyle = canvasstrokeStyle;
		 ctx[canvasCrnt].globalCompositeOperation = "destination-out";
		 $('#pickerDiv').ColorPickerSetColor(canvasstrokeStyle);
	}
	
	$(".tool").removeClass("active");
	$(".tool").removeClass("focus");
	$("#"+val).addClass("active");
	$("#"+val).addClass("focus");
	
	drawingType = val;
}

function dimension(){
	width =	$("#width").val();
	height = $("#height").val();
	$("#canvasDiv").append('<canvas class="can" id="mainC" width="'+width+'px" height="'+height+'px" style="display:none; position:absolute; margin-top:0px; margin-left:0px;"></canvas>');
	mainCanvas = $("#mainC")[0];
	ctxmainCtx = mainCanvas.getContext("2d");
	
	$("#just_container").css('height',height);
	$("#just_container").css('width',width);
	
	//undo_list.push(mainCanvas.toDataURL('image/png'));
	add_canvas();

}

function changeCanvas(i){
	canvasCrnt = i;
	ctx[canvasCrnt].lineWidth = canvasStroke;
	ctx[canvasCrnt].strokeStyle = canvasstrokeStyle;
	$(".canvisList").removeClass("btn-success");
	$("#"+i).addClass("btn-success");
}

function changeBrushSize(){
	canvasStroke = $("#brushRadius").slider("value");
	ctx[canvasCrnt].lineWidth = canvasStroke;
	ctx[canvasCrnt].globalAlpha = canvasStroke;
}

function toggleLayer(i) {
	$("#canvas"+i).toggle();
	$("#layerVisib"+i).toggleClass('glyphicon-eye-open glyphicon-eye-close');
}

function changeIndex(){
	var a = $("#sortable").find("li");
	for(var i = 0; i < a.length; i++){
		 $("#canvas"+a[i].id).css( "z-index",i+1);
	}
}

function changeOpacity(i){
	var opacity = $("#"+i).slider("value");
	var opacity = opacity * 1 / 100;
	var canvasId = i * 1 - 1000;
	$("#canvas"+canvasId).css('opacity',opacity);
}

function save_img(){
	var a = $("#sortable").find("li");
	for(var i = 0; i < a.length; i++){
		if($("#canvas"+a[i].id).css('display') != 'none'){
			var imgData = document.getElementById('canvas'+a[i].id);		
			ctxmainCtx.globalAlpha= $("#canvas"+a[i].id).css('opacity');
			ctxmainCtx.drawImage(imgData, 0, 0);
		}
	}
	
	var a = document.createElement('a')
	    a.download = '<?php echo 'image_'.date("Y-m-d"); ?>';
	    a.href = mainCanvas.toDataURL("image/png");
	    document.body.appendChild(a);
	    a.click();
	    a.remove();
	
	
	// var canvasData = mainCanvas.toDataURL("image/png");
	// var ajax = new XMLHttpRequest();
	// ajax.open("POST",'<?php echo base_url().'index.php/process/pocess_image'; ?>',false);
	// ajax.setRequestHeader('Content-Type', 'application/upload');
	// ajax.send(canvasData);

	//$.post('<?php echo base_url().'index.php/process/pocess_image'; ?>',{image:mainCanvas.toDataURL('image/png'),mode:'save'},function(data, status){
	   //window.location = '/photoshop/index.php/process/execute';
		//alert(data);
   //});
}

function download_crop(){
	
	var a = document.createElement('a')
	    a.download = '<?php echo 'image_'.date("Y-m-d"); ?>';
	    a.href = $("#cropCanvas")[0].toDataURL('image/png');
	    document.body.appendChild(a);
	    a.click();
	    a.remove();
	
	// $.post('<?php echo base_url().'index.php/process/process_crop'; ?>',{image:$("#cropCanvas")[0].toDataURL('image/png'),mode:'save'},function(data, status){
	   // $('#cropCanvas').parent().remove();
	   // $('#cropCanvas').remove();
	   // $("#just_container").css('z-index',0);
	   // window.location = '/photoshop/index.php/process/commence';
    // });

}

function add_canvas(){
	$("#canvasDiv").append('<canvas class="can" id="canvas'+canvasCnt+'" width="'+width+'px" height="'+height+'px" style="z-index:'+canvasCnt+'; position:absolute; margin-top:-'+height+'px; margin-left:0px; border:1px solid black;" ></canvas>'); 
	
	$("#sortable li").removeClass("btn-success");
	var sliderId = canvasCnt + 1000;
	$("#sortable").append('<li id="'+canvasCnt+'" class="canvisList ui-state-default btn-success"><span class="labelCon"></span><input name="canvaslayer" type="radio" value="1" style="margin-left: -20px;" checked onclick="changeCanvas('+canvasCnt+')"> Layer '+canvasCnt+'</input> <button type="button" class="btn" style="margin-left: 38px;" onclick="toggleLayer('+canvasCnt+')"><span id="layerVisib'+canvasCnt+'" style="color:black;" class="glyphicon glyphicon-eye-open logo-small"></span></button><div class="sliderOpacity" id="'+sliderId+'" style="width:151px; margin-left: 168px; margin-top: -25px;"></div><br></li>'); 
	canvasCrnt = canvasCnt;
	
	$("#"+sliderId).slider({
	  value: 100,
	  max: 100,
	  min: 10,
	  orientation: "horizontal",
	  range: "min",
	  animate: true,
	  slide: function(event,ui){
				
				changeOpacity($(this).attr("id"));
			},
	  change: function(event,ui){
				changeOpacity($(this).attr("id"));
			}
	});
	
	canvas[canvasCrnt] = $("#canvas"+canvasCnt+"")[0];
	ctx[canvasCrnt] = canvas[canvasCrnt].getContext("2d");
	
	p = $( "#canvas"+canvasCrnt+"" );
	
	position = p.offset();

	ctx[canvasCrnt].lineWidth = canvasStroke;
	ctx[canvasCrnt].lineCap = canvaslineCap;
	ctx[canvasCrnt].lineJoin = canvaslineJoin;
	ctx[canvasCrnt].strokeStyle = canvasstrokeStyle;
	
	canvas[canvasCrnt].addEventListener('mousemove', function(e) {
		last_mouse.x = mouse.x;
		last_mouse.y = mouse.y;
	
		// mouse.x = e.pageX - this.offsetLeft;
		// mouse.y = e.pageY - this.offsetTop;
		
		//mouse.x = e.pageX - position.left;
		//mouse.y = e.pageY - this.offsetTop;
		
		mouse.x = e.pageX - position.left;
		mouse.y = e.pageY - $("#canvasDiv").offset().top - 15;
		
		//mouse.x = e.pageX;
		//mouse.y = e.pageY;
	
	}, false);
	
	canvas[canvasCrnt].addEventListener('mousedown', function(e) {
		flag = true;
		canvas[canvasCrnt].addEventListener('mousemove', onPaint, false);
	}, false);
	
	canvas[canvasCrnt].addEventListener('mouseup', function() {
		
		if(flag){
			saveState();
		}
		
		flag = false;
		
	}, false);
	
	saveState();
	canvasCnt++;
}

function saveState(){
	undo_list.push(canvas[canvasCrnt].toDataURL('image/png'));
}

function undo(){
	
	if(undo_list.length>0){
		var lastAction = undo_list.pop();
		redo_list.push(lastAction);
		
		stateToRestore = undo_list[undo_list.length-1];
		 
		var img = new Image();
		img.src = stateToRestore;
		img.onload=function(){
			ctx[canvasCrnt].clearRect(0, 0, width, height);
			ctx[canvasCrnt].drawImage(img, 0, 0);
		};
	}
}

function redo(){

	if(redo_list.length>0){
		var stateToRestore = redo_list.pop();
		undo_list.push(stateToRestore);		
		var img = new Image();
		img.src = stateToRestore;
		img.onload=function(){
			ctx[canvasCrnt].clearRect(0, 0, width, height);
			ctx[canvasCrnt].drawImage(img, 0, 0);
		};
	}
	
}

function draw_img(){
	var image = new Image();
	image.src = document.getElementById('imageM').src;
	var cnt = image.src;
	if(cnt.length>0){
		ctx[canvasCrnt].drawImage(image,$(".resize").offset().left-$("#canvas"+canvasCrnt).offset().left,$(".resize").offset().top-$("#canvas"+canvasCrnt).offset().top,$(".resize").width(),$(".resize").height());
		$('#imageDivDrag').remove();
		$('#imageM').remove();
		$("#just_container").css('z-index',0);
		saveState();
	}

}

function generateImg(i){
	var source = document.getElementById('img'+i).src;
	//alert(source);
	var idelem = 'imageDivDrag';
	$('#'+idelem).remove();
	var btn = document.createElement("DIV");
	btn.id = idelem;
	btn.className = "resize";
	document.body.appendChild(btn);
	 $(".resize").width(413);
	 $(".resize").height(310);
	 $(".resize").css('top',158);
	 $(".resize").css('left',495);
	 $("#imageDivDrag").css('background-image','url("'+source+'")');
	 $("#imageDivDrag").css('background-size','100% 100%');
	
	var idelem = 'imageM';
	var btn = document.createElement("IMG");
	btn.id = idelem;
	document.body.appendChild(btn);
	document.getElementById(btn.id).src = source;
	$("#imageM").css('display','none');
	
	 $(".resize").resizable({
		handles: 'ne, se, sw, nw',
		resize: function( event, ui ) {
			
		}
	});

	$(".resize").draggable({
		stack: "div",
		drag: function( event, ui ) {
			
		}
	});
	
	var idelem = 'imgControl';
	var btn = document.createElement("DIV");
	btn.id = idelem;
	
	$("#imageDivDrag").append(btn);
	$("#imgControl").css('height','35px');
	$("#imgControl").css('width','200px');
	$("#imgControl").css('position','relative');
	$("#imgControl").css('top','-50px');

	$("#imgControl").append('<div id="imageGroup" class="btn-group" data-toggle="buttons-radio"></div>');
	
	var btn = document.createElement("BUTTON");
	var text = document.createTextNode("Paste");       // Create a text node
	btn.id = 'flatImage';
	btn.className = "btn btn-primary";
	btn.type = "button";
	btn.appendChild(text); 
	
	$("#imageGroup").append(btn);
	
	btn.onclick = function(){
		draw_img();
	};
	
	var btn = document.createElement("BUTTON");
	var text = document.createTextNode("Discard");       // Create a text node
	btn.id = 'discardImg';
	btn.className = "btn btn-primary";
	btn.type = "button";
	btn.appendChild(text); 
	
	$("#imageGroup").append(btn);
	
	btn.onclick = function(){
		$('#imageDivDrag').remove();
		$('#imageM').remove();
		$("#just_container").css('z-index',0);
	};
	
}

function crop(){
	var idelem = 'cropDiv';
	$('#'+idelem).remove();
	var btn = document.createElement("DIV");
	btn.id = idelem;
	btn.className = "resize";
	document.body.appendChild(btn);
	
	$(".resize").width(413);
	$(".resize").height(310);
	$(".resize").css('top',158);
	$(".resize").css('left',495);
	$("#cropDiv").css('background','rgba(147,190,222,.3)');
	$("#cropDiv").css('border-color','rgb(19, 47, 199)');
	$("#cropDiv").css('border-style','dotted');
	$("#cropDiv").css('border-width','2px');

	$(".resize").resizable({
		handles: 'ne, se, sw, nw',
		resize: function( event, ui ) {
			
		}
	});

	$(".resize").draggable({
		stack: "div",
		drag: function( event, ui ) {
			
		}
	});
	
	var idelem = 'cropControl';
	var btn = document.createElement("DIV");
	btn.id = idelem;

	$("#cropDiv").append(btn);
	$("#cropControl").css('height','35px');
	$("#cropControl").css('width','200px');
	$("#cropControl").css('position','relative');
	$("#cropControl").css('top','-50px');
	
	$("#cropControl").append('<div id="cropGroup" class="btn-group" data-toggle="buttons-radio"></div>');
	
	var btn = document.createElement("BUTTON");
	var text = document.createTextNode("Crop");       // Create a text node
	btn.id = 'cropCrop';
	btn.className = "btn btn-primary";
	btn.type = "button";
	btn.appendChild(text); 
	
	$("#cropGroup").append(btn);
	
	btn.onclick = function(){
		crop_image();
	};
	
	

}

function crop_image(){
	
	var cropWidth = $('#cropDiv').width();
	var cropHeight = $('#cropDiv').height();
	var cropLeft = $('#cropDiv').offset().left;
	var cropTop = $('#cropDiv').offset().top;
	$('#cropDiv').remove();
	
	var idelem = 'cropCanvas';
	$('#'+idelem).remove();
	var btn = document.createElement("CANVAS");
	btn.id = idelem;
	btn.className = "resize";
	btn.width = cropWidth;
	btn.height = cropHeight;
	
	document.body.appendChild(btn);
	$(".resize").css('top',cropTop);
	$(".resize").css('left',cropLeft);
	
	var tempCanvas = $("#cropCanvas")[0];
	var tempCtx = tempCanvas.getContext("2d");
	var imgData = document.getElementById('canvas'+canvasCrnt);	
	
	var sourceX = cropLeft-$("#canvas"+canvasCrnt).offset().left;
	var sourceY = cropTop-$("#canvas"+canvasCrnt).offset().top;
	var sourceWidth = cropWidth;
	var sourceHeight = cropHeight;
	var destWidth = cropWidth;
	var destHeight = cropHeight;
	var destX = 0;
	var destY = 0;

	tempCtx.drawImage(imgData, sourceX, sourceY, sourceWidth, sourceHeight, destX, destY, destWidth, destHeight);
	
	
	$(".resize").resizable({
		handles: 'ne, se, sw, nw',
		resize: function( event, ui ) {
			
		}
	});

	$(".resize").parent().draggable({
		stack: "div",
		drag: function( event, ui ) {
			
		}
	});
	
	$("#cropCanvas").parent().css('z-index','50');
	$("#cropCanvas").parent().css('overflow','');
	$("#cropCanvas").after('<div id="imageGroup" class="btn-group" data-toggle="buttons-radio"></div>');
	$("#imageGroup").css('height','35px');
	$("#imageGroup").css('width','200px');
	$("#imageGroup").css('top','8px');
	
	var btn = document.createElement("BUTTON");
	var text = document.createTextNode("Download");       // Create a text node
	btn.id = 'cropDiscard';
	btn.className = "btn btn-primary";
	btn.type = "button";
	btn.appendChild(text); 
	
	$("#imageGroup").append(btn);
	
	btn.onclick = function(){
		download_crop();
	};
	
	var btn = document.createElement("BUTTON");
	var text = document.createTextNode("Discard");       // Create a text node
	btn.id = 'cropDiscard';
	btn.className = "btn btn-primary";
	btn.type = "button";
	btn.appendChild(text); 
	
	$("#imageGroup").append(btn);
	
	btn.onclick = function(){
		$('#cropCanvas').parent().remove();
		$('#cropCanvas').remove();
		$("#just_container").css('z-index',0);
	};
	
}

$(document).ready(function(){
	
	$("#myModal").modal();
	
	
	$('#pickerDiv').ColorPicker({
		flat: true,
		onChange: function (hsb, hex, rgb) {
			canvasstrokeStyle = '#' + hex;
			if(drawingType=='brush'){
				ctx[canvasCrnt].strokeStyle = canvasstrokeStyle;
			}else if(drawingType=='bg'){
				ctx[canvasCrnt].rect(0,0,$("#canvas"+canvasCrnt+"").width(),$("#canvas"+canvasCrnt+"").height());
				ctx[canvasCrnt].fillStyle = canvasstrokeStyle;
				ctx[canvasCrnt].fill();	
			}
		}
	});
	
	
	$('#pickerDiv').ColorPickerSetColor(canvasstrokeStyle);
	
	
	$("#layerAdd").click(function(){
	   $("#layerAdd").removeClass("active");
	   $(this).addClass("active");
	});
	
	$( "#sortable" ).sortable({
		update: function( event, ui ) {
			changeIndex();
		}
	});
	
	$("#brushRadius").slider({
	  value: 10,
	  max: 100,
	  min: 1,
	  orientation: "horizontal",
	  range: "min",
	  animate: true,
	  slide: changeBrushSize,
	  change: changeBrushSize
	});
	
	$(".imageImport").change(function(){
		var data = new FormData($("#pic_upload")[0]);
			
		$.ajax({
			url: '<?php echo base_url().'index.php/process/upload_pictures'; ?>',
			type: 'POST',
			data: data,
			cache: false,
			processData: false, // Don't process the files
			contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			success: function(data, textStatus, jqXHR)
			{				
				//alert(data.trim());
				var str = data.trim();
				var files = str.split('|');
				
				for(var i=0; i<files.length; i++){
					$("#imagesDiv").append('<img id="img'+imageCount+'" width="110" src="'+files[i]+'" onclick="generateImg('+imageCount+')"/>');
					imageCount++;
				}
				
				$('#pic_upload')[0].reset();
				
			},
			error: function(jqXHR, textStatus, errorThrown)
			{
				// Handle errors here
				console.log('ERRORS: ' + textStatus);
				// STOP LOADING SPINNER
			}
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

#controlsDiv{
	position:absolute;
	width: 402px;
    margin-top: 20px;
    margin-left: 20px;
}

#canvasDiv{
	position:absolute;
	margin-top: 20px;
    margin-left: 450px;
}

#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 49px; width: 355px; }
#sortable li .labelCon { position: absolute; margin-left: -1.3em; }

.resize{
	 position:absolute;
	 border-color:black;
	 border-style:solid;
	 border-width:1px;
	 z-index: 100;
}
.ui-resizable-se{
	 width: 10px;
	 height: 10px;
	 background-color: #D0F2F0;
	 border-color:#45C1B1;
	 border-style:solid;
	 border-width:1px;
	 bottom:0px;
	 right:0px;
}
.ui-resizable-sw{
	 width: 10px;
	 height: 10px;
	 background-color: #D0F2F0;
	 border-color:#45C1B1;
	 border-style:solid;
	 border-width:1px;
	 bottom:0px;
	 left:0px;
}
.ui-resizable-nw{
	 width: 10px;
	 height: 10px;
	 background-color: #D0F2F0;
	 border-color:#45C1B1;
	 border-style:solid;
	 border-width:1px;
	 top:0px;
	 left:0px;
}
.ui-resizable-ne{
	 width: 10px;
	 height: 10px;
	 background-color: #D0F2F0;
	 border-color:#45C1B1;
	 border-style:solid;
	 border-width:1px;
	 top:0px;
	 right:0px;
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
						height="60" src="<?php echo base_url().'images/about.png'; ?>" 
						onmouseover="this.src='<?php echo base_url().'images/about_high.png'; ?>'"
						onmouseout="this.src='<?php echo base_url().'images/about.png'; ?>'"
						border="0" alt=""/>
				</a>
			</li>
		</ul>
	</div>
</div>

<div id="controlsDiv" class="well">
	<!-- COLOR PICKER -->
	<div id="pickerDiv"></div>
	
	<!-- TOOLS -->
	<div style="width:357px; margin-top:10px;">
		<div class="btn-group" data-toggle="buttons-radio">
			<button type="button" id="brush" class="tool btn btn-primary active" onclick="color('brush')" autofocus="true">Brush</button>
			<button type="button" id="bg" class="tool btn btn-primary" onclick="color('bg')">Background</button>
			<button type="button" id="eraser" class="tool btn btn-primary" onclick="color('eraser')">Eraser</button>
		</div>
	</div>
	
	<!-- BRUSH RADIUS -->
	<div id="brushRadius" style="width:357px; margin-top:15px;"></div>
	
	<!-- LAYERS -->
	<div id="layerDiv" style="width:357px; margin-top:15px;">
		<button id="layerAdd" type="button" class="btn btn-primary" onclick="add_canvas()">Add Layer</button>
		<ul id="sortable" style="margin-top:15px;">
		</ul>
	</div>
	
	<!-- FILE UPLOAD -->
	<div id="uploadDiv" style="width:357px; margin-top:15px;">
		<form action="upload_file" id="pic_upload" method="post" enctype="multipart/form-data">
			<label class="btn btn-primary">
				Import Images <input class="imageImport" type="file" name="file[]" id="file[]" size="2000" multiple style="display: none;">
			</label>
		</form>
	</div>
	
	<!-- IMAGE CONTAINER -->
	<div id="imagesDiv" style="width:357px; margin-top:15px;">
		
	</div>
	
	
	
	<button id="download" type="button" style="margin-top:15px;" class="btn btn-primary" onclick="save_img()">Download</button>
	
	<button id="undo" type="button" style="margin-top:15px;" class="btn btn-primary" onclick="undo()">Undo</button>
	<button id="redo" type="button" style="margin-top:15px;" class="btn btn-primary" onclick="redo()">Redo</button>
	
	<button id="crop" type="button" style="margin-top:15px;" class="btn btn-primary" onclick="crop()">Crop</button>

</div>

<div id="canvasDiv" class="well">
	<div id="just_container" style="position:relative; margin-top:0px; margin-left:0px; z-index:0;">
	</div>
</div>



<div class="modal fade" id="myModal" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Before Starting</h4>
			</div>
			<div class="modal-body">
				<div class="form-group has-feedback">
					<input type="input" name="width" value="1080" class="form-control" id="width" placeholder="Width" required>				
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="input" name="height" value="655" class="form-control" id="height" placeholder="Height" required>				
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" onclick="dimension()">Create</button>
			</div>
		</div>
	</div>
</div>