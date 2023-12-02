<?php
use Core\Session;
view('session/create.view.php',[
    'errors'=>$_SESSION['_flash']['errors'] ?? []
])

?>