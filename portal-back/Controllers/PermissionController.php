<?php
namespace controllers;


use classes\Template;
use models\Permission;
use validationPermission\PermissionCreate;
use validationPermission\PermissionUpdate;


class PermissionController extends Controller
{

    public function index()
    {

        $permission = new Permission();
        $this->data['permissions'] = $permission::query()->orderBy('created_at', 'DESC')->get();

        $template = new Template();

        $template->view($this->layouts_path, [
            'title' => 'Permission',
            'content' => $template->render_php($this->inc_path."permissions/all_permissions.php", $this->data)
        ]);

        return $template;

    }



    public function create()
    {
        $template = new Template();

        $template->view($this->layouts_path, [
            'title' => 'Permission Create',
            'content' => $template->render_php($this->inc_path."permissions/create_permission.php", $this->data)
        ]);

        return $template;

    }



    public function store()
    {

        try {

            if (isset($_POST['btnCreatePermission'])) {

                $valdiation = new PermissionCreate($_POST);
                $this->data['errors'] = $valdiation->validateForm();

                $name = $_POST['name'];
                $description = $_POST['description'];


                $template = new Template();

                if (count($this->data['errors']) > 0) {

                    $this->data['permissionParams'] = ['name' => $name, 'description' => $description];

                    $template->view($this->layouts_path,[
                        'title' => 'Permission create',
                        'content' => $template->render_php($this->inc_path."permissions/create_permission.php", $this->data)
                    ]);

                    return $template;

                } else {

                    $permission = new Permission();

                    $permission->name = $name;
                    $permission->description = $description;

                    $result = $permission->save();

                    if ($result) {

                        header("Location: all-permissions");

                    } else {

                        $this->data['errors'] = "An error occurred";
                        $template->view($this->layouts_path,[
                            'title' => 'Permission create',
                            'content' => $template->render_php($this->inc_path."permissions/create_permission.php", $this->data)
                        ]);

                        return $template;
                    }

                }

            } else {

                echo "You have to create permission by button click";

            }

        } catch (\Exception $e) {

            return $this->return500();

        }

    }


    public function edit()
    {

        if (isset($_GET['permissionID'])) {

            $id = $_GET['permissionID'];

            $permission = new Permission();

            $this->data['permission'] = $permission::query()
                ->where('id', $id)
                ->first();



        } else {

            return $this->return404();

        }

        $template = new Template();

        $template->view($this->layouts_path,[
            'title' => 'Permission update',
            'content' => $template->render_php($this->inc_path."permissions/permission.php", $this->data)
        ]);

        return $template;

    }



    public function update()
    {

        try {

            $permission = new Permission();
            $template = new Template();

            $name = $_POST['name'];
            $description = $_POST['description'];

            if (!isset($_GET['permissionID'])) {

                return $this->return404();

            } else {

                $id = $_GET['permissionID'];

                if (isset($_POST['btnUpdatePermission'])) {

                    $validation = new PermissionUpdate($_POST);

                    $this->data['errors'] = $validation->validateForm();


                    if (count($this->data['errors']) > 0 ) {

                        $this->data['permissionParam'] = ['name' => $name,'description' => $description , 'id' => $id];

                        $template->view($this->layouts_path,[
                            'title' => 'Permission update',
                            'content' => $template->render_php($this->inc_path."permissions/permission.php", $this->data)
                        ]);

                        return $template;

                    } else {



                        $permission::query()
                            ->where('id', $id)
                            ->update([
                                'name' => $name,
                                'description' => $description
                                ]);


                        header("Location: all-permissions");
                    }


                } else {

                    echo "You have to update permission by submit click";

                }

            }


        } catch (\Exception $e) {

            return $this->return500();

        }

    }



    public function delete()
    {

        try {

            if (!isset($_GET['permissionID'])) {

                return $this->return404();

            } else {

                $id = $_GET['permissionID'];

                $permission = new Permission();

                $permission::query()
                    ->where('id', $id)
                    ->delete();

                header("Location: all-permissions");

            }


        } catch (\Exception $e) {

            return $this->return500();

        }

    }

}