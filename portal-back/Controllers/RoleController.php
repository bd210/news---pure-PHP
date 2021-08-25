<?php
namespace controllers;


use classes\Template;
use models\Role;
use validationRole\RoleCreate;
use validationRole\RoleUpdate;

class RoleController extends Controller
{


    public function index()
    {
        $role = new Role();
        $this->data['roles'] = $role::query()->orderBy('created_at', 'DESC')->get();

        $template = new Template();

        $template->view($this->layouts_path, [
            'title' => 'Roles',
            'content' => $template->render_php($this->inc_path."roles/all_roles.php", $this->data)
        ]);

        return $template;

    }



    public function create()
    {
        $template = new Template();

        $template->view($this->layouts_path, [
            'title' => 'Role Create',
            'content' => $template->render_php($this->inc_path."roles/create_role.php", $this->data)
        ]);

        return $template;

    }



    public function store()
    {

        try {

            if (isset($_POST['btnCreateRole'])) {

                $valdiation = new RoleCreate($_POST);
                $this->data['errors'] = $valdiation->validateForm();

                $role_name = $_POST['role'];


                $template = new Template();

                if (count($this->data['errors']) > 0) {

                    $this->data['roleParams'] = ['role' => $role_name];

                    $template->view($this->layouts_path,[
                        'title' => 'Role create',
                        'content' => $template->render_php($this->inc_path."roles/create_role.php", $this->data)
                    ]);

                    return $template;

                } else {

                    $role = new Role();

                    $role->role_name = $role_name;

                    $result = $role->save();

                    if ($result) {

                        header("Location: all-roles");

                    } else {

                        $this->data['errors'] = "An error occurred";
                        $template->view($this->layouts_path,[
                            'title' => 'Role create',
                            'content' => $template->render_php($this->inc_path."roles/create_role.php", $this->data)
                        ]);

                        return $template;
                    }

                }

            } else {

                echo "You have to create role by button click";

            }

        } catch (\Exception $e) {

            return $this->return500();

        }

    }


    public function edit()
    {

        if (isset($_GET['roleID'])) {

            $id = $_GET['roleID'];

            $role = new Role();

            $this->data['role'] = $role::query()
                ->where('id', $id)
                ->first();



        } else {

            return $this->return404();

        }

        $template = new Template();

        $template->view($this->layouts_path,[
            'title' => 'Role update',
            'content' => $template->render_php($this->inc_path."roles/role.php", $this->data)
        ]);

        return $template;

    }



    public function update()
    {

        try {

            $role = new Role();
            $template = new Template();
            $role_name = $_POST['role'];

            if (!isset($_GET['roleID'])) {

                return $this->return404();

            } else {

                    $id = $_GET['roleID'];

                if (isset($_POST['btnUpdateRole'])) {

                    $validation = new RoleUpdate($_POST);

                    $this->data['errors'] = $validation->validateForm();


                    if (count($this->data['errors']) > 0 ) {

                        $this->data['roleParam'] = ['role' => $role_name, 'id' => $id];

                        $template->view($this->layouts_path,[
                            'title' => 'Role update',
                            'content' => $template->render_php($this->inc_path."roles/role.php", $this->data)
                        ]);

                        return $template;

                    } else {



                        $role::query()
                            ->where('id', $id)
                            ->update(['role_name' => $role_name]);


                        header("Location: all-roles");
                    }


                } else {

                    echo "You have to update role by submit click";

                }

            }


        } catch (\Exception $e) {

            return $this->return500();

        }

    }



    public function delete()
    {

        try {

            if (!isset($_GET['roleID'])) {

                return $this->return404();

            } else {

                $id = $_GET['roleID'];

                $role = new Role();

                $role::query()
                    ->where('id', $id)
                    ->delete();

                header("Location: all-roles");

            }


        } catch (\Exception $e) {

            return $this->return500();

        }

    }
}