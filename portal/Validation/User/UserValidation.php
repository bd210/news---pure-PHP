<?php

namespace userValidation;

use models\User;

require_once "Validation/unique.php";
class UserValidation
{


    private $data;
    private $errors = [];
    private static $field = ['fname', 'lname','email', 'pass'];
    private $model;

    public function __construct($post_data)
    {

        $this->data = $post_data;

    }


    public function validateForm()
    {
        foreach (self::$field as $field)  {

            if (!array_key_exists($field,$this->data)) {

                trigger_error("$field is not present in data");
                return;
            }
        }

        $this->validateFirstName();
        $this->validateLastName();
        $this->validateEmail();
        $this->validatePassword();

        return $this->errors;
    }

    private function validateFirstName()
    {

        $val = trim($this->data['fname']);

        if (empty($val)) {

            $this->addError('fname', 'First name is required');

        } else {

            if (!preg_match('/^[a-zA-Z0-9]{3,15}$/',$val)) {

                $this->addError('fname', 'First name must be 3-15 chars and alphanumeric');
            }
        }
    }


    private function validateLastName()
    {

        $val = trim($this->data['lname']);

        if (empty($val)) {

            $this->addError('lname', 'Last name is required');

        } else {

            if (!preg_match('/^[a-zA-Z0-9\s]{4,20}$/',$val)) {

                $this->addError('lname', 'Last name must be 4-25 chars and alphanumberic');
            }
        }
    }


    private function validateEmail()
    {

        $val = trim($this->data['email']);
        $this->model = new User();

        if(empty($val)) {

            $this->addError('email', 'Email is required');

        } else {

            if (!filter_var($val,FILTER_VALIDATE_EMAIL)) {

                $this->addError('email', 'Email must be valid');
            }

        }
        if (check($this->model,'email', $val)) {

            $this->addError('email', 'Email already exist');
        }

    }

    private function validatePassword()
    {

        $val = trim($this->data['pass']);

        if (empty($val)) {

            $this->addError('pass', 'Password is required');

        } else {

            if (!preg_match('/^[a-zA-Z0-9\s]{6,20}$/', $val)) {

                $this->addError('pass', 'Password must be 6-20 chars and alphanumberic');
            }

        }
    }





    private function addError($kev,$val)
    {

        $this->errors[$kev] = $val;

    }

}