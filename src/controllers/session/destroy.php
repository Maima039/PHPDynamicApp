<?php
use Core\App;
// log the user out
logout();


header('location: /login');
exit();
