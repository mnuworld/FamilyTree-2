<?php    
/**
 * @copyright      (c) 2013, IT
 * 
 *  user_page 
 *  @access        public 
 *  @author        Owden Godson <owdeng@gmail.com>
 *  
 */

class  user_page  extends db{



    /**
    *@var id
    */
    public $id;

    /**
     * @param type $id 
    */
    public function set_id($id){

      $this->id=$id;
    } 


    /**
    *@var name
    */
    public $name;

    /**
     * @param type $name 
    */
    public function set_name($name){

      $this->name=$name;
    } 

   /**
     * @access  by database to instatiate fields but you can use it
     * @return array of fields present in database table
     */     
    public function fields(){

      return $data=array('id','name',);
    }


} 
?>