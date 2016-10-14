<?php

class Departments
{
    private $departmentId = 0;
    private $departmentName = "";
    private $totalEmployees = 0;

    /**
     * @return int
     */
    public function getDepartmentId()
    {
        return $this->departmentId;
    }

    /**
     * @param int $departmentId
     */
    public function setDepartmentId($departmentId)
    {
        $this->departmentId = $departmentId;
    }

    /**
     * @return string
     */
    public function getDepartmentName()
    {
        return $this->departmentName;
    }

    /**
     * @param string $departmentName
     */
    public function setDepartmentName($departmentName)
    {
        $this->departmentName = $departmentName;
    }

    /**
     * @return int
     */
    public function getTotalEmployees()
    {
        return $this->totalEmployees;
    }

    /**
     * @param int $totalEmployees
     */
    public function setTotalEmployees($totalEmployees)
    {
        $this->totalEmployees = $totalEmployees;
    }
}
?>