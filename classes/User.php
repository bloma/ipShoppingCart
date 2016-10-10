<?php
class User
{
    private $userName = "";
    private $password = "";
    private $accountType = "";

    public function __construct(){}

    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getAccountType()
    {
        return $this->accountType;
    }

    public function setAccountType($accountType)
    {
        $this->accountType = $accountType;
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }


}

?>