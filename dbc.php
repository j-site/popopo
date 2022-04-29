<?php

//関数一つに一つの機能のみを持たせる
//1.データベース接続
//2.データベース取得
//3.カテゴリー名表示

//1.データベース接続
//引数：なし
//返り値：接続結果を返す
function dbconnect (){
    $dsn = 'mysql:host=localhost;dbname=mydb;charset=utf8';
    $user = 'blog_user';
    $pass = '0000';
    
    try{
        $dbh = new PDO($dsn,$user,$pass,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        
     } catch(PDOException $e){
         echo '接続失敗',$e->getMessage();
         exit ();
    };
    return $dbh;
}

//データを取得する
//引数：なし
//戻り値：取得したデータ

function getallblog(){
    $dbh = dbconnect ();
    //SQL文の準備
    $sql = 'SELECT * FROM blogapp';
    //SQLの実行
    $stmt = $dbh->query($sql);
    //SQLの結果を受け取る
     $result = $stmt->fetchall(PDO::FETCH_ASSOC);
     var_dump($result);
     return $result;
     
    $dbh = null;      
}
    $blogdata = getallblog();

    //カテゴリー名を表示
    //引数：数字
    //返り値：カテゴリー名
    function setCategoryName($category){
        if($category === '1'){
            return 'ブログ';
        }elseif($category === '2'){
            return '日常';
        }else{
            return 'その他';
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ブログ一覧</title>
    </head>
    <body>
    <h2>Twitterみたいなアプリ</h2>
    <table>
    <tr>
    <th>No</th>
    <th>タイトル</th>
    <th>カテゴリ</th>
    </tr>
    <?php foreach($blogdata as $colum):?>
    <tr>
        <td><?php echo $colum['id']?></td>
        <td><?php echo $colum['title']?></td>
        <td><?php echo setCategoryName($colum['category'])?></td>
        <td><a href="/detail.php?id=<?php echo $colum['id'] ?>">詳細</a></td>
    </tr>
    <?php endforeach; ?>                                            

    </table>
         
    </body>
    </html>