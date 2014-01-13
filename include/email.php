<?php

/**
 * Description of email
 *
 * @author Ephraim Swilla <swillae1@gmail.com>
 */
class email {

    private $to_email;
    private $subject;
    private $message;
    private $to_name;
    private $path;
    private $user;
    private $from_user;

    /**
     * 
     * @param Email $email Email address, separate by comma if more than one email
     */
    public function set_to_user_id($user_id) {
        global $db;
        $user_info = user::find_by_id($user_id);
        $this->user = array_shift($user_info);
        $this->to_email = $this->user->email;
        $this->to_name = $this->user->username;
    }

    /**
     * @deprecated Dont use this if you set set_to_user(), its alternative to this
     * @param email $email
     * @return type
     */
    public function set_email($email, $registered = TRUE) {
        if ($registered == TRUE) {
            $user_info = user::find_where('email="' . $email . '"');
            $this->user = array_shift($user_info);
            $this->to_name = $user->username;
            $this->to_email = $user->email;
        } else {
            $this->to_email = $email;
            $this->to_name = '';
        }
    }

    public function set_file_path($path) {
        $this->path = RT . $path;
    }

    /**
     * 
     * @param String $subject
     */
    public function set_subject($subject) {


        $this->subject = $subject;
    }

    public function set_from_id($from_id) {
        global $ses_user;
        if (empty($ses_user) || $from_id != '') {
            $user_info = user::find_by_id($from_id);
            $user = array_shift($user_info);
            $this->from_user = $user;
        } else {
            $this->from_user = $ses_user;
        }
    }

    /**
     * @uses Set default email body to user 
     * @param String $message Simple text message ,default html is inside it
     */
    public function set_message($message) {

        if (!empty($this->from_user)) {
            if (!empty($this->from_user->profile_pic)) {
                $profile_pic = '<img src="' . HOME . 'media/members/' . $this->from_user->id . "/" . $this->from_user->profile_pic . '" height="40" width="40"/>';
            } else {
                $profile_pic = '<img src="' . HOME . 'media/members/0/profile.jpg" height="40" width="40"/>';
            }
            $firstname = $this->from_user->firstname;
        } elseif (empty($this->from_user) && !empty($this->user)) {
            if (!empty($this->user->profile_pic)) {
                $profile_pic = '<img src="' . HOME . 'media/members/' . $this->user->id . "/" . $this->user->profile_pic . '" height="40" width="40"/>';
            } else {
                $profile_pic = '<img src="' . HOME . 'media/members/0/profile.jpg" height="40" width="40"/>';
            }
            $firstname = $this->user->firstname;
        } else {
            global $ses_user;
            global $business;
            $this->user=$ses_user;
            if (!empty($ses_user)) {
               $profile_pic=$ses_user->user_pic();
               $firstname=$ses_user->firstname;
            } elseif (!empty($business)) {
               $profile_pic=$business->logo;
               $firstname=$business->name;
            }
        }

        $body = '
            <table width="85%" align="center"  style=" background: whitesmoke; font-size: 12px;" >
            <thead><tr><th height="53" colspan="3" align="left"><h2 style="color:#267BB6;">Unnett</h2></th></tr> </thead>
    <tfoot>
        <tr>
            <th height="23" colspan="3" scope="row">&nbsp;</th>
        </tr>
    </tfoot>
    <tbody>
         <tr class="">
             <td width="70" height="103" align="center"  scope="row">
                       ' . $profile_pic . '<br/>
                       <small>' . $firstname . '</small></td>
                           
           <td width="462" align="left" valign="top" style="padding:1%; font-size:14px; background:#FFF;">
              
      Hi  <a href="' . HOME . 'profile">' . $this->user->firstname. '</a><br/><br/>
           ' . $message . '</td>
           <td width="65" align="center">&nbsp;</td>
        </tr>
   </tbody>
</table>';

        return $this->message = $body;
    }

    /**
     * @deprecated Dont use this is you set already set_message(); this is alternative to it
     * @param type $html
     * @return html body of email to be sent
     */
    public function set_html($html) {
        if (!empty($this->message)) {
            return $this->message = $html;
        }
    }

    /**
     * 
     * @global type $ses_user
     * @global type $business
     * @return type boolean
     * @throws Exception if you fail to set email, subject and message
     */
    public function send() {
        global $ses_user;
        global $business;
        if (isset($this->to_email) == '') {

            if (!empty($ses_user)) {
                $this->to_email = $ses_user->email;
            } elseif (!empty($business)) {
                $this->to_email = $business->email;
            }
        }

        if (!$this->to_email || !$this->message || !$this->subject) {
            throw new Exception('You can not send email without setting first message, subject and to email');
        } else {

            $headers = 'From: Unnett <unnett@unnett.com>' . "\r\n";
            //  $headers .= "Reply-To: {$from}\n";
            // $headers .= "Cc: {$to}\n";
            // $headers .= "Bcc: {$to}\n";
            $headers .= "X-Mailer: PHP/" . phpversion() . "\n";
            $headers .= "MIME-Version: 1.0\n";
            $headers .= "Content-Type: text/html; charset=iso-8859-1";

            $send = mail($this->to_email, $this->subject, $this->message, $headers);
            return $send;


//            require(RT . "persistance/plugins/phpmailer/class.phpmailer.php");
//            $mail = new PHPMailer();
//            $mail->IsSMTP(); // send via SMTP
//            $mail->SMTPAuth = true; // turn on SMTP authentication
//            $email = $this->to_email; // Recipients email ID
//            $name = $this->to_name;
//            $mail->FromName = "Unnett";
//            $mail->From = $_SERVER['HTTP_HOST'];
//            if (preg_match('/,/i', $email)) {
//                $array = explode(',', $email);
//                foreach ($array as $mail_to) {
//                    $mail->AddAddress($mail_to);
//                }
//            } else {
//                $mail->AddAddress($email, $name);
//            }
//            $mail->WordWrap = 50; // set word wrap
//            $mail->IsHTML(true); // send as HTML
//            if ($this->path !== '') {
//                $mail->AddAttachment($this->path);
//            }
//            $mail->Subject = $this->subject;
//            $mail->Body = $this->message; //HTML Body
//            //$mail->AltBody = "This is the body when user views in plain text format"; //Text Body
//            if (!$mail->Send()) {
//                echo "Mailer Error: " . $mail->ErrorInfo;
//                echo '<h4 class="alert_error">Email failed to be sent' . $mail->ErrorInfo . '.</h4>';
//                return FALSE;
//            } else {
//                echo '<br /><h4 class="alert_success">Message has been sent</h4>';
//                return TRUE;
//            }
        }
    }

}

?>
