

<div class="col-lg-8 col-xlg-9 col-md-12">
    <h2>CREATE NEWS</h2>
    <div class="card">

        <div class="card-body">

            <form action="create-post" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
                <div class="form-group mb-4">
                    <label class="col-md-12 p-0">Title</label>
                    <div class="col-md-12 border-bottom p-0">
                        <input type="text" placeholder="Title"
                               class="form-control p-0 border-0" name="title"
                               value="<?= isset($data['postParams']['title']) ? $data['postParams']['title']: ""  ?>"> </div>
                </div>

                <div class="form-group mb-4">
                    <label class="col-md-12 p-0">Content</label>
                    <div class="col-md-12 border-bottom p-0">
                        <textarea name="content" class="form-control p-0 border-0">
                        <?= isset($data['postParams']['content']) ? $data['postParams']['content']: ""  ?>
                        </textarea></div>
                </div>

                <div class="form-group mb-4">
                    <label class="col-md-12 p-0">File</label>
                    <div class="col-md-12 border-bottom p-0">
                        <input type="file"
                               class="form-control p-0 border-0" name="file[]" multiple > </div>
                </div>

                <div class="form-group mb-4">
                    <label class="col-sm-12">Category</label>

                    <div class="col-sm-12 border-bottom">
                        <select class="form-select shadow-none p-0 border-0 form-control-line" name="category">
                            <option value="0">Choose category...</option>
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
                    <label class="col-sm-12">Tags</label>

                    <div class="col-sm-12 border-bottom">
                        <select class="form-select shadow-none p-0 border-0 form-control-line"  name="tag[]" multiple >
                            <option value="0">Choose tags...</option>
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
                    <div class="col-sm-12">
                        <button class="btn btn-success" name="btnCreatePost">Create Post</button>
                        <?php
                        if (isset($data['errors'])) {

                            foreach ($data['errors'] as $error) {

                                echo "<div class='alert-warning'>". $error ."</div>";
                            }

                        }

                        if (isset($data['messageFile'])) {

                                echo "<div class='alert-warning'>". $data['messageFile'] ."</div>";

                        }
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>