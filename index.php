<?php
require_once 'includes/config.inc.php';
require_once 'includes/autoloader.php';
ob_start();
session_start();

$pages = [
    'connection' => "Accueil",
    'new_character' => "Nouvelle fiche",
    'logout' => "Déconnexion",
    'new_skill' => "Nouvelle compétence",
    'new_stuff' => "Nouvel équipement",
    'update_stuff' => "Modifier un équipement",
    'update_skill' => "Modifier la compétence",
];

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