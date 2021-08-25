<?php
namespace controllers;


use classes\Template;
use models\Tag;
use validationTag\TagCreate;
use validationTag\TagUpdate;

class TagController extends Controller
{


    public function index()
    {

        $tag = new Tag();
        $this->data['tags'] = $tag::query()->orderBy('created_at', 'DESC')->get();

        $template = new Template();

        $template->view($this->layouts_path, [
            'title' => 'Tags',
            'content' => $template->render_php($this->inc_path."tags/all_tags.php", $this->data)
        ]);

        return $template;

    }



    public function create()
    {

        $template = new Template();

        $template->view($this->layouts_path, [
            'title' => 'Tag Create',
            'content' => $template->render_php($this->inc_path."tags/create_tag.php", $this->data)
        ]);

        return $template;

    }



    public function store()
    {

        try {

            if (isset($_POST['btnCreateTag'])) {

                $validation = new TagCreate($_POST);
                $this->data['errors'] = $validation->validateForm();

                $template = new Template();

                $tag_name = $_POST['tag'];


                if (count($this->data['errors']) > 0 ) {

                    $this->data['tagParams'] = ['tag' => $tag_name ];

                    $template->view($this->layouts_path,[
                        'title' => 'Tag create',
                        'content' => $template->render_php($this->inc_path."tags/create_tag.php", $this->data)
                    ]);

                    return $template;

                } else {

                    $tag = new Tag();

                    $tag->keyword = $tag_name;

                    $result = $tag->save();

                    if ($result) {

                        header("Location: all-tags");

                    } else {

                        $this->data['errors'] = "An error occurred";

                        $template->view($this->layouts_path,[
                            'title' => 'Tag create',
                            'content' => $template->render_php($this->inc_path."tags/create_tag.php", $this->data)
                        ]);

                        return $template;
                    }

                }


            } else {

                echo "You have to create tag by click button";

            }


        } catch (\Exception $e) {

            return $this->return500();

        }

    }


    public function edit()
    {
        if (isset($_GET['tagID'])) {

            $id = $_GET['tagID'];

            $tag = new Tag();

            $this->data['tag'] = $tag::query()
                ->where('id', $id)
                ->first();



        } else {

            return $this->return404();

        }

        $template = new Template();

        $template->view($this->layouts_path,[
            'title' => 'Tag update',
            'content' => $template->render_php($this->inc_path."tags/tag.php", $this->data)
        ]);

        return $template;
    }



    public function update()
    {

        try {

            $tag = new Tag();
            $template = new Template();
            $tag_name = $_POST['tag'];

            if (!isset($_GET['tagID'])) {

                return $this->return404();

            } else {

                $id = $_GET['tagID'];

                if (isset($_POST['btnUpdateTag'])) {

                    $validation = new TagUpdate($_POST);

                    $this->data['errors'] = $validation->validateForm();


                    if (count($this->data['errors']) > 0 ) {

                        $this->data['tagParam'] = ['tag' => $tag_name, 'id' => $id];

                        $template->view($this->layouts_path,[
                            'title' => 'Tag update',
                            'content' => $template->render_php($this->inc_path."tags/tag.php", $this->data)
                        ]);

                        return $template;

                    } else {



                        $tag::query()
                            ->where('id', $id)
                            ->update([
                                'keyword' => $tag_name,
                                'updated_at' => date("Y-m-d H:i:S")
                            ]);


                        header("Location: all-tags");
                    }


                } else {

                    echo "You have to update role by submit click";

                }

            }


        } catch (\Exception $e) {

            return $this->return500();

        }


    }


    public function delete()
    {

        try {

            if (!isset($_GET['tagID'])) {

                return $this->return404();

            } else {

                $id = $_GET['tagID'];

                $tag = new Tag();

                $tag::query()
                    ->where('id', $id)
                    ->delete();

                header("Location: all-tags");

            }


        } catch (\Exception $e) {

            return $this->return500();

        }

    }
}