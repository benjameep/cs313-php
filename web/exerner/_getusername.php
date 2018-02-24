<?php
    require_once '_shared.php';
    $get_user = $db->prepare('SELECT username FROM person WHERE id=:id;');
    $request = $get_user->execute(array('id' => safe_get('id')));
    echo $request->fetch()
?>