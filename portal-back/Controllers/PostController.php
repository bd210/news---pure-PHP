<?php
namespace controllers;


use classes\File;
use classes\Template;
use models\Category;
use models\Files;
use models\Like;
use models\Post;
use models\PostFile;
use models\PostTag;
use models\Tag;
use validationPost\CreatePost;
use validationPost\UpdatePost;


class PostController extends Controller
{

    public function index()
    {

        $post = new Post();

        $this->data['posts'] = $post::with('categories', 'author', 'edited','files', 'approved' )
            ->where('approved_by', '!=', null)
            ->orderBy('created_at', 'DESC')
            ->get();

        $template = new Template();

        $template->view($this->layouts_path, [
            'title' => 'Posts',
            'content' => $template->render_php($this->inc_path.'posts/all_posts.php', $this->data)
        ]);

        return $template;

    }


    public function create()
    {
        $category = new Category();
        $tag = new Tag();

        $this->data['tags'] = $tag::all();
        $this->data['categories'] = $category::all();

        $template = new Template();

        $template->view($this->layouts_path, [
            'title' => 'Create Post',
            'content' => $template->render_php($this->inc_path.'posts/create_post.php', $this->data)
        ]);

        return $template;
    }



    public function store()
    {

        try {

            if (isset($_POST['btnCreatePost'])) {

                $template = new Template();
                $post_tag = new PostTag();
                $post = new Post();
                $cat = new Category();
                $file = new Files();
                $file_post = new PostFile();
                $img = new File();
                $tag = new Tag();

                $title = $_POST['title'];
                $content = $_POST['content'];
                $category = $_POST['category'];
                $files = $_FILES['file'];
                $fileTmp = $files['tmp_name'];

                if (isset($_POST['tag'])) {

                    $tags = $_POST['tag'];
                }

                $this->data['tags'] = $tag::all();

                $fileName = $files['name'];

                $validation = new CreatePost($_POST);
                $this->data['errors'] = $validation->validateForm();



               if (count($this->data['errors']) > 0 ) {

                    $this->data['categories'] = $cat::all();

                    $this->data['postParams'] = ['title' => $title, 'content' => $content, 'category' => $category];



                    $template->view($this->layouts_path, [
                       'title' => 'Create Post',
                       'content' => $template->render_php($this->inc_path.'posts/create_post.php', $this->data)
                    ]);

                    return $template;

               } else {


                  if (!empty($fileName) && $fileTmp[0] != "" ) {


                       $img->upload($files);

                       $post->title = $title;
                       $post->content = $content;
                       $post->category_id = $category;
                       $post->author_id = $_SESSION['user']->id;

                       $post->save();

                       foreach ($tags as $tag) {

                           $post_tag::query()->insert([
                               'post_id' => $post->id,
                               'tag_id' => $tag

                           ]);

                       }


                         foreach ($fileName as $src) {

                            $file_insert = $file::query()->insertGetId([

                                'file_name' => time() . "_" . $src
                            ]);


                             $file_post::query()->insert([
                                 'file_id' => $file_insert,
                                 'post_id' => $post->id
                             ]);
                         }




                       header("Location: pending-post");

                   } else {


                      $this->data['messageFile'] = "File is required";

                      $template->view($this->layouts_path, [
                          'title' => 'Create Post',
                          'content' => $template->render_php($this->inc_path.'posts/create_post.php', $this->data)
                      ]);

                      return $template;
                   }


               }


            } else {

                echo "You have to create post by click button";

            }

        } catch (\Exception $e) {

            return $this->return500();

        }


    }


    public function edit()
    {

        if (isset($_GET['postID'])) {

            $id = $_GET['postID'];

            $post = new Post();
            $like = new Like();
            $category = new Category();
            $tag = new Tag();

            $this->data['categories'] = $category::all();
            $this->data['tags'] = $tag::all();

            $this->data['likes'] = $like::query()
                ->where('post_id', $id)
                ->groupBy('post_id')
                ->orderBy('post_id')
                ->count('post_id');

            $this->data['post'] = $post::with('categories', 'files', 'tags')
                ->where('id', $id)
                ->first();

        } else {

            return $this->return404();

        }


        $template = new Template();

        $template->view($this->layouts_path,[
            'title' => 'Post update',
            'content' => $template->render_php($this->inc_path."posts/post.php", $this->data)
        ]);

        return $template;


    }


    public function update()
    {

        try {

            if (isset($_POST['btnUpdatePost'])) {

            $validation = new UpdatePost($_POST);
            $this->data['errors'] = $validation->validateForm();

            $post = new Post();
            $file = new Files();
            $file_post = new PostFile();
            $post_tag = new PostTag();

            $files = $_FILES['file'];
            $filesName = $files['name'];
            $filesTmp = $files['tmp_name'];


            $title = $_POST['title'];
            $content = $_POST['content'];
            $category = $_POST['category'];
            $tags = $_POST['tag'];


                if (isset($_SESSION['user'])) {

                    $editedBy = $_SESSION['user']->id;
                }


                if (isset($_GET['postID'])) {

                    $postID = $_GET['postID'];
                }


                if (count($this->data['errors']) > 0 ) {

                    $_SESSION['errorValidation'] = $this->data['errors'];

                    header("Location: view-post?postID=$postID");

                } else {


                   if (!empty($filesName) && $filesTmp[0] != "" ) {

                       $img = new File();

                       $img->upload($files);

                       foreach ($filesName as $src) {

                         $file_insert = $file::query()->insertGetId([
                             'file_name' => time() . "_" . $src
                         ]);

                           $file_post::query()->insert([
                               'file_id' => $file_insert,
                               'post_id' => $postID
                           ]);

                       }

                   }


                   if (isset($tags)) {

                       $post_tag::query()
                           ->where('post_id', $postID)
                           ->delete();

                       foreach ($tags as $tag) {


                           $post_tag::query()
                               ->where('post_id', $postID)
                               ->insert([
                               'post_id' => $postID,
                               'tag_id' => $tag
                           ]);
                       }

                   }

                   $post::query()
                       ->where('id', $postID)
                       ->update([
                       'title' => $title,
                       'content' => $content,
                       'category_id' => $category,
                       'edited_by' => $editedBy,
                       'updated_at' => date("Y-m-d H:i:s"),

                   ]);


                    header("Location: all-posts");

                }



            } else {

                echo "You have to update post by click button";

            }


        } catch (\Exception $e) {

            return $this->return500();

        }

    }


    public function delete()
    {

        try {

            if (isset($_GET['postID'])) {


                $postID = $_GET['postID'];

                $post = new Post();
                $post_file = new PostFile();
                $post_tag = new PostTag();

                $post::query()
                    ->where('id', $postID)
                    ->delete();

                $post_file::query()
                    ->where('post_id', $postID)
                    ->delete();

                $post_tag::query()
                    ->where('post_id', $postID)
                    ->delete();


                header("Location: pending-post");

            } else {

                return $this->return404();

            }
        } catch (\Exception $e) {

            return $this->return500();

        }

    }



    public function pending()
    {

        $post = new Post();
        $this->data['pending'] = $post::with('categories', 'author', 'files' )
            ->where('approved_by', '=', null)
            ->orderBy('created_at', 'ASC')
            ->get();

        $template = new Template();

        $template->view($this->layouts_path, [
            'title' => 'Pending Posts',
            'content' => $template->render_php($this->inc_path.'posts/pending.php', $this->data)
        ]);

        return $template;

    }



    public function approve()
    {

        try {

            if (isset($_GET['postID'])) {

                $id = $_GET['postID'];

                $post = new Post();

                $post::query()
                    ->where('id', $id)
                    ->update([
                      'approved_by' => $_SESSION['user']->id
                    ]);

                header("Location: pending-post");

            } else {

                return $this->return404();
            }


        } catch (\Exception $e) {

            return $this->return500();

        }

    }



    public function deletePostFile()
    {

        try {

            if (isset($_GET['fileID']) && $_GET['postID']) {

                $postID = $_GET['postID'];
                $fileID = $_GET['fileID'];

                $postFile = new PostFile();
                $file = new Files();

                $postFile::query()
                    ->where('post_id', $postID)
                    ->where('file_id', $fileID)
                    ->delete();

                $file::query()
                    ->where('id', $fileID)
                    ->delete();

                header("Location: view-post?postID=$postID");

            } else {

                return $this->return404();
            }


        } catch (\Exception $e) {

            return $this->return500();

        }

    }





}