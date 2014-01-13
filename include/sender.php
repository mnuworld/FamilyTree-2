<?php

/**
  Document   : send_email_processor
  Created on : 26-Jul-2012, 22:38:29
  @author     : Ephraim Swilla <swillae1@gmail.com>
 * @author Fred Haule <fredhaule@gmail.com>
 * 
  Description:
  Purpose of the file is to send sms to user mobile phone
 */
class Sender {

    var $host;
    var $port;
    /*
     * Username that  is to be used  for submission 
     */
    var $strUserName;
    /*
     * password  that  is to be used along with username 
     */
    var $strPassword;
    /*
     * Sender Id to be used for submitting the  message 
     */
    var $strSender;
    /*
     * Message content    that  is to be transmitted 
     */
    var $strMessage;
    /*
     * Mobile No is to be transmitted. 
     */
    var $strMobile;

    /*
     * What type of the message  that  is to be sent 
     * <ul> 
     * <li>0:means plain text</li> 
     * <li>1:means flash</li> 
     * <li>2:means Unicode (Message content        should be in Hex)</li> 
     * <li>6:means Unicode Flash (Message content         should be in Hex)</li> 
     * </ul> 
     */
    var $strMessageType;
    /*
     * Require DLR  or not 
     * <ul> 
     * <li>0:means DLR is  not  Required</li> 
     * <li>1:means DLR is  Required</li> 
     * </ul> 
     */
    var $strDlr;

    private function sms_unicode($message) {

        $hex1 = '';

        if (function_exists('iconv')) {
            $latin = @iconv('UTF-8', 'ISO-8859- 1', $message);
            if (strcmp($latin, $message)) {
                $arr = unpack('H*hex', @iconv('UTF-8', 'UCS- 
          2BE', $message));
                $hex1 = strtoupper($arr['hex ']);
            }
            if ($hex1 == '') {
                $hex2 = '';
                $hex = '';

                for ($i = 0; $i < strlen($message); $i++) {
                    $hex = dechex(ord($message[$i]));
                    $len = strlen($hex);
                    $add = 4 - $len;
                    if ($len < 4) {
                        for ($j = 0; $j < $add; $j++) {
                            $hex = "0" . $hex;
                        }
                    }
                    $hex2.=$hex;
                }
                return $hex2;
            } else {
                return $hex1;
            }
        } else {
            print 'iconv Function Not Exists !';
        }
    }

//Constructor.. 
    public function Sender($host, $port, $username, $password, $sender, $message, $mobile, $msgtype, $dlr) {
        $this->host = $host;
        $this->port = $port;
        $this->strUserName = $username;
        $this->strPassword = $password;
        $this->strSender = $sender;
        $this->strMessage = $message; //URL  Encode The Message.. 
        $this->strMobile = $mobile;
        $this->strMessageType = $msgtype;
        $this->strDlr = $dlr;
    }

    public function Submit() {
        if ($this->strMessageType == "2" ||
                $this->strMessageType == "6") {
//Call The Function Of String To HEX . 
            $this->strMessage = $this->sms_unicode(
                    $this->strMessage);

            try {
//Smpp http  Url to send  sms. 
                $live_url = "http://" . $this->host . ":" . $this->port . "/bulksms/bulksms?username=" . $this->strUserName . "&password=" . $this->strPassword . "&type=" . $this->strMessageType . "&dlr=" . $this->strDlr . "&destination=" . $this->strMobile . "&source=" . $this->strSender . "&message=" . $this->strMessage . "";
                $parse_url = file($live_url);

                $parse_url[0];
                //  echo    $parse_url[0];
            } catch (Exception $e) {

//echo 'Message:'  .$e->getMessage();
                $e->getMessage();
            }
        }
        else
            $this->strMessage = urlencode($this->strMessage);
        try {
//Smpp http  Url to send  sms. 
            $live_url = "http://" . $this->host . ":" . $this->port . "/bulksms/bulksms?username=" . $this->strUserName . "&password=" . $this->strPassword . "&type=" . $this->strMessageType . "&dlr=" . $this->strDlr . "&destination=" . $this->strMobile . "&source=" . $this->strSender . "&message=" . $this->strMessage . "";
            $parse_url = file($live_url);
            // echo $parse_url[0];
            // $parse_url[0];
        } catch (Exception $e) {
            // echo 'Message:' . $e->getMessage();
            // $e->getMessage();
        }
        return $parse_url[0];
    }

}

//send sms in easy way
//
//Please do not touch anything here, for any change please contact us via our emails
//
//------------------------------------------------------------------------------

class sms_sender {

    public $phone_number;
    public $message;

    /**
     * 
     * @param string/integer $phone_number of user
     */
    public function find_country() {

        $x = array(
            93 => " Afghanistan",
            355 => " Albania", 213 => " Algeria",
            1 => " American Samoa",
            376 => "Andorra ",
            244 => " Angola",
            1 => " Anguilla",
            1 => " Antigua and Barbuda",
            54 => " Argentine Republic",
            374 => " Armenia",
            297 => " Aruba",
            247 => " Ascension",
            61 => " Australia",
            672 => " Australian External Territories",
            43 => " Austria ", 994 => " Azerbaijani Republic", 1 => " Bahamas ", 973 => " Bahrain", 880 => " Bangladesh ", 1 => " Barbados ", 375 => " Belarus ", 32 => " Belgium ", 501 => " Belize", 229 => " Benin ", 1 => " Bermuda ", 975 => " Bhutan", 591 => " Bolivia", 387 => " Bosnia and Herzegovina ", 267 => " Botswana", 55 => " Brazil (Federative Republic of)", 1 => " British Virgin Islands", 673 => " Brunei Darussalam ", 359 => " Bulgaria (Republic of)", 226 => " Burkina Faso", 257 => " Burundi (Republic of)", 855 => " Cambodia (Kingdom of)", 237 => " Cameroon (Republic of)", 1 => " Canada", 238 => " Cape Verde (Republic of)", 1 => " Cayman Islands ", 236 => " Central African Republic ", 235 => " Chad (Republic of)", 56 => " Chile ", 86 => " China ( Republic of)", 57 => " Colombia (Republic of)", 269 => " Comoros (Union of the)", 242 => " Congo (Republic of the)", 682 => " Cook Islands", 506 => " Costa Rica", 225 => " Côte d \"Ivoire (Republic of)", 385 => " Croatia (Republic of)", 53 => " Cuba", 357 => " Cyprus (Republic of)", 420 => " Czech Republic ", 850 => " Democratic People\"s Republic of Korea ", 243 => " Democratic Republic of the Congo", 670 => " Democratic Republic of Timor-Leste", 45 => " Denmark", 246 => " Diego Garcia ", 253 => " Djibouti (Republic of) ", 1 => " Dominica (Commonwealth of)", 1 => " Dominican Republic", 593 => " Ecuador", 20 => " Egypt (Arab Republic of)", 503 => " El Salvador (Republic of)", 240 => " Equatorial Guinea (Republic of)", 291 => " Eritrea", 372 => " Estonia (Republic of)", 251 => " Ethiopia (Federal Democratic Republic of) ", 500 => " Falkland Islands (Malvinas) ", 298 => " Faroe Islands", 679 => " Fiji (Republic of)", 358 => " Finland ", 33 => " France", 262 => " French Departments and Territories in the Indian Ocean ", 594 => " French Guiana (French Department of)", 689 => " French Polynesia (Territoire français \"outre-mer)", 241 => " Gabonese Republic", 220 => " Gambia (Republic of the)", 995 => " Georgia", 49 => " Germany (Federal Republic of)", 233 => " Ghana", 350 => " Gibraltar", 881 => " Global Mobile Satellite System (GMSS) shared code", 30 => " Greece ", 299 => " Greenland (Denmark)", 1 => " Grenada", 388 => " Group of countries shared code", 590 => " Guadeloupe (French Department of)", 1 => " Guam ", 502 => " Guatemala (Republic of)", 224 => " Guinea (Republic of)", 245 => " Guinea-Bissau (Republic of)", 592 => " Guyana", 509 => " Haiti (Republic of)", 504 => " Honduras (Republic of)", 852 => " Hong Kong China", 36 => " Hungary (Republic of)", 354 => " Iceland", 91 => " India (Republic of)", 62 => " Indonesia (Republic of)", 870 => " Inmarsat SNAC ", 98 => " Iran (Islamic Republic of)", 964 => " Iraq (Republic of)", 353 => " Ireland", 972 => " Israel (State of)", 39 => " Italy", 1 => " Jamaica", 81 => " Japan", 962 => " Jordan (Hashemite Kingdom of)", 7 => " Kazakhstan (Republic of)", 254 => " Kenya (Republic of)", 686 => " Kiribati (Republic of)", 82 => " Korea (Republic of)", 965 => " Kuwait (State of)", 996 => " Kyrgyz Republic ", 856 => " Lao People\"s Democratic Republic", 371 => " Latvia (Republic of)", 961 => " Lebanon ", 266 => " Lesotho (Kingdom of)", 231 => " Liberia (Republic of)", 218 => " Libya (Socialist People\"s Libyan Arab Jamahiriya)", 423 => " Liechtenstein (Principality of)", 370 => " Lithuania (Republic of) ", 352 => " Luxembourg", 853 => " Macao China", 261 => " Madagascar (Republic of)", 265 => " Malawi", 60 => " Malaysia", 960 => " Maldives (Republic of)", 223 => " Mali (Republic of)", 356 => " Malta", 692 => " Marshall Islands (Republic of the)", 596 => " Martinique (French Department of)", 222 => " Mauritania (Islamic Republic of)", 230 => " Mauritius (Republic of)", 269 => " Mayotte", 52 => " Mexico", 691 => " Micronesia (Federated States of)", 373 => " Moldova (Republic of) ", 377 => " Monaco (Principality of)", 976 => " Mongolia ", 382 => " Montenegro (Republic of)", 1 => " Montserrat", 212 => " Morocco (Kingdom of)", 258 => " Mozambique (Republic of) ", 95 => " Myanmar (Union of)", 264 => " Namibia (Republic of)", 674 => " Nauru (Republic of)", 977 => " Nepal (Federal Democratic Republic of)", 31 => " Netherlands (Kingdom of the)", 599 => " Netherlands Antilles", 687 => " New Caledonia (Territoire français d\"outre-mer)", 64 => " New Zealand", 505 => " Nicaragua", 227 => "Niger (Republic of the)", 234 => " Nigeria (Federal Republic of)", 683 => " Niue ", 1 => " Northern Mariana Islands (Commonwealth of the)", 47 => " Norway", 968 => " Oman (Sultanate of)", 92 => " Pakistan (Islamic Republic of)", 680 => " Palau (Republic of)", 507 => " Panama (Republic of)", 675 => " Papua New Guinea", 595 => " Paraguay (Republic of)", 51 => "Peru", 63 => "Philippines (Republic of the)", 48 => " Poland (Republic of)", 351 => " Portugal", 1 => " Puerto Rico", 974 => " Qatar (State of)", 40 => " Romania ", 7 => " Russian Federation", 250 => " Rwanda (Republic of)", 290 => " Saint Helena", 1 => " Saint Kitts and Nevis", 1 => " Saint Lucia", 508 => " Saint Pierre and Miquelon (Collectivité territoriale de la République française)", 1 => " Saint Vincent and the Grenadines", 685 => " Samoa (Independent State of)", 378 => " San Marino (Republic of) ", 239 => " Sao Tome and Principe (Democratic Republic of)", 966 => " Saudi Arabia (Kingdom of)", 221 => " Senegal (Republic of)", 381 => " Serbia (Republic of)", 248 => " Seychelles (Republic of)", 232 => " Sierra Leone", 65 => " Singapore (Republic of)", 421 => " Slovak Republic", 386 => " Slovenia (Republic of)", 677 => " Solomon Islands", 252 => " Somali Democratic Republic", 27 => " South Africa (Republic of)", 34 => " Spain", 94 => " Sri Lanka (Democratic Socialist Republic of)", 249 => " Sudan (Republic of the)", 597 => " Suriname (Republic of)", 268 => " Swaziland (Kingdom of)", 46 => " Sweden", 41 => " Switzerland (Confederation of)", 963 => " Syrian Arab Republic", 886 => " Taiwan China", 992 => " Tajikistan (Republic of)", 255 => " Tanzania (United Republic of)", 66 => " Thailand", 389 => " The Former Yugoslav Republic of Macedonia", 228 => " Togolese Republic", 690 => " Tokelau", 676 => " Tonga (Kingdom of)", 1 => " Trinidad and Tobago", 290 => " Tristan da Cunha", 216 => " Tunisia", 90 => " Turkey", 993 => " Turkmenistan", 1 => " Turks and Caicos Islands", 688 => " Tuvalu", 256 => " Uganda (Republic of)", 380 => " Ukraine", 971 => " United Arab Emirates", 44 => " United Kingdom of Great Britain and Northern Ireland ", 1 => " United States of America", 1 => " United States Virgin Islands", 598 => " Uruguay (Eastern Republic of)", 998 => " Uzbekistan (Republic of)", 678 => " Vanuatu (Republic of)", 379 => " Vatican City State", 39 => " Vatican City State", 58 => " Venezuela (Bolivarian Republic of)", 84 => " Viet Nam (Socialist Republic of)", 681 => " Wallis and Futuna (Territoire français d\"outre-mer)", 967 => " Yemen (Republic of)", 260 => "Zambia (Republic of)", 263 => " Zimbabwe");

        foreach ($x as $key => $value) {
            if ($this->country_code() == $key) {
                return $value;
            }
        }
    }
   public function country_code() {

        $y = substr($this->phone_number, -9);
        $z = str_ireplace($y, '', $this->phone_number);
        $p = str_ireplace('+', '', $z);
        return $p;
    }
    public function country() {
        $country = $this->find_country();
        if (!empty($country)) {
            return $country;
        } else {
            return $country = 'Tanzania';
        }
    }

    public function set_phone_number($phone_number) {
        $y = substr($phone_number, -9);
        $country_code= $this->country_code() !=''? $this->country_code() : '255';
        $valid_number = $country_code.$y;
        $this->phone_number = $valid_number;
    }

    /**
     * 
     * @param string $message Message to be sent to user phone
     */
    public function set_message($message) {
        $this->message = $message;
    }

    /**
     * 
     * @return boolean true if sms sent
     * @throws Exception if not phone number and message are set
     */
    public function send() {

        if (empty($this->message) && empty($this->phone_number)) {
            throw new Exception('<h4 class="alert_error">You can not send sms without first set message and phone number</h4>');
        } else {

            $send = new Sender('121.241.242.114', '8080', 'nct-ifra', 'ifra221', 'UNNETT', $this->message, $this->phone_number, '5', '0');
            $result = $send->Submit();
            $result = substr($result, 0, 4);
            switch ($result) {
                case '1701':
                    return TRUE;
                    break;
                case '1703':
                    echo '<h4 class="alert_error">Invalid value</h4>';
                    return FALSE;
                    break;
                case '1704':
                    echo '<h4 class="alert_error">Invalid value type</h4>';
                    return FALSE;
                    break;
                case '1705':
                    echo '<h4 class="alert_error">Invalid message</h4>';
                    return FALSE;
                    break;
                case '1706':
                    echo '<h4 class="alert_error">Invalid destination</h4>';
                    return FALSE;
                    break;
                case '1707':
                    echo '<h4 class="alert_error">Invalid source</h4>';
                    return FALSE;
                    break;
                case '1709':
                    echo '<h4 class="alert_error">User validation failed</h4>';
                    return FALSE;
                    break;
                case '1710':
                    echo '<h4 class="alert_error">Enternal error</h4>';
                    return FALSE;
                    break;
                case '1025':
                    echo '<h4 class="alert_error">Insufficient credit, <a href="#" id="contact_us">click here</a> to recharge</h4';
                    return FALSE;
                    break;
                default :
                    return FALSE;
                    break;
            }
        }
    }

}

?>