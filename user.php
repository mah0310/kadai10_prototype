<?php
//エラー表示
ini_set("display_errors", 1);

//2. DB接続します
include("funcs.php");
session_start();
sschk();
$pdo = db_conn();

//２．データ表示SQL作成
$sql = "SELECT * FROM esuser_table";
$stmt = $pdo->prepare($sql);
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
<title>読書図鑑 ユーザー一覧</title>
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
      <div class="navbar-header"><a class="navbar-brand" href="select1.php">戻る</a></div>
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
    <td><?=$v["id"]?></td>
    <td><?=$v["name"]?></td>
    <td><?=$v["email"]?></td>
    <td><?=$v["kanri_flg"]?></td>
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
