<?php
    //defines the core paths , classes and constants

    //DIRECTORY_SEPERATOR a pre-defined constant  (\ for windows , / for unix)
    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

    //SITE_ROOT::defines the file system path to the project
    //must be changed if on a different machine
    defined('SITE_ROOT')?null:
    define('SITE_ROOT', DS.'var'.DS.'www'.DS.'html'.DS.'ugccc');

    //LIB_PATH::defines the path to the includes folder which contains all
    //the libraries
    defined('LIB_PATH')?null:define('LIB_PATH', SITE_ROOT.DS.'includes');

    //core classes
    require_once(LIB_PATH.DS.'core'.DS.'config.php');
    require_once(LIB_PATH.DS.'core'.DS.'database.php');
    require_once(LIB_PATH.DS.'core'.DS.'database_object.php');

    //utilities
    require_once(LIB_PATH.DS.'core'.DS.'functions.php');

    //models classes
    require_once(LIB_PATH.DS.'models'.DS.'user.php');
    require_once(LIB_PATH.DS.'models'.DS.'announcement.php');
    require_once(LIB_PATH.DS.'models'.DS.'speciality.php');
    require_once(LIB_PATH.DS.'models'.DS.'counsellor.php');
    require_once(LIB_PATH.DS.'models'.DS.'counsellor_speciality.php');
    require_once(LIB_PATH.DS.'models'.DS.'student.php');
    require_once(LIB_PATH.DS.'models'.DS.'complaint.php');
    require_once(LIB_PATH.DS.'models'.DS.'assign_counsellor.php');
    require_once(LIB_PATH.DS.'models'.DS.'booking.php');
    require_once(LIB_PATH.DS.'models'.DS.'location.php');

    
?>
