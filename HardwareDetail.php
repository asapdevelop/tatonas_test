<?php

//an array to display response
$response = array();

function createHardwareDetail($hardware, $sensor){
    require_once '../includes/DBConnect.php';
    $sql_get_berita = "INSERT INTO tbl_hardware_detail(hardware, sensor, deleted)
    VALUES ('$hardware','$sensor','0')";
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

function getHardwareDetail(){
    require_once '../includes/DBConnect.php';
    // buat QUery perintah untuk menampilkan semua data
    $sql_get_berita = "SELECT id, hardware, sensor, deleted FROM tbl_hardware_detail";
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
        $response['HardwareDetail'] = $response_data;
    }
    // Set type header response ke Json
    header('Content-Type: application/json');
    echo json_encode($response);
    
}


function ubahHardwareDetail($id, $hardware, $sensor, $deleted) {
    require_once '../includes/DBConnect.php';
    $sql_get_berita = "UPDATE tbl_hardware_detail 
    SET hardware = '$hardware', sensor = '$sensor', deleted = '$deleted'
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

function deleteHardwareDetail($id) {
    require_once '../includes/DBConnect.php';
    $sql_get_berita = "DELETE FROM tbl_hardware_detail WHERE id = '$id'";
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
        case 'createHardwareDetail':
            createHardwareDetail(
                $_POST['hardware'],
                $_POST['sensor']);
        break;
        case 'getHardware':
            getHardware();
        break;
        case 'ubahHardwareDetail':
            ubahHardwareDetail(
                $_POST['id'],
                $_POST['hardware'],
                $_POST['sensor'],
                $_POST['deleted']);
        break;
        case 'deleteHardwareDetail':
            deleteHardwareDetail(
                $_POST['id']);
        break;
    
    }
}