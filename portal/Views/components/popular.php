<?php

    if (isset($data['popular'])) :

?>

<div class="single_sidebar">
    <h2><span>Popular Post</span></h2>
    <ul class="spost_nav">
        <?php
            foreach ($data['popular'] as $popular) :
        ?>
        <li>
            <div class="media wow fadeInDown"> <a href="post?postID=<?= $popular->id ?>" class="media-left">

                    <?php

                    $result = \classes\PostFunction::returnFirstImg($popular['files']);

                    if ($result) {

                        echo ' <img alt="post picture" src="/portal-back/images/'. $result  .'">';

                    } else {

                        echo '<img src="https://i.pinimg.com/originals/10/b2/f6/10b2f6d95195994fca386842dae53bb2.png" alt="post picture"  />';

                    }


                    ?>


                </a>
                <div class="media-body"> <a href="post?postID=<?= $popular->id ?>" class="catg_title"> <?= $popular->title . " -  ". $popular['categories']->category_name ."  -  <i class='fa fa-eye'></i> " . $popular->visits_count?></a> </div>
            </div>
        </li>
        <?php

            endforeach;
        ?>
    </ul>
</div>

<?php

else : echo "NO POSTS WITH THIS CATEGORY";

endif;
?>