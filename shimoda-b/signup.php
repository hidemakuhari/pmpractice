<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {background-color:  #6495ed;}
        </style>
    </head>
    <body><?php
//確認
//print_r($_POST);

        $id = $_POST['id'];
        $password = $_POST['password'];
        $fullname = $_POST['fullname'];

//データベースに接続（レシピ260）
        $dsn = 'mysql:host=localhost;dbname=shimoda-c;charset=utf8';
        $db = new PDO($dsn, 'test', 'pass');
        //登録する
        $sql = 'INSERT INTO users (id,password,name) VALUES (:id,:password,:fullname)';
        $prepare = $db->prepare($sql);
        $prepare->bindValue(":password", $password, PDO::PARAM_STR);
        $prepare->bindValue(":fullname", $fullname, PDO::PARAM_STR);
        $prepare->bindValue(":id", $id, PDO::PARAM_INT);
        $prepare->execute();
        $id = $db->lastInsertId();
        echo '登録しました';
        ?>
        <a href="index.html">ログイン</a></td>
    </body>
</html>