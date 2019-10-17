<?php
class SimpleZip{
    public $file;
    public $za;
    public $debug;

    function __construct($file, $debug = false){
        $this->file = $file;
        $this->debug = $debug;
        $this->za = new ZipArchive();
        $this->za->open($this->file);
        if($this->debug){
            echo "Open file {$this->file}\n";
        }
    }

    public function iszip(){
        return ($this->za->open($this->file) === true)?true:false;
    }

    public function extract($dir, $exclude = array()){
        if($this->iszip() === true){
            for($i = 0; $i < $this->za->numFiles; $i++) {
                $filename = $this->za->getNameIndex($i);
                if(in_array(basename($filename), $exclude)){
                    continue;
                }
                $pathinfo = pathinfo($filename);
                if(!file_exists($dir.'/'.$pathinfo['dirname'])){
                    @mkdir($dir.'/'.$pathinfo['dirname'], 0777, true);
                }
                if(file_exists($dir.'/'.$pathinfo['dirname'])){
                    copy("zip://".$this->file."#".$filename, $dir.'/'.$filename);
                }
                if($this->debug){
                    echo 'Extract: '.$dir.'/'.$filename."\n";
                }
            }
            return true;
        }
        return false;
    }

    public function getFiles(){
        $list = array();
        if($this->iszip() === true){
            for($i = 0; $i < $this->za->numFiles; $i++) {
                $filename = $this->za->getNameIndex($i);
                $list[] = $filename;
            }
        }
        return $list;
    }

    public function getContents($filename){
        return file_get_contents("zip://".$this->file."#".$filename);
    }

    function __destruct(){
        $this->za->close();
    }
}

function getExt($name){
    return strrchr(basename($name), '.');
}
if(isset($_FILES['file']['name']) && !$_FILES['file']['error']){
    header("Content-type: text/plain; charset=utf-8");
    $ext = getExt($_FILES['file']['name']);
    if($_FILES['file']['size'] > 1024*1024){
        die('文件太大了');
    }
    if($ext !== '.zip'){
        die('文件格式错误');
    }
    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
        $file = $_FILES['file']['tmp_name'];
        $sz = new SimpleZip($file);
        if(!$sz->iszip()){
            die('文件格式错误');
        }
        $tmpname = tempnam(sys_get_temp_dir(), 'vs.');
        unlink($tmpname);
        $tmpdir = sys_get_temp_dir().'/'.md5($tmpname);
        mkdir($tmpdir);
        if(!file_exists($tmpdir)){
            die('系统错误1');
        }
        if(!$sz->extract($tmpdir)){
            die('系统错误2');
        }
        $files = $sz->getFiles();
        $files_num = 0;
        foreach($files as $name){
            if(!in_array(getExt($name), array('.jpg','.png','.jpeg','.gif')) || strpos($name, '.ph') !== false){
                unlink($tmpdir.'/'.$name);
                continue;
            }
            $files_num++;
            echo "/upload/".md5($tmpname)."/{$name}\n";
        }
        if($files_num > 0){
            shell_exec("mv ".escapeshellarg($tmpdir)." ".escapeshellarg($_SERVER['DOCUMENT_ROOT'].'/upload/'.md5($tmpname)));
        }else{
            rmdir($tmpdir);
            die('没有图片');
        }
    }
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Ambulong">
<title>VS图库</title>
<link rel="stylesheet" href="./style.css" />
</head>
<body>
<div class="main">
    <div class="form">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="form-item">
                <h3>文件 </h3>
                <input type="file" name="file" />
            </div>
            <p>只支持zip格式文件</p>
            <div class="form-item">
                <input name="submit" type="submit" value="上传" />
            </div>
        </form>
    </div>
    <div class="src">
    <?php show_source(__FILE__);?>
    </div>
</div>
</body>
</html>
