<?php
namespace classes;


class Middleware
{

    private $permission_name = array();

    public function __construct()
    {
       if (isset($_SESSION['user'])) {

           foreach ($_SESSION['user']['roles']['permissions'] as $permission) {

               array_push( $this->permission_name, $permission->name);
           }

       }

    }




    public function issetUser () {

        if (isset($_SESSION['user']))
            return true;
        else
            return false;

    }




    public  function canCreatePost()
    {

        if (in_array('Create Post', $this->permission_name))
            return true;
        else
            return false;

    }



    public  function canDeletePost()
    {

        if (in_array('Delete Post', $this->permission_name))
            return true;
        else
            return false;

    }




    public  function canUpdatePost()
    {

        if (in_array('Update Post', $this->permission_name))
            return true;
        else
            return false;

    }



    public  function canApprovePost()
    {

        if (in_array('Approve Post', $this->permission_name))
            return true;
        else
            return false;

    }



    public  function canCreateUser()
    {

        if (in_array('Create User', $this->permission_name))
            return true;
        else
            return false;

    }



    public  function canDeleteUser()
    {

        if (in_array('Delete User', $this->permission_name))
            return true;
        else
            return false;

    }



    public  function canUpdateUser()
    {

        if (in_array('Update User', $this->permission_name))
            return true;
        else
            return false;

    }



    public  function canCreateRole()
    {

        if (in_array('Create Role', $this->permission_name))
            return true;
        else
            return false;

    }




    public  function canDeleteRole()
    {

        if (in_array('Delete Role', $this->permission_name))
            return true;
        else
            return false;

    }




    public  function canUpdateRole()
    {

        if (in_array('Update Role', $this->permission_name))
            return true;
        else
            return false;

    }




    public  function canCreateTag()
    {

        if (in_array('Create Tag', $this->permission_name))
            return true;
        else
            return false;

    }




    public  function canDeleteTag()
    {

        if (in_array('Delete Tag', $this->permission_name))
            return true;
        else
            return false;

    }




    public  function canUpdateTag()
    {

        if (in_array('Update Tag', $this->permission_name))
            return true;
        else
            return false;

    }




    public  function canCreateCategory()
    {

        if (in_array('Create Category', $this->permission_name))
            return true;
        else
            return false;

    }




    public  function canDeleteCategory()
    {

        if (in_array('Delete Category', $this->permission_name))
            return true;
        else
            return false;

    }




    public  function canUpdateCategory()
    {

        if (in_array('Update Category', $this->permission_name))
            return true;
        else
            return false;

    }




    public  function canCreateForbiddenWord()
    {

        if (in_array('Create Forbidden Word', $this->permission_name))
            return true;
        else
            return false;

    }




    public  function canDeleteForbiddenWord()
    {

        if (in_array('Delete Forbidden Word', $this->permission_name))
            return true;
        else
            return false;

    }




    public  function canUpdateForbiddenWord()
    {

        if (in_array('Update Forbidden Word', $this->permission_name))
            return true;
        else
            return false;

    }




    public  function canCreatePermission()
    {

        if (in_array('Create Permission', $this->permission_name))
            return true;
        else
            return false;

    }




    public  function canDeletePermission()
    {

        if (in_array('Delete Permission', $this->permission_name))
            return true;
        else
            return false;

    }





    public  function canUpdatePermission()
    {

        if (in_array('Update Permission', $this->permission_name))
            return true;
        else
            return false;

    }




    public function canDeleteComment()
    {
        if (in_array('Delete Comment', $this->permission_name))
            return true;
        else
            return false;
    }




    public function canUpdatePermissionRole()
    {
        if (in_array('Update PermissionRole', $this->permission_name))
            return true;
        else
            return false;
    }


    public function canDeleteFile()
    {
        if (in_array('Delete File', $this->permission_name))
            return true;
        else
            return false;
    }

}