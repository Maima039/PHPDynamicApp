<?php

use Core\App;
use Core\Database;
use Core\Validator;
$db = App::resolve(Database::class);

$currentUserId = 1;

// 1. find the corresponding note
$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

// 2. check if user is authorized
authorize($note['user_id'] === $currentUserId);

// 3. validate the form

$errors = [];
if (!Validator::string($_POST['body'], 1, 10)) {
    $errors['body'] = 'A body is required between 1 to 10 characters';
}

// 4. form errors
if (!empty($errors)) {
    // validation issue
    return view('notes/edit.view.php', [
        'heading' => 'Edit note',
        'errors' => $errors,
        'note' => $note
    ]);
}

// 5. if no errors, update the database
$db -> query('update notes set body= :body where id = :id',[
    'body' => $_POST['body'],
    'id' => $_POST['id']
]);

// 6. redirect to notes
header('location: /notes');
die(); 