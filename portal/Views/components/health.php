
<?php

if (isset($data['health'])) :


?>

<div class="technology">
    <div class="single_post_content">
        <h2><span><?= $data['health'][0]['categories']->category_name ?></span></h2>
        <ul class="business_catgnav">
            <li>
                <figure class="bsbig_fig wow fadeInDown"> <a href="post?postID=<?= $data['health'][0]->id ?>" class="featured_img">



                        <?php

                        $result = \classes\PostFunction::returnFirstImg($data['health'][0]['files']);

                        if ($result) {

                            echo ' <img alt="post picture" src="/portal-back/images/'. $result  .'">';

                        } else {

                            echo '<img src="https://i.pinimg.com/originals/10/b2/f6/10b2f6d95195994fca386842dae53bb2.png" alt="post picture"  />';

                        }


                        ?>

                        <span class="overlay"></span> </a>
                    <figcaption> <a href="post?postID=<?= $data['health'][0]->id ?>"><?= $data['health'][0]->title ?></a> </figcaption>

                </figure>
            </li>
        </ul>
        <ul class="spost_nav">
    <?php
    $count = count($data['health'])-1;

    for ($i = 1; $i <= $count; $i++) :

        ?>

            <li>
                <div class="media wow fadeInDown"> <a href="post?postID=<?= $data['health'][$i]->id ?>" class="media-left">


                        <?php

                        $result = \classes\PostFunction::returnFirstImg($data['health'][$i]['files']);

                        if ($result) {

                            echo ' <img alt="post picture" src="/portal-back/images/'. $result  .'">';

                        } else {

                            echo '<img src="https://i.pinimg.com/originals/10/b2/f6/10b2f6d95195994fca386842dae53bb2.png" alt="post picture"  />';

                        }


                        ?>



                    </a>
                    <div class="media-body"> <a href="post?postID=<?= $data['health'][$i]->id ?>" class="catg_title"> <?= $data['health'][$i]->title ?></a> </div>
                </div>
            </li>
    <?php
    endfor;
    ?>
        </ul>
    </div>
</div>
</div>
<?php

else: echo "<h2>NO POSTS WITH THIS CATEGORY</h2>";

endif;
?>