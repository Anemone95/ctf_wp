<?php

Route::set('index.php',function(){
  Index::createView('Index');
});

Route::set('index',function(){
  Index::createView('Index');
});

Route::set('about-us',function(){
  AboutUs::createView('AboutUs');
});

Route::set('contact-us',function(){
  ContactUs::createView('ContactUs');
});

Route::set('list',function(){
  ContactUs::createView('Lista');
});

Route::set('verify',function(){
  if(!isset($_GET['file']) && !isset($_GET['hash'])){
    Verify::createView('Verify');
  }else{
    Verify::verifyFile($_GET['file'],$_GET['hash']);
  }
});


Route::set('download',function(){
  if(isset($_REQUEST['file']) && isset($_REQUEST['hash'])){
    echo Download::downloadFile($_REQUEST['file'],$_REQUEST['hash']);
  }else{
    echo 'jdas';
  }
});

Route::set('verify/download',function(){
  Verify::downloadFile($_REQUEST['file'],$_REQUEST['hash']);
});


Route::set('custom',function(){
  $handler = fopen('php://input','r');
  $data = stream_get_contents($handler);
  if(strlen($data) > 1){
    Custom::Test($data);
  }else{
    Custom::createView('Custom');
  }
});

Route::set('admin',function(){
  if(!isset($_REQUEST['rss']) && !isset($_REQUES['order'])){
    Admin::createView('Admin');
  }else{
    if($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::1'){
      Admin::sort($_REQUEST['rss'],$_REQUEST['order']);
    }else{
     echo ";(";
    }
  }
});

Route::set('custom/sort',function(){
  Custom::sort($_REQUEST['rss'],$_REQUEST['order']);
});
Route::set('index',function(){
 Index::createView('Index');
});
 ?>
