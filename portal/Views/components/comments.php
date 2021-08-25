<?php

    if (isset($data['comments']) && count($data['comments']) > 0) :

?>

        <div class="box-comments">
            <h2>Comments (<?=  count($data['comments']) ?>)</h2> <br/>
            <ul class="list-comments">

            <?php   foreach ($data['comments'] as $comm ) :  ?>

                <li class="comment-children">
                    <div class="comment-details">
                        <h4 class="comment-author"><?= $comm->email   ?></h4>
                        <span style="color: blue"><?= date('F jS Y H:i',strtotime($comm->created_at))  ?></span>
                        <p class="comment-description">
                           <?=  $comm->content ?>
                        </p>
                    <?php  if (isset($_SESSION['user']) && $comm->email == $_SESSION['user']->email) : ?>

                    <a href="comments-view-edit?commentID=<?= $comm->id ?>&postID=<?= $comm->post_id ?>"><i class="fa fa-edit"></i></a>
                    <a href="comment-delete?commentID=<?= $comm->id ?>&postID=<?= $comm->post_id ?>"><i class="fa fa-trash"></i></a>
                    <?php  endif; ?>
                    </div>
                </li>

                <?php  endforeach; ?>

            </ul>
        </div>


<?php

else: echo "<h2>No commets yet</h2>";

endif;
?>
