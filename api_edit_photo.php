<?php 
// ===== 檔案說明 =====
// 這個檔案是用來「編輯/修改」相片資訊的後端程式
// 當使用者要編輯某張相片時，會透過表單提交資料到這裡
// 這個檔案會更新相片的檔案或名稱到資料庫

// 第1行：引入資料庫連接檔案（db.php）
// include_once 表示「把 db.php 的程式碼複製到這裡」
// 這樣才能使用 find() 和 update() 函式來操作資料庫
include_once "db.php";

// 第2行：找到要編輯的相片資料
// $_POST['id'] 是從表單傳過來的相片 ID
// find('photos',$_POST['id']) 的意思是：去 photos 表找出 ID 符合的那筆資料
// 把資料儲存到變數 $photo 裡面
$photo=find('photos',$_POST['id']);

// 第3行：檢查使用者是否上傳了新的圖片檔案
// $_FILES['file']['tmp_name'] 是瀏覽器上傳檔案的暫存位置
// !empty() 表示「不是空的」，即檢查是否確實有上傳檔案
if(!empty($_FILES['file']['tmp_name'])){
    
    // 第4行：刪除舊的相片檔案
    // $photo['url'] 儲存的是舊相片的檔案路徑
    // unlink() 函式的功能是「刪除伺服器上的檔案」
    // 這樣做是為了節省伺服器的硬碟空間
    unlink($photo['url']);
    
    // 第5行：將新上傳的相片移到正式的上傳資料夾
    // $_FILES['file']['tmp_name'] 是瀏覽器上傳的暫存檔
    // move_uploaded_file() 會把檔案從暫存位置搬到 ./upload/ 資料夾
    // {$_FILES['file']['name']} 是新檔案的原始名稱
    move_uploaded_file($_FILES['file']['tmp_name'],"./upload/{$_FILES['file']['name']}");
    
    // 第6行：更新相片的路徑資訊
    // 把新檔案的路徑記錄在 $photo['url']
    // 例如：如果新檔案名稱是 photo.jpg，路徑就會是 ./upload/photo.jpg
    $photo['url']="./upload/{$_FILES['file']['name']}";
    
    // 第7行：更新相片的檔案類型
    // $_FILES['file']['type'] 包含檔案的 MIME 類型
    // 例如：image/jpeg（JPEG圖片）、image/png（PNG圖片）等
    $photo['type']=$_FILES['file']['type'];
}
// if 的大括號結束

// 第8行：更新相片的名稱
// $_POST['name'] 是使用者在表單裡輸入的新相片名稱
// 把新名稱存入 $photo['name']
$photo['name']=$_POST['name'];

// 第9行：把所有更新過的相片資料存入資料庫
// update() 是資料庫函式，用來「修改」資料庫裡的資料
// 第一個參數 'photos' 是資料表名稱
// 第二個參數 $photo['id'] 是要修改的相片 ID
// 第三個參數 $photo 是包含所有新資訊的資料
update('photos',$photo['id'],$photo);

// 第10行：編輯完成後，自動跳轉回 upload.php 頁面
// header() 函式用來控制瀏覽器的行為
// "location:upload.php" 表示「導向到 upload.php 頁面」
// 使用者會看到瀏覽器自動轉向回相片管理頁面
header("location:upload.php");