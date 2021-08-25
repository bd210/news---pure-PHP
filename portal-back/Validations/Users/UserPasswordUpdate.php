<?php


namespace validationUser;


class UserPasswordUpdate
{

    private $data;
    private $errors = [];
    private static $field = ['newPassword', 'confirmNewPassword'];

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


        $this->validatePassword();


        return $this->errors;

    }




    private function validatePassword()
    {

        $new = trim($this->data['newPassword']);
        $confirm = trim($this->data['confirmNewPassword']);
        if (empty($new) || empty($confirm)) {

            $this->addError('newPassword', 'Password and Confirm Password are required');

        } elseif ($new != $confirm) {


            $this->addError('newPassword', 'Password and Confirm Password must be same');

        }  else {

            if (!preg_match('/^[a-zA-Z0-9\s]{6,20}$/', $new)) {

                $this->addError('newPassword', 'Password must be 6-20 chars and alphanumeric');
            }
        }

    }



    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }

}