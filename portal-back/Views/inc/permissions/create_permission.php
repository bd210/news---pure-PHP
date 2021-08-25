
<div class="col-lg-8 col-xlg-9 col-md-12">
    <h2>CREATE PERMISSION</h2>
    <div class="card">

        <div class="card-body">

            <form action="create-permission" method="POST" class="form-horizontal form-material">
                <div class="form-group mb-4">
                    <label class="col-md-12 p-0">Name</label>
                    <div class="col-md-12 border-bottom p-0">
                        <input type="text" placeholder="Permission Name"
                               class="form-control p-0 border-0" name="name"
                               value="<?= isset($data['permissionParams']['name']) ? $data['permissionParams']['name']: ""  ?>"> </div>
                </div>

                <div class="form-group mb-4">
                    <label class="col-md-12 p-0">Description</label>
                    <div class="col-md-12 border-bottom p-0">
                        <input type="text" placeholder="Permission Description"
                               class="form-control p-0 border-0" name="description"
                               value="<?= isset($data['permissionParams']['description']) ? $data['permissionParams']['description']: ""  ?>"> </div>
                </div>

                <div class="form-group mb-4">
                    <div class="col-sm-12">
                        <button class="btn btn-success" name="btnCreatePermission">Create Permission</button>
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