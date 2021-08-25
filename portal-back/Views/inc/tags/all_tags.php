<?php

$middleware = new \classes\Middleware();

if (isset($data['tags'])) :

    $number = 1;
    ?>
    <h2>Tags</h2>

    <?php if ($middleware->canCreateTag()): ?>
    <a href="create-tags-view"> <i class="fas fa-plus"><b>NEW</b></i></a>
    <?php endif; ?>

    <table class="table text-nowrap">
        <tr>
            <th>#</th>
            <th>CreatedAt</th>
            <th>UpdatedAt</th>
            <th>Tag</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>

        <?php  foreach ($data['tags'] as $tag) :  ?>
            <tr>
                <td> <?= $number++ ?> </td>
                <td> <?= date("F jS Y H:i", strtotime($tag->created_at)) ?></td>
                <td>
                    <?php  if ($tag->updated_at != null) :

                        echo date("F jS Y H:i", strtotime($tag->updated_at));

                    else : echo "Not updated";

                    endif;
                    ?>
                </td>
                <td> <?= $tag->keyword ?></td>
                <td>  <a href="view-tag?tagID=<?= $tag->id ?>"><i class="fas fa-edit"></i>  </a></td>

                <?php if ($middleware->canDeleteTag()): ?>
                <td>  <a href="delete-tag?tagID=<?= $tag->id ?>"><i class="fas fa-trash-alt"> </i> </a> </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>

    </table>


<?php

else: echo "NO TAGS";

endif;
?>