<?php
    include "../configuration/customerSession.php";
    include "../configuration/adminSession.php";
    session_start();

    if(session_destroy())
    {
        header("location: ../index.php");
    }
?>