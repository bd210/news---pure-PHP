<div>
    <h2>Login</h2>
    <form action="login" method="POST">

        <div class="form-control">
            <label>Email : </label>
            <input type="text" name="email" >
        </div>

        <div class="form-control">
            <label>Password : </label>
            <input type="password" name="pass" >
        </div>

        <input type="submit" name="submitLog" value="Login" class="btn-theme">
    </form>

    <?php

        if (isset($data['messageLogin'])) {
            echo "<div class='alert-danger'>". $data['messageLogin']. "</div>";
        }

    ?>

</div>
