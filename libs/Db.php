<?php

function PDO(){
    $pdo = new PDO('mysql:host=localhost;dbname=adress_book', 'root', '');

    if (!$pdo) {
        echo "Ошибка: Невозможно установить соединение с MySQL.";

        exit;
    }

    return $pdo;
}

