<?php

/**
 * @author Owden Godson <swillae1@gmail.com>
 *
 *  desc:: PUT ALL FUNCTIONS WHICH YOU THINK ARE IMPORTANT
 */

/**
 *
 * @param class name $class_name load all database classes
 *
 */
function check_required_fields($required_array) {
    $field_errors = array();
    foreach ($required_array as $fieldname) {
        if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
            $field_errors[] = $fieldname;
        }
    }
    return $field_errors;
}

function check_max_field_lengths($field_length_array) {
    $field_errors = array();
    foreach ($field_length_array as $fieldname => $maxlength) {
        if (strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength) {
            $field_errors[] = $fieldname;
        }
    }
    return $field_errors;
}

function display_errors_for_login($errorf1, $field) {
    echo "<span class='formerrors'>";
    if (!empty($errorf1)) {
        foreach ($errorf1 as $error) {
            if ($error == $field) {
                echo '* Please select your ' . $field;
            }
        }
    }
    echo "</span>";
}

function display_errors_for_signup($errorf1, $errorf2, $field, $maxchar) {
    echo "<span class='formerrors'>";
    if (!empty($errorf1)) {
        foreach ($errorf1 as $error) {
            if ($error == $field) {
                echo '* Please enter your ' . $field;
            }
        }
    }
    if (!empty($errorf2)) {
        foreach ($errorf2 as $error) {
            if ($error == $field) {
                echo '* Your ' . $field . ' must have a max of ' . $maxchar . ' characters';
            }
        }
    }
    echo "</span>";
}

function redirect_to($location = NULL) {
    if ($location != NULL) {
        header("Location: {$location}");
        exit;
    }
}

function confirm_query($result_set) {
    if (!$result_set) {
        die("Database selection failed: " . mysql_error());
    }
}

function __autoload($class_name) {

    $class_name = strtolower($class_name);
    $path = RT . "persistance/database/tables/{$class_name}.php";
    if (file_exists($path)) {
        require_once ($path);
    } else {
        die("The class file {$class_name}.php could not be in database folder");
    }
}

/**
 *
 * @param css style name $css_name  
 * @example home.css you should write  css_media('home');
 * @deprecated  css file MUST BE in media/css folder
 *
 */
function css_media($css_name,$media='screen') {
    echo '<link href="media/css/' . $css_name . '.css" media="'.$media.'" rel="stylesheet" type="text/css"/>';
}

/**
 * 
 * @param type $css_ie_name
 */
function css_media_ei($css_ie_name) {
 echo   ' <!--[if IE]>
	<link href="media/css/' . $css_ie_name . '.css" rel="stylesheet" type="text/css"/>
<![endif]-->';
  

}

/**
 *
 * @param javascript $media_name
 * @example main.js write js_media('main');
 * @deprecated FILE MUST BE IN media/js folder
 */
function js_media($media_name) {
    echo '<script type="text/javascript" language="javascript" src="media/js/' . $media_name . '.js" ></script>';
}

/**
 * load jquery ui
 */
function jquery_ui() {
    echo '<link type="text/css" href="persistance/plugins/jquery-ui-1.8.22.custom/css/custom-theme/jquery-ui-1.8.22.custom.css" rel="stylesheet" />
	 <script type="text/javascript" src="persistance/plugins/jquery-ui-1.8.22.custom/js/jquery-ui-1.8.22.custom.min.js"></script>';
}

/**
 * 
 * @param Image name $image_name This is a name of image in media folder
 * @param integer $height  height of your image/icon
 * @param integer $width  width of your image/icon
 * @param string $title  title of your image
 * @param string $alt  alt name of your image
 * @return string image <img src="'.$path.'" height="'.$height.'" width="'.$width.'" title="'.$title.'" alt="'.$alt.'" />
 * @example image('icon/ajax-loader.gif') give me an image
 */
function image($image_name, $height = '', $width = '', $title = '', $alt = '') {

    $path = 'media/images/' . $image_name;
    if (file_exists($path)) {
        $image = '<img src="' . $path . '" height="' . $height . '" width="' . $width . '" title="' . $title . '" alt="' . $alt . '" />';
    } else {
        $image = 'Icon in media/images/' . $image_name . ' does not exist';
    }
    return $image;
}

function mysql_prep($value) {
    global $db;
    $magic_quotes_active = get_magic_quotes_gpc();
    $new_enough_php = function_exists("mysql_real_escape_string");
    if ($new_enough_php) {
        if ($magic_quotes_active) {
            $value = stripslashes($value);
        }
        $value = mysql_real_escape_string($value, $db->conn());
    } else {
        if (!$magic_quotes_active) {
            $value = addslashes($value);
        }
    }
    return $value;
}

function get_time_ago($timeposted) {
    $y = date('Y') - date('Y', strtotime($timeposted));
    $m = date('m') - date('m', strtotime($timeposted));
    $d = date('d') - date('d', strtotime($timeposted));
    $h = date('h') - date('h', strtotime($timeposted));
    $i = date('i') - date('i', strtotime($timeposted));
    $s = date('s') - date('s', strtotime($timeposted));
    if ($y > 1) {
        echo $y . ' years ago';
    } else if ($y > 0) {
        echo $y . ' year ago';
    } else if ($m > 1) {
        echo $m . ' months ago';
    } else if ($m > 0) {
        echo $m . ' month ago';
    } else if ($d > 1) {
        if ($d > 7) {
            echo '1 week ago';
        } else if ($d > 14) {
            echo '2 weeks ago';
        } else if ($d > 21) {
            echo '2 weeks ago';
        } else if ($d > 28) {
            echo '4 weeks ago';
        } else {
            echo $d . ' days ago';
        }
    } else if ($d > 0) {
        echo $d . ' day ago';
    } else if ($h > 1) {
        echo $h . ' hours ago';
    } else if ($h > 0) {
        echo $h . ' hour ago';
    } else if ($i > 1) {
        echo $i . ' minutes ago';
    } else if ($i > 0) {
        echo $i . ' minute ago';
    } else if ($s > 1) {
        echo $s . ' seconds ago';
    } else if ($s > 0) {
        echo $s . ' second ago';
    }
}

function include_file($path) {
    if (file_exists($path)) {
        include($path);
    } else {
        echo '' . $path . ' no file in this path';
    }
}

function sanitize_output($buffer) {
    $search = array(
        '/\>[^\S ]+/s', //strip whitespaces after tags, except space
        '/[^\S ]+\</s', //strip whitespaces before tags, except space
        '/(\s)+/s'  // shorten multiple whitespace sequences
    );
    $replace = array(
        '>',
        '<',
        '\\1'
    );
    $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
}

function return_age($id) {
    $user = user::find_by_id($id);
    $user = array_shift($user);

    $birthDate = $user->birthdate;
    //explode the date to get month, day and year 
    if ($birthDate != '') {
        $birthDate = explode("-", $birthDate);
        //get age from date or birthdate
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
    } else {
        $age = '';
    }
    echo $age;
}

function return_birthday($id) {
    $user = user::find_by_id($id);
    $user = array_shift($user);

    $birthDate = $user->birthdate;
    //explode the date to get month, day and year 
    if ($birthDate != '') {
        $birthDate = explode("-", $birthDate);
        $m = (int) $birthDate[0];
        $d = (int) $birthDate[1];
        $y = $birthDate[2];

        if ($m == 1) {
            $m = 'January';
        } elseif ($m == 2) {
            $m = 'February';
        } elseif ($m == 3) {
            $m = 'March';
        } elseif ($m == 4) {
            $m = 'April';
        } elseif ($m == 5) {
            $m = 'May';
        } elseif ($m == 6) {
            $m = 'June';
        } elseif ($m == 7) {
            $m = 'July';
        } elseif ($m == 8) {
            $m = 'August';
        } elseif ($m == 9) {
            $m = 'September';
        } elseif ($m == 10) {
            $m = 'October';
        } elseif ($m == 11) {
            $m = 'November';
        } elseif ($m == 12) {
            $m = 'December';
        }

        if ($user->full_bday == 'yes') {
            $bday = $m . ' ' . $d . ' ' . $y;
        } else {
            $bday = $m . ' ' . $d;
        }
    } else {
        $bday = '';
    }
    echo $bday;
}
/*
 * 
 * * error reporting 
 */
function error_record($message,$result,$json=FALSE){
    //    
//    
    return $message;
}
?>

