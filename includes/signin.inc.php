<?php
session_start();

// krn belum ada db, pake dummy
$usn1 = "user1";
$pw1 = "password1";

// USER LOGIN
if(isset($_POST["submit"])) {
    
    $usn = $_POST["usn"];
    $pw = $_POST["pw"]; // plaintext password entered by the user

    require_once 'functions.inc.php';

    // the hash of the password that can be stored in the database
    // pw1 as dummy
    $hash = password_hash($pw1, PASSWORD_DEFAULT);
    // echo "Generated hash: ".$hash;

    // verify the hash against the password entered
    $verify = password_verify($pw, $hash);

    // kalo username dan password cocok
    if($verify) {
        // buat cookie
        // id 1 buat dummy, nanti diganti pake id dr db
        $_SESSION['login'] = true;
        setcookie('id', 1, time()+60,'/');
        setcookie('key', hash('sha256', $usn), time()+60,'/');
        
        header("location: ../index.php");
    } else {
        // username dan password tidak cocok
        // echo 'PASSWORD DAN USERNAME TIDAK COCOK';
        header("location: ../login.php");
    }
    
    // kalo salah satu kotak kosong
    if(emptyInputSignIn($usn, $pw) !== false) { 
        header("location: ../login.php?error=emptyinput");
        exit();
    }
    // TODO : menangani salah password atau username

    // header("location: ../loginuser.php");

} 

// TODO: ADMIN
elseif(isset($_POST["submitadmin"])) {
    $usn = $_POST["usn"];
    $pw = $_POST["pw"];

    require_once 'functions.inc.php';

    // kalo salah satu kotak kosong
    if(emptyInputSignIn($usn, $pw) !== false) { // TODO : nanti fungsinya dibikin
        header("location: ../login.php?error=emptyinput");
        exit();
    }
    
    // header("location: ../loginadmin.php");
} 

else {
    header("location: ../login.php");
    exit();
}