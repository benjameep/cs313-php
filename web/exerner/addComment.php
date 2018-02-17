<?php
    require_once '_shared.php';
    
    $create_comment = $db->prepare('INSERT INTO comment (body,postid,personid) VALUES (:body,:postid,:personid)');
    
    try{
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $body = safe_post('body');
            $postid = safe_post('postid');
            $personid = safe_post('personid');
            
            if($body && $postid && $personid){
                $create_comment->execute(array('body' => $body, 'postid' => $postid,'personid' => $personid));
                echo "success";
            } else {
                echo "Missing username or password";
            }
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        die();
    }
?>