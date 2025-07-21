<?php
session_start();
$user_id = $_SESSION["user_id"];

//エラー表示
ini_set("display_errors", 1);

//2. DB接続します
include("funcs.php");
sschk();
$pdo = db_conn();

//２．データ表示SQL作成
$sql = "SELECT * FROM es_table WHERE user_id = :user_id ORDER BY date DESC" ;
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>emoStock 管理者画面</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
<style>
        table {
            border: solid 1px black;
            width: 100%;
            margin: 30px 0;
        }
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid" style="display: flex; align-items: center; background-color:#e4b7a0; font-weight:bold;">
      <div>管理者画面</div>
      <div class="navbar-header"><a class="navbar-brand" href="collect.php">POST</a></div>
      <div class="navbar-header"><a class="navbar-brand" href="login.php">ログイン</a></div>
      <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
      <div class="navbar-header"><a class="navbar-brand" href="index.php">ユーザー登録</a></div>
      <div class="navbar-header"><a class="navbar-brand" href="user.php">ユーザー一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">


<table>
<?php foreach($values as $v){ ?>
    <tr>
    <td><a href="detail.php?id=<?=$v["id"]?>"><?=$v["id"]?></a></td>
    <td><?=$v["post"]?></td>
    <td><img src="upload/<?=$v["img"]?>" width="100" style="border-radius: 8px;"></td>
    <td><?=$v["tag"]?></td>
    <td><?=$v["date"]?></td>
    <td><a href="delete.php?id=<?=$v["id"]?>">削除</a></td>
  </tr>
<?php } ?>
</table>


  </div>
</div>
<!-- Main[End] -->
<script>
  const a = '<?php echo $json; ?>';
  console.log(JSON.parse(a));
</script>
</body>
</html>
