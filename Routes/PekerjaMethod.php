<?php
require_once "../Controllers/PekerjaController.php";

$request_method = $_SERVER["REQUEST_METHOD"];
$pekerja = new PekerjaController();

switch ($request_method) {
    case 'GET' :
        if (isset($_GET["id"])) {
            $id = intval($_GET["id"]);
            echo $pekerja->getDetailPekerja($id);
        } else {
            echo $pekerja->getListPekerja();
        }
        break;
    case 'POST' :
        echo $pekerja->insertPekerja();
        break;
    case 'PUT' :
        if ($_GET["id"]) {
            $id = intval($_GET["id"]);
            echo $pekerja->updatePekerja($id);
        }
        break;
    default: 
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}