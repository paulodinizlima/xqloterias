<?php
Class conection{
    private $PDO;
    private $con;
    public $conectado='n';

    public function __construct($dbname = 'dbxqloterias')
    {        
        try{
            $con = $this->PDO = new PDO("mysql:host=localhost;dbname={$dbname}",'root', '226298my@Sql');
            $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conectado = 's';
            return $this->con;
        }catch(PDOException $e){
            die("Ops, houve um erro: <b>{$e->getMessage()}</b>");
            return -1;            
        }
    }

    public function insert($sql, array $binds){
        $stmt = $this->PDO->prepare($sql);
        foreach($binds as $key => $value){
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        return false;        
    }

    public function select($sql, array $binds){
        $stmt = $this->PDO->prepare($sql);
        foreach($binds as $key => $value){
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        return $stmt;
    }

    public function update($sql, array $binds){
        $stmt = $this->PDO->prepare($sql);
        foreach($binds as $key => $value){
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function delete($sql, array $binds){
        $stmt = $this->PDO->prepare($sql);
        foreach($binds as $key => $value){
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        return $stmt->rowCount();
    }
    
}