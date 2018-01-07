<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  include_once 'inc/init.php';
  usleep(300000);
  
  if (isset($_SESSION["user"])){
    $isposted = isset($_POST["oldpassword"]);
    if ($isposted) {
        User::ChangePasswordForm(true,$_POST["oldpassword"], $_POST["password"], $_POST["password2"] );    
    } else
    {
        User::ChangePasswordForm();   
    }
  }
?>