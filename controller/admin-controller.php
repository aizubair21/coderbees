<?php

include "../configuration/controller.php";
include "../configuration/QueryHandeler.php";

class adminController extends controller
{

    protected $name, $email, $phone, $password, $status, $address, $valueOne, $valueTwo, $valueThree, $valueFour, $valueFive;
    public $nameErr, $emailErr, $phoneErr, $passwordErr, $addressErr, $valueOneErr, $valueTwoErr, $valueThreeErr, $valueFourErr, $valueFiveErr;


    //seter method
    public function name($name)
    {
        $this->name = $name;
    }
    public function email($email)
    {
        $this->email = $email;
        $this->required($email, 'emailErr');
    }
    public function phone($phone)
    {
        $this->phone = $phone;
    }
    public function password($password)
    {
        $this->password = $password;
        $this->required($password, 'passwordErr');
    }
    public function status($status)
    {
        $this->status = $status;
    }
    public function address($address)
    {
        $this->address = $address;
    }
    public function valueOne($valueOne)
    {
        $this->valueOne = $valueOne;
    }
    public function valueTwo($valueTwo)
    {
        $this->valueTwo = $valueTwo;
    }
    public function valueThree($valueThree)
    {
        $this->valueThree = $valueThree;
    }
    public function valueFour($valueFour)
    {
        $this->valueFour = $valueFour;
    }
    public function valueFive($valueFive)
    {
        $this->valueFive = $valueFive;
    }



    //login method
    public function login()
    {
        if ((empty($this->emailErr)  &&  !empty($this->email)) && (empty($this->passwordErr)  &&  !empty($this->password))) {

            $db = new DBSelect;
            $result = $db->select([])->from('admin')->get();
            $count = $result->num_rows;
            $row = $result->fetch_assoc();
            echo "Admin password : " . $row["adminPassword"];

            if ($count == 1) {

                $db_password = $row['adminPassword'];
                if (password_verify($this->password, $db_password)) {
                    $_SESSION["admin_key"] = $row["adminId"];
                    return 'success';
                } else {
                    $this->passwordErr = "Password not matched !";
                }
            } else {
                $this->emailErr = "Email not register yet. <a class='text text-info' href='register.php'> register now</a>";
            }
        } else {
            return "Fill al required field";
        }
    }


    //register 
    public function register()
    {
    }


    //post Approve
    //method take a post id. that will be updated.
    public function approve($id)
    {
        // echo $id;
        if (isset($id)) {

            $update = new DBUpdate;
            $give_status = 1;
            $update->on('posts')->set(['postStatus'])->value([$give_status])->where("postId = '$id'");
            $result = $update->go();
            return $result;
        }
    }

    //post_reject
    public function post_reject($id)
    {
        if (isset($id)) {

            $delete = new DBDelete;
            $delete->from('posts')->where("publisherId = '$id'");
            $result = $delete->go();
            echo $result;
        }
    }

    //post block


    //post unapprove



    //unblock publisher
    public function unblock_publisher($id)
    {
        if (isset($id)) {

            $update = new DBUpdate;
            $give_status = 1;
            $update->on('publisher')->set(['publisherStatus'])->value([$give_status])->where("publisherId = '$id'");
            $result = $update->go();
            echo $result;
        }
    }


    //block publisher
    public function block_publisher($id)
    {
        if (isset($id)) {

            $update = new DBUpdate;
            $give_status = 0;
            $update->on('publisher')->set(['publisherStatus'])->value([$give_status])->where("publisherId = '$id'");
            $result = $update->go();
            echo $result;
        }
    }


    //delete publisher
    public function delete_publisher($id)
    {
        if (isset($id)) {

            $delete = new DBDelete;
            $delete->from('publisher')->where("publisherId = '$id'");
            $result = $delete->go();
            echo $result;
        }
    }


    //update publisher
    public function update_publisher($id)
    {
    }
}
