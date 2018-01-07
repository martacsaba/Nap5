<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  include_once 'inc/init.php';
  usleep(300000);
  
  if (isset($_SESSION["user"])){
    $isposted = isset($_POST["tkid"]);
    $tkid = 0;
    if (isset($_GET["tkid"])) $tkid = $_GET["tkid"];
    if ($isposted) {
        $tkid = $_POST["tkid"];
        TesztKerdes::TesztkerdesForm($isposted, $tkid, $_POST["kerdestxt"], 
                                     $_POST["tipus"], $_POST["kategoria"], $_POST["nehezseg"]);
    } else
    {
        TesztKerdes::TesztkerdesForm(false,$tkid);
        TesztKerdes::OsszsTesztkerdesForm();        
    }
  }
?>