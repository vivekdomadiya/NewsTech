<?php include "../includes/db.php" ?>
<?php include "../includes/functions.php" ?>
<?php ob_start(); ?>
<?php session_start(); ?>

<?php

if(!isLoginRole("admin")) {
    redirect("/PageNotFound");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="/vender/plugins/bootstrap/css/bootstrap.min.css">

    <!-- font-awesome CSS -->
    <link rel="stylesheet" href="/vender/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/vender/plugins/font-awesome/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="/admin/vender/css/style.css">

</head>

<body>