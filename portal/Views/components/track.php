
<section id="newsSection">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="latest_newsarea"> <span>Latest News</span>
                <ul id="ticker01" class="news_sticker">

                    <?php
                    if (isset($details['latestTrack'])) :

                        foreach ($details['latestTrack'] as $latest) : ?>

                            <li><a href="post?postID=<?= $latest->id ?>" >



                                    <?php

                                    $result = \classes\PostFunction::returnFirstImg($latest['files']);

                                    if ($result) {

                                        echo ' <img alt="track news" src="/portal-back/images/'. $result  .'">';

                                    } else {

                                        echo '<img src="https://i.pinimg.com/originals/10/b2/f6/10b2f6d95195994fca386842dae53bb2.png" alt="track news"  />';

                                    }


                                    ?>

                                    <?= $latest->title ?></a></li>

                        <?php
                        endforeach;


                        else: echo "<H2>NO ENTITY</H2>";

                        endif;

                    ?>
                </ul>

            </div>
        </div>
    </div>



</section>
