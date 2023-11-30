<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p>
            <?= htmlspecialchars($note['body']) ?>
        </p>
        <a href="notes" class=" text-blue-500 hover:underline ">go back</a>
        <footer class="mt-6">
            <a href="note/edit?id=<?=$note['id'] ?>" class=" text-grey-500 hover:underline border:current">edit this note</a>
        </footer>
       
        </form>
    </div>
</main>
<?php require base_path('views/partials/footer.php'); ?>