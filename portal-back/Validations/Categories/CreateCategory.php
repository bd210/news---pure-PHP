<?php
namespace validationCategory;


use models\Category;

require_once "Validations/unique.php";

class CreateCategory
{

    private $data;
    private $errors = [];
    private static $field = ['category'];
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


        $this->validateCategory();

        return $this->errors;

    }


    private function validateCategory()
    {

        $val = trim($this->data['category']);
        $this->model = new Category();

        if (empty($val)) {

            $this->addError('category', 'Category is required');

        } else {

            if (!preg_match('/^[a-zA-Z0-9\s]{3,15}$/',$val)) {

                $this->addError('category' , 'Category must be 3-15 chars and alphanumeric');

            }
        }
        if (check($this->model,'category_name', $val)) {

            $this->addError('category', 'Category already exist');
        }


    }



    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }

}