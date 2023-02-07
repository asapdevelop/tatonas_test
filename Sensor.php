<?php

//an array to display response
$response = array();

function createSensor($sensor, $nama, $unit){
    require_once '../includes/DBConnect.php';
    $sql_get_berita = "INSERT INTO tbl_sensor(sensor, nama, unit, deleted)
    VALUES ('$sensor','$nama', '$unit', '0')";
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

function getSensor(){
    require_once '../includes/DBConnect.php';
    // buat QUery perintah untuk menampilkan semua data
    $sql_get_berita = "SELECT sensor, nama, unit, deleted FROM tbl_sensor";
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
        $response['Sensor'] = $response_data;
    }
    // Set type header response ke Json
    header('Content-Type: application/json');
    echo json_encode($response);
    
}


function ubahSensor($sensor, $nama, $unit, $deleted) {
    require_once '../includes/DBConnect.php';
    $sql_get_berita = "UPDATE tbl_sensor 
    SET nama = '$nama', unit = '$unit', deleted = '$deleted'
    WHERE sensor = '$sensor'";
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

function deleteSensor($sensor) {
    require_once '../includes/DBConnect.php';
    $sql_get_berita = "DELETE FROM tbl_sensor WHERE sensor = '$sensor'";
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
        case 'createSensor':
            createSensor(
                $_POST['sensor'],
                $_POST['nama'],
                $_POST['unit']);
        break;
        case 'getSensor':
            getSensor();
        break;
        case 'ubahSensor':
            ubahSensor(
                $_POST['sensor'],
                $_POST['nama'],
                $_POST['unit'],
                $_POST['deleted']);
        break;
        case 'deleteSensor':
            deleteSensor(
                $_POST['sensor']);
        break;
    
    }
}