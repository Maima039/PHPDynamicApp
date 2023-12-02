<?php

use Core\Authenticator;
use Core\Session;

use Http\Forms\LoginForm;


// form validation
$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

// attempt to login
$signedIn = (new Authenticator)->attempt($attributes['email'], $attributes['password']);
if (!$signedIn) {
    // pwd not match or no user found
    $form->error('email', 'Wrong email or pwd')
        ->throw();
}

// success
redirect('/');



// PRG pattern: post redirect get
