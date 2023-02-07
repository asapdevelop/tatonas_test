<?php

//an array to display response
$response = array();

function createTransaksiDetail($id_trans, $hardware, $sensor, $value){
    require_once '../includes/DBConnect.php';
    $sql_get_berita = "INSERT INTO tbl_transaksi_detail(id_trans, hardware, sensor, value)
    VALUES ('$id_trans','$hardware', '$sensor', '$value')";
    if(mysqli_query($conn,$sql_get_berita)){
        //record is created means there is no error
        $response['error'] = false;

        //in message we have a success message
        $response['message'] = 'Request successfully completed';
    } else {
        //record is created means there is no error
        $response['error'] = true;

        //in message we have a success message
        $response['message'] = 'Some error occurred please try again';
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function getTransaksiDetail(){
    require_once '../includes/DBConnect.php';
    // buat QUery perintah untuk menampilkan semua data
    $sql_get_berita = "SELECT id, id_trans, hardware, sensor, value FROM tbl_transaksi_detail";
    $query = $conn->query($sql_get_berita);
    // Variable penampung array sementara
    $response_data = null;
    while ($data = $query->fetch_assoc()) {
        // tambahkan data yg di seleksi ke dalam array
        $response_data[] = $data;
    }
    // Cek apakah datanya null ?
    if (is_null($response_data)) {

        $response['error'] = true;
		//and we have the error message
        $response['message'] = 'Some error occurred please try again';
   
    } else {

        //record is created means there is no error
        $response['error'] = false;

        //in message we have a success message
        $response['message'] = 'Request successfully completed';

        //and we are getting all the heroes from the database in the response
        $response['TransaksiDetail'] = $response_data;
    }
    // Set type header response ke Json
    header('Content-Type: application/json');
    echo json_encode($response);
    
}

function getTransaksiDetailByTrans($id_trans){
    require_once '../includes/DBConnect.php';
    // buat QUery perintah untuk menampilkan semua data
    $sql_get_berita = "SELECT id, id_trans, hardware, sensor, value FROM tbl_transaksi_detail
    WHERE id_trans = '$id_trans'";
    $query = $conn->query($sql_get_berita);
    // Variable penampung array sementara
    $response_data = null;
    while ($data = $query->fetch_assoc()) {
        // tambahkan data yg di seleksi ke dalam array
        $response_data[] = $data;
    }
    // Cek apakah datanya null ?
    if (is_null($response_data)) {

        $response['error'] = true;
		//and we have the error message
        $response['message'] = 'Some error occurred please try again';
   
    } else {

        //record is created means there is no error
        $response['error'] = false;

        //in message we have a success message
        $response['message'] = 'Request successfully completed';

        //and we are getting all the heroes from the database in the response
        $response['TransaksiDetail'] = $response_data;
    }
    // Set type header response ke Json
    header('Content-Type: application/json');
    echo json_encode($response);
    
}


function ubahTransaksiDetail($id, $id_trans, $hardware, $sensor, $value) {
    require_once '../includes/DBConnect.php';
    $sql_get_berita = "UPDATE tbl_transaksi_detail 
    SET id_trans = '$id_trans', hardware = '$hardware', sensor = '$sensor', value = '$value'
    WHERE id = '$id'";
    if(mysqli_query($conn,$sql_get_berita)){
        //record is created means there is no error
        $response['error'] = false;

        //in message we have a success message
        $response['message'] = 'Request successfully completed';
    }
    else{
        //record is created means there is no error
        $response['error'] = true;

        //in message we have a success message
        $response['message'] = 'Some error occurred please try again';
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

function deleteTransaksiDetail($id) {
    require_once '../includes/DBConnect.php';
    $sql_get_berita = "DELETE FROM tbl_transaksi_detail WHERE id = '$id'";
    if(mysqli_query($conn,$sql_get_berita)){
        //record is created means there is no error
        $response['error'] = false;

        //in message we have a success message
        $response['message'] = 'Request successfully completed';
    }
    else{
        //record is created means there is no error
        $response['error'] = true;

        //in message we have a success message
        $response['message'] = 'Some error occurred please try again';
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

    

if(isset($_GET['mode'])){
    switch($_GET['mode']){
        case 'createTransaksiDetail':
            createTransaksiDetail(
                $_POST['id_trans'],
                $_POST['hardware'],
                $_POST['sensor'],
                $_POST['value']);
        break;
        case 'getTransaksiDetail':
            getTransaksiDetail();
        break;
        case 'ubahTransaksiDetail':
            ubahTransaksiDetail(
                $_POST['id'],
                $_POST['id_trans'],
                $_POST['hardware'],
                $_POST['sensor'],
                $_POST['value']);
        break;
        case 'deleteTransaksiDetail':
            deleteTransaksiDetail(
                $_POST['id']);
        break;
        case 'getTransaksiDetailByTrans':
            getTransaksiDetailByTrans(
                $_POST['id_trans']);
        break;
    }
}