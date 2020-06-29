<?php

function Db(){
    // Подключяем config.php
    $config =require_once ('config.php');

    //$link = mysqli_connect($config['host'], $config['user'], $config['pass'], $config['dbname']);
    $link = mysqli_connect('localhost', 'root', '', 'adress_book');

    if (!$link) {
        echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
        echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }



    return $link;
    mysqli_close($link);
}


/*function dbPdo(){

    // Подключяем config.php
    $config =require_once ('config.php');

    $host = $config['host'];
    $dbname = $config['dbname'];
    $user = $config['user'];
    $pass = $config['pass'];

    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    return $dbh;
}*/