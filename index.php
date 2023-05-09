<?php
require_once 'includes/config.inc.php';
require_once 'includes/autoloader.php';
ob_start();
session_start();

$page_title = "Accueil";

include 'includes/header.php';

$page='connection';

if(isset($_GET['page'])){
    $page = $_GET['page'];
}

//Primary Alert New Character created successfully
if(isset($_GET['create'])){
    echo '<div class="alert alert-primary d-flex align-items-center" role="alert">Personnage créé</div>';
}

include_once 'pages/'. $page .'.php';

include 'includes/footer.php';

ob_end_flush();