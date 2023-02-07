<?php

//an array to display response
$response = array();

function createUser($user, $passs, $nama_lengkap, $jabatan, $no_telp, $email){
    require_once '../includes/DBConnect.php';
    $pass = password_hash($passs, PASSWORD_BCRYPT);
    $sql_get_berita = "INSERT INTO tbl_user(username, password, nama_lengkap, jabatan, no_telp, email)
    VALUES ('$user','$pass', '$nama_lengkap', '$jabatan', '$no_telp', '$email')";
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

function getUsers(){
    require_once '../includes/DBConnect.php';
    // buat QUery perintah untuk menampilkan semua data
    $sql_get_berita = "SELECT username, password, nama_lengkap, jabatan, no_telp, email FROM tbl_user";
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
        $response['Users'] = $response_data;
    }
    // Set type header response ke Json
    header('Content-Type: application/json');
    echo json_encode($response);
    
}


function ubahUser($user, $nama_lengkap, $jabatan, $no_telp, $email) {
    require_once '../includes/DBConnect.php';
    $sql_get_berita = "UPDATE tbl_user 
    SET nama_lengkap = '$nama_lengkap', jabatan = '$jabatan', no_telp = '$no_telp', email = '$email'
    WHERE username = '$user'";
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

function deleteUser($user) {
    require_once '../includes/DBConnect.php';
    $sql_get_berita = "DELETE FROM tbl_user WHERE username = '$user'";
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

function ubahPassword($user, $passs){
    require_once '../includes/DBConnect.php';
    $sql_get_berita = "UPDATE tbl_user 
    SET password = '$passs' 
    WHERE username = '$user'";
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
}

function login($user, $passs){
    require_once '../includes/DBConnect.php';
    $pass = password_hash($passs, PASSWORD_BCRYPT);
    $sql_get_berita = "SELECT username, password, nama_lengkap, jabatan, no_telp, email FROM tbl_user
    WHERE username = '$user' AND password = '$passs'";
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
        $response['message'] = 'Periksa Kembali Username dan Password Anda';
   
    } else {

        //record is created means there is no error
        $response['error'] = false;

        //in message we have a success message
        $response['message'] = 'Request successfully completed';

        //and we are getting all the heroes from the database in the response
        $response['Users'] = $response_data;
    }
    // Set type header response ke Json
    header('Content-Type: application/json');
    echo json_encode($response);
}

function cekPasswords($user, $passs){
    require_once '../includes/DBConnect.php';
    $pass = password_hash($passs, PASSWORD_BCRYPT);
    // buat QUery perintah untuk menampilkan semua data
    $sql_get_berita = "SELECT username, password, nama_lengkap, jabatan, no_telp, email FROM tbl_user 
    WHERE username = '$user' AND password = '$pass'";
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
        $response['message'] = 'Password Salah';
   
    } else {

        //record is created means there is no error
        $response['error'] = false;

        //in message we have a success message
        $response['message'] = 'Request successfully completed';

    }
    // Set type header response ke Json
    header('Content-Type: application/json');
    echo json_encode($response);
    
}

function cekPassword($user, $pass){
    require_once '../includes/DBConnect.php';
    // buat QUery perintah untuk menampilkan semua data
    $sql_get_berita = "SELECT username, password, nama_lengkap, jabatan, no_telp, email FROM tbl_user
    WHERE username = '$user' AND password = '$pass'";
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
        $response['Users'] = $response_data;
    }
    // Set type header response ke Json
    header('Content-Type: application/json');
    echo json_encode($response);
    
}
    

if(isset($_GET['mode'])){
    switch($_GET['mode']){
        case 'createUser':
            createUser(
                $_POST['user'],
                $_POST['pass'],
                $_POST['nama_lengkap'],
                $_POST['jabatan'],
                $_POST['no_telp'],
                $_POST['email']);
        break;
        case 'getUsers':
            getUsers();
        break;
        case 'ubahUser':
            ubahUser(
                $_POST['user'],
                $_POST['nama_lengkap'],
                $_POST['jabatan'],
                $_POST['no_telp'],
                $_POST['email']);
        break;
        case 'deleteUser':
            deleteUser(
                $_POST['user']);
        break;
        case 'ubahPassword':
            ubahPassword(
                $_POST['user'],
                $_POST['passs']);
        break;
        case 'login':
            login(
                $_POST['user'],
                $_POST['passs']);
        break;
        case 'cekPassword':
            cekPassword(
                $_POST['user'],
                $_POST['passs']);
        break;
    }
}