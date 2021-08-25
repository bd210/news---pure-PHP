<?php

$middleware = new \classes\Middleware();

if (isset($data['users'])) :

$number = 1;

if (isset($data['success'])) {

        foreach ($data['success'] as $success) {

            echo "<div class='alert-success'>". $success . "</div>";
        }

    }

?>
        <h2>Users</h2>

         <?php if ($middleware->canCreateUser()): ?>
        <a href="create-users-view"> <i class="fas fa-plus"><b>NEW</b></i></a>
        <?php endif; ?>

        <table class="table text-nowrap" >
            <tr>
                <th>#</th>
                <th>CreatedAt</th>
                <th>UpdatedAt</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Edit</th>
                <th>Delete</th>

            </tr>

        <?php  foreach ($data['users'] as $user) :  ?>
            <tr>
                <td> <?= $number++ ?> </td>
                <td> <?= date("F jS Y H:i", strtotime($user->created_at)) ?></td>
                <td>
                    <?php  if ($user->updated_at != null) :

                        echo date("F jS Y H:i", strtotime($user->updated_at));

                    else : echo "Not updated";

                    endif;
                    ?>
                </td>
                <td><a href="view-user-profile?userID=<?= $user->id ?>"> <?= $user->first_name . " " . $user->last_name ?>  </a> </td>
                <td> <?= $user->email ?></td>
                <td> <?= $user['roles']->role_name ?></td>
                <td>  <a href="view-user-profile?userID=<?= $user->id ?>"><i class="fas fa-edit"></i>  </a></td>

                <?php if ($middleware->canDeleteUser()): ?>
                <td>  <a href="delete-user?userID=<?= $user->id ?>"><i class="fas fa-trash-alt"> </i> </a> </td>
                <?php endif; ?>

            </tr>
        <?php endforeach; ?>

        </table>


<?php

   else: echo "NO USERS";

   endif;
?>