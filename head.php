<?php
/* ----this is default title, it will be changed----- */

if (isset($_POST['submit']) == 'login') {
    include 'modules/login/process/process_login.php';
}
if (isset($_GET['pg']) && $_GET['pg'] == 'logout') {
    include 'modules/logout/logout.php';
}
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta charset="utf-8"/>
    <link href="media/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <?php
    /* --------all css media and js is better to load here------- */
     css_media('css');
 js_media('jquery-1.7.2.min');
    js_media('jquery-1.8.0.min');
    js_media('jquery.form');
    js_media('jquery_alert');
    js_media('zoom');
    //----------------------------JavaScript variables------------------------------
    echo '<script type="text/javascript"> var url="' . $AJAX . '"; var home="' . HOME . '";  </script>';
    //-----------------------------------loader------------------------------------ 
    echo "<script type=\"text/javascript\"> var LOADER='" . $LOADER . "'; </script>";
    //-----this is general css and js used in a page------------------------------
   
    jquery_ui();
    $TITLE="Family Tree";
    ?>
    <title><?= $TITLE ?></title>   
</head>
