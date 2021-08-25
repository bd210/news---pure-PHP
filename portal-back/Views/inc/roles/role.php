<?php
$middleware = new \classes\Middleware();

if (isset($data['role']) || isset($data['roleParam'])) :

?>

<div class="col-lg-8 col-xlg-9 col-md-12">
    <div class="card">
        <div class="card-body">

            <form action="<?= isset($data['role']) ? 'update-role?roleID='.$data['role']->id : 'update-role?roleID='.$data['roleParam']['id']  ?>" method="POST" class="form-horizontal form-material">

                <div class="form-group mb-4">
                    <label class="col-md-12 p-0">Role Name</label>
                    <div class="col-md-12 border-bottom p-0">
                        <input type="text" name="role"
                               class="form-control p-0 border-0" value="<?= isset($data['roleParam']['role']) ? $data['roleParam']['role'] : $data['role']->role_name ?>"> </div>
                </div>

                <div class="form-group mb-4">
                    <div class="col-sm-12">

                         <?php if ($middleware->canUpdateRole()): ?>
                        <button class="btn btn-success" name="btnUpdateRole">Update Role</button>
                        <?php
                        else : echo "<b>You dont have this permission</b>";
                        endif;
                        ?>
                    </div>
                </div>

                <?php
                if (isset($data['errors'])) {

                    foreach ($data['errors'] as $error) {

                        echo "<div class='alert-warning'>". $error ."</div>";
                    }

                }
                ?>
            </form>
        </div>
    </div>
</div>
<?php

else : echo "<h2>ROLE DOES NOT EXIST</h2>";

endif;
?>