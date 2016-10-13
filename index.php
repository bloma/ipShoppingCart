<?php
    session_start();
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
                            if(isset($_Session["customerLogin"]))
                            {
                                echo "<p><a href='webpages/shoppingcart.php'>My Cart</a> | <a href='webpages/checkout.php'>Checkout</a> | Hi, $customerSession | <a href='webpages/logout.php'>Logout</a></p>";
                            }
                            else if(isset($_Session["adminLogin"]))
                            {
                                echo "<p><a href='webpages/shoppingcart.php'>My Cart</a> | <a href='webpages/checkout.php'>Checkout</a> | Hi, $adminSession | <a href='webpages/logout.php'>Logout</a></p>";
                            }
                            else if(!isset($_Session["customerLogin"]) && !isset($_Session["adminLogin"]))
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
                            <li><a href="webpages/customers/MyProfile.php">My Profile</a></li>
                            <li><a href="webpages/about.php">About</a></li>
                            <li><a href="webpages/contact.php">Contact Us</a></li>
                        </ul>
                        <br style="clear: left" />
                    </div> <!-- end of topNav-->
                    <!-- We could use this to search for products -->
                    <div id="search">
                        <form action="webpages/searchresults.php" method="post">
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
                                    <li class='first'><a href='#'>My Profile</a></li>
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
                        <div id="sliderWrapper">
                            <div id="slider" class="shoeSlider">
                                <img src="images/slider/02.jpg" alt="" />
                                <a href="#"><img src="images/slider/01.jpg" alt=""/></a>
                                <img src="images/slider/03.jpg" alt="" />
                                <img src="images/slider/04.jpg" alt=""/>
                            </div>
                        </div>
                        <script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
                        <script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
                        <script type="text/javascript">
                            $(window).load(function() {
                                $('#slider').nivoSlider();
                            });
                        </script>
                        <h1>New arrivals</h1>
                        <div class="productBox">
                            <h3>Ut eu feugiat</h3>
                            <img src="images/product/01.jpg" alt="Shoes 1" />
                            <p>Nulla rutrum neque vitae erat condimentum eget malesuada.</p>
                            <p class="productPrice">$ 100</p>
                        </div>
                        <div class="productBox">
                            <h3>Curabitur et turpis</h3>
                            <img src="images/product/02.jpg" alt="Shoes 2" />
                            <p>Sed congue, erat id congue vehicula.</p>
                            <p class="productPrice">$ 80</p>
                        </div>
                        <div class="productBox noMarginRight">
                            <h3>Mauris consectetur</h3>
                            <img src="images/product/03.jpg" alt="Shoes 3" />
                            <p>Morbi non risus vitae est vestibulum tincidunt ac eget metus.</p>
                            <p class="productPrice">$ 60</p>
                        </div>
                        <div class="cleaner"></div>

                        <div class="productBox">
                            <h3>Proin volutpat</h3>
                            <img src="images/product/04.jpg" alt="Shoes 4" />
                            <p>Sed semper euismod dolor sit amet interdum. Phasellus in mi eros.</p>
                            <p class="productPrice">$ 220</p>
                        </div>
                        <div class="productBox">
                            <h3>Aenean tempus</h3>
                            <img src="images/product/05.jpg" alt="Shoes 5" />
                            <p>Maecenas porttitor erat quis leo pellentesque molestie.</p>
                            <p class="productPrice">$ 180</p>
                        </div>
                        <div class="productBox noMarginRight">
                            <h3>Nulla luctus urna</h3>
                            <img src="images/product/06.jpg" alt="Shoes 6" />
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <p class="productPrice">$ 160</p>
                        </div>
                    </div> <!-- END content -->
                    <div class="cleaner"></div>
                </div> <!-- END main -->

                <div id="footer">
                    <p><a href="index.php">Home</a> | <a href="webpages/about.php">About</a> | <a href="webpages/faqs.php">FAQs</a> | <a href="webpages/contact.php">Contact Us</a></p>
                    Copyright © 2016 <a href="#">Shoe Store</a>
                </div> <!-- END of footer -->

            </div> <!-- END innerWrapper -->
        </div> <!-- END bodyWrapper -->
    </body>
</html>