<?php
session_start();
//var_dump($_REQUEST);
if(!empty($_REQUEST["email"]) && !empty($_REQUEST["password"])){ 
    require_once('classes.php');
    $User=User::login($_REQUEST["email"],md5( $_REQUEST["password"]));


    if(!empty($User)){
        $_SESSION['user']=serialize($User);
        if($user->role=="admin"){
            header("location:frontend/admins/home.php");
        }elseif
                ($user->role=="subscriber"){
                    header("location:frontend/subscribers/home.php");
                }

        

    }else{ 
        header("location:index.php?msg=no_user");
    }

} else{
    header("location:index.php?msg=empty_field");
}

?>