<?php

/**
 * file Project definition
 *
 *      
 *
 *
 *
 * DESC: This defines all important parameters used in a system
 */


/**
 * 
 * --define PROJECT TITLE  >>>>>SHOULD NOT EXCEED 1O CHARACTERS
 * 
 */


    //put your code here
    defined('TITLE') ? NULL : define('TITLE', 'FamilyTree');





 #----------DOCUMENT ROOT-----------------------#

/*
 * 
 * -this define where you put your project inside a pointed directory
 * -use "" if you put in root pointed eg. C:\xampp\htdocs\....(default)
 * 
 * for our case, we put in a folder called engineering thus it is in
 *     C:\xammp\htdocs\familyTree
 *   better do like what I did
 */
defined('ROOT_FOLDER') ? NULL : define('ROOT_FOLDER', 'FamilyTree');


#----------DATABASE CONSTANSTS---------------------#

/*
 *
 * --Use this part to define your database variables 
 */


/**
 * --define name of your server
 */
defined('SERVER') ? NULL : define('SERVER', 'localhost');




/**
 * --define database name
 */
defined('DB_NAME') ? NULL : define('DB_NAME', 'familytree_01');




/**
 * --define database username/server name
 */
defined('DB_USERNAME') ? NULL : define('DB_USERNAME', 'root');




/**
 * --define database password
 */
defined('DB_PASSWORD') ? NULL : define('DB_PASSWORD', 'nedwo45');



?>
