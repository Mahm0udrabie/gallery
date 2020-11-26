<?php 
class Db_object {
    public $errors       = array();
    public $upload_errors_array = array(
        UPLOAD_ERR_OK         => "There is no error" ,
        UPLOAD_ERR_INI_SIZE   => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
        UPLOAD_ERR_FORM_SIZE  => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
        UPLOAD_ERR_PARTIAL    => "The uploaded file was only partially uploaded",
        UPLOAD_ERR_NO_FILE    => "No file was uploaded",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
        UPLOAD_ERR_EXTENSION  => "File upload stopped by extension"
        ); 

    public function set_file($file) {
        if(empty($file) || !$file || !is_array($file)){
            $this->errors[] = "There was no file uploaded here";
            return false;
        } elseif($file['error'] != 0){
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->user_image =  basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type     = $file['type'];
            $this->size     = $file['size'];
        }
    }
        //select all users 
    public static function find_all(){
        global $database;
        return static::find_by_query("SELECT * FROM ".static::$db_table." ");
        }

        //  select users by id
    public static function find_by_id($id){
        global $database;
    
        $the_result_array = static::find_by_query("SELECT * FROM ".static::$db_table." WHERE id ='$id'");
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    
    }

        //excute query by this query
    public static function find_by_query($sql){
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();
            while($row = mysqli_fetch_array($result_set)){
                $the_object_array[] = static::instantation($row);
            }  
          return $the_object_array;
        }

    public static function instantation($the_record){
        $calling_class = get_called_class(); 
        $the_object = new $calling_class;
            foreach ($the_record as $the_attribute => $value){
                if($the_object->has_the_attribute($the_attribute)){
                    $the_object->$the_attribute = $value;
                }
            }
        return $the_object;
    }

        // return value of the the exists key 
    private function has_the_attribute($the_attribute){
        $object_properites =  get_object_vars($this);
        return array_key_exists($the_attribute, $object_properites);
    }   

    protected function properties(){
        // return get_object_vars($this);
        $properties = array();
        foreach (static::$db_table_fields as $db_field) {
            if(property_exists($this, $db_field)){
                $properties[$db_field]= $this->$db_field; 
            }
        }
        return $properties;

    }

    protected function clean_properites(){
        global $database;
        $clean_properites = array();
        foreach ($this->properties() as $key => $value) {
            $clean_properites[$key] = $database->escape_string($value);
        }
        return $clean_properites;
    }

    public function save(){
        return isset($this->id) ? $this->update() : $this-> create();
    } //check update or create

    public function create(){
    global $database;
    $properties = $this->clean_properites();
    $sql = "INSERT INTO ".static::$db_table." ( ". implode(",", array_keys($properties)).") ";
    $sql .= " VALUES ('". implode("','", array_values($properties)) ."')";
        if($database->query($sql)){
            $this->id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }

    } // end create method

    public function update(){
        global $database;
        $properties = $this->clean_properites();
        $properties_pairs = array();

        foreach ($properties as $key => $value) {
            $properties_pairs[]="{$key}='{$value}'  ";
        }
        $sql = "UPDATE ".static::$db_table." SET ";
        $sql .=implode(",",$properties_pairs);
        $sql .= " WHERE id = ". $database->escape_string($this->id);
        $database->query($sql);
        return (mysqli_affected_rows($database->connection)== 1) ? true : false;
    } // end update method 

    public function delete(){
        global $database;
        $sql = "DELETE FROM ".static::$db_table." WHERE id = ". $database->escape_string($this->id)." LIMIT 1";
        return ($database->query($sql)) ? true : false;
    } // end DELETE method 
    public static function count_all() {
        global $database;
        $sql = "SELECT COUNT(*) FROM ". static::$db_table;
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        return array_shift($row);
    }
    
     
}
?>
