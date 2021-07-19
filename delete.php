<?php
$connection = require_once 'Notes.php';
$connection->removeNote( $_POST['id'] );
header('Location: index.php');