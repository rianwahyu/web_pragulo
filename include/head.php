<?php
include 'config/connection.php';
session_start();

if ($_SESSION['status'] != "login") {

  header("location:auth_login?pesan=belum_login");
}

$username    =  $_SESSION['username'];
$fullname    =  $_SESSION['fullname'];
$userID      =  $_SESSION['userID'];
$role        =  $_SESSION['role'];

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="src/assets/images/favicon.png">
  <title>Pragulo</title>
  <!-- Custom CSS -->
  <link href="src/assets/extra-libs/c3/c3.min.css" rel="stylesheet">
  <link href="src/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
  <link href="src/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
  <!-- Custom CSS -->
  <link href="src/dist/css/style.min.css" rel="stylesheet">
  <!-- <link href="src/asseets/libs/select2/select2.min.css" rel="stylesheet"> -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  

</head>