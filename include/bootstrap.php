<?php

/**

 * * @author Owden Godson <owdeng@gmail.com>
 * 
 */
require_once 'define.php';

define('RT', $_SERVER['DOCUMENT_ROOT'] . '/' . ROOT_FOLDER . '/');

require(RT . 'include/connection.php');
require(RT . 'include/function.php');
require(RT . 'include/time_format.php');
//require(RT . 'include/checkuserlog.php');   
require(RT . 'include/user_agent.php');
require(RT . 'include/email.php');
require (RT . 'include/sender.php');


$HOME = 'http://' . $_SERVER['HTTP_HOST'] . '/FamilyTree/';

$AJAX = $HOME . "index.php?isajax=true&";

defined('HOME') ? NULL : define('HOME', $HOME . '?pg=');

if (isset($_SESSION['id'])) {

    $session_user = user::find_by_id($_SESSION['id']);
    $ses_user = array_shift($session_user);
}
/**
 * ajax loader
 */
$LOADER = '<div style="margin:5px auto;width:30px;"><img src="' . $HOME . 'media/images/ajax-loader.gif" ></div>';

if (isset($_GET['e']) && $_GET['e'] != '') {
    include_once (RT . 'include/email_receiver.php');
}

if (isset($_GET['isajax'])) {
   

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        include (RT . 'include/ajax_post.php');
        exit();
    }

    if ((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
        /*
         * Ajax processing is done in here
         * @Note: We don't need head or body contents in here.
         */
        
        include_once(RT . 'include/ajax_processor.php');
        exit();
    }
}
?>