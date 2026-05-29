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
/* ===== 表單容器樣式 ===== */
form {
    max-width: 600px;
    margin: 30px auto;
    padding: 25px;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border-left: 4px solid #4A90E2;
}

/* 表單中的每個輸入區塊 */
form div {
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
}

/* 表單標籤樣式 */
form label {
    font-weight: bold;
    color: #333;
    margin-bottom: 8px;
    font-size: 15px;
}

/* 表單輸入欄位樣式 */
form input[type="file"],
form input[type="text"] {
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    font-family: inherit;
    transition: all 0.3s ease;
    background-color: white;
}

form input[type="file"]:focus,
form input[type="text"]:focus {
    outline: none;
    border-color: #4A90E2;
    box-shadow: 0 0 5px rgba(74, 144, 226, 0.3);
    background-color: #fafbfc;
}

/* 提交按鈕樣式 */
form input[type="submit"] {
    background-color: #4A90E2;
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 4px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    align-self: center;
    margin-top: 10px;
    min-width: 150px;
}

form input[type="submit"]:hover {
    background-color: #357abd;
    box-shadow: 0 4px 12px rgba(74, 144, 226, 0.3);
    transform: translateY(-2px);
}

form input[type="submit"]:active {
    transform: translateY(0);
    box-shadow: 0 2px 6px rgba(74, 144, 226, 0.3);
}

/* 檔案標籤圖示樣式 */
.file-icon {
    display: inline-flex;
    align-items: center;
    margin-left: 8px;
    color: #4A90E2;
    font-size: 18px;
}    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 <h1 class="header">檔案上傳練習</h1>
 
 <!-- 上傳檔案表單 -->
<form action="upload_file.php" method="post" enctype="multipart/form-data">
    <div style="position: relative;">
        <label for='file'>
            選擇檔案:
            <span class="file-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                    <path d="M20 6h-8l-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm0 12H4V6h5.17l2 2H20v10z"/>
                </svg>
            </span>
        </label>
        <input type="file" name="file" id="file" required style="opacity:0;position:absolute">
    </div>   
    <div>
        <label for='name'>輸入名稱:</label>
        <input type="text" name="name" id="name" placeholder="請輸入檔案的描述名稱" required>
    </div>

    <input type="submit" value="上傳檔案">
</form>


<!----建立一個連結來查看上傳後的圖檔---->  
<?php 

$rows=all('photos');
?>

<table>
    <tr>
        <td>縮圖</td>
        <td>名稱</td>
        <td>類型</td>
        <td>操作</td>
    </tr>
    <?php 
        foreach($rows as $row):
            ?>
    <tr>
        <td>
            <img src="<?= $row['url'] ?>" style="width:100px;">
        </td>
        <td><?= $row['name'];?></td>
        <td><?= $row['type'];?></td>
        <td>
            <button onclick="location.href='edit_photo.php?id=<?= $row['id']; ?>'">編輯</button>
            <button onclick="location.href='del_photo.php?id=<?= $row['id']; ?>'">刪除</button>
        </td>
    </tr>
    <?php endforeach; ?>
</table>


</body>
</html>