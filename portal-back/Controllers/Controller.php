<?php
namespace controllers;


use classes\Template;

class Controller
{
    protected $data = [];
    protected $layouts_path = "Views/layouts/layout.php";
    protected $inc_path = "Views/inc/";



    public function return404()
    {

        $template = new Template();

        $template->view("Views/layouts/error.php",[
            'title' => 'Not Found Error',
            'content' => $template->render_php("Views/errors/404.php", $this->data)
        ], $this->data);

        return $template;

    }


    public function return500()
    {

        $template = new Template();

        $template->view("Views/layouts/error.php",[
            'title' => 'Internal Server Error',
            'content' => $template->render_php("Views/errors/500.php", $this->data)
        ], $this->data);

        return $template;


    }

}