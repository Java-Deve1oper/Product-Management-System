<?php

session_start();

if($_SESSION["login_user"]==$_REQUEST['uname']){
    header("location:login.php");
}else{
    header("location:login.php");
}
