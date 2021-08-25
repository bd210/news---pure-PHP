<?php

    if (isset($data['single'])) :
    $postID = $data['single']->id;
    $countLikes = count($data['single']['likes']);

    $userIdArray = array();

    $videos = array('mp4');
    $images = array('png', 'jpg', 'jpeg');
    $audios = array('mp3', 'wma');



        foreach ($data['single']['likes'] as $like) {

      array_push($userIdArray,$like['pivot']->user_id);
   }


?>
<h1><?= $data['single']->title ?></h1>

<div class="post_commentbox">
    <a href="#"><i class="fa fa-user"></i><?= $data['single']['author']->first_name . " " .  $data['single']['author']->last_name?></a>
    <span><i class="fa fa-calendar"></i><?=  date('F jS Y H:i',strtotime($data['single']->created_at)) ?></span>
    <a href="#"><i class="fa fa-tags"></i><?= $data['single']['categories']->category_name ?></a>
    <a href="#"><i class="fa fa-eye"><?= $data['hits'] ?></i></a>
    <?php  if (isset($data['single']['edited']) && $data['single']['edited'] != null) : ?>

        <a href="#"><i class="fa fa-edit"></i> <?= $data['single']['edited']->first_name . " " . $data['single']['edited']->last_name   ?> </a>

    <?php  endif; ?>

</div>

<div class="single_page_content">


    <?php

    $result = \classes\PostFunction::returnFirstImg($data['single']['files']);

    if ($result) {

        echo ' <img class="img-center"  src="/portal-back/images/'. $result  .'" alt="single post"  style="width: 700px;height: 400px;">';

    } else {

        echo '<img class="img-center" src="https://i.pinimg.com/originals/10/b2/f6/10b2f6d95195994fca386842dae53bb2.png" alt="single post" style="width: 700px;height: 400px;" />';

    }


    ?>


    <p> <?= $data['single']->content ?> </p>
        <div class="col-lg-offset-0">
        <?php

        if (isset($data['single']['files'])) {

            $count = count($data['single']['files']);

            for($i = 1; $i< $count; $i++) {

                $ext = pathinfo($data['single']['files'][$i]->file_name, PATHINFO_EXTENSION);




                    if (in_array($ext, $images)) {

                        echo '<img src="/portal-back/images/' . $data['single']['files'][$i]->file_name . '" alt="post file" width="100px" height="100px" />';


                    } elseif (in_array($ext, $videos)) {


                        echo '<video controls src="/portal-back/images/' . $data['single']['files'][$i]->file_name . '" alt="post file" width="100px" height="100px%" ></video> ';

                    } elseif (in_array($ext, $audios)) {


                        echo '<audio controls src="/portal-back/images/' . $data['single']['files'][$i]->file_name . '" alt="post file" width="100px" height="100px" ></audio> ';

                    }


            }

        }
        ?>


        </div>

<h4>TAGS</h4>
    <?php
        if (isset($data['single']['tags']) && count($data['single']['tags']) > 0  ) {

            foreach ($data['single']['tags'] as $tag) {

                echo "<p><a href=''> ". $tag->keyword ."</a></p>";

            }

        } else {
            echo "<p>NO TAGS</p>";
        }

    ?>

    <?php if (!isset($_SESSION['user'])) : ?>

    <a href="login-form?postID=<?= $postID ?>"><h3> Like <i class="fa fa-thumbs-o-up"></i> <?= $countLikes > 0 ?  " ( ". $countLikes . " ) "   : "No likes yet" ?> </h3></a>

    <?php
    elseif (isset($_SESSION['user']) &&  in_array($_SESSION['user']->id, $userIdArray)) : ?>

        <a href="unlike?postID=<?= $postID?>&userID=<?= $_SESSION['user']->id?>"><h3> Unlike <i class="fa fa-thumbs-o-up"></i><?= $countLikes > 0 ? " ( ". $countLikes . " ) " : "No likes yet" ?> </h3></a>
   <?php else: ?>
        <a href="like?postID=<?= $postID?>"><h3> Like <i class="fa fa-thumbs-o-up"></i><?= $countLikes > 0 ? "(". $countLikes . ")" : " ( No likes yet ) " ?> </h3></a>
    <?php
    endif;
    ?>



    <?php include_once "Views/components/comments.php"?>
    <br/>
    <h4>Leave commment</h4>

    <form action="<?= isset($_SESSION['comment']) ? 'comments-update?commentID='.$_SESSION['comment']->id.'&postID='.$postID : 'comments-add?postID='.$postID ?>" method="POST" class="contact_form">
        <input class="form-control" type="text" placeholder="Email" name="email" value="<?= isset($_SESSION['comment']) ? $_SESSION['comment']->email : '' ?>">
        <textarea class="form-control" cols="30" rows="5" placeholder="Comment" name="content"><?= isset($_SESSION['comment']) ? $_SESSION['comment']->content : '' ?></textarea>
        <input type="submit" value="<?= isset($_SESSION['comment']) ? 'Update' : 'Send' ?>" name="submitComment">

    </form>


        <?php
        if (isset($_SESSION['errorsComment'])) {

            foreach ($_SESSION['errorsComment'] as $error) {

                echo "<div class='alert-danger'>" .$error. " </div>";
            }
        } elseif (isset($_SESSION['successComment'])) {

            echo "<div class='alert-success'>" .$_SESSION['successComment']. " </div> <br/>";

        }
        ?>

</div>
<?php

else: echo "<h2>POST DOES NOT EXIST</h2>";

endif;

unset($_SESSION['errorsComment']);
unset($_SESSION['successComment']);
unset($_SESSION['comment'])

?>

