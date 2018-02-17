<?php
    require_once '_shared.php';
    
    $get_password = $db->prepare('SELECT password,id FROM person WHERE username=:username');
    
    try{
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = safe_post('username');
            $password = safe_post('password');
            
            if($username && $password){
                $get_password->execute(array('username' => $username));
                foreach($get_password as $row){
                    $correct_password = $row['password'];
                    $id = $row['id'];
                }
                if($password == $correct_password){
                    echo $id;
                } else {
                    echo "wrong";
                }
            } else {
                echo "Missing username or password";
            }
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        die();
    }
?>