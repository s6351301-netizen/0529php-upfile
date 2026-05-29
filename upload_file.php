<?php 
include_once "db.php";
if(!empty($_FILES['file']['tmp_name'])){
/*     echo $_FILES['file']['tmp_name'];   
    echo "<br>"; 
    echo $_FILES['file']['name'];    
    echo "<br>"; 
    echo $_FILES['file']['type'];    
    echo "<br>"; 
    echo $_FILES['file']['size'];    
    echo "<br>"; 
 */
    move_uploaded_file($_FILES['file']['tmp_name'], 'upload/'.$_FILES['file']['name']);
    
    /* $sql="INSERT INTO `photos`(`url`,`name`,`type`) 
               VALUES('./upload/{$_FILES['file']['name']}',
                      '{$_POST['name']}',
                      '{$_FILES['file']['type']}')";
    $pdo->exec($sql);  */                     
    insert('photos',[
                         'url'=>"./upload/{$_FILES['file']['name']}",
                         'name'=>$_POST['name'],
                         'type'=>$_FILES['file']['type']
                     ]);

}


header("location:upload.php");
?>