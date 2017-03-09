<?php

class Employee extends AbstractModel 
{
    protected static $dir = ROOT.'/data/employee_data.json';
    public static $fields = ['name', 'designation', 'gender'];

}