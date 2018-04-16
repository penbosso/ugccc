<?php 

    class Location extends DatabaseObject{
        //class attributes
        public $id;
        public $name;
       
        
        //databaseobject requirements 
        protected static $table_name = "location";
        protected static $db_fields = array('id' , 'name');
    }
?>