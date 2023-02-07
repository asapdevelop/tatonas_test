<?php

//an array to display response
$response = array();

function absenMasuk($username, $latitude, $longitude, $foto){
    require_once '../includes/DBConnect.php';
    $sql_get_berita = "INSERT INTO tbl_absen(username, in_out, tanggal, latitude, longitude, foto)
    VALUES ('$username','IN', date('Y-m-d H.i'), '$latitude', '$longitude', '$foto')";
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

function absenPulang($username, $latitude, $longitude, $foto){
    require_once '../includes/DBConnect.php';
    $sql_get_berita = "INSERT INTO tbl_absen(username, in_out, tanggal, latitude, longitude, foto)
    VALUES ('$username','OUT', date('Y-m-d H.i'), '$latitude', '$longitude', '$foto')";
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

function getAbsen(){
    require_once '../includes/DBConnect.php';
    // buat QUery perintah untuk menampilkan semua data
    $sql_get_berita = "SELECT username, in_out, tanggal, latitude, longitude, foto FROM tbl_absen";
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
        $response['Absen'] = $response_data;
    }
    // Set type header response ke Json
    header('Content-Type: application/json');
    echo json_encode($response);
    
}
    

if(isset($_GET['mode'])){
    switch($_GET['mode']){
        case 'absenMasuk':
            absenMasuk(
                $_POST['username'],
                $_POST['latitude'],
                $_POST['longitude'],
                $_POST['foto']);
        break;
        case 'absenPulang':
            absenPulang(
                $_POST['username'],
                $_POST['latitude'],
                $_POST['longitude'],
                $_POST['foto']);
        break;
        case 'getAbsen':
            getAbsen();
        break;
    }
}