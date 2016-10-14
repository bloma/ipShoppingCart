<?php

class SqlFunctions
{
    public function __construct(){}
    
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
                $conn->close();
        }
    }

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
}

?>