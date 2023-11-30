<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

// validate the form
$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Plz check your email address';
}

if (!Validator::string($password, 7, 10)) {
    $errors['password'] = 'Plz provide a valid pwd';
}

if (!empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

// check if user exists
$db = App::resolve(Database::class);

$res = $db->query('select * from user where email= :email', [
    'email' => $email
])->find();

if ($user) {
    // yes, redirect to login
    header('location:/');
} else {
    // no, register to database
    $db->query('INSERT INTO user(email, password) VALUES(:email, :password)', [
        'email' => $email,
        'password' => $password
    ]);
    // mark that the user has logged in
    $_SESSION['user'] = ['email' => $email];
}

header('location:/');
exit();
