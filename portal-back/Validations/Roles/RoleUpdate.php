<?php
namespace validationRole;



class RoleUpdate
{

    private $data;
    private $errors = [];
    private static $field = ['role'];


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


        $this->validateRole();

        return $this->errors;

    }


    private function validateRole()
    {

        $val = trim($this->data['role']);

        if (empty($val)) {

            $this->addError('role', 'Role is required');

        } else {

            if (!preg_match('/^[a-zA-Z0-9]{3,15}$/',$val)) {

                $this->addError('role' , 'Role must be 3-15 chars and alphanumeric');

            }
        }



    }



    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }

}