<?php 

    class Complaint extends DatabaseObject{
        //class attributes
        public $id;
        public $student_id;
        public $date_logged;
        public $date_couns_started;
        public $date_couns_ended;
        public $stressor;
        public $short_desc;
        
        //databaseobject requirements 
        protected static $table_name = "complaint";
        protected static $db_fields = array('id' , 'student_id', 'date_logged', 'date_couns_started', 
                                            'date_couns_ended', 'stressor', 'short_desc');
    }
?>