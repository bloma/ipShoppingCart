<?php

class Product
{
    private $productID = 0;
    private $productName = "";
    private $productBrand = "";
    private $productPrice = 0.0;

    /**
     * @return int
     */
    public function getProductID()
    {
        return $this->productID;
    }

    /**
     * @param int $productID
     */
    public function setProductID($productID)
    {
        $this->productID = $productID;
    }

    /**
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    /**
     * @return string
     */
    public function getProductBrand()
    {
        return $this->productBrand;
    }

    /**
     * @param string $productBrand
     */
    public function setProductBrand($productBrand)
    {
        $this->productBrand = $productBrand;
    }

    /**
     * @return float
     */
    public function getProductPrice()
    {
        return $this->productPrice;
    }

    /**
     * @param float $productPrice
     */
    public function setProductPrice($productPrice)
    {
        $this->productPrice = $productPrice;
    }
}