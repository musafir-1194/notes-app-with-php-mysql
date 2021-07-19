<?php
    $connection = require_once 'Notes.php';
    // Get Notes Results
    $notes = $connection->getNotes();

    $currentNote = [
        'id' => '',
        'title' => '',
        'description' => ''
    ];
    if ( isset($_GET['id']) )
    {
        $currentNote = $connection->getNoteById( $_GET['id'] )[0];
        // var_dump($currentNote);die;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App using PHP & MySQL</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="heading">
            <h1>Notes | Sagar Panwar</h1>
        </div>
        <div class="note_form">
            <form action="save.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $currentNote['id']; ?>">
                <input type="text" name="title" placeholder="Note title ..."  value="<?php echo $currentNote['title']; ?>"/>
                <textarea name="description" id="description" placeholder="Note description ..."><?php echo $currentNote['description']; ?></textarea>
                <?php if ( $currentNote['id'] ) : ?>
                    <button class="btn-primary">Update Note</button>
                <?php else : ?>
                    <button class="btn-primary">New Note</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="notes_result">
            <?php foreach($notes as $note) : ?>
            <div class="note_area">
                <div class="note__title">
                    <a href="?id=<?php echo $note['id']; ?>"><?php echo $note['title']; ?></a>
                </div>
                <div class="note__desc">
                    <?php echo $note['description']; ?>
                </div>
                <small><?php echo $note['created_date']; ?></small>
                <form action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $note['id']?>" />
                    <button class="close">X</button>
                </form>
            </div>
            <?php endforeach; ?>
            <!-- <div class="note_area">
                <div class="note__title">
                    <a href="#">Sample Note</a>
                </div>
                <div class="note__desc">
                    Sample note description
                </div>
                <small>19/07/2021 19:00:00</small>
                <button class="close">X</button>
            </div> -->
        </div>
    </div>
</body>
</html>