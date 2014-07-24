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
        $fullname = $_POST['fullname'];

//データベースに接続（レシピ260）
        $dsn = 'mysql:host=localhost;dbname=shimoda-c;charset=utf8';
        $db = new PDO($dsn, 'test', 'pass');
//print_r($db);//確認
//student_idが無ければ登録する
        $sql = 'select * from users where student_id=:id';
        $prepare = $db->prepare($sql);
        $prepare->bindValue(":id", $id);
        $prepare->execute();
        $result0 = $prepare->fetchAll(PDO::FETCH_ASSOC);
        if (count($result0) == 0) {//idがない
            //登録する
            $sql = 'INSERT INTO users (password,name,student_id) VALUES (:password,:fullname,:id)';
            $prepare = $db->prepare($sql);
            $prepare->bindValue(":password", $password, PDO::PARAM_STR);
            $prepare->bindValue(":fullname", $fullname, PDO::PARAM_STR);
            $prepare->bindValue(":id", $id, PDO::PARAM_INT);
            $prepare->execute();
            $id = $db->lastInsertId();
            echo '登録した';
        } 
        
//ログインしているかどうか（レシピ261）
        $sql = 'select * from users where student_id=:id and password=:password and logintime is null';
        $prepare = $db->prepare($sql);
        $prepare->bindValue(":id", $id);
        $prepare->bindValue(":password", $password);
        $prepare->execute();
        $result1 = $prepare->fetchAll(PDO::FETCH_ASSOC);

        $sql = 'select * from users where student_id=:id and password=:password and logintime is not null';
        $prepare = $db->prepare($sql);
        $prepare->bindValue(":id", $id);
        $prepare->bindValue(":password", $password);
        $prepare->execute();
        $result2 = $prepare->fetchAll(PDO::FETCH_ASSOC);        
        
        if (count($result1) == 1) {//ログインしていないなら
            //ログインする
            $sql = 'update users set logintime=now() where student_id=:id';
            $prepare = $db->prepare($sql);
            $prepare->bindValue(":id", $id);
            $prepare->execute();
            echo 'ログインした';
        }
        else if (count($result2) == 1) {//ログインしているなら
            //ログアウトする
            #$sql = 'update users set totaltime=totaltime+now()-logintime and logintime=0 and logouttime=0 where id=:id';
            $sql = 'update users set totaltime=totaltime+now()-logintime where student_id=:id';
            $prepare = $db->prepare($sql);
            $prepare->bindValue(":id", $id);
            $prepare->execute();
            $sql = 'update users set logintime=0 where student_id=:id';
            $prepare = $db->prepare($sql);
            $prepare->bindValue(":id", $id);
            $prepare->execute();
            echo 'ログアウトした';
        }
        ?>        
    </body>
</html>