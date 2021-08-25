<?php
namespace controllers;

use classes\Template;
use models\Comment;
use models\Permission;
use models\Post;
use models\Role;
use models\RolePermission;
use models\User;
use validationPermission\PermissionRoleCreate;

class BackendController extends Controller
{



    public function index()
    {

        $template = new Template();

        $template->view('Views/pages/login.php', [
            'title' => 'Login',
        ]);

        return $template;
    }



    public function PermissionRole()
    {

        $permission = new Permission();
        $role = new Role();

        $this->data['permissions'] = $permission::all();
        $this->data['roles'] = $role::all();


        if (isset($_GET['roleID'])) {

            $roleID = $_GET['roleID'];

            $this->data['permissionRoles'] = $role::query()
                ->join('permission_roles', 'permission_roles.role_id', '=', 'roles.id')
                ->join('permissions', 'permission_id', '=', 'permissions.id')
                ->where('roles.id', $roleID)
                ->get();

        }

        $template = new Template();

        $template->view($this->layouts_path,[
            'title' => 'Permission Roles',
            'content' => $template->render_php($this->inc_path."permission_roles/all_permision_roles.php", $this->data)
        ]);

        return $template;

    }



    public function updatePermissionRole()
    {

        try {


                if (isset($_POST['submitPermissionRole'])) {

                    $rolePermission = new RolePermission();

                    if (isset($_POST['rbRole']) &&  isset($_POST['chbPermission'])) {

                        $roleID = $_POST['rbRole'];
                        $permissionID = $_POST['chbPermission'];


                    } else {

                        echo "You have to choose role name and permission";
                    }

                    $validation = new PermissionRoleCreate($_POST);
                    $this->data['errors'] = $validation->validateForm();


                    if (count($this->data['errors']) > 0) {


                        $template = new Template();

                        $template->view($this->layouts_path,[
                            'title' => 'Permission Roles',
                            'content' => $template->render_php($this->inc_path."permission_roles/all_permision_roles.php", $this->data)
                        ]);

                        return $template;


                    } else {

                        $rolePermission::query()
                            ->where('role_id', $roleID)
                            ->delete();

                        foreach ($permissionID as $value) {

                            $rolePermission::query()
                                ->insert([
                                    'role_id' => $roleID ,
                                    'permission_id' => $value,
                                ]);
                        }


                        header("Location: all-permission-roles?roleID=$roleID");

                    }


                } else {

                    echo "You have to add by click button";
                }



        } catch (\Exception $e) {

           return $this->return500();
        }

    }




    public function search()
    {

        $post = new Post();
        $user = new User();
        $comment = new Comment();

        $this->data['posts'] = $post::query()
            ->where('title', 'LIKE', '%'.$_POST['search_text'].'%')
            ->get();

        $this->data['users'] = $user::query()
            ->where('email', 'LIKE', '%'.$_POST['search_text'].'%')
            ->orWhere('first_name', 'LIKE', '%'.$_POST['search_text'].'%')
            ->orWhere('last_name', 'LIKE', '%'.$_POST['search_text'].'%')
            ->get();

        $this->data['comments'] = $comment::query()
            ->where('content', 'LIKE', '%'.$_POST['search_text'].'%')
            ->orWhere('email', 'LIKE', '%'.$_POST['search_text'].'%')
            ->get();


        $template = new Template();

        $template->view($this->layouts_path,[
            'title' => 'Searches',
            'content' => $template->render_php("Views/searches/search.php", $this->data)
        ], $this->data);

        return $template;

    }


}