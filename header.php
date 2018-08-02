<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php bloginfo('name'); wp_title(); ?></title>
<?php wp_head(); ?>
</head>

<body>
<div class="main">
	<div class="head">
		<h2>Выбери своё <br />Путешествие</h2>
		<a href="<?php echo home_url(); ?>"><span>C</span>hoose <span>T</span>ravel</a>
	</div>
	
	<div class="content-main">
<?php wp_nav_menu(array('theme_location' => 'menu', 'container' => false)); ?>
<form class="search-main" action="<?php echo home_url(''); ?>" method="">
	<input class="serch-txt" type="text" name="s" />
	<input class="serch-btn" type="image" src="<?php bloginfo('template_url') ?>/images/serach-btn.jpg" />
</form>		
	
<?php $slider = new WP_Query(array('post_type' => 'slider', 'posts_per_page' => -1, 'order' => 'ASC')); ?>

<?php if ( $slider->have_posts() ) : ?>

<div id="slider">
	<ul id="cycle">
<?php while ( $slider->have_posts() ) : $slider->the_post(); ?>
	<li><?php the_post_thumbnail('full'); ?></li>
<?php endwhile; ?>
	</ul>
	<div id="cyclePager"></div>
</div>

<?php else: ?>
	<p>Место под слайдер</p>
<?php endif; ?>
	<?php wp_reset_query(); ?>