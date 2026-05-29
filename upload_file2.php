<?php 
if(!empty($_FILES['file']['tmp_name'])){
    echo "檔案暫存區的名稱: ".$_FILES['file']['tmp_name']; //檔案在暫存區的路徑_檔名  
    echo "<br>"; 
    echo "檔案的原始名稱: ".$_FILES['file']['name']; //檔案的原始名稱   
    echo "<br>"; 
    echo "檔案的類型: ".$_FILES['file']['type']; //檔案的類型   
    echo "<br>"; 
    echo "檔案的大小: ".$_FILES['file']['size']." bytes"; //檔案的大小，單位為byte   
    echo "<br>"; 
    echo "錯誤代碼: " . $_FILES['file']['error'] . "<br>";

    move_uploaded_file($_FILES['file']['tmp_name'], 'upload/'.$_FILES['file']['name']);
    //將檔案從暫存區搬移到指定upload的資料夾或改成1/的路徑資料夾

    echo "檔案上傳成功";
    error_reporting(0); //關閉錯誤訊息，避免上傳非圖檔時出現錯誤訊息
    echo "<a href='upload/".$_FILES['file']['name']."'>上傳檔案的路徑</a>";
    echo "<br>";
    echo "<img src='upload/".$_FILES['file']['name']."' alt='上傳的檔案' style='width:30%; height:auto;'>"; //顯示上傳的圖檔 
    
/*常見錯誤代碼對照表
代碼	意義
0	上傳成功
1	檔案超過 php.ini 中 upload_max_filesize 限制
2	檔案超過表單 MAX_FILE_SIZE 限制
3	檔案只有部分被上傳
4	沒有檔案被上傳
6	找不到暫存資料夾
7	檔案寫入失敗
8	PHP 擴展阻止了檔案上傳
*/
}



?>