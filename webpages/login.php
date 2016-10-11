<?php

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
                    <div id="siteTitle"><h1><a href="#">Online Shoes Store</a></h1></div>
                    <div id="headerRight">
                        <p><a href="shoppingcart.php">My Cart</a> | <a href="checkout.php">Checkout</a> | <a href="login.php">Log In</a> | <a href="register.php">Register</a> </p>
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
                        <form action="" method = "post">
                            <p>Please enter your email address: <input type ="text" name="username"/></p>
                            <p>Please enter your Password: <input type = "text" name ="password"/></p>
                            <input type="submit" value = "login"/>
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