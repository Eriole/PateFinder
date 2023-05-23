<?php
require_once 'includes/config.inc.php';
require_once 'includes/autoloader.php';
require_once 'includes/function.php';
ob_start();
session_start();

if (empty($_SESSION['user'])) {

    $pages = [
        'connection' => "Accueil",
    ];

} else {

    $pages = [
        'connection' => "Accueil",
        'characters_list' => "Tableau de bord",
        'new_character' => "Nouvelle fiche",
        'character_sheet' => "Fiche personnage",
        'update_character' => "Modifier le personnage",
        'update_statistics' => "Modifier les caractéristiques",
        'new_skill' => "Nouvelle compétence",
        'update_skill' => "Modifier la compétence",
        'new_stuff' => "Nouvel équipement",
        'update_stuff' => "Modifier un équipement",
        'character_delete' => "pouf",
        'logout' => "Déconnexion",
    ];

}


if (isset($_GET['page']) && array_key_exists($_GET['page'], $pages)) {
    $page = $_GET['page'];
    $pageTitle = $pages[$page];
} else {
    $page = 'connection';
    $pageTitle = $pages[$page];
}

include 'includes/header.php';

include_once 'pages/' . $page . '.php';

include 'includes/footer.php';

ob_end_flush();