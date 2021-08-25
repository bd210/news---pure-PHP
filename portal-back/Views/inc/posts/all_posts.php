<?php

$middleware = new \classes\Middleware();

if (isset($data['posts'])) :

    $number = 1;
    if (isset($_GET['per_page']) && $_GET['per_page'] != "") {

        $per_page = $_GET['per_page'];

    } else {

        $per_page = 10;
    }

    $pag = new \classes\Pagination();

    $array = (array)$data['posts'];
    $array = reset($array);

    $numbers = $pag->Paginate($array, $per_page);

    $results = $pag->fetchResult();



    ?>
    <h2>News</h2>

    <?php if ($middleware->canCreatePost()): ?>
    <a href="create-posts-view"> <i class="fas fa-plus"><b>NEW</b></i></a>
    <?php endif; ?>

    <form action="all-posts?per_page=<?= $per_page ?>" method="GET">
        <input type="text" name="per_page" placeholder="News per page">
        <input type="submit" name="submitPerPage" value="Go!" class="btn-primary">

    </form>
    <table class="table text-nowrap">
        <tr>
            <th>#</th>
            <th>CreatedAt</th>
            <th>UpdatedAt</th>
            <th>Picture</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>ApprovedBy</th>
            <th>EditedBy</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>

        <?php  foreach ($results as $post) :  ?>




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
                <td>  <a href="view-user-profile?userID=<?= $post['approved']->id ?>"> <?= $post['approved']->first_name . " " . $post['approved']->last_name ?> </a></td>
                <td>
                    <?php  if ($post['edited'] != null) : ?>
                    <a href="view-user-profile?userID=<?= $post['edited']->id ?>"><?= $post['edited']->first_name . " " . $post['edited']->last_name ?>

                      <?php  else : echo "Not updated";
                      endif; ?>
                </td>
                <td>  <a href="view-post?postID=<?= $post->id ?>"><i class="fas fa-edit"></i>  </a></td>

                <?php if ($middleware->canDeletePost()): ?>
                <td>  <a href="delete-post?postID=<?= $post->id ?>"><i class="fas fa-trash-alt"> </i> </a> </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>

    </table>


<?php

    foreach ($numbers as $num) {

        echo '<a href="all-posts?page='.$num.'">'. $num .'</a>';

    }




else: echo "NO POSTS";

endif;
?>