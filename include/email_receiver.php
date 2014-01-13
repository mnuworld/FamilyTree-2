<?php

/**
 * @author Ephraim  Swilla <swillae1@gmail.com>
 * 
 * @uses Switch receive all links from email sent and process them 
 */
if (!isset($_SESSION['id'])) {
    include_once 'modules/login/process_login.php';
    if (isset($_GET['id']) && $_GET['id'] != '') {
        $user_info = user::find_by_id($_GET['id']);
        $user = array_shift($user_info);
        $clone_login = new login();
        $clone_login->email = $user->email;
        $clone_login->password = $user->password;
        $clone_login->clone_log();
    }
}
//-----Add your case of customization here-----
switch ($_GET['e']) {
    case 'activate':
        include_once 'modules/general/activation.php';
        break;
    default :
        break;
}
exit();
?>
