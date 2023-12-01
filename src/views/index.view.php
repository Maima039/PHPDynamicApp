<?php require_once(__DIR__ . '\partials\head.php'); ?>
<?php require_once(__DIR__ . '\partials\nav.php'); ?>
<?php require_once(__DIR__ . '\partials\banner.php'); ?>
<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        Hello <?=$_SESSION['user']['email'] ?? 'Guest' ?>, Welcome home page
    </div>
</main>
<?php require_once(__DIR__ . '\partials\footer.php'); ?>