<?php 

    class Announcement extends DatabaseObject{
        //class attributes
        public $id;
        public $title;
        public $content;
        public $image;
        public $created_by_user;
        public $date_created;
       
        //databaseobject requirements 
        protected static $table_name = "announcement";
        protected static $db_fields = array('id' , 'title', 'content', 'created_by_user', 'image', 'date_created');
    }
?>