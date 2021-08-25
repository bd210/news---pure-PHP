<?php
namespace controllers;

use classes\Template;
use models\Category;
use validationCategory\CreateCategory;
use validationCategory\UpdateCategory;

class CategoryController extends Controller
{


    public function index()
    {
        $category = new Category();
        $this->data['categories'] = $category::query()->orderBy('created_at', 'DESC')->get();

        $template = new Template();

        $template->view($this->layouts_path, [
            'title' => 'Categories',
            'content' => $template->render_php($this->inc_path."categories/all_categories.php", $this->data)
        ]);

        return $template;
    }



    public function create()
    {

        $template = new Template();

        $template->view($this->layouts_path, [
            'title' => 'Category Create',
            'content' => $template->render_php($this->inc_path."categories/create_category.php", $this->data)
        ]);

        return $template;

    }



    public function store()
    {

        try {

            if (isset($_POST['btnCreateCategory'])) {

                $validation = new CreateCategory($_POST);
                $this->data['errors'] = $validation->validateForm();

                $template = new Template();

                $cat_name = $_POST['category'];


                if (count($this->data['errors']) > 0 ) {

                    $this->data['categoryParams'] = ['category' => $cat_name ];

                    $template->view($this->layouts_path,[
                        'title' => 'Category create',
                        'content' => $template->render_php($this->inc_path."categories/create_category.php", $this->data)
                    ]);

                    return $template;

                } else {

                    $category = new Category();

                    $category->category_name = $cat_name;

                    $result = $category->save();

                    if ($result) {

                        header("Location: all-categories");

                    } else {

                        $this->data['errors'] = "An error occurred";

                        $template->view($this->layouts_path,[
                            'title' => 'Category create',
                            'content' => $template->render_php($this->inc_path."categories/create_category.php", $this->data)
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
        if (isset($_GET['categoryID'])) {

            $id = $_GET['categoryID'];

            $category = new Category();

            $this->data['category'] = $category::query()
                ->where('id', $id)
                ->first();



        } else {

            return $this->return404();

        }

        $template = new Template();

        $template->view($this->layouts_path,[
            'title' => 'Category update',
            'content' => $template->render_php($this->inc_path."categories/category.php", $this->data)
        ]);

        return $template;
    }



    public function update()
    {

        try {

            $category = new Category();
            $template = new Template();
            $cat_name = $_POST['category'];

            if (!isset($_GET['categoryID'])) {

                return $this->return404();

            } else {

                $id = $_GET['categoryID'];

                if (isset($_POST['btnUpdateCategory'])) {

                    $validation = new UpdateCategory($_POST);

                    $this->data['errors'] = $validation->validateForm();


                    if (count($this->data['errors']) > 0 ) {

                        $this->data['categoryParam'] = ['category' => $cat_name, 'id' => $id];

                        $template->view($this->layouts_path,[
                            'title' => 'Category update',
                            'content' => $template->render_php($this->inc_path."categories/category.php", $this->data)
                        ]);

                        return $template;

                    } else {



                        $category::query()
                            ->where('id', $id)
                            ->update([
                                'category_name' => $cat_name,
                                'updated_at' => date("Y-m-d H:i:S")
                            ]);


                        header("Location: all-categories");
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

            if (!isset($_GET['categoryID'])) {

                return $this->return404();

            } else {

                $id = $_GET['categoryID'];

                $category = new Category();

                $category::query()
                    ->where('id', $id)
                    ->delete();

                header("Location: all-categories");

            }


        } catch (\Exception $e) {

            return $this->return500();

        }

    }

}