<?php snippet('header') ?>

<div class="opening">
	<div class="inner">
		<div class="title"><?php echo $site->title()->html() ?></div><div class="subtitle"><?php echo $site->subtitle()->html() ?></div>
	</div>
</div>

<script>
	var cookieIntro = document.cookie.replace(/(?:(?:^|.*;\s*)intro\s*\=\s*([^;]*).*$)|^.*$/, "$1");
	if (cookieIntro == 'seen') {
        $('.opening').remove();
    }
</script>

<header class="home">

<?php snippet('menu') ?>

<div id="container" class="home">

<div class="wrap" id="home">
</div>


<?php snippet('footer') ?>