<?php
require $_SERVER['DOCUMENT_ROOT'] . '/core/prolog.php';
global $user;
if (!$user) {
    header('Location: /authentication/index.php');
    exit();
}
include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
?>
    <div class="main__wrapper">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/blocks/personal.php' ?>
    </div>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php' ?>