<?php
use Core\Authenticator;
$Authenticator = new Authenticator();
// log the user out
$Authenticator->logout();


header('location: /login');
exit();
