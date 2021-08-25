<?php
$middleware = new \classes\Middleware();

if (isset($data['roles'])) :

    $number = 1;
    ?>
    <h2>Roles</h2>

    <?php if ($middleware->canCreateRole()): ?>
    <a href="create-roles-view"> <i class="fas fa-plus"><b>NEW</b></i></a>
    <?php endif; ?>

    <table class="table text-nowrap">
        <tr>
            <th>#</th>
            <th>CreatedAt</th>
            <th>UpdatedAt</th>
            <th>Role</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>

        <?php  foreach ($data['roles'] as $role) :  ?>
            <tr>
                <td> <?= $number++ ?> </td>
                <td> <?= date("F jS Y H:i", strtotime($role->created_at)) ?></td>
                <td>
                    <?php  if ($role->updated_at != null) :

                        echo date("F jS Y H:i", strtotime($role->updated_at));

                    else : echo "Not updated";

                    endif;
                    ?>
                </td>
                <td> <?= $role->role_name ?></td>
                <td>  <a href="view-role?roleID=<?= $role->id ?>"><i class="fas fa-edit"></i>  </a></td>

                <?php if ($middleware->canDeleteRole()): ?>
                <td>  <a href="delete-role?roleID=<?= $role->id ?>"><i class="fas fa-trash-alt"> </i> </a> </td>
                <?php endif; ?>

            </tr>
        <?php endforeach; ?>

    </table>


<?php

else: echo "NO ROLES";

endif;
?>