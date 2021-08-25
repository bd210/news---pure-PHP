<?php

namespace commentValidation;

class CommentValidation
{

    private $data;
    private $errors = [];
    private static $field = ['content','email'];
    

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

        $this->validateContent();
        $this->validateEmail();

        return $this->errors;
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



    private function validateContent()
    {

        $val = trim($this->data['content']);

        if (empty($val)) {

            $this->addError('content', 'Comment is required');

        } else {

            if (!preg_match('/^[a-zA-Z0-9\s]{2,1000}$/',$val)) {

                $this->addError('content', 'Comment must be 2-1000 chars and alphanumberic');
            }
        }
    }



    private function addError($kev,$val)
    {

        $this->errors[$kev] = $val;

    }


}