<?php
if(kirby()->request()->ajax()) {
	$page = page($uri);
	$site = site();
	?>

		<div class="projectslider royalSlider rsDefault">

			<?php foreach($page->medias()->toStructure() as $media): ?>
				<?php if($media->_fieldset() == 'video'):?>

					<?php if( !$media->placeholder()->empty() && !$media->url()->empty() ): ?>
					<?php $image = $media->placeholder()->toFile() ?>

						<a class="rsImg" href="<?php echo resizeOnDemand($image, 1200) ?>" data-rsVideo="<?php echo $media->url() ?>">
							<img src="<?php echo resizeOnDemand($image, 200) ?>" class="rsTmb"/>
						</a>

					<?php endif ?>
				<?php endif ?>
				<?php if($media->_fieldset() == 'image'):?>
					<?php if($media->imagefile()->toFile() !== null):?>
						<?php 
						$image = $media->imagefile()->toFile();
						?>
						<a class="rsImg" href="<?php echo resizeOnDemand($image, 1200) ?>">
						<img src="<?php echo resizeOnDemand($image, 200) ?>" class="rsTmb" />
						</a>
					<?php endif ?>
				<?php endif ?>
				<?php $mediaindex++ ?>
			<?php endforeach ?>

		</div>

		<div class="fullscreen open">go fullscreen</div>
		<div class="fullscreen close">back</div>

		<div class="projectInfos">
			<p><?php echo $page->title()->html() ?></p>
			<p><?php echo $page->subtitle()->html() ?></p>
			<p><?php echo $page->date('Y') ?></p>
			<p><?php echo $page->director()->html() ?></p>
		</div>
		
		<div class="index-btn back"><a class="link" href="<?php echo $page->parent()->url() ?>">back to the index</a></div>

		<?php
	}
	else {
		header::status('404');
	}