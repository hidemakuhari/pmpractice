<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>稼働率一覧</title>
    <style>
      body {background-color:  #6495ed;}
    </style>
  </head>
  <center>
    <body>
      <h1>稼働率一覧</h1>
      <div>
        <?php
# h()関数☆レシピ221☆（安全にブラウザで値を表示したい）を読み込みます☆レシピ041☆（他のファイルを取り込んで利用したい）。
        require_once 'h.php';

//データベースに接続（レシピ260）
        $dsn = 'mysql:host=localhost;dbname=shimoda-c;charset=utf8';
        $db = new PDO($dsn, 'test', 'pass');

        #すべてのデータをデータベースから取得する。
        $sql = 'SELECT * FROM users';
        $prepare = $db->prepare($sql);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

        #すべてのデータを表示する。
        echo '<table border="1">';
        echo '<tr><td>学生番号</td><td>氏名</td><td>滞在状況</td><td>滞在時間(秒）</td></tr>';
        foreach ($result as $person) {
          //ログインしているかどうか
          $isLogin = false;        
          if ($person['logintime'] != null && $person['logouttime'] == null) {
            $isLogin = true;
          }
          echo '<tr><td>' . h($person['id']) . '</td><td>' . h($person['name']) . '</td><td>' . ($isLogin ? '○' : '×') . '</td><td>' . h($person['totaltime']) . '</td></tr>';
        }
        echo '</table>';
        ?>
  </center>
</div>
</body>
</html>
