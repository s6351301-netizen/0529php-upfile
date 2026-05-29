<?php 
// ===== 檔案說明 =====
// 這個檔案是用來「編輯/修改」相片資訊的後端程式
// 當使用者要編輯某張相片時，會透過表單提交資料到這裡
// 這個檔案會更新相片的檔案或名稱到資料庫

// 第1行：引入資料庫連接檔案（db.php）
// include_once 表示「把 db.php 的程式碼複製到這裡」
// 這樣才能使用 find() 和 update() 函式來操作資料庫
include_once "db.php";
$photo=find("photos",$_POST['id']);
unlink($photo['url']);
delete('photos',$_POST['id']);

// 第10行：編輯完成後，自動跳轉回 upload.php 頁面
// header() 函式用來控制瀏覽器的行為
// "location:upload.php" 表示「導向到 upload.php 頁面」
// 使用者會看到瀏覽器自動轉向回相片管理頁面
header("location:upload.php");