<?php

class Notes
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:server=localhost;dbname=notes_app_db', 'root', 'zeron123');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Get Notes Results
    public function getNotes()
    {
        $statement = $this->pdo->prepare("SELECT * FROM `notes` ORDER BY `created_date` DESC");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insert Note
    public function addNote($note)
    {
        $statement = $this->pdo->prepare("INSERT INTO `notes` (`title`, `description`, `created_date`)
            VALUES (:title, :description, :created_date)");
        
        $statement->bindValue('title', $note['title']);
        $statement->bindValue('description', $note['description']);
        $statement->bindValue('created_date', date('Y-m-d H:i:s'));

        return $statement->execute();
    }

    // Update Note
    public function updateNote($id, $note)
    {
        $statement = $this->pdo->prepare("UPDATE `notes` SET `title` = :title, `description` = :description
            WHERE `id` = :id");
        
        $statement->bindValue('id', $id);
        $statement->bindValue('title', $note['title']);
        $statement->bindValue('description', $note['description']);

        return $statement->execute();
    }

    public function getNoteById($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM `notes` WHERE `id` = :id");
        $statement->bindValue('id', $id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // Delete Note
    public function removeNote($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM `notes` WHERE `id` = :id ");
        $statement->bindValue('id', $id);
        return $statement->execute();
    }

}

return new Notes();
