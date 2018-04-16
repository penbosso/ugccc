<?php 

    class Student extends DatabaseObject{
        //class attributes
        public $id;
        public $student_id;
        public $last_name;
        public $first_name;
        public $other_names;
        public $telephone;
        public $email;
        public $hall_of_residence;
        public $department;
        public $course;
        public $password;
        
        //databaseobject requirements 
        protected static $table_name = "student";
        protected static $db_fields = array('id' , 'student_id','last_name', 'first_name', 'other_names', 
                                            'telephone', 'email', 'hall_of_residence', 
                                            'department', 'course', 'password' );
    }
?>