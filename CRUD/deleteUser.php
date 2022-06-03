<?php
    $bdd=new PDO('mysql:host=localhost; dbname=projet_crud; charset=utf8', 'root', 'root');
    $id=$_POST['id'];
    $sql= 'DELETE FROM users WHERE id='.$_POST['id'];
    $bdd->exec($sql);
    echo 'Suppression réussie';
    header('Location: listUser.php');
    exit();
?>