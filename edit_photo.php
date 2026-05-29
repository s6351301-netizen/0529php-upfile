<?php include_once "db.php";
$photo=find('photos',$_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編輯相片</title>
</head>
<body>

<form action="api_edit_photo.php" method="post" enctype="multipart/form-data">
    <div>
        <img src="<?= $photo['url'] ?>" style="width:150px">
    </div>
<div>
    <label for='file'>選擇檔案:</label>
    <input type="file" name="file" id="file">
</div>   
<div>
    <label for='name'>輸入名稱:</label>
    <input type="text" name="name" id="name" value="<?= $photo['name'] ?>">
</div>
<input type="hidden" name="id" value="<?= $photo['id'] ?>">
<input type="submit" value="上傳檔案">


</form>    
</body>
</html>