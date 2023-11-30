<?php
use Core\App;
use Core\Database;
use Core\Validator;
$db = App::resolve(Database::class);

$errors = [];

if (!Validator::string($_POST['body'], 1, 10)) {
    $errors['body'] = 'A body is required between 1 to 10 characters';
}

// form errors

if (!empty($errors)) {
    // validation issue
    return view('notes/create.view.php', [
        'heading' => 'Create',
        'errors' => $errors
    ]);
}
// no errors
$db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
    'body' => $_POST['body'],
    'user_id' => 1
]);
header('location:/notes');
die();
