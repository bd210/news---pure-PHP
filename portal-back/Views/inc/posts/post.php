<?php

$middleware = new \classes\Middleware();
if (isset($data['post'])) :

    $postID = $data['post']->id;

    $videos = array('mp4');
    $images = array('png', 'jpg', 'jpeg');
    $audios = array('mp3', 'wma');



    ?>

    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-12">
            <div class="white-box">
                <div class="user-bg">
                    <?php
                        if (isset($data['post']['files']) && $data['post']['files'] != null)  :

                         $result  =  \classes\PostFunction::returnFirstImg($data['post']['files']);

                        if ($result) {

                            echo  '<img src="images/'. $result .'" alt="post file" width="100%" height="100%" />';

                        } else {


                            echo '<img src="https://i.pinimg.com/originals/10/b2/f6/10b2f6d95195994fca386842dae53bb2.png" width="100%" alt="user" />';
                        }


                     else : echo "NO FILES";
                     endif;
                    ?>
                </div>
                <div class="user-btm-box mt-5 d-md-flex">
                    <div class="col-md-4 col-sm-4 text-center">

                        <h3>Author : </h3>
                    </div>
                    <h3><a href="view-user-profile?userID=<?= $data['post']['author']->id  ?>"><?= $data['post']['author']->first_name . " " . $data['post']['author']->last_name ?></a></h3>

                </div>
                <?php if (isset($data['likes']) && $data['likes'] > 0 ) :

                    echo "<i class=' far fa-thumbs-up' style='color: #0b5ed7'> "."Likes : ".$data['likes']."</i>";


                else : echo "<h3 style='color: red'>No likes yet</h3>";

                endif;
                ?>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="update-post?postID=<?= $postID ?>" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Title</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" name="title"
                                       class="form-control p-0 border-0" value="<?= $data['post']['title']  ?>"> </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Content</label>
                            <div class="col-md-12 border-bottom p-0">

                                <textarea name="content" class="form-control p-0 border-0"> <?= $data['post']['content']  ?>  </textarea>

                        </div>

                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">File</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="file"
                                       class="form-control p-0 border-0" name="file[]" multiple > </div>
                        </div>

                            <div class="form-group mb-4">
                                <?php
                                if (isset($data['post']['tags'])) {
                                        echo "Current tags : ";
                                    foreach ($data['post']['tags'] as $tag) {

                                        echo "<li>". $tag->keyword ."</li>";
                                    }
                                }

                                ?>
                                <br/>

                                <label class="col-sm-12">Select Tags</label>
                                <div class="col-sm-12 border-bottom">
                                    <select class="form-select shadow-none p-0 border-0 form-control-line" name="tag[]" multiple>
                                        <option value="0">Choose tags... </option>
                                        <?php if (isset($data['tags'])) :

                                            foreach ($data['tags'] as $tag) :
                                                ?>
                                                <option  value="<?= $tag->id ?>"> <?= $tag->keyword ?></option>

                                            <?php
                                            endforeach;

                                        else : echo "NO TAG";
                                        endif;
                                        ?>
                                    </select>
                                </div>
                            </div>


                        <div class="form-group mb-4">
                            <label class="col-sm-12">Select Category</label>

                            <div class="col-sm-12 border-bottom">
                                <select class="form-select shadow-none p-0 border-0 form-control-line" name="category">
                                    <option value="<?= $data['post']['categories']->id ?>"><?= $data['post']['categories']->category_name ?></option>
                                    <?php if (isset($data['categories'])) :

                                        foreach ($data['categories'] as $category) :
                                            ?>
                                            <option  value="<?= $category->id ?>"> <?= $category->category_name ?></option>

                                        <?php
                                        endforeach;

                                    else : echo "NO CATEGORY";
                                    endif;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="col-sm-12">

                                <?php if ($middleware->canUpdatePost()): ?>
                                <button class="btn btn-success" name="btnUpdatePost">Update Post</button>
                                <?php

                                else : echo "<b>You dont have this permission</b>";
                                endif; ?>

                            </div>
                        </div>
                    </form> <br/>

                    <?php
                    if (isset($_SESSION['errors'])) {

                        foreach ($_SESSION['errors'] as $error) {

                            echo "<div class='alert-warning'>". $error ."</div>";
                        }

                    }
                    ?>
                    <br/>
                    <div>
                        <h3>All files</h3>
                       <form >

                           <?php

                           if (isset($data['post']['files'][0] ) ) :
                           foreach ($data['post']['files'] as $file) :

                               $ext = pathinfo($file->file_name, PATHINFO_EXTENSION);

                            if (in_array($ext, $images)) {

                                echo '<img src="images/'. $file->file_name .'" alt="post file" width="100px" height="100px" /> 
                               
                            
                                <a href="delete-post-file?postID=' .$postID .'&fileID='. $file->id .'">Delete</a> ';


                            } elseif (in_array($ext, $videos)) {


                                echo '<video controls src="images/'. $file->file_name .'" alt="post file" width="200px" height="200px" ></video> <a href="delete-post-file?postID='. $postID .'&fileID='. $file->id .'">Delete</a>';

                            } elseif (in_array($ext, $audios)) {


                                echo '<audio controls src="images/'. $file->file_name .'" alt="post file" width="100px" height="100px" ></audio> <a href="delete-post-file?postID='. $postID .'&fileID='. $file->id .'">Delete</a>';

                            }


                               endforeach;
                            else : echo "NO FILES";
                            endif;

                            ?>

                       </form>

                        <?php

                        if (isset( $_SESSION['errorValidation'])) {

                            foreach ( $_SESSION['errorValidation'] as $error) {

                                echo "<div class='alert-warning'>". $error ."</div>";
                            }

                        }


                        ?>



                    </div>
                </div>


            </div>

        </div>
        <!-- Column -->
    </div>

<?php

else : echo "<h2>NEW DOES NOT EXIST</h2>";

endif;

unset($_SESSION['errorValidation']);
?>