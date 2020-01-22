<?php
require_once 'functions.php';

$pdo = connectDB();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // 画像を取得
    $sql = 'SELECT * FROM image_posts ORDER BY created_at DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $images = $stmt->fetchAll();

} else {
    // 画像を保存
    if (!empty($_FILES['image']['name'])) {
        $name = $_FILES['image']['name'];
        $type = $_FILES['image']['type'];
        $content = file_get_contents($_FILES['image']['tmp_name']);
        $size = $_FILES['image']['size'];
        $comment = $_POST['comment'];
        
        $sql = 'INSERT INTO image_posts(image_name, image_type, image_content, image_size, comment, created_at)
                VALUES (:image_name, :image_type, :image_content, :image_size, :comment, now())';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':image_name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':image_type', $type, PDO::PARAM_STR);
        $stmt->bindValue(':image_content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':image_size', $size, PDO::PARAM_INT);
        $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
        $stmt->execute();
    }
    unset($pdo);
    header('Location:index.php');
    exit();
}

unset($pdo);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>Image Test</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
</head>

<body>

  <!-- Header -->
  <header class="bg-primary text-center py-1 mb-4">
    <div class="container">
      <h1 class="font-weight-light text-white">画像投稿アプリ</h1>
    </div>
    <div class="py-3">
      <form method="post" enctype="multipart/form-data">
        <span class="form-group text-white">
          <label>画像を選択</label>
          <input type="file" name="image" required>
          <label>コメントを入力</label>
          <input type="string" name="comment" required>
        </span>
        <button type="submit" class="btn btn-success ml-5">投稿</button>
      </form>
    </div>
  </header>

  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <?php for($i = 0; $i < count($images); $i++): ?>
        <div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-0 shadow">
            <a href="image.php?id=<?= $images[$i]['image_id']; ?>">
              <img src="image.php?id=<?= $images[$i]['image_id']; ?>" width="500px" height="350px" class="card-img-top">
            </a>
            <div class="card-body text-center">
              <div class="card-title mb-0"><?= htmlspecialchars($images[$i]['comment']); ?>
                <a href="javascript:void(0);" 
                  onclick="var comment = edit(); if (comment) location.href='edit.php?id=<?= $images[$i]['image_id']; ?>&comment='+comment">
                    <i class="far fa-edit"></i> 編集
                </a>
              </div>
              <div class="card-text text-black-50">
                  <span class="small"><?= $images[$i]['image_name']; ?> (<?= number_format($images[$i]['image_size']/1000, 2); ?> KB)</span>
                  <a href="javascript:void(0);" 
                    onclick="var ok = confirm('削除しますか？'); if (ok) location.href='delete.php?id=<?= $images[$i]['image_id']; ?>'">
                      <i class="far fa-trash-alt"></i> 削除
                  </a>
              </div>
            </div>
          </div>
        </div>
      <?php endfor; ?>
    </div>
  </div>

  <script src="./edit.js"></script>
</body>

</html>