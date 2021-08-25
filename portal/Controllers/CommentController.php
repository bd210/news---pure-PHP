<?php
namespace controllers;

use models\BadWords;
use models\Comment;
use models\VerifyComment;
use commentValidation\CommentValidation;


class CommentController  extends Controller
{


    public function store()
    {

        try {

           if (isset($_POST['submitComment'])) {

                 $postID = $_GET['postID'];

                 $validation = new CommentValidation($_POST);

                 $this->data['errors'] = $validation->validateForm();



              if (count($this->data['errors']) > 0 ) {

                  $_SESSION['errorsComment'] = $this->data['errors'];

                  header("Location: post?postID=$postID");

              } else {


                  $comment = new Comment();
                  $words = new BadWords();
                  $badWords = $words::all();
                  $badWordsArray = array();

                  foreach ($badWords as $bw) {

                    array_push( $badWordsArray, $bw->word);

                  }

                  $comment->content = $this->badWord($badWordsArray,$_POST['content']);
                  $comment->email = $_POST['email'];

                  $comment->created_at = date("Y-m-d H:i:s");
                  $comment->updated_at = null;

                  $comment->post_id = $postID;

                  $result = $comment->save();

                  if ($result) {


                  $email = $comment->email;

                  $verify = new VerifyComment();

                  $verify->email = $email;
                  $time = time() + 3600;
                  $verify->expires = date("Y-m-d H:i:s",$time);

                  $selector = bin2hex(random_bytes(8));

                  $verify->selector = $selector;

                  $verify->save();

                  $url = "localhost/portal/verify-view?selector=".$selector;

                  $to = $email;
                  $subject = "Comment verification";

                  $message = "<p>Link for verification comment : ";

                  $message .= "<a href='.$url.'>Verify</a></p>";

                  $headers = "From : Boris <testingforintership09@gmail.com>\r\n";

                  $headers .= "Content-type : text/html\r\n";

                  $send = mail($to,$subject,$message, $headers);

                  $send ? $_SESSION['successComment'] = "You have to verify comment by email" :  $_SESSION['successComment'] = "An error occurres";

                      header("Location: post?postID=$postID");

                  } else {

                      $this->data['unsuccess'] = "An error occurred";

                      $template = new \classes\Template();

                      $template->view('Views/layouts/layout.php', [
                          'title' => 'Home',
                          'content' => $template->render_php('Views/home.php', $this->data)
                      ], $this->data);

                      return $template;
                  }

              }

           } else {

              echo  "You have to leave comment by submit";
           }


        } catch (\Exception $e) {

            return $this->return500();

        }

    }


    public function verifyView()
    {
        $template = new \classes\Template();

        $template->view('Views/layouts/layout.php', [
            'title' => 'Comment Verify',
            'content' => $template->render_php('Views/comment_email.php', $this->data)
        ], $this->data);

        return $template;
    }



    public function verify()
    {

        try {

            if (isset($_POST)) {

                $selector = $_GET['selector'];
                $now = date("Y-m-d H:i:s",time());


                $verify = new VerifyComment();
                $comment = new Comment();


                $vrf = $verify::all()
                    ->where('selector', '=', $selector)
                    ->where('expires', '>=', $now)
                    ->first();

                if ($vrf) {

                    $comment::query()->where('email', '=',$vrf->email)
                        ->update(['approved_comm' => 1]);


                    $verify::query()->where('id', '=', $vrf->id)->delete();

                    $this->data['success'] = "You are successfully verified comment";
                    header("Location: index.php");


                } else {

                    echo "<h2>Your session has expired</h2>";
                }



            } else {
                echo "<h2>You have to submit comment by click button</h2>";
            }


        } catch (\Exception $e) {
            echo "An error occurred, please contact administrator" . $e->getMessage();
        }

    }


    public function edit()
    {

        $comment = new Comment();

        $commentID = $_GET['commentID'];
        $postID = $_GET['postID'];

        $_SESSION['comment'] = $comment::query()
            ->where('id', $commentID)
            ->first();

       header("Location: post?postID=$postID&commentID=$commentID");
    }



    public function update()
    {

        try {

            $validation = new CommentValidation($_POST);
            $this->data['errors'] = $validation->validateForm();


            $comment = new Comment();
            $postID = $_GET['postID'];

            if (count($this->data['errors']) > 0 ) {

               header("Location: post?postID=$postID");

            } else {


                $commentID = $_GET['commentID'];
                $content = $_POST['content'];
                $date = date("Y-m-d H:i:S");

                $comment::query()
                    ->where('id', $commentID)
                    ->update([
                        'content' => $content,
                        'updated_at' => $date
                    ]);


                header("Location: post?postID=$postID");
            }

        } catch (\Exception $e) {

            return $this->return500();

        }

    }



    public function delete()
    {

        try {

            $postID = $_GET['postID'];
            $id = $_GET['commentID'];
            $comment = new Comment();

            $comment::query()
                ->where('id', $id)
                ->delete();

            header("Location: post?postID=$postID");

        } catch (\Exception $e) {

            return $this->return500();
        }
    }
}