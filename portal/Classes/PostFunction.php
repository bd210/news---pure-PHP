<?php
namespace classes;


class PostFunction
{


    public  static function returnFirstImg( $files = array())
    {

        $images = array('png', 'jpg', 'jpeg');


        foreach ($files as $file) {

            $ext = pathinfo($file->file_name, PATHINFO_EXTENSION);

            if (in_array($ext, $images)) {

                return  $file->file_name ;

            }


        }


    }

}