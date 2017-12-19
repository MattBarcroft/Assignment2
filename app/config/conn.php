<?php
function get_db()
{
    $host ='127.0.0.1';
    $db = 'myKanban';
    $userdb = 'user1';
    $pass = 'mypass';

    $dsn = "mysql:host=$host; dbname=$db";
    $pdo = new PDO($dsn, $userdb, $pass);
    return $pdo;
}

?>
