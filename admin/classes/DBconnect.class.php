<?php

class DBconnect{

  private $host = 'mysql:host=localhost;dbname=vcare_clinic';
  private $user = 'root';
  private $pass = '';
  protected $table;


  public function __construct(){

    // $class = explode('\\', get_called_class());
    // $class = end($class);
    $class = get_called_class();
    $this->table = strtolower($class);

  }

  public function connect(){
      try{
        $db = new PDO($this->host, $this->user, $this->pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
      }
      catch(PDOException $e){
       echo 'faild to connect with database' . $e->getMessage();
      }
  }

  // basic query without join


    function getDataPaginate($table, $col = '*', $filter = true, $start_from, $results_per_page)
    {
        $query = "SELECT $col FROM $table WHERE $filter ORDER BY id desc LIMIT $start_from, $results_per_page";
        $sql = DBconnect::connect()->query($query);
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getCountData($table, $filter = true){
      $query = "SELECT count(id) FROM $table WHERE $filter";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute();
      $row = $stmt->fetch();
      return $row[0];
    }
  

    function getData($table, $cols = '*', $filter = true)
    {
        $query = "SELECT $cols FROM $table WHERE $filter";
        $sql = DBconnect::connect()->query($query);
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }


    function getRowCountData($table, $cols = '*', $filter = true)
    {
        $q = "SELECT $cols FROM $table WHERE $filter";
        $sql = DBconnect::connect()->prepare($q);
        $sql->execute();
        return $sql->rowCount();
    }

    
    // create function to create data
    function create($table, $data)
    {
        $pattern = '/([^,]+)/';
        $col_replacement = '`$1`';
        $val_replacement = "'$1'";
        $cols = preg_replace($pattern, $col_replacement, implode(',', array_keys($data)));
        $vals = preg_replace($pattern, $val_replacement, implode(',', array_values($data)));
        $query = "INSERT INTO $table($cols) VALUES ($vals)";
        $sql = DBconnect::connect()->prepare($query);
        return $sql->execute();
    }

    
    // edit function
    function edit($table, $data, $filter = true){
      foreach ($data as $column => $value) {
        $condtion[] = "`{$column}` = '{$value}'";
      }
      $cols = implode(',' , $condtion);
      $query = "UPDATE $table SET $cols WHERE $filter";
      $sql = DBconnect::connect()->prepare($query);
      return $sql->execute();
    }

    
    // delete function
    function destroy($table, $filter = true)
    {
        $query = "DELETE FROM $table WHERE $filter";
        $sql = DBconnect::connect()->query($query);
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

}
