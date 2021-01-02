<?php

function getRowById($tablename, $id)
{
    global $database;
    $data = $database->select($tablename, "*", ["id"=>$id, "LIMIT"=>1]);
    return $data;
}
?>