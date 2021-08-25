<?php
namespace classes;


class File
{

    private $src = array();

    public function upload($filePicture = array())
    {

        $count = count($filePicture['name']);

        for ($i = 0; $i < $count; $i++) {

            $maxSize = "100000000000000";
            $path = "images/";
            $allowedExt = array('jpg', 'jpeg', 'png', 'mp3', 'mp4', 'wma');


            $file = $filePicture;

            $fileName = $file['name'][$i];
            $fileTmpName = $file['tmp_name'][$i];
            $fileError = $file['error'][$i];
            $fileSize = $file['size'][$i];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = $allowedExt;

            if (!in_array($fileActualExt, $allowed)) {

                echo "You cannot upload files of this type!";

            } else {

                if ($fileError != 0) {

                    echo "There was an error uploading your file!";

                } else {

                    if ($fileSize > $maxSize) {

                        echo "Your file is too big!";

                    } else {

                        $fileNewName = time() . "_" . $fileName;

                        $this->src = $fileNewName;

                        $fileDestination = $path . $fileNewName;



                            move_uploaded_file($fileTmpName, $fileDestination);


                    }


                }

            }

        }
    }

    public function getSrc()
    {

        return  $this->src;

    }

}