<?php
$projects = $page->children()->visible()->flip();
?>

<?php snippet('header') ?>

<header class="desktop reduced">

	<?php snippet('menu') ?>

	<div id="container">

	<div class="category wrap list">

		<?php foreach($projects as $project): ?>

			<div class="project">
				<div class="inner" data-target="<?php echo $project->url() ?>">

					<?php if(!$project->featuredimage()->empty()):

					$image = $project->featuredimage()->toFile();
					$srcset = '';
					for ($i = 600; $i <= 2100; $i += 300) {
						if($i<2100): $srcset .= $image->width($i)->url() . ' ' . $i . 'w,';
						else: $srcset .= $image->url() . ' ' . $i . 'w,';
						endif;
					}
					?>
					<img 
					class="lazyload"
					srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
					data-srcset="<?php echo $srcset ?>" 
					data-sizes="auto" 
					data-optimumx="1.5" 
					alt="<?php echo $project->title()->html() ?>">
					<noscript>
						<<img src="" alt=""> src="<?php echo $image->url() ?>" alt="<?php echo $project->title()->html() ?>">
					</noscript>
				<?php endif ?>

				<div class="infos">
					<div class="overlay_absolute">
						<div class="overlay_table">
						
							<div class="overlay_cell">
							<a href="<?php echo $project->url() ?>">
								<p><?php echo $project->title()->html() ?></p>
								<p><?php echo $project->subtitle()->html() ?></p>
								<p>view project details</p>
								</a>
							</div>
						
						</div>
					</div>
					<div class="overlay_background"></div>
				</div>

			</div>
		</div>



	<?php endforeach ?>

	<div class="index-btn open">see all</div>
	<div class="index-btn close">go back</div>

	<?php snippet('footer') ?>