<?php

// Connexion MAMP Pour Window (Joanna, Hichem et Antoine)
$dsn = 'mysql:dbname=exo_patefinder;port=3306;host=127.0.0.1';
$user = 'root'; // Default User
$password = ''; // Default no password

//Connexion WAMP Pour Mac (Winai)
// $dsn = 'mysql:dbname=exo_patefinder;port=8889;host=127.0.0.1';
// $user = 'root';
// $password = 'root';

try {
    $connection = new PDO($dsn, $user, $password, [

        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    exit('Connexion échouée : ' . $e->getMessage());
}