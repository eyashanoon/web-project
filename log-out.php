<?php
session_start();
$_SESSION['type'] = '';
session_destroy();
header('location:index.php');
