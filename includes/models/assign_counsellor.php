<?php 

    class AssignCounsellor extends DatabaseObject{
        //class attributes
        public $id;
        public $counsel_id;
        public $date_assigned;
        public $complaint_id;
       
        
        //databaseobject requirements 
        protected static $table_name = "assign_counsellor";
        protected static $db_fields = array('id' , 'counsel_id', 'date_assigned', 'complaint_id');
    }
?>