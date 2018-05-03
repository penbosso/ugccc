<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">File A complaint Form</h4>
                </div>
                <div class="content">
                    <form method="post" action="../includes/actions/assign_counsellor.php">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Student ID</label>
                                    <input type="text" name="student_id" class="form-control border-input" >
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Problem/Stressor</label>
                                    <select name="stressor" class="form-control border-input" onchange="showHint(this.value)">
                                        <option>Choose.....</option>
                                        <?php 
                                            $specialiaties = Speciality::find_all();
                                            foreach ($specialiaties as $speciality) {
                                        ?>
                                          <option value="<?php echo $speciality->name; ?>"><?php echo ucwords($speciality->name); ?></option>  
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea name="short_desc" rows="5" class="form-control border-input" placeholder="Here can be your description"></textarea>
                                </div>
                            </div>
                        </div>

                        <div id="txtHint"></div>



                        <div class="text-center">
                            <button type="submit" class="btn btn-info btn-fill btn-wd">Submit</button>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>