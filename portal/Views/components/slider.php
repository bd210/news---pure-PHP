
<section id="sliderSection" style="width: 65%;">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="slick_slider">
                <?php

                    if (isset($data['all'])) :

                            foreach ($data['all'] as $post) :
                ?>
                <div class="single_iteam" > <a href="post?postID=<?= $post->id ?>">


                    <?php

                    $result = \classes\PostFunction::returnFirstImg($post['files']);

                    if ($result) {

                        echo ' <img alt="slider picture" src="/portal-back/images/'. $result  .'">';

                    } else {

                        echo '<img src="https://i.pinimg.com/originals/10/b2/f6/10b2f6d95195994fca386842dae53bb2.png" alt="slider picture"  />';

                    }


                    ?>
                    <div class="slider_article">

                        <p><?= $post->title  ?></p>
                    </div>
                </div>

                <?php

                            endforeach;
                    endif;
                ?>
                </div>

            </div>
        </div>



</section>
