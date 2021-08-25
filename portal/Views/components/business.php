<?php
    if (isset($data['business'])) :


?>
<div class="single_post_content">
    <h2><span><?= $data['business'][0]['categories']->category_name ?></span></h2>
    <div class="single_post_content_left">
        <ul class="business_catgnav  wow fadeInDown">
            <li>
                <figure class="bsbig_fig"> <a href="post?postID=<?= $data['business'][0]->id ?>" class="featured_img">



                        <?php

                        $result = \classes\PostFunction::returnFirstImg($data['business'][0]['files']);

                        if ($result) {

                            echo ' <img alt="post picture" src="/portal-back/images/'. $result  .'">';

                        } else {

                            echo '<img src="https://i.pinimg.com/originals/10/b2/f6/10b2f6d95195994fca386842dae53bb2.png" alt="post picture"  />';

                        }


                        ?>

                        <span class="overlay"></span> </a>
                    <figcaption> <a href="post?postID=<?= $data['business'][0]->id ?>"> <?= $data['business'][0]->title  ?></a> </figcaption>
                    <p> <?= $data['business'][0]->content  ?> </p>
                </figure>
            </li>
        </ul>
    </div>
    <div class="single_post_content_right">
        <ul class="spost_nav">

            <?php
            $count = count($data['business'])-1;

            for ($i = 1; $i <= $count; $i++) :

            ?>

            <li>
                <div class="media wow fadeInDown"> <a href="post?postID=<?= $data['business'][$i]->id ?>" class="media-left">


                        <?php

                        $result = \classes\PostFunction::returnFirstImg($data['business'][$i]['files']);

                        if ($result) {

                            echo ' <img alt="post picture" src="/portal-back/images/'. $result  .'">';

                        } else {

                            echo '<img src="https://i.pinimg.com/originals/10/b2/f6/10b2f6d95195994fca386842dae53bb2.png" alt="post picture"  />';

                        }


                        ?>

                    </a>
                    <div class="media-body"> <a href="post?postID=<?= $data['business'][$i]->id ?>" class="catg_title"> <?= $data['business'][$i]->title ?>  </a> </div>
                </div>
            </li>

            <?php
            endfor;

            ?>
        </ul>
    </div>
</div>

<?php

else: echo "<h2>NO POSTS WITH BUSINESS CATEGORY</h2>";

endif;
?>