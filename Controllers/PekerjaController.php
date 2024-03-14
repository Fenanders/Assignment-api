<?php
require_once '../koneksi.php';

Class PekerjaController {
    public function getListPekerja()
    {
        global $mysqli;
        $data = [];
        $result = $mysqli->query('SELECT * FROM pekerja');
        while($row=mysqli_fetch_object($result))
		{
			$data[]=$row;
		}
        $res = array(
            'status' => 200,
            'message' => 'Get list data pekerja sukses',
            'data' => $data
        );
        header('Content-Type: application/json');
        return json_encode($res); 
    }

    public function getDetailPekerja($id)
    {
        global $mysqli;
        $data = [];
        $result = $mysqli->query("SELECT * FROM pekerja where id =". $id ." LIMIT 1");
        while($row=mysqli_fetch_object($result))
		{
			$data[]=$row;
		}
        $res = array(
            'status' => 200,
            'message' => 'Get detail data pekerja sukses',
            'data' => $data[0]
        );
        header('Content-Type: application/json');
        return json_encode($res); 
    }

    public function insertPekerja() 
    {
        global $mysqli;
        $res = array();
        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data, true);
        
        // Check if JSON data is valid
        if ($data === null) {
            // JSON data is not valid, handle error
            die('Invalid JSON data');
        }

        $nama = $data['nama'];
        $alamat = $data['alamat'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $status_pekerjaan = $data['status'];
        $no_telp = $data['no_telp'];

        $query = "INSERT INTO pekerja SET nama='$nama', alamat='$alamat', jenis_kelamin='$jenis_kelamin', status_pekerjaan='$status_pekerjaan', no_telp='$no_telp'";
        $result = mysqli_query($mysqli, $query);

        if (isset($result)) {
            $res = array(
                'status' => 200,
                'message' => 'Tambah pekerja sukses',
            );
        } else {
            $res = array(
                'status' => 400,
                'message' => 'Tambah pekerja gagal',
            );
        }

        header('Content-Type: application/json');
        return json_encode($res); 
    }

    public function updatePekerja($id)
    {
        global $mysqli;
        $res = array();
        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data, true);
        
        // Check if JSON data is valid
        if ($data === null) {
            // JSON data is not valid, handle error
            die('Invalid JSON data');
        }

        $nama = $data['nama'];
        $alamat = $data['alamat'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $status_pekerjaan = $data['status'];
        $no_telp = $data['no_telp'];
        
        // Perform the database update pekerja
        $query = "UPDATE pekerja SET nama='$nama', alamat='$alamat', jenis_kelamin='$jenis_kelamin', status_pekerjaan='$status_pekerjaan', no_telp='$no_telp' WHERE id='$id'";
        $result = mysqli_query($mysqli, $query);

        if (isset($result)) {
            $res = array(
                'status' => 200,
                'message' => 'Update pekerja sukses',
            );
        } else {
            $res = array(
                'status' => 400,
                'message' => 'Update pekerja gagal',
            );
        }

        header('Content-Type: application/json');
        return json_encode($res); 
    }
}