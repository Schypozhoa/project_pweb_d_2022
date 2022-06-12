<?php

require_once("db.php");

class Barang
{
    private $db;

    function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($this->db->connect_error){
            http_response_code(500);
            die("Connection failed: {$this->db->connect_error}");
        }
    }

    function __destruct()
    {
        $this->db->close();
    }

    function readBarang()
    {
        $start = isset($_GET['start']) ? $_GET['start'] : 0;
        $query = "SELECT * 
                  FROM barang as b
                  INNER JOIN asal AS a
                  ON b.asal = a.asal_id
                  INNER JOIN kondisi AS k
                  ON b.kondisi = k.id_kondisi
                  LIMIT $start, 15";
        $sql = $this->db->query($query);
        $data = [];
        while ($row = $sql->fetch_assoc()){
            if (file_exists("img/{$row['ID']}.jpg")) {
                $row['thumbnail']= "img/{$row['ID']}.jpg";
              } else {
                $row['thumbnail']= "img/noImage.jpg";   
              }
            array_push($data, $row);
        }
        header("Content-Type: application/json");
        echo json_encode($data);
    }

    function readByIdBarang($id)
    {
        $query = "SELECT * 
                FROM barang as b
                INNER JOIN asal AS a
                ON b.asal = a.asal_id
                INNER JOIN kondisi AS k
                ON b.kondisi = k.id_kondisi
                WHERE b.id = $id";
        $sql = $this->db->query($query);
        $data = [];
        while ($row = $sql->fetch_assoc()){
            array_push($data, $row);
        }
        header("Content-Type: application/json");
        echo json_encode($data);
    }

    function deleteBarang($id)
    {
        $query = "DELETE FROM barang WHERE id = $id";
        $sql = $this->db->prepare($query);
        try {
            $sql->execute();
            echo "Success";
        } catch (\Exception $e) {
            $sql->close();
            http_response_code(500);
            die($e->getMessage());
        }
    }

    function createBarang($data)
    {
        foreach ($data as $key => $value){
            $value = is_array($value) ? trim(implode(',', $value)) : trim($value);
            $data[$key] = (strlen($value) > 0 ? $value : NULL);
        }

        $query = "INSERT INTO barang VALUES(NULL, ?, ?, ?, ?, ?)";
        $sql = $this->db->prepare($query);
        $sql->bind_param(
            'siiii',
            $data['nama_barang'],
            $data['harga_barang'],
            $data['stok_barang'],
            $data['id_kondisi'],
            $data['asal_id'],
        );
        try {
            $sql->execute();
            echo "Success";
        } catch (\Exception $e) {
            $sql->close();
            http_response_code(500);
            die($e->getMessage());
        }
        $sql->close();
    }

    function editBarang($data)
    {
        foreach ($data as $key => $value){
            $value = is_array($value) ? trim(implode(',', $value)) : trim($value);
            $data[$key] = (strlen($value) > 0 ? $value : NULL);
        }
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $query = "UPDATE barang SET nama_barang = ?, harga_barang = ?, stok_barang = ?, kondisi = ?, asal = ?  WHERE ID = $id";
        $sql = $this->db->prepare($query);
        $sql->bind_param(
            'siiii',
            $data['nama_barang'],
            $data['harga_barang'],
            $data['stok_barang'],
            $data['id_kondisi'],
            $data['asal_id'],
        );
        try {
            $sql->execute();
            echo "Success";
        } catch (\Exception $e) {
            $sql->close();
            http_response_code(500);
            die($e->getMessage());
        }
        $sql->close();
    }
}

$barang = new Barang();
switch ($_GET['action']) 
{
    case 'createBarang':
        $barang->createBarang($_POST);
        break;
    case 'editBarang':
        $barang->editBarang($_POST);
        break;
    case 'readBarang':
        $barang->readBarang();
        break;
    case 'readidBarang':
        $barang->readByIdBarang($_GET['id']);
        break;
    case 'deleteBarang':
        $barang->deleteBarang($_GET['id']);
        break;
    default:
        http_response_code(500);
        break;
}
?>