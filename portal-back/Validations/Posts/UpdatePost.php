<?php
namespace validationPost;


class UpdatePost
{


    private $data;
    private $errors = [];
    private static $field = ['title', 'content', 'category'];


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


        $this->validateTitle();
        $this->validateContent();
        $this->validateCategory();
        return $this->errors;

    }





    private function validateTitle()
    {

        $val = trim($this->data['title']);

        if (empty($val)) {

            $this->addError('title', 'Title is required');

        } else {

            if (!preg_match('/^[a-zA-Z0-9\s]{3,20}$/',$val)) {

                $this->addError('title' , 'Title must be 3-20 chars and alphanumeric');

            }


        }





    }


    private function validateContent()
    {

        $val = trim($this->data['content']);

        if (empty($val) ) {

            $this->addError('content', 'Content is required');

        } else {

            if (!preg_match('/^[a-zA-Z0-9\s]{5,}$/',$val)) {

                $this->addError('content' , 'Content must be min 5 chars and alphanumeric');

            }
        }


    }

    private function validateFile()
    {

        $val = trim($this->data['file']['tmp_name']);

        if ($val == "") {

            $this->addError('file', 'Files is required');

        }

    }


    private function validateCategory()
    {

        $val = trim($this->data['category']);

        if (empty($val) || $val == 0) {

            $this->addError('category', 'Category is required');

        }

    }




    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }


}