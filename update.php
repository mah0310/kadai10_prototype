<?php
// funcs.phpの読み込み
include("funcs.php");
session_start();
sschk();

// Db接続する
$pdo = db_conn();

// POSTデータの読み込み
$id   = $_POST["id"];
$post = $_POST['post'];
$img   = fileUpload("upfile","upload");
    if ($img == "") {
    $img = $_POST["img_old"]; // 画像がアップされてないなら元画像を使う
    }
$tag = $_POST['tag'];


// SQLの作成
$stmt = $pdo->prepare("UPDATE es_table SET post=:post, img=:img, tag=:tag WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT); 
$stmt->bindValue(':post',  $post, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT 文字だとSTR)
$stmt->bindValue(':img', $img);
$stmt->bindValue(':tag', $tag, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    //*** function化する！*****************
    sql_error($stmt);
}else {
    if ($_SESSION["kanri_flg"] == 1) {
        redirect("select1.php");
    } else {
        redirect("select.php");
    }
}




