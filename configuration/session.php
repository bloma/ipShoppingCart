<?php
    session_start();
    include "config.php";

    $checkAccount = $_SESSION["loggedIn"];

    $sessionSQL = mysqli_query($conn,"select UserID, AccountType from users where UserName = '$checkAccount'");
    $row = mysqli_fetch_array($sessionSQL,MYSQLI_ASSOC);
    $accType = $row["AccountType"];
    $userID = $row["UserID"];
    $name = "";
    $surname = "";
    if($accType == "Customer")
    {
        $customerSQL = mysqli_query($conn,"Select CustomerName,CustomerSurname from customers WHERE UserID = '$userID'");
        $rowCustomers = mysqli_fetch_array($customerSQL,MYSQLI_ASSOC);
        $name = $rowCustomers["CustomerName"];
        $surname = $rowCustomers["CustomerSurname"];
    }
    else if($accType == "Admin")
    {
        $name = "Admin";
    }
?>