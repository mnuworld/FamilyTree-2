<?php

/**
 * @author Owden Godson <swillae1@gmail.com>
 */
defined('SERVER') ? NULL : define('SERVER', 'localhost');      //---database server, default localhost
defined('DB_USERNAME') ? NULL : define('DB_USERNAME', 'root'); //---database username, default root
defined('DB_PASSWORD') ? NULL : define('DB_PASSWORD', 'nedwo45');     //---database password 
defined('DB_NAME') ? NULL : define('DB_NAME', 'familytree_01');       //---database name



mysql_connect(SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
mysql_select_db(DB_NAME) or die(mysql_error());

$query = mysql_query('SHOW TABLES');
$table = '';

while ($row = mysql_fetch_array($query)) {
    $table = $row['Tables_in_' . DB_NAME];

    $sql = mysql_query("SHOW COLUMNS IN `$table` ") or die(mysql_error());

    $class = '<?php    
/**
 * @copyright      (c) '.  date('Y').', IT
 * 
 *  ' . $table . ' 
 *  @access        public 
 *  @author        Owden Godson <owdeng@gmail.com>
 *  
 */

class  ' . $table . '  extends db{

';
    $field = '';
    while ($row1 = mysql_fetch_array($sql)) {
        $column = $row1['Field'];

        $field.='\'' . $column . '\',';

        $class.='

    /**
    *@var ' . $column . '
    */
    public $' . $column . ';

    /**
     * @param type $' . $column . ' 
    */
    public function set_' . $column . '($' . $column . '){

      $this->' . $column . '=$' . $column . ';
    } 
';
    }


    $class.='
   /**
     * @access  by database to instatiate fields but you can use it
     * @return array of fields present in database table
     */     
    public function fields(){

      return $data=array(' . $field . ');
    }


';
    if ($table == 'user') {
        $class.=' public function user_pic($width=40,$height=40,$title=""){ 
        if(empty($this->profile_pic)){
            $this->profile_pic=\'profile.jpg\';
            $id=0;
            $link=$id."/".$this->profile_pic;
        } else{
            $link=$this->id."/".$this->profile_pic;
        } 
        return "<img src=\"".HOME."media/members/".$link."\" width=\"$width\" height=\"$height\" title=\"$title\">";
    }
    }
?>';
    } else {
        $class.='} 
?>';
    }

    $file = $table . '.php';
    $handle = fopen($file, 'wb');
    fwrite($handle, $class);
}
?>
