<?php

$middleware = new \classes\Middleware();

if (isset($data['forbidden'])) :

$number = 1;

?>
    <h2>Forbidden Words</h2>

    <?php  if ($middleware->canCreateForbiddenWord()) : ?>
    <a href="create-forbidden-words-view"> <i class="fas fa-plus"><b>NEW</b></i></a>
    <?php  endif; ?>

    <table class="table text-nowrap">
        <tr>
            <th>#</th>
            <th>CreatedAt</th>
            <th>UpdatedAt</th>
            <th>Word</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>

        <?php  foreach ($data['forbidden'] as $word) :  ?>
            <tr>
                <td> <?= $number++ ?> </td>
                <td> <?= date("F jS Y H:i", strtotime($word->created_at)) ?></td>
                <td>
                    <?php  if ($word->updated_at != null) :

                        echo date("F jS Y H:i", strtotime($word->updated_at));

                    else : echo "Not updated";

                    endif;
                    ?>

                </td>
                <td> <?= $word->word ?></td>

                <td>  <a href="view-forbidden-word?forbiddenID=<?= $word->id ?>"><i class="fas fa-edit"></i>  </a></td>

                <?php

                    if ($middleware->canDeleteForbiddenWord()) :
                ?>
                <td>  <a href="delete-forbidden-word?forbiddenID=<?= $word->id ?>"><i class="fas fa-trash-alt"> </i> </a> </td>
                <?php  endif; ?>
            </tr>
        <?php endforeach; ?>

    </table>


<?php

else: echo "<h1>NO FORBIDDEN WORDS</h1>";

endif;
?>