<?php

abstract class Model
{
    // Bdd
    private static $bdd;

    private static function setBdd()
    {
        self::$bdd = new PDO('mysql:host=localhost;dbname=internships-v2;charset=utf8', 'root', '');
        self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    protected function getBdd()
    {
        if(self::$bdd == null)
            self::setBdd();
        return self::$bdd;
    }

    // Get

    protected function getAll($table, $obj)
    {
        $var = [];
        $req = self::getBdd()->prepare('SELECT * FROM '.$table.' ORDER BY id DESC');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function getOne($table, $obj, $id)
    {
        $req = self::getBdd()->prepare('SELECT * FROM '.$table.' WHERE id = ?');
        $req->execute(array($id));
        $data = $req->fetch(PDO::FETCH_ASSOC);
        return new $obj($data);
        $req->closeCursor();
    }

    protected function getValueByColumn($table, $column, $value)
    {
        $req = self::getBdd()->prepare("SELECT * FROM $table WHERE $column = ? ORDER BY id DESC");
        $req->execute(array($value));
        $result = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $result;
    }

    protected function getAllByColumn($table, $obj, $column, $value)
    {
        $var = [];
        $req = self::getBdd()->prepare("SELECT * FROM $table WHERE $column = ? ORDER BY id DESC");
        $req->execute(array($value));
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    // Add

    protected function add($table, $data)
    {
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_fill(0, count($data), '?'));
        $req = self::getBdd()->prepare("INSERT INTO $table ($columns) VALUES ($values)");
        $req->execute(array_values($data));
        $id = self::getBdd()->lastInsertId();
        $req->closeCursor();
        return $id;
    }

    // Uptade

    protected function update($table, $data, $id)
    {
        $columns = array_keys($data);
        $values = array_values($data);

        $req = self::getBdd()->prepare("UPDATE $table SET ".implode(' = ?, ', $columns)." = ? WHERE id = $id");

        $req->execute($values);
        $req->closeCursor();
    }

    protected function updateByColumn($table, $data, $id, $column)
    {
        $columns = array_keys($data);
        $values = array_values($data);

        $req = self::getBdd()->prepare("UPDATE $table SET ".implode(' = ?, ', $columns)." = ? WHERE $column = $id");
        $req->execute($values);
        $req->closeCursor();
    }

    // Delete

    protected function delete($table, $id)
    {
        $req = self::getBdd()->prepare('DELETE FROM '.$table.' WHERE id = ?');
        $req->execute(array($id));
        $req->closeCursor();
    }

    protected function deleteByColumn($table, $column, $value)
    {
        $req = self::getBdd()->prepare("DELETE FROM $table WHERE $column = ?");
        $req->execute(array($value));
        $req->closeCursor();
    }
    
}
?>