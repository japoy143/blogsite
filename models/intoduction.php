<?php

class Introduction
{
    // private can only be accessible by using setters and getters
    private $username;
    private $email;

    public function __construct(string $username, string $email)
    {
        $this->username =  $username;
        $this->email = $email;
    }

    //getter
    public function getEmail()
    {
        return $this->username;
    }

    public function setter(string $username)
    {
        $this->username = $username;
    }

    // Dynamic getter
    public function __get($property)
    {
        switch ($property) {
            case 'username':
                return $this->username;
            case 'email':
                return $this->email;
            default:
                throw new Exception("Property '$property' does not exist");
        }
    }
}

$intro =  new Introduction('Rainier', 'James');


//inherit
class AdminUser extends Introduction
{
    public $level;


    public function __construct($username, $email, $level)
    {
        $this->level = $level;
        parent::__construct($username, $email); // refers to the introduction class
    }
}

//show what class from
// echo '' . get_class($intro);

//accessing object
// echo $intro->username;

//accessing object email
// echo $intro->email;

//get all values in class except functions
// print_r(get_class_vars('Introduction'));

//get all functions in a class
// print_r(get_class_methods('Introduction'));



$admin = new AdminUser('sssdasdas', 'sss', 5);

echo $admin->__get('username');
echo $admin->level;
