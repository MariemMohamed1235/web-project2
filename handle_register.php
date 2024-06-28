<?php
session_start();
$errors = [];
if(empty($_REQUEST["name"])) $errors ["name" ] = "Name Is Required";
if(empty($_REQUEST["email"])) $errors["email"]="email Is Required";
if(empty($_REQUEST ["pw"]) || empty($_REQUEST[ "pc"])){ 
 $errors["pw"] = "password And password confirmation Is Required";
}else if($_REQUEST ["pw"] != $_REQUEST["pe"]) { 
 $errors["pc"] = "password confirmation must be equal to password";
}


$name =htmlspecialchars(trim($_REQUEST[ "name"]));
$email =filter_var($_REQUEST["emai1"],FILTER_SANITIZE_EMAIL);
$password =htmlspecialchars($_REQUEST["pw"]);
$password_confirmation = htmlspecialchars($_REQUEST["pc"]);
$phone= htmlspecialchars($_REQUEST["phone"]);

if(!empty($_REQUEST["email"]) && !filter_var($_REQUEST["email"],FILTER_VALIDATE_EMAIL)) $_errors["email"]= "Email In Valid Format Please add aa@pp.cc";

if(empty($_errors)){
    require_once('classes.php');
    try{
        $rslt=Subscriber::register($name,$email,md5($password),$phone);
        header("location:index.php?msg=sr");
    }catch(\Throwable $th){
        header("location:register.php?msg=ar");
    }
     
}else{
    $_SESSION["errors"]=$errors;
    header("location:register.php");
}
