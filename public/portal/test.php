<?php

    $all_times = array();
    $start_date = 1;
    $end_date = 5;

    $index = 0;
    // for($i=$start_date; $i<=$end_date; $i++){
    //     $current_date="2018-04-0$i";
    //     for($j=8; $j<=16; $j++){
    //         $current_time = "$current_date $j:00";
    //         $all_time[$index]["date"] = $current_time;
    //         $all_time[$index]["time"] = strtotime($current_time);
    //         $index++;
    //     }
    // }

    // echo json_encode($all_time);

    //function to find all the working peroids of a given counsellor
    function get_all_work_peroid($start_day, $end_day, $start_time, $end_time){
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



    //testing the function
    //$times = get_available_time("monday", "friday", "8:30", "16:30");
    $times = get_available_time("monday", "monday", "8:30", "16:30");
    echo json_encode($times);
    header("Content-type: application/json");
?>