<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PDORepository
 *
 * @author fede
 */
abstract class PDORepository {
    
    const USERNAME = "grupo28";
    const PASSWORD = "YTAxZDdkNDFiM2Q5";
	const HOST ="localhost";
	const DB = "grupo28";
    
    
    private function getConnection(){
        $u=self::USERNAME;
        $p=self::PASSWORD;
        $db=self::DB;
        $host=self::HOST;
        $connection = new PDO("mysql:dbname=$db;host=$host", $u, $p);
        return $connection;
    }

    protected function queryCount($sql, $args){
        $connection = $this->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute($args);
        return $stmt->rowCount();
    }
	

    protected function queryList($sql, $args){
        $connection = $this->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute($args);
        return $stmt->fetchAll();
    }
    protected function queryRow($sql, $args){
        $connection = $this->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute($args);
        return $stmt->fetch();
    }
    
    protected function queryLastInsert($sql, $args){
        $connection = $this->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute($args);
        
        return $connection->lastInsertId();
    }    
    
    protected function queryInsert($sql, $args){
		try {
			$connection = $this->getConnection();
			// set the PDO error mode to exception
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $connection->prepare($sql);
			$stmt->execute($args);
			return 1; //exito
		}
		catch(PDOException $e){
			echo $e;
			return 0; //error
		}
    }

    
}
