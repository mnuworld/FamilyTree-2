<body> 
    <?php
   // $_SESSION['login'] = TRUE;
  
    /**
     * @author Owden Godson<owdeng@gmail.com>
     */
    /* ----------we load this if user do not log in yet-------- */
    if (!isset($_SESSION['familytreelogin']) == TRUE) {
        //include ('modules/landing/banner/before_login.php');
    } else {
        /* ----------we load this if user log in ---------------- */
        //include ('modules/landing/banner/after_login.php');
    }
   
    ?>
    <a name="top" id="top"></a>
    <header class="ym-noprint">
        <div class="ym-wrapper">
            <div class="ym-wbox">
                <h1><strong>Shuma</strong><em>Family Tree</em></h1>
            </div>
        </div>
    </header>
        
        <?php if(isset($_SESSION['familytreelogin']) == TRUE){ ?>
        <nav id="nav">   
            <div class="ym-wrapper">
                <div class="ym-hlist">
            <ul>   
                <li> <a href="<?=HOME?>home_admin" target="_top">Home</a></li>
                <li> <a href='<?=HOME?>add_user' target="_top">Add User</a></li>
                <li> <a href="<?=HOME?>edit_tree" target="_top">Edit Tree</a></li>
                <li><a href="<?=HOME?>logout" target="_top">Logout</a></li>
                
            </ul>
                </div>
            </div>   
        </nav>  
            <div class="ym-wrapper ym-noprint">
            <div class="ym-wbox">
                <div class=" ym-grid">
                    <div class="ym-g38 ym-gr alignRight ym-noprint"><a class="decreaseFont ym-button">-</a><a class="resetFont ym-button">Reset zoom</a><a class="increaseFont ym-button">+</a>
                    </div>
                </div>
            </div>
        </div>
        <?php }
        $page = '';
        $page_not_exist = '<div id="page_not_found">Sorry, this page is not available<br/><small>Type url correctly</small></div>';
        if (isset($_GET['pg']) && $_GET['pg'] != '') {

            /* ----  we load page by using pg variables ---------------- */

            $page = urldecode($_GET['pg']);
//            if (preg_match('/-/', $page)) {
//                $pages = explode('-', $page);
//                if (in_array('files', $pages)) {
//
//                    $files_owner = preg_replace('/files/i', '', str_replace('-', '', $page));
//                    $page = 'files';
//                }
//            }
            
            //check if the name supplied is a name or username in a database
//            $body_user_page=  user_page::find_where("name='".$page."'");
//            if(!empty($body_user_page)){
//                $page='page';
//                $page_info_from_body=$body_user_page;
//            }else{
//            
//            $profile_info=  user::find_where("username='".$page."'");
//            if(!empty($body_user_page)){
//                $page='profile';
//                $page_info_from_body=$body_user_page;
//            }
//            }
            
            
            /* --------loading basic modules url by use this ---------------- */
            $url = 'modules/' . $page . '/' . $page . '.php';
            /* --------Exception page to be seen by user------------------ */
           
            $before_login = array('login','sec', 'forget_password', 'register', 'confirm_register', 'complete_register', 'fb_register', 'fb_complete','page');
           
            $general_pages = array('help', 'about', 'contact', 'privacy','developers','find_friends','create_page','terms','cv','page','awards','home_admin','add_user','edit_tree');
            
            if (in_array($page, $general_pages)) {

                //these are general pages loaded whether user log in or not

                $url_static = 'modules/static/' . $page . '/' . $page . '.php';
                if (file_exists($url_static)) {
                    include ($url_static);
                } else {
                    switch ($page) {
                        case 'add_user':
                            include_once 'modules/home/section/admin/add_user.php';
                            break;
                        
                        case 'edit_tree':
                            include_once 'modules/home/section/admin/edit_tree.php';
                            break;
                        
                        case 'home_admin':
                            include_once 'modules/home/home_admin.php';
                            break;
                    
                        case 'bugs':
                            include_once 'modules/general/bugs.php';
                            break;

                        default :
                            if (file_exists($url)) {
                                include($url);
                            } else {
                                echo $page_not_exist;
                            }
                            break;
                    }
                }
            } else if (!in_array($_GET['pg'], $before_login) && isset($_SESSION['id'])) {

                /* -----these modules pages are loaded when user is loged in--------------- */
                switch ($page) {

                    /* -----add your case page if you need to load.-------------------- */
                 
                    case 'logout':
                        include_once 'modules/login/logout.php';
                        break;

                    default :
                        if (file_exists($url)) {
                            include($url);
                        } else {
                            echo $page_not_exist;
                        }
                        break;
                }
                
            } else if (in_array($_GET['pg'], $before_login) && !isset($_SESSION['id'])) {

                /* -------we load this when user do not log in yet -------- */
                switch ($page) {

                    /* --add your pages in case below if you need to be loaded here-------- */
                    
                    case 'complete_register':
                        include_once 'modules/register/complete_register.php';
                        break;
                    case 'confirm_register':
                        include_once 'modules/register/confirm_register.php';
                        break;
                    case 'fb_register':
                        include_once 'modules/register/fb_register/facebook_register.php';
                        break;
                    case 'sec':
                        include_once 'modules/forget_password/reset_password.php';
                        break;
                    case 'fb_complete':
                        include_once 'modules/register/fb_register/fb_complete.php';
                        break;
                    default :
                        if (file_exists($url)) {
                            include($url);
                        } else {
                            echo $page_not_exist;
                        }
                        break;
                }
       
            } else {
                //default when page is not known
                header('location: index.php');
            }
        } else if (isset($_SESSION['familytreelogin']) == TRUE) {
            //home page when user just logs in, do depend on page variable
            include('modules/home/home_admin.php');
                 
        } else {
            // default when user not logged in
            include('modules/login/login.php');
        }
        ?>
         <div class="ym-wrapper">
             <div class="ym-wbox">       
                 <div class="alignRight ym-noprint">                     
                     <p><a class="ym-button" href="#top"><i class="icon-circle-arrow-up icon-white"></i> Top</a></p>
                 </div>
             </div>
         </div>
        <div style="clear: both;"></div>
        <footer>
            <div class="ym-wrapper">
		<div class="ym-wbox">
			<p class="alignCenter">Family Tree © <?= date('Y') ?>• All Rights Reserved</p>
			<p class="alignCenter"><a href="<?=HOME?>about">About Us</a> • <a href="<?=HOME?>contact">Contact Us</a> • <a href="<?=HOME?>developers">Developers</a> • <a href="<?=HOME?>privacy">Privacy</a> • <a href="<?=HOME?>terms">Terms of Use</a> • <a href="<?=HOME?>help">Help</a></p>
		</div>
	</div>
        </footer>
    <div id="jquery_dialog_window"></div>
</body>