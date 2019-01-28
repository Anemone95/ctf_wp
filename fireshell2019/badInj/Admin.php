<?php

class Admin extends Controller{
  public static function sort($url,$order){
    $uri = parse_url($url);
    $file = file_get_contents($url);
    $dom = new DOMDocument();
    $dom->loadXML($file,LIBXML_NOENT | LIBXML_DTDLOAD);
    $xml = simplexml_import_dom($dom);
    if($xml){
     //echo count($xml->channel->item);
     //var_dump($xml->channel->item->link);
     $data = [];
     for($i=0;$i<count($xml->channel->item);$i++){
       //echo $uri['scheme'].$uri['host'].$xml->channel->item[$i]->link."\n";
       $data[] = new Url($i,$uri['scheme'].'://'.$uri['host'].$xml->channel->item[$i]->link);
       //$data[$i] = $uri['scheme'].$uri['host'].$xml->channel->item[$i]->link;
     }
     //var_dump($data);
     usort($data, create_function('$a, $b', 'return strcmp($a->'.$order.',$b->'.$order.');'));
     echo '<div class="ui list">';
     foreach($data as $dt) {

       $html = '<div class="item">';
       $html .= ''.$dt->id.' - ';
       $html .= ' <a href="'.$dt->link.'">'.$dt->link.'</a>';
       $html .= '</div>';
     }
     $html .= "</div>";
     echo $html;
    }else{
     $html .= "Error, not found XML file!";
     $html .= "<code>";
     $html .= "<pre>";
     $html .= $file;
     $html .= "</pre>";
     $hmlt .= "</code>";
     echo $html;
    }
  }

}

 ?>
