<?php

$dsn = 'mysql:host=localhost;dbname=blogapp;charset=utf8;';
$user = 'blog_user';
$pass = '0000';

    try{
    $dbh = new PDO ($dsn,$user,$pass,[
        PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION,
    ]);
    // echo '接続成功';
    $sql = 'SELECT * FROM blogapp';
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    var_dump($result);


    $dbh = null;
    }catch(PDOException $e){
    echo '接続失敗'.$e->getMessage();
    exit();
    } 

?>