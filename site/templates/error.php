<?php snippet('header') ?>

<header class="page">

<?php snippet('menu') ?>

<div id="container" class="page">

<div class="wrap" id="page">

<div class="inner"><?php echo $page->text()->kirbytext() ?></div>

<div class="index-btn back"><a href="<?php echo $page->parent()->url() ?>">back</a></div>

</div>

<?php snippet('footer') ?>