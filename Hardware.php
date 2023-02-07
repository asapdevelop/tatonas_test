<?php

//an array to display response
$response = array();

function createHardware($hardware, $location, $latitude, $longitude){
    require_once '../includes/DBConnect.php';
    $sql_get_berita = "INSERT INTO tbl_hardware(hardware, location, latitude, longitude, deleted)
    VALUES ('$hardware','$location', '$latitude', '$longitude', '0')";
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

function getHardware(){
    require_once '../includes/DBConnect.php';
    // buat QUery perintah untuk menampilkan semua data
    $sql_get_berita = "SELECT hardware, location, latitude, longitude, deleted FROM tbl_hardware";
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
        $response['Hardware'] = $response_data;
    }
    // Set type header response ke Json
    header('Content-Type: application/json');
    echo json_encode($response);
    
}


function ubahHardware($hardware, $location, $latitude, $longitude, $deleted) {
    require_once '../includes/DBConnect.php';
    $sql_get_berita = "UPDATE tbl_hardware 
    SET location = '$location', latitude = '$latitude', longitude = '$longitude', deleted = '$deleted'
    WHERE hardware = '$hardware'";
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

function deleteHardware($hardware) {
    require_once '../includes/DBConnect.php';
    $sql_get_berita = "DELETE FROM tbl_hardware WHERE hardware = '$hardware'";
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
        case 'createHardware':
            createHardware(
                $_POST['hardware'],
                $_POST['location'],
                $_POST['latitude'],
                $_POST['longitude']);
        break;
        case 'getHardware':
            getHardware();
        break;
        case 'ubahHardware':
            ubahHardware(
                $_POST['hardware'],
                $_POST['location'],
                $_POST['latitude'],
                $_POST['longitude'],
                $_POST['deleted']);
        break;
        case 'deleteHardware':
            deleteHardware(
                $_POST['hardware']);
        break;
    
    }
}