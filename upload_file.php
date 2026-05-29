<?php 
if(!empty($_FILES['file']['tmp_name'])){
    echo $_FILES['file']['tmp_name'];   
    echo "<br>"; 
    echo $_FILES['file']['name'];    
    echo "<br>"; 
    echo $_FILES['file']['type'];    
    echo "<br>"; 
    echo $_FILES['file']['size'];    
    echo "<br>"; 

    move_uploaded_file($_FILES['file']['tmp_name'], 'upload/'.$_FILES['file']['name']);

}



?>