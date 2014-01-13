<?php
/**
 * @author Ephraim Swilla <swillae1@gmail.com>
 * 
 * Desc: Since much ajax are not used with post, in post we use for image upload only
 *       By the time being it may be used in other post request if wished
 */




if(isset($_POST['pg'])){
	
     $page = $_POST['pg'];

 /*------ section inside a folder in modules will be calles here-----------*/
 
 if (isset($_POST['section'])) {
	 
    $file = $_POST['section'];
    $filename = 'modules/' . $page . '/section/' . $file . '.php';

    if (file_exists($filename)) {
        include $filename;
    } else {

        echo 'Ajax found no file name ' . $file . '.php in section of folder ' . $page;
    }
	
} else if(isset($_POST['part'])){

    $part = $_POST['part'];
    $filename = 'modules/' . $page . '/part/' . $part . '.php';
    if (file_exists($filename)) {
        include $filename;
    } else {

        echo 'Ajax found no file ' . $part . '.php in part of folder ' . $page;
    }
}elseif(isset($_POST['process'])){
	
    $process = $_POST['process'];
    $filename = 'modules/' . $page . '/process/' . $process . '.php';
    if (file_exists($filename)) {
        include $filename;
    } else {

        echo 'Ajax found no file ' . $process . '.php in proces of folder ' . $page;
    }
 }elseif(isset ($_POST['file'])){
     
     $file=$_POST['file'];
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
              $g_path=$_POST['g_path'];
              $file_path='modules/general/'.$g_path.'.php';
             if(file_exists($file_path)){
                 include $file_path;
             }  else {
               echo 'File dont exist in general module';    
             }
      }    
 }
 exit();
}

require_once  'modules/general/uploader/uploader.php';

?>
