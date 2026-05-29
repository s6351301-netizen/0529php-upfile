<?php
/**
 * 1.建立表單
 * 2.建立處理檔案程式
 * 3.搬移檔案
 * 4.顯示檔案列表
 */
include_once "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>檔案上傳</title>
    <style>
        /* 讓整個表格寬度適中、置中，並修正邊框重疊問題 */
table {
    width: 100%;
    max-width: 800px;
    margin: 20px auto;
    border-collapse: collapse; /* 移除雙邊框 */
    font-family: "PingFang TC", "Microsoft JhengHei", sans-serif;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* 微弱陰影提升質感 */
    border-radius: 8px;
    overflow: hidden; /* 確保圓角效果套用到標題 */
}

/* 表格標題列樣式 */
th {
    background-color: #4A90E2; /* 沉穩的藍色 */
    color: white;
    font-weight: bold;
    padding: 12px 16px;
    text-align: left; /* 依需求可改為 center */
}

/* 資料儲存格樣式 */
td {
    padding: 12px 16px;
    border-bottom: 1px solid #E0E0E0; /* 灰色的分隔線 */
    color: #333333;
    vertical-align: middle; /* 讓文字和圖片垂直置中對齊 */
}

/* 斑馬紋效果：讓資料列一明一暗，更方便閱讀 */
tbody tr:nth-child(even) {
    background-color: #F8F9FA;
}

/* 滑鼠懸停效果：當滑鼠移過去時，該列會微微變色 */
tbody tr:hover {
    background-color: #F1F5F9;
}

/* 針對縮圖（圖片）的優化 */
table img {
    max-width: 60px; /* 限制縮圖最大寬度 */
    height: auto;
    border-radius: 4px; /* 縮圖微圓角 */
    display: block;
}

/* 如果你的操作欄位有按鈕，可以參考這個樣式 */
.btn-delete {
    background-color: #E74C3C;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.2s;
}
.btn-delete:hover {
    background-color: #C0392B;
}
    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 <h1 class="header">檔案上傳練習</h1>
 <!----建立你的表單及設定編碼----->
<form action="upload_file.php" method="post" enctype="multipart/form-data">
<div>
    <label for='file'>選擇檔案:</label>
    <input type="file" name="file" id="file">
</div>   
<div>
    <label for='name'>輸入名稱:</label>
    <input type="text" name="name" id="name">
</div>

<input type="submit" value="上傳檔案">


</form>


<!----建立一個連結來查看上傳後的圖檔---->  
<?php 
$sql="SELECT * FROM `photos`";
$rows=$pdo->query($sql)->fetchAll();
?>

<table>
    <tr>    
        <td>縮圖</td>
        <td>ID</td>
        <td>名稱name</td>
        <td>類型type</td>
        <td>日期created_at</td>
        <td>位置URL</td>
    </tr>
    <?php 
        foreach($rows as $row):
            ?>
    <tr>
        <td>
            <img src="<?= $row['url'] ?>" style="width:100px;">
        </td>
        <td><?= $row['id'];?></td>  
        <td><?= $row['name'];?></td>
        <td><?= $row['type'];?></td>
        <td><?= $row['created_at'];?></td>  
        <td><?= $row['url'];?></td>
    </tr>
    <?php endforeach; ?>
</table>


</body>
</html>