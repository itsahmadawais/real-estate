<?php

class User{
    
    
    public static function addUser($data){
        global $database;
        $lastid=$database->insert("users", [
        "fname" =>$data['fname'],
        "lname" => $data['lname'],
        "email" => $data['email'],
        "password" => $data['password'],
        "phone" => $data['phone'],
        "role" =>  "agent",
        "membership" => "free"
        ]);
        if(empty($lastid))
            return false;
        return true;
     }
    public static function isAlreadyExist($data)
    {
        global $database;
        $datas = $database->select("users", [ "email"], [
            "email" => $data["email"]
        ]);
        if(count($datas)>0){
            return true;
        }
        return false;
    }
    public static function UpdateUser($data)
    {
        global $database;
        $lastid;
        
        if($data['password']==="0")
        {
            if($data['role']==="admin")
            {
                $data['membership']='paid';
            }
            $lastid = $database->update("users", ["fname" => $data['fname'],"lname"=>$data['lname'],"phone"=>$data['phone'], "email"=>$data['email'], "membership"=>$data['membership'], "role"=>$data['role']], ["id" =>$data['id']]);
        }
        else{
            $lastid = $database->update("users", ["fname" => $data['fname'],"lname"=>$data['lname'],"phone"=>$data['phone'], "email"=>$data['email'], "membership"=>$data['membership'], "role"=>$data['role'], "password"=>$data['password']], ["id" =>$data['id']]);
        }
        if(empty($lastid))
            return false;
        return true;
    }
    public static function UpdatePhoto($data)
    {
        global $database;
         $lastid = $database->update("users", ["photo" => $data['photo']], ["id" =>$data['id']]);
        if(empty($lastid))
            return false;
        return true;
    }
    public static function getuser($data)
    {
        global $database;
        $password=md5($data['password']);
        $datas = $database->select("users",  "*", [
            "email" => $data["email"], "password"=>$password, "LIMIT"=>1]
        );
        return $datas;
    }
    public static function GetUserInfo($data){
        global $database;
        $password=md5($data['password']);
        $datas = $database->select("users",  "*", [
            "id" => $data["email"], "password"=>$password, "LIMIT"=>1]
        );
        return $datas;
    }
    public static function getAllAgents()
    {
        global $database;
        $datas = $database->select("users", "*",["role"=>"agent"]);
        return $datas;
    }
}
?>
