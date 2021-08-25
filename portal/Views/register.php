<form action="register" method="POST" style="text-align: center">

    <div class="form-group">
        <label>First Name : </label> <br/>
        <input type="text" name="fname" value="<?= isset($data['params']['first_name']) ? $data['params']['first_name'] : "" ?>" />
    </div>


    <div class="form-group">
        <label>Last Name : </label><br/>
        <input type="text" name="lname" value="<?= isset($data['params']['last_name']) ? $data['params']['last_name'] : "" ?>" >
    </div>

    <div class="form-group">
        <label>Email : </label><br/>
        <input type="text" name="email"  value="<?= isset($data['params']['email']) ? $data['params']['email'] : "" ?>">
    </div>

    <div class="form-group">
        <label>Password : </label><br/>
        <input type="password" name="pass"  value="<?= isset($data['params']['password']) ? $data['params']['password'] : "" ?>">
    </div>

    <input type="submit" value="Create" class="btn-theme" name="submitRegister">

</form>
<?php

    if (isset($data['errors'])) {

        foreach ($data['errors'] as $error) {

            echo "<div class='alert-danger'>". $error ."</div>";
        }
    }

?>