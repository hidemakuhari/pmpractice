<!DOCTYPE html>
<html>
    <head>
        <title>ログイン処理</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {background-color: #6495ed;}
        </style>
    </head>
    <body><?php
//確認
//print_r($_POST);

        $id = $_POST['id'];
        $password = $_POST['password'];

//データベースに接続（レシピ260）
        $dsn = 'mysql:host=localhost;dbname=shimoda-c;charset=utf8';
        $db = new PDO($dsn, 'test', 'pass');
        //ユーザがいるかどうか
        $sql = 'select * from users where id=:id and password=:password';
        $prepare = $db->prepare($sql);
        $prepare->bindValue(":id", $id);
        $prepare->bindValue(":password", $password);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) == 1) {//ユーザがいるならログインする
            //ログインする
            $sql = 'update users set logintime=now(),logouttime=null where id=:id and password=:password';
            $prepare = $db->prepare($sql);
            $prepare->bindValue(":id", $id);
            $prepare->bindValue(":password", $password);
            $prepare->execute();
            echo 'ログインしました';
        }
        ?>
        <a href="logout.php?id=<?php echo $id; ?>">ログアウト</a>
        
    </body>
</html>