<?php
namespace controllers;


use classes\Template;
use models\Role;
use models\User;
use validationUser\UserCreate;
use validationUser\UserPasswordUpdate;
use validationUser\UserUpdate;

class UserController extends Controller
{

    public function index()
    {

        $user = new User();
        $this->data['users'] = $user::with('roles')
            ->orderBy('created_at', 'DESC')
            ->get();

        $template = new Template();

        $template->view($this->layouts_path,[
            'title' => 'Users',
            'content' => $template->render_php($this->inc_path."users/all_users.php", $this->data)
        ]);

        return $template;
    }



    public function create()
    {
        $role = new Role();
        $this->data['roles'] = $role::all();

        $template = new Template();

        $template->view($this->layouts_path,[
            'title' => 'User create',
            'content' => $template->render_php($this->inc_path."users/create_user.php", $this->data)
        ]);

        return $template;

    }


    public function store()
    {

        try {

            if (isset($_POST['btnCreateUser'])) {

                $valdiation = new UserCreate($_POST);
                $this->data['errors'] = $valdiation->validateForm();

                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $role = $_POST['role'];


                $template = new Template();

                if (count($this->data['errors']) > 0) {

                    $role = new Role();
                    $this->data['roles'] = $role::all();

                    $this->data['userParams'] = ['fname' => $fname, 'lname' => $lname,
                        'email' => $email, 'pass' => $pass, 'role' => $role];

                    $template->view($this->layouts_path,[
                        'title' => 'User create',
                        'content' => $template->render_php($this->inc_path."users/create_user.php", $this->data)
                    ]);

                    return $template;

                } else {

                    $user = new User();

                    $user->first_name = $fname;
                    $user->last_name = $lname;
                    $user->password = md5($pass);
                    $user->email = $email;
                    $user->role_id = $role;

                    $result = $user->save();

                    if ($result) {

                        header("Location: all-users");

                    } else {

                        $this->data['errors'] = "An error occurred";
                        $template->view($this->layouts_path,[
                            'title' => 'User create',
                            'content' => $template->render_php($this->inc_path."users/create_user.php", $this->data)
                        ]);

                        return $template;
                    }

                }

            } else {
                echo "You have to create user by submit click";
            }

        } catch (\Exception $e) {

            return $this->return500();

        }
    }



    public function edit()
    {
        if (isset($_GET['userID'])) {

            $id = $_GET['userID'];
            $user = new User();

            $role = new Role();

            $this->data['roles'] = $role::all();

            $this->data['user'] = $user::with('roles')
                ->where('id', $id)
                ->first();

        } else {

            return $this->return404();

        }


        $template = new Template();

        $template->view($this->layouts_path,[
            'title' => 'User profile',
            'content' => $template->render_php($this->inc_path."users/profile.php", $this->data)
        ]);

        return $template;

    }


    public function update()
    {
        try {

            $user = new User();

            if (!isset($_GET['userID'])) {

                return $this->return404();

            } else {

                $id = $_GET['userID'];

                $validation = new UserUpdate($_POST);
                $this->data['errors'] = $validation->validateForm();

                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $email = $_POST['email'];
                $role = $_POST['role'];

                if (isset($_POST['btnUpdateProfile'])) {


                    if (count($this->data['errors']) > 0) {

                        $_SESSION['errorValidation'] = $this->data['errors'];

                        header("Location: view-user-profile?userID=$id");

                    } else {



                        $user::query()
                            ->where('id', $id)
                            ->update([
                                'first_name' => $fname,
                                'last_name' => $lname,
                                'email' => $email,
                                'role_id' => $role,
                                'updated_at' => date("Y-m-d H:i:s")
                            ]);

                        header("Location: view-user-profile?userID=$id");



                     }


                } elseif (isset($_POST['btnUpdatePassword'])) {

                    $newPass = $_POST['newPassword'];
                    $confirmNewPass = $_POST['confirmNewPassword'];

                    $validation = new UserPasswordUpdate($_POST);
                    $this->data['errors'] = $validation->validateForm();


                    if (count($this->data['errors']) > 0) {


                        $_SESSION['userPasswordValidationError'] = $this->data['errors'];
                        header("Location: view-user-profile?userID=$id");

                    } else {

                        $user::query()
                            ->where('id', $id)
                            ->update(['password' => md5($newPass)]);

                        header("Location: view-user-profile?userID=$id");
                    }


                } else {

                    echo "You have to update user by click button";

                }



            }

        } catch (\Exception $e) {

            return $this->return500();

        }
    }



    public function delete()
    {
        try {

            if (isset($_GET['userID'])) {


                $id = $_GET['userID'];

                $user = new User();
                $user::query()
                    ->where('id', $id)
                    ->delete();

                header("Location: all-users");

            } else {

                return $this->return404();

            }
        } catch (\Exception $e) {

            return $this->return500();

        }
    }

}
