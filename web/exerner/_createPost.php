<?php
    require_once '_shared.php';
    
    $create_post = $db->prepare('INSERT INTO post (title,body,personid) VALUES (:title,:body,:personid)');
    
    try{
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = safe_post('title');
            $body = safe_post('body');
            $personid = safe_post('personid');
            
            if($body && $title && $personid){
                $create_post->execute(array('body' => $body, 'title' => $title,'personid' => $personid));
                echo $db->lastInsertId();
            } else {
                echo "Missing something";
            }
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        die();
    }
?>