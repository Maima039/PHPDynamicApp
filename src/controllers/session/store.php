<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

// validate the form
$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Plz check your email address';
}

if (!Validator::string($password, 7, 275)) {
    $errors['password'] = 'Plz provide a valid pwd';
}

if (!empty($errors)) {
    return view('session/create.view.php', [
        'errors' => $errors
    ]);
}
// log in if credentials matches

// find the user
$user = $db->query('select * from user where email= :email', [
    'email' => $email
])->find();

if ($user) {
    // email matches
    if (password_verify($password, $user['password'])) {
        login(['email' => $email]);
        $_SESSION['name']='Miranda';
        header('location: /');
        exit();
    }
}


// pwd not match or no user found
return view('session/create.view.php', [
    'errors' => ['password' => 'Wrong email or pwd']
]);
