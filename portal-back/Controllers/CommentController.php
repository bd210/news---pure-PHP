<?php
namespace controllers;


use classes\Template;
use models\Comment;

class CommentController extends Controller
{


    public function index()
    {

        $comment = new Comment();
        $this->data['comments'] = $comment::query()->orderBy('created_at', 'DESC')->get();

        $template = new Template();

        $template->view($this->layouts_path, [
            'title' => 'Comments',
            'content' => $template->render_php($this->inc_path."comments/all_comments.php", $this->data)
        ]);

        return $template;

    }



    public function delete()
    {

        try {

            if (!isset($_GET['commentID'])) {

                return $this->return404();

            } else {

                $id = $_GET['commentID'];

                $comment = new Comment();

                $comment::query()
                    ->where('id', $id)
                    ->delete();

                header("Location: all-comments");

            }


        } catch (\Exception $e) {

            return $this->return500();

        }

    }
}