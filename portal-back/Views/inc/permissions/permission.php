<?php
$middleware = new \classes\Middleware();
if (isset($data['permission']) || isset($data['permissionParam'])) :


    ?>

    <div class="col-lg-8 col-xlg-9 col-md-12">
        <div class="card">
            <div class="card-body">

                <form action="<?= isset($data['permission']) ? 'update-permission?permissionID='.$data['permission']->id : 'update-permission?permissionID='.$data['permissionParam']['id']  ?>" method="POST" class="form-horizontal form-material">

                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Name</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" name="name"
                                   class="form-control p-0 border-0" value="<?= isset($data['permissionParam']['name']) ? $data['permissionParam']['name'] : $data['permission']->name ?>"> </div>
                    </div>


                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Description</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" name="description"
                                   class="form-control p-0 border-0" value="<?= isset($data['permissionParam']['description']) ? $data['permissionParam']['description'] : $data['permission']->description ?>"> </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="col-sm-12">


                            <?php if ($middleware->canCreatePermission()): ?>
                            <button class="btn btn-success" name="btnUpdatePermission">Update Permission</button>


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

else : echo "<h2>PERMISSION DOES NOT EXIST</h2>";

endif;
?>