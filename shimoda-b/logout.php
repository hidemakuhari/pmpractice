<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {background-color: #6495ed;}
        </style>
    </head>
    <body><?php
    
    $id=$_GET['id'];
    
//データベースに接続（レシピ260）
        $dsn = 'mysql:host=localhost;dbname=shimoda-c;charset=utf8';
        $db = new PDO($dsn, 'test', 'pass');
        //ログアウトする
        $sql = 'update users set logouttime=now(),totaltime=totaltime+(UNIX_TIMESTAMP(now())-UNIX_TIMESTAMP(logintime)) where id=:id';
        $prepare = $db->prepare($sql);
        $prepare->bindValue(":id", $id);
        $prepare->execute();
        echo 'ログアウトしました';
        ?>
        <a href="index.html">ログイン</a>
    </body>
</html>