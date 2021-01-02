<?php

class Property{
    
    
    public static function addProperty($data){
        global $database;
        $lastid=$database->insert("properties", [
        "city" =>$data['city'],
        "area" => $data['area'],
        "description" => $data['description'],
        "created_by" => $data['created_by'], "price"=>$data['price']
        ]);
        if(empty($lastid))
            return false;
        if($data['img']=="true")
        {
            $data['listid']=$database->id();
            Property::addImages($data);
        }
        return true;
     }
     public static function addImages($data){
        global $database;
        $lastid=$database->insert("images", [
        "img1" =>$data['img1'],
        "img2" => $data['img2'],
        "img3" => $data['img3'],
        "listid" => $data['listid']
        ]);
        if(empty($lastid))
            return false;
        return true;
     }
     public static function deleteProeprty($data)
    {
        global $database;
         $datas = $database->delete("properties", ["AND" => ["pid" => $data['pid']]]);
        if($datas->rowCount()>0)
        {
            return true;
        }
         return false;
    }
    public static function getuser($data)
    {
        global $database;
        $password=md5($data['password']);
        $datas = $database->select("users", [ "email"], [
            "email" => $data["email"], "password"=>$password]
        );
        if(count($datas)>0){
            return true;
        }
        return false;
    }
    public static function getAllProperties()
    {
        global $database;
        $datas = $database->select("properties", "*");
        return $datas;
    }
    public static function getMyProperties($data)
    {
        global $database;
        $datas = $database->select("properties", "*",["created_by"=>$data]);
        return $datas;
    }
    public static function getMePhotos($data)
    {
        global $database;
        $datas = $database->select("images", "*",["listid"=>$data]);
        return $datas;
    }
    public static function getSelectProperties($data)
    {
        global $database;
        $password=md5($data['images']);
        $datas = $database->select("users", [ "email"], [
            "email" => $data["email"], "password"=>$password]
        );
    }
    
}
?>
