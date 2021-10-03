<?php 
session_start();

if ($_SESSION['status'] != "login") {

}else{
    $username    =  $_SESSION['username'];
    $fullname    =  $_SESSION['fullname'];
    $userID      =  $_SESSION['userID'];
    $role        =  $_SESSION['role'];
}

