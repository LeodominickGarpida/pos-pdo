<?php
    session_start();

    // Include files
    include_once '../../config/Database.php';
    include_once '../../models/Accounts.php';

    // Instantiate Database and connect
    $database = new Database();
    $db = $database->connect();

    //  Instantiate categorie object
    $accounts = new Accounts($db);


			
	$avatar	= $_FILES["avatar"]["name"];
	$type		= $_FILES["avatar"]["type"];	//file name "txt_file"	
	$size		= $_FILES["avatar"]["size"];
	$temp		= $_FILES["avatar"]["tmp_name"];

    move_uploaded_file($temp, "../../assets/upload/" .$avatar); //move upload file temperory directory to your upload folder

    $accounts->avatar = $avatar;
    $accounts->name = $_POST['name'];
    $accounts->username = $_POST['username'];
    $accounts->type = $_POST['type'];

    $password = $_POST['password'];
    
    $password = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

    $password = substr($password, 0, 60);

    $accounts->password = $password;

    $accounts->create();
    
    $_SESSION['message'] = 'Account Created Successfully';

    header('Location:../../views/accounts.php');
?>