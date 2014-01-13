
<?php

class login {

    public $email;
    public $password;
    public $error;
    public $phone_number;

    public function __construct() {
        if (isset($_POST['email'])) {
            $this->email = $_POST['email'];
            $this->password = $_POST['password'];
        }
    }

    public function error($error) {
        $this->error = $error;
        $id = $_POST['posted_id'];
        if (empty($id)) {
            $id = 0;
        } else {
            $id = $id++;
        }
        $id++;
        redirect_to("index.php?er=$id");
    }

    public static function getError() {
        return $this->error;
        exit();
    }

    private function autheticate() {
        global $db;
        if (strlen($this->password) == 40) {
            //this password is derived from clone login
            $password = $this->password;
        } else {
            $password = sha1($this->password);
            $this->check_empty();
        }

        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            //here we log in by email
            $user_info = user::find_where("email='{$this->email}' AND password='{$password}'");
           
        } else{
            
            $y = substr($this->email, -9);
            $z = str_ireplace($y, '',$this->email);
            $p = str_ireplace('+', '', $z); //this is the country code we get
            $country_code = $p != '' || 0 ? $p : '255';
            $valid_number = $country_code . $y;
            $this->phone_number = $valid_number;
            //here we log in by phone number
            $user_info = user::find_where("phone_number='{$this->phone_number}' AND password='{$password}'");
        }

        return array_shift($user_info);
    }

    private function check_empty() {
        if (empty($this->email) || empty($this->password)) {
            redirect_to("index.php?err=empty");
        }
    }

    public function log_user_in() {
        $user = $this->autheticate();
        if (!empty($user)) {
            if ($user->activation == 1){
            $this->set_session_cookie();
            redirect_to(HOME);
            
            }else{
            redirect_to("index.php?error=act");   
            }
        } else {
            $error = 'Error occur';
            $this->error($error);
        }
    }

    public function clone_log() {
        $user = $this->autheticate();
        if (!empty($user)) {
            $this->set_session_cookie();
            $this->update_date();
        } else {
            $error = 'Error occur';
            $this->error($error);
        }
    }

    private function set_session_cookie() {

        $user = $this->autheticate();
        $id = $user->id;
        $userpass = $user->password;
        $_SESSION['familytreelogin'] = TRUE;
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $user->username;
        //$_SESSION['idx'] = base64_encode("g4p3h9xfn8sq03hs2234$id"); use of token when nessessary
        if (isset($_POST['remember']) && $_POST['remember'] == "yes") {
            setcookie("familytreeidCookie", $id, time() + 60 * 60 * 24 * 100, "/"); // Cookie set to expire in about 30 days
            setcookie("familytreepassCookie", $userpass, time() + 60 * 60 * 24 * 100, "/"); // Cookie set to expire in about 30 days
        }
    }

    private function update_date() {
        global $db;
        $user = $this->autheticate();
        $id = $user->id;
        $db->query(" UPDATE user SET last_login=now() WHERE id=$id ");
        $frei = frei_session::find_where("session_id='" . $_SESSION['id'] . "'");
        if (empty($frei)) {
            $data = array(
                'username' => $user->username,
                'time' => time(),
                'session_id' => $_SESSION['id'],
                'permanent_id' => $_SESSION['id'] + 120,
                'status' => 1,
                'status_mesg' => 'Available'
            );
            $db->insert('frei_session', $data);
        }
    }

    public function log_by_phone_number() {

        global $db;
        if (strlen($this->password) == 40) {
            //this password is derived from clone login
            $password = $this->password;
        } else {
            $password = sha1($this->password);
            $this->check_empty();
        }

        $user_info = user::find_where("email='{$this->email}' AND password='{$password}'");

        return array_shift($user_info);
    }

}

if (isset($_POST['submit']) == 'login') {
    $login = new login();
    $login->log_user_in();
}
?>
