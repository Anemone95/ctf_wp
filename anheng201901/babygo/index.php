<?php
@error_reporting(1);
include 'flag.php';
class baby
{
    protected $skyobj;
    public $aaa;
    public $bbb;
    function __construct()
    {
        $this->skyobj = new sec;
    }
    function __toString()
    {
        if (isset($this->skyobj))
            return $this->skyobj->read();
    }
}

class cool
{
    public $filename;
    public $nice; //baby object
    public $amzing;  //baby object serialized
    function read()
    {
        $this->nice = unserialize($this->amzing);
        echo $sth;
        $this->nice->aaa = $sth;
        if($this->nice->aaa === $this->nice->bbb)
        {
            $file = "./{$this->filename}";
            if (file_get_contents($file))
            {
                return file_get_contents($file);
            }
            else
            {
                return "you must be joking!";
            }
        }
    }
}

class sec
{
    function read()
    {
        return "it's so sec~~";
    }
}

if (isset($_GET['data']))
{
    $Input_data = unserialize($_GET['data']); //baby object
    echo $Input_data;
}
else
{
    highlight_file("./index.php");
}
?>
