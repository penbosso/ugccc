<?php 

    class Speciality extends DatabaseObject{
        //class attributes
        public $id;
        public $name;
       
        
        //databaseobject requirements 
        protected static $table_name = "speciality";
        protected static $db_fields = array('id' , 'name');
    }
?>