<?php
require_once ("./db.php");

$query = $_POST['data'];
$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$sql = "SELECT * FROM barang WHERE nama_barang LIKE '%{$query}%'";
$result = $db->query($sql);
$response = [];
while ($row = $result->fetch_assoc()) {
    if (file_exists("img/{$row['ID']}.jpg")) {
        $row['thumbnail']= "img/{$row['ID']}.jpg";
      } else {
        $row['thumbnail']= "img/noImage.jpg";   
      }
    array_push($response, $row);
}
header("Content-Type: application/json");
echo json_encode($response);
?>