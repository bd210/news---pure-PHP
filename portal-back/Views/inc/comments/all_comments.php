<?php
$middleware = new \classes\Middleware();

if (isset($data['comments'])) :

    $number = 1;
    ?>
    <h2>Comments</h2>
    <table class="table text-nowrap">
        <tr>
            <th>#</th>
            <th>CreatedAt</th>
            <th>UpdatedAt</th>
            <th>Email</th>
            <th>Content</th>
            <th>Delete</th>

        </tr>

        <?php  foreach ($data['comments'] as $comment) :  ?>
            <tr>
                <td> <?= $number++ ?> </td>
                <td> <?= date("F jS Y H:i", strtotime($comment->created_at)) ?></td>
                <td>
                    <?php  if ($comment->updated_at != null) :

                        echo date("F jS Y H:i", strtotime($comment->updated_at));

                    else : echo "Not updated";

                    endif;
                    ?>
                </td>
                <td> <?= $comment->email ?></td>
                <td> <?= $comment->content ?></td>
                <?php if ($middleware->canDeleteComment()) :  ?>
                <td>  <a href="delete-comment?commentID=<?= $comment->id ?>"><i class="fas fa-trash-alt"> </i> </a> </td>
                <?php  endif; ?>
            </tr>
        <?php endforeach; ?>

    </table>


<?php

else: echo "NO COMMENTS";

endif;
?>