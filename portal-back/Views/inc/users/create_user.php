

<div class="col-lg-8 col-xlg-9 col-md-12">
<h2>CREATE USER</h2>
    <div class="card">

        <div class="card-body">

            <form action="create-user" method="POST" class="form-horizontal form-material">
                <div class="form-group mb-4">
                    <label class="col-md-12 p-0">First Name</label>
                    <div class="col-md-12 border-bottom p-0">
                        <input type="text" placeholder="First name"
                               class="form-control p-0 border-0" name="fname"
                               value="<?= isset($data['userParams']['fname']) ? $data['userParams']['fname']: ""  ?>"> </div>
                </div>

                <div class="form-group mb-4">
                    <label class="col-md-12 p-0">Last Name</label>
                    <div class="col-md-12 border-bottom p-0">
                        <input type="text" placeholder="Last name"
                               class="form-control p-0 border-0" name="lname"
                               value="<?= isset($data['userParams']['lname']) ? $data['userParams']['lname']: ""  ?>"> </div>
                </div>

                <div class="form-group mb-4">
                    <label for="example-email" class="col-md-12 p-0">Email</label>
                    <div class="col-md-12 border-bottom p-0">
                        <input type="email" placeholder="example@gmail.com"
                               class="form-control p-0 border-0" name="email"
                               id="example-email"
                               value="<?= isset($data['userParams']['email']) ? $data['userParams']['email']: ""  ?>">
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label class="col-md-12 p-0">Password</label>
                    <div class="col-md-12 border-bottom p-0">
                        <input type="password" placeholder="Password" class="form-control p-0 border-0" name="pass"
                               value="<?= isset($data['userParams']['pass']) ? $data['userParams']['pass']: ""  ?>">
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label class="col-sm-12">Role</label>

                    <div class="col-sm-12 border-bottom">
                        <select class="form-select shadow-none p-0 border-0 form-control-line" name="role">
                            <option value="0">Choose role...</option>
                           <?php if (isset($data['roles'])) :

                                    foreach ($data['roles'] as $role) :
                            ?>
                            <option  value="<?= $role->id ?>"> <?= $role->role_name ?></option>

                           <?php
                                    endforeach;

                                else : echo "NO ROLES";
                                endif;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <div class="col-sm-12">
                        <button class="btn btn-success" name="btnCreateUser">Create User</button>
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