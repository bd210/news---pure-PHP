<?php
$number = 1;
if (isset($_POST['search_text']) && $_POST['search_text'] != "" ) :


?>


 <?php  if (isset($data['posts'][0])) :  ?>
    <table class="table text-nowrap">
    <h2>Posts</h2>

    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Details</th>
    </tr>
<?php

    foreach ($data['posts'] as $post) :
?>
   <tr>
       <td> <?=  $number ++ ?></td>
       <td> <?= $post->title ?></td>
       <td><a href="view-post?postID=<?=  $post->id ?>"><input type="submit" value="Detail" class="btn-primary"></a> </td>
   </tr>

<?php
    endforeach;
    echo "</table>";
    endif;
    if ( isset($data['users'][0])) : ?>

        <table class="table text-nowrap">
        <h2>Users</h2>

        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Details</th>
        </tr>
<?php  foreach ($data['users'] as $user) : ?>

            <tr>
                <td> <?=  $number ++ ?></td>
                <td> <?= $user->first_name  . " " . $user->last_name ?></td>
                <td> <?=  $user->email ?></td>
                <td><a href="view-user-profile?userID=<?=  $user->id ?>"><input type="submit" value="Detail" class="btn-primary"></a> </td>
            </tr>

<?php
    endforeach;
    echo "</table>";
    endif;
    if( isset($data['comments'][0])) : ?>

        <table  class="table text-nowrap">
        <h2>Comments</h2>

        <tr>
            <th>#</th>
            <th>Email</th>
            <th>Content</th>
            <th>Delete</th>
        </tr>

    <?php
    foreach ( $data['comments'] as $comment) : ?>

        <tr >
            <td> <?=  $number ++ ?></td>
            <td> <?= $comment->email ?></td>
            <td> <?=  $comment->content ?></td>
            <td><a href="delete-comment?commentID=<?= $comment->id ?>"><input type="submit" value="Delete" class="btn-primary"></a> </td>
        </tr>

      <?php
        endforeach;
      endif;
        ?>
    </table>



<?php

else : echo "<h2>NO RESULTS</h2>";

endif;

?>