<?php
abstract class User{
    public $id;
    public $name;
    public $email; 
    public $phone;
    protected $password;
    public $created_at;
    public $updated_at;


    function _constructor($id,$name,$email,$password,$phone,$created_at,$updated_at){
        $this->id=$id;
        $this->name=$name;
        $this->email=$email;
        $this->password=$password;
        $this->phone=$phone;
        $this->created_at=$created_at;
        $this->updated_at=$updated_at;

    }

    public static function login($email,$password){
        $user=null;
        $qry="SELECT * FROM USERS WHERE email='$email' AND password='$password'";
        require_once("config.php");
        $cn=mysqli_connect(DB_HOST,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
        $rslt=mysqli_query($cn,$qry);
        if($arr=mysqli_fetch_assoc($rslt)){
            switch($arr["role"]){
                case'subscriber':
                    $user=new subscriber($arr["id"],$arr["name"],$arr["email"],$arr["password"],$arr["phone"],$arr["created_at"],$arr["updated_at"]);
                
                    break;
                    case'admin':
                        $user=new admin($arr["id"],$arr["name"],$arr["email"],$arr["password"],$arr["phone"],$arr["created_at"],$arr["updated_at"]);
                        
                        break;
            }
        }
        mysqli_close($cn);
        return $user;




















        
    }

}




class Subscriber extends User{
    
    public $role="subscriber";
    
    public static function register($name,$email,$password,$phone){
        $sqr ="INSERT INTO USERS(name,email,password,phone) 
        VALUES('$name','$email','$password','$phone')";
        require_once('config.php');
        $cn=mysqli_connect(DB_HOST,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
        $rslt=mysqli_query($cn,$qry);
        mysqli_close($cn);
        return $rslt;
    }


}




class Admin extends User{

        public $role="admin";

  
}
?>