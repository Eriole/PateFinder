<?php
include 'includes/header.php';


$page='connection';

if(isset($_GET['page'])){
   $page = $_GET['page'];
}

include_once 'pages/'. $page .'.php';

include 'includes/footer.php';