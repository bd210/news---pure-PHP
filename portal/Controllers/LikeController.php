<?php
namespace controllers;

use models\Like;

class LikeController extends Controller
{

    public function like()
    {

        try {

            $postID = $_GET['postID'];
            $likes = new Like();
            $likes->post_id = $postID;
            $likes->user_id = $_SESSION['user']->id;

            $likes->save();

            header("Location: post?postID=$postID");
        } catch (\Exception $e) {
            return $this->return500();
        }
    }



    public function unlike()
    {
        try {

            $postID = $_GET['postID'];
            $userID = $_GET['userID'];
            $likes = new Like();

            $likes::query()
                ->where([
                    'user_id' => $userID,
                    'post_id' => $postID
                ])
                ->delete();

            header("Location: post?postID=$postID");

        } catch (\Exception $e) {
            return $this->return500();
        }
    }
}