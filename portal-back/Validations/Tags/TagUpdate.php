<?php
namespace validationTag;



class TagUpdate
{

    private $data;
    private $errors = [];
    private static $field = ['tag'];

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


        $this->validateTag();

        return $this->errors;

    }


    private function validateTag()
    {

        $val = trim($this->data['tag']);


        if (empty($val)) {

            $this->addError('tag', 'Tag is required');

        } else {

            if (!preg_match('/^[a-zA-Z0-9\s]{2,15}$/',$val)) {

                $this->addError('tag' , 'Tag must be 2-15 chars and alphanumeric');

            }
        }



    }



    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }

}