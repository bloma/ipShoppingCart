<?php

class Customer
{
    private $customerName = "";
    private $customerSurname = "";
    private $contactNumber = "";

    public function __construct(){}

    public function getCustomerName()
    {
        return $this->customerName;
    }

    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }

    public function getCustomerSurname()
    {
        return $this->customerSurname;
    }

    public function setCustomerSurname($customerSurname)
    {
        $this->customerSurname = $customerSurname;
    }

    public function getContactNumber()
    {
        return $this->contactNumber;
    }

    public function setContactNumber($contactNumber)
    {
        $this->contactNumber = $contactNumber;
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}

?>