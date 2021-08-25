<?php
namespace validationTag;

use models\Tag;

require_once "Validations/unique.php";
class TagCreate
{

    private $data;
    private $errors = [];
    private static $field = ['tag'];
    private $model;

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

        $this->model = new Tag();

        if (empty($val)) {

            $this->addError('tag', 'Tag is required');

        } else {

            if (!preg_match('/^[a-zA-Z0-9\s]{2,15}$/',$val)) {

                $this->addError('tag' , 'Tag must be 2-15 chars and alphanumeric');

            }
        }
        if (check($this->model,'keyword', $val)) {

            $this->addError('tag', 'Tag already exist');
        }


    }



    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }

}