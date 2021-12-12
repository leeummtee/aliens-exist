<html>
<body>
<form action='' method='POST' enctype='multipart/form-data'>
<input type='file' name='userFile'><br>
<input type='submit' name='upload_btn' value='upload'>
</form>
</body>
<?php
$info = pathinfo($_FILES['userFile']['name']);
$ext = $info['extension']; // get the extension of the file
$newname = "newname.".$ext;

$target = 'profileimg/'.$newname;
move_uploaded_file( $_FILES['userFile']['tmp_name'], $target);
?>
