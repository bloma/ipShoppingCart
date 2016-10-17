<?php
    include "../configuration/config.php";
    include_once "../classes/SqlFunctions.php";
    @include "../configuration/session.php";

    $passwordReset = false;
    $emailFormatError  = false;
    $noEmailError = false;
    $invalidLogin = false;

    if(class_exists("SqlFunctions"))
    {
        $sqlFunctions = new SqlFunctions();
    }
    if(isset($_POST["forgot"]))
    {
        $email = $_POST["username"];
        $emailFrom = "noreply@axi.co.za";

        if(empty($email))
        {
            $noEmailError = true;
        }
        else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $emailFormatError = true;
        }
        else
        {
            $newPassword = "";
            while (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[$@$!%*?&])[A-Za-z\\d$@$!%*?&]{8,}$/i",$newPassword))
            {
                $newPassword = $sqlFunctions->createTempPassword();
                if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[$@$!%*?&])[A-Za-z\\d$@$!%*?&]{8,}$/i",$newPassword))
                {
                    break;
                }
            }
            $hashed = md5($newPassword);
            $sqlFunctions->resetPassword($conn,$hashed,$email);
            mail($email,"Password reset","Hi\nYour password has been reset to ".$newPassword."\nWe suggest you login and change it immediately\nKind regards AXI Team","From: ".$emailFrom);
            $passwordReset = true;
        }

    }
    else if(isset($_POST['login']))
    {
        $myUsername = mysqli_real_escape_string($conn,$_POST["username"]);
        $myPassword = mysqli_real_escape_string($conn,$_POST["password"]);
        $hashedPassword = md5($myPassword);

        $sql = "select UserID from users where UserName = '$myUsername' and Password = '$hashedPassword'";
        $result = mysqli_query($conn,$sql);
        $count =  mysqli_num_rows($result);
        if($count == 1){
            $_SESSION["loggedIn"] = $myUsername;
            header("location: ../index.php");
        }
        else{
            $invalidLogin = true;
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
                            if(isset($_Session["loggedIn"]) && $accType == "Customer")
                            {
                                echo "<p>Hi, $name . ' '.$surname | <a href='shoppingcart.php'>My Cart</a> | <a href='checkout.php'>Checkout</a> | <a href='logout.php'>Logout</a></p>";
                            }
                            else if(isset($_Session["loggedIn"]) && $accType == "Admin")
                            {
                                echo "<p>Hi, $name| <a href='logout.php'>Logout</a></p>";
                            }
                            else
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
                            <?php
                                if(isset($_SESSION["loggedIn"]) && $accType == "Customer")
                                {
                                    echo "<li><a href='customers/MyProfile.php'>My profile</a></li>";
                                }
                            ?>                            <li><a href="about.php">About</a></li>
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
                                     <?php
                                                                                if(isset($_SESSION["loggedIn"]) & $accType == "Customer")
                                        {
                                            echo "<li class='first'><a href='customers/MyProfile.php'>My Profile</a></li>";
                                            echo "<li><a href='about.php'>About us</a></li>";
                                            echo "<li><a href='faqs.php'>FAQs</a></li>";
                                            echo "<li><a href='contact.php'>Contact US</a></li>";
                                            echo "<li><a href='exchangepolicy.php'>Exchange Policy</a></li>";
                                            echo "<li><a href='privacypolicy.php'>Privacy Policy</a></li>";
                                            echo "<li class='last'><a href='shippingpolicy.php'>Shipping Policy</a></li>";
                                        }
                                        else if(isset($_SESSION["loggedIn"]) && $accType == "Admin")
                                        {
                                            echo "<li class='first'><a href='admin/reports/brandreport.php'>View Brands</a></li>";
                                            echo "<li><a href='admin/reports/customerreport.php'>View Customers</a></li>";
                                            echo "<li><a href='admin/reports/deliveriesreport.php'>View Deliveries</a></li>";
                                            echo "<li><a href='admin/reports/departmentsreport.php'>View Departments</a></li>";
                                            echo "<li><a href='admin/reports/distriburtorreport.php'>View Distributors</a></li>";
                                            echo "<li><a href='admin/reports/orderhistory.php'>View Orders</a></li>";
                                            echo "<li><a href='admin/reports/staffreport.php'>View Staff</a></li>";
                                            echo "<li><a href='admin/reports/stockreport.php'>View Stock</a></li>";
                                            echo "<li><a href='admin/reports/suppliersreport.php'>View Suppliers</a></li>";
                                            echo "<li class='last'><a href='admin/reports/usersreport.php'>view Users</a></li>";
                                        }
                                        else if(!isset($_SESSION["loggedIn"]))
                                        {
                                            echo "<li class='first'><a href='about.php'>About us</a></li>";
                                            echo "<li><a href='faqs.php'>FAQs</a></li>";
                                            echo "<li><a href='contact.php'>Contact US</a></li>";
                                            echo "<li><a href='exchangepolicy.php'>Exchange Policy</a></li>";
                                            echo "<li><a href='privacypolicy.php'>Privacy Policy</a></li>";
                                            echo "<li class='last'><a href='shippingpolicy.php'>Shipping Policy</a></li>";
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div> <!-- END sidebar -->

                    <div id="content" class="floatRight">
                        <form action="" method = "post">
                            <div style="text-align: center;">
                                <p>Please enter your email address</p> <input type ="text" name="username"/>
                                <p>Please enter your Password</p><input type = "password" name ="password"/><br/>
                                <input type="submit" value = "login" name="login"/><br/>
                                <label>Forgot password? Click here: </label><input type="submit" value = "Forgot Password" name="forgot"/><br/>
                            </div>
                        </form>
                        <?php
                            if($passwordReset)
                            {
                                echo "<p>An email has been sent to $email containing your new temporary password</p>";
                            }
                            if($emailFormatError)
                            {
                                echo "<p id='errors'>Email address is invalid</p>";
                            }
                            else if($noEmailError)
                            {
                                echo "<p id='errors'>Email address is required</p>";
                            }
                            else if($invalidLogin)
                            {
                                echo "<p id='errors'>Username or password is incorrect</p>";
                            }
                        ?>
                    </div> <!-- END content -->
                    <div class="cleaner"></div>
                </div> <!-- END main -->

                <div id="footer">
                     <?php
                        echo"<p><a href='../index.php'>Home</a> | <a href='about.php'>About</a> | <a href='faqs.php'>FAQS</a> | <a href='contact.php'>Contact Us</a></p>";
                        echo "<p>Copyright © 2016 <a href='../index.php'>AXI's Sneakers</a></p>";
                    ?>
                </div> <!-- END of footer -->

            </div> <!-- END innerWrapper -->
        </div> <!-- END bodyWrapper -->
    </body>
</html>