<?php
$middleware = new \classes\Middleware();
if ($middleware->canApprovePost()):
if (isset($data['pending']) && count($data['pending']) > 0) :
    $number = 1;

    ?>
    <h2>Pending News</h2>
    <table class="table text-nowrap">
        <tr>
            <th>Num</th>
            <th>CreatedAt</th>
            <th>UpdatedAt</th>
            <th>Picture</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Approve</th>
            <th>Delete</th>
            <th>View</th>

        </tr>

        <?php  foreach ($data['pending'] as $post) :  ?>

            <tr>
                <td> <?= $number++ ?> </td>
                <td> <?= date("F jS Y H:i", strtotime($post->created_at)) ?></td>
                <td>
                    <?php  if ($post->updated_at != null) :

                        echo date("F jS Y H:i", strtotime($post->updated_at));

                    else : echo "Not updated";

                    endif;
                    ?>
                </td>
                <td>

                    <?php


                    $result  =  \classes\PostFunction::returnFirstImg($post['files']);

                    if ($result) {

                        echo  '<img src="/portal-back/images/'. $result .'" alt="post picture" style="height: 50px;width: 50px;" />';

                    } else {


                        echo '<img src="https://i.pinimg.com/originals/10/b2/f6/10b2f6d95195994fca386842dae53bb2.png" alt="post picture" style="height: 50px;width: 50px;" />';
                    }


                    ?>

                </td>
                <td>  <?= substr($post->title, 0, 8). "..." ?> </td>
                <td> <a href="view-user-profile?userID=<?= $post['author']->id ?>"> <?= $post['author']->first_name . " " . $post['author']->last_name ?> </a></td>
                <td> <?= $post['categories']->category_name ?></td>
                <td>  <a href="approve-post?postID=<?= $post->id ?>"><i class="fas fa-check"></i>  </a></td>
                <td>  <a href="delete-post?postID=<?= $post->id ?>"><i class="fas fa-trash-alt"> </i> </a> </td>
                <td>  <a href="view-post?postID=<?= $post->id ?>"><i class="fas fa-eye"> </i> </a> </td>

            </tr>
        <?php endforeach; ?>

    </table>


<?php

else: echo "<h2>NO PENDING POSTS </h2>";

endif;
else : echo "<b><h2>You dont have this permission</h2></b>";
endif;
?>