<?php
$middleware = new \classes\Middleware();
if (isset($data['word']) || isset($data['wordParam'])) :


    ?>

    <div class="col-lg-8 col-xlg-9 col-md-12">
        <div class="card">
            <div class="card-body">

                <form action="<?= isset($data['word']) ? 'update-forbidden-word?forbiddenID='.$data['word']->id : 'update-forbidden-word?forbiddenID='.$data['wordParam']['id']  ?>" method="POST" class="form-horizontal form-material">

                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Forbidden Word Name</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" name="word"
                                   class="form-control p-0 border-0" value="<?= isset($data['wordParam']['word']) ? $data['wordParam']['word'] : $data['word']->word ?>"> </div>
                    </div>

                    <div class="form-group mb-4">
                        <div class="col-sm-12">
                          <?php  if($middleware->canUpdateForbiddenWord()) :  ?>
                            <button class="btn btn-success" name="btnUpdateBadWord">Update Forbidden Word</button>
                          <?php
                          else : echo "You dont have this permission";

                          endif; ?>
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

else : echo "<h2>FORBIDDEN WORD DOES NOT EXIST</h2>";

endif;
?>