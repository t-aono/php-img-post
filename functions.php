<?php
// データベースに接続
function connectDB() {
  try {
    if ($_SERVER['SERVER_NAME'] == 'localhost') {
      // 開発環境のMySQLに接続
      $param = 'mysql:host=mysql;dbname=image_post';
      $pdo = new PDO($param, 'root', 'pass');
      return $pdo;
    
    } else {
      // herokuのClearDBに接続
      $heroku_db = parse_url(getenv('CLEARDB_DATABASE_URL'));
      $db = new PDO('mysql:dbname='.substr($heroku_db['path'], 1).';host='.$heroku_db['host'].';charset=utf8', $heroku_db['user'], $heroku_db['pass']);
    }

  } catch (PDOException $e) {
    echo $e->getMessage();
    exit();
  }
}