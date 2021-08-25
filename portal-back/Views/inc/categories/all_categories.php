<?php
$middleware = new \classes\Middleware();

    if (isset($data['categories'])) :

        $number = 1;
        ?>
        <h2>Categories</h2>
        <?php if ($middleware->canCreateCategory()) :  ?>
        <a href="create-categories-view"> <i class="fas fa-plus"><b>NEW</b></i></a>
        <?php  endif; ?>

        <table class="table text-nowrap">
            <tr>
                <th>#</th>
                <th>CreatedAt</th>
                <th>UpdatedAt</th>
                <th>Category</th>
                <th>Edit</th>
                <th>Delete</th>

            </tr>

            <?php  foreach ($data['categories'] as $category) :  ?>
                <tr>
                    <td> <?= $number++ ?> </td>
                    <td> <?= date("F jS Y H:i", strtotime($category->created_at)) ?></td>
                    <td>
                        <?php  if ($category->updated_at != null) :

                            echo date("F jS Y H:i", strtotime($category->updated_at));

                        else : echo "Not updated";

                        endif;
                        ?>
                    </td>
                    <td> <?= $category->category_name ?></td>
                    <td>  <a href="view-category?categoryID=<?= $category->id ?>""><i class="fas fa-edit"></i>  </a></td>

                     <?php if ($middleware->canDeleteCategory()) :  ?>
                    <td>  <a href="delete-category?categoryID=<?= $category->id ?>"><i class="fas fa-trash-alt"> </i> </a> </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>

        </table>


    <?php

    else: echo "NO CATEGORIES";

    endif;
    ?>