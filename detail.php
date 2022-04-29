<?php

$id = $_GET['id'];

function dbconnect (){
    $dsn = 'mysql:host=localhost;dbname=mydb;charset=utf8';
    $user = 'blog_user';
    $pass = '0000';
    
    try{
        $dbh = new PDO($dsn,$user,$pass,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
        
     } catch(PDOException $e){
         echo '接続失敗',$e->getMessage();
         exit ();
    };
    return $dbh;
}

$dbh = dbconnect ();

//SQL準備
$stmt = $dbh->prepare('SELECT * FROM blogapp where id = :id');
$stmt->bindValue (':id',(int)$id,PDO::PARAM_INT);

//SQL実行
$stmt->execute();
//結果取得
$result = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($result);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ詳細</title>
</head>
<body>
    <h2>ブログ詳細</h2>
    <h3>タイトル：<?php echo $result['title'] ?></h3>
    <p>投稿日時：<?php echo $result['post_at'] ?></p>
    <p>カテゴリ：<?php echo $result['category'] ?></p>
    <hr>        
    <p>本文：<?php echo $result['content'] ?></p>

</body>
</html>