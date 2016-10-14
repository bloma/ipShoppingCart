<?php
    define("DBSERVER","localhost:3306");
    define("DBUSERNMAE","root");
    define("DBPASSWORD","");
    define("DATABASE","test");
   $conn = mysqli_connect(DBSERVER,DBUSERNMAE,DBPASSWORD,DATABASE) or die("Could not connect to the Database". DATABASE);
?>