<?php
namespace controllers;

use classes\Template;
use models\Category;
use models\Post;

class Controller
{

    protected $data= [];

    public function __construct()
    {
        $post = new Post();
        $this->data['categories'] = Category::all();

        $this->data['latestTrack'] = $post::with("categories")
            ->where('posts.approved_by', '!=', null )
            ->orderBy('posts.created_at', 'DESC')->limit(30)->get();
    }


    public function returnView($view_name, $data = array())
    {

        $ext = ".php";
        $basic = "Views/";

        $direcotries = array($basic, $basic."pages/");

        foreach ($direcotries as $direcotry) {

            $full_path = $direcotry.$view_name.$ext;

            if(file_exists($full_path))

                include_once $full_path;

        }



    }


    public function badWord($badWords,$data)
    {

        $replacements = array();

        foreach ($badWords as $or) {

            array_push($replacements, str_repeat("*",strlen($or)));
        }

        $data = str_ireplace($badWords, $replacements,$data);

        return $data;
    }


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