<?php

class Deliveries
{
    private $deliveryID = 0;
    private $distributorID = 0;
    private $customerID = 0;
    private $courierName = "";
    private $recipientName = "";
    private $deliveryAddress = "";
    private $dateDispatched = "";
    private $dateDelivered = "";
    private $totalItems = "";

    /**
     * @return int
     */
    public function getDeliveryID()
    {
        return $this->deliveryID;
    }

    /**
     * @param int $deliveryID
     */
    public function setDeliveryID($deliveryID)
    {
        $this->deliveryID = $deliveryID;
    }

    /**
     * @return int
     */
    public function getDistributorID()
    {
        return $this->distributorID;
    }

    /**
     * @param int $distributorID
     */
    public function setDistributorID($distributorID)
    {
        $this->distributorID = $distributorID;
    }

    /**
     * @return int
     */
    public function getCustomerID()
    {
        return $this->customerID;
    }

    /**
     * @param int $customerID
     */
    public function setCustomerID($customerID)
    {
        $this->customerID = $customerID;
    }

    /**
     * @return string
     */
    public function getCourierName()
    {
        return $this->courierName;
    }

    /**
     * @param string $courierName
     */
    public function setCourierName($courierName)
    {
        $this->courierName = $courierName;
    }

    /**
     * @return string
     */
    public function getRecipientName()
    {
        return $this->recipientName;
    }

    /**
     * @param string $recipientName
     */
    public function setRecipientName($recipientName)
    {
        $this->recipientName = $recipientName;
    }

    /**
     * @return string
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * @param string $deliveryAddress
     */
    public function setDeliveryAddress($deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * @return string
     */
    public function getDateDispatched()
    {
        return $this->dateDispatched;
    }

    /**
     * @param string $dateDispatched
     */
    public function setDateDispatched($dateDispatched)
    {
        $this->dateDispatched = $dateDispatched;
    }

    /**
     * @return string
     */
    public function getDateDelivered()
    {
        return $this->dateDelivered;
    }

    /**
     * @param string $dateDelivered
     */
    public function setDateDelivered($dateDelivered)
    {
        $this->dateDelivered = $dateDelivered;
    }

    /**
     * @return string
     */
    public function getTotalItems()
    {
        return $this->totalItems;
    }

    /**
     * @param string $totalItems
     */
    public function setTotalItems($totalItems)
    {
        $this->totalItems = $totalItems;
    }


}
?>