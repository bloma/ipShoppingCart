<?php

class Orders
{
    private $orderID = 0;
    private $customerID = 0;
    private $productId = 0;
    private $customerName = "";
    private $customerSurname = "";
    private $quantity = 0;
    private $orderDate = "";
    private $totalCost = 0.0;

    /**
     * @return int
     */
    public function getOrderID()
    {
        return $this->orderID;
    }

    /**
     * @param int $orderID
     */
    public function setOrderID($orderID)
    {
        $this->orderID = $orderID;
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
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return string
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * @param string $customerName
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }

    /**
     * @return string
     */
    public function getCustomerSurname()
    {
        return $this->customerSurname;
    }

    /**
     * @param string $customerSurname
     */
    public function setCustomerSurname($customerSurname)
    {
        $this->customerSurname = $customerSurname;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * @param int $orderDate
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;
    }

    /**
     * @return int
     */
    public function getTotalCost()
    {
        return $this->totalCost;
    }

    /**
     * @param int $totalCost
     */
    public function setTotalCost($totalCost)
    {
        $this->totalCost = $totalCost;
    }

    public function calculateTotalCost($amount)
    {
        return $this->totalCost +=$amount;
    }
}
?>