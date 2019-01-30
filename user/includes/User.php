<?php


class User
{
    public $name;
    public $pass;
    protected static $table_name="user";
    protected static $db_fields = array('name', 'pass');


    public function authenticate($username="", $password="") {
        global $database;
        $this->username = $database->escape_value($username);
        $this->password = md5($database->escape_value($password));

        $sql  = "SELECT * FROM user ";
        $sql .= "WHERE name = '{$this->username}' ";
        $sql .= "AND pass = '{$this->password}' ";
        $sql .= "LIMIT 1";
        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_by_sql($sql="") {
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while ($row = $database->fetch_array($result_set)) {
            $object_array[] = self::instantiate($row);
        }
        return $object_array;
    }

    private static function instantiate($record) {
        $object = new self;
        foreach($record as $attribute=>$value){
            if($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    private function has_attribute($attribute) {
         return array_key_exists($attribute, $this->attributes());
    }

    protected function attributes() {
        $attributes = array();
         foreach(self::$db_fields as $field) {
            if(property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }
}
$user = new User();