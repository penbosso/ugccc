<?php 

    class CounsellorSpeciality extends DatabaseObject{
        //class attributes
        public $id;
        public $counsel_id;
        public $speciality_id;
       
        
        //databaseobject requirements 
        protected static $table_name = "counsellor_speciality";
        protected static $db_fields = array('id' , 'counsel_id', 'speciality_id');
    }
?>