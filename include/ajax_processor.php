<?php

/**
 * file Ajaxprocessor
 *
 *  INNOVATION NETWORK ANS SOFTWARE COMPANY LIMITED
 *
 *DESC:  Process all Ajax requests
 */
print_r ($_GET);
exit();
if(isset($_GET['pg'])){
	
     $page = preg_replace('/#/','', $_GET['pg']);

 /*------ section inside a folder in modules will be calles here-----------*/
 
 if (isset($_GET['section'])) {
	 
    $file = $_GET['section'];
    $filename = 'modules/' . $page . '/section/' . $file . '.php';

    if (file_exists($filename)) {
        include $filename;
    } else {

        echo 'Ajax found no file name ' . $file . '.php in section of folder ' . $page;
    }
	
} else if(isset($_GET['part'])){

    $part = $_GET['part'];
    $filename = 'modules/' . $page . '/part/' . $part . '.php';
    if (file_exists($filename)) {
        include $filename;
    } else {

        echo 'Ajax found no file ' . $part . '.php in part of folder ' . $page;
    }
}elseif(isset($_GET['process'])){
	
    $process = $_GET['process'];
    $filename = 'modules/' . $page . '/process/' . $process . '.php';
    if (file_exists($filename)) {
        include $filename;
    } else {

        echo 'Ajax found no file ' . $process . '.php in proces of folder ' . $page;
    }
 }elseif(isset ($_GET['file'])){
     
     $file=$_GET['file'];
     $filename='modules/'.$page.'/'.$file.'.php';
     if (file_exists($filename)) {
        include $filename;
    } else {
        echo 'Ajax found no file ' . $file . '.php in  ' . $page;
    }
         
 }  else {
     
     /**
      * here we will call all pages which are not in normal modules folders
      */
  
      switch ($page){
          case 'general':
              $g_path=$_GET['g_path'];
              $file_path='modules/general/'.$g_path.'.php';
             if(file_exists($file_path)){
                 include $file_path;
             }  else {
               echo 'File doesn\'t exist in general module';    
             }
      }    
 }
}else{
	
 echo '
      WRONG PARAMETER PASSED.........
	    
       To use AJAX just use this format
 
       $.get(url,{pg:"module_folder_name", folder_type: "either_part/section/process",other_parameter:"may_be_ids/action etc"},function(data){
		        get your data here.......
		   });
     ';	
	
}
exit();
?>
