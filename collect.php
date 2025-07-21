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

    <form method="post" action="insert.php" class="post-container" enctype="multipart/form-data">
      <label>POST</label>
      <input type="text" name="post" placeholder="心が動いたことは...?"><br>
      <label><input type="file" name="upfile"></label><br>
      <select name="tag">
        <option value="" disabled selected>感情を言葉にすると？</option>
        <option value="うれしい">うれしい</option>
        <option value="悲しい">悲しい</option>
        <option value="怒り">怒り</option>
        <option value="感謝">感謝</option>
      </select>
      <input type="submit" value="CREATE POST" class="submit-btn">
      
    </form>
    <div class="close-btn"><a href="javascript:history.back()">×</a></div>

   
  </div>
</body>
</html>