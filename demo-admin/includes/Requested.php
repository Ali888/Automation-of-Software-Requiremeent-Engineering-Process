<?php
//include('../../includes/database.php');
include_once ('database.php');
class Requested{

    protected static $table_name = "req_permission";
    protected static $db_fields = array ('project_id','p_id','keyw','project_Title','p_name','approve');

    public $project_id;
    public $project_Title;
    public $p_id;
    public $p_name;
    public $keyw;
    public $approve;


    public static function find_all() {
        return self::find_by_sql("select * from ".self::$table_name);
    }

    public static function find_by_id($id=0) {
        return self::find_by_sql("select * from ".self::$table_name." where project_id={$id} LIMIT 1");
        //return !empty($obj_array) ? array_shift($obj_array) : false;
    }

    public function find_by_sql($sql){
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while($row = $database->fetch_array($result_set)){
            $object_array[] =   self::instantiate($row);
        }
        return $object_array;
    }

    private static function instantiate($record) {
        $object = new self;
        foreach ($record as $attribute=>$value){
            if($object->has_attribute($attribute)){
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    private function has_attribute($attribute) {
        return array_key_exists($attribute,$this->attributes());
    }

    protected function attributes() {
        $attributes = array();
        foreach (self::$db_fields as $field){
            if(property_exists($this,$field)){
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    protected function sanitized_attributes() {
        global $database;
        $clean_attributes = array();
        foreach (self::attributes() as $key=>$value){
            $clean_attributes[$key] =  $database->escape_value($value);
        }
        return $clean_attributes;
    }

    public function save() {
        return isset($this->project_id) ? $this->update() : $this->create();
    }

    public function create() {
        global $database;
        $sanitized_attributes = $this->sanitized_attributes();
        $sql = "insert into ".self::$table_name." (";
        $sql .=join(",",array_keys($sanitized_attributes));
        $sql .=") values('";
        $sql .=join("','",array_values($sanitized_attributes));
        $sql .="')";
        if($database->query($sql)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        global $database;
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE ".self::$table_name." SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE p_id='". $database->escape_value($this->p_id)."' ";
        $sql .= " and project_id='". $database->escape_value($this->project_id)."' ";
        $sql .= " and keyw='". $database->escape_value($this->keyw)."'";


        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }

    public function delete() {
        global $database;
        $sql = "DELETE FROM ".self::$table_name;
        $sql .= " WHERE p_id=". $database->escape_value($this->p_id);
        $sql .= " and project_id='". $database->escape_value($this->project_id)."' ";
        $sql .= " and keyw='". $database->escape_value($this->keyw)."'";
        $sql .= " LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }

    public static function count_all() {
        global $database;
        $sql = "SELECT COUNT(*) FROM ".self::$table_name;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

}
$requested = new Requested();
?>