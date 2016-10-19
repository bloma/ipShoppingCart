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

    public function registerUser($conn,$emailAddress,$hashedPassword,$accType,$userID,$firstName,$surname,$contactNumber)
    {
        $sqlUserInsert = "insert into users (username, password,accountType) values ('$emailAddress','$hashedPassword','$accType')";
        if(mysqli_query($conn,$sqlUserInsert))
        {
            $sqlUserSelect = "select userID from users where username = '$emailAddress'";
            $userIDResult = mysqli_query($conn,$sqlUserSelect);
            if (mysqli_num_rows($userIDResult) > 0)
            {
                $row = mysqli_fetch_assoc($userIDResult);
                $userID = $row['userID'];
            }
            else{
                echo "SQL error ".mysqli_error($conn);
            }
            $sqlCustomer = "insert into customers (userID, customerName,customerSurname,customerTelephone) values ($userID,'$firstName','$surname','$contactNumber')";
            if(mysqli_query($conn,$sqlCustomer))
            {
                @mail($emailAddress,"Registration on AXI's Sneakers","Hi $firstName $surname\nWelcome to AXI's sneakers you have successfully registered on our service\nRegards AXI team","From: noreply@axi.co.za");
                header("location: ../index.php");
            }
            else{
                echo "SQL error ".mysqli_error($conn);
            }
        }
    }

    /**
     * @param $conn
     * @param $newPassword
     * @param $email
     * This function is used to reset a users password
     */

    public function resetPassword($conn,$newPassword, $email)
    {
        $sqlQueryUpdate = "UPDATE USERS set Password = '$newPassword' WHERE UserName = '$email'";
        try{
            mysqli_query($conn,$sqlQueryUpdate);
        }catch (Exception $e)
        {
            $e->getMessage();
        }
    }

    /**
     * @param $conn
     * @param $newPassword
     * @param $email
     * This function is used to update a users password
     */

    public function updatePassword($conn,$newPassword,$email)
    {
        $sqlQueryUpdate = "UPDATE USERS set Password = '$newPassword' WHERE UserName = '$email'";
        try{
            mysqli_query($conn,$sqlQueryUpdate);
        }catch (Exception $e)
        {
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
        for($i = 0; $i< 8; $i++)
        {
            $n = rand(0,$charLength);
            $password[] = $validCharacters[$n];
        }
        return implode($password);
    }

    /**
     * @param $conn
     * @param $name
     * This function is used to display user details on their profile page
     */
    public function displayUserDetails($conn,$name)
    {
        $sqlStatementSelectCustomerDetails = "Select * from customers WHERE CustomerName = '$name'";


    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Reports functions
     * These functions are used to generate reports
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
            echo "<table border='1'><tr><th>Delivery ID</th><th>Distributor ID</th><th>Customer ID</th><th>Courier</th><th>Recipient</th><th>Delivery Address</th><th>Date Dispatched</th><th>Date Delivered</th><th>Total Items</th></tr>";
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr><td>".$row["DeliveryID"]."</td><td>".$row["DistributorID"]."</td><td>".$row["CustomerID"]."</td><td>".$row["CourierName"]."</td><td>".$row["RecipientName"]."</td><td>".$row["DeliveryAddress"]."</td><td>".$row["DateDespatched"]."</td><td>".$row["DateDelivered"]."</td><td>".$row["totalItems"]."</td></tr>";
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
                echo "<tr><td>".$rowProducts["ProductID"]."</td><td>".$rowProducts["BrandID"]."</td><td>".$rowProducts["SupplierID"]."</td><td>".$rowProducts["ProductName"]."</td><td>".$rowProducts["ProductDescription"]."</td><td>".$rowProducts["Price"]."</td><td>".$rowProducts["InStock"]."</td><td>".$rowProducts["Quantity"]."</td></tr>";
            }
            echo "</table>";
        }
        else
        {
            echo "<p id='errors'>No results</p>";
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Database control functions
     * These functions are used to update stock and add new products,users,brands,employees and so forth
     */

}

?>