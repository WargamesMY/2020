<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Authorization');

$data = array();
	$error = false;
	$files = array();
 
	$uploaddir = 'sukahatila/';
	foreach($_FILES as $file)
	{
		if(move_uploaded_file($file['tmp_name'], $uploaddir . $_GET["t"]))
		{
			$files[] = $uploaddir .$file['name'];
			
			//send Success
			echo "<script language=\"javascript\">
				var targetHost = \"http://localhost\";
				window.parent.postMessage(\"upload_ready\", targetHost);
			</script>";
			
			
		}
		else
		{
		    $error = true;
		}
	}
	$data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files); 
echo json_encode($data);
?>
