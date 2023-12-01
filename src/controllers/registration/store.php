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

if (!Validator::string($password, 7, 275)) {
    $errors['password'] = 'Plz provide a valid pwd';
}

if (!empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

// check if user exists
$db = App::resolve(Database::class);

$user = $db->query('select * from user where email= :email', [
    'email' => $email
])->find();

if ($user) {
    // yes, redirect to login
    header('location: /login');
    exit();
} else {
    // no, register to database
    $db->query('INSERT INTO user(email, password) VALUES(:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);
    // mark that the user has logged in
    $_SESSION['user'] = ['email' => $email];
    $_SESSION['name']='Miranda';
    login($user);
    header('location:/');
    exit();
}
