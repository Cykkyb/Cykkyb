<?php
require $_SERVER['DOCUMENT_ROOT'] . '/core/prolog.php';
require 'templates/header.php'
?>

<div class="main__wrapper">

    <?php require 'blocks/main_banner.php' ?>
    <?php require 'blocks/main_new.php' ?>
    <?php require 'blocks/main_old.php' ?>
    <?php require 'blocks/offers.php' ?>
</div>

<?php require 'templates/footer.php' ?>