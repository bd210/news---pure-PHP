<?php
namespace controllers;

use models\Like;
use models\Role;
use models\User;

class LoginController extends Controller
{



    public function viewLogin()
    {
        $template = new \classes\Template();

        $template->view('Views/layouts/layout.php', [
            'title' => 'Login',
            'content' => $template->render_php('Views/login.php', $this->data)
        ], $this->data);

        return $template;
    }


    public function login()
    {
        $user = new User();


        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $result = $user::with('roles','roles.permissions')
            ->where([
                'email' => $email,
                'password' => md5($pass),
            ])
            ->where('users.role_id', '!=' , 2)
            ->first();


        if ($result) {

            $_SESSION['user'] = $result;

            if (isset($_GET['postID'])) {

                try {
                    $postID = $_GET['postID'];

                    $likes = new Like();
                    $likes->post_id = $postID;
                    $likes->user_id = $_SESSION['user']->id;

                    $likes->save();

                } catch (\Exception $e) {

                    return $this->return500();
                }

            }

            header("Location: index.php");

        } else {

            $this->data['messageLogin'] = "Email or password is incorrect";
            $template = new \classes\Template();

            $template->view('Views/layouts/layout.php', [
                'title' => 'Login',
                'content' => $template->render_php('Views/login.php', $this->data)
            ], $this->data);

            return $template;
        }
    }


    public function logout()
    {
        unset($_SESSION['user']);
        header("Location: index.php");
    }

}