<?php

$middleware = new \classes\Middleware();

if (isset($data['roles']) && isset($data['permissions'])) :

    $number = 1;

    if (isset($data['success'])) {

        echo "<div class='alert-success'>". $data['success']."</div>";
    }

    ?>
    <h2>Permission Roles</h2>
    <form action="update-permission-role" method="post" >
    <table class=" text-nowrap">
        <tr>

            <th>Role</th>

        </tr>

        <?php  foreach ($data['roles'] as $role) :  ?>
            <tr>

                <td> <input type="radio" value="<?= $role->id ?>" name="rbRole"> <a href="all-permission-roles?roleID=<?= $role->id ?>"> <?= $role->role_name ?></a> </td>


            </tr>
        <?php endforeach; ?>


        <table class=" text-nowrap">
            <tr>

                <th>Permission</th>

            </tr>

            <?php

          if (isset($data['permissionRoles'])) {

              $permission_id = array();
              foreach ($data['permissionRoles'] as $per) {

                  array_push($permission_id, $per->id);
              }

          }

            foreach ($data['permissions'] as $permission) :



                ?>
                <tr>

                    <td> <input type="checkbox" name="chbPermission[]" value="<?= $permission->id ?>" <?= isset($data['permissionRoles']) && in_array($permission->id, $permission_id )  ?  'checked' :  '' ?> multiple> <?= $permission->name ?> </td>


                </tr>
            <?php

            endforeach; ?>


    </table> <br/>
    <?php if ($middleware->canUpdatePermissionRole()) :  ?>

    <input type="submit" value="Submit" name="submitPermissionRole" class="btn-dropbox"/>
    <?php
    else : echo "You dont have this permission";
    endif;
     ?>
    </form> <br/>
    <?php


    if (isset($data['errors'])) {

        foreach ($data['errors'] as $error) {

            echo "<div class='alert-warning'>". $error ."</div>";
        }

    }

    if (isset($_GET['roleID']) && isset($data['permissionRoles'])  ) : ?>

        <h4><?= isset($data['permissionRoles'][0]->role_name) ? $data['permissionRoles'][0]->role_name : "YOU HAVE TO CHOOSE ROLE NAME"; ?></h4>

      <?php  foreach ($data['permissionRoles'] as $value) :
            if ($value->name != null) :
        ?>
            <li> <?= $value->name  ?></li>

            <?php
            endif;
        endforeach;

        else : echo "CLICK ON ROLE NAME TO SEE PERMISSIONS";

        endif;
        ?>
<?php


else: echo "NO ROLES OR PERMISSIONS";

endif;
?>