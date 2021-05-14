<?php

class countdownDAO{

    public static function setCountdown(countdown $countdown){
        $database = new database();
        try{
            $query = "INSERT INTO countdown(title,target_date,target_time,target_timestamp) VALUES(:title,:target_date,:target_time,:target_timestamp)";
            
            $database->query($query);
            $database->bind(':title', $countdown->getTitle());
            $database->bind(':target_date', $countdown->getDate());
            $database->bind(':target_time', $countdown->getTime());
            $database->bind(':target_timestamp', $countdown->getTimestamp());

            if($database->execute()){
                $id =  $database->lastInsertId();
                return $id;
            } else {
                return false;
            }

        } catch (Exception $ex){            
            return false;
        }
    }
    
    public static function checkAvailableCountdown(){
        $database = new database();
        try{
            $query = "SELECT * FROM countdown";
            $database->query($query);

            $list = $database->resultset();
            if($list){
                return $list;
            } else {
                return false;
            }
        } catch (Exception $ex){
            return false;
        }
    }
    
    public static function updateCountdown(countdown $countdown){
        $database = new database();
        try{
            $query = "UPDATE countdown SET title = :title, target_date = :target_date, target_time = :target_time, target_timestamp = :target_timestamp WHERE id = :id";
            
            $database->query($query);
            $database->bind(':id', $countdown->getId());
            $database->bind(':title', $countdown->getTitle());
            $database->bind(':target_date', $countdown->getDate());
            $database->bind(':target_time', $countdown->getTime());
            $database->bind(':target_timestamp', $countdown->getTimestamp());

            if($database->execute()){
                return true;
            } else {
                return false;
            }

        } catch (Exception $ex){
            return false;
        }
    }
    
    public static function getCountdown(countdown $countdown){
        $database = new database();
        try{
            $query = "SELECT * FROM countdown WHERE id = :id";
            $database->query($query);
            $database->bind(':id', $countdown->getId());

            $list = $database->single();
            if($list){
                return $list;
            } else {
                return false;
            }
        } catch (Exception $ex){
            return false;
        }
    }
}