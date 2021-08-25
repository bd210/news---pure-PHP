<?php

$middleware = new \classes\Middleware();

if (isset($data['tag']) || isset($data['tagParam'])) :


?>

    <div class="col-lg-8 col-xlg-9 col-md-12">
        <div class="card">
            <div class="card-body">

                <form action="<?= isset($data['tag']) ? 'update-tag?tagID='.$data['tag']->id : 'update-tag?tagID='.$data['tagParam']['id']  ?>" method="POST" class="form-horizontal form-material">

                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Tag Name</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" name="tag"
                                   class="form-control p-0 border-0" value="<?= isset($data['tagParam']['tag']) ? $data['tagParam']['tag'] : $data['tag']->keyword ?>"> </div>
                    </div>

                    <div class="form-group mb-4">
                        <div class="col-sm-12">

                             <?php if ($middleware->canUpdateTag()): ?>
                            <button class="btn btn-success" name="btnUpdateTag">Update Tag</button>

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

else : echo "<h2>TAG DOES NOT EXIST</h2>";

endif;
?>