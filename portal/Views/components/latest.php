<div class="col-lg-4 col-md-4 col-sm-4">
    <div class="latest_post">
        <h2><span>Latest post</span></h2>
        <div class="latest_post_container">
            <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
            <ul class="latest_postnav">
                <?php if (isset($data['latest'])) :

                        foreach ($data['latest'] as $post) :
                    ?>
                <li>
                    <div class="media"> <a href="post?postID=<?= $post->id ?>" class="media-left">

                            <?php

                            $result = \classes\PostFunction::returnFirstImg($post['files']);

                            if ($result) {

                                echo ' <img alt="post picture" src="/portal-back/images/'. $result  .'">';

                            } else {

                                echo '<img src="https://i.pinimg.com/originals/10/b2/f6/10b2f6d95195994fca386842dae53bb2.png" alt="post picture"  />';

                            }


                            ?>



                        </a>
                        <div class="media-body"> <a href="post?postID=<?= $post->id ?>" class="catg_title"> <?= $post->title . " - " . $post->categories->category_name ?></a> </div>
                    </div>
                </li>

                <?php
                       endforeach;

                    else: echo "NO ENTITY";

                    endif;
                ?>

            </ul>
            <div id="next-button"><i class="fa  fa-chevron-down"></i></div>
        </div>
    </div>
</div>