<?php
include_once 'variables.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/bootstrap.css">
    <link rel="stylesheet" href="styles/style.css">
    <title>
        <?php if (isset($page_title)) {
            echo $page_title;
        } ?> PATEFINDER
    </title>
    <script src="https://kit.fontawesome.com/ed398f5d99.js" crossorigin="anonymous"></script>
    <title>PâteFinder</title>
</head>

<body>
    <header>
        <div>
            <h1>PâteFinder</h1>
            <p>Gérez vos fiches de personnages pour vos parties de Jeu de Rôle !</p>
        </div>
    </header>