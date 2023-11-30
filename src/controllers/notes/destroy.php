<?php

use Core\App;
use Core\Database;
$db = App::resolve(Database::class);

// $config = require base_path('config.php');
// connect to mysql and execute a query
// $db = new Database($config['database']);



$currentUserId = 1;

// delete function
$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

// check if user is authorized
authorize($note['user_id'] === $currentUserId);

$db->query('delete from notes where id=:id', [
    'id' => $_POST['id']
]);

header('location:/notes');
exit();
