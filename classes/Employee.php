<?php

class Employee
{
    private $employeeID = 0;
    private $employeeName = "";
    private $employeeSurname = "";
    private $role = "";
    private $departmentId = 0;
    private $departmentName = 0;

    /**
     * @return int
     */
    public function getEmployeeID()
    {
        return $this->employeeID;
    }

    /**
     * @param int $employeeID
     */
    public function setEmployeeID($employeeID)
    {
        $this->employeeID = $employeeID;
    }

    /**
     * @return string
     */
    public function getEmployeeName()
    {
        return $this->employeeName;
    }

    /**
     * @param string $employeeName
     */
    public function setEmployeeName($employeeName)
    {
        $this->employeeName = $employeeName;
    }

    /**
     * @return string
     */
    public function getEmployeeSurname()
    {
        return $this->employeeSurname;
    }

    /**
     * @param string $employeeSurname
     */
    public function setEmployeeSurname($employeeSurname)
    {
        $this->employeeSurname = $employeeSurname;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

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
     * @return int
     */
    public function getDepartmentName()
    {
        return $this->departmentName;
    }

    /**
     * @param int $departmentName
     */
    public function setDepartmentName($departmentName)
    {
        $this->departmentName = $departmentName;
    }
}