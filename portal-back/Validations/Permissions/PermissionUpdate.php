<?php
namespace validationPermission;



class PermissionUpdate
{


    private $data;
    private $errors = [];
    private static $field = ['name', 'description'];


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


        $this->validateName();
        $this->validateDescription();


        return $this->errors;

    }


    private function validateName()
    {

        $val = trim($this->data['name']);

        if (empty($val)) {

            $this->addError('name', 'Name is required');

        } else {

            if (!preg_match('/^[a-zA-Z0-9\s]{3,30}$/',$val)) {

                $this->addError('name' , 'Name must be 3-30 chars and alphanumeric');

            }
        }



    }


    private function validateDescription()
    {

        $val = trim($this->data['description']);

        if (empty($val)) {

            $this->addError('description', 'Description is required');

        } else {

            if (!preg_match('/^[a-zA-Z0-9\s .]{5,100}$/', $val)) {

                $this->addError('description', 'Description must be 5-100 chars and alphanumeric');

            }

        }

    }




    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }

}