<?php 
$categories = $pages->find('work')->children()->visible();
$menu = $pages->find('infos')->children()->visible();
?>

	<div class="top_header">
		<div class="title"><?php echo $site->title()->html() ?></div><div class="subtitle"><?php echo $site->subtitle()->html() ?></div>
	</div>

	<nav class="primary">
	<div class="inner">
		<?php foreach ($categories as $category): ?>
			<div class="category<?php e($category->isOpen(), ' active') ?>">
				<a class='link' href="<?php echo $category->url() ?>"><?php echo $category->title()->html() ?></a>
				<a class='overview'><span></span></a>
			</div>
		<?php endforeach ?>
		</div>
	</nav>
	<ul class="secondary">
		<?php foreach($menu as $p): ?>
			<li id="m-<?php echo $p->uid() ?>" <?php e($p->isOpen(), ' class="active"') ?> ><a class='link' href="<?php echo $p->url() ?>"><?php echo $p->title()->html() ?></a></li>
		<?php endforeach ?>
	</ul>
	
	<nav class="mobile">

		<ul>

		</ul>
	</nav>
</header>

