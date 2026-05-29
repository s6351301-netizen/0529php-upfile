<?php include_once "db.php";
$photo=find('photos',$_GET['id']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>刪除圖片</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="delete-container">
        <div class="warning-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
            </svg>
        </div>
        
        <h1>刪除確認</h1>
        <div class="warning-message">
            你是否確認要刪除以下圖片？一旦確認刪除後，該圖片的資料也會一併刪除！
        </div>
        
        <div class="student-info" style='text-align:center'>
            <div><img src="<?= $photo['url'] ?>" style="width:100px"></div>
            <span class="student-name"><?= htmlspecialchars($photo['name'] ?? '') ?></span>
        </div>
        
        <div class="alert-text">
            ⚠️ 此操作無法復原
        </div>
        
        <div class="button-group">
            <form method="POST" action="api_delete_photo.php" style="flex: 1;">
                <input type="hidden" name="id" value="<?= htmlspecialchars($photo['id'] ?? '') ?>">
                <button type="submit" class="btn-confirm">確認刪除</button>
            </form>
            
            <button class="btn-cancel" onclick="window.history.back()">取消</button>
        </div>
    </div>

</body>
</html>