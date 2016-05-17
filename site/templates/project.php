<?php snippet('header') ?>

<header class="project">

	<?php snippet('menu') ?>

	<div id="container" class="project">

		<div class="projectslider royalSlider rsDefault">

			<?php foreach($page->medias()->toStructure() as $media): ?>
				<?php if($media->_fieldset() == 'video'):?>

					<?php if( !$media->placeholder()->empty() && !$media->url()->empty() ): ?>

						<a class="rsImg" href="<?php echo $media->placeholder()->toFile()->width(1200)->url() ?>" data-rsVideo="<?php echo $media->url() ?>">
							<img src="<?php echo $media->placeholder()->toFile()->width(200)->url() ?>" class="rsTmb" />
						</a>

					<?php endif ?>
				<?php endif ?>
				<?php if($media->_fieldset() == 'image'):?>
					<?php if($media->imagefile()->toFile() !== null):?>
						<?php 
						$image = $media->imagefile()->toFile();
						?>
						<a class="rsImg" href="<?php echo $image->width(1200)->url() ?>"><img src="<?php echo $image->width(200)->url() ?>" class="rsTmb" /></a>
					<?php endif ?>
				<?php endif ?>
			<?php endforeach ?>

		</div>

		<?php foreach($page->medias()->toStructure() as $media): ?>
				<?php if($media->_fieldset() == 'image'):?>
					<?php if($media->imagefile()->toFile() !== null):?>
						<?php 
						$image = $media->imagefile()->toFile();
						?>
						<noscript>
						<img src="<?php echo resizeOnDemand($image, 1200) ?>" alt="<?php echo $page->title()->html(); if (!$page->subtitle()->empty()) { echo ', '.$page->subtitle()->html(); } ?>">
						</noscript>
					<?php endif ?>
				<?php endif ?>
			<?php endforeach ?>

		<div class="fullscreen open">go fullscreen</div>
		<div class="fullscreen close">back</div>

		<div class="projectInfos">
			<p><?php echo $page->title()->html() ?></p>
			<p><?php echo $page->subtitle()->html() ?></p>
			<p><?php echo $page->date('Y') ?></p>
			<p><?php echo $page->director()->html() ?></p>
		</div>
		
		<div class="index-btn back"><a class="link" href="<?php echo $page->parent()->url() ?>">back to the index</a></div>

		<div class="wrap">

		</div>

			<?php snippet('footer') ?>