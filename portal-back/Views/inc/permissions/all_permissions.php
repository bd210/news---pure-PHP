<?php
$middleware = new \classes\Middleware();
if (isset($data['permissions'])) :

    $number = 1;
    ?>
    <h2>Permissions</h2>
    <?php if ($middleware->canCreatePermission()): ?>
    <a href="create-permissions-view"> <i class="fas fa-plus"><b>NEW</b></i></a>
    <?php endif;  ?>
    <table class="table text-nowrap">
        <tr>
            <th>#</th>
            <th>CreatedAt</th>
            <th>UpdatedAt</th>
            <th>Name</th>
            <th>Description</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>

        <?php  foreach ($data['permissions'] as $permission) :  ?>
            <tr>
                <td> <?= $number++ ?> </td>
                <td> <?= date("F jS Y H:i", strtotime($permission->created_at)) ?></td>
                <td>
                    <?php  if ($permission->updated_at != null) :

                        echo date("F jS Y H:i", strtotime($permission->updated_at));

                    else : echo "Not updated";

                    endif;
                    ?>
                </td>
                <td> <?= $permission->name ?></td>
                <td> <?= $permission->description ?></td>
                <td>  <a href="view-permission?permissionID=<?= $permission->id ?>"><i class="fas fa-edit"></i>  </a></td>

                 <?php if ($middleware->canCreatePermission()): ?>
                <td>  <a href="delete-permission?permissionID=<?= $permission->id ?>"><i class="fas fa-trash-alt"> </i> </a> </td>
                 <?php endif; ?>
            </tr>
        <?php endforeach; ?>

    </table>


<?php

else: echo "NO PERMISSIONS";

endif;
?>