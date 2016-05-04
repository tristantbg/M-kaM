<?php snippet('header') ?>

<div class="opening">
	<div class="title"><?php echo $site->title()->html() ?></div><div class="subtitle"><?php echo $site->subtitle()->html() ?></div>
</div>

<?php snippet('menu') ?>

<div id="container">

<div class="homeslider royalSlider rsDefault">

<?php foreach($page->featuredimages()->toStructure() as $media): ?>
	<?php if($media->_fieldset() == 'image'):?>
		<?php if($media->imagefile()->toFile() !== null):?>
			<?php 
			$image = $media->imagefile()->toFile()->url();
			?>
			<a class="rsImg" href="<?php echo $image ?>"></a>
		<?php endif ?>
	<?php endif ?>
<?php endforeach ?>

</div>

<div class="wrap" id="home">


<?php snippet('footer') ?>