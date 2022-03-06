<?php
session_start();
$x=$_SESSION['username'];

if(isset($_POST['title'])){
    require '../db_conn.php';

    $title = $_POST['title'];
    $priority = $_POST['priority'];
    $label = $_POST['label'];


    if(empty($title)){
        header("Location: ../index.php?mess=error");
    }else {
        $stmt = $conn->prepare("INSERT INTO todos(title, priority, label, user_name) VALUE(?,?,?,?)");
        $res = $stmt->execute([$title, $priority, $label, $x]);

        if($res){
            header("Location: ../index.php?mess=success"); 
        }else {
            header("Location: ../index.php");
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}