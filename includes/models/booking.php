<?php 

    class Booking extends DatabaseObject{
        //class attributes
        public $id;
        public $scheduled_date;
        public $location_id;
        public $assign_counsellor_id;
       
        
        //databaseobject requirements 
        protected static $table_name = "booking";
        protected static $db_fields = array('id' , 'scheduled_date', 'location_id', 'assign_counsellor_id');
    }
?>