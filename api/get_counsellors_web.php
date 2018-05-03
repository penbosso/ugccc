<?php 
/* purpose: this returns the available time slots for a successfully assigned counsellor
            or a success message in case counsellor is not found
            
    Status codes => their meaning
        0        => counsellor assigned successfully
        1        => invalid REQUEST_METHOD
        2        => invalid student details
        3        => failed to file complaint
        4        => no counsellor assigned
*/

//including contants definition file
include('../includes/initialize.php');


          //create new complaint
        $complaint = new complaint();
        //fetch complaint details
        $complaint->stressor = isset($_GET["stressor"]) ? trim($_GET["stressor"]) : "";
        $complaint->short_desc = isset($_GET["short_desc"]) ? trim($_GET["short_desc"]) : "";
        //$complaint->student_id = $student->id;
        $complaint->date_logged = mysql_date_format(time());
        $complaint->date_couns_started = null;
        $complaint->date_couns_ended = null;

            //if complaint saved then find a counsellor for the given stressor
            $sql = "SELECT cs.* FROM speciality s JOIN counsellor_speciality cs ON " 
                 . "cs.speciality_id=s.id WHERE s.name LIKE '{$complaint->stressor}'";
            //get all the counsellors with speciality in the given stressor
            $counsellor_specialities = CounsellorSpeciality::find_by_sql($sql);
            $selected_counsellor = -1;
            if(count($counsellor_specialities)>0){
            //finds and the  id of a system selected counsellor 
            $selected_counsellor = Counsellor::get_selected_counsellor($counsellor_specialities);
            }

            if($selected_counsellor != -1){
                //get the available booking for the given counsellor
                $available_booking = Counsellor::get_available_booking($selected_counsellor);
                $sql = "SELECT u.* FROM user u JOIN counsellor c ON u.id=c.user_id WHERE c.id='{$selected_counsellor}'";
                $userobject = User::find_by_sql($sql);
                $user = array_shift($userobject);
            

                $name = ucwords($user->title." ".$user->first_name." ".$user->last_name." ");
                ?>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Assigned Counsellor</label>
                                <input type="text" class="form-control border-input" disabled="true" value="<?php echo $name; ?>">
                                <input type="hidden" name="counsellor_id" value="<?php echo $selected_counsellor; ?>">
                            </div>
                    </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Time</label>
                                <select class="form-control border-input" name="scheduled_date">
                                    <?php foreach($available_booking as $booking){ ?>
                                    <option value="<?php echo $booking; ?>"><?php echo strftime("%a %d, %b %Y %H:%M GMT", $booking); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
<?php } else { } ?>

            