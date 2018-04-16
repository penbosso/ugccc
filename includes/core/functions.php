<?php
function strip_zeros_from_date($date=""){
  //removes marked zeros
  $no_zeros=str_replace('*0', '', $date);
  //removes any remaining marks
  $cleaned_string=str_replace('*', '', $no_zeros);
  return $cleaned_string;
}

function redirect_to($location=NULL){
  //redirects to a given page
  if($location!=NULL){
    header("Location:{$location}");
    exit;
  }
}

function output_message($message="", $class="" , $message_return=''){
  //displays a paragraphed text
  if(!empty($message)&& $class == "success"){
    $message_display = "<div class='row'><div class='col-sm-offset-1 col-sm-10 alert alert-success alert-dismissable'>".
            "<a href=''#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>{$message}</div></div>";
  } elseif(!empty($message)&& $class == "fail"){
    $message_display = "<div class='row'><div class='col-sm-offset-1 col-sm-10 alert alert-danger alert-dismissable'>".
              "<a href=''#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>{$message}</div></div>";
  }elseif(!empty($message)&& $class == "info"){
    $message_display = "<div class='row'><div class='col-sm-offset-1 col-sm-10 alert alert-info alert-dismissable'>".
              "<a href=''#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>{$message}</div></div>";
  } else {
    $message_display = "";
  }

  if($message_return == 'r'){
      return $message_display;
  } else {
      echo $message_display;
  }
}

function __autoload($class_name){
    //this function handles classes that haven't being included
    $class_name=strtolower($class_name);
    $path=LIB_PATH.DS."{$class_name}.php";
    if(file_exists($path)){
      require_once($path);
    }else{
      die("The file {$class_name}.php could not be found");
    }
}

function datetime_to_text($datetime=""){
  //displays the date in a different format
  $unixdatetime = strtotime($datatime);
  return Strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}

function get_displayable_date($date_string=""){
    //gives time from a given string
    $unix_time = strftime('%d %B, %Y', strtotime($date_string));
    return $unix_time;
}

//makes a date acceptable to mysql database
function mysql_date_format($dt=""){
  $mysql_date=strftime("%Y-%m-%d", $dt);
  return  $mysql_date;
}

function mysql_datetime_format($dt=""){
  $mysql_date=strftime("%Y-%m-%d %H:%M:%S", $dt);
  return  $mysql_date;
}

?>
