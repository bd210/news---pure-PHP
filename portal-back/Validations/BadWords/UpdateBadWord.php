<?php
namespace validationBadWord;



class UpdateBadWord
{


    private $data;
    private $errors = [];
    private static $field = ['word'];


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


        $this->validateBadWord();

        return $this->errors;

    }


    private function validateBadWord()
    {

        $val = trim($this->data['word']);

        if (empty($val)) {

            $this->addError('word', 'Forbidden Word is required');


        } else {

            if (!preg_match('/^[a-zA-Z0-9\s]{3,20}$/',$val)) {

                $this->addError('word' , 'Forbidden Word must be 3-20 chars and alphanumeric');
            }
        }



    }



    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }

}