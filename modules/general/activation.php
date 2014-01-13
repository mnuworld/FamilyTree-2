<?php

/**
 * @author Owden Godson <owdeng@gmail.com>
 * 
 * @uses user activation after registration
 */
if (isset($_GET['id']) && $_GET['id'] != "") {

    $id = $_GET['id'];
    $hashpass = $_GET['seq'];

    $user_info = user::find_by_id($id);
    if (!empty($user_info)) {
        $a_user = array_shift($user_info);
        if ($a_user->password === $hashpass) {
            $db->update('user', array('activation' => 1), "id='" . $id . "'");

            //---------double check to see if the user is active at the moment----------------
            $active_user = user::find_where("id='" . $id . "' AND activation='1' ");
            if (!empty($active_user)) {
                //--------user is activated successfully so send him to root-------
                redirect_to('index.php');
                exit();
            } else {
                redirect_to('?pg=general&er=a&t=1');
                exit();
            }
        }
    }
} else {
    redirect_to('?pg=general&er=a&t=2');
    exit();
}
?>