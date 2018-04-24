<div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Announcement Form</h4>
                    </div>
                    <div class="content">
                        <form method="POST" enctype="multipart/form-data" action="../includes/actions/make_announcement_action.php">

                            <input type="text" name="created_by_user" hidden value="<?php echo $user_id;?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control border-input">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Content</label>
                                        <textarea rows="5" name="content" class="form-control border-input" placeholder="Here can be your description" value="Mike"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Add Image</label>
                                        <div class="btn-group">
                                            <input name="image_file" type="file"  data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info btn-fill btn-wd">Done</button>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>