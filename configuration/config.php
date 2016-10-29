<?php
    define("DBSERVER","localhost:3306");
    define("DBUSERNMAE","");
    define("DBPASSWORD","");
    define("DATABASE","test");
   $conn = mysqli_connect(DBSERVER,DATABASE) or die("Could not connect to the Database". " ".DATABASE);
?>