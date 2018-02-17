<?php
    require_once '_shared.php';
    
    $create_person = $db->prepare('INSERT INTO person (username,password,email) VALUES (:username,:password,:email)');
    
    try{
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = safe_post('username');
            $password = safe_post('password');
            $email = safe_post('email');
            
            if($username && $password){
                $create_person->execute(array('username' => $username, 'password' => $password,'email' => $email));
                echo "success";
            } else {
                echo "Missing username or password";
            }
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        die();
    }
    header( 'Location: index.php' ) ;
?>