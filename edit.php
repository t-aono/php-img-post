<?php
require_once 'functions.php';

$pdo = connectDB();

$sql = 'UPDATE image_posts SET comment = :comment WHERE image_id = :image_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':comment', $_GET['comment'], PDO::PARAM_STR);
$stmt->bindValue(':image_id', (int)$_GET['id'], PDO::PARAM_INT);
$stmt->execute();

unset($pdo);
header('Location:index.php');
exit();