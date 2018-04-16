<?php 

    class User extends DatabaseObject{
        //class attributes
        public $id;
        public $last_name;
        public $first_name;
        public $other_names;
        public $title;
        public $email;
        public $password;
        public $user_type;
       
        
        //databaseobject requirements 
        protected static $table_name = "user";
        protected static $db_fields = array('id' , 'last_name', 'first_name', 'other_names',
                                            'title','email', 'password','user_type');
    }
?>