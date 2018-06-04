<?php 

    class Counsellor extends DatabaseObject{
        //class attributes
        public $id;
        public $type;
        public $start_time;
        public $end_time;
        public $start_day;
        public $end_day;
        public $user_id;
       
        
        //databaseobject requirements 
        protected static $table_name = "counsellor";
        protected static $db_fields = array('id' , 'type', 'start_time', 'end_time', 
                                            'start_day', 'end_day', 'user_id');

        //returns the id of the selected counsellor based on the given counsellor_specialities
        public static function get_selected_counsellor($counsellor_specialities){
            //variable to hold the various arrays
            $counsellors_array = array();  
            $count_of_objects = array(); 

            //loop through all the given counsellor_specialities
            foreach ($counsellor_specialities as $counsellor_speciality) {
                //find all the assignments for the counsellor of this speciality
                $sql = "SELECT * FROM assign_counsellor WHERE counsel_id='{$counsellor_speciality->counsel_id}'";
                $counsellors_array["$counsellor_speciality->counsel_id"] = AssignCounsellor::find_by_sql($sql);
                //map of the counsellor to the number of assignments
                $count_of_objects["$counsellor_speciality->counsel_id"] = count($counsellors_array["$counsellor_speciality->counsel_id"]);
            }

            //find the min of the counts
            $min_count = min($count_of_objects);
            //find the id of the counsellor with the min assignments
            $least_occuppied_counsellor = array_search($min_count, $count_of_objects);
            //return the id
            return $least_occuppied_counsellor;
        }

        //returns an array of all available booking times 
        public static function get_available_booking($selected_counsellor){
            //available_booking = all_booking - exiting_booking

            //get all working periods of the selected counsellor 
            $all_booking = self::get_all_work_period($selected_counsellor);
            //get all the booked sessions = 
            $booked_peroids = self::get_booked_period($selected_counsellor);
            //getting only the time column from all_booking
            $all_booking_time = array_column($all_booking,'time');
            
            //check if booked_periods != 0
            if( count($booked_peroids) != 0) {
                //if booked_periods != 0 

                //initialize available_booking to empty array
                $available_booking = array();

                $l_all_booking_time = $all_booking_time;
                //loop through booked_periods
                foreach ($booked_peroids as $booked_peroid) {
                    //check if current booked_period's scheduled_time in all_booking_time
                    if(in_array($booked_peroid->scheduled_date, $l_all_booking_time)){
                        //if current booked_period's scheduled_time in all_booking_time
                        //then remove current booked_period's scheduled_time from all_booking_time
                        $l_all_booking_time = array_diff($l_all_booking_time, ["$booked_peroid->scheduled_date"]);
                    }  
                }
                
                //assign result of operation to available time
                $available_booking = array_values($l_all_booking_time);
            } else {
                //if booked_peroids == 0  then available_booking = all_booking
                $available_booking = array_values($all_booking_time);
            }

           //return results of operations
           return $available_booking;
        }

        //function to find all the working peroids of a given counsellor
        private static function get_all_work_period($counsellor_id){
            //get the counsellors info
            $counsellor = Counsellor::find_by_id($counsellor_id);
            $start_day = $counsellor->start_day;
            $end_day = $counsellor->end_day;
            $start_time = $counsellor->start_time;
            $end_time = $counsellor->end_time;

            //converts days to integers
            $num_start_day = date('N', strtotime("$start_day"));
            $num_end_day = date('N', strtotime("$end_day")); 

            //convert the time to integers
            $num_start_time = date('H', strtotime("$start_time"));
            $num_end_time = date('H', strtotime("$end_time"));

            //initializing the return array of this function
            $available_time = array();

            //initializing index of array
            $index = 0;

            //looping through the days from start day to end day
            for ($current_day=$num_start_day; $current_day<=$num_end_day; $current_day++) {
                //converts integer day to text
                $day = date('l', strtotime("Sunday +{$current_day} days"));
                //gets the next date for this day
                $current_date = strftime("%Y-%m-%d", strtotime("next $day"));

                //looping through the time for each day from start time to end time
                for ($current_time=$num_start_time; $current_time < $num_end_time ; $current_time++) { 
                    //forming the date time string
                    $increment = $current_time - $num_start_time;
                    $current_date_time = "$current_date $start_time +$increment hours";

                    //converting date into a timestamp
                    $available_time[$index]["date"] = $current_date_time;
                    $available_time[$index]["time"] = strtotime($current_date_time);

                    //increase index of array
                    $index++;
                }
            }
            //returning the available time
            return $available_time;
        }

        //function to find all the booked peroids of a given counsellor
        private static function get_booked_period($counsellor_id){
            //booked peroids = all bookings for counsellor - all bookings >= current time
            //get current time
            $current_time = time();
            $sql = "SELECT b.*  FROM booking b JOIN assign_counsellor ac ON "
                 . "b.assign_counsellor_id=ac.id WHERE ac.counsel_id='{$counsellor_id}' AND "
                 . "b.scheduled_date>='{$current_time}'";
            $exiting_bookings = Booking::find_by_sql($sql);
            return $exiting_bookings;
        }

        //list all the current booking sessions with details of student counsellees 
        //for a given counsellor
        public static function check_booking_sessions($counsellor_id){
            //initializing response to be returned to an empty array
            $response = array();
            //get all bookings 
            $bookings = Counsellor::get_booked_period($counsellor_id);
            
            //print_r($bookings);
            //initialize a index for loop
            $index = 0;

            //loop through bookings
            foreach ($bookings as $booking) {
                //store booking info in booking index of array
                $response[$index]["booking"] = $booking;
                //get assign_counsellor ingfo
                $assign_counsellor = AssignCounsellor::find_by_id($booking->assign_counsellor_id);    
                //store assign_counsellor info in assign_counsellor index of array
                $response[$index]["assign_counsellor"] = $assign_counsellor;
                //get student information
                $sql = "SELECT s.* FROM complaint c JOIN student s ON c.student_id = s.id "
                      ." WHERE c.id = '{$assign_counsellor->complaint_id}'";      
                $student  = Student::find_by_sql($sql);
                //store student info in student index of array
                $response[$index]["student"] = array_shift($student);
                //increase index count
                $index++;
            }
            
            return $response;
        }
    }
?>