<?php

namespace contactValidation;

class ContactValidation
{


    private $data;
    private $errors = [];
    private static $field = ['name', 'email', 'message'];


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

        $this->validateName();
        $this->validateMessage();
        $this->validateEmail();


        return $this->errors;
    }

    private function validateName()
    {

        $val = trim($this->data['name']);

        if (empty($val)) {

            $this->addError('name', 'Name is required');

        } else {

            if (!preg_match('/^[a-zA-Z0-9]{3,15}$/',$val)) {

                $this->addError('name', 'Name must be 3-15 chars and alphanumberic');
            }
        }
    }




    private function validateEmail()
    {

        $val = trim($this->data['email']);

        if(empty($val)) {

            $this->addError('email', 'Email is required');

        } else {

            if (!filter_var($val,FILTER_VALIDATE_EMAIL)) {

                $this->addError('email', 'Email must be valid');
            }

        }

    }



    private function validateMessage()
    {

        $val = trim($this->data['message']);

        if (empty($val)) {

            $this->addError('message', 'Message is required');

        } else {

            if (!preg_match('/^[a-zA-Z0-9\s]{4,20}$/',$val)) {

                $this->addError('message', 'Message must be 4-1000 chars and alphanumberic');
            }
        }
    }



    private function addError($kev,$val)
    {

        $this->errors[$kev] = $val;

    }


}