<?php
header('Location: /index.php?msg=1');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
<title>muat naik gambar</title>
<style>
* {
	font-family:Arial, Helvetica, sans-serif;
	color:#1f1f1f;
	border:0;
	margin:0;
	padding:0;
	/*background-color:#f7f7f7;*/
}
html, body {
	font-size:100%;
}
h1,h2 {
    font-family: 'Open Sans Condensed', sans-serif;
	font-size:1.85em;
	padding-top:2.0em;
	padding-bottom:0.5em;
}
h2 {
	font-size:1.25em;
}
p {
	font-size:0.85em;
}
#parentbox {
	position:relative;
}
#FileUpload {
	float:left;
}
#FileField {
    width:205px;
	margin-right:10px;
	padding: 6px;
    background: #fff url('http://i.stack.imgur.com/CGQD7.gif') top left repeat-x;
    border: 1px solid #d5d5d5;
	color: #333;
	border-radius: 4px 4px 4px 4px !important;
}

#fileselect {
    position:absolute;
    width:310px;
	height:30px;
	top:0px;
    text-align: right;
    -moz-opacity:0;
    filter:alpha(opacity: 0);
    opacity: 0;
    z-index: 2;
}
#BrowserVisible {
    position: absolute;
    top: 0px;
    left: 0px;
    z-index: 1;
    width:315px;
	height:40px;
}
#removeImg {
	position:absolute;
	top:40px;
	left:0px;
	display:none;
}
#removeImg a {
	font-size:0.85em;
	color:#67bad4;
}
#pdf_preview {
	min-height:480px;
	width:100%;
	background-color:#FFF !important;
	overflow:hidden;
}
#pre_view {
	height:480px;
}
#preview {
	text-align:center;
}
#line {
	width:100%;
	height:1px;
	background-image:url('http://localhost/pan/line-1px.gif');
	background-repeat:repeat-x;
}
@media only screen and (max-device-width: 480px) {
	#FileField {
		width:50% !important;
	}
	#BrowserVisible {
		width:90% !important;
	}
	#fileselect {
		width:95% !important;
	}
	#pdf_preview {
		overflow:scroll;
		-webkit-overflow-scrolling: touch;
		-webkit-transform: translate3d(0, 0, 0);
	}
	#pre_view {
		height:auto !important;
		width:95% !important;
	}
}
</style>
<script type="text/javascript" src="http://localhost/ajax/libs/jquery/1.7/jquery.min.js"></script>
<link rel="stylesheet" href="http://localhost/ui/1.10.0/themes/base/jquery-ui.css">

<!-- jQuery - Shadow - Scripts Start !-->
<script src="http://localhost/pan/jquery.shadow/jquery.shadow.js"></script>	
<link rel="stylesheet" href="http://localhost/pan/jquery.shadow/jquery.shadow.css" />
<!-- jQuery - Shadow - Scripts END !-->

<script language="javascript">
var profileURL = 'http//localhost/';
var targetHost2 = 'http//localhost';
var targetWin2 = parent;
var files
var format_allowed = false;
var size_allowed = false;
var valid = false;
var filename;

//auto height parent webpage
$(document).ready(function(e) {
	
	//GET LANG CODE
	var pageRequest = window.location.search;
	var img = pageRequest.substring(pageRequest.indexOf("&p=")+3,pageRequest.length);
	var getid = pageRequest.substring(pageRequest.indexOf("?id=")+4,pageRequest.indexOf("&p="));
	
	if(img != ""){
		
		if(img.indexOf(".pdf") > -1){
				if(screen.width >= 720){
					$("#preview").html('<iframe id="pdf_preview" src="'+img+'" allowtransparency="true" frameborder="0" allowfullscreen></iframe>');
				}else{
					$("#preview").html('You\'ve uploaded a PDF file. Please click <a href="'+img+'" target="_blank">here</a> to view it.');
				}
		}else{
			$("#preview").html('<img src="" id="pre_view" name="pre_view">');
			$("#pre_view").attr('src',''+img);
			
			$('#pre_view').shadow('raised');
		}
		
		/*$("#confirm_button").val('Change');
		$("#back_button").val('No Change');*/
	
	}else{
		
		$("#preview").html('<img src="" id="pre_view" name="pre_view">');
		$("#pre_view").attr('src','http://placehold.it/640x480&text=No Image/PDF available');
		
		$("#confirm_button").val('Upload');
		$("#back_button").val('Cancel');
	
	}
	
	if (self != parent && window.postMessage) {
		 $(window).on('load', function() {
			  var targetHost = 'http://localhost',
					updateInt = 250,
					containerId = 'box1',
	
				   container = document.getElementById(containerId),
					targetWin = parent;
			  if (container) {
					setInterval(function () {
						 targetWin.postMessage(container.offsetHeight, targetHost);
					}, updateInt);
			  }
		 });
	}
	
	//goBack
	$("#back_button").click(function() {
		window.parent.location.href = profileURL + '?id=' + getid;
	});
});

//POST MESSAGE - GET RESPONSE
function listener(event){
	
	var result = event.data;
	result = String(result);
	
	if(result == "upload_ready"){
		//send Upload Success to Parent Page
		targetWin2.postMessage("imgpath:"+filename, targetHost2);
	}
}

if (window.addEventListener){
  addEventListener("message", listener, false)
} else {
  attachEvent("onmessage", listener)
}
</script>
  
</head>

<body style="background:transparent;">
<div id="box1">
<h1>upload pdf</h1>
<div id="line"></div>
<p>&nbsp;</p>
<div id="preview"></div>
<p>&nbsp;</p>
<div id="line"></div>
<iframe name="upload_iframe" src="" style="display:none;"></iframe>

<form id="upload" action="#" method="POST" enctype="multipart/form-data" target = "upload_iframe">
<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="2000000">
<input type="hidden" name="emailAddress" id="emailAddress" value="">
<input type="hidden" name="user_key" id="user_key" value="">
<input type="hidden" name="time_key" id="time_key" value="">
<input type="hidden" name="redurl" id="redurl" value="">

<h2>Upload new Image/PDF</h2>
<div id="parentbox">
<div id="FileUpload"><input type="file" size="24" id="fileselect" name="fileselect" />
<div id="BrowserVisible" style="display:inline;"><input type="text" id="FileField" /></div>
</div>

<div id="removeImg">
<a href="#" onclick="removeImagePath();">Remove choosen File</a>
</div>
</div>
</form>
<p style="clear:both;">&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><strong>Notice:</strong> By uploading an image (JPG / JPEG / GIF / PNG) or PDF of your purchase receipt, it will be possible for us to provide additional benefits and offers to you in the future.<br>
The maximum size allowed for upload is 2MB.</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<input name="back_button" type="button" id="back_button" style="text-indent:35px;width:143px;height:45px;color:#FFFFFF;border:0;" value="Cancel">

<input name="confirm_button" type="button" id="confirm_button" style="margin-right:20px;text-indent:35px;width:143px;height:45px;color:#FFFFFF;border:0;" value="Upload">
</div>
<script language="javascript">
function removeImagePath(){
	//clean fields
	document.getElementById("FileField").value = "";
	format_allowed = '';
	size_allowed = '';
	
	//check status
	checkStatus();
}
function checkStatus(){

	var img_choose = document.getElementById("FileField").value;
	
	if(img_choose != ""){
		$('#removeImg').css("display","block");
	}else{
		$('#removeImg').css("display","none");
	}
}


/* File Upload - START */

// Variable to store your files
randgen = Math.random().toString(36).substring(7);
var fl = document.getElementById('fileselect');

document.getElementById('fileselect').onchange = function(event){
		
		if(fl.value != "")
		{

			var ext = fl.value.match(/\.(.+)$/)[1];
			switch(ext)
			{
				case 'jpg':
				case 'JPG':
				case 'JPEG':
				case 'GIF':
				case 'PDF':
				case 'PNG':
				case 'jpeg':
				case 'gif':
				case 'bmp':
				case 'png':
				case 'pdf':
					format_allowed = true;
					filename = randgen + "." + ext;
					break;
				default: 
					format_allowed = false;
					break;
			}
			
			//get the file size and file type from file input field
        	var fsize = $('#fileselect')[0].files[0].size;
			var max_size = $("#MAX_FILE_SIZE").val();
			
			if(fsize > max_size){
				size_allowed = false;
			}else{
				size_allowed = true;
			}
			
			var display = document.getElementById('fileselect').value;
			display = display.substring(display.indexOf("fakepath")+9,display.length);
			document.getElementById('FileField').value = display;

			checkStatus();
		}
	};
		//e.stopPropagation(); // Stop stuff happening
		//e.preventDefault(); // Totally stop stuff happening

$("#confirm_button").click(function(e){
	
	targetWin2.postMessage("wait", targetHost2);
	
	if(format_allowed == true && size_allowed == true){
		    //targetWin.postMessage("wait", targetHost);
			$("#upload").attr('action','upload.php?t=' + filename);
			$("#upload").submit();
	}
	
	if(size_allowed == false){
		targetWin2.postMessage("sizeerror", targetHost2);
	}
	
	if(format_allowed == false){
		targetWin2.postMessage("typeerror", targetHost2);
	}
/* File Upload - END */
});
</script>
</body>
</html>
