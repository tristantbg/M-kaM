<?php
$projects = $page->children()->visible()->flip();
?>

<?php snippet('header') ?>

<header class="category">

	<?php snippet('menu') ?>

	<div id="container" class="category">

		<div class="category wrap index">

		<?php foreach($projects as $project): ?>
			<div class="project">
				<div class="inner link" data-target="<?php echo $project->url() ?>">

					<?php if(!$project->featuredimage()->empty()):
					$image = $project->featuredimage()->toFile();
					?>
					<img 
					class="lazyload"
					src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
					data-src="<?php echo resizeOnDemand($image, 500) ?>" 
					alt="<?php echo $project->title()->html() ?>">
				<?php endif ?>

				<div class="infos">
					<div class="overlay_absolute">
						<div class="overlay_table">

							<div class="overlay_cell">
								<a href="<?php echo $project->url() ?>">
									<p><?php echo $project->title()->html() ?></p>
									<p><?php echo $project->date('Y') ?></p>
								</a>
							</div>

						</div>
					</div>
					<div class="overlay_background"></div>
				</div>

			</div>
		</div>

	<?php endforeach ?>

</div>

		<div class="category wrap list">
			<table>
				<tr>


					<?php foreach($projects as $project): ?>
						<td>
							<div class="project">
								<div class="inner link" data-target="<?php echo $project->url() ?>">

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
										<img src="<?php echo resizeOnDemand($image, 1200) ?>" alt="<?php echo $project->title()->html(); if (!$project->subtitle()->empty()) { echo ', '.$project->subtitle()->html(); } ?>">
									</noscript>
								<?php endif ?>

								<div class="infos">
									<div class="overlay_absolute">
										<div class="overlay_table">

											<div class="overlay_cell">
												<a href="<?php echo $project->url() ?>">
													<p><?php echo $project->title()->html() ?></p>
													<p><?php echo $project->date('Y') ?></p>
												</a>
											</div>

										</div>
									</div>
									<div class="overlay_background"></div>
								</div>

							</div>
						</div>
					</td>


				<?php endforeach ?>

			</tr>
		</table>

	</div>

	

<div class="ajax hidden">
	
</div>

<?php snippet('footer') ?>