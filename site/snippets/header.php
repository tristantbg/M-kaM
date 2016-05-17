<!DOCTYPE html>
<html lang="en" class="no-js">
<head>

	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="dns-prefetch" href="//www.google-analytics.com">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="canonical" href="<?php echo html($page->url()) ?>" />
	<?php if($page->isHomepage()): ?>
      <title><?php echo $site->title()->html() ?></title>
    <?php else: ?>
      <title><?php echo $site->title()->html() ?> | <?php echo $page->title()->html(); if (!$page->subtitle()->empty()) { echo ', '.$page->subtitle()->html(); } ?></title>
    <?php endif ?>
	<meta name="description" content="<?php echo $site->description()->html() ?>">
	<meta name="robots" content="index,follow" />
	<meta name="keywords" content="<?php echo $site->keywords()->html() ?>">
	<meta name="DC.Title" content="<?php echo $page->title()->html() ?>" />
    <meta name="DC.Description" content="<?php echo $site->description()->html() ?>"/ >
    <?php if($page->isHomepage()): ?>
      <meta property="og:title" content="<?php echo $site->title()->html() ?>" />
    <?php else: ?>
      <meta property="og:title" content="<?php echo $site->title()->html() ?> | <?php echo $page->title()->html(); if (!$page->subtitle()->empty()) { echo ', '.$page->subtitle()->html(); } ?>" />
    <?php endif ?>
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo html($page->url()) ?>" />
    
    <?php if($page->content()->name() == "project"): ?>
	      <?php foreach($page->medias()->toStructure()->flip() as $index => $media): ?>
	      	<?php if($index < 4):?>
	    	<?php if($media->_fieldset() == 'image'):?>
			<?php if($media->imagefile()->toFile() !== null):?>
				<?php $image = $media->imagefile()->toFile()->resize(1200)->url(); ?>
				<meta property="og:image" content="<?php echo $image ?>" />
			<?php endif ?>
		<?php endif ?>
		<?php endif ?>
		<?php endforeach ?>
	<?php elseif($page->content()->name() == "category"): ?>
		<meta property="og:image" content="<?php echo $page->children()->visible()->flip()->first()->featuredimage()->toFile()->resize(1200)->url() ?>" />
	<?php else: ?>
		<?php if(!$site->ogimage()->empty()): ?>
			<meta property="og:image" content="<?= $site->ogimage()->toFile()->width(1200)->url() ?>"/>
		<?php endif ?>
    <?php endif ?>

    <meta property="og:description" content="<?php echo $site->description()->html() ?>" />
    <meta itemprop="name" content="<?php echo $site->title()->html() ?> | <?php echo $page->title()->html(); if (!$page->subtitle()->empty()) { echo ', '.$page->subtitle()->html(); } ?>">
    <meta itemprop="description" content="<?php echo $site->description()->html() ?>">
	<link rel="shortcut icon" href="<?= url('assets/images/favicon.ico') ?>">
	<link rel="icon" href="<?= url('assets/images/favicon.ico') ?>" type="image/x-icon">

	<?php 
	echo css('assets/css/app.min.css');
	echo js('assets/js/vendor/modernizr.min.js');
	?>
	
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?= url('assets/js/vendor/jquery.min.js') ?>">\x3C/script>')</script>

	<?php if(!$site->customcss()->empty()): ?>
		<style type="text/css">
			<?php echo $site->customcss()->html() ?>
		</style>
	<?php endif ?>

</head>
<body id="<?php echo $page->uid() ?>">

<div class="loader"></div>