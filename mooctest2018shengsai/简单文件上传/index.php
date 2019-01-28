<html>
<body>
<form action="index.php" method="post" enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file" />
<input type="hidden" name="Upload" id="Upload" value = "Upload">
<br/>
<input type="submit" name="submit" value="Submit" />
</form>
</body>
</html>
<?php
if(isset($_POST[ 'Upload' ])){
    $html = "";
    $token = sha1($_SERVER['REMOTE_ADDR']);
    $target_path  = "uploads/".$token."/";
    if (!file_exists($target_path)){
        mkdir ($target_path,0755,true);
    }
    $uploaded_name = $_FILES[ 'file' ][ 'name' ];
    $uploaded_tpye = $_FILES[ 'file' ][ 'type' ];
    $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
    $uploaded_size = $_FILES[ 'file' ][ 'size' ];
    $uploaded_tmp  = $_FILES[ 'file' ][ 'tmp_name' ];
    $type = ".".substr(mime_content_type($uploaded_tmp),-3);
    $_FILES[ 'file' ][ 'name' ] = preg_replace("/\..../",$type,$uploaded_name,1);
    $target_path .= basename($_FILES[ 'file' ][ 'name' ]);
    if($uploaded_size>100000)
    {
        echo '<pre>Your file is too big.</pre>';
        exit;
    }
    if(getimagesize($uploaded_tmp))
    {

        if(!move_uploaded_file($uploaded_tmp,$target_path))
        {
            $html .= '<pre>Your image was not uploaded.</pre>';
        }
        else {
            $html .= "<pre>{$target_path} succesfully uploaded!</pre>";
        }
    }
    else {
        $html .= '<pre>It is not a image</pre>';
    }
    echo $html;
}
?>
