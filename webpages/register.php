<?php
    session_start();
    include "../configuration/config.php";
    include "../classes/Customer.php";
    include "../classes/User.php";
    $firstName = "";
    $surname = "";
    $contactNumber = "";
    $emailAddress = "";
    $password = "";
    if(isset($_POST["submit"]))
    {
        $firstName = $_POST["fName"];
        $surname = $_POST["lName"];
        $contactNumber = $_POST["contactNumber"];
        $emailAddress = $_POST["email"];
        $password = $_POST["password"];
        if(empty($firstName) || empty($surname) || empty($contactNumber) || empty($emailAddress) || empty($password))
        {
            echo "<p>All fields are required</p>";
        }
        else if((strlen($password) < 8))
        {
            echo "<p>Password must be at least 8 characters</p>";
        }
        else if((!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)))
        {
            echo "<p>Email Address is not valid</p>";
        }
        else
        {
            if((class_exists("Customer")) && (class_exists("User")))
            {
                $customerObject = new Customer();
                $userObject = new User();
            }
            $hashedPassword = md5($password);
            $customerObject->setCustomerName($firstName);
            $customerObject->setCustomerSurname($surname);
            $customerObject->setContactNumber($contactNumber);
            $userObject->setUserName($emailAddress);
            $userObject->setPassword($hashedPassword);
            $userObject->setAccountType("Customer");
            $accType = $userObject->getAccountType();
            $userID;
            //SQL statements
            $sqlUserInsert = "insert into users (username, password,accountType) values ('$emailAddress','$hashedPassword','$accType')";
            $sqlUserSelect = "select userID from users where username = '$emailAddress'";
            mysqli_query($conn,$sqlUserInsert);
            $userIDResult = mysqli_query($conn,$sqlUserSelect);
            if (mysqli_num_rows($userIDResult) > 0)
            {
                $row = mysqli_fetch_assoc($userIDResult);
                $userID = $row['userID'];
            }
            else{
                echo "SQL error ".mysqli_errno($conn);
            }
            $sqlCustomer = "insert into customers (userID, customerName,customerSurname,customerTelephone) values ($userID,'$firstName','$surname','$contactNumber')";
            if((mysqli_query($conn,$sqlUserInsert)) && (mysqli_query($conn,$sqlCustomer)))
            {
                header("location: ../index.php");
            }
            else{
                echo "SQL error ".mysqli_error($conn);
            }
        }
    }
?>
<html>
    <head>
        <title>Shoe Store</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/slider.css">
        <link rel="stylesheet" type="text/css" href="../css/smoothMenu.css">

        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../js/ddsmoothmenu.js"></script>
        <script type="text/javascript">
            smoothMenu.init({
                mainmenuid: "topNav", //menu DIV id
                orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
                classname: 'smoothMenu', //class added to menu's outer DIV
                contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
            })
        </script>
    </head>
    <body>
        <div id="bodyWrapper">
            <div id="innerWrapper">
                <div id="header">
                    <div id="siteTitle"><h1><a href="../index.php">AXI's sneakers</a></h1></div>
                    <div id="headerRight">
                        <?php
                            if(isset($_Session["customerLogin"]))
                            {
                                echo "<p><a href='shoppingcart.php'>My Cart</a> | <a href='checkout.php'>Checkout</a> | Hi, $customerSession | <a href='webpages/logout.php'>Logout</a></p>";
                            }
                            else if(isset($_Session["adminLogin"]))
                            {
                                echo "<p><a href='shoppingcart.php'>My Cart</a> | <a href='checkout.php'>Checkout</a> | Hi, $adminSession | <a href='logout.php'>Logout</a></p>";
                            }
                            else if(!isset($_Session["customerLogin"]) && !isset($_Session["adminLogin"]))
                            {
                                echo "<p><a href='login.php'>Log in</a> | <a href='register.php'>Register</a></p>";
                            }
                        ?>
                    </div>
                    <div class="cleaner"></div>
                </div> <!-- END Header -->

                <div id="menuBar">
                    <div id="topNav" class="smoothMenu">
                        <ul>
                            <li><a href="../index.php" >Home</a></li>
                            <li><a href="products.php">Products</a></li>
                            <li><a href="checkout.php">Checkout</a></li>
                            <li><a href="customers/MyProfile.php">My Profile</a></li>
                            <li><a href="about.php">About</a></li>
                            <li><a href="contact.php">Contact Us</a></li>
                        </ul>
                        <br style="clear: left" />
                    </div> <!-- end of topNav-->
                    <!-- We could use this to search for products -->
                    <div id="search">
                        <form action="searchresults.php" method="post">
                            <input type="text" value=" " name="keyword" id="keyword" title="keyword"  class="txtSearch" />
                            <input type="submit" name="Search" value=" " alt="Search" id="searchbutton" title="Search" class="subBtn"  />
                        </form>
                    </div> <!-- END Search -->
                </div><!-- END menuBar -->

                <div id="main">
                    <div id="sidebar" class="floatLeft">
                        <div class="sidebarBox"><span class="bottom"></span>
                            <h3>Categories</h3>
                            <div class="content">
                                <ul class="sidebarList">
                                    <li class="first"><a href="#">My Profile</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Returns Policy</a></li>
                                    <li><a href="#">I</a></li>
                                    <li><a href="#">don't</a></li>
                                    <li><a href="#">Know</a></li>
                                    <li><a href="#">What</a></li>
                                    <li><a href="#">else</a></li>
                                    <li><a href="#">to</a></li>
                                    <li><a href="#">Put</a></li>
                                    <li><a href="#">Here</a></li>
                                    <li><a href="#">Please</a></li>
                                    <li><a href="#">Try</a></li>
                                    <li><a href="#">to</a></li>
                                    <li class="last"><a href="#">Add more</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> <!-- END sidebar -->
                    <div id="content" class="floatRight">
                        <form name="registerForm" action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
                            <p>Enter your Name: <input type="text" name="fName" value="<?php if (isset($_POST["fName"])) echo $_POST["fName"]; ?>"/></p>
                            <p>Enter your Surname: <input type="text" name="lName" value="<?php if (isset($_POST["lName"])) echo $_POST["lName"]; ?>"/></p>
                            <p>Enter your contact Number: <input type="text" name="contactNumber" value="<?php if (isset($_POST["contactNumber"])) echo $_POST["contactNumber"]; ?>"/></p>
                            <p>Enter your email address:<input type="text" name="email" value="<?php if (isset($_POST["email"])) echo $_POST["email"]; ?>"/></p>
                            <p>Enter your password:<input type="password" name="password" value="<?php if (isset($_POST["password"])) echo $_POST["password"]; ?>"/></p>
                            <p><input type="submit" name="submit" value="Submit"/></p>
                        </form>
                    </div> <!-- END content -->
                    <div class="cleaner"></div>
                </div> <!-- END main -->

                <div id="footer">
                    <p><a href="../index.php">Home</a> | <a href="about.php">About</a> | <a href="faqs.php">FAQs</a> | <a href="contact.php">Contact Us</a></p>
                    Copyright © 2016 <a href="#">Shoe Store</a>
                </div> <!-- END of footer -->
            </div> <!-- END innerWrapper -->
        </div> <!-- END bodyWrapper -->
    </body>
</html>