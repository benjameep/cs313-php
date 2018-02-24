<?php
    require_once '_shared.php';
    $get_user = $db->prepare('SELECT username FROM person WHERE id=:id;');
    $get_user->execute(array('id' => safe_get('id',-1)));
    $row = $get_user->fetch();
    echo $row['id']
?>