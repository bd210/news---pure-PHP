<?php
namespace controllers;


use classes\Template;
use models\Permission;
use models\Role;
use models\User;

class LoginController extends Controller
{


    public function login()
    {

        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $user = new User();

        $result = $user::with('roles','roles.permissions')
            ->where([
                'email' => $email,
                'password' => md5($pass),
            ])
            ->where('users.role_id', '!=' , 2)
            ->first();


        if ($result) {

            $_SESSION['user'] = $result;


        } else {

            $template = new Template();

            $this->data['message'] = "Email or password is incorrect";

            $template->view('Views/pages/login.php', [
                'title' => 'Login',
            ], $this->data);

            return $template;
        }

       return $result ? header("Location: all-users") : header("Location: index.php");
    }



    public function logout()
    {

        unset($_SESSION['user']);
        unset($_SESSION['permission']);
        header("Location: index.php");


    }

}