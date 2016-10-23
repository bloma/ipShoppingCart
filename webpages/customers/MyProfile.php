<?php
    @include "../../configuration/session.php";
    include_once "../../classes/Customer.php";
    include_once "../../classes/User.php";
    include_once "../../classes/SqlFunctions.php";
    if(class_exists("User"))
    {
        $userObject = new User();
    }
    if(class_exists("Customer"))
    {
        $customerObject = new Customer();
    }
    if(class_exists("SqlFunctions"))
    {
        $sqlFunctions = new SqlFunctions();
    }
    if(isset($_POST["btnSubmit"]))
    {
        if(!empty($_POST["custName"]))
        {
            $custName = $_POST["custName"];
            $customerObject->setCustomerName($custName);
        }
        if(!empty($_POST["custSurname"]))
        {
            $custSurname = $_POST["custSurname"];
            $customerObject->setCustomerSurname($custSurname);
        }
        if(!empty($_POST["custTelephone"]))
        {
            $custContactNumber = $_POST["custTelephone"];
            $customerObject->setContactNumber($custContactNumber);
        }
        if(!empty($_POST["custPassword"]))
        {
            $custPassword = $_POST["custPassword"];
            $hashedPassword = md5($custPassword);
            $userObject->setPassword($hashedPassword);
        }
        if(!empty($_POST["custEmail"]))
        {
            $custEmail = $_POST["custEmail"];
            $userObject->setUserName($custEmail);
        }
        if(!empty($customerObject->getCustomerName()))
        {
            $sqlFunctions->updateCustomerName($conn,$name,$customerObject->getCustomerName());
        }
        if(!empty($customerObject->getCustomerSurname()))
        {
            $sqlFunctions->updateCustomerSurname($conn,$name,$customerObject->getCustomerSurname());
        }
        if(!empty($customerObject->getContactNumber()))
        {
            $sqlFunctions->updateCustomerContactNumber($conn,$name,$customerObject->getContactNumber());
        }
        if(!empty($userObject->getUserName()))
        {
            $sqlFunctions->updateUserEmail($conn,$name,$userObject->getUserName());
        }
        if(!empty($userObject->getPassword()))
        {
            $sqlFunctions->updateUserPassword($conn,$name,$userObject->getPassword());
        }
    }
    if(isset($_POST["btnCancel"]))
    {
       header("Location: ../../index.php");
    }
?>
<html>
    <head>
        <title>Shoe Store</title>
        <link rel="stylesheet" type="text/css" href="../../css/style.css">
        <link rel="stylesheet" type="texut/css" href="../../css/slider.css">
        <link rel="stylesheet" type="text/css" href="../../css/smoothMenu.css">

        <script type="text/javascript" src="../../js/jquery.min.js"></script>
        <script type="text/javascript" src="../../js/ddsmoothmenu.js"></script>
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
                    <div id="siteTitle"><h1><a href="../../index.php">AXI's sneakers</a></h1></div>
                    <div id="headerRight">
                        <?php
                            if(isset($_SESSION["loggedIn"]) && $accType == "Customer")
                            {
                                echo "<p>Hi, $name $surname | <a href='../shoppingcart.php'>My Cart</a> | <a href='../checkout.php'>Checkout</a> | <a href='../logout.php'>Logout</a></p>";
                            }
                            else if(isset($_SESSION["loggedIn"]) && $accType == "Admin")
                            {
                                echo "<p>Hi, $name| <a href='../logout.php'>Logout</a></p>";
                            }
                            else
                            {
                                echo "<p><a href='../login.php'>Log in</a> | <a href='../register.php'>Register</a></p>";
                            }
                        ?>
                    </div>
                    <div class="cleaner"></div>
                </div> <!-- END Header -->

                <div id="menuBar">
                    <div id="topNav" class="smoothMenu">
                        <ul>
                            <li><a href="../../index.php">Home</a></li>
                            <li><a href="../products.php">Products</a></li>
                            <li><a href="../checkout.php">Checkout</a></li>
                            <?php
                                if(isset($_SESSION["loggedIn"]) && $accType == "Customer")
                                {
                                    echo "<li><a href='MyProfile.php' class='selected'>My profile</a></li>";
                                }
                            ?>
                            <li><a href="../about.php">About</a></li>
                            <li><a href="../contact.php">Contact Us</a></li>
                        </ul>
                        <br style="clear: left" />
                    </div> <!-- end of topNav-->
                    <!-- We could use this to search for products -->
                    <div id="search">
                        <form action="../../webpages/searchresults.php" method="post">
                            <input type="text" value=" " name="keyword" id="keyword" title="keyword"  class="txtSearch" />
                            <input type="submit" name="Search" value=" " alt="Search" id="searchbutton" title="Search" class="subBtn"  />
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
                                            echo "<li class='first'><a href='../customers/MyProfile.php'>My Profile</a></li>";
                                            echo "<li><a href='../about.php'>About us</a></li>";
                                            echo "<li><a href='../faqs.php'>FAQs</a></li>";
                                            echo "<li><a href='../contact.php'>Contact US</a></li>";
                                            echo "<li><a href='../exchangepolicy.php'>Exchange Policy</a></li>";
                                            echo "<li><a href='../privacypolicy.php'>Privacy Policy</a></li>";
                                            echo "<li class='last'><a href='../shippingpolicy.php'>Shipping Policy</a></li>";
                                        }
                                        else if(isset($_SESSION["loggedIn"]) && $accType == "Admin")
                                        {
                                            echo "<h3>CRUD options</h3>";
                                            echo "<h5>Reports</h5>";
                                            echo "<li class='first'><a href='../admin/reports/brandreport.php'>View Brands</a></li>";
                                            echo "<li><a href='../admin/reports/customerreport.php'>View Customers</a></li>";
                                            echo "<li><a href='../admin/reports/deliveriesreport.php'>View Deliveries</a></li>";
                                            echo "<li><a href='../admin/reports/departmentsreport.php'>View Departments</a></li>";
                                            echo "<li><a href='../admin/reports/distriburtorreport.php'>View Distributors</a></li>";
                                            echo "<li><a href='../admin/reports/orderhistory.php'>View Orders</a></li>";
                                            echo "<li><a href='../admin/reports/staffreport.php'>View Staff</a></li>";
                                            echo "<li><a href='../admin/reports/stockreport.php'>View Stock</a></li>";
                                            echo "<li><a href='../admin/reports/suppliersreport.php'>View Suppliers</a></li>";
                                            echo "<li class='last'><a href='../admin/reports/usersreport.php'>view Users</a></li>";
                                            echo "<h5>Insert options</h5>";
                                            echo "<li class='first'><a href='../admin/databasecontrol/insert/insertnewbrands.php'>Add Brand</a></li>";
                                            echo "<li><a href='../admin/databasecontrol/insert/insertnewdistributors.php'>Add Distributor</a></li>";
                                            echo "<li><a href='../admin/databasecontrol/insert/insertnewproduct.php'>Add Product</a></li>";
                                            echo "<li><a class='last' href='../admin/databasecontrol/insert/insertnewsupplier.php'>Add Supplier</a></li>";
                                            echo "<h5>Update options</h5>";
                                            echo "<li class='first'><a href='../admin/databasecontrol/update/updatebrands.php'>Update Brand</a></li>";
                                            echo "<li><a href='../admin/databasecontrol/update/updatedistributors.php'>Update Distributor</a></li>";
                                            echo "<li><a href='../admin/databasecontrol/update/updatestock.php'>Update Stock</a></li>";
                                            echo "<li><a class='last' href='../admin/databasecontrol/update/updatesuppliers.php'>Update Supplier</a></li>";
                                            echo "<h5>Delete Options</h5>";
                                            echo "<li class='first'><a href='../admin/databasecontrol/delete/removebrand.php'>Delete Brand</a></li>";
                                            echo "<li><a href='../admin/databasecontrol/delete/removedistributor.php'>Delete Distributor</a></li>";
                                            echo "<li><a href='../admin/databasecontrol/delete/removeproduct.php'>Delete Product</a></li>";
                                            echo "<li><a class='last' href='../admin/databasecontrol/delete/removesupplier.php'>Delete Supplier</a></li>";
                                        }
                                        else if(!isset($_SESSION["loggedIn"]))
                                        {
                                            echo "<h3>Categories</h3>";
                                            echo "<li class='first'><a href='../about.php'>About us</a></li>";
                                            echo "<li><a href='../faqs.php'>FAQs</a></li>";
                                            echo "<li><a href='../contact.php'>Contact US</a></li>";
                                            echo "<li><a href='../exchangepolicy.php'>Exchange Policy</a></li>";
                                            echo "<li><a href='../privacypolicy.php'>Privacy Policy</a></li>";
                                            echo "<li class='last'><a href='../shippingpolicy.php'>Shipping Policy</a></li>";
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div> <!-- END sidebar -->
                    <div id="content" class="floatRight">
                        <?php
                            $sqlFunctions->displayUserDetails($conn,$name);
                            echo "<h2>Update Details</h2>";
                        ?>
                        <form name="updateDetails" action="<?php $_SERVER['PHP_SELF']?>" method="post">
                            <p>Please enter your new name: <input name="custName" type="text"/></p>
                            <p>Please enter your new surname: <input name="custSurname" type="text"/></p>
                            <p>Please enter your new contact number: <input name="custTelephone" type="text"/></p>
                            <p>Please enter your new email address: <input name="custEmail" type="email"/></p>
                            <p>Please enter your new password: <input name="custPassword" type="password"/></p>
                            <input name="btnSubmit" value="Submit" type="submit"/> <input name="btnCancel" value="Cancel" type="submit"/>
                        </form>
                    </div> <!-- END content -->
                    <div class="cleaner"></div>
                </div> <!-- END main -->

                <div id="footer">
                    <p><a href="../../index.php">Home</a> | <a href="../../webpages/about.php">About</a> | <a href="../../webpages/faqs.php">FAQs</a> | <a href="../../webpages/contact.php">Contact Us</a></p>
                    Copyright © 2016 <a href="#">Shoe Store</a>
                </div> <!-- END of footer -->

            </div> <!-- END innerWrapper -->
        </div> <!-- END bodyWrapper -->
    </body>
</html>