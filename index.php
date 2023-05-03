<?php
$page_title = "Home page";

include 'includes/header.php';
include 'pages/new_character.php';


$page='connection';

if(isset($_GET['page'])){
   $page = $_GET['page'];
}

include_once 'pages/'. $page .'.php';

include 'includes/footer.php';