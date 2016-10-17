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
                mail($emailAddress,"Registration on AXI's Sneakers","Hi $firstName $surname\nWelcome to AXI's sneakers you have successfully registered on our service\nRegards AXI team","From: noreply@axi.co.za");
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

    //////////////////////////////////////////////////

    /**
     * Reports functions
     * These functions are used to generate reports
     */

    public function customerReport()
    {

    }

    public function userReport()
    {

    }

    public function stockReport()
    {

    }

    public function orderHistoryReport()
    {

    }

    public function brandsReport()
    {

    }

    public function distributorsReport()
    {

    }

    public function deliveriesReport()
    {

    }

    public function staffReport()
    {

    }

    public function departmentsReport()
    {

    }

    public function suppliersReport()
    {

    }

    //////////////////////////////////////////////////

    /**
     * Database control functions
     * These functions are used to update stock and add new products,users,brands,employees and so forth
     */

}

?>