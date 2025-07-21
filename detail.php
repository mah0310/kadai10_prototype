<?php
include("funcs.php");
session_start();
sschk();

// ①渡されたidを受け取る
$id = $_GET['id'];
// ②Dbと接続
$pdo = db_conn();

// 渡されたidを元にデータ取得SQLでデータを取得
$sql = "SELECT * FROM es_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//データを1行分だけ取得、複数取得する場合はfetchAllを使う
$row = $stmt->fetch();

?>

<!-- 以下がHTML -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title></title>
  <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/post.css">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>

<body>
  <div>
    <div class="logo">emoStock</div>

    <form method="post" action="update.php" class="post-container" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?=$row["id"]?>">
      <label>POST</label>
      <input type="text" name="post"  value="<?=$row["post"]?>"><br>

      <label>現在の画像:</label><br>
      <?php if (!empty($row["img"])): ?>
      <img src="upload/<?=$row["img"]?>" width="100" style="margin-bottom:10px;"><br>
      <?php endif; ?>
      <label>画像を変更する:</label>
      <input type="file" name="upfile"><br>
      <input type="hidden" name="img_old" value="<?=$row["img"]?>">

      <select name="tag">
        <option value="" disabled>感情を選択してください</option>
        <option value="うれしい" <?=$row["tag"]=="うれしい" ? "selected" : ""?>>うれしい</option>
        <option value="悲しい" <?=$row["tag"]=="悲しい" ? "selected" : ""?>>悲しい</option>
        <option value="怒り" <?=$row["tag"]=="怒り" ? "selected" : ""?>>怒り</option>
        <option value="感謝" <?=$row["tag"]=="感謝" ? "selected" : ""?>>感謝</option>
      </select>
      <input type="submit" value="UPDATE" class="submit-btn">
      
    </form>
    <div class="close-btn"><a href="javascript:history.back()">×</a></div>

   
  </div>
</body>


