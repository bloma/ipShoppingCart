<?php
    session_start();
    include "config.php";
    $checkUser = $_SESSION["loggedIn"];
    $sessionSql = mysqli_query($conn,"Select UserID from users where UserName = '$checkUser'");

    $row = mysqli_fetch_array($sessionSql,MYSQLI_ASSOC);
    $id = $row["UserID"];
    if($id == 1)
    {
        $_SESSION["adminLogin"] = "admin";
        header("Location: ../index.php");
    }
    else{
        $sql = mysqli_query($conn,"Select customerName,customerSurname from customers WHERE UserID = '$id'");
        $row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
        $username = $row["customerName"];
        $userSurname = $row["customerSurname"];
        $count =  mysqli_num_rows($result);
    }