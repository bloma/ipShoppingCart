<?php

class SqlFunctions
{
    public function __construct(){}

    /**
     * User and customer functions
     */

    /**
     * @param $conn
     * @param $emailAddress
     * @param $hashedPassword
     * @param $accType
     * @param $userID
     * @param $firstName
     * @param $surname
     * @param $contactNumber
     * This function is used to register new users on the system
     */

    public function registerUser($conn, $emailAddress, $hashedPassword, $accType, $userID, $firstName, $surname, $contactNumber)
    {
        $sqlUserInsert = "insert into users (username, password,accountType) values ('$emailAddress','$hashedPassword','$accType')";
        if (mysqli_query($conn, $sqlUserInsert)) {
            $sqlUserSelect = "select userID from users where username = '$emailAddress'";
            $userIDResult = mysqli_query($conn, $sqlUserSelect);
            if (mysqli_num_rows($userIDResult) > 0) {
                $row = mysqli_fetch_assoc($userIDResult);
                $userID = $row['userID'];
            } else {
                echo "SQL error " . mysqli_error($conn);
            }
            $sqlCustomer = "insert into customers (userID, customerName,customerSurname,customerTelephone) values ($userID,'$firstName','$surname','$contactNumber')";
            if (mysqli_query($conn, $sqlCustomer)) {
                @mail($emailAddress, "Registration on AXI's Sneakers", "Hi $firstName $surname\nWelcome to AXI's sneakers you have successfully registered on our service\nRegards AXI team", "From: noreply@axi.co.za");
                header("location: ../index.php");
            } else {
                echo "SQL error " . mysqli_error($conn);
            }
        }
    }

    /**
     * @param $conn
     * @param $newPassword
     * @param $email
     * This function is used to reset a users password
     */

    public function resetPassword($conn, $newPassword, $email)
    {
        $sqlQueryUpdate = "UPDATE USERS set Password = '$newPassword' WHERE UserName = '$email'";
        try {
            mysqli_query($conn, $sqlQueryUpdate);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * @return string
     * This function is used to create a new password if a user forgets their current on
     */
    public function createTempPassword()
    {
        $alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $numbers = "0123456789";
        $characters = "!@#$%^&*()_+?/><";
        $validCharacters = $alphabet . $numbers . $characters;
        $charLength = strlen($validCharacters) - 1;
        $password = array();
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $charLength);
            $password[] = $validCharacters[$n];
        }
        return implode($password);
    }

    public function validateEmail($conn,$emailToValidate)
    {
        $sqlSelectEmail = "Select UserName from users";
        $userEmailResult = mysqli_query($conn,$sqlSelectEmail);
        $emailMatches = false;
        while($row = mysqli_fetch_assoc($userEmailResult)) {
            $email = $row["UserName"];
            if ($email == $emailToValidate)
            {
                $emailMatches = true;
            }
            else{
                $emailMatches = false;
            }
        }
        return $emailMatches;
    }

    /**
     * @param $conn
     * @param $name
     * This function is used to display user details on their profile page
     */
    public function displayUserDetails($conn, $name)
    {
        $sqlStatementSelectCustomerDetails = mysqli_query($conn, "Select * from customers WHERE CustomerName = '$name'");
        echo "<h2>Personal Details</h2>";
        $row = mysqli_fetch_array($sqlStatementSelectCustomerDetails, MYSQLI_ASSOC);
        echo "<p>First Name:" . $row["CustomerName"] . "</p>";
        echo "<p>Surname: " . $row["CustomerSurname"] . "</p>";
        echo "<p>Contact Number: " . $row["CustomerTelephone"] . "</p>";
    }

    /**
     * @param $conn
     * @param $oldName
     * @param $newName
     * This function updates a customers name
     */
    public function updateCustomerName($conn,$oldName, $newName)
    {
        $sqlStatementSelectID = "Select CustomerID,UserID from customers WHERE CustomerName = '$oldName'";
        $customerIDResult = mysqli_query($conn,$sqlStatementSelectID);
        $row = mysqli_fetch_array($customerIDResult,MYSQLI_ASSOC);
        $CustomerID = $row["CustomerID"];
        $userID = $row["UserID"];
        $sqlSelectEmail = "Select UserName from users WHERE UserID = '$userID'";
        $emailResult = mysqli_query($conn,$sqlSelectEmail);
        $userRow = mysqli_fetch_array($emailResult);
        $email = $userRow["UserName"];
        $sqlStatementUpdateCustomerName = "Update Customers set CustomerName = '$newName' WHERE CustomerID = '$CustomerID'";
        if(mysqli_query($conn,$sqlStatementUpdateCustomerName))
        {
            @mail($email,"Personal Details Updated","Hi, $newName\nYou have successfully updated your first name","From: noreply@axi.co.za");
        }
        else{
            echo mysqli_error($conn);
        }
    }

    /**
     * @param $conn
     * @param $name
     * @param $surname
     * This function updates a customers surname
     */
    public function updateCustomerSurname($conn,$name,$surname)
    {
        $sqlStatementSelectID = "Select UserID from customers WHERE CustomerName = '$name'";
        $customerIDResult = mysqli_query($conn,$sqlStatementSelectID);
        $row = mysqli_fetch_array($customerIDResult,MYSQLI_ASSOC);
        $userID = $row["UserID"];
        $sqlSelectEmail = "Select UserName from users WHERE UserID = '$userID'";
        $emailResult = mysqli_query($conn,$sqlSelectEmail);
        $userRow = mysqli_fetch_array($emailResult);
        $email = $userRow["UserName"];
        $sqlUpdateSurname = "Update customers set CustomerSurname = '$surname' WHERE CustomerName = '$name'";
        if(mysqli_query($conn,$sqlUpdateSurname))
        {
            @mail($email,"Personal Details Updated","Hi, $name\nYou have successfully updated your surname","From: noreply@axi.co.za");
        }
        else{
            echo mysqli_error($conn);
        }

    }

    /**
     * @param $conn
     * @param $name
     * @param $newContactNumber
     * This function updates a customers telephone number
     */
    public function updateCustomerContactNumber($conn,$name,$newContactNumber)
    {
        $sqlSelectCustomerDetails = "Select UserID from customers WHERE CustomerName = '$name'" ;
        $customerIDResult = mysqli_query($conn,$sqlSelectCustomerDetails);
        $rowCustomer = mysqli_fetch_array($customerIDResult,MYSQLI_ASSOC);
        $userID = $rowCustomer["UserID"];
        $sqlUserSelectEmail = "Select UserName from users WHERE UserID = '$userID'";
        $userResult = mysqli_query($conn,$sqlUserSelectEmail);
        $userRow = mysqli_fetch_array($userResult);
        $email = $userRow["UserName"];
        $sqlUpdateCustomerContact = "Update customers set CustomerTelephone = '$newContactNumber' WHERE CustomerName = '$name'";
        if(mysqli_query($conn,$sqlUpdateCustomerContact))
        {
            @mail($email,"Personal Details Updated","Hi, $name\nYou have successfully updated your contact number","From: noreply@axi.co.za");
        }
        else{
            echo mysqli_error($conn);
        }
    }

    /**
     * @param $conn
     * @param $name
     * @param $newEmail
     * This function updates a users email/Username
     */
    public function updateUserEmail($conn,$name,$newEmail)
    {
        $sqlSelectUserID = "Select UserID from customers WHERE CustomerName = '$name'";
        $iDResult = mysqli_query($conn,$sqlSelectUserID);
        $rowCustomer = mysqli_fetch_array($iDResult,MYSQLI_ASSOC);
        $userID = $rowCustomer["UserID"];
        $sqlUpdateUserName = "Update users set UserName = '$newEmail' WHERE UserID = '$userID'";
        if(mysqli_query($conn,$sqlUpdateUserName))
        {
            $sqlSelectEmail = "select UserName from users WHERE UserID = '$userID'";
            $userEmailResult = mysqli_query($conn,$sqlSelectEmail);
            $rowUser = mysqli_fetch_array($userEmailResult,MYSQLI_ASSOC);
            $email = $rowUser["UserName"];
            @mail($email,"Personal Details Updated","Hi, $name\nYou have successfully updated your email address","From: noreply@axi.co.za");
        }
        else{
            echo mysqli_error($conn);
        }
    }

    /**
     * @param $conn
     * @param $name
     * @param $newPassword
     * This function updates a users password
     */
    public function updateUserPassword($conn,$name,$newPassword)
    {
        $sqlSelectUserID = "Select UserID from customers WHERE CustomerName = '$name'";
        $userIDResult = mysqli_query($conn,$sqlSelectUserID);
        $rowCustomer = mysqli_fetch_array($userIDResult,MYSQLI_ASSOC);
        $userID = $rowCustomer["UserID"];
        $sqlSelectEmail = "select UserName from users WHERE UserID = '$userID'";
        $userEmailResult = mysqli_query($conn,$sqlSelectEmail);
        $rowUser = mysqli_fetch_array($userEmailResult,MYSQLI_ASSOC);
        $email = $rowUser["UserName"];
        $sqlUpdatePassword = "Update users set Password = '$newPassword' WHERE UserID = '$userID'";
        if(mysqli_query($conn,$sqlUpdatePassword))
        {
            @mail($email,"Personal Details Updated","Hi, $name\nYou have successfully updated your password","From: noreply@axi.co.za");
        }
        else{
            echo mysqli_error($conn);
        }
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Reports functions
     */

    /**
     * @param $conn
     * This function prints a report of all brands we sell
     */
    public function brandsReport($conn)
    {
        $sqlStatement = "Select * from Brands";
        $result = mysqli_query($conn,$sqlStatement);
        if(mysqli_num_rows($result) > 0)
        {
            echo "<table border='1'><tr><th>Brand ID</th><th>Supplier ID</th><th>Brand Name</th><th>Supplier Name</th></tr>";
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr><td>".$row["BrandID"]."</td><td>".$row["SupplierID"]."</td><td>".$row["BrandName"]."</td><td>".$row["SupplierName"]."</td></tr>";
            }
            echo "</table>";
        }
        else
        {
            echo "<p id='errors'>No results</p>";
        }

    }

    /**
     * @param $conn
     * This function provides a list of all customers
     */
    public function customerReport($conn)
    {
        $sqlStatement = "Select * from customers";
        $result = mysqli_query($conn,$sqlStatement);
        if(mysqli_num_rows($result) > 0)
        {
            echo "<table border='1'><tr><th>Customer ID</th><th>User ID</th><th>Name</th><th>Surname</th><th>Customer Telephone</th></tr>";
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr><td>".$row["CustomerID"]."</td><td>".$row["UserID"]."</td><td>".$row["CustomerName"]."</td><td>".$row["CustomerSurname"]."</td><td>".$row["CustomerTelephone"]."</td></tr>";
            }
            echo "</table>";
        }
        else
        {
            echo "<p id='errors'>No results</p>";
        }
    }

    /**
     * @param $conn
     * This function provides a list of all deliveries
     */
    public function deliveriesReport($conn)
    {
        $sqlStatement = "Select * from delieveries";
        $result = mysqli_query($conn,$sqlStatement);
        if(mysqli_num_rows($result) > 0)
        {
            echo "<table border='1'><tr><th>Delivery ID</th><th>Distributor ID</th><th>Customer ID</th><th>Courier</th><th>Delivery Address</th><th>Date Dispatched</th><th>Date Delivered</th><th>Total Items</th></tr>";
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr><td>".$row["DeliveryID"]."</td><td>".$row["DistributorID"]."</td><td>".$row["CustomerID"]."</td><td>".$row["CourierName"]."</td><td>".$row["DeliveryAddress"]."</td><td>".$row["DateDespatched"]."</td><td>".$row["DateDelivered"]."</td><td>".$row["TotalItems"]."</td></tr>";
            }
            echo "</table>";
        }
        else
        {
            echo "<p id='errors'>No results</p>";
        }
    }

    /**
     * @param $conn
     * This function provides a list of all departments
     */
    public function departmentsReport($conn)
    {
        $sqlStatement = "Select * from departments";
        $result = mysqli_query($conn,$sqlStatement);
        if(mysqli_num_rows($result) > 0)
        {
            echo "<table border='1'><tr><th>Department ID</th><th>Name</th><th>Total Employees</th></tr>";
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr><td>".$row["DepartmentID"]."</td><td>".$row["DepartmentName"]."</td><td>".$row["TotalEmployees"]."</td></tr>";
            }
            echo "</table>";
        }
        else
        {
            echo "<p id='errors'>No results</p>";
        }
    }

    /**
     * @param $conn
     * This function provides a list of all distributors
     */
    public function distributorsReport($conn)
    {
        $sqlStatement = "Select * from distributors";
        $result = mysqli_query($conn,$sqlStatement);
        if(mysqli_num_rows($result) > 0)
        {
            echo "<table border='1'><tr><th>Distributor ID</th><th>Name</th><th>Contact Number</th><th>Email Address</th><th>Physical Address</th></tr>";
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr><td>".$row["DistributorID"]."</td><td>".$row["CompanyName"]."</td><td>".$row["ContactNumber"]."</td><td>".$row["EmailAddress"]."</td><td>".$row["PhysicalAddress"]."</td></tr>";
            }
            echo "</table>";
        }
        else
        {
            echo "<p id='errors'>No results</p>";
        }
    }

    /**
     * @param $conn
     * This function provides a list of all the staff
     */
    public function staffReport($conn)
    {
        $sqlStatement = "Select * from employees";
        $result = mysqli_query($conn,$sqlStatement);
        if(mysqli_num_rows($result) > 0)
        {
            echo "<table border='1'><tr><th>Employee ID</th><th>Name</th><th>Surname</th><th>Role</th><th>Department ID</th><th>Department Name</th></tr>";
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr><td>".$row["EmployeeID"]."</td><td>".$row["EmployeeName"]."</td><td>".$row["EmployeeSurname"]."</td><td>".$row["Role"]."</td><td>".$row["DepartmentID"]."</td><td>".$row["DepartmentName"]."</td></tr>";
            }
            echo "</table>";
        }
        else
        {
            echo "<p id='errors'>No results</p>";
        }
    }

    /**
     * @param $conn
     * This function provides a list of all orders
     */
    public function orderHistoryReport($conn)
    {
        $sqlStatement = "Select * from orderhistory";
        $result = mysqli_query($conn,$sqlStatement);
        if(mysqli_num_rows($result) > 0)
        {
            echo "<table border='1'><tr><th>Order ID</th><th>Customer ID</th><th>Product ID</th><th>Customer Name</th><th>Customer Surname</th><th>Quantity</th><th>Order Date</th><th>Total Cost</th></tr>";
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr><td>".$row["OrderID"]."</td><td>".$row["CustomerID"]."</td><td>".$row["ProductID"]."</td><td>".$row["CustomerName"]."</td><td>".$row["CustomerSurname"]."</td><td>".$row["Quantity"]."</td><td>".$row["OrderDate"]."</td><td>".$row["TotalCost"]."</td></tr>";
            }
            echo "</table>";
        }
        else
        {
            echo "<p id='errors'>No results</p>";
        }
    }

    /**
     * @param $conn
     * This function provides a list of all users on the site
     */
    public function userReport($conn)
    {
        $sqlStatement = "Select * from users";
        $result = mysqli_query($conn,$sqlStatement);
        if(mysqli_num_rows($result) > 0)
        {
            echo "<table border='1'><tr><th>User ID</th><th>Username</th><th>Account Type</th></tr>";
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr><td>".$row["UserID"]."</td><td>".$row["UserName"]."</td><td>".$row["AccountType"]."</td></tr>";
            }
            echo "</table>";
        }
        else
        {
            echo "<p id='errors'>No results</p>";
        }
    }

    /**
     * @param $conn
     * This function provides a list of all suppliers
     */
    public function suppliersReport($conn)
    {
        $sqlStatement = "Select * from suppliers";
        $result = mysqli_query($conn,$sqlStatement);
        if(mysqli_num_rows($result) > 0)
        {
            echo "<table border='1'><tr><th>Supplier ID</th><th>Name</th><th>Contact Number</th><th>Email Address</th><th>Physical Address</th></tr>";
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr><td>".$row["SupplierID"]."</td><td>".$row["SupplierName"]."</td><td>".$row["ContactNumber"]."</td><td>".$row["EmailAddress"]."</td><td>".$row["PhysicalAddress"]."</td></tr>";
            }
            echo "</table>";
        }
        else
        {
            echo "<p id='errors'>No results</p>";
        }
    }

    /**
     * @param $conn
     * This funcion provides a report on all stock
     */
    public function stockReport($conn)
    {
        $sqlStatement2 = "Select * from products";
        $productsResult = mysqli_query($conn,$sqlStatement2);
        if(mysqli_num_rows($productsResult) > 0)
        {
            echo "<table border='1'><tr><td>Product ID</td><td>Brand ID</td><td>Supplier ID</td><td>Name</td><td>Description</td><td>Price</td><td>In Stock</td><td>Quantity</td></tr>";
            while ($rowProducts = mysqli_fetch_assoc($productsResult))
            {
                echo "<tr><td>".$rowProducts["ProductID"]."</td><td>".$rowProducts["BrandID"]."</td><td>".$rowProducts["SuplierID"]."</td><td>".$rowProducts["ProductName"]."</td><td>".$rowProducts["ProductDescription"]."</td><td>".$rowProducts["Price"]."</td><td>".$rowProducts["InStock"]."</td><td>".$rowProducts["Quantity"]."</td></tr>";
            }
            echo "</table>";
        }
        else
        {
            echo "<p id='errors'>No results</p>";
        }
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Database control functions
     * These functions are used to update stock and add new products,users,brands,employees and so forth
     */

    /**
     * INSERT Functions
     */

    /**
     * UPDATE Functions
     */

    /**
     * DELETE Functions
     */
    /**
     * @param $conn
     * @param $id
     * This function is used to remove a desired brand from the database
     */
    public function removeBrand($conn,$id)
    {
        $sqlDeleteFromBrand = "DELETE FROM brands WHERE BrandID = '$id' ";
        if(mysqli_query($conn,$sqlDeleteFromBrand))
        {
            echo "<p>You have successfully removed the desired brand</p>";
        }
        else{
            echo "<p id='errors'>The ID entered is invalid</p>";
        }
    }

    /**
     * @param $conn
     * @param $id
     * This function is used to remove a distributor brand from the database
     */
    public function removeDistributor($conn,$id)
    {
        $sqlDeleteFromDistributor = "DELETE FROM distributors WHERE DistributorID = '$id' ";
        if(mysqli_query($conn,$sqlDeleteFromDistributor))
        {
            echo "<p>You have successfully removed the desired distributor</p>";
        }
        else{
            echo "<p id='errors'>The ID entered is invalid</p>";
        }
    }

    /**
     * @param $conn
     * @param $id
     * This function is used  to remove a product from the database
     */
    public function removeProduct($conn,$id)
    {
        $sqlDeleteFromProduct = "DELETE FROM products WHERE ProductID = '$id' ";
        if(mysqli_query($conn,$sqlDeleteFromProduct))
        {
            echo "<p>You have successfully removed the desired product</p>";
        }
        else{
            echo "<p id='errors'>The ID entered is invalid</p>";
        }

    }

    /**
     * @param $conn
     * @param $id
     * This function is used to remove a supplier from the database
     */
    public function removeSupplier($conn,$id)
    {
        $sqlDeleteFromSupplier = "DELETE FROM suppliers WHERE SupplierID = '$id' ";
        if(mysqli_query($conn,$sqlDeleteFromSupplier))
        {
            echo "<p>You have successfully removed the desired supplier</p>";
        }
        else{
            echo "<p id='errors'>The ID entered is invalid</p>";
        }
    }
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Search function
     */
    /**
     * @param $conn
     * @param $keyword
     * This function is used to search for a specific item in products
     */
    public function search($conn,$keyword)
    {
        $sqlStatement = "SELECT ProductName,ProductDescription,Price,Image from products where ProductName = '$keyword' or Brand = '$keyword'";
        $searchResult = mysqli_query($conn,$sqlStatement);
        if(mysqli_num_rows($searchResult) >0)
        {
            echo "<h1>Search Results</h1>";
            while ($row = mysqli_fetch_assoc($searchResult))
            {
                echo "<div class='productBox noMarginRight'>";
                echo "<h3>".$row["ProductName"]."</h3>";
                echo '<img src="data:image/jpeg;base64,'.base64_encode($row["Image"]).'" />';
                echo "<p>".$row["ProductDescription"]."</p>";
                echo "<p class='productPrice'>R".$row["Price"]."</p>";
                echo "</div>";
            }
        }
        else{
            echo "<p id ='errors'>Sorry, we could not find what you were looking for</p>";
        }
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Display Products
     */
    /**
     * @param $conn
     * This function displays all the products on the product page
     */
    public function displayProducts($conn)
    {
        $sqlStatement = "SELECT ProductID,ProductName,ProductDescription,Price,Image from products";
        @$searchResult = mysqli_query($conn,$sqlStatement);
        if(mysqli_num_rows($searchResult) >0)
        {
            while ($row = mysqli_fetch_assoc($searchResult))
            {
                echo "<div class='productBox noMarginRight'>";
                    echo "<h3>".$row["ProductName"]."</h3>";
                    echo '<img src="data:image/jpeg;base64,'.base64_encode($row["Image"]).'" />';
                    echo "<p>".$row["ProductDescription"]."</p>";
                    echo "<p class='productPrice'>R".$row["Price"]."</p>";
                    echo "<form name='cart' action='' method='get'>";
                        echo "<button name='add' value='' type='submit' class='addtocart' />";
                    echo "</form>";
                echo "</div>";
            }
        }
        else{
            echo "<p id ='errors'>Sorry, no products to display</p>";
        }
    }

    /**
     * @param $conn
     * This function is used to display new Products on the home page
     */
    public function displayNewProducts($conn)
    {
        @$sqlStatement = "SELECT NewProductD,ProductName,ProductDescription,ProductPrice,Image from newproducts";
        @$searchResult = mysqli_query($conn,$sqlStatement);
        if(mysqli_num_rows($searchResult) >0)
        {
            echo "<h1>New Arrivals</h1>";
            while ($row = mysqli_fetch_assoc($searchResult))
            {
                echo "<div class='productBox noMarginRight'>";
                    echo "<h3>".$row["ProductName"]."</h3>";
                    echo '<img src="data:image/jpeg;base64,'.base64_encode($row["Image"]).'" />';
                    echo "<p>".$row["ProductDescription"]."</p>";
                    echo "<p class='productPrice'>R".$row["Price"]."</p>";
                    echo "<form name='cart' action='' method='get'>";
                    echo "<button name='add' value='' type='submit' class='addtocart' />";
                    echo "</form>";
                echo "</div>";
            }
        }
        else{
            echo "<p id ='errors'>Sorry, no products to display</p>";
        }
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Checkout SQL functions
     */
}
?>