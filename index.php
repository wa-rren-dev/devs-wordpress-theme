<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!--<button class="dark-mode">Enable Dark Mode</button>-->

<?php if (is_single()) { ?>

	<?php the_post(); ?>
		<header>
			<h1>
				<marquee behavior="alternate" scrolldelay="1000" direction="right">
					<?php the_title(); ?>
				</marquee>
				<marquee behavior="alternate" scrolldelay="900" direction="right">
					<span class="byline">by <?php echo get_the_author_meta("first_name") ?></span>, <span class="date"><?php echo get_the_date("d-m-Y"); ?></span>
				</marquee>
			</h1>
		</header>
		<main>
			<?php the_content(); ?>
		</main>
<?php } else { ?>
	<header>
		<h1>
			<marquee behavior="alternate" scrolldelay="1000" direction="right">
					devs
			</marquee>
		</h1>
	</header>
	<main>
		<ul class="archive">
			<?php if ( have_posts() ) : while (have_posts() ) : the_post(); ?>
			<li>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> by <span class="byline"><?php echo get_the_author_meta("first_name") ?></span>, <span class="date"><?php echo get_the_date("d-m-Y"); ?></span></h2>
			</li>
			<?php endwhile; endif;?>
		</ul>
	</main>
<?php } ?>

<?php wp_footer();?>

</body>
</html>
