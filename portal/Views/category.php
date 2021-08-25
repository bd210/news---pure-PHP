<?php

      if (isset($data['category']) && count($data['category']) > 0) :    ?>

              <div class="single_sidebar">
                  <h2><span> <?= $data['category'][0]['categories']->category_name?></span></h2>
                  <ul class="spost_nav">


              <?php foreach ($data['category'] as $cat) :  ?>

                      <li>
                          <div class="media wow fadeInDown"> <a href="post?postID=<?= $cat->id ?>" class="media-left">



                                  <?php

                                  $result = \classes\PostFunction::returnFirstImg($cat['files']);

                                  if ($result) {

                                      echo ' <img alt="post picture" src="/portal-back/images/'. $result  .'">';

                                  } else {

                                      echo '<img src="https://i.pinimg.com/originals/10/b2/f6/10b2f6d95195994fca386842dae53bb2.png" alt="post picture"  />';

                                  }


                                  ?>


                              </a>

                              <div class="media-body"> <a href="post?postID=<?= $cat->id ?>" class="catg_title"> <?= $cat->title ?></a> </div>
                          </div>
                      </li>

              <?php
              endforeach;
              ?>
                  </ul>
              </div>



<?php

     else: echo "<h2>NO POSTS WITH THIS CATEGORY</h2>";

     endif;

?>
