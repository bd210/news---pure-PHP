<?php

    if (isset($data['sport'])) :


?>

<div class="fashion">
    <div class="single_post_content">
        <h2><span><?= $data['sport'][0]['categories']->category_name ?></span></h2>
        <ul class="business_catgnav wow fadeInDown">
            <li>
                <figure class="bsbig_fig"> <a href="post?postID=<?= $data['sport'][0]->id ?>" class="featured_img">



                    <?php

                    $result = \classes\PostFunction::returnFirstImg($data['sport'][0]['files']);

                    if ($result) {

                        echo ' <img alt="post picture" src="/portal-back/images/'. $result  .'">';

                    } else {

                        echo '<img src="https://i.pinimg.com/originals/10/b2/f6/10b2f6d95195994fca386842dae53bb2.png" alt="post picture"  />';

                    }


                    ?>


                    <figcaption> <a href="post?postID=<?= $data['sport'][0]->id ?>"> <?= $data['sport'][0]->title  ?> </a> </figcaption>

                </figure>
            </li>
        </ul>
        <ul class="spost_nav">
            <?php
            $count = count($data['sport'])-1;

            for ($i = 1; $i <= $count; $i++) :

            ?>

            <li>
                <div class="media wow fadeInDown"> <a href="post?postID=<?= $data['sport'][$i]->id ?>" class="media-left">


                        <?php

                        $result = \classes\PostFunction::returnFirstImg($data['sport'][$i]['files']);

                        if ($result) {

                            echo ' <img alt="post picture" src="/portal-back/images/'. $result  .'">';

                        } else {

                            echo '<img src="https://i.pinimg.com/originals/10/b2/f6/10b2f6d95195994fca386842dae53bb2.png" alt="post picture"  />';

                        }


                        ?>

                    </a>
                    <div class="media-body"> <a href="post?postID=<?= $data['sport'][$i]->id ?>" class="catg_title"> <?= $data['sport'][$i]->title ?></a> </div>
                </div>
            </li>
            <?php
            endfor;
            ?>
        </ul>
    </div>
</div>

<?php

else: echo "<h2>NO POSTS WITH THIS CATEGORY</h2>";

endif;
?>