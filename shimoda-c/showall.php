<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>稼働率一覧</title>
</head>
<body>
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
  echo '<ul>';
  echo '学生番号　氏名　滞在状況　滞在時間';
  foreach ($result as $tweet) {
    echo '<li>'.h($tweet['student_id']).h($tweet['name']).h($tweet['logintime']).h($tweet['totaltime']).'</li>';
  }
  echo '</ul>';


?>
</div>
</body>
</html>
