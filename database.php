<?php
function connect(): PDO
{
    $host = 'std-mysql';
    $db = 'std_950_php_exam_3';
    $user = 'std_950_php_exam_3';
    $pass = '901109qsq';
    $charset = 'utf8';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    return new PDO($dsn, $user, $pass, $opt);
}