<?php
namespace controllers;

use classes\Template;
use models\BadWord;
use validationBadWord\CreateBadWord;
use validationBadWord\UpdateBadWord;

class BadWordController extends Controller
{

    public function index(){

        $word = new BadWord();
        $this->data['forbidden'] = $word::query()->orderBy('created_at', 'DESC')->get();

        $template = new Template();

        $template->view($this->layouts_path, [
            'title' => 'Forbidden words',
            'content' => $template->render_php($this->inc_path."bad_words/all_bad_words.php", $this->data)
        ]);

        return $template;

    }



    public function create()
    {

        $template = new Template();

        $template->view($this->layouts_path, [
            'title' => 'Forbidden Word Create',
            'content' => $template->render_php($this->inc_path."bad_words/create_bad_word.php", $this->data)
        ]);

        return $template;

    }



    public function store()
    {

        try {

            if (isset($_POST['btnCreateBadWord'])) {

                $validation = new CreateBadWord($_POST);
                $this->data['errors'] = $validation->validateForm();

                $template = new Template();

                $word = $_POST['word'];


                if (count($this->data['errors']) > 0 ) {

                    $this->data['wordParams'] = ['word' => $word ];

                    $template->view($this->layouts_path,[
                        'title' => 'Forbidden Word create',
                        'content' => $template->render_php($this->inc_path."bad_words/create_bad_word.php", $this->data)
                    ]);

                    return $template;

                } else {

                    $bad_word = new BadWord();

                    $bad_word->word = $word;

                    $result = $bad_word->save();

                    if ($result) {

                        header("Location: all-forbidden-words");

                    } else {

                        $this->data['errors'] = "An error occurred";

                        $template->view($this->layouts_path,[
                            'title' => 'Forbidden Word create',
                            'content' => $template->render_php($this->inc_path."bad_words/create_bad_word.php", $this->data)
                        ]);

                        return $template;
                    }

                }


            } else {

                echo "You have to create forbidden word by click button";

            }


        } catch (\Exception $e) {

            return $this->return500();

        }

    }


    public function edit()
    {
        if (isset($_GET['forbiddenID'])) {

            $id = $_GET['forbiddenID'];

            $bad_word = new BadWord();

            $this->data['word'] = $bad_word::query()
                ->where('id', $id)
                ->first();



        } else {

            return $this->return404();;

        }

        $template = new Template();

        $template->view($this->layouts_path,[
            'title' => 'Forbidden word update',
            'content' => $template->render_php($this->inc_path."bad_words/bad_word.php", $this->data)
        ]);

        return $template;
    }



    public function update()
    {

        try {

            $bad_word = new BadWord();
            $template = new Template();
            $word = $_POST['word'];

            if (!isset($_GET['forbiddenID'])) {

                return $this->return404();;

            } else {

                $id = $_GET['forbiddenID'];

                if (isset($_POST['btnUpdateBadWord'])) {

                    $validation = new UpdateBadWord($_POST);

                    $this->data['errors'] = $validation->validateForm();


                    if (count($this->data['errors']) > 0 ) {

                        $this->data['wordParam'] = ['word' => $word, 'id' => $id];

                        $template->view($this->layouts_path,[
                            'title' => 'Forbidden word update',
                            'content' => $template->render_php($this->inc_path."bad_words/bad_word.php", $this->data)
                        ]);

                        return $template;

                    } else {



                        $bad_word::query()
                            ->where('id', $id)
                            ->update([
                                'word' => $word,
                                'updated_at' => date("Y-m-d H:i:S")
                            ]);


                        header("Location: all-forbidden-words");
                    }


                } else {

                    echo "You have to update forbidden word by submit click";

                }

            }


        } catch (\Exception $e) {

            return $this->return500();

        }


    }



    public function delete()
    {

        try {

            if (!isset($_GET['forbiddenID'])) {

                return $this->return404();

            } else {

                $id = $_GET['forbiddenID'];

                $bad_word = new BadWord();

                $bad_word::query()
                    ->where('id', $id)
                    ->delete();

                header("Location: all-forbidden-words");

            }


        } catch (\Exception $e) {

            return $this->return500();

        }

    }


}