
<div class="col-lg-8 col-xlg-9 col-md-12">
    <h2>CREATE ROLE</h2>
    <div class="card">

        <div class="card-body">

            <form action="create-role" method="POST" class="form-horizontal form-material">
                <div class="form-group mb-4">
                    <label class="col-md-12 p-0">Role Name</label>
                    <div class="col-md-12 border-bottom p-0">
                        <input type="text" placeholder="Role name"
                               class="form-control p-0 border-0" name="role"
                               value="<?= isset($data['roleParams']['role']) ? $data['roleParams']['role']: ""  ?>"> </div>
                </div>


                <div class="form-group mb-4">
                    <div class="col-sm-12">
                        <button class="btn btn-success" name="btnCreateRole">Create Role</button>
                        <?php
                        if (isset($data['errors'])) {

                            foreach ($data['errors'] as $error) {

                                echo "<div class='alert-warning'>". $error ."</div>";
                            }

                        }
                        ?>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>