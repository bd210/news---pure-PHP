<?php
$middleware = new \classes\Middleware();
if (isset($data['category']) || isset($data['categoryParam'])) :


    ?>

    <div class="col-lg-8 col-xlg-9 col-md-12">
        <div class="card">
            <div class="card-body">

                <form action="<?= isset($data['category']) ? 'update-category?categoryID='.$data['category']->id : 'update-category?categoryID='.$data['categoryParam']['id']  ?>" method="POST" class="form-horizontal form-material">

                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Category Name</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" name="category"
                                   class="form-control p-0 border-0" value="<?= isset($data['categoryParam']['category']) ? $data['categoryParam']['category'] : $data['category']->category_name ?>"> </div>
                    </div>

                    <div class="form-group mb-4">
                        <div class="col-sm-12">

                            <?php if ($middleware->canUpdateCategory()) :  ?>
                            <button class="btn btn-success" name="btnUpdateCategory">Update Category</button>
                            <?php
                            else : echo "You dont have this permission";

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

else : echo "<h2>CATEGORY DOES NOT EXIST</h2>";

endif;
?>