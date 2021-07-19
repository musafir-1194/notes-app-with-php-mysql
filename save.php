<?php

// var_dump($_POST);die;
$connection = require_once 'Notes.php';
$id = $_POST['id'] ?? '';
if ( $id )
{
    // Update
    // var_dump($_POST);die;
    $connection->updateNote($id, $_POST);
}
else
{
    // Insert
    $connection->addNote($_POST);
}
header('Location: index.php');