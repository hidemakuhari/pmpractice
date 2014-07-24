<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body><?php
//確認
//print_r($_POST);

        $id = $_POST['id'];
        $password = $_POST['password'];

//データベースに接続（レシピ260）
        $dsn = 'mysql:host=localhost;dbname=shimodab;charset=utf8';
        $db = new PDO($dsn, 'test', 'pass');
//print_r($db);//確認
//ログインしているかどうか（レシピ261）
        $sql = 'select * from users where id=:id and password=:password and logintime is null';
        $prepare = $db->prepare($sql);
        $prepare->bindValue(":id", $id);
        $prepare->bindValue(":password", $password);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) == 1) {//ログインしていないなら
            //ログインする
            $sql = 'update users set logintime=now() where id=:id';
            $prepare = $db->prepare($sql);
            $prepare->bindValue(":id", $id);
            $prepare->execute();
            echo 'ログインした';
        }

//ログインしているなら
//ログアウトする
        ?>
    </body>
</html>