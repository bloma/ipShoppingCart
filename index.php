<?php
    @include "configuration/session.php";
?>
<html>
    <head>
        <title>Shoe Store</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/slider.css">
        <link rel="stylesheet" type="text/css" href="css/smoothMenu.css">

        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/ddsmoothmenu.js"></script>
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
                    <div id="siteTitle"><h1><a href="index.php">AXI's sneakers</a></h1></div>
                    <div id="headerRight">
                        <?php
                            if(isset($_SESSION["loggedIn"]) && $accType == "Customer")
                            {
                                echo "<p>Hi, $name $surname | <a href='webpages/shoppingcart.php'>My Cart</a> | <a href='webpages/checkout.php'>Checkout</a> | <a href='webpages/logout.php'>Logout</a></p>";
                            }
                            else if(isset($_SESSION["loggedIn"]) && $accType == "Admin")
                            {
                                echo "<p>Hi, $name| <a href='webpages/logout.php'>Logout</a></p>";
                            }
                            else
                            {
                                echo "<p><a href='webpages/login.php'>Log in</a> | <a href='webpages/register.php'>Register</a></p>";
                            }
                        ?>
                    </div>
                    <div class="cleaner"></div>
                </div> <!-- END Header -->

                <div id="menuBar">
                    <div id="topNav" class="smoothMenu">
                        <ul>
                            <li><a href="index.php" class="selected">Home</a></li>
                            <li><a href="webpages/products.php">Products</a></li>
                            <li><a href="webpages/checkout.php">Checkout</a></li>
                            <?php
                                if(isset($_SESSION["loggedIn"]) && $accType == "Customer")
                                {
                                    echo "<li><a href='webpages/customers/MyProfile.php'>My profile</a></li>";
                                }
                            ?>
                            <li><a href="webpages/about.php">About</a></li>
                            <li><a href="webpages/contact.php">Contact Us</a></li>
                        </ul>
                        <br style="clear: left" />
                    </div> <!-- end of topNav-->
                    <!-- We could use this to search for products -->
                    <div id="search">
                        <form action="webpages/searchresults.php" method="post">
                            <input type="text" value="" name="keyword" id="keyword" title="keyword"  class="txtSearch" />
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
                                            echo "<li class='first'><a href='webpages/customers/MyProfile.php'>My Profile</a></li>";
                                            echo "<li><a href='webpages/about.php'>About us</a></li>";
                                            echo "<li><a href='webpages/faqs.php'>FAQs</a></li>";
                                            echo "<li><a href='webpages/contact.php'>Contact US</a></li>";
                                            echo "<li><a href='webpages/exchangepolicy.php'>Exchange Policy</a></li>";
                                            echo "<li><a href='webpages/privacypolicy.php'>Privacy Policy</a></li>";
                                            echo "<li class='last'><a href='webpages/shippingpolicy.php'>Shipping Policy</a></li>";
                                        }
                                        else if(isset($_SESSION["loggedIn"]) && $accType == "Admin")
                                        {
                                            echo "<li class='first'><a href='webpages/admin/reports/brandreport.php'>View Brands</a></li>";
                                            echo "<li><a href='webpages/admin/reports/customerreport.php'>View Customers</a></li>";
                                            echo "<li><a href='webpages/admin/reports/deliveriesreport.php'>View Deliveries</a></li>";
                                            echo "<li><a href='webpages/admin/reports/departmentsreport.php'>View Departments</a></li>";
                                            echo "<li><a href='webpages/admin/reports/distriburtorreport.php'>View Distributors</a></li>";
                                            echo "<li><a href='webpages/admin/reports/orderhistory.php'>View Orders</a></li>";
                                            echo "<li><a href='webpages/admin/reports/staffreport.php'>View Staff</a></li>";
                                            echo "<li><a href='webpages/admin/reports/stockreport.php'>View Stock</a></li>";
                                            echo "<li><a href='webpages/admin/reports/suppliersreport.php'>View Suppliers</a></li>";
                                            echo "<li class='last'><a href='webpages/admin/reports/usersreport.php'>view Users</a></li>";
                                        }
                                        else if(!isset($_SESSION["loggedIn"]))
                                        {
                                            echo "<li class='first'><a href='webpages/about.php'>About us</a></li>";
                                            echo "<li><a href='webpages/faqs.php'>FAQs</a></li>";
                                            echo "<li><a href='webpages/contact.php'>Contact US</a></li>";
                                            echo "<li><a href='webpages/exchangepolicy.php'>Exchange Policy</a></li>";
                                            echo "<li><a href='webpages/privacypolicy.php'>Privacy Policy</a></li>";
                                            echo "<li class='last'><a href='webpages/shippingpolicy.php'>Shipping Policy</a></li>";
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div> <!-- END sidebar -->

                    <div id="content" class="floatRight">
                        <div id="sliderWrapper">
                            <div id="slider" class="shoeSlider">
                                <?php
                                    echo "<img src='images/slider/af1.jpg' alt='' />";
                                    echo "<img src='images/slider/stan.jpg' alt='' />";
                                    echo "<img src='images/slider/stanSmith.jpg' alt='' />";
                                    echo "<img src='images/slider/yeezy.jpg' alt='' />";
                                    echo "<img src='images/slider/superstar.jpg' alt='' />";
                                ?>
                            </div>
                        </div>
                        <script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
                        <script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
                        <script type="text/javascript">
                            $(window).load(function() {
                                $('#slider').nivoSlider();
                            });
                        </script>
                        <?php
                            echo "<h1>New Arrivals</h1>";
                            for($i = 1; $i <= 12; ++$i)
                            {
                                echo "<div class='productBox noMarginRight'>";
                                echo "<h3>Ut eu feugiat</h3>";
                                echo "<img src='images/product/01.jpg' alt='Shoes 1' />";
                                echo "<p>Nulla rutrum neque vitae erat condimentum eget malesuada.</p>";
                                echo "<p class='productPrice'>R150</p>";
                                echo "</div>";
                            }
                        ?>
                    </div> <!-- END content -->
                    <div class="cleaner"></div>
                </div> <!-- END main -->
                <div id="footer">
                    <?php
                        echo"<p><a href='index.php'>Home</a> | <a href='webpages/about.php'>About</a> | <a href='webpages/faqs.php'>FAQS</a> | <a href='webpages/contact.php'>Contact Us</a></p>";
                        echo "<p>Copyright © 2016 <a href='index.php'>AXI's Sneakers</a></p>";
                    ?>
                </div> <!-- END of footer -->
            </div> <!-- END innerWrapper -->
        </div> <!-- END bodyWrapper -->
    </body>
</html>