<?php
namespace validationUser;



class UserUpdate
{

    private $data;
    private $errors = [];
    private static $field = ['fname', 'lname', 'email','role'];

    public function __construct($post_data)
    {
        $this->data = $post_data;
    }


    public function validateForm()
    {

        foreach (self::$field as $field) {

            if (!array_key_exists($field, $this->data)) {

                trigger_error("$field is not present in data");
                return;
            }

        }


        $this->validateFName();
        $this->validateLName();
        $this->validateEmail();
        $this->validateRole();

        return $this->errors;

    }


    private function validateFName()
    {

        $val = trim($this->data['fname']);

        if (empty($val)) {

            $this->addError('fname', 'First name is required');

        } else {

            if (!preg_match('/^[a-zA-Z0-9]{3,15}$/',$val)) {

                $this->addError('fname' , 'First name must be 3-15 chars and alphanumeric');

            }
        }


    }


    private function validateLName()
    {

        $val = trim($this->data['lname']);

        if (empty($val)) {

            $this->addError('lname', 'Last name is required');

        } else {

            if (!preg_match('/^[a-zA-Z0-9\s]{4,25}$/', $val)) {

                $this->addError('lname', 'Last name must be 4-25 chars and alphanumeric');

            }

        }

    }


    private function validateEmail()
    {

        $val = trim($this->data['email']);

        if (empty($val)) {

            $this->addError('email', 'Email is required');

        } else {

            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {

                $this->addError('email', 'Email must be valid');

            }

        }

    }



    private function validateRole()
    {

        $val = trim($this->data['role']);

        if (empty($val) || $val == 0) {

            $this->addError('role', 'Role is required');

        }

    }

    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }

}