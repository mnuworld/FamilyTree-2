<?php    
/**
 * @copyright      (c) 2013, IT
 * 
 *  user 
 *  @access        public 
 *  @author        Owden Godson <owdeng@gmail.com>
 *  
 */

class  user  extends db{



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
    *@var first_name
    */
    public $first_name;

    /**
     * @param type $first_name 
    */
    public function set_first_name($first_name){

      $this->first_name=$first_name;
    } 


    /**
    *@var last_name
    */
    public $last_name;

    /**
     * @param type $last_name 
    */
    public function set_last_name($last_name){

      $this->last_name=$last_name;
    } 


    /**
    *@var email
    */
    public $email;

    /**
     * @param type $email 
    */
    public function set_email($email){

      $this->email=$email;
    } 


    /**
    *@var password
    */
    public $password;

    /**
     * @param type $password 
    */
    public function set_password($password){

      $this->password=$password;
    } 


    /**
    *@var date_of_birth
    */
    public $date_of_birth;

    /**
     * @param type $date_of_birth 
    */
    public function set_date_of_birth($date_of_birth){

      $this->date_of_birth=$date_of_birth;
    } 


    /**
    *@var gender
    */
    public $gender;

    /**
     * @param type $gender 
    */
    public function set_gender($gender){

      $this->gender=$gender;
    } 


    /**
    *@var marital_status
    */
    public $marital_status;

    /**
     * @param type $marital_status 
    */
    public function set_marital_status($marital_status){

      $this->marital_status=$marital_status;
    } 


    /**
    *@var activation
    */
    public $activation;

    /**
     * @param type $activation 
    */
    public function set_activation($activation){

      $this->activation=$activation;
    } 


    /**
    *@var type
    */
    public $type;

    /**
     * @param type $type 
    */
    public function set_type($type){

      $this->type=$type;
    } 


    /**
    *@var parent_id
    */
    public $parent_id;

    /**
     * @param type $parent_id 
    */
    public function set_parent_id($parent_id){

      $this->parent_id=$parent_id;
    } 

   /**
     * @access  by database to instatiate fields but you can use it
     * @return array of fields present in database table
     */     
    public function fields(){

      return $data=array('id','first_name','last_name','email','password','date_of_birth','gender','marital_status','activation','type','parent_id',);
    }


 public function user_pic($width=40,$height=40,$title=""){ 
        if(empty($this->profile_pic)){
            $this->profile_pic='profile.jpg';
            $id=0;
            $link=$id."/".$this->profile_pic;
        } else{
            $link=$this->id."/".$this->profile_pic;
        } 
        return "<img src=\"".HOME."media/members/".$link."\" width=\"$width\" height=\"$height\" title=\"$title\">";
    }
    }
?>