<?php
    require '_shared.php';
    
    $create_person = $db->prepare('INSERT INTO person (username,password,email) VALUES (:username,:password,:email)');
    $get_password = $db->prepare('SELECT password FROM person WHERE username=:username');
    
    $create_post = $db->prepare('INSERT INTO post (title,body,personid) VALUES (:title,:body,:personid)');
    $create_comment = $db->prepare('INSERT INTO comment (body,postid,personid) VALUES (:body,:postid,:personid)');
    $update_post = $db->prepare('UPDATE post SET title=:title,body=:body WHERE id=:id');
    $update_comment = $db->prepare('UPDATE comment SET body=:body WHERE id=:id');
    
    $query = $db->query('SELECT * FROM person');
    foreach($query as $row){
        var_dump($row);
    }
?>