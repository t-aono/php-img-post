<?php
// データベースに接続
function connectDB() {
    $param = 'mysql:host=mysql;dbname=image_post';
    try {
        $pdo = new PDO($param, 'root', 'pass');
        return $pdo;

    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}