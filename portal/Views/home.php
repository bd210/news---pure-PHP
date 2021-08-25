<?php
if (isset ($data['success'])) : ?>

    <div class="alert-success"><?= $data['success'] ?></div>

<?php elseif (isset ($data['unsuccess'])) : ?>

    <div class="alert-danger"><?= $data['unsuccess'] ?></div>
<?php

endif;

?>
<?php include_once "Views/components/slider.php" ?>

    <?php  include_once "Views/components/latest.php"?>

<div class="row">

    <div class="col-lg-8 col-md-8 col-sm-8">

        <div class="left_content">

            <?php include_once "Views/components/business.php" ?>

            <div class="fashion_technology_area">

                <?php include_once "Views/components/sport.php" ?>


                <?php include_once "Views/components/health.php" ?>




            </div>



        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <aside class="right_content">



                <?php include_once "Views/components/popular.php" ?>


                <?php include_once "Views/components/tags.php"?>

                <?php  include_once "Views/components/sponsorAndCategory.php"?>



            </aside>
        </div>



