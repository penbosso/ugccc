<?php //require_once (LIB_PATH.DS.'core'.DS.'database.php');
//includes all common methods called on all database objects returned on a query
// 'static::[attribute or method]' is used to access the info of the calling object
// that is static but not this object's info


class DatabaseObject{

  public function create(){
    $this->id = 0;
    //used to create a new object by instantiating an object
    //and saving it to the database
    global $database;
    //gets all the attributes of the calling class
    $attributes=static::sanitized_attributes();
    $sql="INSERT INTO ".static::$table_name."( ";
    $sql.=join(", ", array_keys($attributes));
    $sql.=") VALUES( '";
    $sql.=join("', '", array_values($attributes));
    $sql.=" ')";
    //username, password, first_name, last_name)";
    // $sql.=$database->escape_value($this->username)."','";
    // $sql.=$database->escape_value($this->password)."','";
    // $sql.=$database->escape_value($this->first_name)."','";
    // $sql.=$database->escape_value($this->last_name)."')";
    if($database->query($sql)){
      $this->id=$database->insert_id();
      return true;
    }else{
      return false;
    }
  }

  //used to update an object by setting the info in the db to
  public function update(){
  //the new info on the object and saving it to the database
    global $database;
    $attributes=static::sanitized_attributes();
    $attribute_pairs=array();
    foreach ($attributes as $key => $value) {
      if ($value == '') {
        $attribute_pairs[]="{$key}=NULL";
      } else {
        $attribute_pairs[]="{$key}='{$value}'";
      }
    }
    $sql="UPDATE ".static::$table_name." SET ";
    $sql.=join(", ",$attribute_pairs);
    // $sql.="username='".$database->escape_value($this->username)."' ,";
    // $sql.="password='".$database->escape_value($this->password)."' ,";
    // $sql.="first_name='".$database->escape_value($this->first_name)."' ,";
    // $sql.="last_name='".$database->escape_value($this->last_name)."' ";
    $sql.=" WHERE id=".$database->escape_value($this->id);
    //echo $sql;
    $database->query($sql);
    return($database->affected_rows()==1)? true : false;
  }

  public function save(){
    //determines which function to perform
    //that's preventing the same record to be created more than once
    //new records don't have id
    return isset($this->id)?$this->update():$this->create();
  }

  public function delete(){
    //used to delete a record
    global $database;

    $sql="DELETE FROM ".static::$table_name." WHERE id=".$database->escape_value($this->id);
    $sql.=" LIMIT 1";
    $database->query($sql);
    return($database->affected_rows()==1)? true : false;
  }

  public static function find_all(){
    //returns all records stored in the table specified in the child class
    return self::find_by_sql("SELECT * FROM ".static::$table_name);
  }

  public static function find_all_with($condition=""){
    //returns all records stored in the table specified in the child class
    return self::find_by_sql("SELECT * FROM ".static::$table_name." WHERE ".$condition);
  }

  public static function find_by_id($id=0){
    //returns array of a record by id
    global $database;
    $result_array=self::find_by_sql("SELECT * FROM ".static::$table_name." WHERE id=".$database->escape_value($id)." LIMIT 1");
    //returns the first element in the array
    return !empty($result_array)?array_shift($result_array):false;
  }

  public static function find_by_sql($sql=""){
    //DOC::returns an array of  objects based on a specific query
    //IMP::accesing the $database object created in the 'database.php' file
    //and calling the class method query
    global $database;
    $result_set=$database->query($sql);
    //an array of objects
    $object_array=array();
    //for every record fetched from the db,
    //an object is created and it's attributes are assigned
    while($row=$database->fetch_array($result_set)){
      $object_array[]=self::instantiate($row);
    }
    return $object_array;
  }

  public static function count_all(){
    //returns the count of the records in a table
    global $database;
    $sql="SELECT COUNT(*) FROM ".static::$table_name;
    $result_set=$database->query($sql);
    $row=$database->fetch_array($result_set);
    return array_shift($row);
  }

  private static function instantiate($record){
    $object=new static;
    //sets all the properties of a record from the database to an object of the
    //subclass
    foreach($record as $attribute=>$value){
      if($object->has_attribute($attribute)){
        //assigns the value of $record[$attribute] to $object->$attribute
        $object->$attribute=$value;
      }
    }
    return $object;
  }

  private function has_attribute($attribute){
    //checks if the object has the given attribute
    //this fetchs all the variables(attributes)of the object [private or public]
    $object_vars= $this->attributes();
    //checks if the attribute is part of the object_vars
    return array_key_exists($attribute, $object_vars);
  }

  protected function attributes(){
    //returns an array of attribute keys and their values
    //fetches all the fields in the db_fields array and stores them in
    //a new array so that only the db related attributes are returned
    foreach(static::$db_fields as $field){
      if(property_exists($this, $field)){
        $attributes[$field]=$this->$field;
      }
    }
    return $attributes;
  }

  protected function sanitized_attributes(){
    global $database;
    $clean_attributes=array();
    foreach($this->attributes() as $key=>$value){
        $clean_attributes[$key]=$database->escape_value($value);
    }
    return $clean_attributes;
  }
}
?>
