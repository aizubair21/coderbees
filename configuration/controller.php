<?php

class controller
{
    public $errOne, $errTwo, $errThree, $errFour, $errFive, $errSix, $errSeven;

    //is input empty
    public function required($property, string $errorProperty)
    {

        if (empty($property)) {
            $this->{$errorProperty} = "Field is required*";
        }
    }

    //unique method
    public function unique($uniqueProperty, string $table, string $whereFieldName, string $errorProperty)
    {

        // $qry = " SELECT * FROM $table WHERE $where = '$uniqueProperty}'";
        // $result = $this->mysqli->query($qry)->num_rows;

        $Db = new DBSelect;
        $Db->select([])->from($table)->where(" $whereFieldName = '$uniqueProperty'");
        $result = $Db->get()->num_rows;
        if ($result > 0) {
            $this->{$errorProperty} = "Already Exist !";
        }
    }

    // //valid email 
    public function isValidEmail($property, string $errorProperty)
    {
        if (!empty($property)) {
            if (filter_var($property, FILTER_VALIDATE_EMAIL)) {
                $this->{$property} = $property;
            } else {
                $this->{$errorProperty} = "Giva a valid email";
            }
        } else {
            $this->{$errorProperty} = "Field is required.";
        }
    }

    //errorShow into sebsite;
    public function isError($errorValue)
    {
        if (isset($errorValue)) {

            echo "<div><strong class='text text-danger'> $errorValue </strong></div>";
        }
    }
}
