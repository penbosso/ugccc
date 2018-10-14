<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">File A complaint Form</h4>
                </div>
                <div class="content">
                    <form method="POST" action="../includes/actions/refer_session.php">
                            <!--div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="date" class="form-control border-input" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Location</label>
                                        <input type="text" class="form-control border-input" >
                                    </div>
                                </div>
                            </div-->
                                <input type="hidden" name="complaint_id" id="complaint_id" value="<?php echo $complaint_id; ?>"/>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Counsellor</label>
                                        <select name="counsel_id">
                                        <?php 
                                            $sql = "SELECT c.* FROM counsellor c JOIN user u ON c.user_id = u.id"
                                            ." WHERE NOT u.id='$user_id'";
                                            $counsellors = Counsellor::find_by_sql($sql);
                                            foreach ($counsellors as $counsellor ) {
                                                $counsellor_details = User::find_by_id($counsellor->user_id);
                                                $display_name = ucwords($counsellor_details->title." "
                                                .$counsellor_details->first_name." "
                                                                        .$counsellor_details->other_names." "
                                                                        .$counsellor_details->last_name);
                                                                        ?>
                                            <option value="<?php echo $counsellor->id; ?>"><?php echo $display_name; ?> </option>
                                            <?php } 
                                            $available_booking = Counsellor::get_available_booking($counsellor->id); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sellect Time</label>
                                        
                                        <select name="scheduled_date">
                                         <?php foreach($available_booking as $booking){ ?>
                                            <option value="<?php echo $booking; ?>"><?php echo strftime("%a %d, %b %Y %H:%M GMT", $booking); ?></option>
                                         <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="" id="approve_appt_confirm">CONFIRM</button>
                            <button type="button" class="" data-dismiss="modal">CLOSE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>