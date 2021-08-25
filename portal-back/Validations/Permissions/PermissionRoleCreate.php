<?php


namespace validationPermission;


class PermissionRoleCreate
{


    private $data;
    private $errors = [];
    private static $field = ['rbRole', 'chbPermission'];


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


        $this->validateRoleName();
        $this->validatePermission();


        return $this->errors;

    }


    private function validateRoleName()
    {

        $val = $this->data['rbRole'];

        if ($val == "" && !isset($val)) {

            $this->addError('rbRole', 'Role Name is required');

        }


    }


    private function validatePermission()
    {

        $val = implode(',', $this->data['chbPermission']);


        if ($val == "" && !isset($val)) {

            $this->addError('chbPermission', 'Permission is required');

        }

    }




    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }



}