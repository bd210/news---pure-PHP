<?php
namespace controllers;

use contactValidation\ContactValidation;
use models\Category;
use models\Comment;
use models\Post;
use models\User;
use models\Visit;
use userValidation\UserValidation;

class FrontendController extends Controller
{


    public function index()
    {
        $post = new Post();


        $this->data['all'] = $post::with('files')
            ->where('approved_by' ,'!=', null)
            ->get();


        $this->data['latest'] = $post::with("categories")
            ->where('posts.approved_by', '!=', null )
            ->orderBy('posts.created_at', 'DESC')->limit(5 )->get();


        $this->data['categoriesIndex'] = Category::all();

        $this->data['business'] = $post::with( 'categories','files')
            ->where('approved_by' ,'!=', null)
            ->where('category_id', 3)
            ->orderBy('posts.created_at', 'DESC')
            ->limit(5)
            ->get();


        $this->data['sport'] = $post::with( 'categories','files')
            ->where('approved_by' ,'!=', null)
            ->where('category_id', 5)
            ->orderBy('posts.created_at', 'DESC')
            ->limit(5)
            ->get();


        $this->data['health'] = $post::with( 'categories','files')
            ->where('approved_by' ,'!=', null)
            ->where('category_id', 4)
            ->orderBy('posts.created_at', 'DESC')
            ->limit(5)
            ->get();


        $this->data['popular'] = $post::with("visits", "files")
            ->withCount('visits')
            ->orderBy("visits_count", "desc")
            ->limit(5)
            ->get();


        $template = new \classes\Template();

        $template->view('Views/layouts/layout.php', [
            'title' => 'Home',
            'content' =>  $template->render_php('Views/home.php', $this->data)
        ], $this->data);

        return $template;
    }



    public function single()
    {
        $id = $_GET['postID'];

        if ($id) {

         $post = new Post();
         $comment = new Comment();
         $visit = new Visit();



         $this->data['single'] = $post::with("categories","files", "tags", "author", "approved", "edited", "likes")
             ->where('posts.id', $id)
             ->where('approved_by', '!=', null)
             ->first();


         $this->data['comments'] = $comment::all()
             ->where('approved_comm',true)
             ->where('post_id', $id);


         $this->data['hits'] = $visit::with('posts')
                ->where('post_id' ,$id)
                ->groupBy('post_id')
                ->orderBy('post_id')
                ->count('post_id');


         $visit->visited_at = date("Y-m-d H:i:s");
         $visit->ip = $_SERVER['REMOTE_ADDR'];
         $visit->post_id = $id;

         $visit->save();

        }

        $template = new \classes\Template();

        $template->view('Views/layouts/layout.php', [
            'title' => 'Single',
            'content' => $template->render_php('Views/single.php', $this->data)
        ], $this->data);

        return $template;

    }



    public function contact()
    {

        $template = new \classes\Template();

        $template->view('Views/layouts/layout.php', [
            'title' => 'Contact',
            'content' => $template->render_php('Views/contact.php', $this->data)
        ], $this->data);

        return $template;

    }



    public function categories()
    {

        $post = new Post();
        $catID = $_GET['catID'];

        $this->data['category'] = $post::with("categories")
           ->where('approved_by', '!=', null)
           ->where('category_id','=', $catID)
           ->get();

        $template = new \classes\Template();

        $template->view('Views/layouts/layout.php', [
            'title' => 'Category',
            'content' => $template->render_php('Views/category.php', $this->data)
        ], $this->data);

        return $template;

    }


    public function registerForm()
    {
        $template = new \classes\Template();

        $template->view('Views/layouts/layout.php', [
            'title' => 'Register',
            'content' => $template->render_php('Views/register.php', $this->data)
        ], $this->data);

        return $template;
    }



    public function register()
    {
        try {

            if (isset($_POST['submitRegister'])) {

                $validation = new UserValidation($_POST);
                $this->data['errors'] = $validation->validateForm();

                $user = new User();
                $user->first_name = $_POST['fname'];
                $user->last_name = $_POST['lname'];
                $user->email = $_POST['email'];
                $password = $_POST['pass'];
                $user->role_id = 2;


                if (count($this->data['errors']) > 0 ) {

                    $this->data['params'] =['first_name' => $user->first_name, 'last_name' => $user->last_name,
                        'email' => $user->email, 'password' => $password, 'role_id' => $user->role_id];

                    $template = new \classes\Template();

                    $template->view('Views/layouts/layout.php', [
                        'title' => 'Register',
                        'content' => $template->render_php('Views/register.php', $this->data)
                    ], $this->data);

                    return $template;

                } else {

                    $user->password = md5($password);
                    $result = $user->save();

                    if ($result) {

                        header("Location: login-form");
                    } else {
                        echo "An error occurred with registration";
                    }

                }

            } else {
                echo "You have to register by submit button";
            }


        } catch (\Exception $e) {

                return  $this->return500();

        }

    }



    public function contactSend()
    {

        if (isset($_POST['submitContact'])) {


            $validation = new ContactValidation($_POST);
            $this->data['errors'] = $validation->validateForm();

            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];

            if (count($this->data['errors']) > 0 ) {

                $this->data['paramsContact'] = ['name'=> $name, 'email' => $email, 'message' => $message];

                $template = new \classes\Template();

                $template->view('Views/layouts/layout.php', [
                    'title' => 'Contact',
                    'content' => $template->render_php('Views/contact.php', $this->data)
                ], $this->data);

                return $template;

            } else {


                echo "All is correct";

            }

        } else {
            echo "You have to send message by submit click ";
        }
    }
}