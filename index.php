<?php
require_once 'includes/config.inc.php';
require_once 'includes/autoloader.php';

$page_title = "Home page";

include 'includes/header.php';

$page='connection';

if(isset($_GET['page'])){
   $page = $_GET['page'];
}

include_once 'pages/'. $page .'.php';

include 'includes/footer.php';