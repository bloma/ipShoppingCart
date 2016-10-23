<?php
    @include "configuration/session.php";
    include "classes/SqlFunctions.php";
    if(class_exists("SqlFunctions"))
    {
        $sqlObject = new SqlFunctions();
    }
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
                        <form action="webpages/searchresults.php" method="get">
                            <input type="text" value="" name="keyword" class="txtSearch" />
                            <input type="submit" name="Search" value=" " alt="Search" class="subBtn"  />
                        </form>
                    </div> <!-- END Search -->
                </div><!-- END menuBar -->

                <div id="main">
                    <div id="sidebar" class="floatLeft">
                        <div class="sidebarBox"><span class="bottom"></span>

                            <div class="content">
                                <ul class="sidebarList">
                                    <?php
                                        if(isset($_SESSION["loggedIn"]) & $accType == "Customer")
                                        {
                                            echo "<h3>Categories</h3>";
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
                                            echo "<h3>CRUD options</h3>";
                                            echo "<h5>Reports</h5>";
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
                                            echo "<h5>Insert options</h5>";
                                            echo "<li class='first'><a href='webpages/admin/databasecontrol/insert/insertnewbrands.php'>Add Brand</a></li>";
                                            echo "<li><a href='webpages/admin/databasecontrol/insert/insertnewdistributors.php'>Add Distributor</a></li>";
                                            echo "<li><a href='webpages/admin/databasecontrol/insert/insertnewproduct.php'>Add Product</a></li>";
                                            echo "<li><a class='last' href='webpages/admin/databasecontrol/insert/insertnewsupplier.php'>Add Supplier</a></li>";
                                            echo "<h5>Update options</h5>";
                                            echo "<li class='first'><a href='webpages/admin/databasecontrol/update/updatebrands.php'>Update Brand</a></li>";
                                            echo "<li><a href='webpages/admin/databasecontrol/update/updatedistributors.php'>Update Distributor</a></li>";
                                            echo "<li><a href='webpages/admin/databasecontrol/update/updatestock.php'>Update Stock</a></li>";
                                            echo "<li><a class='last' href='webpages/admin/databasecontrol/update/updatesuppliers.php'>Update Supplier</a></li>";
                                            echo "<h5>Delete Options</h5>";
                                            echo "<li class='first'><a href='webpages/admin/databasecontrol/delete/removebrand.php'>Delete Brand</a></li>";
                                            echo "<li><a href='webpages/admin/databasecontrol/delete/removedistributor.php'>Delete Distributor</a></li>";
                                            echo "<li><a href='webpages/admin/databasecontrol/delete/removeproduct.php'>Delete Product</a></li>";
                                            echo "<li><a class='last' href='webpages/admin/databasecontrol/delete/removesupplier.php'>Delete Supplier</a></li>";
                                        }
                                        else if(!isset($_SESSION["loggedIn"]))
                                        {
                                            echo "<h3>Categories</h3>";
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
                                    echo "<img src='images/slider/adidas.jpg' alt='' />";
                                    echo "<img src='images/slider/stanSmith.jpg' alt='' />";
                                    echo "<img src='images/slider/yeezy.jpg' alt='' />";
                                    echo "<img src='images/slider/jordan1.jpg' alt='' />";
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
                            $sqlObject->displayNewProducts($conn);
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