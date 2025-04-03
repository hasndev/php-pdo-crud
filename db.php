<?php
try{
$con= new PDO("mysql:host=localhost;dbname=webdev101", "root", "");
 $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException  $e ){
echo "Error: ".$e;
}

// Select
function getData($db,$query,$parm = []) {
  $stmt = $db->prepare($query);
  $stmt->execute($parm);
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $rows;
} // CRUD : Create - Read - Update - Delete


//Insert - Update - Delete
function setData($db,$query,$parm = []) {
  $stmt = $db->prepare($query);
  $stmt->execute($parm);
  $count = $stmt->rowCount();
  return $count;
}
?>
