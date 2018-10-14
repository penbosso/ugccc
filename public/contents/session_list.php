<?php 
    //get user details with given id $user_id
    $user = User::find_by_id($user_id);
    
    //check the type of user
    if($user->user_type == "counsellor"){
        $time = time();
        //sql to fetch all bookings for given counsellor 
        $sql = "SELECT b.* FROM user u JOIN counsellor c ON u.id=c.user_id "
            ." JOIN assign_counsellor ac ON c.id=ac.counsel_id JOIN booking b "
            ." ON ac.id=b.assign_counsellor_id WHERE u.id='{$user->id}' AND b.scheduled_date>='$time'";
        $bookings = Booking::find_by_sql($sql);
        $complaints = 0;
    } elseif($user->user_type == "front_desk") {
        $sql = "SELECT * FROM complaint WHERE stressor='Others...' OR stressor='Choose.....' AND id NOT IN "
             . "(SELECT complaint_id FROM assign_counsellor)";
        $complaints = Complaint::find_by_sql($sql);
        $bookings  = 0;
    } 

    if(!$bookings && !$complaints){
        output_message("no counselling sessions found", "fail");
    } elseif($complaints){
?>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Sessions</h4>
                    <p class="category">Here is a subtitle for this table</p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Datetime</th>
                            <th>Stressor</th>
                            <th>Description</th>
                            <th>Session Actions</th>
                        </thead>
                        <tbody>
                        <?php 
                            $i =1;
                            foreach($complaints as $complaint){ 
                                $sql = "SELECT s.* FROM  complaint c JOIN student s ON s.id= c.student_id "
                                    . "WHERE c.id='{$complaint->id}' ";
                                $result = Student::find_by_sql($sql);
                                $student = array_shift($result);
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo ucwords($student->first_name." ".$student->other_names." ".$student->last_name); ?></td>
                                <td>-</td>
                                <td>Others...</td>
                                <td><?php echo $complaint->short_desc; ?></td>
                                <td>
                                   <a data-toggle ="modal" data-id="<?php echo $complaint->id; ?>" href="?page=assign_counsellor&cid=<?php echo $complaint->id; ?>" class="assignModal"> Assign Counsellor </a> 
                                </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
</div>

<?php }   else {  ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Sessions</h4>
                    <p class="category">Here is a subtitle for this table</p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Datetime</th>
                            <th>Stressor</th>
                            <th>Description</th>
                            <th>Session Actions</th>
                        </thead>
                        <tbody>
                        <?php 
                            $i =1;
                            foreach($bookings as $booking){ 
                                $sql = "SELECT s.* FROM booking b JOIN assign_counsellor ac ON ac.id=b.assign_counsellor_id "
                                    . "JOIN complaint c ON c.id=ac.complaint_id JOIN student s ON s.id= c.student_id "
                                    . "WHERE b.id='{$booking->id}' ";
                                $result = Student::find_by_sql($sql);
                                $student = array_shift($result);

                                $sql = "SELECT c.* FROM booking b JOIN assign_counsellor ac ON ac.id=b.assign_counsellor_id "
                                    . "JOIN complaint c ON c.id=ac.complaint_id "
                                    . "WHERE b.id='{$booking->id}' ";
                                $result = Complaint::find_by_sql($sql);
                                $complaint = array_shift($result);

                                $sql = "SELECT ac.* FROM booking b JOIN assign_counsellor ac ON ac.id=b.assign_counsellor_id "
                                    . "JOIN complaint c ON c.id=ac.complaint_id "
                                    . "WHERE b.id='{$booking->id}' ";
                                $result = AssignCounsellor::find_by_sql($sql);
                                $assign_counsellor = array_shift($result);
                            
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo ucwords($student->first_name." ".$student->other_names." ".$student->last_name); ?></td>
                                <td><?php echo strftime("%a %d, %b %Y %H:%M GMT", $booking->scheduled_date); ?></td>
                                <td><?php echo ucwords($complaint->stressor); ?></td>
                                <td><?php echo $complaint->short_desc; ?></td>
                                <td>
                                    <?php if($user->user_type == "counsellor"){ ?>
                                    <?php if($complaint->date_couns_started == "") { ?>
                                    <a data-toggle ="modal" data-id="<?php echo $complaint->id; ?>" href="#start_sess_modal" class="startModal">Start </a> 
                                    <?php } else { if($complaint->date_couns_ended == ""){?>
                                    <a data-toggle ="modal" data-id="<?php echo $assign_counsellor->id; ?>" href="#add_sess_modal" class="addModal"> Add </a> |
                                    <a data-toggle ="modal" data-id="<?php echo $booking->id; ?>" href="#remove_sess_modal" class="removeModal"> Remove </a> |
                                    <a data-toggle ="modal" data-id="<?php echo $complaint->id; ?>" href="#end_sess_modal" class="endModal"> End </a> 
                                    <?php } } } ?>
                                    <?php if(($complaint->date_couns_ended != "")&&($complaint->date_couns_started != "")){ ?>
                                    <a data-toggle ="modal" data-id="<?php echo $complaint->id; ?>" href="?page=assign_counsellor&cid=<?php echo $complaint->id; ?>" class="referModal"> Refer </a> |
                                    <a data-toggle ="modal" data-id="<?php echo $booking->id; ?>" href="#remove_sess_modal" class="removeModal"> Remove </a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
</div>
<?php  } ?>